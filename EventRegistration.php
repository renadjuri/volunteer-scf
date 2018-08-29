<?php

$ID = $_POST['id'];
$TaskOption = $_POST['TaskOption'];
if ($_SESSION['admin']!='true' && $_SESSION['id']) {
    $VoluID = $_SESSION['id'];
require 'includes/connection.php'; //connecting to the database
mysqli_set_charset($con, "utf8");

$query = " INSERT INTO `volunteertask`(`EventID`, `VoluID`, `task`)  VALUES ('$ID','$VoluID','$TaskOption')";

mysqli_query($con, $query);
$reg = 'true';

}
else {
    $reg ='false';
    
}

header("location:Details.php?reg='$reg'&EventID='$ID'");
?>