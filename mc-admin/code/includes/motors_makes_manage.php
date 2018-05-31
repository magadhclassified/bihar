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

$id = (int)$_POST['id'];
$title = $_POST['title'];
$parent = (int)$_POST['parent'];
if(isset($_POST['active'])){$status = 1;}else{$status=0;}

// ---------------------------------------------------------------------------------------------------------------

if($id > 0){
	
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'EDIT', 'Listings - Motors - Makes and Models', 'motors_makes_models', " . $id . ")");
		
		$sqlquery = mysql_query(sprintf("UPDATE motors_makes_models SET title='%s', date_edited=%d, status=%d WHERE id = %d",
					mysql_real_escape_string($title),
					mysql_real_escape_string(time()),
					mysql_real_escape_string($status),
					mysql_real_escape_string($id)
					));

}else{
	
	$sqlquery = mysql_query(sprintf("INSERT INTO motors_makes_models(title, parent_id, date_created, date_edited, status) VALUES('%s', %d, %d, %d, %d)",
				mysql_real_escape_string($title),
				mysql_real_escape_string($parent),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(time()),
				mysql_real_escape_string($status)
				));
	
	$document_id = mysql_insert_id();
	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'ADD', 'Listings - Motors - Makes and Models', 'motors_makes_models', " . $document_id . ")");
		
}

header('Location: ../../motors-makes');

?>