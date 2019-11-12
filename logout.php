<?php

/*
 * 登出页面
 × 注：此页面仅用于用户主动退出登录
 */

include 'functions.php';
if (LOGIN_ENABLE == false) header("location: index.php");

setcookie("pb_user", "", time()-3600);
setcookie("pb_token", "", time()-3600);
header ( "location:index.php" );
?>