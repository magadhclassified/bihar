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
if(!check_perms('directory', $account_permissions)){die('Unauthorised access.');}

$action = $_GET['action'];
if(isset($_GET['id'])){$id = (int)$_GET['id'];}
if(isset($_GET['data'])){$data = $_GET['data'];}

// Deletion
if($action == 'delete'){

	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'DELETE', 'Listings - Directory - Categories', 'directory_categories', " . $id . ")");
		
	mysql_query('DELETE FROM directory_categories WHERE id = ' . $id);
		
}

// Move
if($action == 'move'){

	$t_cur = explode('-', $data);

	$data_cur = explode('_', $t_cur[0]);
	$data_new = explode('_', $t_cur[1]);
	
	$cur_id = $data_cur[0];
	$cur_order = $data_cur[1];
	$other_id = $data_new[0];
	$other_order = $data_new[1];
	
	mysql_query('UPDATE directory_categories SET ordering = ' . $cur_order . ' WHERE id = ' . $other_id);
	mysql_query('UPDATE directory_categories SET ordering = ' . $other_order . ' WHERE id = ' . $cur_id);
		
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'CHANGE', 'Listings - Directory - Categories', 'directory_categories', " . $cur_id . ")");
		
}

header('Location: ../../directory-categories');

?>