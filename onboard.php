<?php
require_once "includes/main.php";
if (!empty($_GET['channel_id'])) {
    $channel_id = base64_decode($_GET['channel_id']);
    $channel_cd = base64_decode($_GET['channel_cd']);
    $channel_id = (int)$channel_id;

    if ($channel_id > 0) {

        $SQLi_a = mysqli_query($conn, "SELECT * FROM cm_channel WHERE id = '$channel_id' AND link_status = 'active'");
        if (mysqli_num_rows($SQLi_a) > 0) {
            while($ix_data = mysqli_fetch_assoc($SQLi_a)) {
                $channel_id = $ix_data['id'];
                $channel_name = $ix_data['channel_name'];
                $channel_status = $ix_data['link_status'];
                $created = $ix_data['created'];
                $updated = $ix_data['updated'];
            }
        }
        if (mysqli_num_rows($SQLi_a) == 0) {
            $channel_name = "";
            $errmsg = "<h5 class='text-center text-success'>Channel not found or not active.</h5>";
        }
        //http://localhost/stash/15crew/add_recipient.php?channel_id=Mw==&channel_cd=MTY0OTc3NzY0Ng==
    }else {
        $channel_name = "";
        $errmsg = "<h5 class='text-center text-danger'>Channel not found.</h5>";
    }
}else {
    $channel_name = "";
    $errmsg = "<h5 class='text-center text-danger'>Channel not found.</h5>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Community Manager">
    <meta name="author" content="Community Manager">

    <title>::: Community Manager - Onboard :::</title>

    <!-- vendor css -->
    <link href="assets_v2/lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets_v2/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="assets_v2/lib/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="assets_v2/css/azia.css">

  </head>
  <body class="az-body">

    <div class="az-signin-wrapper">
      <div class="az-card-signin">
        <div class="az-signin-header">
          <h2 class="text-center">Community Manager <small style="font-size:9px;">v1.0</small></h2>
          <?php
            if (empty($errmsg)) {
                echo "<h4>Please enter your details to subscribe to <strong> $channel_name </strong> Channel</h4>";
            }else {
                echo $errmsg;
            }
          ?>
          <form action="sign_up.php" method="POST" id="add_subscriber_form">

          <div class="response_status">
          </div>

          <div class="channel_status mg-b-20 mg-t-20 text-center" style="display:none;">
            <img src="assets/img/double_ring.gif" alt="Loading..." style="width: 50px;">
          </div>
          <?php
            if (!empty($channel_name)) {
          ?>
            <div class="form-group">
              <label>Name *</label>
              <input type="text" class="form-control" placeholder="Enter Name" value="" name="name">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Country Code *</label>
              <input type="text" class="form-control" placeholder="+234" value="" name="countrycode">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Phone Number *</label>
              <input type="text" class="form-control" placeholder="08035511111" value="" name="phonenumber">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Email <small>(optional)</small></label>
              <input type="text" class="form-control" placeholder="Enter your email" value="" name="email">
              <input type="hidden" class="form-control" value="<?php echo $_GET['channel_id']; ?>" name="channel_id">
              <input type="hidden" class="form-control" value="<?php echo $channel_name; ?>" name="channel_name">
            </div><!-- form-group -->
            
            <button class="btn btn-az-primary btn-block do_channel">Join Channel</button>
          <?php
            }
          ?>
          </form>
        </div><!-- az-signin-header -->
        <div class="az-signin-footer">
        </div><!-- az-signin-footer -->
      </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->

    <script src="assets_v2/lib/jquery/jquery.min.js"></script>
    <script src="assets_v2/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets_v2/lib/ionicons/ionicons.js"></script>

    <script src="assets_v2/js/azia.js"></script>
    <script>
      $(function(){
        'use strict'

      });

      $(document).on('click', '.do_channel', function(event){
        event.preventDefault();
        var name = $('input[name=name]').val();
        var countrycode = $('input[name=countrycode]').val();
        var phonenumber = $('input[name=phonenumber]').val();
        var channel_id = $('input[name=channel_id]').val();
        var email = $('input[name=email]').val();

        if ( (name.length < 1) || (countrycode.length < 1) || (phonenumber.length < 1) || (channel_id.length < 1) ) {
            alert('Please fill out all fields marked *');
            return false;
        }
        var doService = document.getElementById('add_subscriber_form');
        $('div.channel_status').show();
        $('div.response_status').html('');
        $.ajax({
            type: 'POST',
            url: 'sign_up.php',
            dataType: 'json',
            data: new FormData(doService),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
            //$("html, body, #add_service_form").animate({ scrollTop: 0 }, 1200);
        },
        success: function(msg){
            var status = msg.status;
            var response = msg.data;
            if(status == 'OK'){
                $('div.response_status').html(response);
                $("#add_subscriber_form")[0].reset();
            }if(status == 'ERROR'){
                $('div.response_status').html(response);
            }
            $('div.channel_status').hide();
        },
        error: function(jqXHR, textStatus, errorThrown){
            $('div.channel_status').hide();
            alert('Sorry, but an error occurred: '+textStatus+' ('+errorThrown+')');
        }
        });
    });
    </script>
  </body>
</html>