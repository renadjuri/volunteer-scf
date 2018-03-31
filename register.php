<?php include('server.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css\style13.css" rel="stylesheet" type="text/css"/>

        <style>

            body{
                background-size:cover;
                background-attachment:fixed;
            }
            form{border:none;
                 box-shadow: none;}
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
                <h2> تسجيل الدخول </h2>
            </div>
            <form method="post" action="register2.php" >
                <?php include('errors.php'); ?>
                <table>
                    <tr>
                        <td>
                            <input type="text" name="username" class="textInput" placeholder="كما تريده أن يظهر في الشهادة" required >
                        </td>
                        <td><b> : الاسم الثلاثي</b></td>

                    </tr>
                    <tr>
                        <td>
                            <input type="email" name="email" class="textInput" placeholder="user@mail.com" required >
                        </td>
                        <td><b> : البريد الإلكتروني</b></td>

                    </tr><tr>
                        <td>
                            <input type="tel" name="phone" class="textInput" placeholder="0555555555" maxlength="10" required >
                        </td>
                        <td><b>  : رقم الهاتف</b></td>

                    </tr><tr>
                        <td>
                            <input type="password" name="pssword" class="textInput" placeholder="**********" maxlength="20" required >
                        </td>
                        <td><b> : كلمة المرور</b></td>

                    </tr>
                    <tr>
                        <td>
                            <input type="password" name="pssword2" class="textInput" placeholder="**********" maxlength="20" required >
                        </td>
                        <td><b> : إعادة كلمة المرور</b></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="includes/CharterofVolunteerism.pdf"><b>أقر أني اطلعت على ميثاق التطوع</b></a>
                            <input type="checkbox" name="check" value="ok"required>
                        </td>
                    <br>
                    </tr>

                    <tr>
                        <td>
                            <a href="includes/Terms_and_Conditions.pdf"><b>أتعهد بالإلتزام بشروط و أحكام التطوع في الجمعية السعودية للسرطان</b></a>
                            <input type="checkbox" name="check2" value="ok2"required><form action="/action_page.php">
                        </td>
                    </tr>

                    <tr>
                        <td><button type="submit" name="register_btn"  >اكمال التسجيل </button></td>
                    </tr>

                </table>
            </form>
    </center>
    <br>
    <br>

    <!--Footer of the page -->
    <div class="footer">
        <footer>             
            <?php include('includes/footer.php'); ?>
        </footer>
    </div>

</center>
</body>
</html>
