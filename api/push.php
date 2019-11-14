<?php

/*
 * 推送文字，支持 API 调用
 */

include '../functions.php';

if (empty($_POST['text'])){
    $ret = array('success' => false, 'info' => 'Text is empty.');
    die(json_encode($ret));
}
if ($conn->connect_error){
    $ret = array('success' => false, 'info' => 'Failed to connect to the database');
    die(json_encode($ret));
}

$burntext = $_POST['text'];
$burntext = htmlspecialchars($burntext,ENT_QUOTES);
$savetime = $_POST['savetime'];
$token = $_POST['token'];

if (!empty($token)) $payload = Jwt::verifyToken($token);

$uid = create_uuid();

if ($savetime == 'true') $date = "'".date("Y-m-d H:i:s")."'"; else $date = 'NULL';

if ($token == ""){
    $sql = "INSERT INTO pb_content (textContent, textId, textUser, date) VALUES ('$burntext', '$uid', '', $date)";
} else if ($payload != false){
    $username = $payload['sub'];
    $sql = "INSERT INTO pb_content (textContent, textId, textUser, date) VALUES ('$burntext', '$uid', '$username', $date)";
} else {
    $ret = array('success' => false, 'info' => 'Token invalid');
    die(json_encode($ret));
}

if ($conn->query($sql) === TRUE){
    $ret = array('success' => true, 'info' => $uid);
} else {
    $ret = array('success' => false, 'info' => 'Unknow error');
}
exit(json_encode($ret));