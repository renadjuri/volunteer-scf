<?php
ob_start();
session_start(); // Starting Session
include("includes/database.php");
if ($_POST) {
    $username = $post("username");
    $password = $post("password");
    if (empty($username) || empty($password)) {
        //$msg = "Username or Password is empty";
        $msg = "empty";
    } else {
        $account = $query("select * from account where password='$password' AND username='$username'");
        $row = mysqli_fetch_array($account);
        if ($row) {
            $_SESSION['id'] = $row['ID'];
            $_SESSION['is_admin'] = $row['is_admin'] == 1;
            $id = $_SESSION['id'];
            setcookie('id', $id);

        // if is_admin == 1 return true else return false
            $msg = "login";
        } else {
        //$msg = "Username or Password is invalid";
            $msg = "invalid";
        }
    }
    echo $msg;
}
ob_end_flush();
?>