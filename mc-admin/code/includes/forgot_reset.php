<?php

require_once 'class.phpmailer.php';

$token = $p_data;

if(strlen($token) == 32){

	if(!ctype_alnum($token)){
		header('Location: ' . WEBSITE_ROOT . SYSTEM_ADMIN_FOLDER . '/login/reset/error');
		exit();
	}

	$valid = false;

	$sqlquery = mysql_query(sprintf("SELECT id, email FROM users WHERE active = 1 AND forgot_token = '%s'",
				mysql_real_escape_string($token)));
	   
	while($row = mysql_fetch_array($sqlquery)){ 
		
			$valid = true;
			$admin_id = $row['id'];
			$admin_email = $row['email'];
			
			$new_password_clean = create_guid(10);
			$new_salt = create_guid(32);
			$new_password = sha1($new_password_clean . $new_salt);
			
			mysql_query("UPDATE users SET forgot_token = '', pass_word='" . $new_password . "', salt='" . $new_salt . "' WHERE id = " . $admin_id);
			
			$message = 'Dear administrator,
			
Your password has been changed to: ' . $new_password_clean . '
			
Regards,
' . SYSTEM_NAME;
			
			send_mail_text($admin_email, '', '', SYSTEM_EMAIL, SYSTEM_NAME, 'Password Reset Completed', $message);
			
	}

	if($valid){
		log_error('Account (email: ' . $admin_email . ') completed their password reset.', 'FORGOT_PASSWORD_DONE');
		header('Location: ' . WEBSITE_ROOT . SYSTEM_ADMIN_FOLDER . '/login/reset/reset');
	}else{
		log_error('Account (token: ' . $token . ') request password failed: token not found.', 'FORGOT_PASSWORD_TOKEN_ERROR');
		header('Location: ' . WEBSITE_ROOT . SYSTEM_ADMIN_FOLDER . '/login/reset/error');
	}
	
}

?>