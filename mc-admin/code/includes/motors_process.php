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
if(!check_perms('motors', $account_permissions)){die('Unauthorised access.');}

$action = $_GET['action'];
if(isset($_GET['id'])){$id = (int)$_GET['id'];}
if(isset($_GET['data'])){$data = $_GET['data'];}

// Deletion
if($action == 'delete'){
	$sql = mysql_query("select img1,img2,img3,img4 from motors where id = '$id'");
	$res = mysql_fetch_assoc($sql);
	$img1 = $res['img1'];
	$img2 = $res['img2'];
	$img3 = $res['img3'];
	$img4 = $res['img4'];
	if(!empty($img1)) {
	unlink('../../../files/motors/featured/'.$img1);
	unlink('../../../files/motors/fp/'.$img1);
	unlink('../../../files/motors/thumb/'.$img1);
	unlink('../../../files/motors/small/'.$img1);
	unlink('../../../files/motors/promo/'.$img1);
	unlink('../../../files/motors/original/'.$img1);
	unlink('../../../files/motors/medium/'.$img1); }
	if(!empty($img2)) {
	unlink('../../../files/motors/featured/'.$img2);
	unlink('../../../files/motors/fp/'.$img2);
	unlink('../../../files/motors/thumb/'.$img2);
	unlink('../../../files/motors/small/'.$img2);
	unlink('../../../files/motors/promo/'.$img2);
	unlink('../../../files/motors/original/'.$img2);
	unlink('../../../files/motors/medium/'.$img2); }
	if(!empty($img3)) {
	unlink('../../../files/motors/featured/'.$img3);
	unlink('../../../files/motors/fp/'.$img3);
	unlink('../../../files/motors/thumb/'.$img3);
	unlink('../../../files/motors/small/'.$img3);
	unlink('../../../files/motors/promo/'.$img3);
	unlink('../../../files/motors/original/'.$img3);
	unlink('../../../files/motors/medium/'.$img3); }
	if(!empty($img4)) {
	unlink('../../../files/motors/featured/'.$img4);
	unlink('../../../files/motors/fp/'.$img4);
	unlink('../../../files/motors/thumb/'.$img4);
	unlink('../../../files/motors/small/'.$img4);
	unlink('../../../files/motors/promo/'.$img4);
	unlink('../../../files/motors/original/'.$img4);
	unlink('../../../files/motors/medium/'.$img4); }
	
mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'DELETE', 'Listings - Motors', 'motors', " . $id . ")");	
mysql_query('DELETE FROM motors WHERE id = ' . $id);
		
}

// Status
if($action == 'activate'){
	
	mysql_query('UPDATE motors SET status = 1 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Listings - Motors', 'motors', " . $id . ")");
		
}else if($action == 'deactivate'){
	
	mysql_query('UPDATE motors SET status = 0 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Listings - Motors', 'motors', " . $id . ")");
		
}

header('Location: ../../motors');

?>