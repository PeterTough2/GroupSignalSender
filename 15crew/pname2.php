<?php
require_once "../includes/main.php";
ajaxauthsuperuser();
$name = NAME;
$ID   = ID;

if (!isset($_POST)) {
    $msg = "Error, Try Again.";
    echo "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important; opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />$msg</div>";
    exit;
}
if ((empty($_POST['name']))) {
    $msg = "Please fill out all fields";
    echo "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important; opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />$msg</div>";
    exit;
}

$name = strip_tags($_POST['name']);
if (!get_magic_quotes_gpc) {
    $name = addslashes($name);
}
//mysqli escape
$name   = mysqli_real_escape_string($conn, $name);
$update = mysqli_query($conn, "UPDATE cm_superuser SET name = '$name' WHERE id = '$ID' LIMIT 1");
$num    = mysqli_affected_rows($conn);
if ($num == 0) {
    $errmsg = mysqli_error($conn);
    $msg    = "Error, Saving Name";
    echo "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important; opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />$msg</div>";
    exit;
}
if ($num == 1) {
    $msg = "Name Updated Successfully.";
    echo "<div id='gorepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/goodfb.png' id='acticon' />$msg</div>";
    exit;
}

?>