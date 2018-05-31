<?php

$featured_fp_jobs_offer = '';
$featured_fp_jobs_offer_extras = '';
$num_items_jobs_offer = 0;
$featured_fp_jobs_wanted = '';
$featured_fp_jobs_wanted_extras = '';
$num_items_jobs_wanted = 0;

// ------------------------------------------------------------------------------------------------------------------------------

$sqlquery = mysql_query('SELECT id, title FROM jobs_industries ORDER BY RAND() LIMIT 3');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$field_t_id = filer_out_limit($row['id']);
	$field_t_title = filer_out_limit($row['title']);
	
	$featured_fp_jobs_offer_extras .= '<a href="jobs-offered-by-industry/' . $field_t_id . '/' . seo($field_t_title) . '">' . $field_t_title . '</a>, ';
	$featured_fp_jobs_wanted_extras .= '<a href="jobs-wanted-by-industry/' . $field_t_id . '/' . seo($field_t_title) . '">' . $field_t_title . '</a>, ';
}

if(strlen($featured_fp_jobs_offer_extras) > 0){$featured_fp_jobs_offer_extras = substr($featured_fp_jobs_offer_extras, 0, strlen($featured_fp_jobs_offer_extras)-2);}
if(strlen($featured_fp_jobs_wanted_extras) > 0){$featured_fp_jobs_wanted_extras = substr($featured_fp_jobs_wanted_extras, 0, strlen($featured_fp_jobs_wanted_extras)-2);}

// ------------------------------------------------------------------------------------------------------------------------------

