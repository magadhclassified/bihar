<?php

if(!isset($caller)){exit('Direct access not allowed.');}

$item_title = '';
$item_price = '';
$item_distance = '';
$item_type = 0;
$item_rating = 0;
$item_geo1 = 0;
$item_geo2 = 0;
$item_geo3 = 0;
$item_member = 0;
$item_contact_name = '';
$item_contact_number = '';
$item_contact_email = '';
$item_brief = '';
$item_keywords = '';
$item_image_file1 = '';
$item_image_file2 = '';
$item_image_file3 = '';
$item_image_file4 = '';
$item_maps_lat = '';
$item_maps_lng = '';
$item_contents = '';
$item_featured = 0;
$item_fp = 0;
$item_active = 1;

if($listing_id > 0){
	$sqlquery = mysql_query(sprintf("SELECT * FROM accommodation WHERE id = %d AND member_id = %d",
				mysql_real_escape_string($listing_id),
				mysql_real_escape_string($_SESSION['Member_ID'])
				));

	while($row = mysql_fetch_array($sqlquery)){ 
		$item_title = filter_out($row['title']);
		$item_price = filter_out($row['price']);
		$item_distance = filter_out($row['from_airport']);
		$item_type = filter_out($row['type_id']);
		$item_rating = filter_out($row['rating_id']);
		$item_geo1 = filter_out($row['geo1_id']);
		$item_geo2 = filter_out($row['geo2_id']);
		$item_geo3 = filter_out($row['geo3_id']);
		$item_member = filter_out($row['member_id']);
		$item_contact_name = filter_out($row['contact_name']);
		$item_contact_number = filter_out($row['contact_number']);
		$item_contact_email = filter_out($row['contact_email']);
		$item_brief = filter_out($row['brief']);
		$item_keywords = filter_out($row['keywords']);
		$item_image_file1 = filter_out($row['img1']);
		$item_image_file2 = filter_out($row['img2']);
		$item_image_file3 = filter_out($row['img3']);
		$item_image_file4 = filter_out($row['img4']);
		$item_maps_lat = filter_out($row['gps_lat']);
		$item_maps_lng = filter_out($row['gps_lon']);
		$item_contents = filter_out($row['contents']);
		$item_featured = filter_out($row['is_featured']);
		$item_fp = filter_out($row['is_fp']);
		$item_active = filter_out($row['status']);
	}
	if(strlen($item_title) == 0){
		header('Location: ' . COMPANY_URL . 'my-dashboard');
		exit();
	}
}

// -------------------------------------------------------------------------------------------------------------------------
// Types
// -------------------------------------------------------------------------------------------------------------------------

$types_listbox = '';

$sqlquery = mysql_query("SELECT id, title FROM accommodation_types ORDER BY title ASC");

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	
	if($form_item_id == $item_type){
		$types_listbox .= '<option value="' . $form_item_id . '" selected="selected">&nbsp;' . $form_item_title . '</option>';
	}else{
		$types_listbox .= '<option value="' . $form_item_id . '">&nbsp;' . $form_item_title . '</option>';
	}
	
}

// -------------------------------------------------------------------------------------------------------------------------
// Ratings
// -------------------------------------------------------------------------------------------------------------------------

$ratings_listbox = '';

$sqlquery = mysql_query("SELECT id, title FROM accommodation_ratings ORDER BY rating_value ASC");

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	
	if($form_item_id == $item_rating){
		$ratings_listbox .= '<option value="' . $form_item_id . '" selected="selected">&nbsp;' . $form_item_title . '</option>';
	}else{
		$ratings_listbox .= '<option value="' . $form_item_id . '">&nbsp;' . $form_item_title . '</option>';
	}
	
}

// -------------------------------------------------------------------------------------------------------------------------
// Geographic
// -------------------------------------------------------------------------------------------------------------------------

$geo1_listbox = '';
$geo2_listbox = '';
$geo3_listbox = '';

$sqlquery = mysql_query('SELECT id, title FROM locations WHERE parent_id = 0 ORDER BY title ASC');

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	
	if($form_item_id == $item_geo1){
		$geo1_listbox .= '<option value="' . $form_item_id . '" selected="selected">&nbsp;' . $form_item_title . '</option>';
	}else{
		$geo1_listbox .= '<option value="' . $form_item_id . '">&nbsp;' . $form_item_title . '</option>';
	}
}

if($item_geo1 > 0){
	$sqlquery = mysql_query('SELECT id, title FROM locations WHERE parent_id = ' . (int)$item_geo1 . ' ORDER BY title ASC');

	while($row = mysql_fetch_array($sqlquery)){ 
		$form_item_id = filter_out($row['id']);
		$form_item_title = filter_out($row['title']);
		
		if($form_item_id == $item_geo2){
			$geo2_listbox .= '<option value="' . $form_item_id . '" selected="selected">&nbsp;' . $form_item_title . '</option>';
		}else{
			$geo2_listbox .= '<option value="' . $form_item_id . '">&nbsp;' . $form_item_title . '</option>';
		}
	}
}

if($item_geo2 > 0){
	$sqlquery = mysql_query('SELECT id, title FROM locations WHERE parent_id = ' . (int)$item_geo2 . ' ORDER BY title ASC');

	while($row = mysql_fetch_array($sqlquery)){ 
		$form_item_id = filter_out($row['id']);
		$form_item_title = filter_out($row['title']);
		
		if($form_item_id == $item_geo3){
			$geo3_listbox .= '<option value="' . $form_item_id . '" selected="selected">&nbsp;' . $form_item_title . '</option>';
		}else{
			$geo3_listbox .= '<option value="' . $form_item_id . '">&nbsp;' . $form_item_title . '</option>';
		}
	}
}

// -------------------------------------------------------------------------------------------------------------------------
// Facilities
// -------------------------------------------------------------------------------------------------------------------------

$facilities_selected = array();
$facilities_list = '';

$sqlquery = mysql_query(sprintf("SELECT * FROM accommodation_facilities_details WHERE accommodation_id = %d",
			mysql_real_escape_string($listing_id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$facilities_selected[] = filter_out($row['facility_id']);
}

// ---	

$sqlquery = mysql_query('SELECT * FROM accommodation_facilities ORDER BY title ASC');

while($row = mysql_fetch_array($sqlquery)){ 
	$item_ad_id = filter_out($row['id']);
	$item_ad_title = filter_out($row['title']);

	if(in_array($item_ad_id, $facilities_selected)){
		$facilities_list .= '<option value="' . $item_ad_id . '" selected="selected">&nbsp;' . $item_ad_title . '</option>';
	}else{
		$facilities_list .= '<option value="' . $item_ad_id . '">&nbsp;' . $item_ad_title . '</option>';
	}
}

?>