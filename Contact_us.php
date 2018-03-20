<!DOCTYPE html>

<!-- the header of the page-->
<?php
$page_title = "تواصل معنا"; //page title to pass it to the header
include("includes\Header.php"); // the header of the page
?>
<!--Style for the page-->
<link href="css\style1.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
    h3	      { padding-right:80px;}
    p	      { color: #7B7B7B; 
              padding-right:80px;
              font-family: arial, sans-serif;}
    .pad      {padding-right:25px;}
    p a       {color:#7B7B7B; 
               padding-right:2px;
               font-family: arial, sans-serif;
               font-size:13pt;
               text-decoration:none;}
    p a:hover {color:dodgerblue; }
    .icon     {float:right;
               margin-right: 5px;
               position: relative;
               top: -43px;
               right:-20px;}
    #gmap_canvas img{max-width:none!important;background:none!important}
    .content{   height:800px;}
    .footer {margin-top:150px; }
</style>
<!--heading and the background-->
<body background="images\background.png">
    <div class="body"> 
        <div class="title">
            <h1>تواصل معنا</h1>

        </div>
        <!--Main Content-->
        <div class="content">             
            <p class="pad"> .يسعدنا استقبال ملاحظاتكم و إستفساراتكم
                <br>.تواصل معنا من خلال أي من وسائل التواصل التالية
            </p><br>
            <!--Contact Us Via PHONE with phone icon-->
            <h3>الهاتف</h3>
            <img class ="icon" src="images\phone.jpg" alt="phone" height="40px" width="40px">
            <p>(013) 888-1004<br>
                الأحد - الخميس<br>
                من 9:00ص الى 4:00 م </p>
            <!--Contact Us Via EMAIL with email icon-->
            <h3>البريد الإلكتروني</h3>
            <img class ="icon" src="images\mail.png" alt="email" height="40px" width="40px">
            <p><a href="mailto:renadjuri@gmail.com">renadjuri@gmail.com</a></p>
            <!--Contact Us Via ADDRESS with location icon-->
            <h3>العنوان</h3>
            <img class ="icon" src="images\Map.png" alt="address" style="height:40px; width:40px">
            <p> شارع الملك عبد العزيز<br>
                الظهران <br>
                المملكة العربية السعودية
            </p>
            <!--google map code -->
            <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
            <div style='overflow:hidden;height:440px;width:700px;'>
                <div id='gmap_canvas' style='height:400px;width:600px; margin-right:12px; border:2px solid black; '></div>
                <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
            </div>
            <script type='text/javascript'>
                function init_map() {
                    var myOptions = {zoom: 10, center: new google.maps.LatLng(26.456816, 50.109059),
                        mapTypeId: google.maps.MapTypeId.ROADMAP};
                    map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                    marker = new google.maps.Marker({map: map, position: new google.maps.LatLng(26.456816, 50.109059)});
                    infowindow = new google.maps.InfoWindow({content: '<strong>جمعية السرطان السعودي</strong><br>King Abdullah Bin Abdulaziz Road, Dammam 32413, Saudi Arabia<br>'});
                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.open(map, marker);
                    });
                    infowindow.open(map, marker);
                }
                google.maps.event.addDomListener(window, 'load', init_map);
            </script>
        </div>
        <!--Footer of the page -->
        <div class="footer">
            <footer>             
                <?php include('includes\footer.php'); ?>
            </footer>
        </div>
    </div>
</body>
</html>
