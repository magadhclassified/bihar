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

$safe = $_POST['safe'];

// ---------------------------------------------------------------------------------------------------------------

mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'EDIT', 'System - Settings', 'settings', 1)");
		
$sqlquery = mysql_query(sprintf("UPDATE settings SET surf_safe_text ='%s' WHERE id = %d",
			mysql_real_escape_string($safe),
			mysql_real_escape_string(1)
			));

$_SESSION['FormAction'] = 'OK';
header('Location: ../../settings');

?>