<?php

$field_title = '';

$sqlquery = mysql_query(sprintf('SELECT restaurants.*, locations.title ltitle, restaurants_menus.title menutitle, restaurants_dresscodes.title dresscodetitle, emir.title emirate, deve.title development FROM restaurants INNER JOIN locations ON restaurants.geo2_id = locations.id INNER JOIN restaurants_menus ON restaurants.menu_id = restaurants_menus.id INNER JOIN restaurants_dresscodes ON restaurants.dresscode_id = restaurants_dresscodes.id INNER JOIN locations emir ON restaurants.geo1_id = emir.id LEFT JOIN locations deve ON restaurants.geo3_id = deve.id WHERE restaurants.status=1 AND locations.status=1 AND restaurants_dresscodes.status=1 AND restaurants_menus.status=1 AND restaurants.id=%d',
			mysql_real_escape_string($listing_id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$field_title = filer_out_limit($row['title']);
	$field_price = filer_out_limit($row['price']);
	$field_menu = filer_out_limit($row['menutitle']);
	$field_dresscode = filer_out_limit($row['dresscodetitle']);
	$field_location = filer_out_limit($row['ltitle']);
	$field_emirate = filer_out_limit($row['emirate']);
	
	$field_development = '';
	if(isset($row['development'])){
		$field_development = filer_out_limit($row['development']);
	}
	
	$field_content = filer_out_limit($row['contents']);
	$field_kw = filer_out_limit($row['keywords']);
	$field_date = filer_out_limit($row['date_created']);
	$field_brief = filer_out_limit($row['brief']);
	$field_address = filer_out_limit($row['address']);
	$field_img1 = filer_out_limit($row['img1']);
	$field_img2 = filer_out_limit($row['img2']);
	$field_img3 = filer_out_limit($row['img3']);
	$field_img4 = filer_out_limit($row['img4']);
	$field_contact_name = filer_out_limit($row['contact_name']);
	$field_contact_number = filer_out_limit($row['contact_number']);
	$field_gps_lat = filer_out_limit($row['gps_lat']);
	$field_gps_lon = filer_out_limit($row['gps_lon']);
	$field_member_id = filer_out_limit($row['member_id']);
	
	$url = COMPANY_URL . 'restaurant-details/' . $listing_id . '/' . seo($field_title);
	
	$page_data[3] = $field_brief;
	$page_data[4] = $field_kw;
	
	$og_title = $field_title;
	$og_image = COMPANY_URL . 'files/restaurants/thumb/' . $field_img1;
	$og_url = $url;
}
		
if(strlen($field_title) == 0){
	header('Location: ' . COMPANY_URL . 'restaurants');
	exit();
}

// Now get contact details
$sqlquery = mysql_query(sprintf('SELECT * FROM profiles WHERE id=%d',
			mysql_real_escape_string($field_member_id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$field_profile_company = filer_out_limit($row['company_name']);
	$field_profile_contact = filer_out_limit($row['contact_person']);
	$field_profile_address = filer_out_limit($row['address']);
	$field_profile_tel = filer_out_limit($row['tel']);
	$field_profile_fax = filer_out_limit($row['fax']);
	$field_profile_web = filer_out_limit($row['web']);
	$field_profile_img = filer_out_limit($row['img1']);
}

// Cuisines
$cuisines_array = array();
$cuisines_list = '';

$sqlquery = mysql_query(sprintf("SELECT restaurants_cuisines.title FROM restaurants_cuisines_details INNER JOIN restaurants_cuisines ON restaurants_cuisines_details.cuisine_id = restaurants_cuisines.id WHERE restaurants_cuisines_details.restaurant_id = %d ORDER BY restaurants_cuisines.title ASC",
			mysql_real_escape_string($listing_id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$cuisines_array[] = filter_out($row['title']);
}

$cuisines_list = implode(', ', $cuisines_array);

?>