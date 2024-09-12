<?php
require_once "../includes/main.php";
require_once "../includes/mail.php";
authsuperuser();
$ID = ID;
$name = NAME;


$bad_request = "Bad Request.";
$alert1 = "Please fill out all fields";
$alert2 = "Please enter a valid email address";
$alert4 = "Error creating channel.";
$alert6 = "Account Created";
$alert8 = "Channel updated successfully";

if (!isset($_POST)) {
	$msg = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;
opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />$bad_request</div>";
  echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
  exit;
}

if ( (empty($_POST['channel_name'])) || (empty($_POST['channel_id'])) ) {
	$msg = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />$alert1</div>";
  echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
  exit;
}

$channel_name = mysqli_real_escape_string($conn, strip_tags($_POST['channel_name']));
$channel_id = (int)$_POST['channel_id'];

$SQLi = mysqli_query($conn, "UPDATE cm_channel SET channel_name = '$channel_name', updated = '$SERVERTIME' WHERE id = '$channel_id' LIMIT 1");
$num = mysqli_affected_rows($conn);
$query_info = mysqli_info($conn);

preg_match_all('/(\S[^:]+): (\d+)/', $query_info, $matches);
$info = array_combine($matches[1], $matches[2]);

if ($info['Warnings'] > 0) {
    $sql_err = mysqli_error($conn);
    $msg = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;
  opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />$alert4 ($sql_err)</div>";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}else {
    $msg = "<div id='gorepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;
  opacity: 1;'>&times;</button><img src='../assets/img/goodfb.png' id='acticon' />$alert8</div>";
    echo json_encode(array("status"=>"OK","data"=>"$msg","id"=>""));
    exit;
}
?>
