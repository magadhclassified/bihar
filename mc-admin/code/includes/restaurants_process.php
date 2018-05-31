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
if(!check_perms('restaurants', $account_permissions)){die('Unauthorised access.');}

$action = $_GET['action'];
if(isset($_GET['id'])){$id = (int)$_GET['id'];}
if(isset($_GET['data'])){$data = $_GET['data'];}

// Deletion
if($action == 'delete'){
	$sql = mysql_query("select img1,img2,img3,img4 from restaurants where id = '$id'");
	$res = mysql_fetch_assoc($sql);
	$img1 = $res['img1'];
	$img2 = $res['img2'];
	$img3 = $res['img3'];
	$img4 = $res['img4'];
	
	
	if(!empty($img1)) {
	unlink('../../../files/restaurants/featured/'.$img1);
	unlink('../../../files/restaurants/fp/'.$img1);
	unlink('../../../files/restaurants/thumb/'.$img1);
	unlink('../../../files/restaurants/small/'.$img1);
	unlink('../../../files/restaurants/promo/'.$img1);
	unlink('../../../files/restaurants/original/'.$img1);
	unlink('../../../files/restaurants/medium/'.$img1); }
	if(!empty($img2)) {
	unlink('../../../files/restaurants/featured/'.$img2);
	unlink('../../../files/restaurants/fp/'.$img2);
	unlink('../../../files/restaurants/thumb/'.$img2);
	unlink('../../../files/restaurants/small/'.$img2);
	unlink('../../../files/restaurants/promo/'.$img2);
	unlink('../../../files/restaurants/original/'.$img2);
	unlink('../../../files/restaurants/medium/'.$img2); }
	if(!empty($img3)) {
	unlink('../../../files/restaurants/featured/'.$img3);
	unlink('../../../files/restaurants/fp/'.$img3);
	unlink('../../../files/restaurants/thumb/'.$img3);
	unlink('../../../files/restaurants/small/'.$img3);
	unlink('../../../files/restaurants/promo/'.$img3);
	unlink('../../../files/restaurants/original/'.$img3);
	unlink('../../../files/restaurants/medium/'.$img3); }
	if(!empty($img4)) {
	unlink('../../../files/restaurants/featured/'.$img4);
	unlink('../../../files/restaurants/fp/'.$img4);
	unlink('../../../files/restaurants/thumb/'.$img4);
	unlink('../../../files/restaurants/small/'.$img4);
	unlink('../../../files/restaurants/promo/'.$img4);
	unlink('../../../files/restaurants/original/'.$img4);
	unlink('../../../files/restaurants/medium/'.$img4); }
	
	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'DELETE', 'Listings - Restaurants', 'restaurants', " . $id . ")");
		
	mysql_query('DELETE FROM restaurants WHERE id = ' . $id);
	mysql_query('DELETE FROM restaurants_cuisines_details WHERE restaurant_id = ' . $id);
		
}

// Status
if($action == 'activate'){
	
	mysql_query('UPDATE restaurants SET status = 1 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Listings - Restaurants', 'restaurants', " . $id . ")");
		
}else if($action == 'deactivate'){
	
	mysql_query('UPDATE restaurants SET status = 0 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Listings - Restaurants', 'restaurants', " . $id . ")");
		
}

header('Location: ../../restaurants');

?>