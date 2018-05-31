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

$action = $_GET['action'];
$id = (int)$_GET['id'];

// Deletion
if($action == 'delete'){

	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'DELETE', 'Listings - Locations', 'locations', " . $id . ")");
		
	mysql_query('DELETE FROM locations WHERE id = ' . $id);
		
}

header('Location: ../../locations');

?>