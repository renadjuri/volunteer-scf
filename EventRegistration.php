<?php

$ID = $_POST['id'];
$TaskOption = $_POST['TaskOption'];
$VoluID = '2130008877';

require 'includes/connection.php'; //connecting to the database
mysqli_set_charset($con, "utf8");

$query = " INSERT INTO `volunteertask`(`EventID`, `VoluID`, `task`)  VALUES ('$ID','$VoluID','$TaskOption')";

mysqli_query($con, $query);

header("location:Details.php?reg='true'&EventID='$ID'");
?>