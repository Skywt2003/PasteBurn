<?php
include 'functions.php';
if ($login_enable == false) header("location: index.php");
setcookie("user", "", time()-3600);
setcookie("pswd", "", time()-3600);
header ( "location:index.php" );
?>