$sql = "SELECT jobs.id, jobs.member_id, jobs.title, jobs.img1, jobs.ref, jobs.brief, locations.title ltitle, profiles.company_name, jobs_industries.title indust FROM jobs INNER JOIN locations ON jobs.geo2_id = locations.id INNER JOIN profiles ON jobs.member_id = profiles.id INNER JOIN jobs_industries ON jobs.industry_id = jobs_industries.id WHERE jobs.status=1 AND locations.status=1 AND jobs.is_fp = 1 AND jobs.type_id = 1";
if($global_emirate_id > 0){$sql .= ' AND jobs.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY jobs.date_created DESC LIMIT 5';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_items_jobs_offer++;
	$field_t_id = filer_out_limit($row['id']);
	$field_t_member_id = filer_out_limit($row['member_id']);
	$field_t_member_company = filer_out_limit($row['company_name']);
	$field_t_title = filer_out_limit($row['title']);
	$field_t_industry = filer_out_limit($row['indust']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_ref = filer_out_limit($row['ref']);
	
	$url = 'job-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

		 $featured_fp_jobs_offer .= '<div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <a href="' . $url . '"><img src="files/jobs/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
                      <div class="overlay">
                        <a href="' . $url . '"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>    
                    <a href="' . $url . '">' . $field_t_title . ',' .$field_t_location.'</a><br>
					Reference: ' . $field_t_ref . '<br>
					Location: ' . $field_t_location . '<br>
					Industry: ' . $field_t_industry . ' 
                  </div>
                </div>';
	
	
	/*$featured_fp_jobs_offer .= '<p><span class="frame"><a href="' . $url . '"><img src="files/jobs/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a></span><span class="text"><span class="title"><a href="' . $url . '">' . $field_t_title . '</a></span><span class="category">Reference:</span> <strong class="category">' . $field_t_ref . '</strong>  <span class="category">Location:</span> <strong class="category">' . $field_t_location . '</strong><span class="category">Industry:</span> <strong class="category">' . $field_t_industry . '</strong><br />&nbsp;<br />' . substr($field_t_brief,0,255) . '...<br /><a class="buttons viewdetails" href="' . $url . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Details</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="jobs-by-advertiser/' . $field_t_member_id . '/' . seo($field_t_member_company) . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Advertiser\'s Jobs</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="jobs"><span class="leftborder">&nbsp;</span><span class="buttondetail">View&nbsp;all&nbsp;Jobs</span><span class="rightborder">&nbsp;</span></a></span><span class="clear">&nbsp;</span><span class="viewmore">View more jobs offered: ' . $featured_fp_jobs_offer_extras . '</span></p>';*/

}

// ------------------------------------------------------------------------------------------------------------------------------

$sql = "SELECT jobs.id, jobs.member_id, jobs.title, jobs.img1, jobs.ref, jobs.brief, locations.title ltitle, profiles.company_name, jobs_industries.title indust FROM jobs INNER JOIN locations ON jobs.geo2_id = locations.id INNER JOIN profiles ON jobs.member_id = profiles.id INNER JOIN jobs_industries ON jobs.industry_id = jobs_industries.id WHERE jobs.status=1 AND locations.status=1 AND jobs.is_fp = 1 AND jobs.type_id = 2";
if($global_emirate_id > 0){$sql .= ' AND jobs.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY jobs.date_created DESC LIMIT 5';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_items_jobs_wanted++;
	$field_t_id = filer_out_limit($row['id']);
	$field_t_member_id = filer_out_limit($row['member_id']);
	$field_t_member_company = filer_out_limit($row['company_name']);
	$field_t_title = filer_out_limit($row['title']);
	$field_t_industry = filer_out_limit($row['indust']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_ref = filer_out_limit($row['ref']);
	
	$url = 'job-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

	 $featured_fp_jobs_wanted .= '<div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <a href="' . $url . '"><img src="files/jobs/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
                      <div class="overlay">
                        <a href="' . $url . '"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>    
                    <a href="' . $url . '">' . $field_t_title . ',' .$field_t_location.'</a><br>
					Reference: ' . $field_t_ref . '<br>
					Location: ' . $field_t_location . '<br>
					Industry: ' . $field_t_industry . ' 
                  </div>
                </div>';
	
	/*$featured_fp_jobs_wanted .= '<p><span class="frame"><a href="' . $url . '"><img src="files/jobs/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a></span><span class="text"><span class="title"><a href="' . $url . '">' . $field_t_title . '</a></span><span class="category">Reference:</span> <strong class="category">' . $field_t_ref . '</strong>  <span class="category">Location:</span> <strong class="category">' . $field_t_location . '</strong><span class="category">Industry:</span> <strong class="category">' . $field_t_industry . '</strong><br />&nbsp;<br />' . $field_t_brief . '<br /><a class="buttons viewdetails" href="' . $url . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Details</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="jobs-by-advertiser/' . $field_t_member_id . '/' . seo($field_t_member_company) . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Advertiser\'s Jobs</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="jobs"><span class="leftborder">&nbsp;</span><span class="buttondetail">View&nbsp;all&nbsp;Jobs</span><span class="rightborder">&nbsp;</span></a></span><span class="clear">&nbsp;</span><span class="viewmore">View more jobs wanted: ' . $featured_fp_jobs_wanted_extras . '</span></p>';*/

}

// ------------------------------------------------------------------------------------------------------------------------------
/*
if(strlen($featured_fp_jobs_offer) > 0 || strlen($featured_fp_jobs_wanted) > 0){
?>

<div class="item">
<p class="header">
<strong>Featured Jobs</strong>
<?php if(strlen($featured_fp_jobs_offer) > 0 && strlen($featured_fp_jobs_wanted) > 0){ ?><span class="buttons"><a class="rightbutton" href="?sale" id="bb__jobs_d">Jobs Wanted</a><img src="graphics/fillers/content-header-buttons-divider.png" alt="" /><a class="leftbutton leftbuttonselected" href="?renting" id="bb__jobs_c">Jobs on Offer</a></span><?php } ?>
</p>

<?php if(strlen($featured_fp_jobs_offer) > 0){ ?>
<div class="middle" id="ss__jobs_c">
<div class="slideshow3">
<?php echo $featured_fp_jobs_offer; ?>
</div>
<?php if($num_items_jobs_offer > 1){ ?>
<span class="controlscontainers">
<a class="jFlowPlay" id="jFPlay3" href="#">&nbsp;</a>
<span class="controls3"></span>
</span>
<?php } ?>
</div>
<?php } ?>

<?php if(strlen($featured_fp_jobs_wanted) > 0){ 

// -------------------------------------------------------------
// New: need to cater for then there are no listings in the main selected tab BUT there are in the other tab
$new__num = 4;
if(strlen($featured_fp_jobs_offer) == 0){$new__num = 3;}
// -------------------------------------------------------------

?>
<div class="middle" <?php if(strlen($featured_fp_jobs_offer) > 0){echo 'style="display:none;"';} ?> id="ss__jobs_d">
<div class="slideshow<?php echo $new__num; ?>">
<?php echo $featured_fp_jobs_wanted; ?>
</div>
<?php if($num_items_jobs_wanted > 1){ ?>
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
<?php if(strlen($featured_fp_jobs_offer) > 0 || strlen($featured_fp_jobs_wanted) > 0){ ?>
<section class="featured-lis" >
        <div class="container">
          <div class="row">
            <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
              <h3 class="section-title">Featured Jobs</h3>
			  
				<!--<a class="btn btn-danger btn-post" href="#" id="bb__properties_b">Properties for Sale</a>
				<a class="btn btn-danger btn-post" href="#" id="bb__properties_a">Properties for Rent</a>-->
			<?php if(strlen($featured_fp_jobs_offer) > 0){ ?>
			  <div id="new-jobs" class="owl-carousel">
			  <?php echo $featured_fp_jobs_offer; ?>
			   </div>
			  <?php } ?>
			  
			   <?php if(strlen($featured_fp_jobs_wanted) > 0){ ?>
			    <div id="new-jobs" class="owl-carousel" <?php if(strlen($featured_fp_jobs_offer) > 0){echo 'style="display:none;"';} ?> id="ss__properties_b">
			  <?php echo $featured_fp_jobs_wanted; ?>
			    </div>
			  <?php }  ?>
              </div>
            </div> 
          </div></section>
<?php } ?>