
<!DOCTYPE html>
<!-- the header of the page-->
<?php
$page_title = "جمعية السرطان السعودي"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
?>
<style>
    .carousel-control.right, .carousel-control.left {
        background-image: none;
        color: #8db792;
    }

    .carousel-indicators li {
        border-color: #8db792;
    }

    .carousel-indicators li.active {
        background-color: #8db792;
    }

    .item {
        width:100%;
        height: 500px;
    }
    /*contact background*/
    .bg {
        background-color: #e3efe5;
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
                        <img src="https://placehold.it/150x80?text=IMAGE" />

                    </div>
                    <div class="item">
                        <img src="https://placehold.it/150x80?text=IMAGE"  />

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
            <center><div class="Rectangle"></div></center>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
                    <p>نبذة عن التطوع</p>
                </div>
                <div class="col-sm-6"> 
                    <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
                    <p>الإحصائيات</p>    
                </div>

            </div>
        </div><br>


        <div class="container text-center">    
            <h2>أخر أخبارنا</h2>
            <center><div class="Rectangle"></div></center>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <div class="well">
                        <blockquote class="twitter-tweet"><p lang="ar" dir="rtl">نظمت <a href="https://twitter.com/hashtag/%D8%AC%D9%85%D8%B9%D9%8A%D8%A9_%D8%A7%D9%84%D8%B3%D8%B1%D8%B7%D8%A7%D9%86?src=hash&amp;ref_src=twsrc%5Etfw">#جمعية_السرطان</a> مساء اليوم الحفل الخيري النسائي
                                <a href="https://twitter.com/hashtag/saudi_fashion_day?src=hash&amp;ref_src=twsrc%5Etfw">
                                    #saudi_fashion_day</a><a href="https://twitter.com/hashtag/%D9%8A%D9%88%D9%85_%D8%A7%D9%84%D9%85%D9%88%D8%B6%D8%A9_%D8%A7%D9%84%D8%B3%D8%B9%D9%88%D8%AF%D9%8A?src=hash&amp;ref_src=twsrc%5Etfw">#يوم_الموضة_السعودي</a> بفندق 
                                <a href="https://twitter.com/hashtag/%D9%83%D9%85%D8%A8%D9%86%D8%B3%D9%83%D9%8A_%D8%A7%D9%84%D8%B9%D8%AB%D9%85%D8%A7%D9%86?src=hash&amp;ref_src=twsrc%5Etfw">#كمبنسكي_العثمان</a> <br>بالتعاون مع نخبة من المصممات السعوديات بحضور العديد من سيدات الأعمال والمجتمع <a href="https://t.co/kXv8dSMGkA">pic.twitter.com/kXv8dSMGkA</a></p>&mdash; جمعية السرطان (@SaudiCancerF) 
                            <a href="https://twitter.com/SaudiCancerF/status/980189318311530496?ref_src=twsrc%5Etfw">March 31, 2018</a>
                        </blockquote> 
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                      <a href="https://twitter.com/intent/tweet?button_hashtag=%D8%AC%D9%85%D8%B9%D9%8A%D8%A9_%D8%A7%D9%84%D8%B3%D8%B1%D8%B7%D8%A7%D9%86&ref_src=twsrc%5Etfw" class="twitter-hashtag-button" data-show-count="false">
                        Tweet #%D8%AC%D9%85%D8%B9%D9%8A%D8%A9_%D8%A7%D9%84%D8%B3%D8%B1%D8%B7%D8%A7%D9%86</a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8">
                    </script>
                </div>
                <div class="col-sm-6"> 
                    <div class="well">
                        <blockquote class="twitter-tweet"><p lang="ar" dir="rtl">اطلقت 
                                <a href="https://twitter.com/hashtag/%D8%AC%D9%85%D8%B9%D9%8A%D8%A9_%D8%A7%D9%84%D8%B3%D8%B1%D8%B7%D8%A7%D9%86?src=hash&amp;ref_src=twsrc%5Etfw">#جمعية_السرطان</a> أول نادي لأطباء
                                <a href="https://twitter.com/hashtag/%D8%A7%D9%84%D8%A3%D9%88%D8%B1%D8%A7%D9%85?src=hash&amp;ref_src=twsrc%5Etfw">#الأورام</a> بالمنطقة
                                <a href="https://twitter.com/hashtag/%D8%A7%D9%84%D8%B4%D8%B1%D9%82%D9%8A%D8%A9?src=hash&amp;ref_src=twsrc%5Etfw">#الشرقية</a> مساء أمس بحضور أكثر من ٦٠ طبيبا واستشاريا بهذا المجال من مراكز ومستشفيات المنطقة<br>وتناول اللقاء أبرز المستجدات في طب الأورام وسرطان المعده <a href="https://t.co/VIofBuIsaJ">pic.twitter.com/VIofBuIsaJ</a></p>&mdash; جمعية السرطان (@SaudiCancerF) <a href="https://twitter.com/SaudiCancerF/status/976473628177989632?ref_src=twsrc%5Etfw">March 21, 2018</a>
                        </blockquote> 
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>

                  
                </div>
            </div>
        </div>
    </div>
    <!-- Contact form -->

    <div class="container-fluid bg text-right" id="contact">
        <h2 class="text-center">تواصل معنا</h2>
        <center><div class="Rectangle"></div></center>
        <br>
        <div class="row">
            <div class="col-sm-5">
                <h3>تواصل معنا عبر أحد الوسائل التالية</h3>
                <p><span class="glyphicon glyphicon-map-marker pull-right"></span> المملكة العربية السعودية  ,المنطقة الشرقية,الخبر  
                    34427 &ensp;</p>
                <p><span class="glyphicon glyphicon-phone  pull-right"></span>  0505348085 -  0138649887 &ensp;</p>
                <p><span class="glyphicon glyphicon-envelope  pull-right"></span> info@scf.org.sa  &ensp;</p> 
            </div>

            <div class="col-sm-7">

                <form class="form-horizontal" role="form" method="post" action="index.php">
                    <div class="form-group">
<!--  value ="<?php //echo htmlspecialchars($_POST['email']);     ?>"-->
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="text" class="form-control text-right" id="name" name="name"  
                                   placeholder="الأسم الثلاثي" tabindex="1" />
                            <div>  <?php echo "<p class='text-danger'>$errName</p>"; ?> </div>
                        </div>

                    </div>
                    <div class="form-group">
<!--  value ="<?php // echo htmlspecialchars($_POST['email']);     ?>"-->
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="email" class="form-control text-right" id="email" name="email" 
                                   placeholder="example@domain.com" tabindex="2"  />
                            <div> <?php echo "<p class='text-danger'>$errEmail</p>"; ?></div>
                        </div>

                    </div>
                    <div class="form-group">
<!--value=" <?php // echo htmlspecialchars($_POST['message']);     ?>"-->
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

                        <div class="col-sm-10 col-sm-offset-2">
                            <input id="submit" name="submit" type="submit" value="أرسل" tabindex="5"
                                   class="btn btn-success" style="background-color:#709675;" 
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


