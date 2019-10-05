<?php
include 'functions.php';
if ($login_enable == false) header("location: index.php");

if ($_POST['username'] != ""){
    // session_destroy();
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
    $result = mysqli_query($conn,"SELECT * FROM pb_users
    WHERE userName='$username' AND userPassword='$password' ");
    
    if ($row = mysqli_fetch_array($result)){
        setcookie("user", $username, time()+3600 );
        setcookie("pswd", md5($password), time()+3600 );
        // session_start();
        // $_SESSION['user'] = $username;
        $failed = false;
        header ( "location:user.php" );
    } else {
        $failed = true;
    }
}

include 'header.php';
?>

<div class="container maincontent">
    <?php if (isset($_COOKIE['user']) == false){ ?>
        <h3>Login</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <!--<div class="custom-control custom-checkbox">-->
            <!--    <input type="checkbox" class="custom-control-input" id="customCheck" name="remenber">-->
            <!--    <label class="custom-control-label" for="customCheck">Remenber me</label>-->
            <!--</div> <br>-->
            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
        </form> <br>
        <?php if ($failed){?>
            <div class="alert alert-danger">
                Login failed, please try again.
            </div>
        <?php } ?>
    <?php } else header ( "location:user.php" ); ?>
</div>

<?php include 'footer.php' ?>
