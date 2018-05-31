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
if(!check_perms('gallery', $account_permissions)){die('Unauthorised access.');}

$id = (int)$_POST['id'];
$title = $_POST['title'];
$date = $_POST['date'];
$filename = $_POST['oldimg'];
$album = $_POST['cat'];
if(isset($_POST['active'])){$status = 1;}else{$status=0;}

$date = strtotime($date);

// ---------------------------------------------------------------------------------------------------------------

if($_FILES['frm_upload']['size'] > 0){

	// ******************* ORIGINAL
	$handle = new Upload($_FILES['frm_upload']);
	if ($handle->uploaded && $handle->file_is_image) {
		$handle->Process('../../../files/gallery/original/');
		if ($handle->processed) {
			$filename = $handle->file_dst_name;
		}else{
			echo 'Error: ' . $handle->error . '';
			exit();
		}
		$handle-> Clean();
		
		// ******************* THUMB
		$handle = new Upload('../../../files/gallery/original/' . $filename);
		if ($handle->uploaded) {
			$handle->image_resize = true;
			$handle->image_x = 140;
			$handle->image_y = 67;
			$handle->image_ratio_crop = true;
			$handle->jpeg_quality = 100;
			$handle->Process('../../../files/gallery/thumb/');
			if ($handle->processed) {
			}else{
				echo 'Error: ' . $handle->error . '';
			}
		}
		
		// ******************* LARGE (gallery slider)
		$handle = new Upload('../../../files/gallery/original/' . $filename);
		if ($handle->uploaded) {
		
			if($handle->image_src_x > 640){
				$handle->image_resize = true;
				$handle->image_x = 610;
				$handle->image_y = 290;
				$handle->image_ratio_crop = true;
				$handle->jpeg_quality = 100;
			}
			$handle->Process('../../../files/gallery/large/');
			if ($handle->processed) {
			}else{
				echo 'Error: ' . $handle->error . '';
			}
		}
		
	}else{
		$_SESSION['FormAction'] = 'ERROR';
	}

}

// Do not allow blank image uploads
if(strlen($filename) == 0){
	$_SESSION['FormAction'] = 'ERROR';
	header('Location: ../../gallery');
	exit();
}

// ---------------------------------------------------------------------------------------------------------------

if($id > 0){
	
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'EDIT', 'Content - Gallery', 'gallery', " . $id . ")");
		
		$sqlquery = mysql_query(sprintf("UPDATE gallery SET title='%s', date_created=%d, img_url='%s', status=%d, album_id=%d WHERE id = %d",
				mysql_real_escape_string($title),
				mysql_real_escape_string($date),
				mysql_real_escape_string($filename),
				mysql_real_escape_string($status),
				mysql_real_escape_string($album),
				mysql_real_escape_string($id)
				));

}else{
	
	$sqlquery = mysql_query(sprintf("INSERT INTO gallery(title, date_created, status, img_url, album_id) VALUES('%s', %d, %d, '%s', %d)",
				mysql_real_escape_string($title),
				mysql_real_escape_string($date),
				mysql_real_escape_string($status),
				mysql_real_escape_string($filename),
				mysql_real_escape_string($album)
				));
	
	$document_id = mysql_insert_id();
	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'ADD', 'Content - Gallery', 'gallery', " . $document_id . ")");
		
}

header('Location: ../../gallery');

?>