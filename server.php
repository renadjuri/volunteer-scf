<?php

session_start();
// initializing variables
$FirstName=$MiddleName=$LastName=$MobileNumber=$DateOfBirth=$Gender=$nationality=$residence=$Qualification="";
$errors="";


// connect to the database
$db = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449');
// REGISTER USER
if (isset($_POST['register_btn'])) {
// receive all input values from the form
    $FirstName = mysqli_real_escape_string($db, $_POST['FirstName']);
    $MiddleName = mysqli_real_escape_string($db, $_POST['MiddleName']);
    $LastName = mysqli_real_escape_string($db, $_POST['LastName']);
    $MobileNumber = mysqli_real_escape_string($db, $_POST['MobileNumber']);
    $DateOfBirth = mysqli_real_escape_string($db, $_POST['DateOfBirth']);
    $Gender = mysqli_real_escape_string($db, $_POST['Gender']);
    $nationality = mysqli_real_escape_string($db, $_POST['nationality']);
    $residence = mysqli_real_escape_string($db, $_POST['residence']);
    $Qualification = mysqli_real_escape_string($db, $_POST['Qualification']);
    $Email = mysqli_real_escape_string($db, $_POST['Email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);
    if ($password == $password2) {
        $password = md5($password); //hash password
        mysqli_query($db, $sql);


       
         if (empty($_POST["FirstName"])) {
                $errors = "الرجاء ادخال الاسم بشكل صحيح";
            } else if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["FirstName"])) {
                $errors = "الإسم المدخل غير صحيح";
            }
			
		if (empty($_POST["Email"])) {
                $errors = "الرجاء ادخال البريد الإلكتروني";
            } else if (!filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
                $errors = "البريد الإلكتروني غير صحيح";
            }
			
	    if (empty($_POST["MobileNumber"])) {
                $errors = "الرجاء ادخال رقم الهاتف";
            } else if (!preg_match("/[ 0-9 ]/",$_POST["MobileNumber"])) {
                $errors = "رقم الهاتف المدخل غير صحيح";
            }
			
        if (empty($_POST["password"])) {
                $errors = "الرجاء ادخال كلمة المرور";
            } else if (!preg_match("/[ 0-9 ]/",$_POST["password"])) {
                $errors = "رقم الهاتف المُدخل غير صحيح";
            }
  
  if ($password != $password2) {
	$errors=  "كلمة المرور غير متطابقة";
  }
        if (empty($_POST["VolunteerID"])) {
                $errors = "الرجاء ادخال السجل المدني";
            } else if (!preg_match("/[ 0-9  ]/",$_POST["VolunteerID"])) {
                $errors = "الرقم المدخل غير صحيح";
            }

             if (empty($_POST["Qualification"])) {
                $errors = "الرجاء ادخال المؤهل العلمي";
            } else if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["Qualification"])) {
                $errors = "المؤهل العلمي غير صحيح";
            }
        // first check the database to make sure 
        // a user does not already exist with the same username and/or email
        $user_check_query = "SELECT * FROM Volunteer WHERE Email='$Email' OR MobileNumber='$MobileNumber' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) { // if user exists

            if ($user['Email'] === $Email) {
                $errors= "البريد الإلكتروني موجود مسبقاً";
            }
            if ($user['MobileNumber'] === $MobileNumber) {
                $errors="رقم الهاتف موجود مسبقاً";
            }
        }

        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {
            $password = md5($password); //encrypt the password before saving in the database

            $query = "INSERT INTO Volunteer (FirstName,MiddleName,LastName,MobileNumber,DateOfBirth,Gender,nationality,residence,Qualification)
  			  VALUES('$FirstName','$MiddleName','$LastName','$MobileNumber','$DateOfBirth','$Gender','$nationality','$residence','$Qualification')";
            mysqli_query($db, $query);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "انت مسجل الآن";
        }
    }
}
?>