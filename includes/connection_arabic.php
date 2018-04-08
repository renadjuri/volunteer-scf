<?php
$con=mysqli_connect('localhost', 'root', '');
if(!$con) die ("failed");

mysqli_select_db($con, 'database');
mysqli_query($con,"set NAMES utf8");

$query = function ($query) use ($con) {
     mysqli_set_charset($con,"utf8");
    return mysqli_query($con, $query);
};

$get_user_data = function ($index, $id = null) use ($query) {
    if ($id == null) {
        $id = $_SESSION['id'];
    }
    if (!is_admin()) {
        $q = $query("select * from account INNER JOIN volunteer ON (account.Username = volunteer.VolunteerUsername) where account.Username = '$id' ");
    } else {
        $q = $query("select * from account INNER JOIN admin ON (account.Username = admin.AdminUsername) where account.Username = '$id' ");
    }
    $row = mysqli_fetch_array($q);
    return $row[$index];
};

function is_login() {
    if (isset($_SESSION['id'])||isset($_SESSION['username'])) {
        return true;
    } else {
        return false;
    }
}
function is_admin() {
    if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
        return true;
    }
    return false;
}
?>
