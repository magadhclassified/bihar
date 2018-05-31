<?php

session_start();

include '../../config.php';
include 'conn.php';
include 'functions.php';
include 'class.upload.php';

if(!isset($_SESSION['Member_ID'])){
	exit('Not logged in.');
}

$id = (int)$_POST['id'];
$title = $_POST['title'];
$cat = (int)$_POST['cat'];
$geo1 = (int)$_POST['geo1'];
$geo2 = (int)$_POST['geo2'];
$geo3 = (int)$_POST['geo3'];
$physical = $_POST['physical'];
$postal = $_POST['postal'];
$tel = $_POST['tel'];
$fax = $_POST['fax'];
$web = $_POST['website'];
$contact_email = $_POST['contact_email'];
$map_lat = $_POST['lat'];
$map_lng = $_POST['lng'];
$brief = $_POST['brief'];
$keywords = $_POST['keywords'];
$content_intro = $_POST['content_intro'];
$content = $_POST['content_full'];
$filename1 = $_POST['oldimg1'];

if(isset($_POST['featured'])){$featured = 1;}else{$featured=0;}
if(isset($_POST['fp'])){$fp = 1;}else{$fp=0;}
if(isset($_POST['active'])){$status = 1;}else{$status=0;}

// ---------------------------------------------------------------------------------------------------------------

if($_FILES['frm_upload1']['size'] > 0){
	$handle = new Upload($_FILES['frm_upload1']);
	if ($handle->uploaded && $handle->file_is_image) {
		$handle->Process('../../files/directory/original/');
		if ($handle->processed) {
			$filename1 = $handle->file_dst_name;
		}else{
			echo 'Error: ' . $handle->error . '';
			exit();
		}
		$handle-> Clean();
		
		// Resize - FEATURED
		$handle = new Upload('../../files/directory/original/' . $filename1);
		if ($handle->uploaded) {
			$handle->image_resize = true; $handle->image_x = 242; $handle->image_y = 152; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../files/directory/featured/');
			if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
		}
		
		// Resize - MEDIUM
		$handle = new Upload('../../files/directory/original/' . $filename1);
		if ($handle->uploaded) {
			$handle->image_resize = true; $handle->image_x = 296; $handle->image_y = 204; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../files/directory/medium/');
			if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
		}
		
		// Resize - PROMO
		$handle = new Upload('../../files/directory/original/' . $filename1);
		if ($handle->uploaded) {
			$handle->image_resize = true; $handle->image_x = 195; $handle->image_y = 129; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../files/directory/promo/');
			if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
		}
		
		// Resize - THUMB
		$handle = new Upload('../../files/directory/original/' . $filename1);
		if ($handle->uploaded) {
			$handle->image_resize = true; $handle->image_x = 185; $handle->image_y = 124; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../files/directory/thumb/');
			if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
		}
		
		// Resize - THUMB
		$handle = new Upload('../../files/directory/original/' . $filename1);
		if ($handle->uploaded) {
			$handle->image_resize = true; $handle->image_x = 178; $handle->image_y = 123; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../files/directory/fp/');
			if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
		}
		
		// Resize - SMALL
		$handle = new Upload('../../files/directory/original/' . $filename1);
		if ($handle->uploaded) {
			$handle->image_resize = true; $handle->image_x = 73; $handle->image_y = 55; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../files/directory/small/');
			if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
		}
		
	}else{
		$_SESSION['MemUpdate'] = 'Your listing could not be uploaded/edited: one or more images were invalid.';
		header('Location: ../../my-jobs-manage');
		exit();
	}
}

// ---------------------------------------------------------------------------------------------------------------

if($id > 0){
	
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", 0, 'MEMBER-EDIT', 'Directory (ID: " . $id . "), Member (ID: " . $_SESSION['Member_ID'] . ")', 'directory', " . $id . ")");
		
		$sqlquery = mysql_query(sprintf("UPDATE directory SET title='%s', category_id=%d, geo1_id=%d, geo2_id=%d, geo3_id=%d, company_physical='%s', company_postal='%s', company_tel='%s', company_fax='%s', company_web='%s', contact_email='%s', brief='%s', keywords='%s', img1='%s', gps_lat='%s', gps_lon='%s', contents_intro='%s', contents='%s', date_edited=%d, status=%d WHERE id = %d AND member_id = %d",
					mysql_real_escape_string($title),
					mysql_real_escape_string($cat),
					mysql_real_escape_string($geo1),
					mysql_real_escape_string($geo2),
					mysql_real_escape_string($geo3),
					mysql_real_escape_string($physical),
					mysql_real_escape_string($postal),
					mysql_real_escape_string($tel),
					mysql_real_escape_string($fax),
					mysql_real_escape_string($web),
					mysql_real_escape_string($contact_email),
					mysql_real_escape_string($brief),
					mysql_real_escape_string($keywords),
					mysql_real_escape_string($filename1),
					mysql_real_escape_string($map_lat),
					mysql_real_escape_string($map_lng),
					mysql_real_escape_string($content_intro),
					mysql_real_escape_string($content),
					mysql_real_escape_string(time()),
					mysql_real_escape_string(0),
					mysql_real_escape_string($id),
					mysql_real_escape_string($_SESSION['Member_ID'])
					));
		
}else{
	
	$sqlquery = mysql_query(sprintf("INSERT INTO directory(title, category_id, geo1_id, geo2_id, geo3_id, company_physical, company_postal, company_tel, company_fax, company_web, contact_email, brief, keywords, img1, gps_lat, gps_lon, contents_intro, contents, member_id, date_created, date_edited, is_featured, is_fp, status, gallery_id) VALUES('%s', %d, %d, %d, %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d, %d, %d, %d, %d, %d, %d)",
				mysql_real_escape_string($title),
				mysql_real_escape_string($cat),
				mysql_real_escape_string($geo1),
				mysql_real_escape_string($geo2),
				mysql_real_escape_string($geo3),
				mysql_real_escape_string($physical),
				mysql_real_escape_string($postal),
				mysql_real_escape_string($tel),
				mysql_real_escape_string($fax),
				mysql_real_escape_string($web),
				mysql_real_escape_string($contact_email),
				mysql_real_escape_string($brief),
				mysql_real_escape_string($keywords),
				mysql_real_escape_string($filename1),
				mysql_real_escape_string($map_lat),
				mysql_real_escape_string($map_lng),
				mysql_real_escape_string($content_intro),
				mysql_real_escape_string($content),
				mysql_real_escape_string($_SESSION['Member_ID']),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(0),
				mysql_real_escape_string(0),
				mysql_real_escape_string(0),
				mysql_real_escape_string(0)
				));
				
	$document_id = mysql_insert_id();
	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", 0, 'MEMBER-ADD', 'Directory (ID: " . $document_id . "), Member (ID: " . $_SESSION['Member_ID'] . ")', 'directory', " . $document_id . ")");
	
}

echo '<script type="text/javascript">parent.window.location.reload();</script>';
exit();

?>