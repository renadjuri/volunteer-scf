<?php
session_start();
@ob_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <!--page title to pass it to the header-->
        <title>
            <?php
            isset($page_title) ? $page_title : "جمعية السرطان السعودية";
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
        <link href="css\style1.css" rel="stylesheet" type="text/css" />
    </head>

    <body>

        
            <?php
            $filename = basename($_SERVER["SCRIPT_FILENAME"], '.php');
            ?>
            <div class="container">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar9">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="brand-centered">
                            <a class="navbar-brand" href="index.php"><img src="images/logo.png" style="width: 220px; height: 90px" alt="جمعية السرطان السعودية" id="logo"></a>
                        </div>

                        <div id="navbar9" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav navbar-left">
                                <!-- check if the user logged in -->
                                <?php
                                if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

                                    if (isset($_SESSION['admin'])) {
                                        ?> 
                                        <li <?php echo ($filename == 'admin_events_tab') ? 'class="active"' : ''; ?>>
                                            <a href="admin_events_tab.php" style="font-size: 12pt;"> <span><?php
                                                    $username = $_SESSION["username"];
                                                    echo $username;
                                                    ?>  </span>
                                        </span> <span class="glyphicon glyphicon-user"style="font-size: 10pt;"></span> </a></li>
                                        <li> <a href="logout.php" style="font-size: 12pt;" > تسجيل الخروج <span class="glyphicon glyphicon-log-out" style="font-size: 10pt;"></span> </a></li>
                                    
                                        <?php
                                    } else
                                    if (empty($_SESSION['admin'])) {
                                        ?>
                                        <li <?php echo ($filename == 'volunteer_personal_information_tab') ? 'class="active"' : ''; ?>>
                                            <a href="volunteer_personal_information_tab.php"style="font-size: 12pt;"> <span><?php
                                                    $username = $_SESSION["username"];
                                                    echo $username;
                                                    ?>  </span> <span class="glyphicon glyphicon-user"style="font-size: 10pt;"></span> </a></li>
                                        <li> <a href="logout.php" style="font-size: 12pt;" > تسجيل الخروج <span class="glyphicon glyphicon-log-out" style="font-size: 10pt;"></span> </a></li>

                                        <?php
                                    }
                                }
                                ?>
                                <!-- check if there is no logged in user-->
                                <?php if (empty($_SESSION['username']) && empty($_SESSION['id'])) { ?>
                                    <li <?php echo ($filename == 'انشاء حساب') ? 'class="active"' : ''; ?>><a href="signup.php" style="font-size: 12pt;"> انشاء حساب <span class="glyphicon glyphicon glyphicon-user" style="font-size: 10pt;">

                                            </span> </a></li>
                                            <li <?php echo ($filename == 'login') ? 'class="active"' : ''; ?>><a href="login.php" style="font-size: 12pt;">تسجيل الدخول <span class="glyphicon glyphicon-log-in" style="font-size: 10pt;">

                                            </span> </a></li>

                                    <?php
                                }
                                ?>

                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <!-- Image and text -->
                                <li<?php echo ($filename == '#contact') ? 'class="active"' : ''; ?> ><a href="contact.php">تواصل</a></li>
                                <li <?php echo ($filename == 'about') ? 'class="active"' : ''; ?>><a href="about.php">عن الجمعية</a></li>
                                <li <?php echo ($filename == 'events') ? 'class="active"' : ''; ?> ><a href="events.php">الفعاليات</a></li> 
                                <li <?php echo ($filename == 'index') ? 'class="active"' : ''; ?> ><a href="index.php">الرئيسية</a></li>
                                <li></li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                    <!--/.container-fluid -->
                </nav>
            </div>




        <button onclick="topFunction()" id="myBtn">  <span class="glyphicon glyphicon-chevron-up"></span></button>




