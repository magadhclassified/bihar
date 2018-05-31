<?php

$field_title = '';

$sqlquery = mysql_query(sprintf('SELECT properties.*, locations.title ltitle, properties_categories.title cattitle, properties_types.title typetitle, emir.title emirate, deve.title development FROM properties INNER JOIN locations ON properties.geo2_id = locations.id INNER JOIN properties_categories ON properties.category_id = properties_categories.id INNER JOIN properties_types ON properties.type_id = properties_types.id INNER JOIN locations emir ON properties.geo1_id = emir.id LEFT JOIN locations deve ON properties.geo3_id = deve.id WHERE properties.status=1 AND locations.status=1 AND properties_categories.status=1 AND properties_types.status=1 AND properties.id=%d',
			mysql_real_escape_string($listing_id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$field_title = filer_out_limit($row['title']);
	$field_ref = filer_out_limit($row['ref']);
	$field_bed = filer_out_limit($row['bed']);
	$field_bath = filer_out_limit($row['bath']);
	$field_size = filer_out_limit($row['size_dwelling']);
	$field_price = filer_out_limit($row['price']);
	$field_category = filer_out_limit($row['cattitle']);
	$field_rental_time = filer_out_limit($row['rental_time']);
	$field_no_cheques = filer_out_limit($row['no_cheques']);
	$field_type = filer_out_limit($row['typetitle']);
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
	$field_img1 = filer_out_limit($row['img1']);
	$field_img2 = filer_out_limit($row['img2']);
	$field_img3 = filer_out_limit($row['img3']);
	$field_img4 = filer_out_limit($row['img4']);
	$field_contact_name = filer_out_limit($row['contact_name']);
	$field_contact_number = filer_out_limit($row['contact_number']);
	$field_gps_lat = filer_out_limit($row['gps_lat']);
	$field_gps_lon = filer_out_limit($row['gps_lon']);
	$field_member_id = filer_out_limit($row['member_id']);
	
	$url = COMPANY_URL . 'property-details/' . $listing_id . '/' . seo($field_title);
	
	$page_data[3] = $field_brief;
	$page_data[4] = $field_kw;
	
	$og_title = $field_title;
	$og_image = COMPANY_URL . 'files/property/thumb/' . $field_img1;
	$og_url = $url;
}
		
if(strlen($field_title) == 0){
	header('Location: ' . COMPANY_URL . 'property');
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

// Now get amenities and features
$features_list = '';

$sqlquery = mysql_query(sprintf("SELECT properties_amenities.title FROM properties_amenities_details INNER JOIN properties_amenities ON properties_amenities_details.amenity_id = properties_amenities.id WHERE properties_amenities_details.property_id = %d",
			mysql_real_escape_string($listing_id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$features_list .= '&nbsp;&bull;&nbsp; ' . filter_out($row['title']) . '<br />';
}

// Now get views
$views_list = '';

$sqlquery = mysql_query(sprintf("SELECT properties_views.title FROM properties_views_details INNER JOIN properties_views ON properties_views_details.view_id = properties_views.id WHERE properties_views_details.property_id = %d",
			mysql_real_escape_string($listing_id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$views_list .= '&nbsp;&bull;&nbsp; ' . filter_out($row['title']) . '<br />';
}

?>