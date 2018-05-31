<?php

session_start();

if(!isset($_SESSION['Admin_Logged_In']) ||  $_SESSION['Admin_Logged_In'] != "YES"){
	echo "Restricted access.";
	exit();
}

include '../../../config.php';
include 'conn.php';
include 'functions.php';
include 'class.upload.php';

$is_caller = true;
include 'my_info.php';
if(!check_perms('motors', $account_permissions)){die('Unauthorised access.');}

$id = (int)$_POST['id'];
$title = $_POST['title'];
$price = $_POST['price'];
$doors = (int)$_POST['doors'];
$mileage = (int)$_POST['mileage'];
$year = (int)$_POST['year'];
$mm = $_POST['mm'];
$colour = (int)$_POST['colour'];
$type = (int)$_POST['type'];
$geo1 = (int)$_POST['geo1'];
$geo2 = (int)$_POST['geo2'];
$geo3 = (int)$_POST['geo3'];
$member = $_POST['member'];
$contact_name = $_POST['contact_name'];
$contact_number = $_POST['contact_number'];
$contact_email = $_POST['contact_email'];
$map_lat = $_POST['lat'];
$map_lng = $_POST['lng'];
$brief = $_POST['brief'];
$keywords = $_POST['keywords'];
$content = $_POST['content_full'];
$filename1 = $_POST['oldimg1'];
$filename2 = $_POST['oldimg2'];
$filename3 = $_POST['oldimg3'];
$filename4 = $_POST['oldimg4'];

$temp_mm = explode('|', $mm);
$make = (int)$temp_mm[1];
$model = (int)$temp_mm[0];

if(isset($_POST['featured'])){$featured = 1;}else{$featured=0;}
if(isset($_POST['fp'])){$fp = 1;}else{$fp=0;}
if(isset($_POST['active'])){$status = 1;}else{$status=0;}

// ---------------------------------------------------------------------------------------------------------------

for($x=1; $x<=4; $x++){
	if($_FILES['frm_upload' . $x]['size'] > 0){
		$handle = new Upload($_FILES['frm_upload' . $x]);
		if ($handle->uploaded && $handle->file_is_image) {
		
			$file__name = '';
			
			$handle->Process('../../../files/motors/original/');
			if ($handle->processed) {
				$file__name = $handle->file_dst_name;
			}else{
				echo 'Error: ' . $handle->error . '';
				exit();
			}
			$handle-> Clean();
			
			// Resize - FEATURED
			$handle = new Upload('../../../files/motors/original/' . $file__name);
			if ($handle->uploaded) {
				$handle->image_resize = true; $handle->image_x = 242; $handle->image_y = 152; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../../files/motors/featured/');
				if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
			}
			
			// Resize - MEDIUM
			$handle = new Upload('../../../files/motors/original/' . $file__name);
			if ($handle->uploaded) {
				$handle->image_resize = true; $handle->image_x = 296; $handle->image_y = 204; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../../files/motors/medium/');
				if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
			}
			
			// Resize - PROMO
			$handle = new Upload('../../../files/motors/original/' . $file__name);
			if ($handle->uploaded) {
				$handle->image_resize = true; $handle->image_x = 195; $handle->image_y = 129; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../../files/motors/promo/');
				if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
			}
			
			// Resize - THUMB
			$handle = new Upload('../../../files/motors/original/' . $file__name);
			if ($handle->uploaded) {
				$handle->image_resize = true; $handle->image_x = 185; $handle->image_y = 124; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../../files/motors/thumb/');
				if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
			}
			
			// Resize - FP
			$handle = new Upload('../../../files/motors/original/' . $file__name);
			if ($handle->uploaded) {
				$handle->image_resize = true; $handle->image_x = 178; $handle->image_y = 123; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../../files/motors/fp/');
				if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
			}
			
			// Resize - SMALL
			$handle = new Upload('../../../files/motors/original/' . $file__name);
			if ($handle->uploaded) {
				$handle->image_resize = true; $handle->image_x = 73; $handle->image_y = 55; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../../files/motors/small/');
				if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
			}
			
			switch($x){
				case 1: $filename1 = $file__name; break;
				case 2: $filename2 = $file__name; break;
				case 3: $filename3 = $file__name; break;
				case 4: $filename4 = $file__name; break;
			}
			
		}else{
			$_SESSION['FormAction'] = 'ERROR';
		}
	}
}

