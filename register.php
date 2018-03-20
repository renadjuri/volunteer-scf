<?php include('server.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <title>تسجيل مستخدم جديد</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css\style1.css" rel="stylesheet" type="text/css"/>
    </head>
    <style>

        input[type=text], input[type=password] ,input[type=email] , input[type=tel] {
            width: 50%;
            padding: 10px 10px;
            margin: 4px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            style:center;
        }
        
        /* The "Forgot password" text */
        span.pssword {
            float: center;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
        }
    </style>
    <body>
        <div class="header">
            <h2>تسجيل مستخدم جديد</h2>
        </div>
        <form method="post" action="register.php" >
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
                    </td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <br>
                </tr>
                <tr>
                    <td>
                        <a href="includes/Terms_and_Conditions.pdf"><b>أتعهد بالإلتزام بشروط و أحكام التطوع في الجمعية السعودية للسرطان</b></a>
                        <input type="checkbox" name="check2" value="ok2"required><form action="/action_page.php">
                    </td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </tr>
                <tr>
                    <td><button type="submit" name="register_btn" formaction="/register2.php" >اكمال التسجيل </button></td>
                </tr>
            </table>
        </form>
    </body>

</html>
