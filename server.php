<?php

session_start();

// initializing variables
$username = "";
$email = "";
$phone = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'cancergroup');

// REGISTER USER
if (isset($_POST['register_btn'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $education = mysqli_real_escape_string($db, $_POST['education']);
    if ($password == $password2) {
        $password = md5($password); //hash password
        $sql = "INSERT INTO account(username,email , phone, password, id,education)
		VALUES('$username','$email','$phone','$password','$id',;$education')";
        mysql_query($db, $sql);


        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($username)) {
            array_push($errors, "يتطلب إدخال الاسم");
        }
        if (empty($email)) {
            array_push($errors, "الرجاء ادخال البريد الإلكتروني");
        }
        if (empty($phone)) {
            array_push($errors, "الرجاء اخال رقم الهاتف");
        }
        if (empty($password)) {
            array_push($errors, "الرجاء ادخال كلمة المرور");
        }
        if ($password != $password2) {
            array_push($errors, "كلمة المرور غير متطابقة");
        }

        // first check the database to make sure 
        // a user does not already exist with the same username and/or email
        $user_check_query = "SELECT * FROM account WHERE username='$username' OR email='$email' OR phone='$phone' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) { // if user exists
            if ($user['username'] === $username) {
                array_push($errors, "الاسم موجود مسبقاً");
            }

            if ($user['email'] === $email) {
                array_push($errors, "البريد الإلكتروني موجود مسبقاً");
            }
            if ($user['phone'] === $phone) {
                array_push($errors, "رقم الهاتف موجود مسبقاً");
            }
        }

        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {
            $password = md5($password); //encrypt the password before saving in the database

            $query = "INSERT INTO account (username, email,phone, password, id,education) 
  			  VALUES('$username', '$email', 'phone','$password','$id','$education')";
            mysqli_query($db, $query);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "انت مسجل الآن";
        }
    }

// LOGIN USER
    if (isset($_POST['login_user']))//هنا اسم البوتن اللي في اللوق ان {
        $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);


    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM account WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
        } else {
            array_push($errors, "اسم المستخدم او كلمة المرور خاطئة");
        }
    }
}
?>