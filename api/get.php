<?php

/*
 * 取回文字，支持 API 调用
 */

include '../functions.php';

$uid = $_GET["id"];

if ($conn->connect_error){
    $ret = array('success' => false, 'info' => 'Failed to connect to the database', 'text' => '', 'time' => '');
    die(json_encode($ret));
}

$result = mysqli_query($conn,"SELECT * FROM pb_content WHERE textId='$uid' ");

if ($row = mysqli_fetch_array($result)){
    $ret = array('success' => true, 'info' => '', 'text' => $row['textContent'], 'user' => $row['textUser'], 'time' => $row['date']);
} else {
    $ret = array('success' => false, 'info' => '404 not found', 'text' => '', 'user' => '', 'time' => '');
}

if (DEBUG_MODE == false) mysqli_query($conn, "DELETE FROM pb_content WHERE textId='$uid' ");

exit(json_encode($ret));
