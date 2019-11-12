<?php
/*
 * 登录页面
 */

include 'functions.php';
if (LOGIN_ENABLE == false) header("location: index.php");
include 'header.php';
?>

<script>
$(document).ready(function(){
    $("#submit").click(function(){
        $.post("./api/login.php",
        {
            user: $("#username").val(),
            pswd: $("#password").val()
        },
        function(data,status){
            var ret = JSON.parse(data);
            if (ret.success == false){
                $("#hint").addClass("alert alert-danger");
                $("#hint").text("Login failed：" + ret.info);
            } else {
                document.cookie="pb_token=" + ret.token;
                document.cookie="pb_user=" + $("#username").val();
                window.location.href="user.php";
            }
        });
    });
});
</script>

<div class="container maincontent">
    <?php if (isset($_COOKIE['pb_token']) == false){ ?>
        <h3>Login</h3>
        <form id="main">
            <?php if ($_GET['from'] == 'logout') {?>
                <div id="hint" class="alert alert-info">您已登出，请重新登录。</div>
            <?php } ?>
            <?php if ($_GET['from'] == 'register') {?>
                <div id="hint" class="alert alert-info">注册成功，请登录。</div>
            <?php } ?>
            <div class="form-group">
                <input type="text" id="username" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" id="password" class="form-control" placeholder="Password">
            </div>
            <!--<div class="custom-control custom-checkbox">-->
            <!--    <input type="checkbox" class="custom-control-input" id="customCheck" name="remenber">-->
            <!--    <label class="custom-control-label" for="customCheck">Remenber me</label>-->
            <!--</div> <br>-->
            <button id="submit" type="button" class="btn btn-primary">Submit</button>
        </form> <br>
        <div id="hint"></div>
    <?php } else header ( "location:user.php" ); ?>
</div>

<?php include 'footer.php' ?>
