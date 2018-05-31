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
if(!check_perms('jobs', $account_permissions)){die('Unauthorised access.');}

$action = $_GET['action'];
if(isset($_GET['id'])){$id = (int)$_GET['id'];}
if(isset($_GET['data'])){$data = $_GET['data'];}

// Deletion
if($action == 'delete'){

	$sql = mysql_query("select img1 from jobs where id = '$id'");
	$res = mysql_fetch_assoc($sql);
	$img1 = $res['img1'];
	if(!empty($img1)) {
	unlink('../../../files/jobs/featured/'.$img1);
	unlink('../../../files/jobs/fp/'.$img1);
	unlink('../../../files/jobs/thumb/'.$img1);
	unlink('../../../files/jobs/small/'.$img1);
	unlink('../../../files/jobs/promo/'.$img1);
	unlink('../../../files/jobs/original/'.$img1);
	unlink('../../../files/jobs/medium/'.$img1); }
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'DELETE', 'Listings - Jobs', 'jobs', " . $id . ")");

	mysql_query('DELETE FROM jobs WHERE id = ' . $id);
		
}

// Status
if($action == 'activate'){
	
	mysql_query('UPDATE jobs SET status = 1 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Listings - Jobs', 'jobs', " . $id . ")");
		
}else if($action == 'deactivate'){
	
	mysql_query('UPDATE jobs SET status = 0 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Listings - Jobs', 'jobs', " . $id . ")");
		
}

header('Location: ../../jobs');

?>