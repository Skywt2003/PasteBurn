<?php

/*
 * 一些常用的函数
 * 包括载入配置文件、连接数据库
 */

include 'config.php';
include 'jwt.php';

$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

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
    
    if ($row = mysqli_fetch_array($result)){
        return ($row['userPassword'] == $pswd);
    } else {
        return false;
    }
}

?>

