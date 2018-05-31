<?php

session_start();

include '../../config.php';
include 'conn.php';
include 'functions.php';
include 'class.phpmailer.php';

if(isset($_POST['form_email'])){

	$email = $_POST['form_email'];
	$valid = false;

	$sqlquery = mysql_query(sprintf("SELECT id, email, contact_person FROM profiles WHERE status = 1 AND email = '%s'",
				mysql_real_escape_string($email)));
	   
	while($row = mysql_fetch_array($sqlquery)){ 
		
			$valid = true;
			$member_id = $row['id'];
			$member_email = $row['email'];
			$member_name = $row['contact_person'];
			
			$fpass_token = create_guid(40);
			mysql_query("UPDATE profiles SET forgot_token = '" . $fpass_token . "' WHERE id = " . (int)$member_id);
			
			$message = 'Dear ' . $member_name . ',
			
A password reset request was made for your ' . COMPANY_NAME . ' account. If you did not make the request, please contact us immediately.
			
If you did request your password to be reset, please click the link below:
			
' . COMPANY_URL . 'forgotten-password-process/verify/' . $fpass_token . '
			
Kind regards,
' . COMPANY_NAME;
			//Send reset email - send to error page if mail could not be sent
			
			$sqlquery = mysql_query("SELECT email_feedback FROM settings WHERE id = 1");
			while($row = mysql_fetch_array($sqlquery)){ 
				$feeback_email = $row['email_feedback'];
			}
			
			send_mail_text($member_email, '', '', $feeback_email, COMPANY_NAME, COMPANY_NAME . ' Password Retrieval', $message);
			
	}

	if($valid){
		//header('Location: ../../forgotten-password-process/sent');
		$_SESSION['Form_Forgot'] = 'Thank You, reset instructions have been emailed.';
		header('Location: ../../forgot-password');
	}else{
		//header('Location: ../../forgotten-password-process/notfound');
		$_SESSION['Form_Forgot'] = 'Error, the specified email address could not be found.';
		header('Location: ../../forgot-password');
	}

}

?>