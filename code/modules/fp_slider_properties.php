<?php

$featured_fp_properties_sale = '';
$featured_fp_properties_sale_extras = '';
$num_items_prop_sale = 0;
$featured_fp_properties_rent = '';
$featured_fp_properties_rent_extras = '';
$num_items_prop_rent = 0;

// ------------------------------------------------------------------------------------------------------------------------------

$sqlquery = mysql_query('SELECT id, title FROM properties_types WHERE parent_id > 0 ORDER BY RAND() LIMIT 3');echo mysql_error();
while($row = mysql_fetch_assoc($sqlquery)){ 
	$field_t_id = filer_out_limit($row['id']);
	$field_t_title = filer_out_limit($row['title']);
	
	$featured_fp_properties_sale_extras .= '<a href="properties-for-sale-by-type/' . $field_t_id . '/' . seo($field_t_title) . '">' . $field_t_title . '</a>, ';
	$featured_fp_properties_rent_extras .= '<a href="properties-for-rent-by-type/' . $field_t_id . '/' . seo($field_t_title) . '">' . $field_t_title . '</a>, ';
}

if(strlen($featured_fp_properties_sale_extras) > 0){$featured_fp_properties_sale_extras = substr($featured_fp_properties_sale_extras, 0, strlen($featured_fp_properties_sale_extras)-2);}
if(strlen($featured_fp_properties_rent_extras) > 0){$featured_fp_properties_rent_extras = substr($featured_fp_properties_rent_extras, 0, strlen($featured_fp_properties_rent_extras)-2);}

// ------------------------------------------------------------------------------------------------------------------------------

$sql = "SELECT properties.id, properties.member_id, properties.title, properties.img1, properties.bed, properties.price, properties.brief, properties.size_dwelling, properties.rental_time, properties.bed, properties.ref, locations.title ltitle, profiles.company_name FROM properties INNER JOIN locations ON properties.geo2_id = locations.id INNER JOIN profiles ON properties.member_id = profiles.id WHERE properties.status=1 AND locations.status=1 AND properties.is_fp = 1 AND properties.category_id = 1";
if($global_emirate_id > 0){$sql .= ' AND properties.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY properties.date_created DESC LIMIT 5';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_items_prop_sale++;
	$field_t_id = filer_out_limit($row['id']);
	$field_t_member_id = filer_out_limit($row['member_id']);
	$field_t_member_company = filer_out_limit($row['company_name']);
	$field_t_title = filer_out_limit($row['title']);
	$field_t_brief = filer_out_limit($row['brief']);
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

	
	 $featured_fp_properties_sale .= '<div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <a href="' . $url . '"><img src="files/property/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
                      <div class="overlay">
                        <a href="' . $url . '"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>    
                    <a href="' . $url . '">' . $field_t_title . ',' .$field_t_location.'<br>
					Price: ' . $global_settings_measurements[0] . ' ' . number_f($field_t_price) . ' ' . $field_t_rentaltime . '<br>
					Size: ' . $field_t_size . ' ' . $global_settings_measurements[2] . '<br>
					Location: ' . $field_t_location . ' 
                  </div>
                </div>';
	
	
	
	
	
	/*$featured_fp_properties_sale .= '<p><span class="frame"><a href="' . $url . '"><img src="files/property/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a></span><span class="text"><span class="title"><a href="' . $url . '">' . $field_t_title . '</a></span><span class="category">Price:</span> <strong class="category">' . $global_settings_measurements[0] . ' ' . number_f($field_t_price) . ' ' . $field_t_rentaltime . '</strong>  <span class="category">Location:</span> <strong class="category">' . $field_t_location . '</strong><span class="category">Size:</span> <strong class="category">' . $field_t_size . ' ' . $global_settings_measurements[2] . '</strong><br />&nbsp;<br />' . substr($field_t_brief,0,255) . '...<br /><a class="buttons viewdetails" href="' . $url . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Details</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="properties-by-agent/' . $field_t_member_id . '/' . seo($field_t_member_company) . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Agent\'s Properties</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="property"><span class="leftborder">&nbsp;</span><span class="buttondetail">View&nbsp;all&nbsp;Properties</span><span class="rightborder">&nbsp;</span></a></span><span class="clear">&nbsp;</span><span class="viewmore">View more properties for sale: ' . $featured_fp_properties_sale_extras . '</span></p>';*/

}

// ------------------------------------------------------------------------------------------------------------------------------

