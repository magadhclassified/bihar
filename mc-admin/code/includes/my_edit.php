<?php

session_start();

if(!isset($_SESSION['Admin_Logged_In']) || $_SESSION['Admin_Logged_In'] != "YES"){
	echo "Restricted access.";
	exit();
}

include '../../../config.php';
include 'conn.php';
include 'functions.php';

$name = $_POST['name'];
$password = $_POST['password'];

$salt = create_guid(32);

// Check name
if(strlen($name) < 2){
	$_SESSION['FormAction'] = 'ERROR';
	header('Location: ../../my');
	exit();
}

if(strlen($password) == 0){
	$sqlquery = mysql_query(sprintf("UPDATE users SET full_name='%s' WHERE id = %d",
				mysql_real_escape_string($name),
				mysql_real_escape_string($_SESSION['Admin_ID'])
				));
}else{

	$sqlquery = mysql_query(sprintf("UPDATE users SET full_name='%s', salt='%s', pass_word='%s' WHERE id = %d",
				mysql_real_escape_string($name),
				mysql_real_escape_string($salt),
				mysql_real_escape_string(sha1($password . $salt)),
				mysql_real_escape_string($_SESSION['Admin_ID'])
				));
}
				
log_error('Account (id: ' . $_SESSION['Admin_ID'] . ') changed their profile details.', 'CLIENT_EDIT');

$_SESSION['FormAction'] = 'OK'; // OK or ERROR
header('Location: ../../my');

?>