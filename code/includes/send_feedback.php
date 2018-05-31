<?php

session_start();

include '../../config.php';
include 'conn.php';
include 'functions.php';
include 'class.phpmailer.php';
include 'cap/securimage.php';

$name = safe_input($_POST['feedbackname']);
$email = safe_input($_POST['feedbackemail']);
$tel = safe_input($_POST['feedbacknumber']);
$subject = safe_input($_POST['feedsubject']);
$msg = safe_input($_POST['message']);

// Anti-spam
if(strlen($_POST['email']) > 0){
	header('Location: ../../thank-you-contact');
	exit();
}

// Extra measure: CAPTCHA
$securimage = new Securimage();
if($securimage->check($_POST['capbox']) == false){
	$_SESSION['Form_Status'] = 'ERROR';
	header('Location: ../../contact-us');
	exit();
}

$sqlquery = mysql_query("SELECT email_feedback FROM settings WHERE id = 1");
while($row = mysql_fetch_array($sqlquery)){ 
	$feeback_recipient = $row['email_feedback'];
}

$final_msg = "----------------------------------------------------------------------------------------------\nThis email was sent from the " . COMPANY_NAME . " Website.\n----------------------------------------------------------------------------------------------\n\nA visitor completed the feedback form found on the " . COMPANY_NAME . " website. Their details are as follows:\r\n\r\nFull Name: " . $name . "\r\n\r\nEmail Address: " . $email . "\r\n\r\nContact Number: " . $tel . "\r\n\r\nSubject: " . $subject . "\r\n\r\nMessage:\r\n\r\n" . $msg;

send_mail_text($feeback_recipient, '', '', $email, $name, 'Feedback from the ' . COMPANY_NAME . ' website', $final_msg);

header('Location: ../../thank-you-contact');

?>