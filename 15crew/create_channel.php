<?php
require_once "../includes/main.php";
authsuperuser();
$name = NAME;
$pic = "$mi6/assets/img/icon.jpg";
$page_action = "Create Channel";
if (isset($_GET['channel_id'])) {
  $page_action = $lang["Edit Channel"];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>::: Maxam - <?php echo $page_action; ?> :::</title>
    <link rel="shortcut icon" href="../assets_v2/img/favicon.png">

    <link rel="stylesheet" href="../assets/css/jqueryui.css">
    <!-- vendor css -->
    <link href="../assets_v2/lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../assets_v2/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../assets_v2/lib/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="../assets_v2/css/azia.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets_v2/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets_v2/css/custom_v2.css">

  </head>
  <body class="az-body az-body-sidebar az-body-dashboard-nine">

    <div class="az-sidebar az-sidebar-sticky az-sidebar-indigo-dark">
      <?php
      require_once "leftmenu.php";
      ?>
    </div><!-- az-sidebar -->
    <div class="az-content az-content-dashboard-nine">


      <?php
      require_once "topmenu.php";
      ?>
      <div class="az-content-header">
        <div class="az-content-header-top">
          <div>
            <h2 class="az-content-title mg-b-5 mg-b-lg-8"><?php echo $page_action; ?></h2>
          </div>
        </div><!-- az-content-body-title -->

      </div><!-- az-content-header -->
      <div class="az-content-body">
        <!-- your content starts here -->



<div id="status" style="margin-top: 10px; margin-bottom: 15px;"></div>
<div class="tblpagination">

          <div class="row row-sm">

            <div class="col-md-8 col-sm-12 form-partition">

<?php

if (empty($_GET['channel_id'])) {
  if ((int)$_GET['channel_id'] == 0) {
?>

<form id="add_service_form" method="post" enctype="multipart/form-data">

<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">Channel Name</span>
</div>
<input type="text" class="form-control" name="channel_name" id="channel_name" autocomplete="off" aria-describedby="basic-addon1" required>
</div><!-- input-group -->

<div class="box-footer">
<button type="submit" class="btn btn-info pull-left create_service">Create Channel</button>
</div><!-- /.box-footer -->


</div><!-- col -->
</div><!-- row -->

</form>
<?php
  }
}
if (!empty($_GET['channel_id'])) {
  if ((int)$_GET['channel_id'] > 0) {
    $channel_id = (int)$_GET['channel_id'];
    $SQLi_a = mysqli_query($conn, "SELECT * FROM cm_channel WHERE id = '$channel_id'");
    while($ix_data = mysqli_fetch_assoc($SQLi_a)) {
        $channel_id = $ix_data['id'];
        $channel_name = $ix_data['channel_name'];
        $channel_status = $ix_data['link_status'];
        $created = $ix_data['created'];
        $updated = $ix_data['updated'];
    }

    $id_url = base64_encode($channel_id);
    $created_url = base64_encode($created);
    if ($channel_status == 'active') {
      $class_status = "on";
    }else {
      $class_status = "";
    }

    $onboard_url = $mi6."onboard.php"."?channel_id=$id_url&channel_cd=$created_url";
?>
<!-- edit form start -->

  <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">Channel Name</span>
      </div>
      <input type="text" readonly class="form-control" name="channel_name" id="channel_name" autocomplete="off" aria-describedby="basic-addon1" value="<?php echo $channel_name; ?>" required>
  </div><!-- input-group -->

  Activate URL: Members can register to this channel only when URL is activated.
  <br>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">Channel URL</span>
    </div>
    <input type="text" readonly class="form-control" name="channel_url" id="channel_url" autocomplete="off" aria-describedby="basic-addon1" value="<?php echo $onboard_url; ?>" required>
  </div><!-- input-group -->

  <div class='az-toggle az-toggle-success <?php echo $class_status; ?>' link_toggle_status='<?php echo $channel_status; ?>'>
    <span></span>
  </div>
  <br>

<form id="edit_service_form" method="post" enctype="multipart/form-data">

<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">Channel Name</span>
</div>
<input type="text" class="form-control" name="channel_name" id="channel_name" autocomplete="off" aria-describedby="basic-addon1" value="<?php echo $channel_name; ?>" required>
<input type="hidden" class="form-control" name="channel_id" id="channel_id" value="<?php echo $channel_id; ?>" required>
</div><!-- input-group -->

<div class="box-footer">
<button type="submit" class="btn btn-info pull-left update_service">Update Channel</button>
</div><!-- /.box-footer -->

 </div><!-- col -->
</div><!-- row -->


</form>
<!-- end edit form -->
<?php
  }
}
?>

</div><!-- /.tblpagination -->


        <!-- your content ends here -->
      </div><!-- az-content-body -->
      <div class="az-footer">
      <?php
      require_once "footer.php";
      ?>
      </div><!-- az-footer -->
    </div><!-- az-content -->

    <!--For autocomplete to work-->
    <!--<script src="../assets_v2/lib/jquery/jquery.min.js"></script>-->
    <script src="../assets/js/jQuery-2.1.4.min.js"></script>
    <script src="../assets/js/jquery-ui.js"></script>
    <script src="../assets_v2/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets_v2/lib/ionicons/ionicons.js"></script>
    <script src="../assets_v2/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../assets_v2/js/azia.js"></script>
    <script src="../assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Page script -->
    <script src="../assets_v2/js/functions.js"></script>
    <script src="../assets/js/superuser_timeout.js"></script>
    <script>
      $(function(){
        'use strict'

        $('.az-sidebar .with-sub').on('click', function(e){
          e.preventDefault();
          $(this).parent().toggleClass('show');
          $(this).parent().siblings().removeClass('show');
        })

        $(document).on('click touchstart', function(e){
          e.stopPropagation();

          // closing of sidebar menu when clicking outside of it
          if(!$(e.target).closest('.az-header-menu-icon').length) {
            var sidebarTarg = $(e.target).closest('.az-sidebar').length;
            if(!sidebarTarg) {
              $('body').removeClass('az-sidebar-show');
            }
          }
        });


        $('#azSidebarToggle').on('click', function(e){
          e.preventDefault();

          if(window.matchMedia('(min-width: 992px)').matches) {
            $('body').toggleClass('az-sidebar-hide');
          } else {
            $('body').toggleClass('az-sidebar-show');
          }
        });

        new PerfectScrollbar('.az-sidebar-body', {
          suppressScrollX: true
        });

        // Toggle Switches
        $(document).on('click', '.az-toggle', function(event){
            $(this).toggleClass('on');
        });

      });

/* Add Service */
$(document).on('click', 'button.create_service', function(event){
    event.preventDefault();
    var channel_name = $('input#channel_name').val();

    if ( (channel_name == '') || (channel_name == ' ')) {
        alert('Please enter Channel name');
        return false;
    }
    var doService = document.getElementById('add_service_form');

    var loading = $('<div id="loading" style="display: none;margin: 0 auto;position: absolute;left: 45%;top: 42%;width: 70px;padding: 10px;"><img src="../assets/img/double_ring.gif" alt="Loading..." style="width: 50px;"></div>').insertBefore('div.tblpagination');
    loading.show();
    $('div#status').html('');
    $.ajax({
        type: 'POST',
        url: 'do_create_channel.php',
        dataType: 'json',
        data: new FormData(doService),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
        $("html, body, #add_service_form").animate({ scrollTop: 0 }, 1200);
    },
    success: function(msg){
        var status = msg.status;
        var response = msg.data;
        if(status == 'OK'){
        var service_id = msg.id;
            $('div#status').html(response);
            $("#add_service_form")[0].reset();
        }if(status == 'ERROR'){
            $('div#status').html(response);
        }
        loading.remove();
    },
    error: function(jqXHR, textStatus, errorThrown){
        loading.remove();
        alert('Sorry, but an error occurred: '+textStatus+' ('+errorThrown+')');
    }
    });
});
/* Add Service */


