<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>PasteBurn</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
        <!--<script src="https://cdn.staticfile.org/jquery/3.4.1/jquery.min.js"></script>-->
        <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
        <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
        
        
        <link rel="stylesheet" href="./style.css">
    </head>
    
    <body>
        <nav class="navbar navbar-expand-sm bg-light navbar-light">
            <div class="container">
                <a class="navbar-brand" href="<?php echo $siteurl ?>">PasteBurn</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="https://github.com/Skywt2003/PasteBurn/blob/master/API.md">API</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://github.com/Skywt2003/PasteBurn/blob/master/CHANGELOG.md">ChangeLog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                    </ul>
                    <?php if ($login_enable == true) {?>
                        <ul class="navbar-nav navbar-right">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    <?php if (isset($_COOKIE["pb_user"])) echo $_COOKIE["pb_user"]; else echo "Guest"; ?>
                                </a>
                                <div class="dropdown-menu">
                                    <?php if (isset($_COOKIE["pb_user"])){ ?>
                                        <a class="dropdown-item" href="user.php">My Text</a>
                                        <a class="dropdown-item" href="logout.php">Logout</a>
                                    <?php } else { ?>
                                        <a class="dropdown-item" href="login.php">Login</a>
                                        <a class="dropdown-item" href="register.php">Register</a>
                                    <?php } ?>
                                </div>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </nav>