<?php

session_start();

include '../../config.php';
include 'conn.php';
include 'functions.php';
include 'class.upload.php';

if(!isset($_SESSION['Member_ID'])){
	exit('Not logged in.');
}

$company = safe_input($_POST['company']);
$name = safe_input($_POST['name']);
$email = safe_input($_POST['email']);
$address = safe_input($_POST['address']);
$tel = safe_input($_POST['tel']);
$fax = safe_input($_POST['fax']);
$website = safe_input($_POST['website']);
$filename1 = safe_input($_POST['oldimg']);
$password = safe_input($_POST['password']);
	
if((strlen($company) == 0) || (strlen($name) == 0) || (strlen($email) == 0)){
	$_SESSION['MemUpdate'] = 'Your details could not be updated: please ensure you complete all fields.';
	header('Location: ../../my-profile');
	exit();
}
	
// ------------------------------------------------------------------------------------------------------------------
// Check if exists
// ------------------------------------------------------------------------------------------------------------------

/*$sqlquery = mysql_query(sprintf("SELECT COUNT(*) cnt FROM profiles WHERE email = '%s' AND id <> " . $_SESSION['Member_ID'],
			mysql_real_escape_string($email)
			));
while($row = mysql_fetch_array($sqlquery)){ 
	$cnt = (int)$row['cnt'];
}
if($cnt > 0){
	$_SESSION['MemUpdate'] = 'Your details could not be updated: email address specified already in use.';
	header('Location: ../../my-profile');
	exit();
}*/
	
// ---------------------------------------------------------------------------------------------------------------

if($_FILES['frm_upload1']['size'] > 0){
	$handle = new Upload($_FILES['frm_upload1']);
	if ($handle->uploaded && $handle->file_is_image) {
		$handle->Process('../../files/profiles/original/');
		if ($handle->processed) {
			$filename1 = $handle->file_dst_name;
		}else{
			echo 'Error: ' . $handle->error . '';
			exit();
		}
		$handle-> Clean();
		
		// Resize
		$handle = new Upload('../../files/profiles/original/' . $filename1);
		if ($handle->uploaded) {
			$handle->image_resize = true;
			$handle->image_x = 169;
			$handle->image_ratio_y = true;
			$handle->jpeg_quality = 100;
			$handle->Process('../../files/profiles/');
			if ($handle->processed) {
			}else{
				echo 'Error: ' . $handle->error . '';
				exit();
			}
		}
	}else{
		$_SESSION['MemUpdate'] = 'Your details could not be updated: specified logo image was invalid.';
		header('Location: ../../my-profile');
		exit();
	}
}
	
// ------------------------------------------------------------------------------------------------------------------
// Enter member details into the database
// ------------------------------------------------------------------------------------------------------------------

$salt = create_guid(40);
	
if(strlen($password) > 0){	
	
	$sqlquery = mysql_query(sprintf("UPDATE profiles SET company_name='%s', pass_word='%s', salt='%s', email='%s', contact_person='%s', address='%s', tel='%s', fax='%s', web='%s', img1='%s', date_edited=%d WHERE id = %d",
				mysql_real_escape_string($company),
				mysql_real_escape_string(sha1($password . $salt)),
				mysql_real_escape_string($salt),
				mysql_real_escape_string($email),
				mysql_real_escape_string($name),
				mysql_real_escape_string($address),
				mysql_real_escape_string($tel),
				mysql_real_escape_string($fax),
				mysql_real_escape_string($website),
				mysql_real_escape_string($filename1),
				mysql_real_escape_string(time()),
				mysql_real_escape_string($_SESSION['Member_ID'])
				));
			
}else{

	$sqlquery = mysql_query(sprintf("UPDATE profiles SET company_name='%s', email='%s', contact_person='%s', address='%s', tel='%s', fax='%s', web='%s', img1='%s', date_edited=%d WHERE id = %d",
				mysql_real_escape_string($company),
				mysql_real_escape_string($email),
				mysql_real_escape_string($name),
				mysql_real_escape_string($address),
				mysql_real_escape_string($tel),
				mysql_real_escape_string($fax),
				mysql_real_escape_string($website),
				mysql_real_escape_string($filename1),
				mysql_real_escape_string(time()),
				mysql_real_escape_string($_SESSION['Member_ID'])
				));

}

//$_SESSION['MemUpdate'] = 'Your personal details have been updated!<script type="text/javascript">parent.window.location.reload();</script>';
header('Location: ../../my-dashboard');
//echo '<script type="text/javascript">parent.window.location.reload();</script>';
exit();

?>