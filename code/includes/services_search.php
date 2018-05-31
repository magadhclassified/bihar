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
		$extra_crumb_url = 'services-category/1-' . $search_data_d_category . '/' . seo($extra_crumb_title);
		$page_data[4] = filer_out_limit($row['keywords']);
		$page_data[3] = filer_out_limit($row['brief']);
		
		$paging_extra .= '/' . seo($extra_crumb_title);
	}

}

$sr_kw = kwit($sr_kw);

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$sql = "SELECT services.id, services.title, services.img1, services.brief, directory_categories.title ititle, locations.title ltitle FROM services INNER JOIN directory_categories ON services.category_id = directory_categories.id INNER JOIN locations ON services.geo2_id = locations.id WHERE services.status=1 AND directory_categories.status=1 AND locations.status=1 AND (services.title LIKE '%s' OR services.keywords LIKE '%s')";

if($search_data_d_category > 0){$sql .= ' AND services.category_id = ' . $search_data_d_category;}

if($global_emirate_id > 0){$sql .= ' AND services.geo1_id = ' . $global_emirate_id;}

$sql .= ' ORDER BY services.date_created DESC';

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
	
	$url = 'services-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

	$finalString .= '<span class="resultlisting' . ($num_articles % 3 == 0 ? ' resultlistingright' : '') . '">
	<a href="' . $url . '"><img src="files/services/thumb/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
	<span class="name">' . $field_t_title . '</span><span class="category">' . $field_t_industry . '</span>
	<span class="area">' . $field_t_location . '</span>
	<a class="buttons viewdetails" href="' . $url . '"><span class="leftborder">&nbsp;</span>
	<span class="buttondetail">View Details</span><span class="rightborder">&nbsp;</span></a></span>';
	
	if($num_articles % 3 == 0){$finalString .= '<div class="clear">&nbsp;</div>';}

}

if($numResults > $pp){
		
	$lbound++;
	$toArticles = $lbound + $pp - 1;
	if($toArticles > $numResults){ 
		$toArticles = $numResults;
	}
		
	// START PAGING ************************************************************************************************************
		
	$finalPaging .= '<div class="resultpaging"> <span class="total">Page <strong>' . $page . '</strong> of <strong>' . $numPages . '</strong></span> <span class="splitter">|</span> <a class="lastlink" href="' . $paging_extra_pre . '1' . $paging_extra . '">First</a> <span class="splitter">|</span>';
			
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
				$finalPaging .= '<a href="' . $paging_extra_pre . $i . $paging_extra . '" class="selected">' . $i . '</a> ';
			}else{
				$finalPaging .= '<a href="' . $paging_extra_pre . $i . $paging_extra . '">' . $i . '</a> ';
			}
		}
		
	}else{
		for($i = 1; $i<=$numPages; $i++){
			if($i == $page){
				$finalPaging .= '<a href="' . $paging_extra_pre . $i . $paging_extra . '" class="selected">' . $i . '</a> ';
			}else{
				$finalPaging .= '<a href="' . $paging_extra_pre . $i . $paging_extra . '">' . $i . '</a> ';
			}
		}
	}
	//
	
	$finalPaging .= '<span class="splitter">|</span> <a class="lastlink" href="' . $paging_extra_pre . $numPages . $paging_extra . '">Last</a></div>';
	
	// END PAGING **************************************************************************************************************
		
}
if($num_articles == 0){
	$finalString = 'There are currently no results available for your search.';
}







?>