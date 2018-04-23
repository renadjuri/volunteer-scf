
<!-- footer of the volunteer of scf website -->

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<footer class="container-fluid text-center ">
    <div class="social">

        <a href="https://twitter.com/SaudiCancerF"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a>
        <a href="https://www.snapchat.com/add/saudicancerf/"> <i class="fa fa-snapchat fa-2x" aria-hidden="true"></i></a> 
        <a href="https://www.instagram.com/saudicancerf/"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
    </div>
    <br>
    <p>&copy; جميع الحقوق محفوظة لجمعية السرطان السعودية  2018 <br>
        <a href="http://scf.org.sa" title="قم بزيارة الموقع">scf.org.sa</a>
    </p>



</footer>


<script>
    $(document).ready(function () {
        // Add smooth scrolling to all links in navbar + footer link
        $(".navbar a, footer a[href='#']").on('click', function (event) {
            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "#") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 900, function () {

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });

        $(window).scroll(function () {
            $(".slideanim").each(function () {
                var pos = $(this).offset().top;

                var winTop = $(window).scrollTop();
                if (pos < winTop + 600) {
                    $(this).addClass("slide");
                }
            });
        });
    })
</script>

<!--java script for going to the top of the page-->
<script>
// When the user scrolls down 30px from the top of the document, show the button
    window.onscroll = function () {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
            document.getElementById("myBtn").style.display = "block";
        } else {
            document.getElementById("myBtn").style.display = "none";
        }
    }

// When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</body>
