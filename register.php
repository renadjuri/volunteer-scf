<!DOCTYPE html>
<?php
$page_title = "تسجيل مستخدم جديد"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
include('server.php')
?>

        <style>

            body{
                background-size:cover;
                background-attachment:fixed;
            }
            #form-container {

                width: 600px;
                height: 700px;}
            #form-topcontainer {
                width: 590px;}
            </style>
     
        <body>
        
    <br>
    <center>
        <div id="form-container" >
            <div id="form-topcontainer">
                <h1> تسجيل مستخدم جديد </h1>
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
                            <a href="includes/CharterofVolunteerism.pdf"><b>أقر أني اطلعت على ميثاق التطوع</b>
                                <input type="checkbox" name="check" value="ok"required>
                            </a>
                        </td>
                    <br>
                    </tr>
                    <tr>
                        <td>
                            <a href="includes/Terms_and_Conditions.pdf"><b>أتعهد بالإلتزام بشروط و أحكام التطوع في الجمعية السعودية للسرطان</b>
                                <input type="checkbox" name="check2" value="ok2"required>
                               <!-- <form action="/action_page.php">-->
                            </a>
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
    <center>
        <div class="footer">
            <footer>             
                <?php include('includes/footer.php'); ?>
            </footer>
        </div>
    </center>
</center>
</body>
</html>
