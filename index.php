
<!DOCTYPE html>
<!-- the header of the page-->
<?php
$page_title = "جمعية السرطان السعودي"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
?>



<style type="text/css">
    body{

    }
    .mySlides {display:none;
    }
</style>
</head>

<body>



    <div class="w3-content w3-section">
        <img class="mySlides" src="images/img1.jpg" style="width:100%">
        <img class="mySlides" src="images/img2.jpg" style="width:100%">
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
<center>
    <div class="footer">
        <footer>             
            <?php include('includes/footer.php'); ?>
        </footer>
    </div>
</center>
</body>
</html>
