<?php
require_once "../includes/main.php";
ajaxauthsuperuser();
$ID = ID;
$name = NAME;

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


            

$channel_id = (int)$_GET['channel_id'];
$channel_row = 0;

$SQL = mysqli_query($conn, "SELECT cm_subscriber.*,cm_channel.channel_name FROM cm_subscriber INNER JOIN cm_channel ON cm_channel.id = '$channel_id' WHERE cm_subscriber.channel_id = '$channel_id'");
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
        if ($subscriber_status == 'active') {
            $active_class = "on";
            $deliver_status = "on";
        }else {
            $active_class = "";
            $deliver_status = "off";
        }
        $channel_row++;
        if ($channel_row == 1) {
            $dbdata = "<table style='width:100%; margin-bottom:20px;'>
            <caption> $channel_name <br> <small>$row_count Subscriber</small> </caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Subscriber Name</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>";
        }

        $dbdata .= "
        <tr id='$id'>
        <td>$channel_row</td>
        <td>$name</td>
        <td>$countrycode - $subscriber_number</td>
        <td>
            <div class='az-toggle az-toggle-success $active_class' medium='sub_status' channel_id='$channel_id' sub_id='$id' deliver='$deliver_status'><span></span></div>
        </td>
        </tr>"; 
    }
    $dbdata .= "
    </tbody>
    </table>";    

    echo json_encode(array("status"=>"OK","data"=>"$dbdata"));
    exit;
}
if ($row_count == 0) {
    echo json_encode(array("status"=>"ERROR","data"=>"No subscriber on this channel"));
    exit;
}
echo json_encode(array("status"=>"ERROR","data"=>"Please refresh and try again."));
exit;

?>