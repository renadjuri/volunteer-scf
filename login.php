<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css\style13.css" rel="stylesheet" type="text/css"/>

        <style>

            body{
                background-image:url("images/orange hand wallpaper.jpg");
                background-size:cover;
                background-attachment:fixed;
            }
            a{color:white;}

        </style>
    </head>
    <body>
        <!--Navigation menu-->
    <center><img src="images/logo.png" id="logo" ></center>

    <ul>
        <li><a href="index.php">الرئيسية </a></li>
        <li><a href="events.php">الفعاليات</a></li>
        <li><a href="includes/CharterofVolunteerism.pdf">ميثاق  التطوع</a></li>
        <li><a href="Contact_us.php">اتصل بنا</a></li>

    </ul>


    <br>
    <br>

    <center>
        <div id="form-container" >
            <div id="form-topcontainer">
                <img id="logo-form" src="images/logo.png" alt="logo" width="100"/>
                <h2> التسجيل </h2>
            </div>
            <center>
                <form action="/action_page.php">
                    <br><br>

                    <input style="text-align:center" type="text" placeholder="الرجاء ادخال اسم المستخدم" name="uname" required>
                    <label for="uname"><b>اسم المستخدم</b></label>
                    <br>
                    <input style="text-align:center" type="password" placeholder="الرجاء ادخال كلمة المرور" name="psw" required >
                    <label for="psw"><b>كلمة المرور</b></label>
                    <br>
                    <label>
                        <input type="checkbox" checked="checked" name="remember">  تذكرني
                    </label>
                    <button type="submit">تسجيل الدخول</button>

                    <br><br>
                    <label>  ليست لديك عضوية؟ </label>
                    <a href="register.php">سجل الآن</a>

                    <br>
                    <span class="psw"> <a href="forget-password.php">نسيت كلمة المرور</a>

                    </span>   
                    <br>
                    <br>
                </form>
        </div>
    </center>
    <!--Footer of the page -->
    <div class="footer">
        <footer>             
            <?php include('includes\footer.php'); ?>
        </footer>
    </div>
</body>
</html>
