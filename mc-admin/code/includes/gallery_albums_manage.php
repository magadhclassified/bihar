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
if(!check_perms('gallery', $account_permissions)){die('Unauthorised access.');}

$id = (int)$_POST['id'];
$title = $_POST['title'];

if($id > 0){
	
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'EDIT', 'Content - Gallery - Albums', 'gallery_albums', " . $id . ")");
		
		$sqlquery = mysql_query(sprintf("UPDATE gallery_albums SET title='%s' WHERE id = %d",
					mysql_real_escape_string($title),
					mysql_real_escape_string($id)
					));
		
}else{
	
	$sqlquery = mysql_query(sprintf("INSERT INTO gallery_albums(title, date_created) VALUES('%s', %d)",
				mysql_real_escape_string($title),
				mysql_real_escape_string(time())
				));
	
	$document_id = mysql_insert_id();
	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'ADD', 'Content - Gallery - Albums', 'gallery_albums', " . $document_id . ")");
		
}

header('Location: ../../gallery-albums');

?>