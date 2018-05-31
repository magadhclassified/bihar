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
if(!check_perms('categories', $account_permissions)){die('Unauthorised access.');}

$id = (int)$_POST['id'];
$title = $_POST['title'];
$banner_top = $_POST['b1'];
$banner_rhs = $_POST['b2'];
$contents = $_POST['elm1'];
$filename = $_POST['oldimg'];
if(isset($_POST['active'])){$status = 1;}else{$status=0;}

// ---------------------------------------------------------------------------------------------------------------

if($_FILES['frm_upload']['size'] > 0){

	// ******************* ORIGINAL
	$handle = new Upload($_FILES['frm_upload']);
	if ($handle->uploaded && $handle->file_is_image) {
		$handle->Process('../../../files/categories/original/');
		if ($handle->processed) {
			$filename = $handle->file_dst_name;
		}else{
			echo 'Error: ' . $handle->error . '';
			exit();
		}
		$handle-> Clean();
		
		// ******************* THUMB
		$handle = new Upload('../../../files/categories/original/' . $filename);
		if ($handle->uploaded) {
			$handle->image_resize = true;
			$handle->image_x = 111;
			$handle->image_y = 80;
			$handle->image_ratio_crop = true;
			$handle->jpeg_quality = 100;
			$handle->Process('../../../files/categories/');
			if ($handle->processed) {
			}else{
				echo 'Error: ' . $handle->error . '';
			}
		}
		
	}else{
		$_SESSION['FormAction'] = 'ERROR';
	}

}

// ---------------------------------------------------------------------------------------------------------------

if($id > 0){
	
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'EDIT', 'Awards - Categories', 'categories', " . $id . ")");
		
		$sqlquery = mysql_query(sprintf("UPDATE categories SET title='%s', img1='%s', banner_top='%s', banner_rhs='%s', contents='%s', date_edited=%d WHERE id = %d",
				mysql_real_escape_string($title),
				mysql_real_escape_string($filename),
				mysql_real_escape_string($banner_top),
				mysql_real_escape_string($banner_rhs),
				mysql_real_escape_string($contents),
				mysql_real_escape_string(time()),
				mysql_real_escape_string($id)
				));

}else{
	
	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	// Get next ordering value
	$sqlquery = mysql_query('SELECT MAX(ordering) max_or FROM categories');
	while($row = mysql_fetch_array($sqlquery)){ 
		$ordering = $row['max_or'];
	}
	if(is_null($ordering)){
		$ordering = 0;
	}
	$ordering++;

	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	$sqlquery = mysql_query(sprintf("INSERT INTO categories(title, img1, banner_top, banner_rhs, contents, ordering, date_created, date_edited, status) VALUES('%s', '%s', '%s', '%s', '%s', %d, %d, %d, %d)",
				mysql_real_escape_string($title),
				mysql_real_escape_string($filename),
				mysql_real_escape_string($banner_top),
				mysql_real_escape_string($banner_rhs),
				mysql_real_escape_string($contents),
				mysql_real_escape_string($ordering),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(1)
				));
	
	$document_id = mysql_insert_id();
	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'ADD', 'Awards - Categories', 'categories', " . $document_id . ")");
		
}

header('Location: ../../categories');

?>