<?php

/*
 * 用户中心 页面
 * Todo: 已分享的文字管理
 */

include 'functions.php';
if (LOGIN_ENABLE == false) header("location: index.php");
include 'header.php';
?>

<div class="container maincontent">
    <?php if (isset($_COOKIE['pb_token']) == false){
        header ( "location: login.php?from=logout" );
    } else if (Jwt::verifyToken($_COOKIE['pb_token']) == false){
        setcookie("pb_user", "", time()-3600);
        setcookie("pb_token", "", time()-3600);
        header ( "location: login.php?from=logout" );
    } else { ?>
        <p>Welcome back, <?php echo $_COOKIE['pb_user']; ?>.</p>
        
    <?php } ?>
</div>

<?php include 'footer.php' ?>
