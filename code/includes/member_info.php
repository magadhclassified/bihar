<?php

if(!isset($caller)){exit('Direct access not allowed.');}

/*if(!isset($_SESSION['Member_Done_Login'])){
	// First see if a profile entry exists for this member...
	$mem_x_counts = 0;
	$mem_x_actual_id = 0;
	$sqlquery = mysql_query(sprintf("SELECT id FROM profiles WHERE member_id = %d",
				mysql_real_escape_string($_SESSION['Member_ID'])
				));
	while($row = mysql_fetch_array($sqlquery)){ 
		$mem_x_actual_id = $row['id'];
		$mem_x_counts++;
	}

	// If not, create one
	if($mem_x_counts == 0){
		$sqlquery = mysql_query(sprintf("INSERT INTO profiles(company_name, contact_person, email, address, tel, fax, web, img1, member_id, member_type, date_created, date_edited) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d, '%s', %d, %d)",
					mysql_real_escape_string('Private'),
					mysql_real_escape_string($_SESSION['Member_Name']),
					mysql_real_escape_string($_SESSION['Member_Email']),
					mysql_real_escape_string(''),
					mysql_real_escape_string($_SESSION['Member_Number']),
					mysql_real_escape_string(''),
					mysql_real_escape_string(''),
					mysql_real_escape_string(''),
					mysql_real_escape_string($_SESSION['Member_ID']),
					mysql_real_escape_string($_SESSION['Member_Type']),
					mysql_real_escape_string(time()),
					mysql_real_escape_string(time())
					));
		$mem_x_actual_id = mysql_insert_id();
	}
	// Get profile info, change the Member_ID session to use the 7Day Market ID system, not 7Days member id

	$_SESSION['Member_ID'] = $mem_x_actual_id;
	$_SESSION['Member_Done_Login'] = 'YES';
}*/

$sqlquery = mysql_query(sprintf("SELECT * FROM profiles WHERE id = %d",
			mysql_real_escape_string($_SESSION['Member_ID'])
			));
while($row = mysql_fetch_array($sqlquery)){ 
	$member_name = filer_out_limit($row['contact_person']);
	$member_email = filer_out_limit($row['email']);
	$member_number = filer_out_limit($row['tel']);
	$member_company = filer_out_limit($row['company_name']);
	$member_address = filer_out_limit($row['address']);
	$member_fax = filer_out_limit($row['fax']);
	$member_website = filer_out_limit($row['web']);
	$member_logo = filer_out_limit($row['img1']);
	if(strlen($member_logo) == 0){$member_logo='company-logo.jpg';}
}

?>