<?php
require_once "includes/main.php";
authsuperuser();
$ID = ID;
$name = NAME;

$bad_request_lang = "Bad Request.";
$alert1 = "Please fill out all fields marked *";
$alert2 = "Please enter a valid email address";
$alert4 = "Error creating channel";
$alert8 = "Channel created successfully";

if (!isset($_POST)) {
    $msg = "
    <div class='alert alert-danger mg-b-20' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>×</span>
        </button>
        <strong>Error!</strong> $bad_request_lang
    </div>";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}

if ( empty($_POST['channel_id']) || empty($_POST['name']) || empty($_POST['countrycode']) || empty($_POST['phonenumber']) ) {
	$msg = "
    <div class='alert alert-danger mg-b-20' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>×</span>
        </button>
        <strong>Error!</strong> $alert1
    </div>";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}

$channel_id = base64_decode($_POST['channel_id']);
$channel_id = (int)$channel_id;
$name = mysqli_real_escape_string($conn, strip_tags($_POST['name']));
$countrycode = mysqli_real_escape_string($conn, strip_tags($_POST['countrycode']));
$phonenumber = mysqli_real_escape_string($conn, strip_tags($_POST['phonenumber']));
$subscriber_email = mysqli_real_escape_string($conn, strip_tags($_POST['email']));
$channel_name_txt = strip_tags($_POST['channel_name']);

/**
 * SELECT * FROM cm_subscriber WHERE channel_id = '$channel_id' AND subscriber_number = '$phonenumber' AND countrycode = '$countrycode'
*/

$Query = "SELECT cm_subscriber.*,cm_channel.channel_name FROM cm_subscriber INNER JOIN cm_channel ON cm_channel.id = '$channel_id' WHERE cm_subscriber.channel_id = '$channel_id' AND cm_subscriber.subscriber_number = '$phonenumber' AND cm_subscriber.countrycode = '$countrycode'";

$SQL = mysqli_query($conn, $Query);
$row_count = mysqli_num_rows($SQL);
if ($row_count > 0) {
    while($rows = mysqli_fetch_assoc($SQL)) {
        $id = $rows['id'];
        $channel_id = $rows['channel_id'];
        $name = $rows['name'];
        $countrycode = $rows['countrycode'];
        $subscriber_number = $rows['subscriber_number'];
        $subscriber_status = $rows['subscriber_status'];
        $added_on = $rows['added_on'];
        $updated_on = $rows['updated_on'];
        $channel_name = $rows['channel_name'];
    }
    $msg = "
    <div class='alert alert-danger mg-b-20' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>×</span>
        </button>
        <strong>Error!</strong> Subscriber already exist on <strong>$channel_name</strong> Channel
    </div>";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}
if ($row_count == 0) {
    //do nothing...
}

$SQLi = mysqli_query($conn, "INSERT INTO cm_subscriber (channel_id, name, countrycode, subscriber_number, subscriber_email, subscriber_status, added_on, updated_on) VALUES ('$channel_id', '$name', '$countrycode', '$phonenumber', '$subscriber_email', 'active', '$SERVERTIME', '$SERVERTIME')");

if (!$SQLi) {
	$error = mysqli_error($conn);
    $msg = "
    <div class='alert alert-danger mg-b-20' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>×</span>
        </button>
        <strong>Error!</strong> Joining $channel_name_txt 
    </div>";

    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}
if ($SQLi) {
	$conn_id = mysqli_insert_id($conn);
	$msg = "
    <div class='alert alert-success mg-b-20' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>×</span>
        </button>
        <strong>Perfect!</strong> You have joined the <strong>$channel_name_txt</strong> Channel successfully.
    </div>";
    echo json_encode(array("status"=>"OK","data"=>"$msg"));
    exit;
}
?>