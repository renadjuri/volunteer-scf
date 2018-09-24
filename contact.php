<?php
$page_title = "تواصل معنا"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
?>
<body>

    <?php
    $name = $email = $message = $human = "";
    $errName = $errEmail = $errMessage = $errHuman = $result = "";
    if (isset($_POST["submit"])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $human = intval($_POST['human']);
        $from = 'Contact Form';
        $to = 'admin@volunteer-scf.org';
        $subject = 'Message from Contact at volunteer system ';
        $headers = 'From: admin@volunteer-scf.org';
        $body = "من: $name\n البريد الإلكتروني: $email\n الرسالة:\n $message";


        // Check if name has been entered
        if (!$_POST['name']) {
            $errName = 'تأكد من تعبئة البيانات المطلوبة';
        }

        // Check if email has been entered and is valid
        if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errEmail = 'البريد الإلكتروني المدخل غير صحيح';
        }

        //Check if message has been entered
        if (!$_POST['message']) {
            $errMessage = 'تأكد من تعبئة البيانات المطلوبة';
        }
        //Check if simple anti-bot test is correct
        if ($human !== 5) {
            $errHuman = 'الإجابة المدخلة غير صحيحة';
        }

// If there are no errors, send the email
        if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
            if (mail($to, $subject, $body, $headers)) {
                $result = '<div class="alert alert-success">شكرا لتواصلك ،سنقوم بالتواصل معك في أقرب فرصة</div>';
            } else {
                $result = '<div class="alert alert-danger">عذرا حدث خطأ أثناء إرسال رسالتك ، حاول مجددا لاحقاً</div>';
            }
        }
    }
    ?>
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('images/contact-bg.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>تواصل معنا</h1>
                        <span class="subheading"> يسعدنا استقبال ملاحظاتكم و إستفساراتكم</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <br>


    <!-- Contact form -->

    <div class="container-fluid bg text-right" id="contact">

        <br>
        <div class="row">


            <div class="col-sm-7">
            <h3>يمكنك تعبئة النموذج التالي و سنقوم بالرد في أقرب وقت </h3>

            <form class="form-horizontal" role="form" method="post" action="contact.php">
                    <div class="form-group">
<!--  value ="<?php //echo htmlspecialchars($_POST['email']);             ?>"-->
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="text" class="form-control text-right" id="name" name="name"  
                                   placeholder="الأسم الثلاثي" tabindex="1" />
                            <div>  <?php echo "<p class='text-danger'>$errName</p>"; ?> </div>
                        </div>

                    </div>
                    <div class="form-group">
<!--  value ="<?php // echo htmlspecialchars($_POST['email']);             ?>"-->
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="email" class="form-control text-right" id="email" name="email" 
                                   placeholder="example@domain.com" tabindex="2"  />
                            <div> <?php echo "<p class='text-danger'>$errEmail</p>"; ?></div>
                        </div>

                    </div>
                    <div class="form-group">
<!--value=" <?php // echo htmlspecialchars($_POST['message']);             ?>"-->
                        <div class="col-sm-10 col-sm-offset-2">
                            <textarea class="form-control text-right" rows="4" name="message"
                                      placeholder="رسالتك" tabindex="3" ></textarea>
                            <div> <?php echo "<p class='text-danger'>$errMessage</p>"; ?></div>
                        </div>

                    </div>
                    <div class="form-group">

                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="text" class="form-control text-right" id="human" tabindex="4" name="human" placeholder="? = 2 + 3">
                            <?php echo "<p class='text-danger'>$errHuman</p>"; ?>
                        </div>

                    </div>
                    <div class="form-group">

                       <div class="col-sm-10  col-sm-offset-2">
                            <input id="submit" name="submit" type="submit" value="أرسل" tabindex="5"
                                   class="btn btn-success" 
                                   ata-toggle="tooltip" data-placement="bottom" title="نسعد بسماع ملاحظاتكم"
                                   >
                        </div>
                    </div>
                    <div class="form-group">
                         <div class="col-sm-10 col-sm-offset-2">
                            <?php echo $result; ?>	
                        </div>
                    </div>
                </form> 
            </div> 
            <div class="col-sm-5 col-offset-2">
                <h3>تواصل معنا عبر أحد الوسائل التالية</h3>
                <p><span class="glyphicon glyphicon-map-marker pull-right"></span> المملكة العربية السعودية  ,المنطقة الشرقية,الخبر  
                    34427 &ensp;</p>
                <p><span class="glyphicon glyphicon-phone  pull-right"></span>  0505348085 -  0138649887 &ensp;</p>
                <p><span class="glyphicon glyphicon-envelope  pull-right"></span> info@scf.org.sa  &ensp;</p> 
            </div>


        </div>
    </div>
    <!--Footer of the page -->

    <?php include('includes/footer.php');
    ?>
     