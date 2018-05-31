<?php

$featured_listings = '';
$num_articles = 0;

$sql = "SELECT properties.id, properties.title, properties.img1, properties.bed, properties.price, properties.size_dwelling, properties.rental_time, properties.bed, properties.ref, locations.title ltitle FROM properties INNER JOIN locations ON properties.geo2_id = locations.id WHERE properties.status=1 AND locations.status=1 AND properties.is_featured = 1";
if($global_emirate_id > 0){$sql .= ' AND properties.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY properties.date_created DESC LIMIT 4';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_articles++;
	$field_t_id = $row['id'];
	$field_t_title = filer_out_limit($row['title']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_bed = filer_out_limit($row['bed']);
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_rentaltime = filer_out_limit($row['rental_time']);
	$field_t_price = filer_out_limit($row['price']);
	$field_t_size = filer_out_limit($row['size_dwelling']);
	$field_t_bed = filer_out_limit($row['bed']);
	$field_t_ref = filer_out_limit($row['ref']);
	
	$url = 'property-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

	$featured_listings .= '<div class="item-list">
                <div class="col-sm-2 no-padding photobox">
                  <div class="add-image">
                    <a href="' . $url . '"><img src="files/property/thumb/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
                   
                  </div>
                </div>
                <div class="col-sm-7 add-desc-box">
                  <div class="add-details">
                    <h5 class="add-title"><a href="' . $url . '">' . $field_t_title . '</a></h5>
                    <div class="info">
                      <span class="item-location"><i class="fa fa-map-marker"></i> ' . $field_t_location . '</span>
					  
					  <span class="featuredsize">Size: ' . $field_t_size . ' ' . $global_settings_measurements[2] . '</span><br />&nbsp;<br /><img class="featuredbedrooms" src="graphics/icons/featured-listing-bed.png" alt="Bedrooms" title="Bedrooms" /><strong>' . number_f($field_t_bed) . '</strong>&nbsp;&nbsp;|&nbsp;&nbsp;<strong>Ref. num ' . $field_t_ref . '</strong></span>
					  
					  
                    </div>
                  
                  </div>
                </div>
                <div class="col-sm-3 text-right  price-box">
                  <h2 class="item-price"> ' . $global_settings_measurements[0] . ' ' . number_f($field_t_price) . ' ' . @$field_t_rental_time . ' </h2>
                 <!-- <a class="btn btn-danger btn-sm"><i class="fa fa-certificate"></i>
                  <span>Top Ads</span></a> 
                  <a class="btn btn-common btn-sm"> <i class="fa fa-eye"></i> <span>215</span> </a>--> 
                </div>
              </div>';

	//<span class="featuredlisting' . ($num_articles % 2 == 0 ? ' featuredlistingright' : '') . '"><a href="' . $url . '"><img src="files/property/featured/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a><span class="featuredtitle">' . $field_t_title . '</span><br /><strong> ' . $global_settings_measurements[0] . ' ' . number_f($field_t_price) . ' ' . $field_t_rentaltime . '</strong><br /><span class="featuredsize">Size: ' . $field_t_size . ' ' . $global_settings_measurements[2] . '</span><br />&nbsp;<br /><img class="featuredbedrooms" src="graphics/icons/featured-listing-bed.png" alt="Bedrooms" title="Bedrooms" /><strong>' . number_f($field_t_bed) . '</strong>&nbsp;&nbsp;|&nbsp;&nbsp;<strong>Ref. num ' . $field_t_ref . '</strong></span>
	
	
	
	
	
}

if(strlen($featured_listings) > 0){
	$featured_listings = '<div class="item"><div class="widget-title">
                  <h4>Featured Listings</h4></div><div class="middle">' . $featured_listings . '</div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}

?>