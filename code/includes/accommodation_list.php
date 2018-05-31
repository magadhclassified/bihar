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
$search_data_a_type = 0;
$search_data_a_rating = 0;
$search_data_a_kw = '';
$sr_kw = '';

if($search_id > 0){

	$paging_extra = '-' . $search_id;

	$sqlquery = mysql_query(sprintf("SELECT * FROM searches WHERE id = %d", mysql_real_escape_string($search_id)));
	while($row = mysql_fetch_assoc($sqlquery)){ 
		$search_criteria = unserialize($row['search']);
	}
	$search_data_a_kw = $search_criteria['kw'];
	$search_data_a_type = (int)$search_criteria['type'];
	$search_data_a_rating = (int)$search_criteria['rating'];

	$sr_kw = $search_data_a_kw;

}

$sr_kw = kwit($sr_kw);

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$sql = "SELECT accommodation.id, accommodation.title, accommodation.img1, accommodation.price, accommodation.brief, locations.title ltitle FROM accommodation INNER JOIN locations ON accommodation.geo2_id = locations.id WHERE accommodation.status=1 AND locations.status=1 AND (accommodation.title LIKE '%s' OR accommodation.keywords LIKE '%s')";

if($search_data_a_type > 0){$sql .= ' AND accommodation.type_id = ' . $search_data_a_type;}
if($search_data_a_rating > 0){$sql .= ' AND accommodation.rating_id = ' . $search_data_a_rating;}

if($global_emirate_id > 0){$sql .= ' AND accommodation.geo1_id = ' . $global_emirate_id;}

$sql .= ' ORDER BY accommodation.date_created DESC';

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
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_price = filer_out_limit($row['price']);
	
	$url = 'accommodation-details/' . $field_t_id . '/' . seo($field_t_title);
        $url = strtolower($url);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}

	
	   	$finalString .= '<div class="item-list">
                <div class="col-sm-2 no-padding photobox">
                  <div class="add-image">
                    <a href="' . $url . '"><img src="files/accommodation/thumb/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
                   
                  </div>
                </div>
                <div class="col-sm-7 add-desc-box">
                  <div class="add-details">
                    <h5 class="add-title"><a href="' . $url . '">' . $field_t_title . '</a></h5>
                    <div class="info">
                       <span class="category">' . $field_t_price . '</span><br>   
                      <span class="item-location"><i class="fa fa-map-marker"></i> ' . $field_t_location . '</span>
                    </div>
                    <div class="item_desc">' . substr($field_t_brief,0,255) . '</div>
                  </div>
                </div>
                <!--<div class="col-sm-3 text-right  price-box">
                  <a class="btn btn-danger btn-sm"><i class="fa fa-certificate"></i>
                  <span>Top Ads</span></a> 
                  <a class="btn btn-common btn-sm"> <i class="fa fa-eye"></i> <span>215</span> </a> 
                </div>-->
              </div>';

}

if($numResults > $pp){
		
	$lbound++;
	$toArticles = $lbound + $pp - 1;
	if($toArticles > $numResults){ 
		$toArticles = $numResults;
	}
		
	// START PAGING ************************************************************************************************************
		
	$finalPaging .= '<div class="pagination-bar"> <ul class="pagination"><li><a href="accommodation/1' . $paging_extra . '" class="pagination-btn">Previous</a></li>';
			
			
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
				$finalPaging .= '<li class="active"><a href="accommodation/' . $i . $paging_extra . '">' . $i . '</a></li>';
			}else{
				$finalPaging .= '<li><a href="accommodation/' . $i . $paging_extra . '">' . $i . '</a></li> ';
			}
		}
		
	}else{
		for($i = 1; $i<=$numPages; $i++){
			if($i == $page){
				$finalPaging .= '<li class="active"><a href="accommodation/' . $i . $paging_extra . '" class="selected">' . $i . '</a></li> ';
			}else{
				$finalPaging .= '<li><a href="accommodation/' . $i . $paging_extra . '">' . $i . '</a></li> ';
			}
		}
	}
	//
	
	$finalPaging .= '<li><a href="accommodation/'. $numPages . $paging_extra .'" class="pagination-btn">Next »</a></li></ul></div>';
	// END PAGING **************************************************************************************************************
		
}
if($num_articles == 0){
	$finalString = '<div class="item-list">There are currently no results available for your search.</div>';
}

?>