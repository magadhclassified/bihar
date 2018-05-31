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
if(!check_perms('locations', $account_permissions)){die('Unauthorised access.');}

$id = (int)$_POST['id'];
$parent_id = (int)$_POST['pid'];
$title = $_POST['title'];

if($id > 0){
	
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'EDIT', 'Listings - Locations', 'locations', " . $id . ")");
		
		$sqlquery = mysql_query(sprintf("UPDATE locations SET title='%s' WHERE id = %d",
					mysql_real_escape_string($title),
					mysql_real_escape_string($id)
					));
		
}else{
	
	$sqlquery = mysql_query(sprintf("INSERT INTO locations(title, parent_id, date_created, date_edited, status) VALUES('%s', %d, %d, %d, %d)",
				mysql_real_escape_string($title),
				mysql_real_escape_string($parent_id),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(1)
				));
	
	$document_id = mysql_insert_id();
	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'ADD', 'Listings - Locations', 'locations', " . $document_id . ")");
		
}

header('Location: ../../locations');

?>