<?php

$field_title = '';
$field_gallery = 0;

$sqlquery = mysql_query(sprintf('SELECT services.*, locations.title ltitle FROM services INNER JOIN locations ON services.geo2_id = locations.id WHERE services.id = %d AND services.status = 1',
			mysql_real_escape_string($listing_id)
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$field_title = filer_out_limit($row['title']);
	$field_location = filer_out_limit($row['ltitle']);
	$field_content = filer_out_limit($row['contents']);
	$field_content_intro = filer_out_limit($row['contents_intro']);
	$field_kw = filer_out_limit($row['keywords']);
	$field_date = filer_out_limit($row['date_created']);
	$field_brief = filer_out_limit($row['brief']);
	$field_img = filer_out_limit($row['img1']);
	$field_gps_lat = filer_out_limit($row['gps_lat']);
	$field_gps_lon = filer_out_limit($row['gps_lon']);
	$field_member_id = filer_out_limit($row['member_id']);
	$field_contact_name = filer_out_limit($row['contact_name']);
	$field_contact_number = filer_out_limit($row['contact_number']);
	$field_profile_address_physical = filer_out_limit($row['company_physical']);
	$field_profile_address_postal = filer_out_limit($row['company_postal']);
	$field_profile_tel = filer_out_limit($row['company_tel']);
	$field_profile_fax = filer_out_limit($row['company_fax']);
	$field_profile_web = filer_out_limit($row['company_web']);
	$field_profile_img = filer_out_limit($row['img1']);
	$field_gallery = filer_out_limit($row['gallery_id']);
	
	$url = COMPANY_URL . 'services-details/' . $listing_id . '/' . seo($field_title);
	if(strlen($field_profile_img) == 0){$field_profile_img = 'none.jpg';}
	
	$page_data[3] = $field_brief;
	$page_data[4] = $field_kw;
	
	$og_title = $field_title;
	$og_image = COMPANY_URL . 'files/services/thumb/' . $field_img;
	$og_url = $url;
}
		
if(strlen($field_title) == 0){
	header('Location: ' . COMPANY_URL . 'services');
	exit();
}

// =============================================================================================================================
// Get gallery images for this item if specified
// =============================================================================================================================

$str_carousel_gallery = '';

if($field_gallery > 0){

	$sqlquery = mysql_query(sprintf('SELECT title, img_url FROM gallery WHERE album_id = %d AND status = 1 ORDER BY id DESC',
				mysql_real_escape_string($field_gallery)
				));

	while($row = mysql_fetch_array($sqlquery)){ 
		$field_gallery_title = filer_out_limit($row['title']);
		$field_gallery_image = filer_out_limit($row['img_url']);
			
		$str_carousel_gallery .= '<li><img src="files/gallery/large/' . $field_gallery_image . '" alt="' . safe_alt($field_gallery_title) . '" title="' . safe_alt($field_gallery_title) . '" /><span>' . $field_gallery_title . '</span></li>';
	}
		
}
if(strlen($str_carousel_gallery) > 0){
	$str_carousel_gallery = '<div class="detailsslider"><div class="detailsslide"><ul>' . $str_carousel_gallery . '</ul></div><p class="paging"><a class="sliderback" href="#"><img src="graphics/buttons/detailsslider-previous.png" alt="Previous" title="Previous" height="30" width="25" /></a><a class="slidernext" href="#"><img src="graphics/buttons/detailsslider-next.png" alt="Next" title="Next" height="30" width="25" /></a></p><script type="text/javascript" src="ajax/carousel/detailsslider-settings.js"></script></div>';
}
	
// =============================================================================================================================




?>