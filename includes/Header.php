<!DOCTYPE html>
<html>
    <head>
        <!--page title to pass it to the header-->

        <title>
            <?= isset($page_title) ? $page_title : "جمعية السرطان السعودي" ?>
        </title>
        <link rel="shortcut icon" href="images/logo1.png"></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> 
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="css\style13.css" rel="stylesheet" type="text/css" />

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
        <ul>
            <li><a href="index.php">الرئيسية </a></li>
            <li><a href="events.php">الفعاليات</a></li>
            <li><a href="includes/CharterofVolunteerism.pdf">ميثاق  التطوع</a></li>
            <li><a href="Contact_us.php">اتصل بنا</a></li>

        </ul>
        <br>



