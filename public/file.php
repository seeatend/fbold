<?php
$file = $_GET['file'];
$file_url = $file."&Signature=".$_GET['Signature']."&Expires=".$_GET['Expires'];
$filename="followback-".$_GET['Expires'].".mp4";
if(isset($_GET['Signature'])){
	header('content-type: application/octet-stream');
	header('Content-Type: video/mp4');	
	header('content-Disposition: attachment; filename='.$filename);
	header('Content-Transfer-Encoding: binary');
	header('Pragma: no-cache');
	header('Expires: 0');
	readfile($file_url);
	exit();
} elseif( $_GET['Expires'] >= time() ) {
	
	header('content-type: application/octet-stream');	
	header('content-Disposition: attachment; filename='.$file);
	header('Content-Transfer-Encoding: binary');
	header('Pragma: no-cache');
	header('Expires: 0');
	readfile('http://www.followback.com/bids_images/'.$file);
	exit();
}
?>
