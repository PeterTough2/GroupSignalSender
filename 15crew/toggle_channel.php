<?php
require_once "../includes/main.php";
ajaxauthsuperuser();
$channel_id = (int)$_GET['channel_id'];
$deliver = $_GET['deliver'];

if (empty($_GET['deliver'])) {
    echo json_encode(array("status"=>"ERROR","data"=>"Please refresh page and try again."));
    exit;
}

if ($deliver == 'off') {
    $status = "inactive";
}
if ($deliver == 'on') {
    $status = "active";
}

if ( ($channel_id > 0) ) {
	$del = mysqli_query($conn, "UPDATE cm_channel SET link_status = '$status' WHERE id = '$channel_id' LIMIT 1");
	if ($del) {
		echo json_encode(array("status"=>"OK","data"=>"Successfully Updated."));
        exit;
	}
	if (!$del) {
		echo json_encode(array("status"=>"ERROR","data"=>"Unable to toggle Channel status - try again."));
        exit;
	}
}else {
    echo json_encode(array("status"=>"ERROR","data"=>"Wrong input - refresh and try again."));
    exit;
}
?>