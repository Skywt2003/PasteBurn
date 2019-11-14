<?php

/*
 * 登录，支持 API 调用
 */

include '../functions.php';

if (empty($_POST['user'])){
    $ret = array('success' => false, 'info' => 'Username is empty', 'token' => '');
    die(json_encode($ret));
}
if ($conn->connect_error){
    $ret = array('success' => false, 'info' => 'Failed to connect to the database', 'token' => '');
    die(json_encode($ret));
}

$user = $_POST['user'];
$pswd = $_POST['pswd'];

if (checkUser($user,$pswd) == false){
    $ret = array('success' => false, 'info' => 'User invalid', 'token' => '');
    die(json_encode($ret));
}

$payload = array('iat'=>time(),'exp'=>time() + ($maintain_time?$maintain_time:86400),'nbf'=>time(),'sub'=>$user,'name'=>$user,'jti'=>md5(uniqid('JWT').time()));;
$token = Jwt::getToken($payload);

$ret = array('success' => true, 'info' => '', 'token' => $token);

exit(json_encode($ret));

?>