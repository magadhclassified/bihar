<?php

$field_title = '';

$sqlquery = mysql_query(sprintf('SELECT accommodation.*, locations.title ltitle, accommodation_types.title typetitle, accommodation_ratings.rating_value ratingvalue, emir.title emirate, deve.title development FROM accommodation INNER JOIN locations ON accommodation.geo2_id = locations.id INNER JOIN accommodation_types ON accommodation.type_id = accommodation_types.id INNER JOIN accommodation_ratings ON accommodation.rating_id = accommodation_ratings.id INNER JOIN locations emir ON accommodation.geo1_id = emir.id LEFT JOIN locations deve ON accommodation.geo3_id = deve.id WHERE accommodation.status=1 AND locations.status=1 AND accommodation_ratings.status=1 AND accommodation_types.status=1 AND accommodation.id=%d',
			mysql_real_escape_string($listing_id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$field_title = filer_out_limit($row['title']);
	$field_price = filer_out_limit($row['price']);
	$field_type = filer_out_limit($row['typetitle']);
	$field_rating = filer_out_limit($row['ratingvalue']);
	$field_location = filer_out_limit($row['ltitle']);
	$field_emirate = filer_out_limit($row['emirate']);
	$field_airport = filer_out_limit($row['from_airport']);
	
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
	
	$url = COMPANY_URL . 'accommodation-details/' . $listing_id . '/' . seo($field_title);
	
	$page_data[3] = $field_brief;
	$page_data[4] = $field_kw;
	
	$og_title = $field_title;
	$og_image = COMPANY_URL . 'files/accommodation/thumb/' . $field_img1;
	$og_url = $url;
}
		
if(strlen($field_title) == 0){
	header('Location: ' . COMPANY_URL . 'accommodation');
	exit();
}

// Determine rating stars
$rating_stars = '';
if($field_rating == 0){
	$rating_stars = 'Not Rated';
}else{
	$base_stars = floor($field_rating);
	for($k=1; $k<=$base_stars; $k++){
		$rating_stars .= '<img src="graphics/icons/details-rating-full.png" alt="" />';
	}
	if($field_rating > $base_stars){
		$rating_stars .= '<img src="graphics/icons/details-rating-half.png" alt="" />';
	}
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

// Facilities
$facilities_array = array();
$facilities_list = '';

$sqlquery = mysql_query(sprintf("SELECT accommodation_facilities.title FROM accommodation_facilities_details INNER JOIN accommodation_facilities ON accommodation_facilities_details.facility_id = accommodation_facilities.id WHERE accommodation_facilities_details.accommodation_id = %d ORDER BY accommodation_facilities.title ASC",
			mysql_real_escape_string($listing_id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$facilities_array[] = filter_out($row['title']);
}

$facilities_list = implode(', ', $facilities_array);

?>