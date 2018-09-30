<?php
session_start();
$eventID = $_POST['id'];
$TaskOption = $_POST['TaskOption'];
//$regbef ='false';
if (!isset($_SESSION['admin']) && isset($_SESSION['id'])) { // Kh changed this $_SESSION['admin']!='true'
    $VoluID = $_SESSION['id'];
require 'includes/connection.php'; //connecting to the database
mysqli_set_charset($con, "utf8");
//$query1="select Vounteer_ID from volunteerregisterinevent where Event_ID='".$eventID."' and Vounteer_ID='".$VoluID."'";
//
//$result = mysqli_query($con, $query1);
//$rownum = mysqli_num_rows($result);
//if ($rownum == 0){
$query2 = "INSERT INTO volunteerregisterinevent(Event_ID, Vounteer_ID, Task)  VALUES ('".$eventID."','".$VoluID."','".$TaskOption."')";
mysqli_query($con, $query2);
//}else{
//    $regbef='true';
//}

$reg = 'true';
}
else {
    $reg ='false';
    
}

header("location:Details.php?reg=$reg&EventID=$eventID");
?>