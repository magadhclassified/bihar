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
if(!check_perms('users', $account_permissions)){die('Unauthorised access.');}

$id = (int)$_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$type = $_POST['type'];
if(isset($_POST['active'])){$status = 1;}else{$status=0;}

$salt = create_guid(32);

// ---------------------------------------------------------------------------------------------------------------

$mods = '';
if(!isset($_POST['perms'])){$modules=array();}
if($type == 'ADMIN'){
	$mods = implode(',', $_POST['perms']);
}else{
	// Get all modules
	$sqlquery = mysql_query('SELECT * FROM settings_components WHERE available=1 ORDER BY title ASC');
	while($row = mysql_fetch_array($sqlquery)){ 
		$perms_perm = filter_out($row['section_permission']);
		$perms_parent = filter_out($row['parent_permission']);
		
		$mods .= $perms_perm . ',';
		if(strlen($perms_parent) > 0){
			$mods .= $perms_parent  . ',';
		}
	}
	if(strlen($mods) > 0){
		$mods = substr($mods, 0, strlen($mods)-1);
	}
}

$mods = implode(',', array_unique(explode(',', $mods)));

// ---------------------------------------------------------------------------------------------------------------

if($id > 0){
	
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'EDIT', 'System - Admin Accounts', 'users', " . $id . ")");
		
		if(strlen($password) > 0){
			$sqlquery = mysql_query(sprintf("UPDATE users SET full_name='%s', email='%s', pass_word='%s', salt='%s', acc_type='%s', acc_permissions='%s', active=%d WHERE id = %d",
						mysql_real_escape_string($name),
						mysql_real_escape_string($email),
						mysql_real_escape_string(sha1($password . $salt)),
						mysql_real_escape_string($salt),
						mysql_real_escape_string($type),
						mysql_real_escape_string($mods),
						mysql_real_escape_string($status),
						mysql_real_escape_string($id)
						));
		}else{
			$sqlquery = mysql_query(sprintf("UPDATE users SET full_name='%s', email='%s', acc_type='%s', acc_permissions='%s', active=%d WHERE id = %d",
						mysql_real_escape_string($name),
						mysql_real_escape_string($email),
						mysql_real_escape_string($type),
						mysql_real_escape_string($mods),
						mysql_real_escape_string($status),
						mysql_real_escape_string($id)
						));
		}
		
		

}else{
	
	$sqlquery = mysql_query(sprintf("INSERT INTO users(full_name, email, pass_word, salt, acc_type, acc_permissions, date_created, date_login, forgot_token, active) VALUES('%s', '%s', '%s', '%s', '%s', '%s', %d, %d, '%s', %d)",
				mysql_real_escape_string($name),
				mysql_real_escape_string($email),
				mysql_real_escape_string(sha1($password . $salt)),
				mysql_real_escape_string($salt),
				mysql_real_escape_string($type),
				mysql_real_escape_string($mods),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(''),
				mysql_real_escape_string($status)
				));
	
	$document_id = mysql_insert_id();
	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'ADD', 'System - Admin Accounts', 'users', " . $document_id . ")");
		
}

header('Location: ../../users');

?>