<?php

$featured_fp_directory = '';
$num_fp_directory = 0;

$sql = "SELECT directory.id, directory.title, directory.img1, directory.brief, directory_categories.title ititle, locations.title ltitle FROM directory INNER JOIN directory_categories ON directory.category_id = directory_categories.id INNER JOIN locations ON directory.geo2_id = locations.id WHERE directory.status=1 AND directory.is_fp=1 AND directory_categories.status=1 AND locations.status=1";
if($global_emirate_id > 0){$sql .= ' AND directory.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY directory.date_created DESC LIMIT 10';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_fp_directory++;
	$field_t_id = $row['id'];
	$field_t_title = filer_out_limit($row['title']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_industry = filer_out_limit($row['ititle']);
	$field_t_location = filer_out_limit($row['ltitle']);
	
	$url = 'directory-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

		  $featured_fp_directory .= '<div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <a href="' . $url . '"><img src="files/directory/fp/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
                      <div class="overlay">
                        <a href="' . $url . '"><i class="fa fa-link"></i></a>
                      </div> 
                    </div> 
                    <a href="' . $url . '" class="item-name">' . $field_t_title . '<br>
					' . $field_t_location . '</a>  
                   
                  </div>
                </div>';
	
	
/*	$featured_fp_directory .= '<span class="directorylisting"><a href="' . $url . '"><img src="files/directory/fp/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a><span class="name">' . $field_t_title . '</span><span class="category">' . $field_t_industry . '</span><span class="area">' . $field_t_location . '</span>' . substr($field_t_brief,0,255) . '...<br /><a class="buttons viewdetails" href="' . $url . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Details</span><span class="rightborder">&nbsp;</span></a></span>';
	
	if($num_fp_directory < 4){
		$featured_fp_directory .= '<img class="divider" src="graphics/fillers/content-directories-divider.png" alt="" height="238" width="69" />';
	}*/

}

if(strlen($featured_fp_directory) > 0){ ?>

   <section>
        <div class="container">
		     <div class="row">
            <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
              <h3 class="section-title">Featured Directory</h3>
              <div id="new-directory" class="owl-carousel">
                <?php echo $featured_fp_directory; ?>
              </div>
            </div> 
        </div>
      </section>
		  
<!--<div class="itemfull">
<p class="header">
<strong>Featured Directory</strong>
<span class="buttons"><a href="directory"><span class="leftborder">&nbsp;</span><span class="buttondetail">View all Directory Entries</span></a></span>
</p>
<p class="middle">
<?php //echo $featured_fp_directory; ?>
</p>
<img class="bottomborder" src="graphics/fillers/content-bottom-borders-full-bg.png" alt="" />
</div>
<div class="clear">&nbsp;</div>-->
<?php }  ?>

