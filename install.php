<?php

echo "请确保在 config.php 中配置了所有内容。<br>";

include 'config.php';

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("连接数据库失败：" . $conn->connect_error);
}

$sql = "CREATE TABLE pb_content (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
textId VARCHAR(255) NOT NULL,
textContent TEXT(65535) NOT NULL,
textUser VARCHAR(255) NOT NULL,
date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "成功创建数据库 pb_content <br>";
} else {
    echo "创建数据库 pb_content 失败：" . $conn->error . "<br>";
}

$sql = "CREATE TABLE pb_users (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
userName VARCHAR(255) NOT NULL,
userPassword VARCHAR(255) NOT NULL,
userPermission INT NOT NULL,
userEmail VARCHAR(255) NOT NULL,
date TIMESTAMP
)";
 
if ($conn->query($sql) === TRUE) {
    echo "成功创建数据库 pb_users <br>";
} else {
    echo "创建数据库 pb_users 失败：" . $conn->error . "<br>";
}

$conn->close();

echo "完成。";

?>
