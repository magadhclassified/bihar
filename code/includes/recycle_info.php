<?php

$field_title = '';

$sqlquery = mysql_query(sprintf('SELECT recycle.*, locations.title ltitle, recycle_categories.title cattitle, recycle_conditions.title contitle, recycle_types.title typetitle FROM recycle INNER JOIN locations ON recycle.geo2_id = locations.id INNER JOIN recycle_categories ON recycle.category_id = recycle_categories.id INNER JOIN recycle_conditions ON recycle.condition_id = recycle_conditions.id INNER JOIN recycle_types ON recycle.type_id = recycle_types.id WHERE recycle.status=1 AND locations.status=1 AND recycle_categories.status=1 AND recycle_conditions.status=1 AND recycle_types.status=1 AND recycle.id=%d',
			mysql_real_escape_string($listing_id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$field_title = filer_out_limit($row['title']);
	$field_price = filer_out_limit($row['price']);
	$field_category = filer_out_limit($row['cattitle']);
	$field_condition = filer_out_limit($row['contitle']);
	$field_type = filer_out_limit($row['typetitle']);
	$field_location = filer_out_limit($row['ltitle']);
	$field_content = filer_out_limit($row['contents']);
	$field_kw = filer_out_limit($row['keywords']);
	$field_date = filer_out_limit($row['date_created']);
	$field_brief = date('d F Y', $field_date) . ' - ' . filer_out_limit($row['brief']);
	$field_img1 = filer_out_limit($row['img1']);
	$field_img2 = filer_out_limit($row['img2']);
	$field_img3 = filer_out_limit($row['img3']);
	$field_img4 = filer_out_limit($row['img4']);
	$field_contact_name = filer_out_limit($row['contact_name']);
	$field_contact_number = filer_out_limit($row['contact_number']);
	$field_gps_lat = filer_out_limit($row['gps_lat']);
	$field_gps_lon = filer_out_limit($row['gps_lon']);
	$field_member_id = filer_out_limit($row['member_id']);
	
	$url = COMPANY_URL . 'recycle-details/' . $listing_id . '/' . seo($field_title);
	
	$page_data[3] = $field_brief;
	$page_data[4] = $field_kw;
	
	$og_title = $field_title;
	$og_image = COMPANY_URL . 'files/recycle/thumb/' . $field_img1;
	$og_url = $url;
}
		
if(strlen($field_title) == 0){
	header('Location: ' . COMPANY_URL . 'recycle');
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