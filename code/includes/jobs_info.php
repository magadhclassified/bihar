<?php

$field_title = '';

$sqlquery = mysql_query(sprintf('SELECT jobs.*, locations.title ltitle, jobs_commitments.title ctitle FROM jobs INNER JOIN locations ON jobs.geo2_id = locations.id INNER JOIN jobs_commitments ON jobs.commitment_id = jobs_commitments.id WHERE jobs.id = %d AND jobs.status = 1',
			mysql_real_escape_string($listing_id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$field_title = filer_out_limit($row['title']);
	$field_salary = filer_out_limit($row['salary']);
	$field_ref = filer_out_limit($row['ref']);
	$field_location = filer_out_limit($row['ltitle']);
	$field_commitment = filer_out_limit($row['ctitle']);
	$field_content = filer_out_limit($row['contents']);
	$field_kw = filer_out_limit($row['keywords']);
	$field_date = filer_out_limit($row['date_created']);
	$field_brief = filer_out_limit($row['brief']);
	$field_img = filer_out_limit($row['img1']);
	$field_contact_name = filer_out_limit($row['contact_name']);
	$field_contact_number = filer_out_limit($row['contact_number']);
	$field_gps_lat = filer_out_limit($row['gps_lat']);
	$field_gps_lon = filer_out_limit($row['gps_lon']);
	$field_member_id = filer_out_limit($row['member_id']);
	
	$url = COMPANY_URL . 'job-details/' . $listing_id . '/' . seo($field_title);
	if(strlen($field_img) == 0){$field_img = 'none.jpg';}
	
	$page_data[3] = $field_brief;
	$page_data[4] = $field_kw;
	
	$og_title = $field_title;
	$og_image = COMPANY_URL . 'files/jobs/thumb/' . $field_img;
	$og_url = $url;
}
		
if(strlen($field_title) == 0){
	header('Location: ' . COMPANY_URL . 'jobs');
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