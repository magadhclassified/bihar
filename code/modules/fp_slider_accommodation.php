<?php

$featured_fp_accommodation_sale = '';
$featured_fp_accommodation_sale_extras = '';
$num_items_accommodation_sale = 0;
$featured_fp_accommodation_rent = '';
$featured_fp_accommodation_rent_extras = '';
$num_items_accommodation_rent = 0;

// ------------------------------------------------------------------------------------------------------------------------------

$sqlquery = mysql_query('SELECT id, title FROM accommodation_types ORDER BY RAND() LIMIT 3');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$field_t_id = filer_out_limit($row['id']);
	$field_t_title = filer_out_limit($row['title']);
	
	$featured_fp_accommodation_sale_extras .= '<a href="accommodation-by-type/' . $field_t_id . '/' . seo($field_t_title) . '">' . $field_t_title . '</a>, ';
	$featured_fp_accommodation_rent_extras .= '<a href="accommodation-by-type/' . $field_t_id . '/' . seo($field_t_title) . '">' . $field_t_title . '</a>, ';
}

if(strlen($featured_fp_accommodation_sale_extras) > 0){$featured_fp_accommodation_sale_extras = substr($featured_fp_accommodation_sale_extras, 0, strlen($featured_fp_accommodation_sale_extras)-2);}
if(strlen($featured_fp_accommodation_rent_extras) > 0){$featured_fp_accommodation_rent_extras = substr($featured_fp_accommodation_rent_extras, 0, strlen($featured_fp_accommodation_rent_extras)-2);}

// ------------------------------------------------------------------------------------------------------------------------------

