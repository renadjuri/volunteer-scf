<?php

$page_title = "جمعية السرطان السعودية"; //page title to pass it to the header
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
        height: 70%;
    }
    /*contact background*/
    .bg {
        background-color: #e3efe5;
    }
</style>
</head>

<body>


    <!-- Page Header -->
    <header class="masthead" style="background-image: url('images/header-2.png')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>جمعية السرطان السعودية</h1>
                        <span class="subheading">بادر بالتطوع في فعاليات جمعية السرطان السعودية</span>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!--
        <div class="container-fluid text-center">    
            <div class="row content">
    
                <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
                     Indicators 
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
    
                     Wrapper for slides 
                    <div class="carousel-inner" role="listbox">
    
                        <div class="item active">
                            <img src="images/img3.jpg" />
    
                        </div>
                        <div class="item">
                            <img src="images/img2.jpg"  />
    
                        </div>
                        <div class="item">
                            <img src="images/img1.jpg"  />
    
                        </div>
    
                    </div>
    
                     Left and right controls 
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">السابق</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">التالي</span>
                    </a>
                </div>
            </div>-->


    <div class="container text-center">    
        <h2>أخر أخبارنا</h2>
        <center><div class="Rectangle"></div></center>
        <br>
        <div class="row">
            <center>
                <div class="col-md-6 col-md-offset-3">

                    <a class="twitter-timeline" href="https://twitter.com/SaudiCancerF?ref_src=twsrc%5Etfw" data-width="%100"
                    data-height="600">Tweets by SaudiCancerF</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8">
                    </script>

                    <a href="https://twitter.com/intent/tweet?button_hashtag=%D8%AC%D9%85%D8%B9%D9%8A%D8%A9_%D8%A7%D9%84%D8%B3%D8%B1%D8%B7%D8%A7%D9%86&ref_src=twsrc%5Etfw" class="twitter-hashtag-button" data-show-count="false">
                        Tweet #%D8%AC%D9%85%D8%B9%D9%8A%D8%A9_%D8%A7%D9%84%D8%B3%D8%B1%D8%B7%D8%A7%D9%86</a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8">
                    </script>

                </div>
            </center>
        </div>
    </div>
</div>


<div class="container-fluid " >

    <br>
    <div class="row">
        <!-- Add Google Maps -->
        <div id="googleMap" class="col-sm-7">
            <img src="images/googleMap.JPG" alt="location" style="height:350px; width:100%;" />
        </div>
        <div class="col-lg-5 col-offset-2">
            <center>
            <h2>عنواننا</h2>
                <div class="Rectangle" style=" width:30%;"></div>

            </center>
            </br>
            <p><span class="glyphicon glyphicon-map-marker pull-right"></span> المملكة العربية السعودية  ,المنطقة الشرقية,الخبر  
                34427 &ensp;</p>
            <p><span class="glyphicon glyphicon-phone  pull-right"></span>  0505348085 -  0138649887 &ensp;</p>
            <p><span class="glyphicon glyphicon-globe  pull-right"></span> <a href="http://scf.org.sa/"> scf.org.sa  &ensp;</a></p> 
        </div>
    </div></div>

<?php include('includes/footer.php'); ?>


