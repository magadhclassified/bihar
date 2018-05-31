<?php

if(!isset($caller)){exit('Direct access not allowed.');}

include 'class.phpmailer.php';

$pass_result = '';

switch($action){
	case 'notfound':
		$pass_result = '<strong>Error</strong>, the specified email address could not be found.';
		break;
	case 'email':
		$pass_result = '<strong>Error</strong>, the forgotten password email could not be sent.';
		break;
	case 'sent':
		$pass_result = '<strong>Thank You</strong>, reset instructions have been emailed to the specified email address.';
		break;
	case 'verify':

			if(!ctype_alnum($verify_code)){
				$pass_result = '<strong>Error</strong>, a token error occurred.';
				break;
			}

			if(strlen($verify_code) != 40){
				$pass_result = '<strong>Error</strong>, a token error occurred.';
				break;
			}

			$valid = false;

			$sqlquery = mysql_query(sprintf("SELECT id, email, contact_person FROM profiles WHERE status = 1 AND forgot_token = '%s'",
						mysql_real_escape_string($verify_code)));
			   
			while($row = mysql_fetch_array($sqlquery)){ 
				
					$valid = true;
					$admin_id = $row['id'];
					$admin_email = $row['email'];
					$admin_name = $row['contact_person'];
					
					$new_password_clean = create_guid(10);
					$new_salt = create_guid(40);
					$new_password = sha1($new_password_clean . $new_salt);
					
					mysql_query("UPDATE profiles SET forgot_token = '', pass_word='" . $new_password . "', salt='" . $new_salt . "' WHERE id = " . (int)$admin_id);
					
					$message = 'Dear ' . $admin_name . ',
					
Your password has been changed to: ' . $new_password_clean . '
					
Kind regards,
' . COMPANY_NAME;
					//Send reset email - send to error page if mail could not be sent
					$sqlquery = mysql_query("SELECT email_feedback FROM settings WHERE id = 1");
					while($row = mysql_fetch_array($sqlquery)){ 
						$feeback_email = $row['email_feedback'];
					}
					
					send_mail_text($admin_email, '', '', $feeback_email, COMPANY_NAME, COMPANY_NAME . ' Password Reset', $message);
					
			}

			if($valid){
				$pass_result = '<strong>Thank You</strong>, your password has now been reset and an email containing your new password has been sent.';
			}else{
				$pass_result = '<strong>Error</strong>, a token error occurred.';
			}
		
			break;
}

?>