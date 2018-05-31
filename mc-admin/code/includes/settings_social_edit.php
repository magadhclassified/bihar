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

$fburl = $_POST['fburl'];
$twurl = $_POST['twurl'];
$fbappid = $_POST['fbappid'];
$addthisuser = $_POST['addthisusername'];

// ---------------------------------------------------------------------------------------------------------------

mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'EDIT', 'System - Settings', 'settings', 1)");
		
$sqlquery = mysql_query(sprintf("UPDATE settings SET facebook_link='%s', twitter_link='%s', facebook_app_id='%s', addthis_username='%s' WHERE id = %d",
			mysql_real_escape_string($fburl),
			mysql_real_escape_string($twurl),
			mysql_real_escape_string($fbappid),
			mysql_real_escape_string($addthisuser),
			mysql_real_escape_string(1)
			));

$_SESSION['FormAction'] = 'OK';
header('Location: ../../settings');

?>