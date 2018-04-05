
<!DOCTYPE html>
<!-- the header of the page-->
<?php
$page_title = "جمعية السرطان السعودي"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
?>
<style>
    .carousel-control.right, .carousel-control.left {
        background-image: none;
        color: #b7a900;
    }

    .carousel-indicators li {
        border-color: #b7a900;
    }

    .carousel-indicators li.active {
        background-color: #b7a900;
    }

    .item span {
        font-style: normal;
    }
    /*contact background*/
    .bg-grey {
        background-color: #f6f6f6;
    }
</style>
</head>

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
        $to = 'example@gmail.com';
        $subject = 'Message from Contact at volunteer system ';

        $body = "From: $name\n E-Mail: $email\n Message:\n $message";


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
            if (mail($to, $subject, $body, $from)) {
                $result = '<div class="alert alert-success">شكرا لتواصلك ،سنقوم بالتواصل معك في أقرب فرصة</div>';
            } else {
                $result = '<div class="alert alert-danger">عذرا حدث خطأ أثناء إرسال رسالتك ، حاول مجددا لاحقاً</div>';
            }
        }
    }
    ?>


    <div class="container-fluid text-center">    
        <div class="row content">

            <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>

                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">

                    <div class="item active">
                        <img src="images/img1.jpg"/>

                    </div>
                    <div class="item">
                        <img src="images/img2.jpg" />

                    </div>

                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">السابق</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">التالي</span>
                </a>
            </div>
        </div>
        <div class="container text-center">    
            <h2>ادارة المتطوعين في جمعية السرطان السعودية</h2>
            <h2>أخبارنا</h2><br>
            <div class="row">
                <div class="col-sm-4">
                    <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
                    <p>نبذة عن التطوع</p>
                </div>
                <div class="col-sm-4"> 
                    <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
                    <p>الإحصائيات</p>    
                </div>
                <div class="col-sm-4">
                    <div class="well">
                        <p>أخبار....</p>
                    </div>
                    <div class="well">
                        <p>أخبار..</p>
                    </div>
                </div>
            </div>
        </div><br>
    </div>
    <!-- Contact form -->

    <div class="container-fluid bg-grey text-right" id="contact">
        <h2 class="text-center">تواصل معنا</h2>
        <div class="row">
             <div class="col-sm-5">
                <h3>تواصل معنا عبر أحد الوسائل التالية</h3>
                <p><span class="glyphicon glyphicon-map-marker pull-right"></span> المملكة العربية السعودية  ,المنطقة الشرقية,الخبر  
                    34427</p>
                <p><span class="glyphicon glyphicon-phone  pull-right"></span>  013 864 7557  </p>
                <p><span class="glyphicon glyphicon-envelope  pull-right"></span> myemail@something.com  </p> 
            </div>
            
            <div class="col-sm-7">

                <form class="form-horizontal" role="form" method="post" action="home.php">
                    <div class="form-group">
<!--  value ="<?php //echo htmlspecialchars($_POST['email']);  ?>"-->
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="text" class="form-control text-right" id="name" name="name"  
                                   placeholder="الأسم الثلاثي" />
                            <div>  <?php echo "<p class='text-danger'>$errName</p>"; ?> </div>
                        </div>

                    </div>
                    <div class="form-group">
<!--  value ="<?php // echo htmlspecialchars($_POST['email']);  ?>"-->
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="email" class="form-control text-right" id="email" name="email" 
                                   placeholder="example@domain.com" />
                            <div> <?php echo "<p class='text-danger'>$errEmail</p>"; ?></div>
                        </div>

                    </div>
                    <div class="form-group">
<!--value=" <?php // echo htmlspecialchars($_POST['message']);  ?>"-->
                        <div class="col-sm-10 col-sm-offset-2">
                            <textarea class="form-control text-right" rows="4" name="message"
                                      placeholder="رسالتك"></textarea>
                            <div> <?php echo "<p class='text-danger'>$errMessage</p>"; ?></div>
                        </div>

                    </div>
                    <div class="form-group">

                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="text" class="form-control text-right" id="human" name="human" placeholder="? = 2 + 3">
                            <?php echo "<p class='text-danger'>$errHuman</p>"; ?>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2 pull-left ">
                            <input id="submit" name="submit" type="submit" value="أرسل" class="btn btn-success">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <?php echo $result; ?>	
                        </div>
                    </div>
                </form> 
            </div> 


           
        </div>
    </div>


    <!-- Add Google Maps -->
    <div id="googleMap" style="height:400px;width:100%;"></div>
    <script>
        function myMap() {
            var myCenter = new google.maps.LatLng(26.2854327, 50.2175179);
            var mapProp = {center: myCenter, zoom: 12, scrollwheel: false, draggable: false, mapTypeId: google.maps.MapTypeId.ROADMAP};
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            var marker = new google.maps.Marker({position: myCenter});
            marker.setMap(map);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlpC7CwBIk2EGwJ3bIDtpFf8ytPzAbggM&callback=myMap"></script>

    <?php include('includes/footer.php'); ?>


