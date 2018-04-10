
<!DOCTYPE html>
<html>
    <head>
        <!--page title to pass it to the header-->
        <title>
            <?php
            isset($page_title) ? $page_title : "جمعية السرطان السعودية";
            session_start(); // Starting Session
            ?>
        </title>
        <!--page logo at the header-->
        <link rel="shortcut icon" href="images/logo1.png"></link>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- Style CSS -->
        <link href="css\style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>

        <header>
            <!--Logo of the website-->

            <div class="container-fluid" style="background-image:url(images/header-2.png); height: 360px">
                <a href="index.php">
                    <img src="images/logo.png" style="width: 160px; height: 120px" alt="جمعية السرطان السعودية" id="logo"></a>
            </div>

            <!--Navigation menu-->
            <?php
            $filename = basename($_SERVER["SCRIPT_FILENAME"], '.php');
            ?>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">

                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>                        
                        </button>
                    </div>

                    <div class="collapse navbar-collapse" id="myNavbar">

                        <ul class="nav navbar-nav  navbar-right">
                            <!-- Image and text -->
                            <li<?php echo ($filename == '#contact') ? 'class="active"' : ''; ?> ><a href="index.php#contact">تواصل</a></li>
                            <li <?php echo ($filename == 'about') ? 'class="active"' : ''; ?>><a href="about.php">عن جمعية السرطان السعودية</a></li>
                            <li <?php echo ($filename == 'events') ? 'class="active"' : ''; ?> ><a href="events.php">الفعاليات</a></li> 
                            <li <?php echo ($filename == 'index') ? 'class="active"' : ''; ?> ><a href="index.php">الصفحة الرئيسة</a></li>

                        </ul>
                        <ul class="nav navbar-nav navbar-left">

                            <!-- check if the user logged in -->
                            <?php
                            if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

                                if (isset($_SESSION['admin'])) {
                                    ?> 
                                    <li <?php echo ($filename == 'admin-profile') ? 'class="active"' : ''; ?>>
                                        <a href="admin-profile.php"><span class="glyphicon glyphicon-user"></span> <span><?php
                                                $username = $_SESSION["username"];
                                                echo $username;
                                                ?>  </span></a></li>
                                    <li> <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> تسجيل الخروج</a></li>

                                    <?php
                                } else
                                if (empty($_SESSION['admin'])) {
                                    ?>
                                    <li <?php echo ($filename == 'volunteerprofile') ? 'class="active"' : ''; ?>>
                                        <a href="volunteerprofile.php"><span class="glyphicon glyphicon-user"></span> <span><?php
                                                $username = $_SESSION["username"];
                                                echo $username;
                                                ?>  </span></a></li>
                                    <li> <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> تسجيل الخروج</a></li>

                                    <?php
                                }
                            }
                            ?>
                            <!-- check if there is no logged in user-->
                            <?php if (empty($_SESSION['username']) && empty($_SESSION['id'])) { ?>
                                <li <?php echo ($filename == 'انشاء حساب') ? 'class="active"' : ''; ?>><a href="signup.php"><span class="glyphicon glyphicon glyphicon-user">

                                        </span> انشاء حساب</a></li>
                                <li <?php echo ($filename == 'login') ? 'class="active"' : ''; ?>><a href="login.php"><span class="glyphicon glyphicon-log-in">

                                        </span> تسجيل الدخول</a></li>

                                <?php
                            }
                            ?>

                        </ul>

                    </div>
                </div>
            </nav>

        </header>
    <body>
        <button onclick="topFunction()" id="myBtn">  <span class="glyphicon glyphicon-chevron-up"></span></button>




