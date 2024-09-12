<?php
require_once "../includes/main.php";
authsuperuser();
$ID = ID;
$name = NAME;

$bad_request_lang = "Bad Request.";
$alert1 = "Please fill out all fields";
$alert2 = "Please enter a valid email address";
$alert4 = "Error creating channel";
$alert8 = "Channel created successfully";

if (!isset($_POST)) {
	$msg = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />$bad_request_lang</div>";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}

if (empty($_POST['channel_name'])) {
	$msg = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />$alert1</div>";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}

$channel_name = mysqli_real_escape_string($conn, strip_tags($_POST['channel_name']));

$SQLi = mysqli_query($conn, "INSERT INTO cm_channel (channel_name, created, updated, link_status) VALUES ('$channel_name', '$SERVERTIME', '$SERVERTIME' 'inactive')");

if (!$SQLi) {
	$error = mysqli_error($conn);
	$msg = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />$alert4 ($error)</div>";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}
if ($SQLi) {
	$conn_id = mysqli_insert_id($conn);
	$msg = "<div id='gorepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/goodfb.png' id='acticon' />$alert8</div>";
    echo json_encode(array("status"=>"OK","data"=>"$msg","id"=>"$conn_id"));
    exit;
}
?>