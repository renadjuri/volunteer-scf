<?php
$con = mysqli_connect('localhost', 'root', '','database')
or die ('Cannot connect to the database.');

mysqli_query($con, 'set NAMES utf8');

/*
  to call the database and use query add those lines to your code :
 * 
 require 'includes\connection.php';
 mysqli_set_charset($con,"utf8");
 
//your query:
$query=""; 
 mysqli_query($con,$query);
 
 *  */
?>