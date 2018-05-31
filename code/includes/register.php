<?php

session_start();

include '../../config.php';
include 'conn.php';
include 'functions.php';
include 'class.phpmailer.php';

$name = safe_input($_POST['name']);
$company = safe_input($_POST['company']);
$email = safe_input($_POST['email']);
$address = safe_input($_POST['address']);
$tel = safe_input($_POST['tel']);
$fax = safe_input($_POST['fax']);
$website = safe_input($_POST['website']);
$pass = safe_input($_POST['pass1']);

if((strlen($name) == 0) || (strlen($email) == 0) || (strlen($pass) == 0)){
	$_SESSION['Form_Feedback'] = 'One or more fields were not completed. Please try again.';
	header('Location: ../../register');
	exit();
}

// Check if this member's email is not already in use
$sqlquery = mysql_query(sprintf("SELECT COUNT(*) num_emails FROM profiles WHERE email = '%s'",
			mysql_real_escape_string($email)
			));
while($row = mysql_fetch_array($sqlquery)){ 
	$num_emails = $row['num_emails'];
}
if($num_emails > 0){
	$_SESSION['Form_Feedback'] = 'The specified email address is already in use. If you already have an account with us, please use the Forgot Password feature to have your login details reset.';
	header('Location: ../../register');
	exit();
}

$activation = sha1(time() . $email . create_guid(32));
$salt = create_guid(40);

$sqlquery = mysql_query(sprintf("INSERT INTO profiles(company_name, contact_person, email, address, tel, fax, web, img1, member_id, member_type, date_created, date_edited, pass_word, salt, activation_guid, forgot_token, date_login, status) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d, '%s', %d, %d, '%s', '%s', '%s', '%s', %d, %d)",
			mysql_real_escape_string($company),
			mysql_real_escape_string($name),
			mysql_real_escape_string($email),
			mysql_real_escape_string($address),
			mysql_real_escape_string($tel),
			mysql_real_escape_string($fax),
			mysql_real_escape_string($website),
			mysql_real_escape_string(''),
			mysql_real_escape_string(0),
			mysql_real_escape_string('MAGADHCLASSIFIED'),
			mysql_real_escape_string(time()),
			mysql_real_escape_string(time()),
			mysql_real_escape_string(sha1($pass . $salt)),
			mysql_real_escape_string($salt),
			mysql_real_escape_string($activation),
			mysql_real_escape_string(''),
			mysql_real_escape_string(time()),
			mysql_real_escape_string(0)
			));
			
// Because this is a 7D member, set their member ID as their actual member ID
$last_member = (int)mysql_insert_id();
mysql_query('UPDATE profiles SET member_id = ' . $last_member . ' WHERE id = ' . $last_member);

// Send activation email
$sqlquery = mysql_query("SELECT email_feedback FROM settings WHERE id = 1");
while($row = mysql_fetch_array($sqlquery)){ 
	$feeback_email = $row['email_feedback'];
}

$msg = 'Dear ' . $name . ',

Thank you for your registration on ' . COMPANY_NAME . '.

In order to activate your account, please follow the link below:

' . COMPANY_URL . 'activate/' . $activation . '

If you have any queries, please do not hesitate to contact us.

Kind regards,
' . COMPANY_NAME;

send_mail_text($email, '', '', $feeback_email, COMPANY_NAME, COMPANY_NAME . ' Registration', $msg);

$_SESSION['Form_Feedback'] = 'Thank you for your registration! An email has been sent containing your account activation details.';
header('Location: ../../register');

?>