<?php
//require_once "../includes/main.php";
/*
ajaxauthsuperuser();
$name = NAME;
$ID   = ID;
$admin_number = PHONE;
*/

//Here is the function to send via POST using CURL
function sendViaPost($senderID, $phone, $message) {
    $response = array();
    $headers = array('Content-Type: application/x-www-form-urlencoded');
    $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create';
    $arr_params = [
        'from'  	=>  $senderID,
        'to'  		=>  $phone,
        'body'  	=>  $message,

        'append_sender' => 2, // Choose your Append Sender ID Option:
        //1 for none,
        // 2 for Hosted SIM Only
        // and 3 for all

        'api_token' =>  'uPBPhSN6T3mw02qNACXrAcX4LKMMul1tmvNGZCzjiarUO1oHZcKmaZUcn0Mz', //Todo: Replace with your API Token

        'dnd'       =>  4 //Choose your preferred DND Management Option:
        // 1 for Get a refund,
        // 2 for Direct hosted SIM,
        // 3 for Hosted SIM Only,
        // 4 for Dual-Backup and
        // 5 for Dual-Dispatch
    ];
    if (is_array($arr_params)) {
        $final_url_data = http_build_query($arr_params, '', '&');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $final_url_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $response['body'] = curl_exec($ch);
    $response['code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $response;
}

$roma = "31311";

$message = "
Pair: LTC/USDT
Entry: 165 - 170 sats
SL: 155 sats 6% 
TP: 181 - 214 sats 10-30%
Exchange: Binance
";


//Call the SendViaPost function to dispatch your message passing in your Sender ID, Phone Number and Message Body)
//$response = sendViaPost('BulkSMSNG', '2348160361948', "This is a test message - oooGGG");
$response = sendViaPost('CManager', '2348160361948,2348061385058', $message);
//$response = sendViaPost('BulkSMSNG', '2348160361948', $message);

$response_code = $response['code'];
$response_body = $response['body'];

echo "HTTP Code: $response_code "." \n Response Body: $response_body";

?>