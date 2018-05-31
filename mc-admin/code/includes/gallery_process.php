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
if(!check_perms('gallery', $account_permissions)){die('Unauthorised access.');}

$action = $_GET['action'];
$id = (int)$_GET['id'];

if($action == 'activate'){
	
	mysql_query('UPDATE gallery SET status = 1 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Content - Gallery', 'gallery', " . $id . ")");
		
}else if($action == 'deactivate'){
	
	mysql_query('UPDATE gallery SET status = 0 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Content - Gallery', 'gallery', " . $id . ")");
		
}

// Deletion
if($action == 'delete'){

	$sqlquery = mysql_query("SELECT img_url FROM gallery WHERE id = " . $id);
	while($row = mysql_fetch_array($sqlquery)){ 
		if(is_file('../../../files/gallery/original/' . $row['img_url'])){
			unlink('../../../files/gallery/original/' . $row['img_url']);
		}
		if(is_file('../../../files/gallery/thumb/' . $row['img_url'])){
			unlink('../../../files/gallery/thumb/' . $row['img_url']);
		}
		if(is_file('../../../files/gallery/large/' . $row['img_url'])){
			unlink('../../../files/gallery/large/' . $row['img_url']);
		}
	}

	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'DELETE', 'Content - Gallery', 'gallery', " . $id . ")");
		
	mysql_query('DELETE FROM gallery WHERE id = ' . $id);
		
}

header('Location: ../../gallery');

?>