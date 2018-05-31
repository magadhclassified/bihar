<?php

session_start();

include('../../../config.php');
include('conn.php');
include('functions.php');
require_once 'class.phpmailer.php';

$email = $_POST['u'];

if(!preg_match('/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/', $email)){
	header('Location: ../../login/reset/notfound');
	exit();
}

$valid = false;

$sqlquery = mysql_query(sprintf("SELECT id, email FROM users WHERE active = 1 AND email = '%s'",
            mysql_real_escape_string($email)));
   
while($row = mysql_fetch_array($sqlquery)){ 
	
		$valid = true;
		$admin_id = $row['id'];
		$admin_email = $row['email'];
		
		$fpass_token = create_guid(32);
		mysql_query("UPDATE users SET forgot_token = '" . $fpass_token . "' WHERE id = " . $admin_id);
		
		$message = 'Dear administrator,
		
A password reset request was made from the ' . COMPANY_NAME . ' website admin. If you did not make the request, please contact support immediately.
		
If you did request your password to be reset, please click the link below:
		
' . COMPANY_URL . SYSTEM_ADMIN_FOLDER . '/login/reset/' . $fpass_token . '
		
Regards,
' . SYSTEM_NAME;

		send_mail_text($admin_email, '', '', SYSTEM_EMAIL, SYSTEM_NAME, 'Password Reset Request', $message);
		
}

if($valid){
	log_error('Account (email: ' . $email . ') requested a password reset.', 'FORGOT_PASSWORD_REQUEST');
	header('Location: ../../login/reset/sent');
}else{
	log_error('Account (email: ' . $email . ') request password failed: email address not found.', 'FORGOT_PASSWORD_ERROR');
	header('Location: ../../login/reset/notfound');
}

?>