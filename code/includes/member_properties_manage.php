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
$category = (int)$_POST['category'];
$typemain = $_POST['type'];
$price = $_POST['price'];
$rental_time = $_POST['rentaltime'];
$no_cheques = $_POST['no_cheques'];
$ref = $_POST['ref'];
$size_dwelling = $_POST['dwelling'];
$bed = $_POST['bed'];
$bath = $_POST['bath'];
$geo1 = (int)$_POST['geo1'];
$geo2 = (int)$_POST['geo2'];
$geo3 = (int)$_POST['geo3'];
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

$temp_mm = explode('|', $typemain);
$type_main = (int)$temp_mm[1];
$type_sub = (int)$temp_mm[0];

if(isset($_POST['featured'])){$featured = 1;}else{$featured=0;}
if(isset($_POST['fp'])){$fp = 1;}else{$fp=0;}
if(isset($_POST['active'])){$status = 1;}else{$status=0;}

if(isset($_POST['view'])){
	$views = $_POST['view'];
}else{
	$views = array();
}

if(isset($_POST['amenity'])){
	$amenities = $_POST['amenity'];
}else{
	$amenities = array();
}

// ---------------------------------------------------------------------------------------------------------------

for($x=1; $x<=4; $x++){
	if($_FILES['frm_upload' . $x]['size'] > 0){
		$handle = new Upload($_FILES['frm_upload' . $x]);
		if ($handle->uploaded && $handle->file_is_image) {
		
			$file__name = '';
			
			$handle->Process('../../files/property/original/');
			if ($handle->processed) {
				$file__name = $handle->file_dst_name;
			}else{
				echo 'Error: ' . $handle->error . '';
				exit();
			}
			$handle-> Clean();
			
			// Resize - FEATURED
			$handle = new Upload('../../files/property/original/' . $file__name);
			if ($handle->uploaded) {
				$handle->image_resize = true; $handle->image_x = 242; $handle->image_y = 152; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../files/property/featured/');
				if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
			}
			
			// Resize - MEDIUM
			$handle = new Upload('../../files/property/original/' . $file__name);
			if ($handle->uploaded) {
				$handle->image_resize = true; $handle->image_x = 296; $handle->image_y = 204; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../files/property/medium/');
				if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
			}
			
			// Resize - PROMO
			$handle = new Upload('../../files/property/original/' . $file__name);
			if ($handle->uploaded) {
				$handle->image_resize = true; $handle->image_x = 195; $handle->image_y = 129; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../files/property/promo/');
				if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
			}
			
			// Resize - THUMB
			$handle = new Upload('../../files/property/original/' . $file__name);
			if ($handle->uploaded) {
				$handle->image_resize = true; $handle->image_x = 185; $handle->image_y = 124; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../files/property/thumb/');
				if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
			}
			
			// Resize - FP
			$handle = new Upload('../../files/property/original/' . $file__name);
			if ($handle->uploaded) {
				$handle->image_resize = true; $handle->image_x = 178; $handle->image_y = 123; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../files/property/fp/');
				if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
			}
			
			// Resize - SMALL
			$handle = new Upload('../../files/property/original/' . $file__name);
			if ($handle->uploaded) {
				$handle->image_resize = true; $handle->image_x = 73; $handle->image_y = 55; $handle->image_ratio_crop = true; $handle->jpeg_quality = 100; $handle->Process('../../files/property/small/');
				if ($handle->processed) {}else{echo 'Error: ' . $handle->error . ''; exit();}
			}
			
			switch($x){
				case 1: $filename1 = $file__name; break;
				case 2: $filename2 = $file__name; break;
				case 3: $filename3 = $file__name; break;
				case 4: $filename4 = $file__name; break;
			}
			
		}else{
			$_SESSION['MemUpdate'] = 'Your listing could not be uploaded/edited: one or more images were invalid.';
			header('Location: ../../my-property-manage');
			exit();
		}
	}
}

// ---------------------------------------------------------------------------------------------------------------

