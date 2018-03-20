<!--Header for all the pages Done by: Renad Juri -->
<!DOCTYPE html>
<html>
    <head><!--page title to pass it to the header-->
        <meta http-equiv="Content-Type" content="text/html;  charset=utf-8" />
        <title>
            <?= isset($page_title) ? $page_title : "جمعية السرطان السعودي" ?>
        </title>
        <script src="js/jquery.min.js"></script>
        <!--Styling some of the elements using external CSS-->
        <link href="css/profile.css" rel="stylesheet" type="text/css"/>
        <link href="css/style1.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="css/style_header.css">
        <link rel="icon" type="image/png" href="images/logo.png"/>
    </head>
    <body>
        <!-- header element creates a header for the page -->
        <header>
            <!--Logo of the TechBay website-->

            <a href="index.php">
                <img class="logo " src="images/logo.png" alt="volunteer Logo">
            </a>
            <!--Navigation Menu-->
            <div class="d">
                <button class="menu"><a href="Contact_us.php">تواصل معنا</a></button>
                <button class="menu"><a href="Laptops.php">التطوع في الجمعية</a></button>
                <button class="menu"><a href="Smartphones.php">ميثاق التطوع</a></button>
                <button class="menu"><a href="index.php">الصفحة الرئيسية</a></button>

            </div>
        </header>

