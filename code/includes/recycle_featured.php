<?php

$featured_listings = '';
$num_articles = 0;

$sql = "SELECT recycle.id, recycle.title, recycle.img1, recycle.brief, recycle_categories.title ititle, locations.title ltitle FROM recycle INNER JOIN recycle_categories ON recycle.category_id = recycle_categories.id INNER JOIN locations ON recycle.geo2_id = locations.id WHERE recycle.status=1 AND recycle_categories.status=1 AND locations.status=1 AND recycle.is_featured = 1";
if($global_emirate_id > 0){$sql .= ' AND recycle.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY recycle.date_created DESC LIMIT 2';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_articles++;
	$field_t_id = $row['id'];
	$field_t_title = filer_out_limit($row['title']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_category = filer_out_limit($row['ititle']);
	$field_t_location = filer_out_limit($row['ltitle']);
	
	$url = 'recycle-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

	$featured_listings .= '<div class="item-list">
                <div class="col-sm-2 no-padding photobox">
                  <div class="add-image">
                    <a href="' . $url . '"><img src="files/restaurants/thumb/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
                    
                  </div>
                </div>
                <div class="col-sm-7 add-desc-box">
                  <div class="add-details">
                    <h5 class="add-title"><a href="' . $url . '">' . $field_t_title . '</a></h5>
                    <div class="info">
                       <span class="category">' . $field_t_price . '</span><br>   
                      <span class="item-location"><i class="fa fa-map-marker"></i> ' . $field_t_location . '</span>
                    </div>
                    <div class="item_desc">' . substr($field_t_brief,0,255) . '</div>
                  </div>
                </div>
                <!--<div class="col-sm-3 text-right  price-box">
                  <a class="btn btn-danger btn-sm"><i class="fa fa-certificate"></i>
                  <span>Top Ads</span></a> 
                  <a class="btn btn-common btn-sm"> <i class="fa fa-eye"></i> <span>215</span> </a> 
                </div>-->
              </div>';
	
	/*$featured_listings .= '<span class="featuredlisting' . ($num_articles % 2 == 0 ? ' featuredlistingright' : '') . '"><a href="' . $url . '"><img src="files/recycle/featured/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a><span class="featuredtitle">' . $field_t_title . '</span><br /><strong>' . $field_t_category . '</strong><br /><span class="featuredsize">' . $field_t_location . '</span><br />&nbsp;<br /></span>';*/

}

if(strlen($featured_listings) > 0){
	$featured_listings = '<div class="item"><div class="widget-title">
                  <h4>Featured Listings</h4></div><div class="middle">' . $featured_listings . '</div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}

?>