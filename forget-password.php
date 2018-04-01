<!DOCTYPE html>
<!-- the header of the page-->
<?php
$page_title = " إستعادة كلمة المرور"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
?>

<style>

    body{
        background-size:cover;
        background-attachment:fixed;
    }
    p{color: white;}

    #form-container {

        width: 500px;
        height: 400px;}

</style>

<body>
   
<br>
<center>
    <div id="form-container" >
        <div id="form-topcontainer">
         
            <h1> استعادة كلمة المرور </h1>
        </div>
        <br>
        <br>
        <p> فضلا قم بإدخال بريدك الإلكتروني و سوف يتم إرسال تعليمات كلمة المرور الخاصة بك من خلال البريد الإلكتروني  </p> 
        <form action="/action_page.php">
            <input type="text" name="Email" value=""> البريد الإلكتروني<br>
            <button type="submit">إرسال</button> 
            <br>
        </form>
    </div>   
</center>
<!--Footer of the page -->
<center>
    <div class="footer">
        <footer>             
            <?php include('includes/footer.php'); ?>
        </footer>
    </div>
</center>
</div>
</body>
</html>