<?php
$page_title = "تواصل معنا"; //page title to pass it to the header
include("includes/Header2.php"); // the header of the page
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
    <header class="masthead inner" style="background-image: url('images/header-6.jpg')">
		<div class="overlay"></div>
		<div class="container-fluid p-r-l-51 p-t-160 ">
		  <div class="row">
		    <div class="col-lg-12 col-md-12 mx-auto">
		      <div class="">
		        <h2 class="yellow-text">تواصل معنا</h2>
		        <h4 class="subheading white-text">يسعدنا استقبال ملاحظاتكم و استفساراتكم</h4>
		      </div>
		    </div>
		  </div>
		</div>
				    </header>


    <!-- Contact form -->
  <div class="container-fluid p-r-l-51 p-b-50"  id="contact">    
        <div class="row">


            <div class="col-md-4">
																		 <h3 class="sub-heading">اتصل بنا</h3>
																		 <div class="row">
																		 	<div class="col-md-12"><p><span class="glyphicon glyphicon-map-marker pull-left location-icons "></span>المملكة العربية السعودية، المنطقة الشرقية، الخبر، 34427</p></div>
																		 	<div class="col-md-12"> <p><span class="glyphicon glyphicon-phone pull-left location-icons "></span>0505348085 - 0138649887</p>
																		 	</div>
																		 	<div class="col-md-12"> <p><span class="glyphicon glyphicon-envelope pull-left location-icons "></span> <a href="http://scf.org.sa/">info@scf.org.sa</a></p> </div>
																		 </div>
																		 
																		 
                       </div>
			
			            <div class="col-md-8">
																		 <h3 class="sub-heading">اترك رسالة</h3>
									
			            <form class="form-horizontal" role="form" method="post" action="contact.php">
								<div class="row">
								<div class="col-md-6">
			<!--  value ="<?php //echo htmlspecialchars($_POST['email']);             ?>"-->
			                            <input type="text" class="form-control dir-rtl" id="name" name="name"  
			                                   placeholder="الاسم الثلاثي" tabindex="1" />
			                            <div>  <?php echo "<p class='text-danger'>$errName</p>"; ?> </div>
			                        </div>
			
								<div class="col-md-6">
			<!--  value ="<?php // echo htmlspecialchars($_POST['email']);             ?>"-->
			                        
			                            <input type="email" class="form-control dir-rtl" id="email" name="email" 
			                                   placeholder="example@domain.com" tabindex="2"  />
			                            <div> <?php echo "<p class='text-danger'>$errEmail</p>"; ?></div>
			                        </div>
			
								<div class="col-md-12 p-t-20">
			               
			<!--value=" <?php // echo htmlspecialchars($_POST['message']);             ?>"-->
			                            <textarea class="form-control dir-rtl" rows="4" name="message"
			                                      placeholder="رسالتك" tabindex="3" ></textarea>
			                            <div> <?php echo "<p class='text-danger'>$errMessage</p>"; ?></div>
			                    </div>
								<div class="col-md-6 p-t-20">
			
			                            <input type="text" class="form-control dir-rtl" id="human" tabindex="4" name="human" placeholder="? = 2 + 3">
			                            <?php echo "<p class='text-danger'>$errHuman</p>"; ?>
			
			                    </div>
			
								<div class="col-md-3 p-t-22">
			                            <input id="submit" name="submit" type="submit" value="أرسل" tabindex="5"
			                                   class="btn btn-block btn-success" data-toggle="tooltip" data-placement="bottom" title="نسعد بسماع ملاحظاتكم">
			                    </div>
			                    <div class="form-group">
			                         <div class="col-sm-10 col-sm-offset-2">
			                            <?php echo $result; ?>	
			                        </div>
			                    </div>
								</div>
			                </form> 
			            </div> 
			


        </div>
    </div>
    <!--Footer of the page -->

    <?php include('includes/footer.php');
    ?>
     