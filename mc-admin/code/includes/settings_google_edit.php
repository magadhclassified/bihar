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
if(!check_perms('settings', $account_permissions)){die('Unauthorised access.');}

$ga = $_POST['ga'];
$wt = $_POST['wt'];
$maps = $_POST['maps'];
$zoom = $_POST['zoom'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

// ---------------------------------------------------------------------------------------------------------------

mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'EDIT', 'System - Settings', 'settings', 1)");
		
$sqlquery = mysql_query(sprintf("UPDATE settings SET google_analytics='%s', google_webmaster_tools='%s', google_maps_api ='%s', google_maps_zoom=%d, google_maps_lat='%s', google_maps_lng='%s' WHERE id = %d",
			mysql_real_escape_string($ga),
			mysql_real_escape_string($wt),
			mysql_real_escape_string($maps),
			mysql_real_escape_string($zoom),
			mysql_real_escape_string($lat),
			mysql_real_escape_string($lng),
			mysql_real_escape_string(1)
			));

$_SESSION['FormAction'] = 'OK';
header('Location: ../../settings');

?>