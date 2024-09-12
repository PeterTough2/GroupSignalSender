<?php
require_once "../includes/main.php";
authsuperuser();
$name = NAME;
$pic = "$mi6/assets/img/icon.jpg";
$page_action = "Send Messages";

$channel_list = "";
$SQLi_a = mysqli_query($conn, "SELECT * FROM cm_channel");
while($ix_data = mysqli_fetch_assoc($SQLi_a)) {
    $channel_id = $ix_data['id'];
    $channel_name = $ix_data['channel_name'];
    $created = $ix_data['created'];
    $updated = $ix_data['updated'];

    $channel_list .= "<option value='$channel_id'> $channel_name </option>";
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>::: Community Manager - <?php echo $page_action; ?> :::</title>
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

    <style>
        input.switch {
            height: 0;
            width: 0;
            visibility: hidden;
        }

        label.switch {
            cursor: pointer;
            text-indent: -9999px;
            width: 40px;
            height: 20px;
            background: grey;
            display: block;
            border-radius: 15px;
            position: relative;
            margin-bottom: 10px;
        }

        label:after {
            content: '';
            position: absolute;
            top: 5px;
            left: 5px;
            width: 15px;
            height: 10px;
            background: #fff;
            border-radius: 15px;
            transition: 0.1s;
        }

        input:checked + label.switch {
            background: #2279a4;
        }

        input:checked + label:after {
            left: calc(100% - 5px);
            transform: translateX(-100%);
        }

        label:active:after {
            width: 30px;
        }

        table tbody tr td {
            border: 1px solid #ccc;
        }

        table thead tr th:nth-child(1) {
            text-align: center;
        }

        table tbody tr td:nth-child(1) {
            text-align: center;
        }

        table tbody tr td:nth-child(2) {
            text-align: left;
            padding-left:5px;
        }

        table tbody tr td:nth-child(3) {
            text-align: left;
            padding-left:5px;
        }

        table tbody tr td:nth-child(4) {
            margin-left: 15px;
        }

        table tbody tr:nth-child(even) {
            background: #ccc;
        }

        table tbody tr:nth-child(odd) {
            background: #fff;
        }

        caption {
            caption-side: top;
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 3px;
        }

        .channel_list_data {
            overflow-y:scroll;
            max-height: 400px;
            padding-bottom: 20px;
        }

        .channel_status, .message_status, .channel_list_data {
            display:none;
        }
    </style>

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

    <div class="col-md-5 col-sm-12 form-partition">
        <select name="channel" id="channel" class="form-control">
            <option value="">- Select Channel -</option>
            <?php echo $channel_list; ?>
        </select>

        <div class="channel_status mg-b-20 mg-t-20 text-center">
            <img src="../assets/img/double_ring.gif" alt="Loading..." style="width: 50px;">
        </div>
        <div class="channel_list_data">
            
        

        </div>
    </div><!-- col-md-6 col-sm-12 form-partition -->

    <div class="col-md-6 col-sm-12 form-partition">

        <div class="message_status mg-b-20 mg-t-20 text-center">
            <img src="../assets/img/double_ring.gif" alt="Loading..." style="width: 50px;">
        </div>

        <div class="card">
            <div class="card-body">
                <p class="mg-b-0">
<textarea rows="6" name="message" class="form-control mg-t-20" placeholder="Enter Message" required="">
Pair: SNM/BTC

Entry: 340 - 355 sats

SL: 320 sats 6%

TP: 374 - 442 sats 10 - 30%

Exchange: Binance
</textarea>
                </p>
            </div><!-- card-body -->
            <div class="card-footer bd-t">
                <table cellpadding="5">
                    <tr>
                        <td>SMS <div class='az-toggle az-toggle-success on sms' medium='sms' sms_toggle_status='on'><span></span></div></td>
                        <td>WhatsApp <div class='az-toggle az-toggle-success on whatsapp' medium='whatsapp' whatsapp_toggle_status='on'><span></span></div></td>
                    </tr>
                </table>
            </div><!-- card-footer -->
 
            <button class="btn btn-block btn-primary btn-lg mg-b-20 do_send_msg">Send Message <i class="icon ion-md-paper-plane"></i></button>
        </div>

    </div><!-- col-md-6 col-sm-12 form-partition -->


    </div><!-- /.row row-sm -->
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
    <!--<script src="../assets/js/jquery3.2.1.min.js"></script>-->
    <script src="../assets/js/jquery-ui.js"></script>
    <script src="../assets_v2/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets_v2/lib/ionicons/ionicons.js"></script>
    <script src="../assets_v2/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../assets_v2/js/azia.js"></script>
    <script src="../assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Page script -->
    <script src="../assets_v2/js/functions.js"></script>
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

    $(document).on('click', '.az-toggle', function(event){
        var medium = $(this).attr('medium');
        if (medium == 'sms') {
            var status = $(this).attr('sms_toggle_status');
            if (status == 'on') {
                $(this).attr('sms_toggle_status', 'off');
            }
            if (status == 'off') {
                $(this).attr('sms_toggle_status', 'on');
            }
        }
        if (medium == 'whatsapp') {
            var status = $(this).attr('whatsapp_toggle_status');
            if (status == 'on') {
                $(this).attr('whatsapp_toggle_status', 'off');
            }
            if (status == 'off') {
                $(this).attr('whatsapp_toggle_status', 'on');
            }
        }
        if (medium == 'sub_status') {
            var channel_id = $(this).attr('channel_id');
            var sub_id = $(this).attr('sub_id');
            var deliver_status = $(this).attr('deliver');
            var toggle_attr = $(this);
            if (deliver_status == 'on') {
                var toggle = "off";
            }
            if (deliver_status == 'off') {
                var toggle = "on";
            }

            if ( (channel_id.length > 0) && (sub_id.length) ) {
                $.ajax({
                type: 'POST',
                url: 'toggle_sub.php?channel_id='+channel_id+"&sub_id="+sub_id+"&deliver="+toggle,
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
                            //$(this).attr('deliver', 'on');
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
        }
    });

    /*
    $(document).on('click', 'button.do_send_msg', function(event){
        event.preventDefault();
        $('button.do_send_msg').prop('disabled', true);
        var message = $('textarea[name=message]').val();
        var sms_toggle_status = $('div.sms').attr('sms_toggle_status');
        var whatsapp_toggle_status = $('div.whatsapp').attr('whatsapp_toggle_status');
        var channel_id = $("select#channel option:selected").val();

        if (channel_id.length < 1) {
            alert('Please select channel first');
            return false;
        }

        if (message.length > 150) {
            var tzt = message.length;
            alert('Message cannot exceed 150 characters, '+tzt+' entered');
            return false;
        }

        $('div.message_status').show();
        $.ajax({
            type: 'POST',
            url: 'do_send_message.php?channel_id='+channel_id+"&message="+message+"&sms="+sms_toggle_status+"&whatsapp="+whatsapp_toggle_status,
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
                $('div.message_status').html("<div class='alert alert-success mg-b-5' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success! </strong> " + response + "</div>");
            }if(status == 'ERROR'){
                $('div.message_status').html("<div class='alert alert-danger mg-b-5' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Failed! </strong> " + response + "</div>");
            }
            $('div.message_status').show();
            $('button.do_send_msg').prop('disabled', false);
        },
        error: function(jqXHR, textStatus, errorThrown){
            //$('div.message_status').hide();
            $('button.do_send_msg').prop('disabled', false);
            alert('Sorry, but an error occurred: '+textStatus+' ('+errorThrown+')');
        }
        });
    });
    */

    $(document).on('click', 'button.do_send_msg', function(event){
        event.preventDefault();
        $('button.do_send_msg').prop('disabled', true);
        var message = $('textarea[name=message]').val();
        var sms_toggle_status = $('div.sms').attr('sms_toggle_status');
        var whatsapp_toggle_status = $('div.whatsapp').attr('whatsapp_toggle_status');
        var channel_id = $("select#channel option:selected").val();

        if (channel_id.length < 1) {
            alert('Please select channel first');
            return false;
        }

        if (message.length > 150) {
            var tzt = message.length;
            alert('Message cannot exceed 150 characters, '+tzt+' entered');
            return false;
        }
        var request_data = {};
        request_data['channel_id'] = channel_id;
        request_data['message'] = message;
        request_data['sms'] = sms_toggle_status;
        request_data['whatsapp'] = whatsapp_toggle_status;

        $('div.message_status').show();
        var request_data = {
            url: 'do_send_message.php',
            method: 'POST',
            data: request_data
        };
        $.ajax({
            url: request_data.url,
            type: request_data.method,
            data: request_data.data,
            dataType: "json"
        }).done(function(jsondata) {
            var status = jsondata.status;
            var response = jsondata.data;
            if (status == 'OK') {
                $('div.message_status').html("<div class='alert alert-success mg-b-5' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success! </strong> " + response + "</div>");
            }
            if (status == 'ERROR') {
                $('div.message_status').html("<div class='alert alert-danger mg-b-5' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Failed! </strong> " + response + "</div>");
            }
            $('div.message_status').show();
            $('button.do_send_msg').prop('disabled', false);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            //$('div.message_status').hide();
            $('button.do_send_msg').prop('disabled', false);
            alert('Sorry, but an error occurred: '+textStatus+' ('+errorThrown+')');
        });
    });    

    $("select#channel").change(function(event) {
        var channel_id = $("select#channel option:selected").val();

        if (channel_id.length < 1) {
            return false;
        }
        $('div.channel_list_data').html('');
        $('div.channel_status').show();
        $.ajax({
            type: 'POST',
            url: 'load_channel_data.php?channel_id='+channel_id,
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
                $('div.channel_list_data').show();
                $('div.channel_list_data').html(response);
            }if(status == 'ERROR'){
                alert(response);
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