// ---------------------------------------------------------------------------------------------------------------

if($id > 0){
	
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'EDIT', 'Listings - Motors', 'motors', " . $id . ")");
		
		$sqlquery = mysql_query(sprintf("UPDATE motors SET title='%s', price=%f, doors=%d, mileage=%d, age_year=%d, make_id=%d, model_id=%d, colour_id=%d, type_id=%d, geo1_id=%d, geo2_id=%d, geo3_id=%d, contact_name='%s', contact_number='%s', contact_email='%s', brief='%s', keywords='%s', img1='%s', img2='%s', img3='%s', img4='%s', gps_lat='%s', gps_lon='%s', contents='%s', member_id=%d, date_edited=%d, is_featured=%d, is_fp=%d, status=%d WHERE id = %d",
					mysql_real_escape_string($title),
					mysql_real_escape_string($price),
					mysql_real_escape_string($doors),
					mysql_real_escape_string($mileage),
					mysql_real_escape_string($year),
					mysql_real_escape_string($make),
					mysql_real_escape_string($model),
					mysql_real_escape_string($colour),
					mysql_real_escape_string($type),
					mysql_real_escape_string($geo1),
					mysql_real_escape_string($geo2),
					mysql_real_escape_string($geo3),
					mysql_real_escape_string($contact_name),
					mysql_real_escape_string($contact_number),
					mysql_real_escape_string($contact_email),
					mysql_real_escape_string($brief),
					mysql_real_escape_string($keywords),
					mysql_real_escape_string($filename1),
					mysql_real_escape_string($filename2),
					mysql_real_escape_string($filename3),
					mysql_real_escape_string($filename4),
					mysql_real_escape_string($map_lat),
					mysql_real_escape_string($map_lng),
					mysql_real_escape_string($content),
					mysql_real_escape_string($member),
					mysql_real_escape_string(time()),
					mysql_real_escape_string($featured),
					mysql_real_escape_string($fp),
					mysql_real_escape_string($status),
					mysql_real_escape_string($id)
					));

}else{
	
	$sqlquery = mysql_query(sprintf("INSERT INTO motors(title, price, doors, mileage, age_year, make_id, model_id, colour_id, type_id, geo1_id, geo2_id, geo3_id, contact_name, contact_number, contact_email, brief, keywords, img1, img2, img3, img4, gps_lat, gps_lon, contents, member_id, date_created, date_edited, is_featured, is_fp, status) VALUES('%s', %f, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d, %d, %d, %d, %d, %d)",
				mysql_real_escape_string($title),
				mysql_real_escape_string($price),
				mysql_real_escape_string($doors),
				mysql_real_escape_string($mileage),
				mysql_real_escape_string($year),
				mysql_real_escape_string($make),
				mysql_real_escape_string($model),
				mysql_real_escape_string($colour),
				mysql_real_escape_string($type),
				mysql_real_escape_string($geo1),
				mysql_real_escape_string($geo2),
				mysql_real_escape_string($geo3),
				mysql_real_escape_string($contact_name),
				mysql_real_escape_string($contact_number),
				mysql_real_escape_string($contact_email),
				mysql_real_escape_string($brief),
				mysql_real_escape_string($keywords),
				mysql_real_escape_string($filename1),
				mysql_real_escape_string($filename2),
				mysql_real_escape_string($filename3),
				mysql_real_escape_string($filename4),
				mysql_real_escape_string($map_lat),
				mysql_real_escape_string($map_lng),
				mysql_real_escape_string($content),
				mysql_real_escape_string($member),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(time()),
				mysql_real_escape_string($featured),
				mysql_real_escape_string($fp),
				mysql_real_escape_string($status)
				));
	
	$document_id = mysql_insert_id();
	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", " . $_SESSION['Admin_ID'] . ", 'ADD', 'Listings - Motors', 'motors', " . $document_id . ")");
	
}

header('Location: ../../motors');

?>