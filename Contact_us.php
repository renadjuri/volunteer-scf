<!DOCTYPE html>
<html>
<head>
    <title>تواصل معنا</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> 
    <link href="css\style13.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.min.js"></script>

    <style>
        body{
            background-image:url("images/orange wallpaper.jpg");
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
    <li><a class="active" href="Contact_us.php">اتصل بنا</a></li>

</ul>


<br>
<br>
<p> .يسعدنا استقبال ملاحظاتكم و إستفساراتكم
    <br>.تواصل معنا من خلال أي من وسائل التواصل التالي
</p><br>
<!--Contact Us Via PHONE with phone icon-->
<h3>الهاتف</h3><img class ="icon" src="images\phone.jpg" alt="phone" height="40px" width="40px"> <p>(013) 888-1004<br>
    الأحد - الخميس<br>
    من 9:00ص الى 4:00 م </p>
<!--Contact Us Via EMAIL with email icon-->
<h3>البريد الإلكتروني</h3><img class ="icon" src="images\mail.png" alt="email" height="40px" width="40px"> <p><a href="mailto:renadjuri@gmail.com">renadjuri@gmail.com</a></p>
<!--Contact Us Via ADDRESS with location icon-->
<img class ="icon" src="images\Map.png" alt="address" style="height:40px; width:40px"><h3>العنوان</h3>
<p> شارع الملك عبد العزيز<br>
    الظهران <br>
    المملكة العربية السعودية
</p>
 <!--google map code -->
            <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
            <div style='overflow:hidden;height:440px;width:700px;'>
                <div id='gmap_canvas' style='height:400px;width:600px; margin-left:12px; border:2px solid black; '></div>
                <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
            </div>
            <script type='text/javascript'>
                function init_map() {
                    var myOptions = {zoom: 10, center: new google.maps.LatLng(26.456816, 50.109059),
                        mapTypeId: google.maps.MapTypeId.ROADMAP};
                    map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                    marker = new google.maps.Marker({map: map, position: new google.maps.LatLng(26.456816, 50.109059)});
                    infowindow = new google.maps.InfoWindow({content: '<strong>جمعية السرطان السعودية</strong><br>King Abdullah Bin Abdulaziz Road, Dammam 32413, Saudi Arabia<br>'});
                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.open(map, marker);
                    });
                    infowindow.open(map, marker);
                }
                google.maps.event.addDomListener(window, 'load', init_map);
            </script>
<!--Footer of the page -->

<div class="footer">
    <footer>             
        <?php include('includes\footer.php'); ?>
    </footer>
</div>
</body>
</html>
