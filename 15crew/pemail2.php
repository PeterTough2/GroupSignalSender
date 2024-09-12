<?php
require_once "../includes/main.php";

ajaxauthsuperuser();
$name = NAME;
$ID   = ID;
$admin_number = PHONE;

if (!isset($_POST)) {
    $xo = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />Error, Try Again.</div>";
    echo $xo;
    exit;
}

if ((!isset($_POST['confirmcode'])) && (!isset($_POST['email2']))) {
    if ((empty($_POST['email1']))) {
        $xo = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />Please fill out all fields.</div>";
        echo $xo;
        exit;
    }
    
    else {
        $email = $_SESSION['cm_superuser'];
        $roma  = rand(30000, 90000);
        $codex = mysqli_query($conn, "UPDATE cm_superuser SET confirmcode = '$roma' WHERE id = '$ID' LIMIT 1");
        if (!$codex) {
            $xo = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />Error, Try Again.</div>";
            echo $xo;
            exit;
        }

    $message = "Community Manager
    Hello $name,
    Use the confirmation code below to complete the process.
    Confirmation number : $roma";

    //$response = sendViaPost('BulkSMSNG', $admin_number, $message);//BulkSMSNG - CManager
    $response = sendViaPost(SENDERID,  $admin_number, $message);

    $response_code = trim($response['code']);
    $response_body = $response['body'];
    if ($response_code == '200') {
        $msg = "A Confirmation code has been sent to your phone number, to validate transfer.";
        $xo = "<div id='gorepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/goodfb.png' id='acticon' />$msg</div>";
        echo $xo;
    } else {
        $msg = "Error Sending Email, Try again.";
        $xo = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />$msg</div>";
        echo $xo;
    }
    exit;

    }
}


if ((isset($_POST['confirmcode'])) && (isset($_POST['email2']))) {
    
    if ((empty($_POST['email2'])) || (empty($_POST['confirmcode']))) {
        $xo = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />Please fill out all fields</div>";
        echo $xo;
        exit;
    }
    
    $confirmcode = (int) $_POST['confirmcode'];
    $email2      = strtolower(trim($_POST['email2']));
    $phone = (trim($_POST['phone']));
    
    if (!filter_var($email2, FILTER_VALIDATE_EMAIL)) {
        $xo = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />Email is not valid</div>";
        echo $xo;
        exit;
    }    
    
    $confirmcode = mysqli_real_escape_string($conn, $confirmcode);
    $email2      = mysqli_real_escape_string($conn, $email2);
    $phone      = mysqli_real_escape_string($conn, $phone);
    $tsql        = "UPDATE cm_superuser SET email = '$email2', phone = '$phone', confirmcode = '0' WHERE id = '$ID' AND confirmcode = '$confirmcode' LIMIT 1";
    $dodex       = mysqli_query($conn, "$tsql");
    $num         = mysqli_affected_rows($conn);
    if ($num == 1) {
        $_SESSION['cm_superuser'] = $email2;
        echo $xo;
        $xo = "<div id='gorepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/goodfb.png' id='acticon' />Email updated successfully</div>";
        echo $xo;
        exit;
    }
    if ($num == 0) {
        $xo = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;opacity: 1;'>&times;</button><img src='../assets/img/failed.png' id='acticon' />Error updating email, try again</div>";
        echo $xo;
        exit;
    }
}
?>