$sql = "SELECT properties.id, properties.member_id, properties.title, properties.img1, properties.bed, properties.price, properties.brief, properties.size_dwelling, properties.rental_time, properties.bed, properties.ref, locations.title ltitle, profiles.company_name FROM properties INNER JOIN locations ON properties.geo2_id = locations.id INNER JOIN profiles ON properties.member_id = profiles.id WHERE properties.status=1 AND locations.status=1 AND properties.is_fp = 1 AND properties.category_id = 2";
if($global_emirate_id > 0){$sql .= ' AND properties.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY properties.date_created DESC LIMIT 5';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_items_prop_rent++;
	$field_t_id = filer_out_limit($row['id']);
	$field_t_member_id = filer_out_limit($row['member_id']);
	$field_t_member_company = filer_out_limit($row['company_name']);
	$field_t_title = filer_out_limit($row['title']);
	$field_t_brief = filer_out_limit($row['brief']);
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

	
		 $featured_fp_properties_rent .= '<div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <a href="' . $url . '"><img src="files/property/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
                      <div class="overlay">
                        <a href="' . $url . '"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>    
                    <a href="' . $url . '">' . $field_t_title . ',' .$field_t_location.'<br>
					Price: ' . $global_settings_measurements[0] . ' ' . number_f($field_t_price) . ' ' . $field_t_rentaltime . '<br>
					Size: ' . $field_t_size . ' ' . $global_settings_measurements[2] . '<br>
					Location: ' . $field_t_location . ' 
                  </div>
                </div>';
	
	
	
	/*$featured_fp_properties_rent .= '<p><span class="frame"><a href="' . $url . '"><img src="files/property/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a></span><span class="text"><span class="title"><a href="' . $url . '">' . $field_t_title . '</a></span><span class="category">Price:</span> <strong class="category">' . $global_settings_measurements[0] . ' ' . number_f($field_t_price) . ' ' . $field_t_rentaltime . '</strong>  <span class="category">Location:</span> <strong class="category">' . $field_t_location . '</strong><span class="category">Size:</span> <strong class="category">' . $field_t_size . ' ' . $global_settings_measurements[2] . '</strong><br />&nbsp;<br />' . $field_t_brief . '<br /><a class="buttons viewdetails" href="' . $url . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Details</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="properties-by-agent/' . $field_t_member_id . '/' . seo($field_t_member_company) . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Agent\'s Properties</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="property"><span class="leftborder">&nbsp;</span><span class="buttondetail">View&nbsp;all&nbsp;Properties</span><span class="rightborder">&nbsp;</span></a></span><span class="clear">&nbsp;</span><span class="viewmore">View more properties for rent: ' . $featured_fp_properties_rent_extras . '</span></p>';*/
	

}

// ------------------------------------------------------------------------------------------------------------------------------



/*
if(strlen($featured_fp_properties_sale) > 0 || strlen($featured_fp_properties_rent) > 0){
?>

<div class="item">
<p class="header">
<strong>Featured Properties</strong>
<?php if(strlen($featured_fp_properties_sale) > 0 && strlen($featured_fp_properties_rent) > 0){ ?><span class="buttons"><a class="rightbutton" href="?sale" id="bb__properties_b">Properties for Sale</a><img src="graphics/fillers/content-header-buttons-divider.png" alt="" /><a class="leftbutton leftbuttonselected" href="?renting" id="bb__properties_a">Properties for Rent</a></span><?php } ?>
</p>

<?php if(strlen($featured_fp_properties_rent) > 0){ ?>
<div class="middle" id="ss__properties_a">
<div class="slideshow1">
<?php echo $featured_fp_properties_rent; ?>
</div>
<?php if($num_items_prop_rent > 1){ ?>
<span class="controlscontainers">
<a class="jFlowPlay" id="jFPlay1" href="#">&nbsp;</a>
<span class="controls1"></span>
</span>
<?php } ?>
</div>
<?php } ?>

<?php if(strlen($featured_fp_properties_sale) > 0){ 

// -------------------------------------------------------------
// New: need to cater for then there are no listings in the main selected tab BUT there are in the other tab
$new__num = 2;
if(strlen($featured_fp_properties_rent) == 0){$new__num = 1;}
// -------------------------------------------------------------

?>
<div class="middle" <?php if(strlen($featured_fp_properties_rent) > 0){echo 'style="display:none;"';} ?> id="ss__properties_b">
<div class="slideshow<?php echo $new__num; ?>">
<?php echo $featured_fp_properties_sale; ?>
</div>
<?php if($num_items_prop_sale > 1){ ?>
<span class="controlscontainers">
<a class="jFlowPlay" id="jFPlay<?php echo $new__num; ?>" href="#">&nbsp;</a>
<span class="controls<?php echo $new__num; ?>"></span>
</span>
<?php } ?>
</div>
<?php } ?>

<img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" />
</div>
<?php } */ ?>

<script>
$("#bb__properties_a").click(function(){return $("#ss__properties_b").hide();

</script>

<?php if(strlen($featured_fp_properties_sale) > 0 || strlen($featured_fp_properties_rent) > 0){ ?>
		<section class="featured-lis" >
        <div class="container">
          <div class="row">
            <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
              <h3 class="section-title">Featured Property</h3>
			  
				<!--<a class="btn btn-danger btn-post" href="#" id="bb__properties_b">Properties for Sale</a>
				<a class="btn btn-danger btn-post" href="#" id="bb__properties_a">Properties for Rent</a>-->
			<?php if(strlen($featured_fp_properties_rent) > 0){ ?>
			  <div id="new-products" class="owl-carousel">
			  <?php echo $featured_fp_properties_rent; ?>
			   </div>
			  <?php } ?>
			  
			   <?php if(strlen($featured_fp_properties_sale) > 0){ ?>
			    <div id="new-products" class="owl-carousel" <?php if(strlen($featured_fp_properties_rent) > 0){echo 'style="display:none;"';} ?> id="ss__properties_b">
			  <?php echo $featured_fp_properties_sale; ?>
			    </div>
			  <?php }  ?>
              </div>
            </div> 
          </div></section>
		   <?php } ?>