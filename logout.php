<!--Log out Page -->
<?php
session_start();// Starting Session
session_destroy(); // Ending Session
header('Location:./index.php');
ob_end_flush();
?>