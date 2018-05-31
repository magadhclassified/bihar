<?php

$featured_fp_recycle = '';
$featured_fp_recycle_extras = '';
$num_items_recycle = 0;

// ------------------------------------------------------------------------------------------------------------------------------

$sqlquery = mysql_query('SELECT id, title FROM recycle_categories ORDER BY RAND() LIMIT 3');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$field_t_id = filer_out_limit($row['id']);
	$field_t_title = filer_out_limit($row['title']);
	
	$featured_fp_recycle_extras .= '<a href="recycle-items-by-category/' . $field_t_id . '/' . seo($field_t_title) . '">' . $field_t_title . '</a>, ';
}

if(strlen($featured_fp_recycle_extras) > 0){$featured_fp_recycle_extras = substr($featured_fp_recycle_extras, 0, strlen($featured_fp_recycle_extras)-2);}

// ------------------------------------------------------------------------------------------------------------------------------

$sql = "SELECT recycle.id, recycle.member_id, recycle.title, recycle.price, recycle.img1, recycle.brief, locations.title ltitle, profiles.company_name FROM recycle INNER JOIN locations ON recycle.geo2_id = locations.id INNER JOIN profiles ON recycle.member_id = profiles.id WHERE recycle.status=1 AND locations.status=1 AND recycle.is_fp = 1";
if($global_emirate_id > 0){$sql .= ' AND recycle.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY recycle.date_created DESC LIMIT 5';

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
	
	$url = 'recycle-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}
	
	$featured_fp_recycle .= ' <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      "><a href="' . $url . '"><img src="files/recycle/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
                      <div class="overlay">
                        <a href="' . $url . '"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>    
                  <a href="' . $url . '">' . $field_t_title . '<br>
                    ' . $global_settings_measurements[0] . ' ' . number_f2($field_t_price) . ', '. $field_t_location . '</a>   
                  </div>
                </div>';

	/*$featured_fp_recycle .= '<p><span class="frame"><a href="' . $url . '"><img src="files/recycle/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a></span><span class="text"><span class="title"><a href="' . $url . '">' . $field_t_title . '</a></span><span class="category">Price:</span> <strong class="category">' . $global_settings_measurements[0] . ' ' . number_f2($field_t_price) . '</strong><br /><span class="category">Location:</span> <strong class="category">' . $field_t_location . '</strong><br />&nbsp;<br />' . substr($field_t_brief,0,355) . '...<br /><a class="buttons viewdetails" href="' . $url . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Details</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="recycle"><span class="leftborder">&nbsp;</span><span class="buttondetail">View&nbsp;all&nbsp;Recycles</span><span class="rightborder">&nbsp;</span></a></span><span class="clear">&nbsp;</span><span class="viewmore">View items by category: ' . $featured_fp_recycle_extras . '</span></p>';*/

}

// ------------------------------------------------------------------------------------------------------------------------------

if(strlen($featured_fp_recycle) > 0){
?>

<section class="featured-lis" >
        <div class="container">
          <div class="row">
            <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
              <h3 class="section-title">Featured Recycle</h3>
              <div id="new-recycle" class="owl-carousel">
			  <?php echo $featured_fp_recycle; ?>
              </div>
            </div> 
          </div></section>  

<!--<div class="item">
<p class="header">
<strong>Featured Recycles</strong>
</p>

<div class="middle">
<div class="slideshow7">
<?php //echo $featured_fp_recycle; ?>
</div>
<span class="controlscontainers">
<a class="jFlowPlay" id="jFPlay7" href="#">&nbsp;</a>
<span class="controls7"></span>
</span>
</div>

<img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" />
</div>-->
<?php } ?>



				
             
          