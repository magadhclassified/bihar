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
if(!check_perms('accommodation', $account_permissions)){die('Unauthorised access.');}

$action = $_GET['action'];
if(isset($_GET['id'])){$id = (int)$_GET['id'];}
if(isset($_GET['data'])){$data = $_GET['data'];}

// Deletion
if($action == 'delete'){
	
	$sql = mysql_query("select img1,img2,img3,img4 from accommodation where id = '$id'");
	$res = mysql_fetch_assoc($sql);
	$img1 = $res['img1'];
	$img2 = $res['img2'];
	$img3 = $res['img3'];
	$img4 = $res['img4'];
	
	if(!empty($img1)) {
	unlink('../../../files/accommodation/featured/'.$img1);
	unlink('../../../files/accommodation/fp/'.$img1);
	unlink('../../../files/accommodation/thumb/'.$img1);
	unlink('../../../files/accommodation/small/'.$img1);
	unlink('../../../files/accommodation/promo/'.$img1);
	unlink('../../../files/accommodation/original/'.$img1);
	unlink('../../../files/accommodation/medium/'.$img1); }
	if(!empty($img2)) {
	unlink('../../../files/accommodation/featured/'.$img2);
	unlink('../../../files/accommodation/fp/'.$img2);
	unlink('../../../files/accommodation/thumb/'.$img2);
	unlink('../../../files/accommodation/small/'.$img2);
	unlink('../../../files/accommodation/promo/'.$img2);
	unlink('../../../files/accommodation/original/'.$img2);
	unlink('../../../files/accommodation/medium/'.$img2); }
	if(!empty($img3)) {
	unlink('../../../files/accommodation/featured/'.$img3);
	unlink('../../../files/accommodation/fp/'.$img3);
	unlink('../../../files/accommodation/thumb/'.$img3);
	unlink('../../../files/accommodation/small/'.$img3);
	unlink('../../../files/accommodation/promo/'.$img3);
	unlink('../../../files/accommodation/original/'.$img3);
	unlink('../../../files/accommodation/medium/'.$img3); }
	if(!empty($img4)) {
	unlink('../../../files/accommodation/featured/'.$img4);
	unlink('../../../files/accommodation/fp/'.$img4);
	unlink('../../../files/accommodation/thumb/'.$img4);
	unlink('../../../files/accommodation/small/'.$img4);
	unlink('../../../files/accommodation/promo/'.$img4);
	unlink('../../../files/accommodation/original/'.$img4);
	unlink('../../../files/accommodation/medium/'.$img4); }
	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'DELETE', 'Listings - Accommodation', 'accommodation', " . $id . ")");
		
	mysql_query('DELETE FROM accommodation WHERE id = ' . $id);
	mysql_query('DELETE FROM accommodation_facilities_details WHERE accommodation_id = ' . $id);
		
}

// Status
if($action == 'activate'){
	
	mysql_query('UPDATE accommodation SET status = 1 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Listings - Accommodation', 'accommodation', " . $id . ")");
		
}else if($action == 'deactivate'){
	
	mysql_query('UPDATE accommodation SET status = 0 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Listings - Accommodation', 'accommodation', " . $id . ")");
		
}

header('Location: ../../accommodation');

?>