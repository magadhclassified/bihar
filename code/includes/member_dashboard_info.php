<?php

if(!isset($caller)){exit('Direct access not allowed.');}

// -----------------------------------------------------------------------------------------------------------
// PROPERTIES
// -----------------------------------------------------------------------------------------------------------

$dash_properties_list = '';
$dash_properties_rent = 0;
$dash_properties_sale = 0;
$dash_properties_enquiries = 0;
$dash_properties_total = 0;
$dash_properties_pending = 0;
$dash_properties_last_date = '';

$field_dash_item_id = 0;

$sqlquery = mysql_query(sprintf('SELECT properties.id, properties.category_id, properties.date_created pdate, properties.status, properties.title, properties.img1, properties.price, properties.size_dwelling, properties.rental_time, properties.ref, locations.title ltitle, (SELECT COUNT(enquiries.id) FROM enquiries WHERE enquiries.listing_section=\'PROPERTY\' AND enquiries.listing_id=properties.id) num_enq FROM properties INNER JOIN locations ON properties.geo2_id = locations.id WHERE properties.member_id = ' . (int)$_SESSION['Member_ID'] . ' ORDER BY id ASC',
			mysql_real_escape_string($_SESSION['Member_ID'])
			));

while($row = mysql_fetch_assoc($sqlquery)){ 
	$field_dash_item_id = $row['id'];
	$field_dash_item_title = filer_out_limit($row['title']);
	$field_dash_item_img1 = filer_out_limit($row['img1']);
	$field_dash_item_price = filer_out_limit($row['price']);
	$field_dash_item_location = filer_out_limit($row['ltitle']);
	$field_dash_item_rentaltime = filer_out_limit($row['rental_time']);
	$field_dash_item_category = filer_out_limit($row['category_id']);
	$field_dash_item_status = filer_out_limit($row['status']);
	$field_dash_item_created = filer_out_limit($row['pdate']);
	
	if(strlen($field_dash_item_img1) == 0){$field_dash_item_img1 = 'none.jpg';}
	
	$dash_properties_total++;
	if($field_dash_item_category == 1){$dash_properties_sale++;}else if($field_dash_item_category == 2){$dash_properties_rent++;}
	if($field_dash_item_status == 0){$dash_properties_pending++;}
	$dash_properties_last_date = date('d M Y', $field_dash_item_created);
	$dash_properties_enquiries = filer_out_limit($row['num_enq']);

}

