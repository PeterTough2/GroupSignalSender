<?php
$Lifetime = 3600 * 24;
$separator = strstr(strtoupper(substr(PHP_OS, 0, 3)), "WIN") ? "\\\\" : "/";

$DirectoryPath = dirname(__FILE__) . "{$separator}SessionData";
//in Wamp for Windows the result for $DirectoryPath
//would be C:\\wamp\\www\\your_site\\SessionData

is_dir($DirectoryPath) or mkdir($DirectoryPath, 0777);

if (ini_get("session.use_trans_sid") == true) {
    ini_set("url_rewriter.tags", "");
    ini_set("session.use_trans_sid", false);
}

//ini_set('opcache.enable', '0');//disable configured to use the in-memory compiled code

ini_set("max_execution_time", "120");
ini_set("max_input_vars", "20000");
ini_set("session.gc_maxlifetime", $Lifetime);
ini_set("session.gc_divisor", "1");
ini_set("session.gc_probability", "1");
ini_set("session.cookie_lifetime", "0");
ini_set("session.save_path", $DirectoryPath);
session_start();

//session_start();
header("Pragma: no-cache");
header("Cache-control: public, no-cache, no-store, no-transform, must-revalidate");
header("Expires: Mon, 31 Jan 1995 12:00:00 GMT");
header("x-content-type-options: nosniff");
set_time_limit(300);
if (version_compare(phpversion(), '5.6.25', '<')) {
    // php version isn't high enough
    exit('Please upgrade your PHP to version 5.6.25 or higher');
}
require_once "config.php";
require_once "cryptography.php";

$siteprotocol = explode('/', strtolower($_SERVER['SERVER_PROTOCOL']));
$HTTP_PROTOCOL = $siteprotocol[0] . "://";
$HTTP_PROTOCOL = "http://";
$SERVER_HOST = $_SERVER['HTTP_HOST'];
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
$SITE_MASTER_FOLDER = explode(DIRECTORY_SEPARATOR, dirname(__DIR__));
$SITE_MASTER_FOLDER = end($SITE_MASTER_FOLDER);
$r = explode("/", $_SERVER['SCRIPT_FILENAME']);
$filename = end($r); //the exact file name
define("FILENAME", "$filename");
$SERVERTIME = time();
$SERVERDATE = date("jS-M-Y g:i A");
define("SERVERDATE", "$SERVERDATE");
$YYMMDD = date("Ymd");
$YYYY = date("Y");

const SENDERID = "CManager";

//$mi6 = $HTTP_PROTOCOL . $SERVER_HOST . "/"."benliska/maxam";
//$mi6 = $HTTP_PROTOCOL . $SERVER_HOST;
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 ? "https://" : "http://";
$mi6 = $HTTP_PROTOCOL . $SERVER_HOST . "/"."stash";
//$mi6 = $protocol . $SERVER_HOST;

$site_url_full = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'];
$site_current_url_full = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//parse url
$i_site_url_full = parse_url($site_url_full);
$site_url_full = $i_site_url_full['scheme'] . "://" . $i_site_url_full['host'];

$i_site_current_url_full = parse_url($site_current_url_full);
$site_current_url_full = $i_site_current_url_full['scheme'] . "://" . $i_site_current_url_full['host'] . $i_site_current_url_full['path'];

define("SITEFULLURL", "$site_url_full");
define("SITECURRENTFULLURL", "$site_current_url_full");

$mi6 = "https://dewebmanager.com/cmanager/";

//error_reporting(0);
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

$dbhost = "localhost";
$dbuser = "cmanagerxc";
$dbpass = "21xxd9283jdhDXPsj";
$dbname = "cmanager";//

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
    $errmsg = mysqli_error($conn);
    echo "Error, Connecting to Database";
    exit();
}
mysqli_set_charset($conn, 'utf8');

function getExtension($str)
{
    $i = strrpos($str, ".");
    if (!$i) {
        return "";
    }

    $l = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
}

function filesize_formatted($size)
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    $power = $size > 0 ? floor(log($size, 1024)) : 0;
    return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
}

function html($str)
{
    $str = htmlentities(htmlentities("$str", ENT_COMPAT, "UTF-8"), ENT_COMPAT, "UTF-8");
    return $str;
}
function log_error($info)
{
    global $SITE_MASTER_FOLDER;
    $on_line = __LINE__;
    $the_file = __FILE__;
    if (is_array($info)) {
        $info = print_r($info, true);
    }
    $info = "\n $info \n On Date: " . SERVERDATE;
    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/$SITE_MASTER_FOLDER/in/error_log.md", 'a');
    fwrite($fp, $info);
    fclose($fp);
}

function getPercent($total, $val, $sign)
{
    if ($sign == true) {
        return number_format(($val / $total) * 100, 2) . "%";
    }
    if ($sign == false) {
        return number_format(($val / $total) * 100, 2);
    }
}

function filterupload($filename)
{
    $from = [";", "!", "@", "¥", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "=", "_", "»", "¤", "î", "™", "¢", "|", "'", "~", "`", "ï", "‰", "´", "©", "ì", "´", "â", "¿", "½", "�", '��'];

    $to = ["", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""];
    return str_replace($from, $to, $filename);
}

