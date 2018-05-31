<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$item_title = '';
$item_image_file = '';
$item_image_link = '';
$item_code = '';
$item_date_from = time();
$item_date_to = time() + (86400 * 30);
$item_active = 1;

$zone_id = 0;

if($listing_id > 0){
	$sqlquery = mysql_query(sprintf("SELECT * FROM banners WHERE id = %d",
				mysql_real_escape_string($listing_id)
				));

	while($row = mysql_fetch_array($sqlquery)){ 
		$item_title = filter_out($row['title']);
		$item_image_file = filter_out($row['image_file']);
		$item_image_link = filter_out($row['image_link']);
		$item_code = filter_out($row['banner_code']);
		$item_date_from = filter_out($row['date_from']);
		$item_date_to = filter_out($row['date_to']);
		$item_active = filter_out($row['status']);
	}
}

// ----------------------------------------------------------------------------------------------
// Get zone id for this banner

$sqlquery = mysql_query(sprintf('SELECT zone_id FROM banners_details WHERE banner_id = %d LIMIT 1',
			mysql_real_escape_string($listing_id)
			));
while($row = mysql_fetch_array($sqlquery)){ 
	$zone_id = filter_out($row['zone_id']);
}

$zones_listbox = '';

$sqlquery = mysql_query("SELECT id, title FROM banners_zones ORDER BY id ASC");

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	
	if($form_item_id == $zone_id){
		$zones_listbox .= '<option value="' . $form_item_id . '" selected="selected">' . $form_item_title . '</option>';
	}else{
		$zones_listbox .= '<option value="' . $form_item_id . '">' . $form_item_title . '</option>';
	}
}

// ----------------------------------------------------------------------------------------------

$banner_pages_list = '';
$banner_pages_assigned = array();

// Get current banner assigned pages
$sqlquery = mysql_query(sprintf('SELECT page_id FROM banners_details WHERE banner_id = %d',
			mysql_real_escape_string($listing_id)
			));
while($row = mysql_fetch_array($sqlquery)){ 
	$banner_pages_assigned[] = filter_out($row['page_id']);
}

// Now get all pages for the selected zone and check applicable
$sqlquery = mysql_query(sprintf("SELECT id, title FROM banners_pages WHERE linkage LIKE '%%%s%%' ORDER BY title ASC",
			mysql_real_escape_string('[' . $zone_id . ']')
			));
while($row = mysql_fetch_array($sqlquery)){ 
	$banner_p_id = filter_out($row['id']);
	$banner_p_title = filter_out($row['title']);
	
	if(in_array($banner_p_id, $banner_pages_assigned)){
		$banner_pages_list .= '<li><input class="checkbox" name="pages[]" value="' . $banner_p_id . '" type="checkbox" checked="checked" />&nbsp;&nbsp;' . $banner_p_title . '</li>';
	}else{
		$banner_pages_list .= '<li><input class="checkbox" name="pages[]" value="' . $banner_p_id . '" type="checkbox" />&nbsp;&nbsp;' . $banner_p_title . '</li>';
	}
}

if(strlen($banner_pages_list) == 0){
	$banner_pages_list = 'First select Zone above.';
}

?>