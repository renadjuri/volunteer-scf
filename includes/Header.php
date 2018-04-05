<!DOCTYPE html>
<html>
    <head>
        <!--page title to pass it to the header-->

        <title>
            <?= isset($page_title) ? $page_title : "جمعية السرطان السعودية" ?>
        </title>
        <link rel="shortcut icon" href="images/logo1.png"></link>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link href="css\style.css" rel="stylesheet" type="text/css" />


        <script src="js/jquery.min.js"></script>

    </head>
    <body>
        <!-- header element creates a header for the page -->
        <header>
            <!--Logo of the website-->
            <center>
                <a href="index.php">
                    <img src="images/logo.png"  alt="جمعية السرطان السعودية" 
                         id="logo"></a>
            </center>
            <!--Navigation menu-->

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
                        <!--
                           <ul class="nav navbar-right">
                               <li> <a class="navbar-brand"  href="home.php">
                                       <img src="images/logo1.png" width="50" height="40" alt="">
                                   </a>
                               </li>
   
                           </ul>
                        -->
                        <ul class="nav navbar-nav  navbar-right">
                            <!-- Image and text -->
                            <li><a href="#contact">تواصل</a></li>
                            <li><a href="#">عن جمعية السرطان السعوية</a></li>
                            <li><a href="/events.php">الفعاليات</a></li> 
                            <li ><a href="/home.php">الصفحة الرئيسة</a></li>

                        </ul>
                        <ul class="nav navbar-nav navbar-left">
                            <li><a href="register2.php"><span class="glyphicon glyphicon-user"></span>إنشاء حساب</a></li>

                            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> تسجيل الدخول</a></li>
                        </ul>
                    </div>
                </div>
            </nav>


