<?php
require_once "../includes/main.php";
authsuperuser();
$name = NAME;
$email = EMAIL;
$confirmcode = CONFIRMCODE;

$pic = "$mi6/assets/img/icon.jpg";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>::: Community Manager :::</title>
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
    .cs-mg-b-10 {
      margin-bottom: 10px;
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
            <h2 class="az-content-title mg-b-5 mg-b-lg-8">Manage Channels</h2>
          </div>
        </div><!-- az-content-body-title -->

      </div><!-- az-content-header -->
      <div class="az-content-body">
        <!-- your content starts here -->

<?php
$adjacents = 10;
$pager = "";
$query = "SELECT COUNT(*) as num FROM cm_channel";
$targetpage = $_SERVER['PHP_SELF'];
$limit = 50;
if (isset($_GET['page'])) {
	$page = (int)$_GET['page'];
	$start = ($page - 1) * $limit;
} else {
	$start = 0;
}

$sql = "SELECT * FROM cm_channel ORDER BY id DESC LIMIT $start, $limit";

$total_pages = mysqli_fetch_array(mysqli_query($conn, $query));
$total_pages = $total_pages['num'];
$result = mysqli_query($conn, $sql);
?>

<div id="allcontent" class="col-md-12" style="contain: content;max-width: 100%;background-color: #fff;">

<br>
<a href="create_channel.php" class="btn btn-info"> Create Channel </a>
&nbsp;&nbsp;
<br><br>
<div class="col-md-6">
<div class="tblpagination">

<?php
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

  $addbtn = "";
  $editbtn = "";
  $deletebtn = "";

  $addbtn = "<a class='' href='add_recipient.php?channel_id=$channel_id'><button class='btn btn-mini btn-success btn-table'>Add Recipient</button></a> ";

  $editbtn = "<a class='' href='create_channel.php?channel_id=$channel_id'><button class='btn btn-mini btn-info btn-table'>Edit Channel</button></a> ";

  $deletebtn = "<button class='btn btn-mini btn-danger btn-table do_del' title='Delete Channel' data-id='$channel_id' id='btn_$channel_id'>Delete Channel</button>";

  $created = date("Y-m-d @ H:i", $created);
  $updated = date("Y-m-d @ H:i", $updated);

  $DB_data .= "<tr class='lectbody' id='$channel_id'>
  <td>$channel_name</td>
  <td>$addbtn $editbtn $deletebtn</td>
  </tr>";
}
$DB_data .= "</tbody></table><br>";
mysqli_free_result($result);
mysqli_close($conn);
echo $DB_data;
echo $pagination;
?>


</div><!-- /.tblpagination -->
</div><!-- /.col-md-6 -->

</div><!-- /.allcontent -->


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

      });

      var loading = $('<div id="loading" style="display: none;margin: 0 auto;position: fixed;margin-left: -60px;"><img src="../assets/img/double_ring.gif" alt="<?php echo $lang["Loading"]; ?>" style="width: 100px;"></div>').insertBefore('div.tblpagination');

      $(document).ready(function() {

        $(document).on('click', '.do_del', function(event){
          var del_id = $(this).attr('data-id');
          var rmx = confirm("Delete Channel");
          if (rmx == true) {
              $.get('del_channel.php?id='+del_id, function(data) {
                if (data == 'SESSIONEXPIRED') {
                  window.location.href = 'logout.php';
                }
                if (data == "OK") {
                  $('tr#'+del_id).slideUp(600);
                  setTimeout(function(){ $('tr#'+del_id).remove(); }, 600);
                }
                if (data == "DBERROR") {
                  alert('<?php echo $lang["Error Deleting Channel..."];?>');
                }
              });
          } else {
              return false;
          }
        });

        function ActionI() {
          $('a.popup-webcam').magnificPopup({
          disableOn: 0,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false
          });

          $('a.popup-edit').magnificPopup({
          disableOn: 0,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false
          });
        }
        ActionI();

        $(document).on('click', 'div.pagination a', function(event){
          event.preventDefault();
          loading.show();
          var goto = $(this).attr('href').split('?');
          $.get('ajax_portal.php?'+goto[1],  function(data) {
            $('div.tblpagination').html(data);
              if (data == 'SESSIONEXPIRED') {
              window.location.href = 'logout.php';
            }
            loading.hide();
            ActionI();
            }).fail(function(jqXHR) {
              loading.hide();
              $('div.tblpagination').html('<?php echo $lang["Sorry, but an error occurred:"];?> ' + jqXHR.status).append(jqXHR.responseText);
          });
        });
      });
    </script>
  </body>
</html>
