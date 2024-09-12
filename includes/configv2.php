<?php
date_default_timezone_set('GMT');
/*
//db localhost
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "password";
$dbname = "maxam";

FTP inloggegevens:
Host: offerte.maxamgaragepoorten.be
Username: offerte@offerte.maxamgaragepoorten.be
Password: bVW53pzqNe

$dbhost = "localhost";
$dbuser = "maxamgarag_offerteusr";
$dbpass = "xK5vSBnPpM";
$dbname = "maxamgarag_offertedb";
*/
//db online
$dbhost = "localhost";
$dbuser = "maxamoffer_liveusr";
$dbpass = "lh84YuxET";
$dbname = "maxamoffer_offertelive";


$ftp_server = "ftp.xantrosremote.nl";
$ftp_user_name = "acc322849";
$ftp_user_pass = "zk6JGSUA8Q";
/**********Encrypt and save in a file, then load file, decrypt and use ************/

$smtp_host = "";
$site_email = "info@maxamgaragepoorten.be";// info@garagepoorten-maxam.be to info@maxamgaragepoorten.be
$site_password = "";
$site_port = 465;
$smtp_data = array("host"=>$smtp_host,"username"=>$site_email,"password"=>$site_password,"port"=>$site_port);

$service_icon_width = 150;
$service_icon_height = 150;
$valid_image_formats = array("jpg", "png", "jpeg");

define("COMMISSION", "10");

$default_lang = "en_GB"; // en_GB | nl_NL | fr_FR
?>
