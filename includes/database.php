<?php
//manage database at http://www.phpmyadmin.co
//Username: sql12229449 , Password: xQDtaEtuwZ
//database name: sql12229449
//Server: sql12.freemysqlhosting.net

$mysqli = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449');

$query = function ($query) use ($mysqli) {
    return mysqli_query($mysqli, $query);
};

$last_insert_id = function () use ($mysqli) {
    return mysqli_insert_id($mysqli);
};

$post = function ($index) use ($mysqli) {
    if ($_POST[$index]) {
        return mysqli_real_escape_string($mysqli, $_POST[$index]);
    }
    return "";
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

