<?php
include 'functions.php';

$ret;

$uid = $_GET["id"];

$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    die("Failed to connect to the database: " . $conn->connect_error);
}

$result = mysqli_query($conn,"SELECT * FROM pb_content WHERE textId='$uid' ");

if ($row = mysqli_fetch_array($result)){
    $ret = array('success' => true, 'text' => $row['textContent'], 'user' => $row['textUser']);
} else {
    $ret = array('success' => false, 'text' => '', 'user' => '');
}

echo json_encode($ret);

if ($debug == false) mysqli_query($conn,"DELETE FROM pb_content WHERE textId='$uid' ");

?>