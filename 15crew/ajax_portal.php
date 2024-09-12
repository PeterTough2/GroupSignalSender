<?php
require_once "../includes/main.php";
ajaxauthsuperuser();

$adjacents = 10;
$pager = "";
$query = "SELECT COUNT(*) as num FROM cm_channel";
$targetpage = $_SERVER['PHP_SELF'];
$limit = 50;

$page = (int)$_GET['page'];
if($page) {
$start = ($page - 1) * $limit;
}
else {
$start = 0;
}

$sql = "SELECT * FROM cm_channel ORDER BY id DESC LIMIT $start, $limit";

$total_pages = mysqli_fetch_array(mysqli_query($conn, $query));
$total_pages = $total_pages['num'];
$result = mysqli_query($conn, $sql);

$DB_data = "";

require_once "../includes/pagination.php";

$DB_data = "<table class='responstable table'><thead><tr>
<th>Channels</th>
<th>Action</th>
</tr></thead><tbody>";

while($ix_data = mysqli_fetch_array($result)) {
  $channel_id = $ix_data['id'];
  $channel_name = $ix_data['channel_name'];
  $created = $ix_data['created'];
  $updated = $ix_data['updated'];

  $editbtn = "";
  $deletebtn = "";

  $editbtn = "<a class='' href='create_channel.php?channel_id=$channel_id'><button class='btn btn-mini btn-info btn-table'>Edit Channel</button></a> ";

  $deletebtn = "<button class='btn btn-mini btn-danger btn-table do_del' title='Delete Channel' data-id='$channel_id' id='btn_$channel_id'>Delete Channel</button>";

  $created = date("Y-m-d @ H:i", $created);
  $updated = date("Y-m-d @ H:i", $updated);

  $DB_data .= "<tr class='lectbody' id='$channel_id'>
  <td>$channel_name</td>
  <td>$editbtn $deletebtn</td>
  </tr>";
}
$DB_data .= "</tbody></table><br>";
$DB_data .= $pagination;
mysqli_free_result($result);
mysqli_close($conn);
echo $DB_data;
?>