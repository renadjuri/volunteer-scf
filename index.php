<!DOCTYPE html>
<!-- home page of the volunteer managing system -->
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html;  charset=utf-8" />

    <head>
        <title>الصفحة الرئيسية</title>
        <style>

            .article {
                text-align: right;
                padding : 7px;
                border: 2px solid;
                box-shadow: 3px 5px;
                max-width:500px

            }
        </style>
    </head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .mySlides {display:none;}
    </style>
    <body>

        <?php
        // put your code here
        ?>

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

    </body>
</html>
