<?php
include 'functions.php';
if ($login_enable == false) header("location: index.php");

if ($_POST['username'] != ""){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
    
    $result = mysqli_query($conn,"SELECT * FROM pb_users WHERE userName='$username' OR userEmail='$email' ");
    if ($row = mysqli_fetch_array($result)){
        $failed = true;
        $errinfo = "用户名或 Email 已存在";
    } else {
        $sql = "INSERT INTO pb_users (userName, userPassword, userPermission, userEmail) VALUES ('$username', '$password', 0, '$email')";
        $failed = ($conn->query($sql) == false);
        if ($failed) $errinfo = "数据库错误"; else $suc=true;
    }
}

include 'header.php';
?>

<div class="container maincontent">
    <?php if ($register_enable == false){ ?>
        <div class="alert alert-info">
            暂时不开放注册。
        </div>
    <?php } else {?>
        <?php if (isset($_COOKIE['user'])) header("location: user.php") ?>
        <h3>Register</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
        </form> <br>
        <?php if ($failed){?>
            <div class="alert alert-danger">
                <?php echo $errinfo ?>
            </div>
        <?php } else if ($suc) header("location:login.php") ?>
    <?php } ?>
</div>

<?php include 'footer.php' ?>
