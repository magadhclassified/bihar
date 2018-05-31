<?php

$field_title = '';
$event_string_feat = '';

$sqlquery = mysql_query(sprintf('SELECT events.*, locations.title ltitle, events_types.title typetitle, emir.title emirate, deve.title development FROM events INNER JOIN locations ON events.geo2_id = locations.id INNER JOIN events_types ON events.type_id = events_types.id INNER JOIN locations emir ON events.geo1_id = emir.id LEFT JOIN locations deve ON events.geo3_id = deve.id WHERE events.status=1 AND locations.status=1 AND events_types.status=1 AND events.id=%d',
			mysql_real_escape_string($listing_id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$field_title = filer_out_limit($row['title']);
	$field_price = filer_out_limit($row['price']);
	$field_type = filer_out_limit($row['typetitle']);
	$field_location = filer_out_limit($row['ltitle']);
	$field_emirate = filer_out_limit($row['emirate']);
	$field_price = filer_out_limit($row['price']);
	$field_times = filer_out_limit($row['times']);
	$field_venue = filer_out_limit($row['venue']);
	$field_web = filer_out_limit($row['website']);
	
	$field_development = '';
	if(isset($row['development'])){
		$field_development = filer_out_limit($row['development']);
	}
	
	$field_content = filer_out_limit($row['contents']);
	$field_kw = filer_out_limit($row['keywords']);
	$field_date = filer_out_limit($row['date_created']);
	$field_brief = filer_out_limit($row['brief']);
	$field_img1 = filer_out_limit($row['img1']);
	$field_contact_name = filer_out_limit($row['contact_name']);
	$field_contact_number = filer_out_limit($row['contact_number']);
	$field_gps_lat = filer_out_limit($row['gps_lat']);
	$field_gps_lon = filer_out_limit($row['gps_lon']);
	$field_member_id = filer_out_limit($row['member_id']);
	
	$field_date_to = filer_out_limit($row['date_to']);
	$field_date_from = filer_out_limit($row['date_from']);
	
	$event_string_feat = date('d M Y', $field_date_from);
	if(date('d M Y', $field_date_to) != date('d M Y', $field_date_from)){$event_string_feat .= ' - ' . date('d M Y', $field_date_to);}
	
	$url = COMPANY_URL . 'event-details/' . $listing_id . '/' . seo($field_title);
	
	$page_data[3] = $field_brief;
	$page_data[4] = $field_kw;
	
	$og_title = $field_title;
	$og_image = COMPANY_URL . 'files/events/thumb/' . $field_img1;
	$og_url = $url;
}
		
if(strlen($field_title) == 0){
	header('Location: ' . COMPANY_URL . 'events');
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

?>