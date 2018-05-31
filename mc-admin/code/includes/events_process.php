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
if(!check_perms('events', $account_permissions)){die('Unauthorised access.');}

$action = $_GET['action'];
if(isset($_GET['id'])){$id = (int)$_GET['id'];}
if(isset($_GET['data'])){$data = $_GET['data'];}

// Deletion
if($action == 'delete'){
	$sql = mysql_query("select img1 from events where id = '$id'");
	$res = mysql_fetch_assoc($sql);
	$img1 = $res['img1'];
	if(!empty($img1)) {
	unlink('../../../files/events/featured/'.$img1);
	unlink('../../../files/events/fp/'.$img1);
	unlink('../../../files/events/thumb/'.$img1);
	unlink('../../../files/events/small/'.$img1);
	unlink('../../../files/events/promo/'.$img1);
	unlink('../../../files/events/original/'.$img1);
	unlink('../../../files/events/medium/'.$img1); }
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'DELETE', 'Listings - Events', 'events', " . $id . ")");	
	mysql_query('DELETE FROM events WHERE id = ' . $id);
		
}

// Status
if($action == 'activate'){
	
	mysql_query('UPDATE events SET status = 1 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Listings - Events', 'events', " . $id . ")");
		
}else if($action == 'deactivate'){
	
	mysql_query('UPDATE events SET status = 0 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Listings - Events', 'events', " . $id . ")");
		
}

header('Location: ../../events');

?>