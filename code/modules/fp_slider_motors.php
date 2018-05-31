<?php

$featured_fp_motors_sale = '';
$featured_fp_motors_sale_extras = '';
$num_items_motors_sale = 0;
$featured_fp_motors_rent = '';
$featured_fp_motors_rent_extras = '';
$num_items_motors_rent = 0;

// ------------------------------------------------------------------------------------------------------------------------------

$sqlquery = mysql_query('SELECT id, title FROM motors_makes_models WHERE parent_id = 0 ORDER BY RAND() LIMIT 3');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$field_t_id = filer_out_limit($row['id']);
	$field_t_title = filer_out_limit($row['title']);
	
	$featured_fp_motors_sale_extras .= '<a href="motors-for-sale-by-make/' . $field_t_id . '/' . seo($field_t_title) . '">' . $field_t_title . '</a>, ';
	$featured_fp_motors_rent_extras .= '<a href="motors-for-rent-by-make/' . $field_t_id . '/' . seo($field_t_title) . '">' . $field_t_title . '</a>, ';
}

if(strlen($featured_fp_motors_sale_extras) > 0){$featured_fp_motors_sale_extras = substr($featured_fp_motors_sale_extras, 0, strlen($featured_fp_motors_sale_extras)-2);}
if(strlen($featured_fp_motors_rent_extras) > 0){$featured_fp_motors_rent_extras = substr($featured_fp_motors_rent_extras, 0, strlen($featured_fp_motors_rent_extras)-2);}

// ------------------------------------------------------------------------------------------------------------------------------

