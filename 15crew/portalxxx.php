<?php

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 ? "https://" : "http://";
$mi6 = $HTTP_PROTOCOL . $SERVER_HOST . "/"."stash";
//$mi6 = $protocol . $SERVER_HOST;

$site_url_full = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'];
$site_current_url_full = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//parse url
$i_site_url_full = parse_url($site_url_full);
$site_url_full = $i_site_url_full['scheme'] . "://" . $i_site_url_full['host'];

$i_site_current_url_full = parse_url($site_current_url_full);
$site_current_url_full = $i_site_current_url_full['scheme'] . "://" . $i_site_current_url_full['host'] . $i_site_current_url_full['path'];

define("SITEFULLURL", "$site_url_full");
define("SITECURRENTFULLURL", "$site_current_url_full");

echo "mi6: ".$mi6;

echo "\n";

echo "site_url_full: ".$site_url_full;

echo "\n";

echo "site_current_url_full: ".$site_current_url_full;

$ty = explode('/')


//phpinfo();
?>