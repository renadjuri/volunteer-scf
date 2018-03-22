<!DOCTYPE html>
<html>
    <head><!--page title to pass it to the header-->
        <meta http-equiv="Content-Type" content="text/html;  charset=utf-8" />
        <title>
            <?= isset($page_title) ? $page_title : "جمعية السرطان السعودي" ?>
        </title>
        <script src="js/jquery.min.js"></script>
        <link href="css/profile.css" rel="stylesheet" type="text/css"/>
        <link href="css/style13.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <!-- header element creates a header for the page -->
        <header>
            <!--Logo of the website-->
            <center>
                <a href="index.php">
                    <img src="images/logo.png" id="logo" >         
                </a>
            </center>   
            <!--Navigation Menu-->
            <center><img src="images/logo.png" id="logo" ></center>

            <ul>
                <li><a href="index.php">الرئيسية </a></li>
                <li><a href="events.php">الفعاليات</a></li>
                <li><a href="includes/CharterofVolunteerism.pdf">ميثاق  التطوع</a></li>
                <li><a class="active" href="Contact_us.php">اتصل بنا</a></li>

            </ul>

        </header>

