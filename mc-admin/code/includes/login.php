<?php

session_start();

// Do not process any login if panel is locked
if(isset($_SESSION['Login_Error']) && $_SESSION['Login_Error'] == "LOCKED"){
	header('Location: ../../login');
	exit();
}

include('../../../config.php');
include('conn.php');
include('functions.php');

$user = $_POST['u'];
$pass = $_POST['p'];

if(!preg_match('/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/', $user)){
	log_error('Account (username: ' . $user . ') login failed using password: ' . $pass . '. [invalid email format]', 'FAILED_LOGIN');
	$_SESSION['Login_Error'] = 'LOGIN';
	header('Location: ../../login');
	exit();
}

$valid = false;

$sqlquery = mysql_query(sprintf("SELECT id, salt, pass_word, acc_type, acc_permissions FROM users WHERE active = 1 AND email = '%s'",
            mysql_real_escape_string($user)));
   
while($row = mysql_fetch_array($sqlquery)){ 
	if($row['pass_word'] === sha1($pass . $row['salt'])){
		$valid = true;
		$admin_id = $row['id'];
		$_SESSION['Admin_ID'] = $admin_id;
		$_SESSION['Admin_Logged_In'] = "YES";
		mysql_query("UPDATE users SET date_login = " . time() . " WHERE id = " . $admin_id);
	}
}

if($valid){
	log_error('Account (username: ' . $user . ') logged in successfully.', 'SUCCESSFUL_LOGIN');
	$_SESSION['Login_Error'] = '';
	
	if(isset($_POST['remember'])){
		setcookie("Remember_Username", $user, time()+3600*24*30, "/", "", 0, 1); //Keeps username for 30 days from last login
	}
	
	header('Location: ../../dashboard');
}else{
	if(isset($_SESSION['Num_Logins'])){
		$_SESSION['Num_Logins'] = (int)$_SESSION['Num_Logins'] + 1;
	}else{
		$_SESSION['Num_Logins'] = 1;
	}
	
	if((int)$_SESSION['Num_Logins'] >= 3){
		$_SESSION['Login_Error'] = "LOCKED";
		log_error('Account (username: ' . $user . ') login failed using password: ' . $pass . '. [attempt ' . $_SESSION['Num_Logins'] . ', account locked]', 'FAILED_LOGIN');
		header('Location: ../../login');
		exit();
	}
	
	log_error('Account (username: ' . $user . ') login failed using password: ' . $pass . '. [attempt ' . $_SESSION['Num_Logins'] . ']', 'FAILED_LOGIN');
	$_SESSION['Login_Error'] = 'LOGIN';
	header('Location: ../../login');
}

?>