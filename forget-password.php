<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> 
        <link href="css\style13.css" rel="stylesheet" type="text/css"/>

        <style>

            body{
                background-size:cover;
                background-attachment:fixed;
            }
            p{color: white;}
            h2{color: white;}

        </style>
    </head>
    <body>
        <!--Navigation menu-->
    <center><img src="images/logo.png" id="logo" ></center>

    <ul>
        <li><a href="index.php">الرئيسية </a></li>
        <li><a href="events.php">الفعاليات</a></li>
        <li><a href="includes/CharterofVolunteerism.pdf">ميثاق  التطوع</a></li>
        <li><a class="active" href="Contact_us.php">اتصل بنا</a></li>

    </ul>
    <br>
    <br>
    <center>
        <div id="form-container" >
            <div id="form-topcontainer">
                <img id="logo-form" src="images/logo.png" alt="logo" width="100" />
                <br>
                <br>
                <h2> استعادة كلمة المرور </h2>
            </div>
            <br>
            <br>
            <p> فضلا قم بإدخال بريدك الإلكتروني و سوف يتم إرسال تعليمات كلمة المرور الخاصة بك من خلال البريد الإلكتروني  </p> 
            <form action="/action_page.php">
                <input type="text" name="Email" value=""> البريد الإلكتروني<br>
                <button type="submit">إرسال</button> 
                <br>
            </form>
        </div>   
    </center>
    <!--Footer of the page -->
    <center>
        <div class="footer">
            <footer>             
                <?php include('includes/footer.php'); ?>
            </footer>
        </div>
    </center>
</div>
</body>
</html>