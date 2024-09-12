<?php
require_once "../includes/main.php";
loginsuperuser();

$err = "";
if ( isset($_GET['msg']) && (!empty($_GET['msg'])) ) {
	$err = strip_tags($_GET['msg']);
	$err = "<div id='barepor'><img src='../assets/img/failed.png' id='acticon' /> $err <a href='index.php' style='color:#fff;'>".$lang["Login"]." </a></div>";
}

if ( isset($_GET['OK']) && (!empty($_GET['OK'])) ) {
	$err = strip_tags($_GET['msg']);
	$err = "<div id='gorepor'><img src='../assets/img/goodfb.png' id='acticon' /> $err <a href='index.php' style='color:#fff;'>".$lang["Login"]." </a></div>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Maxam - <?php echo $lang["Recover"]; ?></title>
<link rel="stylesheet" type="text/css" href="../assets/css/reset.css" />
<link rel="stylesheet" type="text/css" href="../assets/css/form.css" />
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

<!-- Favicon -->
<link rel="shortcut icon" href="../assets_v2/img/favicon.png">

<style type="text/css">
i.hosname {
   font-family: 'Roboto', sans-serif;
}
div#header {
   height: 100px;
}
#bg {
background: url(../assets_v2/img/bg1.jpg) no-repeat center center fixed;
background-size: cover;
position: fixed;
left: 0;
top: 0;
width: 100%;
height: 100%;
}
img.wz_header {
  width: 200px;
  height: 50px;
  margin-bottom: 20px;
  margin-top: 10px;
}
i strong {
	font-weight: bold;
}
</style>
</head>

<body>

<div id="bg"></div>

<div id="header">
<img src="../assets_v2/img/header.png" class="wz_header">
<br /><i class='vers'><strong>Recover Password</strong></i></div>

<form action="do_recover.php" method="POST">

<div id="status"><?php echo $err; ?></div>

<label for=""></label>
<input type="text" name="maxam_user" id="" placeholder="Email" class="email">

<button type="submit" name="maxam_init"><?php echo $lang["Recover"]; ?></button>

</form>
</body>
</html>