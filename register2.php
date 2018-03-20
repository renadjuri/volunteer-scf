<?php include('server.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <title>تسجيل مستخدم جديد</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css\style1.css" rel="stylesheet" type="text/css"/>
    </head>
    <style>

        input[type=text], input[type=password] ,input[type=email] , input[type=tel] input[type=date] {
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
        <form method="post" action="register2.php" >

            <?php $info = $account->getRow("cancergroup", $_SESSION["userid"]); ?>
            <?php include('errors.php'); ?>
            <table>
                <tr>

                    <td>


                        <?php
                        $gender = $info->gender;
                        if ($gender == "Male") {
                            $male = " selected='true'";
                        }
                        if ($gender == "Female") {
                            $female = " selected='true'";
                        }
                        ?>

                        <input type="radio" name="gender" value="female" checked <?= $female ?>>أنثى<br>
                        <input type="radio" name="gender" value="male"  <?= $male ?>> ذكر<br>
                    </td>
                    <td><b> : الجنس</b></td>
                    </select>
                    </td>
                </tr>


                <tr>
                    <td>
                        <input type="date" name="birthdate" required value="<?= $basic_info->birthdate ?>">
                    </td>
                    <td><b>  : تاريخ الميلاد </b></td>

                </tr><tr>
                    <td>
                        <input type="text" style="text-align:right" name="id" placeholder="1234567899" maxlength="10" required >
                    </td>
                    <td><b> : السجل المدني/الإقامة</b></td>

                </tr>
                <tr>
                    <td>
                        <select name="edu_select">
                            <?php
                            $edu_select = $info->edu_select;
                            if ($edu_select == "Master") {
                                $Master = " selected='true'";
                            }
                            if ($edu_select == "Bachelor") {
                                $Bachelor = " selected='true'";
                            }
                            if ($edu_select == "secondary") {
                                $secondary = " selected='true'";
                            }
                            if ($edu_select == "Other") {
                                $Other = " selected='true'";
                            }
                            ?>
                            <option value="Master" <?= $Master ?>>ماجستير</option>
                            <option value="Bachelor" <?= $Bachelor ?>>بكالوريوس</option>
                            <option value="secondary" <?= $secondary ?> >ثانوي</option>
                            <option value="Other" <?= $Other ?> >أخرى</option>

                        </select>
                    </td>
                    <td><b>  : المؤهل العلمي</b></td>

                </tr>
                <tr>
                    <td>
                        <input style="text-align:right" type="text" name="education" placeholder="التخصص الدراسي" maxlength="20" >
                    </td>
                    <td><b>: المؤهل العلمي</b></td>
                </tr>
                <tr>
                    <td><button type="submit" name="register_btn" formaction="/profile.php">الدخول الى الملف الشخصي </button></td>
                </tr>
            </table>
        </form>
    </body>

</html>
