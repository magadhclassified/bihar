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

$id = (int)$_POST['id'];
$title = $_POST['title'];
if(isset($_POST['active'])){$status = 1;}else{$status=0;}

// ---------------------------------------------------------------------------------------------------------------

if($id > 0){
	
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'EDIT', 'Listings - Recycle - Categories', 'recycle_categories', " . $id . ")");
		
		$sqlquery = mysql_query(sprintf("UPDATE recycle_categories SET title='%s', date_edited=%d, status=%d WHERE id = %d",
					mysql_real_escape_string($title),
					mysql_real_escape_string(time()),
					mysql_real_escape_string($status),
					mysql_real_escape_string($id)
					));

}else{
	
	$sqlquery = mysql_query(sprintf("INSERT INTO recycle_categories(title, date_created, date_edited, status) VALUES('%s', %d, %d, %d)",
				mysql_real_escape_string($title),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(time()),
				mysql_real_escape_string($status)
				));
	
	$document_id = mysql_insert_id();
	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'ADD', 'Listings - Recycle - Categories', 'recycle_categories', " . $document_id . ")");
		
}

header('Location: ../../recycle-categories');

?>