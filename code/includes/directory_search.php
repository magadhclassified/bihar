<?php

$pp = WEBSITE_PAGING;
$finalString = '';
$finalPaging = '';
$num_articles = 0;

if($page == 0 || $page == 1){
	$page = 1;
	$lbound = 0;
}else{
	$lbound = ($pp * $page) - $pp;
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$paging_extra = '';
$paging_extra_pre = '';
$search_data_d_category = 0;
$search_data_d_kw = '';
$sr_kw = '';
$search_for_category = '';
$extra_crumb_title = '';
$extra_crumb_url = '';

if($search_id > 0){

	$paging_extra_pre = 'directory/';
	$paging_extra = '-' . $search_id;

	$sqlquery = mysql_query(sprintf("SELECT * FROM searches WHERE id = %d", mysql_real_escape_string($search_id)));
	while($row = mysql_fetch_assoc($sqlquery)){ 
		$search_criteria = unserialize($row['search']);
	}
	$search_data_d_kw = $search_criteria['kw'];
	$search_data_d_category = (int)$search_criteria['category'];

	$sr_kw = $search_data_d_kw;

}else{
	// It was a category click...
	
	$paging_extra_pre = 'directory-category/';
	$search_data_d_category = $my_category;
	$paging_extra = '-' . $search_data_d_category; // instead add the cat id and also the cat name SEO
	
	// Get the category for display
	$sqlquery = mysql_query(sprintf("SELECT title, brief, keywords FROM directory_categories WHERE id = %d", mysql_real_escape_string($search_data_d_category)));
	while($row = mysql_fetch_assoc($sqlquery)){ 
		$search_for_category = filer_out_limit($row['title']) . ': ';
		$extra_crumb_title = filer_out_limit($row['title']);
		$extra_crumb_url = 'directory-category/1-' . $search_data_d_category . '/' . seo($extra_crumb_title);
		$page_data[4] = filer_out_limit($row['keywords']);
		$page_data[3] = filer_out_limit($row['brief']);
		
		$paging_extra .= '/' . seo($extra_crumb_title);
	}

}

$sr_kw = kwit($sr_kw);

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$sql = "SELECT directory.id, directory.title, directory.img1, directory.brief, directory_categories.title ititle, locations.title ltitle FROM directory INNER JOIN directory_categories ON directory.category_id = directory_categories.id INNER JOIN locations ON directory.geo2_id = locations.id WHERE directory.status=1 AND directory_categories.status=1 AND locations.status=1 AND (directory.title LIKE '%s' OR directory.keywords LIKE '%s')";

if($search_data_d_category > 0){$sql .= ' AND directory.category_id = ' . $search_data_d_category;}

if($global_emirate_id > 0){$sql .= ' AND directory.geo1_id = ' . $global_emirate_id;}

$sql .= ' ORDER BY directory.date_created DESC';

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$sqlquery = mysql_query(sprintf($sql . " LIMIT " . $lbound . ", " . $pp,
			mysql_real_escape_string($sr_kw),
			mysql_real_escape_string($sr_kw)
			));
					
$numResults = mysql_num_rows(mysql_query(sprintf($sql,
			  mysql_real_escape_string($sr_kw),
			  mysql_real_escape_string($sr_kw)
			  )));
				  
$numPages = ceil($numResults / $pp);

// ==================================================================================================================================

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_articles++;
	$field_t_id = $row['id'];
	$field_t_title = filer_out_limit($row['title']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_industry = filer_out_limit($row['ititle']);
	$field_t_location = filer_out_limit($row['ltitle']);
	
	$url = 'directory-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}
	
	$finalString .= '<div class="item-list make-grid">
                <div class="col-sm-2 no-padding photobox">
                  <div class="add-image">
                    <a href="' . $url . '"><img src="files/directory/thumb/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
                  </div>
                </div>
                <div class="col-sm-7 add-desc-box">
                  <div class="add-details">
                    <h5 class="add-title"><a href="' . $url . '">' . $field_t_title . '</a></h5>
                    <div class="info">
                      <span class="category">' . $field_t_industry . '</span><br>  
                      <span class="item-location"><i class="fa fa-map-marker"></i> ' . $field_t_location . '</span>
					   <div class="item_desc">' . substr($field_t_brief,0,100) . '...</div>
                    </div>
                  </div>
                </div>
              </div>';

	/*$finalString .= '<span class="resultlisting' . ($num_articles % 3 == 0 ? ' resultlistingright' : '') . '"><a href="' . $url . '"><img src="files/directory/thumb/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a><span class="name">' . $field_t_title . '</span><span class="category">' . $field_t_industry . '</span><span class="area">' . $field_t_location . '</span>' . substr($field_t_brief,0,255) . '...<br /><a class="buttons viewdetails" href="' . $url . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Details</span><span class="rightborder">&nbsp;</span></a></span>';*/
	

}

if($numResults > $pp){
		
	$lbound++;
	$toArticles = $lbound + $pp - 1;
	if($toArticles > $numResults){ 
		$toArticles = $numResults;
	}
		
	// START PAGING ************************************************************************************************************
		
	$finalPaging .= '<div class="pagination-bar"> <ul class="pagination"><li><a class="lastlink" href="' . $paging_extra_pre . '1' . $paging_extra . '">First</a></li>';
			
	// Many pages paging
	if($numPages > 7){
		$int__curpage = $page;
		$int__maxpages = $numPages;
		$int__l_bound = $int__curpage - 3;
		$int__h_bound = $int__curpage + 3;
		if($int__l_bound < 1){
			$int__h_bound = $int__h_bound + (-1 * $int__l_bound) + 1;
			$int__l_bound = 1;
		}
		if($int__h_bound > $int__maxpages){
			$int__l_bound = $int__l_bound - ($int__h_bound - $int__maxpages);
			$int__h_bound = $int__maxpages;
		}
		
		for($i = $int__l_bound; $i<=$int__h_bound; $i++){
			if($i == $page){
				$finalPaging .= '<li class="active"><a href="' . $paging_extra_pre . $i . $paging_extra . '" class="selected">' . $i . '</a></li> ';
			}else{
				$finalPaging .= '<li><a href="' . $paging_extra_pre . $i . $paging_extra . '">' . $i . '</a></li> ';
			}
		}
		
	}else{
		for($i = 1; $i<=$numPages; $i++){
			if($i == $page){
				$finalPaging .= '<li class="active"><a href="' . $paging_extra_pre . $i . $paging_extra . '" class="selected">' . $i . '</a></li> ';
			}else{
				$finalPaging .= '<li><a href="' . $paging_extra_pre . $i . $paging_extra . '">' . $i . '</a></li> ';
			}
		}
	}
	//
	
	$finalPaging .= '<li><a class="lastlink" href="' . $paging_extra_pre . $numPages . $paging_extra . '" class="pagination-btn">Next »</a></li></ul></div>';
	
	// END PAGING **************************************************************************************************************
		
}

if(strlen($finalString) > 0){
	$finalString = '<div class="item"><div class="widget-title"><h4>'.make_fancy($extra_crumb_title).'</h4></div><div class="middle">' . $finalString . '</div><img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" /></div>';
}

//if($num_articles == 0){
	//$finalString = 'There are currently no results available for your search.';
//}

?>