<?php
include 'config.php';

function create_uuid($prefix = ""){
    $str = md5(uniqid(mt_rand(), true));  
    $uuid  = substr($str,0,8) . '-';  
    $uuid .= substr($str,8,4) . '-';  
    $uuid .= substr($str,12,4) . '-';  
    $uuid .= substr($str,16,4) . '-';  
    $uuid .= substr($str,20,12);  
    return $prefix . $uuid;
}

function checkLogin($user, $pswd_md5){
    global $db_servername, $db_username, $db_password, $db_name;
    
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
    $result = mysqli_query($conn,"SELECT * FROM pb_users WHERE userName='$user' ");
    
    if ($row = mysqli_fetch_array($result)){
        return (md5($row['userPassword']) == $pswd_md5);
    } else {
        return false;
    }
}

?>

