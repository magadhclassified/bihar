<?php

$landing_dir_cat_list = '';
$landing_dir_cat_cnt = 0;

$sqlquery = mysql_query('SELECT id, title FROM directory_categories WHERE status = 1 AND parent_id = 0 ORDER BY ordering ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$landing_dir_cat_cnt++;
	$landing_dir_cat_id = filer_out_limit($row['id']);
	$landing_dir_cat_title = filer_out_limit($row['title']);
	
	
	 $landing_dir_cat_list .= '<div class="col-md-3 col-sm-6 col-xs-12">
              <div style="visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;" class="category-box border-1 wow fadeInUpQuick animated animated" data-wow-delay="0.3s">
                <div class="icon">
                  <i class="lnr lnr-users color-1"></i>
                </div>
                <div class="category-header">  
                  <h4>' . $landing_dir_cat_title . '</h4>
                </div>
                <div class="category-content">
                  <ul>';
	
	
	//$landing_dir_cat_list .= '<div class="directorylisting' . ($landing_dir_cat_cnt % 3 == 0 ? ' directorylistingright' : '') . '"><p class="directorylistingtitle">' . $landing_dir_cat_title . '</p><ul>';
	
	// ----------------------------------------------------------------------------------------------------------------------------------
	
	$sql_extra_line = '';
	if($global_emirate_id > 0){$sql_extra_line .= ' AND directory.geo1_id = ' . $global_emirate_id;}
	
	$sqlquery2 = mysql_query('SELECT id, title, (SELECT COUNT(id) FROM directory WHERE category_id = directory_categories.id' . $sql_extra_line . ' AND status=1) num FROM directory_categories WHERE status = 1 AND parent_id = ' . (int)$landing_dir_cat_id . ' ORDER BY ordering ASC');
	while($row2 = mysql_fetch_assoc($sqlquery2)){ 
		$landingx_dir_cat_id = filer_out_limit($row2['id']);
		$landingx_dir_cat_title = filer_out_limit($row2['title']);
		$landingx_dir_cat_num = filer_out_limit($row2['num']);
		
		$landing_dir_cat_list .= '<li><a href="directory-category/1-' . $landingx_dir_cat_id . '/' . seo($landingx_dir_cat_title) . '">' . $landingx_dir_cat_title . '</a><span class="category-counter">' . $landingx_dir_cat_num . '</sapn></li>';
	}
	
	// ----------------------------------------------------------------------------------------------------------------------------------
	
	$landing_dir_cat_list .= '</ul></div></div></div>';
	
	//if($landing_dir_cat_cnt % 3 == 0){$landing_dir_cat_list .= '<div class="clear">&nbsp;</div>';}
	
}

?>