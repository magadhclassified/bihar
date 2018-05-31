<?php

if(!isset($caller)){exit('Direct access not allowed.');}

$item_title = '';
$item_ref = '';
$item_salary = '';
$item_industry = 0;
$item_commitment = 0;
$item_type = 0;
$item_geo1 = 0;
$item_geo2 = 0;
$item_geo3 = 0;
$item_contact_name = '';
$item_contact_number = '';
$item_contact_email = '';
$item_brief = '';
$item_keywords = '';
$item_image_file1 = '';
$item_maps_lat = '';
$item_maps_lng = '';
$item_contents = '';
$item_featured = 0;
$item_fp = 0;
$item_active = 1;

if($listing_id > 0){
	$sqlquery = mysql_query(sprintf("SELECT * FROM jobs WHERE id = %d AND member_id = %d",
				mysql_real_escape_string($listing_id),
				mysql_real_escape_string($_SESSION['Member_ID'])
				));

	while($row = mysql_fetch_array($sqlquery)){ 
		$item_title = filter_out($row['title']);
		$item_ref = filter_out($row['ref']);
		$item_salary = filter_out($row['salary']);
		$item_industry = filter_out($row['industry_id']);
		$item_commitment = filter_out($row['commitment_id']);
		$item_type = filter_out($row['type_id']);
		$item_geo1 = filter_out($row['geo1_id']);
		$item_geo2 = filter_out($row['geo2_id']);
		$item_geo3 = filter_out($row['geo3_id']);
		$item_contact_name = filter_out($row['contact_name']);
		$item_contact_number = filter_out($row['contact_number']);
		$item_contact_email = filter_out($row['contact_email']);
		$item_brief = filter_out($row['brief']);
		$item_keywords = filter_out($row['keywords']);
		$item_image_file1 = filter_out($row['img1']);
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
// Industries
// -------------------------------------------------------------------------------------------------------------------------

$industries_listbox = '';

$sqlquery = mysql_query("SELECT id, title FROM jobs_industries ORDER BY title ASC");

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	
	if($form_item_id == $item_industry){
		$industries_listbox .= '<option value="' . $form_item_id . '" selected="selected">&nbsp;' . $form_item_title . '</option>';
	}else{
		$industries_listbox .= '<option value="' . $form_item_id . '">&nbsp;' . $form_item_title . '</option>';
	}
	
}

// -------------------------------------------------------------------------------------------------------------------------
// Commitments
// -------------------------------------------------------------------------------------------------------------------------

$commitments_listbox = '';

$sqlquery = mysql_query("SELECT id, title FROM jobs_commitments ORDER BY title ASC");

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	
	if($form_item_id == $item_commitment){
		$commitments_listbox .= '<option value="' . $form_item_id . '" selected="selected">&nbsp;' . $form_item_title . '</option>';
	}else{
		$commitments_listbox .= '<option value="' . $form_item_id . '">&nbsp;' . $form_item_title . '</option>';
	}
	
}

// -------------------------------------------------------------------------------------------------------------------------
// Types
// -------------------------------------------------------------------------------------------------------------------------

$types_listbox = '';

$sqlquery = mysql_query("SELECT id, title FROM jobs_types ORDER BY title ASC");

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

?>