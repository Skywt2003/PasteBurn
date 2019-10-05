<?php
include 'functions.php';
if ($login_enable == false) header("location: index.php");
include 'header.php';
?>

<div class="container maincontent">
    <?php if (isset($_COOKIE['user']) == false){
        header ( "location:login.php" );
    } else if (checkLogin($_COOKIE['user'],$_COOKIE['pswd']) == false){ // 登录验证
        header ( "location:logout.php" );
    } else { ?>
        <p>Welcome back, <?php echo $_COOKIE['user']; ?>.</p>
        <p>更多功能正在开发中……</p>
    <?php } ?>
</div>

<?php include 'footer.php' ?>
