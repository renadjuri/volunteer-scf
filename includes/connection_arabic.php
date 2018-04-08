<?php
$con=mysqli_connect('localhost', 'root', '', 'sql12229449');
if(!$con) die ("failed");
mysqli_set_charset($con, 'utf8');
mysqli_select_db($con, 'sql12229449');
mysqli_query($con,"set NAMES utf8");

$query = function ($query) use ($con) {
    return mysqli_query($con, $query);
};



$post = function ($index) use ($con) {
    if ($_POST[$index]) {
        return mysqli_real_escape_string($con, $_POST[$index]);
    }
    return "";
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
    if (isset($_SESSION['id'])) {
        return true;
    } else {
        return false;
    }
}
function is_admin() {
    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true) {
        return true;
    }
    return false;
}
?>
