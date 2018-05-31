<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$item_name = '';
$item_email = '';
$item_company = '';
$item_address = '';
$item_tel = '';
$item_fax = '';
$item_website = '';
$item_image_file = '';
$item_active = 1;

if($listing_id > 0){
	$sqlquery = mysql_query(sprintf("SELECT * FROM profiles WHERE id = %d",
				mysql_real_escape_string($listing_id)
				));

	while($row = mysql_fetch_array($sqlquery)){ 
		$item_name = filter_out($row['contact_person']);
		$item_email = filter_out($row['email']);
		$item_company = filter_out($row['company_name']);
		$item_address = filter_out($row['address']);
		$item_tel = filter_out($row['tel']);
		$item_fax = filter_out($row['fax']);
		$item_website = filter_out($row['web']);
		$item_image_file = filter_out($row['img1']);
		$item_active = filter_out($row['status']);
	}
}

?>