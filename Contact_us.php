<!DOCTYPE html>
<html>
    <head>
        <title>تواصل معنا</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> 
        <link href="css\style13.css" rel="stylesheet" type="text/css" />

        <style>
            .error {color: #FF0000;}
            /*tooltip to help the user to enter valid input*/
            .a {font-size: 14pt;
                color: grey;
            }
            body{
              
                background-size:cover;
                background-attachment:fixed;
            }
            form {
                border: none;
                
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
        <li><a class="active" href="Contact_us.php">اتصل بنا</a></li>

    </ul>


    <br>
    <br>



    <?php
    //Initializing empty php variables for the fields and error messages
    $first_name = $last_name = $email_from = $telephone = $comments = "";

    $EmailErr = $FnameErr = $LnameErr = $telephoneErr = $messageErr = "";
    //Check form method is post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Setting php variables
        $first_name = $_POST['first_name']; // required
        $last_name = $_POST['last_name']; // required
        $email_from = $_POST['email']; // required
        $telephone = $_POST['telephone']; // not required
        $message = $_POST['comments']; // required
        //Check if all fields are empty if true show error message 
        if (empty($_POST["first_name"]) && empty($_POST["last_name"]) && empty($_POST["email"]) &&
                empty($_POST["comments"])) {
            echo "<p class='error'>
						تأكد من تعبئة البيانات المطلوبة بالشكل الصحيح	
						 </p>";
        } else {
            //Email validation  
            if (empty($_POST["email"])) {
                $EmailErr = "تأكد من تعبئة البيانات المطلوبة.";
            } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $EmailErr = "البريد الإلكتروني غير صحيح";
            }
            //First Name validation 
            if (empty($_POST["first_name"])) {
                $FnameErr = "تأكد من تعبئة البيانات المطلوبة.";
            } else if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["first_name"])) {
                $FnameErr = "الإسم المدخل غير صحيح";
            }
            //Last Name validation 
            if (empty($_POST["last_name"])) {
                $LnameErr = "تأكد من تعبئة البيانات المطلوبة.";
            }

            if (!empty($_POST["last_name"])) {
                if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["last_name"])) {
                    $LnameErr = "الإسم الاخير المدخل غير صحيح";
                }
            }

            //message Validation 
            if (empty($_POST["comments"])) {
                $messageErr = "تأكد من تعبئة البيانات المطلوبة";
            }
        } if (!empty($_POST["first_name"]) && !empty($_POST["last_name"]) && !empty($_POST["email"]) &&
                !empty($_POST["comments"])) {
            if (isset($_POST['email'])) {


                // EDIT THE 2 LINES BELOW AS REQUIRED
                $email_to = "renadjuri@gmail.com";
                $email_subject = "صفحة التواصل في موقع ادارة المتطوعين لجكعية السرطان السعودية";
                $email_message = "رسالة تواصل من:\n\n";

                function clean_string($string) {
                    $bad = array("content-type", "bcc:", "to:", "cc:", "href");
                    return str_replace($bad, "", $string);
                }

                $email_message .= "الأسم الأول " . clean_string($first_name) . "\n";
                $email_message .= "الأسم الأخير " . clean_string($last_name) . "\n";
                $email_message .= "البريد الإلكتروني" . clean_string($email_from) . "\n";
                $email_message .= "رقم الهاتف" . clean_string($telephone) . "\n";
                $email_message .= "الرسالة:" . clean_string($comments) . "\n";
                $email_message .= "-- " . "\n" . "هذه الرسالة مرسلة من قسم التواصل" . "\n" . "موقع ادارة المتطوعين في جمعية السرطان السعودية" . "\n" . "(http://scf.org.sa/volunteer)" . "\n";



// create email headers
                $headers = 'From: ' . $email_from . "\r\n" .
                        'Reply-To: ' . $email_from . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                @mail($email_to, $email_subject, $email_message, $headers);

                echo "<p class='error'>
						شكرا لتواصلك معنا
						 </p>";
            }
        }
    }
    ?>

    <form name="contactform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <table width = "450px">
            <tr><!--Contact Us Via PHONE with phone icon-->
                <td>
                    <p> رقم الهاتف : 
                        (013) 888-1004 <img  src="images\phone.png" alt="phone" height="30px" width="30px">
                        <br>

                        <!--Contact Us Via EMAIL with email icon-->

                    <p>
                        <a class="a" href="mailto:volunteer@scf.org.sa">volunteer@scf.org.sa</a>
                        بريدنا الإلكتروني
                        <img  src="images\mail.png" alt="phone" height="30px" width="30px"> 
                    </p>
                    <!--Contact Us Via ADDRESS with location icon-->

            </tr>
            <tr>
            <label style = "color:red"> * مطلوب </label>
            </tr>
            <tr>

                <td valign = "top">
                    <input type = "text" name = "first_name" maxlength = "50" size = "30">
                </td>
                <td valign = "top">

                    <label for = "first_name"><label style = "color:red"> * </label> الأسم الأول </label>
                </td>
            </tr>
            <tr>
                <td class="error">
                    <?php
                    //If error is set show it 
                    if (!empty($FnameErr)) {
                        echo $FnameErr;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td valign = "top">
                    <input type = "text" name = "last_name" maxlength = "50" size = "30">
                </td>
                <td valign = "top">

                    <label for = "last_name"><label style = "color:red"> * </label> الأسم الأخير </label>
                </td>

            </tr>
            <tr>
                <td class="error">
                    <?php
                    //If error is set show it 
                    if (!empty($LnameErr)) {
                        echo $LnameErr;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td valign = "top">
                    <input type = "text" name = "email" maxlength = "80" size = "30">
                </td>
                <td valign = "top">

                    <label for = "email"><label style = "color:red"> * </label> البريد الإلكتروني </label>
                </td>
            </tr>
            <tr>
                <td class="error">
                    <?php
                    //If error is set show it 
                    if (!empty($EmailErr)) {
                        echo $EmailErr;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td valign = "top">
                    <input type = "text" name = "telephone" maxlength = "30" size = "30">
                </td>
                <td valign = "top">

                    <label for = "telephone"> رقم الهاتف</label>
                </td>
            </tr>
            <tr>
                <td class="error">
                    <?php
                    //If error is set show it 
                    if (!empty($telephoneErr)) {
                        echo $telephoneErr;
                    }
                    ?>
                </td>

            </tr>
            <tr>
                <td valign = "top">
                    <textarea name = "comments" maxlength = "1000" cols = "80" rows = "10"></textarea>
                </td>
                <td valign = "top">
                    <label for = "comments"><label style = "color:red"> * </label> رسالتك </label>
                </td>
            </tr>
            <tr>
                <td class="error">
                    <?php
                    //If error is set show it 
                    if (!empty($messageErr)) {
                        echo $messageErr;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan = "1" style = "text-align:center">
                    <input type = "submit" value = "أرسل">
                </td>
            </tr>
        </table>
    </form>
    <!--Footer of the page -->

    <div class="footer">
        <footer>             
            <?php include('includes\footer.php'); ?>
        </footer>
    </div>
</body>
</html>