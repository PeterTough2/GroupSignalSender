<?php
require_once "../includes/main.php";
ajaxauthsuperuser();
$ID      = ID;
$name    = NAME;
$passkey = PASSWORD;
if (!isset($_POST)) {
    $xo  = "<div class='alert alert-danger alert-dismissable'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;
opacity: 1;'>&times;</button>
<h4><i class='icon fa fa-info'></i>Alert</h4>
Error, Try Again.
</div>";
    echo $xo;
    exit;
}

if ((empty($_POST['pp1'])) OR (empty($_POST['pp2'])) OR (empty($_POST['pp3']))) {
    $xo  = "<div class='alert alert-danger alert-dismissable'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;
opacity: 1;'>&times;</button>
<h4><i class='icon fa fa-info'></i>Alert</h4>
Please fill out all fields
</div>";
    echo $xo;
    exit;
}

$pp1 = ($_POST['pp1']);
$pp2 = ($_POST['pp2']);
$pp3 = ($_POST['pp3']);

//$pp1 = encrypt_decrypt(encrypt, $pp1);
$passkey = Cryptography::decrypt($passkey);

if ($pp1 == $passkey) {
} else {
    $xo  = "<div class='alert alert-danger alert-dismissable'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;
opacity: 1;'>&times;</button>
<h4><i class='icon fa fa-info'></i> Alert</h4>
Current Password is Wrong.
</div>";
    echo $xo;
    exit;
}

if ($pp2 !== $pp3) {
    $xo  = "<div class='alert alert-danger alert-dismissable'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;
opacity: 1;'>&times;</button>
<h4><i class='icon fa fa-info'></i> Alert</h4>
New Password doesn't Match.
</div>";
    echo $xo;
    exit;
}

//$pp2 = encrypt_decrypt(encrypt, $pp2);
$pp2    = Cryptography::encrypt($pp2);
//mysqli escape
$pp2    = mysqli_real_escape_string($conn, $pp2);
$tsql   = "UPDATE cm_superuser SET password = '$pp2' WHERE id = '$ID' LIMIT 1";
$update = mysqli_query($conn, "UPDATE cm_superuser SET password = '$pp2' WHERE id = '$ID' LIMIT 1");
$num    = mysqli_affected_rows($conn);

if ($num == 0) {
    $errmsg = mysqli_error($conn);
    $xo     = "<div class='alert alert-danger alert-dismissable'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;
opacity: 1;'>&times;</button>
<h4><i class='icon fa fa-info'></i> Alert</h4>
Error, Saving Password
</div>";
    echo $xo;
    exit;
}

if ($num == 1) {
    $_SESSION['cm_superpass'] = $pp2;
    $xo                          = "<div class='alert bg-green alert-dismissable'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;
opacity: 1;'>&times;</button>
<h4><i class='icon fa fa-info'></i>Alert</h4>
Password Updated Successfully.
</div>";
    echo $xo;
    exit;
}

?>