/* Edit Service */
$(document).on('click', 'button.update_service', function(event){
    event.preventDefault();
    var channel_name = $('input#channel_name').val();
    var channel_id = $('input#channel_id').val();

    if ( (channel_name == '') || (channel_name == ' ')) {
        alert('Please enter Channel name');
        return false;
    }
    if ( (channel_id == '') || (channel_id == ' ')) {
        alert('Please enter Channel ID');
        return false;
    }
    var doService = document.getElementById('edit_service_form');

    var loading = $('<div id="loading" style="display: none;margin: 0 auto;position: absolute;left: 45%;top: 42%;width: 70px;padding: 10px;"><img src="../assets/img/double_ring.gif" alt="Loading..." style="width: 50px;"></div>').insertBefore('div.tblpagination');
    loading.show();
    $('div#status').html('');
    $.ajax({
        type: 'POST',
        url: 'do_edit_channel.php',
        dataType: 'json',
        data: new FormData(doService),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
        $("html, body, #edit_service_form").animate({ scrollTop: 0 }, 1200);
    },
    success: function(msg){
        var status = msg.status;
        var response = msg.data;
        if(status == 'OK'){
            var service_id = msg.id;
            $('div#status').html(response);
        }if(status == 'ERROR'){
            $('div#status').html(response);
        }
        loading.remove();
    },
    error: function(jqXHR, textStatus, errorThrown){
        loading.remove();
        alert('Sorry, but an error occurred: '+textStatus+' ('+errorThrown+')');
    }
    });
});
/* Edit Service */

$(document).on('click', '.az-toggle', function(event){

var channel_id = '<?php echo (int)$_GET['channel_id']; ?>';
var link_toggle_status = $(this).attr('link_toggle_status');
var toggle_attr = $(this);

if (link_toggle_status == 'active') {
    var toggle = "off";
}
if (link_toggle_status == 'inactive') {
    var toggle = "on";
}
//alert(link_toggle_status+" ->"+toggle);

if ( (channel_id.length > 0) ) {
    $.ajax({
    type: 'POST',
    url: 'toggle_channel.php?channel_id='+channel_id+"&deliver="+toggle,
    dataType: 'json',
    data: '',
    contentType: false,
    cache: false,
    processData:false,
    beforeSend: function(){
    //$("html, body, #edit_service_form").animate({ scrollTop: 0 }, 1200);
    },
    success: function(msg){
        var status = msg.status;
        var response = msg.data;
        if(status == 'OK'){
            if (deliver_status == 'on') {
                toggle_attr.attr('deliver', 'off');
            }
            if (deliver_status == 'off') {
                toggle_attr.attr('deliver', 'on');
            }
        }if(status == 'ERROR'){
            alert(response);
            if (toggle_attr.hasClass('off')) {
                toggle_attr.addClass('on');
            }else {
                toggle_attr.removeClass('on'); 
            }
        }
    },
    error: function(jqXHR, textStatus, errorThrown){
        alert('Sorry, but an error occurred: '+textStatus+' ('+errorThrown+')');
    }
    });
}
});

    </script>
  </body>
</html>