<?php

echo "Here";
function unzipmyfile($file,$location){
	$zip = new ZipArchive;
	if($zip->open($file)===TRUE){
		$zip->extractTo($location);
		$zip->close();
		return "success";
             }
	else{
		return "fail";
	}
}

//print_r(get_loaded_extensions());

$file= "vendor.zip";//enter zip file location == audio_streamer-2007-05-31.zip,xquote
$location="./";//folder to unzip to
echo unzipmyfile($file,$location);
echo "\n";

?>