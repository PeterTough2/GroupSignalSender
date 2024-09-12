<?php
//<a href="app-chat.html"><i class="typcn typcn-messages"></i></a>
$fvb = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $fvb = $_SERVER['QUERY_STRING']."&";
}
$fvb = SITECURRENTFULLURL;

$topmenu = "
<div class='az-header az-header-dashboard-nine'>
        <div class='container-fluid'>
          <div class='az-header-left'>
            <a href='' id='azSidebarToggle' class='az-header-menu-icon'><span></span></a>
          </div><!-- az-header-left -->


          <div class='az-header-right'>

          <div class='az-header-message'>


          </div><!-- az-header-message -->

            <div class='dropdown az-profile-menu'>
              <a href='' class='az-img-user'><img src='$pic' alt=''></a>
              <div class='dropdown-menu'>
                <div class='az-dropdown-header d-sm-none'>
                  <a href='' class='az-header-arrow'><i class='icon ion-md-arrow-back'></i></a>
                </div>
                <div class='az-header-profile'>
                  <div class='az-img-user'>
                    <img src='$pic' alt=''>
                  </div><!-- az-img-user -->
                  <h6>$name</h6>
                  <span>Community Manager</span>
                </div><!-- az-header-profile -->
                <a href='logout.php' class='dropdown-item'><i class='typcn typcn-power-outline'></i> ".$lang["Log Out"] ."</a>
              </div><!-- dropdown-menu -->
            </div>
          </div><!-- az-header-right -->
        </div><!-- container -->
        </div><!-- az-header -->";
echo $topmenu;
?>