if($field_dash_item_id > 0){
	$dash_properties_list = '<div class="item"><p class="header"><strong>My Properties</strong></p><div class="middle"><div class="detailsimagesmember"><img class="latestimg" src="graphics/elements/latest.png" alt="" height="54" width="57" /><img src="files/property/medium/' . $field_dash_item_img1 . '" alt="' . safe_alt($field_dash_item_title) . '" title="' . safe_alt($field_dash_item_title) . '" /><p class="propstats"><span class="stattitle">' . chop_text($field_dash_item_title, 37, ' ', '...') . '</span><span class="statprice">' . $global_settings_measurements[0] . ' ' . number_f($field_dash_item_price) . ' ' . $field_dash_item_rentaltime . '</span><span class="statarea">' . $field_dash_item_location . '</span></p></div><p class="detailsinfo"><span class="detailstitle">My Property Statistics</span><span class="detailscategorymember">Total properties for rent:</span><span class="detailsdetailsmember">' . number_f($dash_properties_rent) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Total properties for sale:</span><span class="detailsdetailsmember">' . number_f($dash_properties_sale) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Total properties listed:</span><span class="detailsdetailsmember">' . number_f($dash_properties_total) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Total enquiries made:</span><span class="detailsdetailsmember">' . number_f($dash_properties_enquiries) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Last time a property was added:</span><span class="detailsdetailsmember">' . $dash_properties_last_date . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Properties pending approval:</span><span class="detailsdetailsmember">' . number_f($dash_properties_pending) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><a class="buttons" href="my-property-manage" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 1000 } )"><span class="leftborder">&nbsp;</span><span class="buttondetail">Add New Property</span><span class="rightborder">&nbsp;</span></a><a class="detailsbuttons" href="my-properties"><span class="leftborder">&nbsp;</span><span class="buttondetail">Manage My Properties</span><span class="rightborder">&nbsp;</span></a></p><p class="clear">&nbsp;</p></div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}else{
	$dash_properties_list = '<div class="item"><p class="header"><strong>My Properties</strong></p><div class="middle"><img class="image_left" src="files/details-images/nothing-listed.jpg" alt="You currently do not have any properties added at the moment" title="You currently do not have any properties added at the moment" height="86" width="125" /><span class="nolisted">You currently do not have any properties added at the moment.</span><br />&nbsp;<br /><a class="detailsbuttons" href="my-property-manage" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 1000 } )" style="float:none;"><span class="leftborder">&nbsp;</span><span class="buttondetail">Upload a Property</span><span class="rightborder">&nbsp;</span></a><p class="clear">&nbsp;</p></div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}

// -----------------------------------------------------------------------------------------------------------
// MOTORS
// -----------------------------------------------------------------------------------------------------------

$dash_motors_list = '';
$dash_motors_rent = 0;
$dash_motors_sale = 0;
$dash_motors_enquiries = 0;
$dash_motors_total = 0;
$dash_motors_pending = 0;
$dash_motors_last_date = '';

$field_dash_item_id = 0;

$sqlquery = mysql_query(sprintf('SELECT motors.id, motors.type_id, motors.date_created pdate, motors.status, motors.title, motors.img1, motors.price, locations.title ltitle, (SELECT COUNT(enquiries.id) FROM enquiries WHERE enquiries.listing_section=\'MOTORS\' AND enquiries.listing_id=motors.id) num_enq FROM motors INNER JOIN locations ON motors.geo2_id = locations.id WHERE motors.member_id = ' . (int)$_SESSION['Member_ID'] . ' ORDER BY id ASC',
			mysql_real_escape_string($_SESSION['Member_ID'])
			));

while($row = mysql_fetch_assoc($sqlquery)){ 
	$field_dash_item_id = $row['id'];
	$field_dash_item_title = filer_out_limit($row['title']);
	$field_dash_item_img1 = filer_out_limit($row['img1']);
	$field_dash_item_price = filer_out_limit($row['price']);
	$field_dash_item_location = filer_out_limit($row['ltitle']);
	$field_dash_item_category = filer_out_limit($row['type_id']);
	$field_dash_item_status = filer_out_limit($row['status']);
	$field_dash_item_created = filer_out_limit($row['pdate']);
	
	if(strlen($field_dash_item_img1) == 0){$field_dash_item_img1 = 'none.jpg';}
	
	$dash_motors_total++;
	if($field_dash_item_category == 1){$dash_motors_sale++;}else if($field_dash_item_category == 2){$dash_motors_rent++;}
	if($field_dash_item_status == 0){$dash_motors_pending++;}
	$dash_motors_last_date = date('d M Y', $field_dash_item_created);
	$dash_motors_enquiries = filer_out_limit($row['num_enq']);

}

if($field_dash_item_id > 0){
	$dash_motors_list = '<div class="item"><p class="header"><strong>My Motors</strong></p><div class="middle"><div class="detailsimagesmember"><img class="latestimg" src="graphics/elements/latest.png" alt="" height="54" width="57" /><img src="files/motors/medium/' . $field_dash_item_img1 . '" alt="' . safe_alt($field_dash_item_title) . '" title="' . safe_alt($field_dash_item_title) . '" /><p class="propstats"><span class="stattitle">' . chop_text($field_dash_item_title, 37, ' ', '...') . '</span><span class="statprice">' . $global_settings_measurements[0] . ' ' . number_f($field_dash_item_price) . '</span><span class="statarea">' . $field_dash_item_location . '</span></p></div><p class="detailsinfo"><span class="detailstitle">My Motor Statistics</span><span class="detailscategorymember">Total motors for rent:</span><span class="detailsdetailsmember">' . number_f($dash_motors_rent) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Total motors for sale:</span><span class="detailsdetailsmember">' . number_f($dash_motors_sale) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Total motors listed:</span><span class="detailsdetailsmember">' . number_f($dash_motors_total) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Total enquiries made:</span><span class="detailsdetailsmember">' . number_f($dash_motors_enquiries) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Last time a motor was added:</span><span class="detailsdetailsmember">' . $dash_motors_last_date . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Motors pending approval:</span><span class="detailsdetailsmember">' . number_f($dash_motors_pending) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><a class="buttons" href="my-motors-manage" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 950 } )"><span class="leftborder">&nbsp;</span><span class="buttondetail">Add New Motor</span><span class="rightborder">&nbsp;</span></a><a class="detailsbuttons" href="my-motors"><span class="leftborder">&nbsp;</span><span class="buttondetail">Manage My Motors</span><span class="rightborder">&nbsp;</span></a></p><p class="clear">&nbsp;</p></div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}else{
	$dash_motors_list = '<div class="item"><p class="header"><strong>My Motors</strong></p><div class="middle"><img class="image_left" src="files/details-images/nothing-listed.jpg" alt="You currently do not have any motors added at the moment" title="You currently do not have any motors added at the moment" height="86" width="125" /><span class="nolisted">You currently do not have any motors added at the moment.</span><br />&nbsp;<br /><a class="detailsbuttons" href="my-motors-manage" style="float:none;" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 950 } )"><span class="leftborder">&nbsp;</span><span class="buttondetail">Upload a Motor</span><span class="rightborder">&nbsp;</span></a><p class="clear">&nbsp;</p></div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}

// -----------------------------------------------------------------------------------------------------------
// JOBS
// -----------------------------------------------------------------------------------------------------------

$dash_jobs_list = '';
$dash_jobs_offered = 0;
$dash_jobs_wanted = 0;
$dash_jobs_enquiries = 0;
$dash_jobs_total = 0;
$dash_jobs_pending = 0;
$dash_jobs_last_date = '';

$field_dash_item_id = 0;

$sqlquery = mysql_query(sprintf('SELECT jobs.id, jobs.type_id, jobs.date_created pdate, jobs.status, jobs.title, jobs.img1, jobs.salary, locations.title ltitle, (SELECT COUNT(enquiries.id) FROM enquiries WHERE enquiries.listing_section=\'JOBS\' AND enquiries.listing_id=jobs.id) num_enq FROM jobs INNER JOIN locations ON jobs.geo2_id = locations.id WHERE jobs.member_id = ' . (int)$_SESSION['Member_ID'] . ' ORDER BY id ASC',
			mysql_real_escape_string($_SESSION['Member_ID'])
			));

while($row = mysql_fetch_assoc($sqlquery)){ 
	$field_dash_item_id = $row['id'];
	$field_dash_item_title = filer_out_limit($row['title']);
	$field_dash_item_img1 = filer_out_limit($row['img1']);
	$field_dash_item_salary = filer_out_limit($row['salary']);
	$field_dash_item_location = filer_out_limit($row['ltitle']);
	$field_dash_item_category = filer_out_limit($row['type_id']);
	$field_dash_item_status = filer_out_limit($row['status']);
	$field_dash_item_created = filer_out_limit($row['pdate']);
	
	if(strlen($field_dash_item_img1) == 0){$field_dash_item_img1 = 'none.jpg';}
	
	$dash_jobs_total++;
	if($field_dash_item_category == 1){$dash_jobs_offered++;}else if($field_dash_item_category == 2){$dash_jobs_wanted++;}
	if($field_dash_item_status == 0){$dash_jobs_pending++;}
	$dash_jobs_last_date = date('d M Y', $field_dash_item_created);
	$dash_jobs_enquiries = filer_out_limit($row['num_enq']);

}

if($field_dash_item_id > 0){
	$dash_jobs_list = '<div class="item"><p class="header"><strong>My Jobs</strong></p><div class="middle"><div class="detailsimagesmember"><img class="latestimg" src="graphics/elements/latest.png" alt="" height="54" width="57" /><img src="files/jobs/medium/' . $field_dash_item_img1 . '" alt="' . safe_alt($field_dash_item_title) . '" title="' . safe_alt($field_dash_item_title) . '" /><p class="propstats"><span class="stattitle">' . chop_text($field_dash_item_title, 37, ' ', '...') . '</span><span class="statprice">' . $field_dash_item_salary . '</span><span class="statarea">' . $field_dash_item_location . '</span></p></div><p class="detailsinfo"><span class="detailstitle">My Job Statistics</span><span class="detailscategorymember">Total jobs offered:</span><span class="detailsdetailsmember">' . number_f($dash_jobs_offered) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Total jobs wanted:</span><span class="detailsdetailsmember">' . number_f($dash_jobs_wanted) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Total jobs listed:</span><span class="detailsdetailsmember">' . number_f($dash_jobs_total) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Total enquiries made:</span><span class="detailsdetailsmember">' . number_f($dash_jobs_enquiries) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Last time a job was added:</span><span class="detailsdetailsmember">' . $dash_jobs_last_date . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Jobs pending approval:</span><span class="detailsdetailsmember">' . number_f($dash_jobs_pending) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><a class="buttons" href="my-jobs-manage"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 950 } )"><span class="leftborder">&nbsp;</span><span class="buttondetail">Add New Job</span><span class="rightborder">&nbsp;</span></a><a class="detailsbuttons" href="my-jobs"><span class="leftborder">&nbsp;</span><span class="buttondetail">Manage My Jobs</span><span class="rightborder">&nbsp;</span></a></p><p class="clear">&nbsp;</p></div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}else{
	$dash_jobs_list = '<div class="item"><p class="header"><strong>My Jobs</strong></p><div class="middle"><img class="image_left" src="files/details-images/nothing-listed.jpg" alt="You currently do not have any jobs added at the moment" title="You currently do not have any jobs added at the moment" height="86" width="125" /><span class="nolisted">You currently do not have any jobs added at the moment.</span><br />&nbsp;<br /><a class="detailsbuttons" href="my-jobs-manage" style="float:none;" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 950 } )"><span class="leftborder">&nbsp;</span><span class="buttondetail">Upload a Job</span><span class="rightborder">&nbsp;</span></a><p class="clear">&nbsp;</p></div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}

// -----------------------------------------------------------------------------------------------------------
// RECYCLE
// -----------------------------------------------------------------------------------------------------------

$dash_recycle_list = '';
$dash_recycle_offered = 0;
$dash_recycle_wanted = 0;
$dash_recycle_enquiries = 0;
$dash_recycle_total = 0;
$dash_recycle_pending = 0;
$dash_recycle_last_date = '';

$field_dash_item_id = 0;

$sqlquery = mysql_query(sprintf('SELECT recycle.id, recycle.type_id, recycle.date_created pdate, recycle.status, recycle.title, recycle.img1, recycle.price, locations.title ltitle, (SELECT COUNT(enquiries.id) FROM enquiries WHERE enquiries.listing_section=\'RECYCLE\' AND enquiries.listing_id=recycle.id) num_enq FROM recycle INNER JOIN locations ON recycle.geo2_id = locations.id WHERE recycle.member_id = ' . (int)$_SESSION['Member_ID'] . ' ORDER BY id ASC',
			mysql_real_escape_string($_SESSION['Member_ID'])
			));

while($row = mysql_fetch_assoc($sqlquery)){ 
	$field_dash_item_id = $row['id'];
	$field_dash_item_title = filer_out_limit($row['title']);
	$field_dash_item_img1 = filer_out_limit($row['img1']);
	$field_dash_item_price = filer_out_limit($row['price']);
	$field_dash_item_location = filer_out_limit($row['ltitle']);
	$field_dash_item_category = filer_out_limit($row['type_id']);
	$field_dash_item_status = filer_out_limit($row['status']);
	$field_dash_item_created = filer_out_limit($row['pdate']);
	
	if(strlen($field_dash_item_img1) == 0){$field_dash_item_img1 = 'none.jpg';}
	
	$dash_recycle_total++;
	if($field_dash_item_category == 1){$dash_recycle_offered++;}else if($field_dash_item_category == 2){$dash_recycle_wanted++;}
	if($field_dash_item_status == 0){$dash_recycle_pending++;}
	$dash_recycle_last_date = date('d M Y', $field_dash_item_created);
	$dash_recycle_enquiries = filer_out_limit($row['num_enq']);

}

if($field_dash_item_id > 0){
	$dash_recycle_list = '<div class="item"><p class="header"><strong>My Recycle Ads</strong></p><div class="middle"><div class="detailsimagesmember"><img class="latestimg" src="graphics/elements/latest.png" alt="" height="54" width="57" /><img src="files/recycle/medium/' . $field_dash_item_img1 . '" alt="' . safe_alt($field_dash_item_title) . '" title="' . safe_alt($field_dash_item_title) . '" /><p class="propstats"><span class="stattitle">' . chop_text($field_dash_item_title, 37, ' ', '...') . '</span><span class="statprice">' . $global_settings_measurements[0] . ' ' . number_f2($field_dash_item_price) . '</span><span class="statarea">' . $field_dash_item_location . '</span></p></div><p class="detailsinfo"><span class="detailstitle">My Notice Board Ads Statistics</span><span class="detailscategorymember">Total ads offered:</span><span class="detailsdetailsmember">' . number_f($dash_recycle_offered) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Total ads wanted:</span><span class="detailsdetailsmember">' . number_f($dash_recycle_wanted) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Total ads listed:</span><span class="detailsdetailsmember">' . number_f($dash_recycle_total) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Total enquiries made:</span><span class="detailsdetailsmember">' . number_f($dash_recycle_enquiries) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Last time an item was added:</span><span class="detailsdetailsmember">' . $dash_recycle_last_date . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Ads pending approval:</span><span class="detailsdetailsmember">' . number_f($dash_recycle_pending) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><a class="buttons" href="my-recycle-manage" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 950 } )"><span class="leftborder">&nbsp;</span><span class="buttondetail">Add New Ad</span><span class="rightborder">&nbsp;</span></a><a class="detailsbuttons" href="my-recycle"><span class="leftborder">&nbsp;</span><span class="buttondetail">Manage My Notice Board Ads</span><span class="rightborder">&nbsp;</span></a></p><p class="clear">&nbsp;</p></div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}else{
	$dash_recycle_list = '<div class="item"><p class="header"><strong>My Recycle Ads</strong></p><div class="middle"><img class="image_left" src="files/details-images/nothing-listed.jpg" alt="You currently do not have any notice board ads added at the moment" title="You currently do not have any Notice Board ads added at the moment" height="86" width="125" /><span class="nolisted">You currently do not have any notice board ads added at the moment.</span><br />&nbsp;<br /><a class="detailsbuttons" href="my-recycle-manage" style="float:none;" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 950 } )"><span class="leftborder">&nbsp;</span><span class="buttondetail">Upload an Ad</span><span class="rightborder">&nbsp;</span></a><p class="clear">&nbsp;</p></div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}

// -----------------------------------------------------------------------------------------------------------
// DIRECTORY
// -----------------------------------------------------------------------------------------------------------

$landing_dir_cat_list = '';
$landing_dir_cat_cnt = 0;
$landing_dir_cat_total = 0;

$sqlquery = mysql_query('SELECT id, title FROM directory_categories WHERE status = 1 AND parent_id = 0 ORDER BY ordering ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$landing_dir_cat_cnt++;
	$landing_dir_cat_id = filer_out_limit($row['id']);
	$landing_dir_cat_title = filer_out_limit($row['title']);
	
	$landing_dir_cat_list .= '<div class="directorylisting' . ($landing_dir_cat_cnt % 3 == 0 ? ' directorylistingright' : '') . '"><p class="directorylistingtitle">' . $landing_dir_cat_title . '</p><ul>';
	
	// ----------------------------------------------------------------------------------------------------------------------------------
	
	$sqlquery2 = mysql_query('SELECT id, title, (SELECT COUNT(id) FROM directory WHERE category_id = directory_categories.id AND directory.member_id=' . (int)$_SESSION['Member_ID'] . ') num FROM directory_categories WHERE status = 1 AND parent_id = ' . (int)$landing_dir_cat_id . ' ORDER BY ordering ASC');
	while($row2 = mysql_fetch_assoc($sqlquery2)){ 
		$landingx_dir_cat_id = filer_out_limit($row2['id']);
		$landingx_dir_cat_title = filer_out_limit($row2['title']);
		$landingx_dir_cat_num = filer_out_limit($row2['num']);
		$landing_dir_cat_total += $landingx_dir_cat_num;
		
		$landing_dir_cat_list .= '<li><span class="dlisting"' . ($landingx_dir_cat_num > 0 ? ' style="font-weight:bold;"' : '') . '>' . $landingx_dir_cat_title . ' (' . $landingx_dir_cat_num . ')</span></li>';
	}
	
	// ----------------------------------------------------------------------------------------------------------------------------------
	
	$landing_dir_cat_list .= '</ul></div>';
	
	if($landing_dir_cat_cnt % 3 == 0){$landing_dir_cat_list .= '<div class="clear">&nbsp;</div>';}
	
}

// -----------------------------------------------------------------------------------------------------------
// RESTAURANTS
// -----------------------------------------------------------------------------------------------------------

$dash_restaurants_list = '';
$dash_restaurants_enquiries = 0;
$dash_restaurants_total = 0;
$dash_restaurants_pending = 0;
$dash_restaurants_last_date = '';

$field_dash_item_id = 0;

$sqlquery = mysql_query(sprintf('SELECT restaurants.id, restaurants.date_created pdate, restaurants.status, restaurants.title, restaurants.img1, restaurants.price, locations.title ltitle, (SELECT COUNT(enquiries.id) FROM enquiries WHERE enquiries.listing_section=\'RESTAURANTS\' AND enquiries.listing_id=restaurants.id) num_enq FROM restaurants INNER JOIN locations ON restaurants.geo2_id = locations.id WHERE restaurants.member_id = ' . (int)$_SESSION['Member_ID'] . ' ORDER BY id ASC',
			mysql_real_escape_string($_SESSION['Member_ID'])
			));

while($row = mysql_fetch_assoc($sqlquery)){ 
	$field_dash_item_id = $row['id'];
	$field_dash_item_title = filer_out_limit($row['title']);
	$field_dash_item_img1 = filer_out_limit($row['img1']);
	$field_dash_item_price = filer_out_limit($row['price']);
	$field_dash_item_location = filer_out_limit($row['ltitle']);
	$field_dash_item_status = filer_out_limit($row['status']);
	$field_dash_item_created = filer_out_limit($row['pdate']);
	
	if(strlen($field_dash_item_img1) == 0){$field_dash_item_img1 = 'none.jpg';}
	
	$dash_restaurants_total++;
	if($field_dash_item_status == 0){$dash_restaurants_pending++;}
	$dash_restaurants_last_date = date('d M Y', $field_dash_item_created);
	$dash_restaurants_enquiries = filer_out_limit($row['num_enq']);

}

if($field_dash_item_id > 0){
	$dash_restaurants_list = '<div class="item"><p class="header"><strong>My Restaurants</strong></p><div class="middle"><div class="detailsimagesmember"><img class="latestimg" src="graphics/elements/latest.png" alt="" height="54" width="57" /><img src="files/restaurants/medium/' . $field_dash_item_img1 . '" alt="' . safe_alt($field_dash_item_title) . '" title="' . safe_alt($field_dash_item_title) . '" /><p class="propstats"><span class="stattitle">' . chop_text($field_dash_item_title, 37, ' ', '...') . '</span><span class="statprice">' . $field_dash_item_price . '</span><span class="statarea">' . $field_dash_item_location . '</span></p></div><p class="detailsinfo"><span class="detailstitle">My Restaurant Ads Statistics</span><span class="detailscategorymember">Total restaurants listed:</span><span class="detailsdetailsmember">' . number_f($dash_restaurants_total) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Total enquiries made:</span><span class="detailsdetailsmember">' . number_f($dash_restaurants_enquiries) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Last time a restaurant was added:</span><span class="detailsdetailsmember">' . $dash_restaurants_last_date . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Restaurants pending approval:</span><span class="detailsdetailsmember">' . number_f($dash_restaurants_pending) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><a class="buttons" href="my-restaurants-manage" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 950 } )"><span class="leftborder">&nbsp;</span><span class="buttondetail">Add New Listing</span><span class="rightborder">&nbsp;</span></a><a class="detailsbuttons" href="my-restaurants"><span class="leftborder">&nbsp;</span><span class="buttondetail">Manage My Restaurants</span><span class="rightborder">&nbsp;</span></a></p><p class="clear">&nbsp;</p></div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}else{
	$dash_restaurants_list = '<div class="item"><p class="header"><strong>My Restaurants</strong></p><div class="middle"><img class="image_left" src="files/details-images/nothing-listed.jpg" alt="You currently do not have any restaurants added at the moment" title="You currently do not have any restaurants added at the moment" height="86" width="125" /><span class="nolisted">You currently do not have any restaurants added at the moment.</span><br />&nbsp;<br /><a class="detailsbuttons" href="my-restaurants-manage" style="float:none;" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 950 } )"><span class="leftborder">&nbsp;</span><span class="buttondetail">Upload a Restaurant</span><span class="rightborder">&nbsp;</span></a><p class="clear">&nbsp;</p></div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}

// -----------------------------------------------------------------------------------------------------------
// ACCOMMODATION
// -----------------------------------------------------------------------------------------------------------

$dash_accommodation_list = '';
$dash_accommodation_enquiries = 0;
$dash_accommodation_total = 0;
$dash_accommodation_pending = 0;
$dash_accommodation_last_date = '';

$field_dash_item_id = 0;

$sqlquery = mysql_query(sprintf('SELECT accommodation.id, accommodation.date_created pdate, accommodation.status, accommodation.title, accommodation.img1, accommodation.price, locations.title ltitle, (SELECT COUNT(enquiries.id) FROM enquiries WHERE enquiries.listing_section=\'ACCOMMODATION\' AND enquiries.listing_id=accommodation.id) num_enq FROM accommodation INNER JOIN locations ON accommodation.geo2_id = locations.id WHERE accommodation.member_id = ' . (int)$_SESSION['Member_ID'] . ' ORDER BY id ASC',
			mysql_real_escape_string($_SESSION['Member_ID'])
			));

while($row = mysql_fetch_assoc($sqlquery)){ 
	$field_dash_item_id = $row['id'];
	$field_dash_item_title = filer_out_limit($row['title']);
	$field_dash_item_img1 = filer_out_limit($row['img1']);
	$field_dash_item_price = filer_out_limit($row['price']);
	$field_dash_item_location = filer_out_limit($row['ltitle']);
	$field_dash_item_status = filer_out_limit($row['status']);
	$field_dash_item_created = filer_out_limit($row['pdate']);
	
	if(strlen($field_dash_item_img1) == 0){$field_dash_item_img1 = 'none.jpg';}
	
	$dash_accommodation_total++;
	if($field_dash_item_status == 0){$dash_accommodation_pending++;}
	$dash_accommodation_last_date = date('d M Y', $field_dash_item_created);
	$dash_accommodation_enquiries = filer_out_limit($row['num_enq']);

}

if($field_dash_item_id > 0){
	$dash_accommodation_list = '<div class="item"><p class="header"><strong>My Hotels</strong></p><div class="middle"><div class="detailsimagesmember"><img class="latestimg" src="graphics/elements/latest.png" alt="" height="54" width="57" /><img src="files/accommodation/medium/' . $field_dash_item_img1 . '" alt="' . safe_alt($field_dash_item_title) . '" title="' . safe_alt($field_dash_item_title) . '" /><p class="propstats"><span class="stattitle">' . chop_text($field_dash_item_title, 37, ' ', '...') . '</span><span class="statprice">' . $field_dash_item_price . '</span><span class="statarea">' . $field_dash_item_location . '</span></p></div><p class="detailsinfo"><span class="detailstitle">My Hotel Ads Statistics</span><span class="detailscategorymember">Total hotels listed:</span><span class="detailsdetailsmember">' . number_f($dash_accommodation_total) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Total enquiries made:</span><span class="detailsdetailsmember">' . number_f($dash_accommodation_enquiries) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Last time a listing was added:</span><span class="detailsdetailsmember">' . $dash_accommodation_last_date . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Listings pending approval:</span><span class="detailsdetailsmember">' . number_f($dash_accommodation_pending) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><a class="buttons" href="my-accommodation-manage" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 950 } )"><span class="leftborder">&nbsp;</span><span class="buttondetail">Add New Listing</span><span class="rightborder">&nbsp;</span></a><a class="detailsbuttons" href="my-accommodation"><span class="leftborder">&nbsp;</span><span class="buttondetail">Manage My Listings</span><span class="rightborder">&nbsp;</span></a></p><p class="clear">&nbsp;</p></div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}else{
	$dash_accommodation_list = '<div class="item"><p class="header"><strong>My Hotels</strong></p><div class="middle"><img class="image_left" src="files/details-images/nothing-listed.jpg" alt="You currently do not have any hotels added at the moment" title="You currently do not have any hotels added at the moment" height="86" width="125" /><span class="nolisted">You currently do not have any hotels added at the moment.</span><br />&nbsp;<br /><a class="detailsbuttons" href="my-accommodation-manage" style="float:none;" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 950 } )"><span class="leftborder">&nbsp;</span><span class="buttondetail">Upload a Hotel Listing</span><span class="rightborder">&nbsp;</span></a><p class="clear">&nbsp;</p></div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}

// -----------------------------------------------------------------------------------------------------------
// EVENTS
// -----------------------------------------------------------------------------------------------------------

$dash_events_list = '';
$dash_events_enquiries = 0;
$dash_events_total = 0;
$dash_events_pending = 0;
$dash_events_last_date = '';

$field_dash_item_id = 0;

$sqlquery = mysql_query(sprintf('SELECT events.id, events.date_created pdate, events.status, events.title, events.img1, events.price, locations.title ltitle, (SELECT COUNT(enquiries.id) FROM enquiries WHERE enquiries.listing_section=\'EVENTS\' AND enquiries.listing_id=events.id) num_enq FROM events INNER JOIN locations ON events.geo2_id = locations.id WHERE events.member_id = ' . (int)$_SESSION['Member_ID'] . ' ORDER BY id ASC',
			mysql_real_escape_string($_SESSION['Member_ID'])
			));

while($row = mysql_fetch_assoc($sqlquery)){ 
	$field_dash_item_id = $row['id'];
	$field_dash_item_title = filer_out_limit($row['title']);
	$field_dash_item_img1 = filer_out_limit($row['img1']);
	$field_dash_item_price = filer_out_limit($row['price']);
	$field_dash_item_location = filer_out_limit($row['ltitle']);
	$field_dash_item_status = filer_out_limit($row['status']);
	$field_dash_item_created = filer_out_limit($row['pdate']);
	
	if(strlen($field_dash_item_img1) == 0){$field_dash_item_img1 = 'none.jpg';}
	
	$dash_events_total++;
	if($field_dash_item_status == 0){$dash_events_pending++;}
	$dash_events_last_date = date('d M Y', $field_dash_item_created);
	$dash_events_enquiries = filer_out_limit($row['num_enq']);

}

if($field_dash_item_id > 0){
	$dash_events_list = '<div class="item"><p class="header"><strong>My Events</strong></p><div class="middle"><div class="detailsimagesmember"><img class="latestimg" src="graphics/elements/latest.png" alt="" height="54" width="57" /><img src="files/events/medium/' . $field_dash_item_img1 . '" alt="' . safe_alt($field_dash_item_title) . '" title="' . safe_alt($field_dash_item_title) . '" /><p class="propstats"><span class="stattitle">' . chop_text($field_dash_item_title, 37, ' ', '...') . '</span><span class="statprice">' . $field_dash_item_price . '</span><span class="statarea">' . $field_dash_item_location . '</span></p></div><p class="detailsinfo"><span class="detailstitle">My Event Ads Statistics</span><span class="detailscategorymember">Total events listed:</span><span class="detailsdetailsmember">' . number_f($dash_events_total) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Total enquiries made:</span><span class="detailsdetailsmember">' . number_f($dash_events_enquiries) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Last time an event was added:</span><span class="detailsdetailsmember">' . $dash_events_last_date . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><span class="detailscategorymember">Events pending approval:</span><span class="detailsdetailsmember">' . number_f($dash_events_pending) . '</span><img class="detailsdivider" src="graphics/fillers/details-divider.png" alt="" /><a class="buttons" href="my-events-manage" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 950 } )"><span class="leftborder">&nbsp;</span><span class="buttondetail">Add New Event</span><span class="rightborder">&nbsp;</span></a><a class="detailsbuttons" href="my-events"><span class="leftborder">&nbsp;</span><span class="buttondetail">Manage My Events</span><span class="rightborder">&nbsp;</span></a></p><p class="clear">&nbsp;</p></div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}else{
	$dash_events_list = '<div class="item"><p class="header"><strong>My Events</strong></p><div class="middle"><img class="image_left" src="files/details-images/nothing-listed.jpg" alt="You currently do not have any events added at the moment" title="You currently do not have any events added at the moment" height="86" width="125" /><span class="nolisted">You currently do not have any events added at the moment.</span><br />&nbsp;<br /><a class="detailsbuttons" href="my-events-manage" style="float:none;" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 950 } )"><span class="leftborder">&nbsp;</span><span class="buttondetail">Upload an Event</span><span class="rightborder">&nbsp;</span></a><p class="clear">&nbsp;</p></div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}

?>