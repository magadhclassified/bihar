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
if(!check_perms('pages', $account_permissions)){die('Unauthorised access.');}

$id = (int)$_POST['id'];
$title = $_POST['title'];
$seotitle = $_POST['seotitle'];
$brief = $_POST['brief'];
$keywords = $_POST['keywords'];
$seo = $_POST['seo'];
$contents = $_POST['elm1'];
$gallery = (int)$_POST['gallery'];

// ---------------------------------------------------------------------------------------------------------------

if($id > 0){
	
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'EDIT', 'Content - Pages', 'pages', " . $id . ")");
		
		$sqlquery = mysql_query(sprintf("UPDATE pages SET title='%s', seotitle='%s' , brief='%s', keywords='%s', contents='%s', seo='%s', date_edited=%d, gallery_id=%d WHERE id = %d",
					mysql_real_escape_string($title),
					mysql_real_escape_string($seotitle),
					mysql_real_escape_string($brief),
					mysql_real_escape_string($keywords),
					mysql_real_escape_string($contents),
					mysql_real_escape_string($seo),
					mysql_real_escape_string(time()),
					mysql_real_escape_string($gallery),
					mysql_real_escape_string($id)
					));

}

header('Location: ../../pages');

?>