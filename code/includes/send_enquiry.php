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
$msg = safe_input($_POST['message']);
$section = safe_input($_POST['section']);
$id = safe_input($_POST['id']);

// Anti-spam
if(strlen($_POST['email']) > 0){
	header('Location: ../../thank-you-enquiry');
	exit();
}

// Get the listing information
$section_table = '';
$section_seo = '';
$listing_title = '';
$listing_email = '';

switch($section){
	case 'PROPERTY': $section_table = 'properties'; $section_seo = 'property-details'; break;
	case 'JOBS': $section_table = 'jobs'; $section_seo = 'job-details'; break;
	case 'MOTORS': $section_table = 'motors'; $section_seo = 'motor-details'; break;
	case 'DIRECTORY': $section_table = 'directory'; $section_seo = 'directory-details'; break;
	case 'RECYCLE': $section_table = 'recycle'; $section_seo = 'recycle-details'; break;
	case 'RESTAURANTS': $section_table = 'restaurants'; $section_seo = 'restaurant-details'; break;
	case 'ACCOMMODATION': $section_table = 'accommodation'; $section_seo = 'accommodation-details'; break;
	case 'EVENTS': $section_table = 'events'; $section_seo = 'event-details'; break;
}

$sqlquery = mysql_query(sprintf('SELECT title, contact_email FROM ' . $section_table . ' WHERE id = %d',
			mysql_real_escape_string($id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$listing_title = filer_out_limit($row['title']);
	$listing_email = filer_out_limit($row['contact_email']);
}

$seo_url = COMPANY_URL . $section_seo . '/' . $id . '/' . seo($listing_title);

// Extra measure: CAPTCHA
$securimage = new Securimage();
if($securimage->check($_POST['capbox']) == false){
	$_SESSION['Form_Status'] = 'ERROR';
	header('Location: ' . $seo_url);
	exit();
}

$member_id = 0;
if(isset($_SESSION['Member_ID'])){
	$member_id = $_SESSION['Member_ID'];
}

// Add enquiry to the database
$sqlquery = mysql_query(sprintf("INSERT INTO enquiries(full_name, email, contact_number, message, listing_section, listing_id, member_id, ip, date_created) VALUES('%s', '%s', '%s', '%s', '%s', %d, %d, '%s', %d)",
			mysql_real_escape_string($name),
			mysql_real_escape_string($email),
			mysql_real_escape_string($tel),
			mysql_real_escape_string($msg),
			mysql_real_escape_string($section),
			mysql_real_escape_string($id),
			mysql_real_escape_string($member_id),
			mysql_real_escape_string(get_the_ip()),
			mysql_real_escape_string(time())
			));

$sqlquery = mysql_query("SELECT email_feedback FROM settings WHERE id = 1");
while($row = mysql_fetch_array($sqlquery)){ 
	$feeback_recipient = $row['email_feedback'];
}

$final_msg = "----------------------------------------------------------------------------------------------\nThis email was sent from the " . COMPANY_NAME . " Website.\n----------------------------------------------------------------------------------------------\n\nA visitor completed the enquiry form in response to your listing: " . $listing_title . " (" . $seo_url . "). Their details are as follows:\r\n\r\nFull Name: " . $name . "\r\n\r\nEmail Address: " . $email . "\r\n\r\nContact Number: " . $tel . "\r\n\r\nMessage:\r\n\r\n" . $msg . "\r\n\r\n----------------------------------------------------------------------------------------------\nPlease report any abuse of this facility to " . $feeback_recipient . "\n----------------------------------------------------------------------------------------------";

send_mail_text($listing_email, '', '', $email, $name, 'Enquiry from the ' . COMPANY_NAME . ' website', $final_msg);

header('Location: ../../thank-you-enquiry');

?>