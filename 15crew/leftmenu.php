<?php
//$level = LEVEL;
$currentfile = $_SERVER['SCRIPT_NAME'];
$currentfile = explode('/', $currentfile);
$currentfile = end($currentfile);
$CLIZ = $CLI = $CLIA = $CLIB = $CLIC = $CLID = $CLIE = $CLIV = $CLIZ = $CLIH = $CLIG = $CLIF = "";

$leftmenu = "<div class='az-sidebar-header'>
        <a href='#' class='az-logo'>CManager</a>
      </div><!-- az-sidebar-header -->
      <div class='az-sidebar-loggedin'>
        <div class='az-img-user online'><img src='$pic' alt=''></div>
        <div class='media-body'>
          <h6>$name</h6>
          <span>Mr Stash</span>
        </div><!-- media-body -->
      </div><!-- az-sidebar-loggedin -->

      <div class='az-sidebar-body'>
      <ul class='nav'>
          <li class='nav-label'>Main Menu</li>";

$vcs = "
<li class='nav-item $CLIG'><a href='portal.php' class='nav-link'><i class='icon ion-ios-person'></i>Manage Channels</a></li>

<li class='nav-item $CLIV'><a href='messages.php' class='nav-link'><i class='icon ion-md-paper-plane'></i>Send Messages</a></li>

";

$leftmenu .= "
$vcs

<li class='nav-label menu-batch'></li>

<li class='nav-item $CLIF'>
  <a href='' class='nav-link with-sub'><i class='icon ion-ios-person'></i>Manage Profile</a>
  <nav class='nav-sub'>
    <a href='pname.php' class='nav-sub-link'>Profile Name</a>
    <a href='pemail.php' class='nav-sub-link'>Email</a>
    <a href='ppassword.php' class='nav-sub-link'>Password</a>
  </nav>
</li><!-- nav-item -->

<li class='nav-item $CLI'><a href='logout.php' class='nav-link'><i class='icon ion-ios-power'></i>Log Out</a></li>

</ul><!-- nav -->
      </div><!-- az-sidebar-body -->";
echo $leftmenu;
?>