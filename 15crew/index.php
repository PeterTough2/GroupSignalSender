<?php
require_once "../includes/main.php";
loginsuperuser();

$err = "";
$alert1 = $lang["Forgot Password"];
if ( isset($_GET['msg']) && (!empty($_GET['msg'])) ) {
	$err = strip_tags($_GET['msg']);
	$err = "<div id='barepor'><img src='../assets/img/failed.png' id='acticon' /> $err <a href='forgot.php' style='color:#fff;'>$alert1 </a></div>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Stash - 15% Crew</title>
<link rel="stylesheet" type="text/css" href="../assets/css/reset.css" />
<link rel="stylesheet" type="text/css" href="../assets/css/form.css" />
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

<!-- Favicon -->
<link rel="shortcut icon" href="../assets_v2/img/stash_logo.jpg">

<style type="text/css">
i.hosname {
   font-family: 'Roboto', sans-serif;
}
div#header {
   height: 100px;
}
#bg {
background: url(../assets_v2/img/fx.jpg) no-repeat center center fixed;
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

<form action="do_portal.php" method="POST" style="margin-top:30px;">

<div class="" style="font-size: 26px;
color: #fff;
width: 95%;
margin-bottom: 10px;
border-radius: 5px;
display: inline-block;
text-align: center;
padding: 10px 0px;
font-family: segoe script;background-color: black;">Community Manager</div>

<div id="status"><?php echo $err; ?></div>

<label for=""></label>
<input type="text" name="stash_user" id="" placeholder="Username" class="email">

<label for=""></label>
<input type="password" name="stash_pass" id="" placeholder="Password" class="pass">

<button type="submit" name="stash_init">Login</button>

<br><br>
<a href="forgot.php" style="background-color: black;
padding: 5px;
border-radius: 5px;
text-decoration: none;
font-size: 14px;
color: #fff;
font-family: tahoma;">Recover Password</a>
</form>
</body>
</html>