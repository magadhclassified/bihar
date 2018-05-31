<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$item_title = '';
$item_ref = '';
$item_price = '';
$item_rentaltime = '';
$item_noCheques = '';
$item_size_dwelling = '';
$item_beds = '';
$item_baths = '';
$item_category = 0;
$item_type = 0;
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
	$sqlquery = mysql_query(sprintf("SELECT * FROM properties WHERE id = %d",
				mysql_real_escape_string($listing_id)
				));

	while($row = mysql_fetch_array($sqlquery)){ 
		$item_title = filter_out($row['title']);
		$item_ref = filter_out($row['ref']);
		$item_price = filter_out($row['price']);
		$item_rentaltime = filter_out($row['rental_time']);
		$item_noCheques = filter_out($row['no_cheques']);
		$item_size_dwelling = filter_out($row['size_dwelling']);
		$item_beds = (int)filter_out($row['bed']);
		$item_baths = (int)filter_out($row['bath']);
		$item_category = filter_out($row['category_id']);
		$item_type = filter_out($row['type_id']);
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
}

// -------------------------------------------------------------------------------------------------------------------------
// Categories
// -------------------------------------------------------------------------------------------------------------------------

$categories_listbox = '';

$sqlquery = mysql_query("SELECT id, title FROM properties_categories ORDER BY title ASC");

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	
	if($form_item_id == $item_category){
		$categories_listbox .= '<option value="' . $form_item_id . '" selected="selected">' . $form_item_title . '</option>';
	}else{
		$categories_listbox .= '<option value="' . $form_item_id . '">' . $form_item_title . '</option>';
	}
	
}

// -------------------------------------------------------------------------------------------------------------------------
// Types
// -------------------------------------------------------------------------------------------------------------------------

$types_listbox = '';

$sqlquery = mysql_query("SELECT id, title FROM properties_types WHERE parent_id = 0 ORDER BY title ASC");

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	
	$types_listbox .= '<optgroup label="' . $form_item_title . '">';
	
	$sqlquery2 = mysql_query("SELECT id, title FROM properties_types WHERE parent_id = " . $form_item_id . " ORDER BY title ASC");
	while($row2 = mysql_fetch_array($sqlquery2)){ 
		$form_item_id2 = filter_out($row2['id']);
		$form_item_title2 = filter_out($row2['title']);
		
		if($form_item_id2 == $item_type){
			$types_listbox .= '<option value="' . $form_item_id2 . '|' . $form_item_id . '" selected="selected">' . $form_item_title2 . '</option>';
		}else{
			$types_listbox .= '<option value="' . $form_item_id2 . '|' . $form_item_id . '">' . $form_item_title2 . '</option>';
		}
	}
	
	$types_listbox .= '</optgroup>';
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
		$geo1_listbox .= '<option value="' . $form_item_id . '" selected="selected">' . $form_item_title . '</option>';
	}else{
		$geo1_listbox .= '<option value="' . $form_item_id . '">' . $form_item_title . '</option>';
	}
}

if($item_geo1 > 0){
	$sqlquery = mysql_query('SELECT id, title FROM locations WHERE parent_id = ' . (int)$item_geo1 . ' ORDER BY title ASC');

	while($row = mysql_fetch_array($sqlquery)){ 
		$form_item_id = filter_out($row['id']);
		$form_item_title = filter_out($row['title']);
		
		if($form_item_id == $item_geo2){
			$geo2_listbox .= '<option value="' . $form_item_id . '" selected="selected">' . $form_item_title . '</option>';
		}else{
			$geo2_listbox .= '<option value="' . $form_item_id . '">' . $form_item_title . '</option>';
		}
	}
}

if($item_geo2 > 0){
	$sqlquery = mysql_query('SELECT id, title FROM locations WHERE parent_id = ' . (int)$item_geo2 . ' ORDER BY title ASC');

	while($row = mysql_fetch_array($sqlquery)){ 
		$form_item_id = filter_out($row['id']);
		$form_item_title = filter_out($row['title']);
		
		if($form_item_id == $item_geo3){
			$geo3_listbox .= '<option value="' . $form_item_id . '" selected="selected">' . $form_item_title . '</option>';
		}else{
			$geo3_listbox .= '<option value="' . $form_item_id . '">' . $form_item_title . '</option>';
		}
	}
}

// -------------------------------------------------------------------------------------------------------------------------
// Members
// -------------------------------------------------------------------------------------------------------------------------

$members_listbox = '';

$sqlquery = mysql_query("SELECT id, contact_person, company_name FROM profiles ORDER BY contact_person ASC");

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['contact_person']);
	$form_item_company = filter_out($row['company_name']);
	
	if(strlen($form_item_company) > 0){$form_item_title .= ' (' . $form_item_company . ')';}
	
	if($form_item_id == $item_member){
		$members_listbox .= '<option value="' . $form_item_id . '" selected="selected">' . $form_item_title . '</option>';
	}else{
		$members_listbox .= '<option value="' . $form_item_id . '">' . $form_item_title . '</option>';
	}
	
}

// -------------------------------------------------------------------------------------------------------------------------
// Views
// -------------------------------------------------------------------------------------------------------------------------

$views_selected = array();
$views_list = '';

$sqlquery = mysql_query(sprintf("SELECT * FROM properties_views_details WHERE property_id = %d",
			mysql_real_escape_string($listing_id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$views_selected[] = filter_out($row['view_id']);
}

// ---	

$sqlquery = mysql_query('SELECT * FROM properties_views ORDER BY title ASC');

while($row = mysql_fetch_array($sqlquery)){ 
	$item_ad_id = filter_out($row['id']);
	$item_ad_title = filter_out($row['title']);

	if(in_array($item_ad_id, $views_selected)){
		$views_list .= '<li><input class="checkbox" name="view[]" value="' . $item_ad_id . '" type="checkbox" checked="checked" />&nbsp;&nbsp;' . $item_ad_title . '</li>';
	}else{
		$views_list .= '<li><input class="checkbox" name="view[]" value="' . $item_ad_id . '" type="checkbox" />&nbsp;&nbsp;' . $item_ad_title . '</li>';
	}
}

// -------------------------------------------------------------------------------------------------------------------------
// Amenities
// -------------------------------------------------------------------------------------------------------------------------

$amenities_selected = array();
$amenities_list = '';

$sqlquery = mysql_query(sprintf("SELECT * FROM properties_amenities_details WHERE property_id = %d",
			mysql_real_escape_string($listing_id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$amenities_selected[] = filter_out($row['amenity_id']);
}

// ---	

$sqlquery = mysql_query('SELECT * FROM properties_amenities ORDER BY title ASC');

while($row = mysql_fetch_array($sqlquery)){ 
	$item_ad_id = filter_out($row['id']);
	$item_ad_title = filter_out($row['title']);

	if(in_array($item_ad_id, $amenities_selected)){
		$amenities_list .= '<li><input class="checkbox" name="amenity[]" value="' . $item_ad_id . '" type="checkbox" checked="checked" />&nbsp;&nbsp;' . $item_ad_title . '</li>';
	}else{
		$amenities_list .= '<li><input class="checkbox" name="amenity[]" value="' . $item_ad_id . '" type="checkbox" />&nbsp;&nbsp;' . $item_ad_title . '</li>';
	}
}

?>