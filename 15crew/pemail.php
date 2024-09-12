<?php
require_once "../includes/main.php";
authsuperuser();
$name = NAME;
$code = CONFIRMCODE;
$admin_number = PHONE;
$pic = "$mi6/assets/img/icon.jpg";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>::: Community Manager - Manage Profile :::</title>
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
            <h2 class="az-content-title mg-b-5 mg-b-lg-8">Manage Profile</h2>
          </div>
        </div><!-- az-content-body-title -->
        
      </div><!-- az-content-header -->
      <div class="az-content-body">
        <!-- your content starts here -->

        <div id="status" style="margin-top: 10px; margin-bottom:10px;"></div>

        <?php
        if ($code < 1) {
        ?>
        <!-- form start -->
        <form class="form-horizontal" action="pemail2.php" onsubmit="superenginex4(); return false" method="post">

          <div class="row row-sm">

            <div class="col-md-8 col-sm-12 form-partition">

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">Current Phone</span>
                </div>
                <input type="email" class="form-control" name="phone" value="<?php echo $admin_number; ?>" readonly autocomplete="off" aria-describedby="basic-addon1" required>
              </div><!-- input-group -->

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">Current Email</span>
                </div>
                <input type="email" class="form-control" name="email1" value="<?php echo $_SESSION['cm_superuser']; ?>" readonly autocomplete="off" aria-describedby="basic-addon1" required>
              </div><!-- input-group -->

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">A confirmation code will be sent to your email, when you click on send request.</span>
                </div>
              </div><!-- input-group -->

              <div class="box-footer">
          <button type="submit" class="btn btn-info pull-left dnt">Send Request</button>
          </div><!-- /.box-footer -->
              
            </div><!-- col -->
          </div><!-- row -->
          

        </form>
        <?php
        }
        ?>
        <?php
        if ($code > 0) {
        ?>
        <!-- form start -->
        <form class="form-horizontal" action="pemail2.php" onsubmit="superenginex4(); return false" method="post">

          <div class="row row-sm">

            <div class="col-md-8 col-sm-12 form-partition">

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">Confirmation Code</span>
                </div>
                <input type="text" class="form-control" name="confirmcode" autocomplete="off" aria-describedby="basic-addon1" required>
              </div><!-- input-group -->

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">New Phone Number</span>
                </div>
                <input type="text" class="form-control" name="phone" placeholder="+2348160361948" autocomplete="off" aria-describedby="basic-addon1" required>
              </div><!-- input-group -->

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">New Email Address</span>
                </div>
                <input type="email" class="form-control" name="email2" autocomplete="off" aria-describedby="basic-addon1" required>
              </div><!-- input-group -->

               <div class="box-footer">
          <button type="submit" class="btn btn-info pull-left dnt">Update Email</button>
          </div><!-- /.box-footer -->
              
            </div><!-- col -->
          </div><!-- row -->     

        </form>
        <?php
        }
        ?>


        <!-- your content ends here -->
      </div><!-- az-content-body -->
      <div class="az-footer">
      <?php
      require_once "footer.php";
      ?>
      </div><!-- az-footer -->
    </div><!-- az-content -->


    <script src="../assets_v2/lib/jquery/jquery.min.js"></script>
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

    </script>
  </body>
</html>