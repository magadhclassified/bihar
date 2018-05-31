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
if(!check_perms('logs_activity', $account_permissions)){die('Unauthorised access.');}

$action = $_GET['action'];

// Deletion
if($action == 'clear'){

	mysql_query('DELETE FROM logs_events');

	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'DELETE', 'System - Activity Logs', 'logs_events', 0)");
		
}

header('Location: ../../logs-activity');

?>