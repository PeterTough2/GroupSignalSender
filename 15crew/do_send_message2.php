<?php
require_once "../includes/main.php";
ajaxauthsuperuser();

require_once __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

$ID = ID;
$name = NAME;

$msg = "SMS and WhatsApp is turned OFF - turn either or both ON";
echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
exit;

function SendWhatsApp($data_rows, $message) {
    
}
function SendSMS($data_rows, $message) {
    //$client = new Client(ACCOUNT_SID, AUTH_TOKEN); //initiate twilio class
    $client = new Twilio\Rest\Client(ACCOUNT_SID, AUTH_TOKEN);
    //$client->setLogLevel('debug');//Enable Debug Logging
    $success = 0;
    $failed = 0;

    for ($i = 0; $i < count($data_rows); $i++) {
        $a_name = $data_rows[$i]["name"];
        $a_countrycode = $data_rows[$i]["countrycode"];
        $a_subscriber_number = $data_rows[$i]["subscriber_number"];
        $a_channel_name = $data_rows[$i]["channel_name"];
        
        $a_phonenumber = "+".$a_countrycode.$a_subscriber_number;
        $sms_message = "$message";

        if (!empty($a_countrycode) && !empty($a_subscriber_number)) {
            try {
                $twilio_message = $client->messages->create(
                    $a_phonenumber, // Text this number
                    [
                        'from' => TWILIO_NUMBER, // From a valid Twilio number
                        'body' => $sms_message,
                    ]
                );
            } catch (\Twilio\Exceptions\RestException $e) {
                $failed++;
                $twilio_err = "Error sending SMS: " . $e->getCode() . ' : ' . $e->getMessage() . "\n";
                $info = "\n $twilio_err \n On Date: " . $SERVERDATE;
                $fp = fopen("twilio_log.txt", "a");
                fwrite($fp, $info);
                fclose($fp);
                continue;
            }
            //$MessageStatus = $message->status;
            $MessageResponse = $twilio_message;
            if (!empty($MessageResponse)){
                $success++;
            }
        }
    }
    return json_encode(array("data"=>" $success Sent; $failed Failed"));
}

if (!isset($_GET)) {
	$msg = "Bad Request.";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}

if (empty($_GET['channel_id'])) {
	$msg = "Please refresh page";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}

if (empty($_GET['message'])) {
	$msg = "Please enter a message";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}

if ( ($_GET['sms'] == 'off') && ($_GET['whatsapp'] == 'off') ) {
	$msg = "SMS and WhatsApp is turned OFF - turn either or both ON";
    echo json_encode(array("status"=>"ERROR","data"=>"$msg"));
    exit;
}

$channel_id = (int)$_GET['channel_id'];
$message = nl2br($_GET['message']);
$channel_row = 0;
$data_rows = [];

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
    }

    if ( ($_GET['sms'] == 'on') ) {
        $sms_response = SendSMS($data_rows, $message);
        $sms_response = json_decode($sms_response);
        $sms_response = $sms_response->data;
    }
    if ( ($_GET['whatsapp'] == 'on') ) {
        //SendWhatsApp($data_rows, $message);//stingy with their API
    }

    echo json_encode(array("status"=>"OK","data"=>"$row_count Subscribers; SMS Response > $sms_response"));
    exit;
}
if ($row_count == 0) {
    echo json_encode(array("status"=>"ERROR","data"=>"No active subscriber on this channel"));
    exit;
}
echo json_encode(array("status"=>"ERROR","data"=>"Please refresh and try again."));
exit;
?>