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
if(!check_perms('properties', $account_permissions)){die('Unauthorised access.');}

$action = $_GET['action'];
if(isset($_GET['id'])){$id = (int)$_GET['id'];}
if(isset($_GET['data'])){$data = $_GET['data'];}

// Deletion
if($action == 'delete'){
	$sql = mysql_query("select img1,img2,img3,img4 from properties where id = '$id'");
	$res = mysql_fetch_assoc($sql);
	$img1 = $res['img1'];
	$img2 = $res['img2'];
	$img3 = $res['img3'];
	$img4 = $res['img4'];
	
	if(!empty($img1)) {
	unlink('../../../files/property/featured/'.$img1);
	unlink('../../../files/property/fp/'.$img1);
	unlink('../../../files/property/thumb/'.$img1);
	unlink('../../../files/property/small/'.$img1);
	unlink('../../../files/property/promo/'.$img1);
	unlink('../../../files/property/original/'.$img1);
	unlink('../../../files/property/medium/'.$img1); }
	if(!empty($img2)) {
	unlink('../../../files/property/featured/'.$img2);
	unlink('../../../files/property/fp/'.$img2);
	unlink('../../../files/property/thumb/'.$img2);
	unlink('../../../files/property/small/'.$img2);
	unlink('../../../files/property/promo/'.$img2);
	unlink('../../../files/property/original/'.$img2);
	unlink('../../../files/property/medium/'.$img2); }
	if(!empty($img3)) {
	unlink('../../../files/property/featured/'.$img3);
	unlink('../../../files/property/fp/'.$img3);
	unlink('../../../files/property/thumb/'.$img3);
	unlink('../../../files/property/small/'.$img3);
	unlink('../../../files/property/promo/'.$img3);
	unlink('../../../files/property/original/'.$img3);
	unlink('../../../files/property/medium/'.$img3); }
	if(!empty($img4)) {
	unlink('../../../files/property/featured/'.$img4);
	unlink('../../../files/property/fp/'.$img4);
	unlink('../../../files/property/thumb/'.$img4);
	unlink('../../../files/property/small/'.$img4);
	unlink('../../../files/property/promo/'.$img4);
	unlink('../../../files/property/original/'.$img4);
	unlink('../../../files/property/medium/'.$img4); }
	
	

	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'DELETE', 'Listings - Properties', 'properties', " . $id . ")");
		
	mysql_query('DELETE FROM properties WHERE id = ' . $id);
	mysql_query('DELETE FROM properties_amenities_details WHERE property_id = ' . $id);
	mysql_query('DELETE FROM properties_views_details WHERE property_id = ' . $id);
		
}

// Status
if($action == 'activate'){
	
	mysql_query('UPDATE properties SET status = 1 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Listings - Properties', 'properties', " . $id . ")");
		
}else if($action == 'deactivate'){
	
	mysql_query('UPDATE properties SET status = 0 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Listings - Properties', 'properties', " . $id . ")");
		
}

header('Location: ../../properties');

?>