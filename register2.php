<?php include('server.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css\style13.css" rel="stylesheet" type="text/css" />

        <style>

            body{
                background-size:cover; 
                background-attachment:fixed; 
            }

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
    <center>
        <div id="form-container" >
            <div id="form-topcontainer">
                <img id="logo-form" src="images/logo.png" alt="logo" width="100" />
                <h2> التسجيل </h2>  /* test comment*/
            </div>
            <center>

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
                <!--Footer of the page -->
                <div class="footer">
                    <footer>             
                        <?php include('includes/footer.php'); ?>
                    </footer>
                </div>
            </center>
        </div>
    </body>

</html>
