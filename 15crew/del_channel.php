<?php
require_once "../includes/main.php";
ajaxauthsuperuser();
$io = (int)$_GET['id'];
if ($io > 0) {
	$del = mysqli_query($conn, "DELETE FROM cm_channel WHERE id = '$io'");
	if ($del) {
		$del2 = mysqli_query($conn, "DELETE FROM cm_subscriber WHERE channel_id = '$io'");
		echo "OK";
	}
	if (!$del) {
		echo "DBERROR";
	}
}
exit;
?>