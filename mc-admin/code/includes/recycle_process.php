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
if(!check_perms('recycle', $account_permissions)){die('Unauthorised access.');}

$action = $_GET['action'];
if(isset($_GET['id'])){$id = (int)$_GET['id'];}
if(isset($_GET['data'])){$data = $_GET['data'];}

// Deletion
if($action == 'delete'){
	$sql = mysql_query("select img1,img2,img3,img4 from recycle where id = '$id'");
	$res = mysql_fetch_assoc($sql);
	$img1 = $res['img1'];
	$img2 = $res['img2'];
	$img3 = $res['img3'];
	$img4 = $res['img4'];
	
	if(!empty($img1)) {
	unlink('../../../files/recycle/featured/'.$img1);
	unlink('../../../files/recycle/fp/'.$img1);
	unlink('../../../files/recycle/thumb/'.$img1);
	unlink('../../../files/recycle/small/'.$img1);
	unlink('../../../files/recycle/promo/'.$img1);
	unlink('../../../files/recycle/original/'.$img1);
	unlink('../../../files/recycle/medium/'.$img1); }
	if(!empty($img2)) {
	unlink('../../../files/recycle/featured/'.$img2);
	unlink('../../../files/recycle/fp/'.$img2);
	unlink('../../../files/recycle/thumb/'.$img2);
	unlink('../../../files/recycle/small/'.$img2);
	unlink('../../../files/recycle/promo/'.$img2);
	unlink('../../../files/recycle/original/'.$img2);
	unlink('../../../files/recycle/medium/'.$img2); }
	if(!empty($img3)) {
	unlink('../../../files/recycle/featured/'.$img3);
	unlink('../../../files/recycle/fp/'.$img3);
	unlink('../../../files/recycle/thumb/'.$img3);
	unlink('../../../files/recycle/small/'.$img3);
	unlink('../../../files/recycle/promo/'.$img3);
	unlink('../../../files/recycle/original/'.$img3);
	unlink('../../../files/recycle/medium/'.$img3); }
	if(!empty($img4)) {
	unlink('../../../files/recycle/featured/'.$img4);
	unlink('../../../files/recycle/fp/'.$img4);
	unlink('../../../files/recycle/thumb/'.$img4);
	unlink('../../../files/recycle/small/'.$img4);
	unlink('../../../files/recycle/promo/'.$img4);
	unlink('../../../files/recycle/original/'.$img4);
	unlink('../../../files/recycle/medium/'.$img4); }
	
	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'DELETE', 'Listings - Recycle', 'recycle', " . $id . ")");
		
	mysql_query('DELETE FROM recycle WHERE id = ' . $id);
		
}

// Status
if($action == 'activate'){
	
	mysql_query('UPDATE recycle SET status = 1 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Listings - Recycle', 'recycle', " . $id . ")");
		
}else if($action == 'deactivate'){
	
	mysql_query('UPDATE recycle SET status = 0 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Listings - Recycle', 'recycle', " . $id . ")");
		
}

header('Location: ../../recycle');

?>