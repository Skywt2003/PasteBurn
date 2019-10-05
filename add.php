<?php
include "functions.php";

$ret;

if (empty($_POST["text"])){
    $ret = array('success' => false, 'info' => '文本为空');
} else {
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
    if ($conn->connect_error){
        die("{ 'success':false, 'info':'数据库连接错误：".$conn->connect_error."' }");
    }
    
    $burntext = $_POST["text"];
    $uid = create_uuid();
    $user = $_POST["user"];
    $pswd_md5 = $_POST["pswd"];
    
    if ($user != ""){
        if (checkLogin($user,$pswd_md5)==false){
            die("{ 'success':false, 'info':'账号信息错误' }");
        }
        $sql = "INSERT INTO pb_content (textContent, textId, textUser) VALUES ('$burntext', '$uid', '$user')";
    } else {
        $sql = "INSERT INTO pb_content (textContent, textId, textUser) VALUES ('$burntext', '$uid', '')";
    }
    
    if ($conn->query($sql) === TRUE){
        $ret = array('success' => true, 'info' => $uid);
    } else {
        $ret = array('success' => false, 'info' => '未知错误');
    }
    $conn->close();
}

echo json_encode($ret);

?>