$sql = "SELECT accommodation.id, accommodation.member_id, accommodation.title, accommodation.price, accommodation.contact_number, accommodation.img1, accommodation.brief, locations.title ltitle, profiles.company_name FROM accommodation INNER JOIN locations ON accommodation.geo2_id = locations.id INNER JOIN profiles ON accommodation.member_id = profiles.id WHERE accommodation.status=1 AND locations.status=1 AND accommodation.is_fp = 1 AND accommodation.type_id = 1";
if($global_emirate_id > 0){$sql .= ' AND accommodation.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY accommodation.date_created DESC LIMIT 10';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_items_accommodation_sale++;
	$field_t_id = filer_out_limit($row['id']);
	$field_t_member_id = filer_out_limit($row['member_id']);
	$field_t_member_company = filer_out_limit($row['company_name']);
	$field_t_title = filer_out_limit($row['title']);
	$field_t_price = filer_out_limit($row['price']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_contact = filer_out_limit($row['contact_number']);
	
	$url = 'accommodation-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

	
	
	 $featured_fp_accommodation_sale .= '<div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <a href="' . $url . '"><img src="files/accommodation/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
                      <div class="overlay">
                        <a href="' . $url . '"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>    
                    <a href="' . $url . '">' . $field_t_title . ',' .$field_t_location.'</a><br>
					Contact: ' . $field_t_contact . '<br>
					Location: ' . $field_t_location . '
                  </div>
                </div>';
	
	
	/*$featured_fp_accommodation_sale .= '<p><span class="frame"><a href="' . $url . '"><img src="files/accommodation/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a></span><span class="text"><span class="title"><a href="' . $url . '">' . $field_t_title . '</a></span><span class="category">Location:</span> <strong class="category">' . $field_t_location . '</strong><br /><span class="category">Contact:</span> <strong class="category">' . $field_t_contact . '</strong><br />&nbsp;<br />' . $field_t_brief . '<br /><a class="buttons viewdetails" href="' . $url . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Details</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="accommodation"><span class="leftborder">&nbsp;</span><span class="buttondetail">View&nbsp;all&nbsp;Hotels</span><span class="rightborder">&nbsp;</span></a></span><span class="clear">&nbsp;</span><span class="viewmore">View more hotels: ' . $featured_fp_accommodation_sale_extras . '</span></p>';*/

}

// ------------------------------------------------------------------------------------------------------------------------------

$sql = "SELECT accommodation.id, accommodation.member_id, accommodation.title, accommodation.price, accommodation.contact_number, accommodation.img1, accommodation.brief, locations.title ltitle, profiles.company_name FROM accommodation INNER JOIN locations ON accommodation.geo2_id = locations.id INNER JOIN profiles ON accommodation.member_id = profiles.id WHERE accommodation.status=1 AND locations.status=1 AND accommodation.is_fp = 1 AND accommodation.type_id = 2";
if($global_emirate_id > 0){$sql .= ' AND accommodation.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY accommodation.date_created DESC LIMIT 10';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_items_accommodation_rent++;
	$field_t_id = filer_out_limit($row['id']);
	$field_t_member_id = filer_out_limit($row['member_id']);
	$field_t_member_company = filer_out_limit($row['company_name']);
	$field_t_title = filer_out_limit($row['title']);
	$field_t_price = filer_out_limit($row['price']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_contact = filer_out_limit($row['contact_number']);
	
	$url = 'accommodation-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

	$featured_fp_accommodation_rent .= '<div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <a href="' . $url . '"><img src="files/accommodation/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
                      <div class="overlay">
                        <a href="' . $url . '"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>    
                    <a href="' . $url . '">' . $field_t_title . ',' .$field_t_location.'</a><br>
					Contact: ' . $field_t_contact . '<br>
					Location: ' . $field_t_location . '
                  </div>
                </div>';
	
	/*$featured_fp_accommodation_rent .= '<p><span class="frame"><a href="' . $url . '"><img src="files/accommodation/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a></span><span class="text"><span class="title"><a href="' . $url . '">' . $field_t_title . '</a></span><span class="category">Location:</span> <strong class="category">' . $field_t_location . '</strong><br /><span class="category">Contact:</span> <strong class="category">' . $field_t_contact . '</strong><br />&nbsp;<br />' . $field_t_brief . '<br /><a class="buttons viewdetails" href="' . $url . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Details</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="accommodation"><span class="leftborder">&nbsp;</span><span class="buttondetail">View&nbsp;all&nbsp;Hotels</span><span class="rightborder">&nbsp;</span></a></span><span class="clear">&nbsp;</span><span class="viewmore">View more hotels: ' . $featured_fp_accommodation_rent_extras . '</span></p>';*/

}

// ------------------------------------------------------------------------------------------------------------------------------
/*
if(strlen($featured_fp_accommodation_sale) > 0 || strlen($featured_fp_accommodation_rent) > 0){
?>

<div class="item">
<p class="header">
<strong>Featured Hotels</strong>
<?php if(strlen($featured_fp_accommodation_sale) > 0 && strlen($featured_fp_accommodation_rent) > 0){ ?><span class="buttons"><a class="rightbutton" href="#" id="bb__accommodation_b">Serviced Apartments</a><img src="graphics/fillers/content-header-buttons-divider.png" alt="" /><a class="leftbutton leftbuttonselected" href="#" id="bb__accommodation_a">Hotels</a></span><?php } ?>
</p>

<?php if(strlen($featured_fp_accommodation_sale) > 0){ ?>
<div class="middle" id="ss__accommodation_a">
<div class="slideshow9">
<?php echo $featured_fp_accommodation_sale; ?>
</div>
<?php if($num_items_accommodation_sale > 1){ ?>
<span class="controlscontainers">
<a class="jFlowPlay" id="jFPlay9" href="#">&nbsp;</a>
<span class="controls9"></span>
</span>
<?php } ?>
</div>
<?php } ?>

<?php if(strlen($featured_fp_accommodation_rent) > 0){ 

// -------------------------------------------------------------
// New: need to cater for then there are no listings in the main selected tab BUT there are in the other tab
$new__num = 10;
if(strlen($featured_fp_accommodation_sale) == 0){$new__num = 9;}
// -------------------------------------------------------------

?>
<div class="middle" <?php if(strlen($featured_fp_accommodation_sale) > 0){echo 'style="display:none;"';} ?> id="ss__accommodation_b">
<div class="slideshow<?php echo $new__num; ?>">
<?php echo $featured_fp_accommodation_rent; ?>
</div>
<?php if($num_items_accommodation_rent > 1){ ?>
<span class="controlscontainers">
<a class="jFlowPlay" id="jFPlay<?php echo $new__num; ?>" href="#">&nbsp;</a>
<span class="controls<?php echo $new__num; ?>"></span>
</span>
<?php } ?>
</div>
<?php } ?>

<img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" />
</div>
<?php } */?>
<?php if(strlen($featured_fp_accommodation_sale) > 0 || strlen($featured_fp_accommodation_rent) > 0){ ?>
<section class="featured-lis" >
        <div class="container">
          <div class="row">
            <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
              <h3 class="section-title">Featured Accommodation</h3>
			  
				<!--<a class="btn btn-danger btn-post" href="#" id="bb__properties_b">Properties for Sale</a>
				<a class="btn btn-danger btn-post" href="#" id="bb__properties_a">Properties for Rent</a>-->
			<?php if(strlen($featured_fp_accommodation_sale) > 0){ ?>
			  <div id="new-accommodation" class="owl-carousel">
			  <?php echo $featured_fp_accommodation_sale; ?>
			   </div>
			  <?php } ?>
			  
			   <?php if(strlen($featured_fp_accommodation_rent) > 0){ ?>
			    <div id="new-accommodation" class="owl-carousel" <?php if(strlen($featured_fp_accommodation_sale) > 0){echo 'style="display:none;"';} ?> id="ss__properties_b">
			  <?php echo $featured_fp_accommodation_rent; ?>
			    </div>
			  <?php }  ?>
              </div>
            </div> 
          </div></section>
<?php } ?>
