<?php
require_once "../includes/main.php";
ajaxauthsuperuser();

$ID = ID;
$name = NAME;

if (!isset($_POST)) {
	$msg = "Bad Request.";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}

if (empty($_POST['channel_id'])) {
	$msg = "Please refresh page";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}

if (empty($_POST['message'])) {
	$msg = "Please enter a message";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}

if ( ($_POST['sms'] == 'off') && ($_POST['whatsapp'] == 'off') ) {
	$msg = "SMS and WhatsApp is turned OFF - turn either or both ON";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}

$channel_id = (int)$_POST['channel_id'];
$message = urldecode($_POST['message']);
$channel_row = 0;
$data_rows = [];
$no_list = [];

$SQL = mysqli_query($conn, "SELECT cm_subscriber.*,cm_channel.channel_name FROM cm_subscriber INNER JOIN cm_channel ON cm_channel.id = '$channel_id' WHERE cm_subscriber.channel_id = '$channel_id' AND cm_subscriber.subscriber_status = 'active'");
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
        $channel_row++;

        $data_rows[] = [
            "name" => $name,
            "countrycode" => $countrycode,
            "subscriber_number" => $subscriber_number,
            "channel_name" => $channel_name
        ];

        if (!empty($countrycode) && !empty($subscriber_number)) {
            $no_list[] = $countrycode.$subscriber_number;
        }
    }

    if ( ($_POST['sms'] == 'on') ) {
        $sms_response = sendViaPost(SENDERID, implode(",",$no_list), $message);
        $response_code = (int)trim($sms_response['code']);
        $response_body = $sms_response['body'];
        if ($sms_response['code'] == 200) {
            $status = "OK";
            $data = "SMS Message sent successfully!";
        }else {
            $status = "ERROR";
            $data = "$response_code Error: SMS Message NOT sent";
        }
    }
    if ( ($_POST['whatsapp'] == 'on') ) {
        //SendWhatsApp($data_rows, $message);//stingy with their API
    }

    echo json_encode(array("status"=>"$status","data"=>"$data"));
    exit;
}
if ($row_count == 0) {
    echo json_encode(array("status"=>"ERROR","data"=>"No active subscriber on this channel"));
    exit;
}
echo json_encode(array("status"=>"ERROR","data"=>"Please refresh and try again."));
exit;
?>