function random_string($length)
{
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

function random_digit($length)
{
    $key = '';
    $keys = range(0, 9);

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

function random_alpha($length)
{
    $key = '';
    $keys = range('A', 'Z');

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

function ajaxauthsuperuser()
{
    global $conn;
    global $SERVERDATE;
    global $SERVERTIME;
    global $ServerIP;
    $user = $_SESSION['cm_superuser'];
    $pass = $_SESSION['cm_superpass'];

    $sql = "SELECT * FROM cm_superuser WHERE email = '$user' LIMIT 1";
    $sqlexe = mysqli_query($conn, $sql);

    if (mysqli_num_rows($sqlexe) == 1) {
        while ($mox = mysqli_fetch_assoc($sqlexe)) {
            $ID = $mox['id'];
            $name = $mox['name'];
            $email = $mox['email'];
            $db_password = $mox['password'];
            $confirmcode = $mox['confirmcode'];
            $config = $mox['config'];
            $phone = $mox['phone'];

            $sentPass = Cryptography::decrypt($pass);
            $storedPass = Cryptography::decrypt($db_password);
            $config = json_decode(base64_decode($config));
            $config_email_signature = $config->email_signature;

            if ($sentPass == $storedPass) {
                $_SESSION['cm_superuser'] = $user;
                $_SESSION['cm_superpass'] = $pass;
                $_SESSION['cm_superphone'] = $phone;
                define("ID", "$ID");
                define("NAME", "$name");
                define("EMAIL", "$email");
                define("PASSWORD", "$db_password");
                define("PHONE", "$phone");
                define("CONFIRMCODE", "$confirmcode");
                define("EMAILSIGNATURE", "$config_email_signature");
            } else {
                if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                    echo json_encode(["SESSIONEXPIRED" => "YES"]);
                } else {
                    echo "SESSIONEXPIRED";
                }
                exit();
            }
        }
    }
    if (mysqli_num_rows($sqlexe) == 0) {
        header("location:logout.php");
        exit();
    }
}

function authsuperuser()
{
    global $conn;
    global $SERVERDATE;
    global $SERVERTIME;
    global $ServerIP;
    $user = $_SESSION['cm_superuser'];
    $pass = $_SESSION['cm_superpass'];

    $sql = "SELECT * FROM cm_superuser WHERE email = '$user' LIMIT 1";
    $sqlexe = mysqli_query($conn, $sql);

    if (mysqli_num_rows($sqlexe) == 1) {
        while ($mox = mysqli_fetch_assoc($sqlexe)) {
            $ID = $mox['id'];
            $name = $mox['name'];
            $email = $mox['email'];
            $db_password = $mox['password'];
            $confirmcode = $mox['confirmcode'];
            $config = $mox['config'];
            $phone = $mox['phone'];

            $sentPass = Cryptography::decrypt($pass);
            $storedPass = Cryptography::decrypt($db_password);
            $config = json_decode(base64_decode($config));
            $config_email_signature = $config->email_signature;

            if ($sentPass == $storedPass) {
                $_SESSION['cm_superuser'] = $user;
                $_SESSION['cm_superpass'] = $pass;
                $_SESSION['cm_superphone'] = $phone;
                define("ID", "$ID");
                define("NAME", "$name");
                define("EMAIL", "$email");
                define("PASSWORD", "$db_password");
                define("PHONE", "$phone");
                define("CONFIRMCODE", "$confirmcode");
                define("EMAILSIGNATURE", "$config_email_signature");
            } else {
                header("location:logoutx1.php");
                exit();
            }
        }
    }
    if (mysqli_num_rows($sqlexe) == 0) {
        header("location:logoutx2.php");
        exit();
    }
}

function loginsuperuser()
{
    global $conn;
    global $SERVERDATE;
    global $SERVERTIME;
    global $ServerIP;
    $user = $_SESSION['cm_superuser'];
    $pass = $_SESSION['cm_superpass'];

    $sql = "SELECT * FROM cm_superuser WHERE email = '$user' LIMIT 1";
    $sqlexe = mysqli_query($conn, $sql);

    if (mysqli_num_rows($sqlexe) == 1) {
        while ($mox = mysqli_fetch_assoc($sqlexe)) {
            $ID = $mox['id'];
            $name = $mox['name'];
            $db_password = $mox['password'];
            $phone = $mox['phone'];

            //$sentPass = $pass;
            $sentPass = Cryptography::decrypt($pass);
            $storedPass = Cryptography::decrypt($db_password);
            if ($sentPass == $storedPass) {
                $_SESSION['cm_superuser'] = $user;
                $_SESSION['cm_superpass'] = $pass;
                $_SESSION['cm_superphone'] = $phone;
                mysqli_query($conn, "UPDATE cm_superuser SET lastlogin = '$SERVERTIME' WHERE id = '$ID' LIMIT 1");
                header("location:portal.php");
                exit();
            } else {
            }
        }
    }
    if (mysqli_num_rows($sqlexe) == 0) {
    }
}

//Here is the function to send via POST using CURL
function sendViaPost($senderID, $phone, $message) {
    $response = array();
    $headers = array('Content-Type: application/x-www-form-urlencoded');
    $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create';

    $message = str_replace("\r\n", "\n", $message);
    $message = str_replace("\r", "\n", $message);

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

function SendWhatsApp($data_rows, $message) {
    
}

$regex_alpha = "/^[a-z;& ]+$/i"; //all alphabets, (& and ; incase of special character)  including spaces (case-insensitive)
$regex_alphanumeric = "/^[a-z;&0-9- ]+$/i"; ///^[a-z][0-9]$/i//all alphabets and digits including spaces and dash (case-insensitive)
$regex_alphanumeric_specialchar = "/^[a-z;&0-9_ -]+$/i"; ///^[a-z][0-9_]$/i//all alphabets and digits including underscore (case-insensitive)
$regex_alphanumeric_specialchar_nospace = "/^[a-z0-9_]+$/i"; ///^[a-z][0-9_]$/i//all alphabets and digits including underscore (case-insensitive)
$regex_numeric = "/^\d+$/"; //0-9//all digits
$regex_ip = "/[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+/"; //all ipv4 address or this /\b(?:\d{1,3}\.){3}\d{1,3}\b/m
$regex = "/^[_a-zA-Z0-9_]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$/"; //email
?>