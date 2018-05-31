<?php

session_start();

if(!isset($_SESSION['Admin_Logged_In']) ||  $_SESSION['Admin_Logged_In'] != "YES"){
	echo "Restricted access.";
	exit();
}

include '../../../config.php';
date_default_timezone_set(TIME_ZONE);
include 'conn.php';
include 'functions.php';
include 'class.upload.php';

$is_caller = true;
include 'my_info.php';
if(!check_perms('profiles', $account_permissions)){die('Unauthorised access.');}

$id = (int)$_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$company = $_POST['company'];
$address = $_POST['address'];
$tel = $_POST['tel'];
$fax = $_POST['fax'];
$website = $_POST['website'];
$filename1 = $_POST['oldimg1'];
$password = safe_input($_POST['password']);
if(isset($_POST['active'])){$status = 1;}else{$status=0;}

// ---------------------------------------------------------------------------------------------------------------

if($_FILES['frm_upload1']['size'] > 0){
	$handle = new Upload($_FILES['frm_upload1']);
	if ($handle->uploaded && $handle->file_is_image) {
		$handle->Process('../../../files/profiles/original/');
		if ($handle->processed) {
			$filename1 = $handle->file_dst_name;
		}else{
			echo 'Error: ' . $handle->error . '';
			exit();
		}
		$handle-> Clean();
		
		// Resize
		$handle = new Upload('../../../files/profiles/original/' . $filename1);
		if ($handle->uploaded) {
			$handle->image_resize = true;
			$handle->image_x = 169;
			$handle->image_ratio_y = true;
			$handle->jpeg_quality = 100;
			$handle->Process('../../../files/profiles/');
			if ($handle->processed) {
			}else{
				echo 'Error: ' . $handle->error . '';
				exit();
			}
		}
	}else{
		$_SESSION['FormAction'] = 'ERROR';
	}
}

// ---------------------------------------------------------------------------------------------------------------

$salt = create_guid(40);

if($id > 0){
	
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'EDIT', 'Listings - Profiles', 'profiles', " . $id . ")");
		
		if(strlen($password) > 0){
		
			$sqlquery = mysql_query(sprintf("UPDATE profiles SET company_name='%s', email='%s', contact_person='%s', address='%s', tel='%s', fax='%s', web='%s', img1='%s', date_edited=%d, status=%d, pass_word='%s', salt='%s' WHERE id = %d",
						mysql_real_escape_string($company),
						mysql_real_escape_string($email),
						mysql_real_escape_string($name),
						mysql_real_escape_string($address),
						mysql_real_escape_string($tel),
						mysql_real_escape_string($fax),
						mysql_real_escape_string($website),
						mysql_real_escape_string($filename1),
						mysql_real_escape_string(time()),
						mysql_real_escape_string($status),
						mysql_real_escape_string(sha1($password . $salt)),
						mysql_real_escape_string($salt),
						mysql_real_escape_string($id)
						));
		
		}else{
		
			$sqlquery = mysql_query(sprintf("UPDATE profiles SET company_name='%s', email='%s', contact_person='%s', address='%s', tel='%s', fax='%s', web='%s', img1='%s', date_edited=%d, status=%d WHERE id = %d",
						mysql_real_escape_string($company),
						mysql_real_escape_string($email),
						mysql_real_escape_string($name),
						mysql_real_escape_string($address),
						mysql_real_escape_string($tel),
						mysql_real_escape_string($fax),
						mysql_real_escape_string($website),
						mysql_real_escape_string($filename1),
						mysql_real_escape_string(time()),
						mysql_real_escape_string($status),
						mysql_real_escape_string($id)
						));
					
		}

}else{
	
	$sqlquery = mysql_query(sprintf("INSERT INTO profiles(company_name, email, contact_person, address, tel, fax, web, img1, member_id, member_type, date_created, date_edited, pass_word, salt, activation_guid, forgot_token, date_login, status) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d, '%s', %d, %d, '%s', '%s', '%s', '%s', %d, %d)",
				mysql_real_escape_string($company),
				mysql_real_escape_string($email),
				mysql_real_escape_string($name),
				mysql_real_escape_string($address),
				mysql_real_escape_string($tel),
				mysql_real_escape_string($fax),
				mysql_real_escape_string($website),
				mysql_real_escape_string($filename1),
				mysql_real_escape_string(0),
				mysql_real_escape_string('MAGADHCLASSIFIED'),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(sha1($password . $salt)),
				mysql_real_escape_string($salt),
				mysql_real_escape_string(''),
				mysql_real_escape_string(''),
				mysql_real_escape_string(time()),
				mysql_real_escape_string($status)
				));
	
	$document_id = mysql_insert_id();
	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'ADD', 'Listings - Profiles', 'profiles', " . $document_id . ")");
	
	mysql_query("UPDATE profiles SET member_id = " . $document_id . " WHERE id = " . $document_id);
		
}

header('Location: ../../profiles');

?>
