<?php

session_start();

if(!isset($_SESSION['Admin_Logged_In']) ||  $_SESSION['Admin_Logged_In'] != "YES"){
	echo "Restricted access.";
	exit();
}

include '../../../config.php';
date_default_timezone_set(TIME_ZONE);
include 'conn.php';
include 'functions.php';
include 'class.upload.php';

$is_caller = true;
include 'my_info.php';
if(!check_perms('banners', $account_permissions)){die('Unauthorised access.');}

$id = (int)$_POST['id'];
$title = $_POST['title'];
$zone = $_POST['zone'];
$link = $_POST['link'];
$filename1 = $_POST['oldimg1'];
$code = $_POST['code'];
$fdate = $_POST['fdate'];
$tdate = $_POST['tdate'];

$tdate = strtotime($tdate . ' 23:59:59');
$fdate = strtotime($fdate . ' 00:00:01');

if(isset($_POST['active'])){$status = 1;}else{$status=0;}

if(isset($_POST['pages'])){
	$pages = $_POST['pages'];
}else{
	$pages = array();
}

// ---------------------------------------------------------------------------------------------------------------

if($_FILES['frm_upload1']['size'] > 0){
	$handle = new Upload($_FILES['frm_upload1']);
	if ($handle->uploaded && $handle->file_is_image) {
		$handle->Process('../../../files/promo/original/');
		if ($handle->processed) {
			$filename1 = $handle->file_dst_name;
		}else{
			echo 'Error: ' . $handle->error . '';
			exit();
		}
		$handle-> Clean();
		
		// Resize
		$handle = new Upload('../../../files/promo/original/' . $filename1);
		if ($handle->uploaded) {
			$handle->image_resize = true;
			$handle->image_x = 293;
			$handle->image_ratio_y = true;
			$handle->jpeg_quality = 100;
			$handle->Process('../../../files/promo/');
			if ($handle->processed) {
			}else{
				echo 'Error: ' . $handle->error . '';
				exit();
			}
		}
	}else{
		$_SESSION['FormAction'] = 'ERROR';
	}
}

// ---------------------------------------------------------------------------------------------------------------

if($id > 0){
	
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'EDIT', 'Content - Banners', 'banners', " . $id . ")");
		
		$sqlquery = mysql_query(sprintf("UPDATE banners SET title='%s', image_file='%s', image_link='%s', banner_code='%s', date_edited=%d, date_from=%d, date_to=%d, status=%d WHERE id = %d",
					mysql_real_escape_string($title),
					mysql_real_escape_string($filename1),
					mysql_real_escape_string($link),
					$code,
					mysql_real_escape_string(time()),
					mysql_real_escape_string($fdate),
					mysql_real_escape_string($tdate),
					mysql_real_escape_string($status),
					mysql_real_escape_string($id)
					)) or die(mysql_error());
					echo $sqlquery;
		mysql_query(sprintf("DELETE FROM banners_details WHERE banner_id = %d", mysql_real_escape_string($id)));

		foreach($pages as $s){
			$sqlquery = mysql_query(sprintf("INSERT INTO banners_details(banner_id, zone_id, page_id) VALUES(%d, %d, %d)",
						mysql_real_escape_string($id),
						mysql_real_escape_string($zone),
						mysql_real_escape_string($s)
						));
		}

}else{
	
	$sqlquery = mysql_query(sprintf("INSERT INTO banners(title, image_file, image_link, banner_code, date_created, date_edited, date_from, date_to, status) VALUES('%s', '%s', '%s', '%s', %d, %d, %d, %d, %d)",
				mysql_real_escape_string($title),
				mysql_real_escape_string($filename1),
				mysql_real_escape_string($link),
				$code,
				mysql_real_escape_string(time()),
				mysql_real_escape_string(time()),
				mysql_real_escape_string($fdate),
				mysql_real_escape_string($tdate),
				mysql_real_escape_string($status)
				)) or die(mysql_error());
	
	$document_id = mysql_insert_id();
	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'ADD', 'Content - banners', 'Banners', " . $document_id . ")");
		
	foreach($pages as $s){
		$sqlquery = mysql_query(sprintf("INSERT INTO banners_details(banner_id, zone_id, page_id) VALUES(%d, %d, %d)",
					mysql_real_escape_string($document_id),
					mysql_real_escape_string($zone),
					mysql_real_escape_string($s)
					));
	}
		
}

header('Location: ../../banners');

?>