$sql = "SELECT motors.id, motors.member_id, motors.title, motors.price, motors.img1, motors.brief, locations.title ltitle, profiles.company_name, motors_makes_models.title mmake FROM motors INNER JOIN locations ON motors.geo2_id = locations.id INNER JOIN profiles ON motors.member_id = profiles.id INNER JOIN motors_makes_models ON motors.make_id = motors_makes_models.id WHERE motors.status=1 AND locations.status=1 AND motors.is_fp = 1 AND motors.type_id = 1 AND motors_makes_models.status = 1";
if($global_emirate_id > 0){$sql .= ' AND motors.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY motors.date_created DESC LIMIT 5';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_items_motors_sale++;
	$field_t_id = filer_out_limit($row['id']);
	$field_t_member_id = filer_out_limit($row['member_id']);
	$field_t_member_company = filer_out_limit($row['company_name']);
	$field_t_title = filer_out_limit($row['title']);
	$field_t_price = filer_out_limit($row['price']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_make = filer_out_limit($row['mmake']);
	
	$url = 'motor-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}
	
	
	 $featured_fp_motors_sale .= '<div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <a href="' . $url . '"><img src="files/motors/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
                      <div class="overlay">
                        <a href="' . $url . '"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>    
                    <a href="' . $url . '">' . $field_t_title . ',' .$field_t_location.'</a><br>
					Price: ' . $global_settings_measurements[0] . ' ' . number_f($field_t_price) . '<br>
					Make: ' . $field_t_make . '<br>
					Location: ' . $field_t_location . ' 
                  </div>
                </div>';
	

	/*$featured_fp_motors_sale .= '<p><span class="frame"><a href="' . $url . '"><img src="files/motors/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a></span><span class="text"><span class="title"><a href="' . $url . '">' . $field_t_title . '</a></span><span class="category">Price:</span> <strong class="category">' . $global_settings_measurements[0] . ' ' . number_f($field_t_price) . '</strong>  <span class="category">Location:</span> <strong class="category">' . $field_t_location . '</strong><span class="category">Make:</span> <strong class="category">' . $field_t_make . '</strong><br />&nbsp;<br />' . $field_t_brief . '<br /><a class="buttons viewdetails" href="' . $url . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Details</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="motors-by-dealer/' . $field_t_member_id . '/' . seo($field_t_member_company) . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View this Dealer\'s Listings</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="motors"><span class="leftborder">&nbsp;</span><span class="buttondetail">View&nbsp;all&nbsp;Motors</span><span class="rightborder">&nbsp;</span></a></span><span class="clear">&nbsp;</span><span class="viewmore">View more motors for sale: ' . $featured_fp_motors_sale_extras . '</span></p>';*/

}

// ------------------------------------------------------------------------------------------------------------------------------

$sql = "SELECT motors.id, motors.member_id, motors.title, motors.price, motors.img1, motors.brief, locations.title ltitle, profiles.company_name, motors_makes_models.title mmake FROM motors INNER JOIN locations ON motors.geo2_id = locations.id INNER JOIN profiles ON motors.member_id = profiles.id INNER JOIN motors_makes_models ON motors.make_id = motors_makes_models.id WHERE motors.status=1 AND locations.status=1 AND motors.is_fp = 1 AND motors.type_id = 2 AND motors_makes_models.status = 1";
if($global_emirate_id > 0){$sql .= ' AND motors.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY motors.date_created DESC LIMIT 5';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_items_motors_rent++;
	$field_t_id = filer_out_limit($row['id']);
	$field_t_member_id = filer_out_limit($row['member_id']);
	$field_t_member_company = filer_out_limit($row['company_name']);
	$field_t_title = filer_out_limit($row['title']);
	$field_t_price = filer_out_limit($row['price']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_make = filer_out_limit($row['mmake']);
	
	$url = 'motor-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

		 $featured_fp_motors_rent .= '<div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <a href="' . $url . '"><img src="files/motors/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
                      <div class="overlay">
                        <a href="' . $url . '"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>    
                    <a href="' . $url . '">' . $field_t_title . ',' .$field_t_location.'</a><br>
					Price: ' . $global_settings_measurements[0] . ' ' . number_f($field_t_price) . '<br>
					Make: ' . $field_t_make . '<br>
					Location: ' . $field_t_location . ' 
                  </div>
                </div>';
	
	/*$featured_fp_motors_rent .= '<p><span class="frame"><a href="' . $url . '"><img src="files/motors/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a></span><span class="text"><span class="title"><a href="' . $url . '">' . $field_t_title . '</a></span><span class="category">Price:</span> <strong class="category">' . $global_settings_measurements[0] . ' ' . number_f($field_t_price) . '</strong>  <span class="category">Location:</span> <strong class="category">' . $field_t_location . '</strong><span class="category">Make:</span> <strong class="category">' . $field_t_make . '</strong><br />&nbsp;<br />' . $field_t_brief . '<br /><a class="buttons viewdetails" href="' . $url . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Details</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="motors-by-dealer/' . $field_t_member_id . '/' . seo($field_t_member_company) . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View this Dealer\'s Listings</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="motors"><span class="leftborder">&nbsp;</span><span class="buttondetail">View&nbsp;all&nbsp;Motors</span><span class="rightborder">&nbsp;</span></a></span><span class="clear">&nbsp;</span><span class="viewmore">View more motors for rent: ' . $featured_fp_motors_rent_extras . '</span></p>';*/

}

// ------------------------------------------------------------------------------------------------------------------------------
/*
if(strlen($featured_fp_motors_sale) > 0 || strlen($featured_fp_motors_rent) > 0){
?>

<div class="item">
<p class="header">
<strong>Featured Motors</strong>
<?php if(strlen($featured_fp_motors_sale) > 0 && strlen($featured_fp_motors_rent) > 0){ ?><span class="buttons"><a class="rightbutton" href="#" id="bb__motors_f">Motors for Rent</a><img src="graphics/fillers/content-header-buttons-divider.png" alt="" /><a class="leftbutton leftbuttonselected" href="#" id="bb__motors_e">Motors for Sale</a></span><?php } ?>
</p>

<?php if(strlen($featured_fp_motors_sale) > 0){ ?>
<div class="middle" id="ss__motors_e">
<div class="slideshow5">
<?php echo $featured_fp_motors_sale; ?>
</div>
<?php if($num_items_motors_sale > 1){ ?>
<span class="controlscontainers">
<a class="jFlowPlay" id="jFPlay5" href="#">&nbsp;</a>
<span class="controls5"></span>
</span>
<?php } ?>
</div>
<?php } ?>

<?php if(strlen($featured_fp_motors_rent) > 0){ 

// -------------------------------------------------------------
// New: need to cater for then there are no listings in the main selected tab BUT there are in the other tab
$new__num = 6;
if(strlen($featured_fp_motors_sale) == 0){$new__num = 5;}
// -------------------------------------------------------------

?>
<div class="middle" <?php if(strlen($featured_fp_motors_sale) > 0){echo 'style="display:none;"';} ?> id="ss__motors_f">
<div class="slideshow<?php echo $new__num; ?>">
<?php echo $featured_fp_motors_rent; ?>
</div>
<?php if($num_items_motors_rent > 1){ ?>
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

<?php if(strlen($featured_fp_motors_sale) > 0 || strlen($featured_fp_motors_rent) > 0){ ?>
<section class="featured-lis" >
        <div class="container">
          <div class="row">
            <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
              <h3 class="section-title">Featured Motors</h3>
              <div id="new-motors" class="owl-carousel">
			  <?php if(strlen($featured_fp_motors_rent) > 0){ ?>
			  <div id="new-products" class="owl-carousel">
			  <?php echo $featured_fp_motors_rent; ?>
			   </div>
			  <?php } ?>
			  
			   <?php if(strlen($featured_fp_motors_sale) > 0){ ?>
			    <div id="new-products" class="owl-carousel" <?php if(strlen($featured_fp_motors_sale) > 0){echo 'style="display:none;"';} ?> id="ss__properties_b">
			  <?php echo $featured_fp_motors_sale; ?>
			    </div>
			  <?php }  ?>

              </div>
            </div> 
          </div></section>
		   <?php }  ?>
