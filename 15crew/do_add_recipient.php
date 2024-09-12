<?php
require_once "../includes/main.php";
ajaxauthsuperuser();
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

if (empty($_POST['channel_id'])) {
	$msg = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />Please refresh page</div>";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}

if (empty($_POST['subscriber_name'])) {
	$msg = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />Please enter subscriber name</div>";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}

if (empty($_POST['countrycode'])) {
	$msg = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />Please select country code</div>";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}

if (empty($_POST['phone_number'])) {
	$msg = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />Please enter phone number</div>";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}

if (!empty($_POST['email'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $msg = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />Please enter a valid email address</div>";
        echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
        exit;
    }
}

$channel_id = (int)$_POST['channel_id'];
$subscriber_name = mysqli_real_escape_string($conn, strip_tags($_POST['subscriber_name']));
$countrycode = mysqli_real_escape_string($conn, strip_tags($_POST['countrycode']));
$phone_number = mysqli_real_escape_string($conn, strip_tags($_POST['phone_number']));
$subscriber_email = mysqli_real_escape_string($conn, strtolower(strip_tags($_POST['email'])));

//id/channel_id/name/countrycode/subscriber_number/added_on/updated_on

$subscriber_status = "active";
$SQLi = mysqli_query($conn, "INSERT INTO cm_subscriber (channel_id, name, countrycode, subscriber_number, subscriber_email, subscriber_status, added_on, updated_on) VALUES ('$channel_id', '$subscriber_name', '$countrycode', '$phone_number', '$subscriber_email', '$subscriber_status', '$SERVERTIME', '$SERVERTIME')");

if (!$SQLi) {
	$error = mysqli_error($conn);
	$msg = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />Error creating subscriber ($error)</div>";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}
if ($SQLi) {
	$conn_id = mysqli_insert_id($conn);
	$msg = "<div id='gorepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/goodfb.png' id='acticon' />Subscriber created successfully</div>";
    echo json_encode(array("status"=>"OK","data"=>"$msg","id"=>"$conn_id"));
    exit;
}
?>