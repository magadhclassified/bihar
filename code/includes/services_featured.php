<?php
/*================================FEATURED MEDICALS services IN MAGADH================================*/
$featured_medical_listings = '';
$num_articles = 0;
$sql = "SELECT services.id, services.title, services.img1, services.brief, services.company_physical, directory_categories.title ititle, 
locations.title ltitle FROM services INNER JOIN directory_categories ON services.category_id = directory_categories.id INNER JOIN locations ON 
services.geo2_id = locations.id WHERE services.status=1 AND services.is_featured=1 AND directory_categories.status=1 AND locations.status=1 AND 
(directory_categories.id = 53 OR directory_categories.id = 54 OR directory_categories.id = 55 OR directory_categories.id = 56)";
if($global_emirate_id > 0){$sql .= ' AND services.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY services.date_created DESC LIMIT 4';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_articles++;
	$field_t_id = $row['id'];
	$field_t_title = filer_out_limit($row['title']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_industry = filer_out_limit($row['ititle']);
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_company_physical = filer_out_limit($row['company_physical']);
	
	$url = 'services-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

	$featured_medical_listings .= '<span class="featuredlisting' . ($num_articles % 2 == 0 ? ' featuredlistingright' : '') . '">
	<a href="' . $url . '"><img src="files/directory/featured/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
	<span class="featuredtitle">' . $field_t_title . '</span><br /><strong>' . $field_t_industry . '</strong><br />
	<span class="featuredsize">' . $field_t_company_physical . ' ' . $field_t_location . '</span><br />&nbsp;<br /></span>';

}

if(strlen($featured_medical_listings) > 0){
	$featured_medical_listings = '<div class="item"><p class="header"><strong>Featured Medical Services in Magadh</strong></p><div class="middle">' . $featured_medical_listings . '</div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}





/*================================FEATURED ESTATE AGENTS IN MAGADH================================*/
$featured_estateagent_listings = '';
$num_articles = 0;

$sql = "SELECT services.id, services.title, services.img1, services.brief, services.company_physical, directory_categories.title ititle, 
locations.title ltitle FROM services INNER JOIN directory_categories ON services.category_id = directory_categories.id INNER JOIN locations ON 
services.geo2_id = locations.id WHERE services.status=1 AND services.is_featured=1 AND directory_categories.status=1 AND locations.status=1 AND 
directory_categories.id = 40";
if($global_emirate_id > 0){$sql .= ' AND services.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY services.date_created DESC LIMIT 4';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_articles++;
	$field_t_id = $row['id'];
	$field_t_title = filer_out_limit($row['title']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_industry = filer_out_limit($row['ititle']);
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_company_physical = filer_out_limit($row['company_physical']);
	
	$url = 'services-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

	$featured_estateagent_listings .= '<span class="featuredlisting' . ($num_articles % 2 == 0 ? ' featuredlistingright' : '') . '">
	<a href="' . $url . '"><img src="files/directory/featured/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
	<span class="featuredtitle">' . $field_t_title . '</span><br /><strong>' . $field_t_industry . '</strong><br />
	<span class="featuredsize">' . $field_t_company_physical . ' ' . $field_t_location . '</span><br />&nbsp;<br /></span>';

}

if(strlen($featured_estateagent_listings) > 0){
	$featured_estateagent_listings = '<div class="item"><p class="header"><strong>Featured Estates Agents in Magadh</strong></p><div class="middle">' . $featured_estateagent_listings . '</div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}




/*================================FEATURED BUILDERS & CONSTRUCTION IN MAGADH================================*/
$featured_builders_listings = '';
$num_articles = 0;

$sql = "SELECT services.id, services.title, services.img1, services.brief, services.company_physical, directory_categories.title ititle, 
locations.title ltitle FROM services INNER JOIN directory_categories ON services.category_id = directory_categories.id INNER JOIN locations ON 
services.geo2_id = locations.id WHERE services.status=1 AND services.is_featured=1 AND directory_categories.status=1 AND locations.status=1 AND 
directory_categories.id = 12";
if($global_emirate_id > 0){$sql .= ' AND services.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY services.date_created DESC LIMIT 4';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_articles++;
	$field_t_id = $row['id'];
	$field_t_title = filer_out_limit($row['title']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_industry = filer_out_limit($row['ititle']);
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_company_physical = filer_out_limit($row['company_physical']);
	
	$url = 'services-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

	$featured_builders_listings .= '<span class="featuredlisting' . ($num_articles % 2 == 0 ? ' featuredlistingright' : '') . '">
	<a href="' . $url . '"><img src="files/directory/featured/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
	<span class="featuredtitle">' . $field_t_title . '</span><br /><strong>' . $field_t_industry . '</strong><br />
	<span class="featuredsize">' . $field_t_company_physical . ' ' . $field_t_location . '</span><br />&nbsp;<br /></span>';

}

if(strlen($featured_builders_listings) > 0){
	$featured_builders_listings = '<div class="item"><p class="header"><strong>Featured Builders & Contruction in Magadh</strong></p><div class="middle">' . $featured_builders_listings . '</div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}




/*================================FEATURED MOTORING IN MAGADH================================*/
$featured_motoring_listings = '';
$num_articles = 0;

$sql = "SELECT services.id, services.title, services.img1, services.brief, services.company_physical, directory_categories.title ititle, 
locations.title ltitle FROM services INNER JOIN directory_categories ON services.category_id = directory_categories.id INNER JOIN locations ON 
services.geo2_id = locations.id WHERE services.status=1 AND services.is_featured=1 AND directory_categories.status=1 AND locations.status=1 AND 
(directory_categories.id = 58 OR directory_categories.id = 59)";
if($global_emirate_id > 0){$sql .= ' AND services.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY services.date_created DESC LIMIT 4';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_articles++;
	$field_t_id = $row['id'];
	$field_t_title = filer_out_limit($row['title']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_industry = filer_out_limit($row['ititle']);
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_company_physical = filer_out_limit($row['company_physical']);
	
	$url = 'services-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

	$featured_motoring_listings .= '<span class="featuredlisting' . ($num_articles % 2 == 0 ? ' featuredlistingright' : '') . '">
	<a href="' . $url . '"><img src="files/directory/featured/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
	<span class="featuredtitle">' . $field_t_title . '</span><br /><strong>' . $field_t_industry . '</strong><br />
	<span class="featuredsize">' . $field_t_company_physical . ' ' . $field_t_location . '</span><br />&nbsp;<br /></span>';

}

if(strlen($featured_motoring_listings) > 0){
	$featured_motoring_listings = '<div class="item"><p class="header"><strong>Featured Motoring in Magadh</strong></p><div class="middle">' . $featured_motoring_listings . '</div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}



/*================================FEATURED EDUCATION SERVICES IN MAGADH================================*/
$featured_education_listings = '';
$num_articles = 0;

$sql = "SELECT services.id, services.title, services.img1, services.brief, services.company_physical, directory_categories.title ititle, 
locations.title ltitle FROM services INNER JOIN directory_categories ON services.category_id = directory_categories.id INNER JOIN locations ON 
services.geo2_id = locations.id WHERE services.status=1 AND services.is_featured=1 AND directory_categories.status=1 AND locations.status=1 AND 
(directory_categories.id = 35 OR directory_categories.id = 36 OR directory_categories.id = 37 OR directory_categories.id = 38)";
if($global_emirate_id > 0){$sql .= ' AND services.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY services.date_created DESC LIMIT 4';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_articles++;
	$field_t_id = $row['id'];
	$field_t_title = filer_out_limit($row['title']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_industry = filer_out_limit($row['ititle']);
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_company_physical = filer_out_limit($row['company_physical']);
	
	$url = 'services-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

	$featured_education_listings .= '<span class="featuredlisting' . ($num_articles % 2 == 0 ? ' featuredlistingright' : '') . '">
	<a href="' . $url . '"><img src="files/directory/featured/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
	<span class="featuredtitle">' . $field_t_title . '</span><br /><strong>' . $field_t_industry . '</strong><br />
	<span class="featuredsize">' . $field_t_company_physical . ' ' . $field_t_location . '</span><br />&nbsp;<br /></span>';

}

if(strlen($featured_education_listings) > 0){
	$featured_education_listings = '<div class="item"><p class="header"><strong>Featured Education in Magadh</strong></p><div class="middle">' . $featured_education_listings . '</div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}




/*================================FEATURED EVENTS SERVICES IN MAGADH================================*/
$featured_event_listings = '';
$num_articles = 0;

$sql = "SELECT services.id, services.title, services.img1, services.brief, services.company_physical, directory_categories.title ititle, 
locations.title ltitle FROM services INNER JOIN directory_categories ON services.category_id = directory_categories.id INNER JOIN locations ON 
services.geo2_id = locations.id WHERE services.status=1 AND services.is_featured=1 AND directory_categories.status=1 AND locations.status=1 AND 
(directory_categories.id = 42 OR directory_categories.id = 43 OR directory_categories.id = 44)";
if($global_emirate_id > 0){$sql .= ' AND services.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY services.date_created DESC LIMIT 4';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_articles++;
	$field_t_id = $row['id'];
	$field_t_title = filer_out_limit($row['title']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_industry = filer_out_limit($row['ititle']);
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_company_physical = filer_out_limit($row['company_physical']);
	
	$url = 'services-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

	$featured_event_listings .= '<span class="featuredlisting' . ($num_articles % 2 == 0 ? ' featuredlistingright' : '') . '">
	<a href="' . $url . '"><img src="files/directory/featured/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
	<span class="featuredtitle">' . $field_t_title . '</span><br /><strong>' . $field_t_industry . '</strong><br />
	<span class="featuredsize">' . $field_t_company_physical . ' ' . $field_t_location . '</span><br />&nbsp;<br /></span>';

}

if(strlen($featured_event_listings) > 0){
	$featured_event_listings = '<div class="item"><p class="header"><strong>Featured Events Services in Magadh</strong></p><div class="middle">' . $featured_event_listings . '</div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}






?>

