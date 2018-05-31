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
if(!check_perms('faqs', $account_permissions)){die('Unauthorised access.');}

$id = (int)$_POST['id'];
$title = $_POST['title'];
$about = $_POST['brief'];
if(isset($_POST['active'])){$status = 1;}else{$status=0;}

// ---------------------------------------------------------------------------------------------------------------

if($id > 0){
	
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'EDIT', 'Content - FAQs', 'faqs', " . $id . ")");
		
		$sqlquery = mysql_query(sprintf("UPDATE faqs SET question='%s', answer='%s', date_edited=%d, status=%d WHERE id = %d",
					mysql_real_escape_string($title),
					mysql_real_escape_string($about),
					mysql_real_escape_string(time()),
					mysql_real_escape_string($status),
					mysql_real_escape_string($id)
					));

}else{
	
	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	// Get next ordering value
	$sqlquery = mysql_query('SELECT MAX(ordering) max_or FROM faqs');
	while($row = mysql_fetch_array($sqlquery)){ 
		$ordering = $row['max_or'];
	}
	if(is_null($ordering)){
		$ordering = 0;
	}
	$ordering++;

	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	$sqlquery = mysql_query(sprintf("INSERT INTO faqs(question, answer, date_created, date_edited, ordering, status) VALUES('%s', '%s', %d, %d, %d, %d)",
				mysql_real_escape_string($title),
				mysql_real_escape_string($about),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(time()),
				mysql_real_escape_string($ordering),
				mysql_real_escape_string($status)
				));
	
	$document_id = mysql_insert_id();
	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'ADD', 'Content - FAQs', 'faqs', " . $document_id . ")");
		
}

header('Location: ../../faqs');

?>