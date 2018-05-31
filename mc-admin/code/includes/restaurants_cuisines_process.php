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
if(!check_perms('restaurants', $account_permissions)){die('Unauthorised access.');}

$action = $_GET['action'];
if(isset($_GET['id'])){$id = (int)$_GET['id'];}
if(isset($_GET['data'])){$data = $_GET['data'];}

// Deletion
if($action == 'delete'){

	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'DELETE', 'Listings - Restaurants - Cuisines', 'restaurants_cuisines', " . $id . ")");
		
	mysql_query('DELETE FROM restaurants_cuisines WHERE id = ' . $id);
	mysql_query('DELETE FROM restaurants_cuisines_details WHERE cuisine_id = ' . $id);
		
}

// Status
if($action == 'activate'){
	
	mysql_query('UPDATE restaurants_cuisines SET status = 1 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Listings - Restaurants - Cuisines', 'restaurants_cuisines', " . $id . ")");
		
}else if($action == 'deactivate'){
	
	mysql_query('UPDATE restaurants_cuisines SET status = 0 WHERE id = ' . $id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'STATUS', 'Listings - Restaurants - Cuisines', 'restaurants_cuisines', " . $id . ")");
		
}

header('Location: ../../restaurants-cuisines');

?>