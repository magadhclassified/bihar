<?php

session_start();

if(!isset($_SESSION['Admin_Logged_In']) ||  $_SESSION['Admin_Logged_In'] != "YES"){
	echo "Restricted access.";
	exit();
}

include '../../../config.php';
include 'conn.php';
include 'functions.php';

$is_caller = true;
include 'my_info.php';
if(!check_perms('banners', $account_permissions)){die('Unauthorised access.');}

$action = $_GET['action'];
if(isset($_GET['id'])){$id = (int)$_GET['id'];}
if(isset($_GET['data'])){$data = $_GET['data'];}

// Deletion
if($action == 'delete'){
	
	$sql = mysql_query("select image_file from banners where id = '$id'");
	$res = mysql_fetch_assoc($sql);
	$image_file = $res['image_file'];
	if(!empty($image_file)){
	unlink('../../../files/promo/original/'.$image_file);
	unlink('../../../files/promo/'.$image_file);}

	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'DELETE', 'Content - Banners', 'banners', " . $id . ")");
		
	mysql_query('DELETE FROM banners WHERE id = ' . $id);
	mysql_query('DELETE FROM banners_details WHERE banner_id = ' . $id);
		
}

// Status
if($action == 'activate'){
	
	mysql_query('UPDATE banners SET status = 1 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Content - Banners', 'banners', " . $id . ")");
		
}else if($action == 'deactivate'){
	
	mysql_query('UPDATE banners SET status = 0 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Content - Banners', 'banners', " . $id . ")");
		
}

header('Location: ../../banners');

?>