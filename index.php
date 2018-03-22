<!DOCTYPE html>
<!-- home page of the volunteer managing system -->
<html>
    <head>

        <title>جمعية السرطان السعودية</title><link rel="shortcut icon" href="images/log1.png"></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="css\style13.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
        body{
            background-image:url("images/orange wallpaper.jpg");
            background-size:cover;
            background-attachment:fixed;
        }
         .mySlides {display:none;
        }
    </style>
</head>

<body>

    <!--Navigation menu-->
<center><img src="images/logo.png" id="logo" ></center>

<ul>
    <li><a class="active" href="index.php">الرئيسية </a></li>
    <li><a href="events.php">الفعاليات</a></li>
    <li><a href="includes/CharterofVolunteerism.pdf">ميثاق  التطوع</a></li>
    <li><a href="Contact_us.php">اتصل بنا</a></li>

</ul>


<br>
<br>


<div class="w3-content w3-section" style="max-width:500px">
    <img class="mySlides" src="img.jpg" style="width:100%">
    <img class="mySlides" src="img.jpg" style="width:100%">
    <img class="mySlides" src="img.jpg" style="width:100%">
    <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
    <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
</div>
<div>
    <article class="article">
        <h1>:نبذة عن التطوع</h1>
        نبذة عن التطوع

    </article>
</div>
<br>
<div>
    <article class="article">
        <h1>:الإحصائيات</h1>
        الاحصائيات

    </article>
</div>
<script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {
            myIndex = 1
        }
        x[myIndex - 1].style.display = "block";
        setTimeout(carousel, 5000); // Change image every 2 seconds
    }
</script>
<!--Footer of the page -->
<div class="footer">
    <footer>             
        <?php include('includes\footer.php'); ?>
    </footer>
</div>
</body>
</html>
