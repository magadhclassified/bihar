<?php

$featured_fp_restaurants = '';
$featured_fp_restaurants_extras = '';
$num_items_recycle = 0;

// ------------------------------------------------------------------------------------------------------------------------------

$sqlquery = mysql_query('SELECT id, title FROM restaurants_cuisines ORDER BY RAND() LIMIT 3');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$field_t_id = filer_out_limit($row['id']);
	$field_t_title = filer_out_limit($row['title']);
	
	$featured_fp_restaurants_extras .= '<a href="restaurants-by-cuisine/' . $field_t_id . '/' . seo($field_t_title) . '">' . $field_t_title . '</a>, ';
}

if(strlen($featured_fp_restaurants_extras) > 0){$featured_fp_restaurants_extras = substr($featured_fp_restaurants_extras, 0, strlen($featured_fp_restaurants_extras)-2);}

// ------------------------------------------------------------------------------------------------------------------------------

$sql = "SELECT restaurants.id, restaurants.member_id, restaurants.title, restaurants.price, restaurants.img1, restaurants.brief, restaurants.contact_number, locations.title ltitle, restaurants_menus.title menu_tit, profiles.company_name FROM restaurants INNER JOIN locations ON restaurants.geo2_id = locations.id INNER JOIN profiles ON restaurants.member_id = profiles.id INNER JOIN restaurants_menus ON restaurants.menu_id = restaurants_menus.id WHERE restaurants.status=1 AND locations.status=1 AND restaurants.is_fp = 1";
if($global_emirate_id > 0){$sql .= ' AND restaurants.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY restaurants.date_created DESC LIMIT 10';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_items_recycle++;
	$field_t_id = filer_out_limit($row['id']);
	$field_t_member_id = filer_out_limit($row['member_id']);
	$field_t_member_company = filer_out_limit($row['company_name']);
	$field_t_title = filer_out_limit($row['title']);
	$field_t_price = filer_out_limit($row['price']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_contact = filer_out_limit($row['contact_number']);
	$field_t_menu = filer_out_limit($row['menu_tit']);
	
	$url = 'restaurant-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

	
	     $featured_fp_restaurants .= '<div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <a href="' . $url . '"><img src="files/restaurants/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
                      <div class="overlay">
                        <a href="' . $url . '"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>    
                    <a href="' . $url . '">' . $field_t_title . ',' .$field_t_location.'</a><br>
                    <i class="fa fa-phone-square"></i> '.$field_t_contact.'  
                  </div>
                </div>';
	
	
	/*$featured_fp_restaurants .= '<p><span class="frame"><a href="' . $url . '"><img src="files/restaurants/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a></span><span class="text"><span class="title"><a href="' . $url . '">' . $field_t_title . '</a></span><span class="category">Menu:</span> <strong class="category">' . $field_t_menu . '</strong><span class="category">Contact:</span> <strong class="category">' . $field_t_contact . '</strong><br /><span class="category">Location:</span> <strong class="category">' . $field_t_location . '</strong><br />&nbsp;<br />' . substr($field_t_brief,0,355) . '...<br /><a class="buttons viewdetails" href="' . $url . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Details</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="restaurants"><span class="leftborder">&nbsp;</span><span class="buttondetail">View&nbsp;all&nbsp;Restaurants</span><span class="rightborder">&nbsp;</span></a></span><span class="clear">&nbsp;</span><span class="viewmore">View restaurants by cuisine: ' . $featured_fp_restaurants_extras . '</span></p>';*/

}

// ------------------------------------------------------------------------------------------------------------------------------

if(strlen($featured_fp_restaurants) > 0){
?>
<section class="featured-lis" >
        <div class="container">
          <div class="row">
            <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
              <h3 class="section-title">Featured Restaurants</h3>
              <div id="new-restaurants" class="owl-carousel">
			  
			  <?php echo $featured_fp_restaurants; ?>
			  
			   </div>
            </div> 
          </div></section>
<!--<div class="item">
<p class="header">
<strong>Featured Restaurants</strong>
</p>

<div class="middle">
<div class="slideshow8">
<?php //echo $featured_fp_restaurants; ?>
</div>
<span class="controlscontainers">
<a class="jFlowPlay" id="jFPlay8" href="#">&nbsp;</a>
<span class="controls8"></span>
</span>
</div>

<img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" />
</div>-->
<?php } ?>
