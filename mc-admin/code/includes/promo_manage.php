<?php

session_start();

if(!isset($_SESSION['Admin_Logged_In']) ||  $_SESSION['Admin_Logged_In'] != "YES"){
	echo "Restricted access.";
	exit();
}

include '../../../config.php';
include 'conn.php';
include 'functions.php';
include 'class.upload.php';

$is_caller = true;
include 'my_info.php';
if(!check_perms('promo', $account_permissions)){die('Unauthorised access.');}

$filename1 = $_POST['oldimg1'];
$filename2 = $_POST['oldimg2'];
$filename3 = $_POST['oldimg3'];

if(isset($_POST['ppenable'])){$peel = 1;}else{$peel=0;}
if(isset($_POST['bgenable'])){$bg = 1;}else{$bg=0;}

$link = $_POST['pplink'];

// ---------------------------------------------------------------------------------------------------------------

if($_FILES['frm_upload1']['size'] > 0){
	$handle = new Upload($_FILES['frm_upload1']);
	if ($handle->uploaded && $handle->file_is_image) {
		$handle->Process('../../../files/promo/');
		if ($handle->processed) {
			$filename1 = $handle->file_dst_name;
		}else{
			echo 'Error: ' . $handle->error . '';
			exit();
		}
		$handle-> Clean();
	}else{
		$_SESSION['FormAction'] = 'ERROR';
	}
}

if($_FILES['frm_upload2']['size'] > 0){
	$handle = new Upload($_FILES['frm_upload2']);
	if ($handle->uploaded && $handle->file_is_image) {
		$handle->Process('../../../files/promo/');
		if ($handle->processed) {
			$filename2 = $handle->file_dst_name;
		}else{
			echo 'Error: ' . $handle->error . '';
			exit();
		}
		$handle-> Clean();
	}else{
		$_SESSION['FormAction'] = 'ERROR';
	}
}

if($_FILES['frm_upload3']['size'] > 0){
	$handle = new Upload($_FILES['frm_upload3']);
	if ($handle->uploaded && $handle->file_is_image) {
		$handle->Process('../../../files/promo/');
		if ($handle->processed) {
			$filename3 = $handle->file_dst_name;
		}else{
			echo 'Error: ' . $handle->error . '';
			exit();
		}
		$handle-> Clean();
	}else{
		$_SESSION['FormAction'] = 'ERROR';
	}
}

// ---------------------------------------------------------------------------------------------------------------

mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'EDIT', 'Content - Banners', 'settings', 1)");
		
$sqlquery = mysql_query(sprintf("UPDATE settings SET peel_enabled=%d, peel_image_thumb='%s', peel_image='%s', peel_link='%s', bg_enabled=%d, bg_image='%s' WHERE id = %d",
			mysql_real_escape_string($peel),
			mysql_real_escape_string($filename1),
			mysql_real_escape_string($filename2),
			mysql_real_escape_string($link),
			mysql_real_escape_string($bg),
			mysql_real_escape_string($filename3),
			mysql_real_escape_string(1)
			));

$_SESSION['FormAction'] = 'OK';
header('Location: ../../promo');

?>