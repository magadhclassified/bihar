<?php

$field_title = '';

$sqlquery = mysql_query(sprintf('SELECT motors.*, mmake.title maketitle, mmodel.title modeltitle, locations.title ltitle, motors_colours.title colourtitle FROM motors INNER JOIN motors_makes_models mmake ON motors.make_id = mmake.id INNER JOIN motors_makes_models mmodel ON motors.model_id = mmodel.id INNER JOIN locations ON motors.geo2_id = locations.id INNER JOIN motors_colours ON motors.colour_id = motors_colours.id WHERE motors.status=1 AND mmake.status=1 AND mmodel.status=1 AND locations.status=1 AND motors_colours.status=1 AND motors.id=%d',
			mysql_real_escape_string($listing_id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$field_title = filer_out_limit($row['title']);
	$field_price = filer_out_limit($row['price']);
	$field_doors = filer_out_limit($row['doors']);
	$field_mileage = filer_out_limit($row['mileage']);
	$field_year = filer_out_limit($row['age_year']);
	$field_make = filer_out_limit($row['maketitle']);
	$field_model = filer_out_limit($row['modeltitle']);
	$field_colour = filer_out_limit($row['colourtitle']);
	$field_location = filer_out_limit($row['ltitle']);
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
	
	$url = COMPANY_URL . 'motors-details/' . $listing_id . '/' . seo($field_title);
	
	$page_data[3] = $field_brief;
	$page_data[4] = $field_kw;
	
	$og_title = $field_title;
	$og_image = COMPANY_URL . 'files/motors/thumb/' . $field_img1;
	$og_url = $url;
}
		
if(strlen($field_title) == 0){
	header('Location: ' . COMPANY_URL . 'motors');
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