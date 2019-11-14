<?php

/*
 * 一些常用的函数
 * 包括载入配置文件、JWT 模块、数据库连接
 */

include 'config.php';

/**
 * PHP 实现 JWT
 * https://segmentfault.com/a/1190000016251365
 */

class Jwt {
    //头部
    private static $header=array(
        'alg'=>'HS256', //生成 signature 的算法
        'typ'=>'JWT'    //类型
    );

    //使用 HMAC 生成信息摘要时所使用的密钥
    
    private static $key = GLOBAL_KEY;

    /**
     * 获取 jwt token
     * @param array $payload jwt 载荷 格式如下 非必须
     * [
     *  'iat'=>time(),  //签发时间
     *  'exp'=>time()+7200,  //过期时间
     *  'nbf'=>time()+60,  //该时间之前不接收处理该 Token
     *  'sub'=>'www.admin.com',  //面向的用户 / Whom the token refers to
     *  'name'=>'username', //用户名
     *  'jti'=>md5(uniqid('JWT').time())  //该 Token 唯一标识
     * ]
     * @return bool|string
     */
    public static function getToken(array $payload){
        if (is_array($payload)){
            $base64header=self::base64UrlEncode(json_encode(self::$header,JSON_UNESCAPED_UNICODE));
            $base64payload=self::base64UrlEncode(json_encode($payload,JSON_UNESCAPED_UNICODE));
            $token=$base64header.'.'.$base64payload.'.'.self::signature($base64header.'.'.$base64payload,self::$key,self::$header['alg']);
            return $token;
        } else {
            return false;
        }
    }

    /**
     * 验证 token 是否有效,默认验证 exp,nbf,iat 时间
     * @param string $Token 需要验证的 token
     * @return bool|string
     */
    public static function verifyToken(string $Token)
    {
        $tokens = explode('.', $Token);
        if (count($tokens) != 3) return false;

        list($base64header, $base64payload, $sign) = $tokens;
        $base64decodeheader = json_decode(self::base64UrlDecode($base64header), JSON_OBJECT_AS_ARRAY);
        if (empty($base64decodeheader['alg'])) return false;
        if (self::signature($base64header . '.' . $base64payload, self::$key, $base64decodeheader['alg']) !== $sign) return false;

        $payload = json_decode(self::base64UrlDecode($base64payload), JSON_OBJECT_AS_ARRAY);

        //签发时间大于当前服务器时间验证失败
        if (isset($payload['iat']) && $payload['iat'] > time()) return false;

        //过期时间小于当前服务器时间验证失败
        if (isset($payload['exp']) && $payload['exp'] < time()) return false;

        //该 nbf 时间之前不接收处理该 Token
        if (isset($payload['nbf']) && $payload['nbf'] > time()) return false;

        return $payload;
    }

    /**
     * base64UrlEncode https://jwt.io/ 中 base64UrlEncode 编码实现
     * @param string $input 需要编码的字符串
     * @return string
     */
    private static function base64UrlEncode(string $input)
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }

    /**
     * base64UrlEncode https://jwt.io/ 中 base64UrlEncode 解码实现
     * @param string $input 需要解码的字符串
     * @return bool|string
     */
    private static function base64UrlDecode(string $input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $addlen = 4 - $remainder;
            $input .= str_repeat('=', $addlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }

    /**
     * HMACSHA256 签名 https://jwt.io/ 中 HMACSHA256 签名实现
     * @param string $input 为 base64UrlEncode(header).".".base64UrlEncode(payload)
     * @param string $key
     * @param string $alg 算法方式
     * @return mixed
     */
    private static function signature(string $input, string $key, string $alg = 'HS256')
    {
        $alg_config=array(
            'HS256'=>'sha256'
        );
        return self::base64UrlEncode(hash_hmac($alg_config[$alg], $input, $key,true));
    }
}

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

function create_uuid($prefix = ""){
    $str = md5(uniqid(mt_rand(), true));  
    $uuid  = substr($str,0,8) . '-';  
    $uuid .= substr($str,8,4) . '-';  
    $uuid .= substr($str,12,4) . '-';  
    $uuid .= substr($str,16,4) . '-';  
    $uuid .= substr($str,20,12);  
    return $prefix . $uuid;
}

function checkUser($user, $pswd){
    global $conn;
    
    $result = mysqli_query($conn,"SELECT * FROM pb_users WHERE userName='$user' ");
    
    require_once('phpass-0.5/PasswordHash.php');
    $hasher = new PasswordHash(8, false);
    
    if ($row = mysqli_fetch_array($result)){
        return $hasher->CheckPassword($pswd, $row['userPassword']);
    } else {
        return false;
    }
}

?>