if($id > 0){
	
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", 0, 'MEMBER-EDIT', 'Properties (ID: " . $id . "), Member (ID: " . $_SESSION['Member_ID'] . ")', 'properties', " . $id . ")");
		
		$sqlquery = mysql_query(sprintf("UPDATE properties SET title='%s', ref='%s', price=%f, rental_time='%s', no_cheques='%s', size_dwelling=%f, bed=%f, bath=%f, category_id=%d, type_main_id=%d, type_id=%d, geo1_id=%d, geo2_id=%d, geo3_id=%d, contact_name='%s', contact_number='%s', contact_email='%s', brief='%s', keywords='%s', img1='%s', img2='%s', img3='%s', img4='%s', gps_lat='%s', gps_lon='%s', contents='%s', date_edited=%d, status=%d WHERE id = %d AND member_id = %d",
					mysql_real_escape_string($title),
					mysql_real_escape_string($ref),
					mysql_real_escape_string($price),
					mysql_real_escape_string($rental_time),
					mysql_real_escape_string($no_cheques),
					mysql_real_escape_string($size_dwelling),
					mysql_real_escape_string($bed),
					mysql_real_escape_string($bath),
					mysql_real_escape_string($category),
					mysql_real_escape_string($type_main),
					mysql_real_escape_string($type_sub),
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
					mysql_real_escape_string(time()),
					mysql_real_escape_string(0),
					mysql_real_escape_string($id),
					mysql_real_escape_string($_SESSION['Member_ID'])
					));
					
		// Do views and amenities
		
		mysql_query(sprintf("DELETE FROM properties_views_details WHERE property_id = %d", mysql_real_escape_string($id)));
		mysql_query(sprintf("DELETE FROM properties_amenities_details WHERE property_id = %d", mysql_real_escape_string($id)));
		
		foreach($views as $s){
			$sqlquery = mysql_query(sprintf("INSERT INTO properties_views_details(property_id, view_id) VALUES(%d, %d)",
						mysql_real_escape_string($id),
						mysql_real_escape_string($s)
						));
		}
		foreach($amenities as $s){
			$sqlquery = mysql_query(sprintf("INSERT INTO properties_amenities_details(property_id, amenity_id) VALUES(%d, %d)",
						mysql_real_escape_string($id),
						mysql_real_escape_string($s)
						));
		}

}else{
	
	$sqlquery = mysql_query(sprintf("INSERT INTO properties(title, ref, price, rental_time, no_cheques, size_dwelling, bed, bath, category_id, type_main_id, type_id, geo1_id, geo2_id, geo3_id, contact_name, contact_number, contact_email, brief, keywords, img1, img2, img3, img4, gps_lat, gps_lon, contents, member_id, date_created, date_edited, is_featured, is_fp, status) VALUES('%s', '%s', %f, '%s', '%s', %f, %f, %f, %d, %d, %d, %d, %d, %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d, %d, %d, %d, %d, %d)",
				mysql_real_escape_string($title),
				mysql_real_escape_string($ref),
				mysql_real_escape_string($price),
				mysql_real_escape_string($rental_time),
				mysql_real_escape_string($no_cheques),
				mysql_real_escape_string($size_dwelling),
				mysql_real_escape_string($bed),
				mysql_real_escape_string($bath),
				mysql_real_escape_string($category),
				mysql_real_escape_string($type_main),
				mysql_real_escape_string($type_sub),
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
				mysql_real_escape_string($_SESSION['Member_ID']),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(0),
				mysql_real_escape_string(0),
				mysql_real_escape_string(0)
				));
				
	// Do views and amenities
	
	$document_id = mysql_insert_id();
	
	foreach($views as $s){
		$sqlquery = mysql_query(sprintf("INSERT INTO properties_views_details(property_id, view_id) VALUES(%d, %d)",
					mysql_real_escape_string($document_id),
					mysql_real_escape_string($s)
					));
	}
	foreach($amenities as $s){
		$sqlquery = mysql_query(sprintf("INSERT INTO properties_amenities_details(property_id, amenity_id) VALUES(%d, %d)",
					mysql_real_escape_string($document_id),
					mysql_real_escape_string($s)
					));
	}
	
	mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", 0, 'MEMBER-ADD', 'Properties (ID: " . $document_id . "), Member (ID: " . $_SESSION['Member_ID'] . ")', 'properties', " . $document_id . ")");
	
}

echo '<script type="text/javascript">parent.window.location.reload();</script>';
exit();

?>