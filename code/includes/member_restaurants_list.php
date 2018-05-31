<?php

$pp = MEMBER_PAGING;
$finalString = '';
$finalPaging = '';
$num_listings = 0;

if($page == 0 || $page == 1){
	$page = 1;
	$lbound = 0;
}else{
	$lbound = ($pp * $page) - $pp;
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$paging_extra = '';
$search_data_m_status = -1;
$search_data_m_kw = '';
$sr_kw = '';

if($search_id > 0){

	$paging_extra = '-' . $search_id;

	$sqlquery = mysql_query(sprintf("SELECT * FROM searches WHERE id = %d", mysql_real_escape_string($search_id)));
	while($row = mysql_fetch_assoc($sqlquery)){ 
		$search_criteria = unserialize($row['search']);
	}
	$search_data_m_kw = $search_criteria['kw'];
	$search_data_m_status = (int)$search_criteria['status'];

	$sr_kw = $search_data_m_kw;

}

$sr_kw = kwit($sr_kw);

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$sql = "SELECT restaurants.id, restaurants.status, restaurants.title, restaurants.date_created, restaurants.date_edited, restaurants.price, restaurants.img1, restaurants.brief, restaurants_menus.title ititle, locations.title ltitle FROM restaurants INNER JOIN restaurants_menus ON restaurants.menu_id = restaurants_menus.id INNER JOIN locations ON restaurants.geo2_id = locations.id WHERE restaurants.member_id=%d AND (restaurants.title LIKE '%s' OR restaurants.keywords LIKE '%s')";

if($search_data_m_status > -1){$sql .= ' AND restaurants.status = ' . $search_data_m_status;}

$sql .= ' ORDER BY restaurants.date_created DESC';

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$sqlquery = mysql_query(sprintf($sql . " LIMIT " . $lbound . ", " . $pp,
			mysql_real_escape_string($_SESSION['Member_ID']),
			mysql_real_escape_string($sr_kw),
			mysql_real_escape_string($sr_kw)
			));
					
$numResults = mysql_num_rows(mysql_query(sprintf($sql,
			  mysql_real_escape_string($_SESSION['Member_ID']),
			  mysql_real_escape_string($sr_kw),
			  mysql_real_escape_string($sr_kw)
			  )));
				  
$numPages = ceil($numResults / $pp);

// ==================================================================================================================================

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_listings++;
	$field_t_id = $row['id'];
	$field_t_title = filer_out_limit($row['title']);
	$field_t_price = filer_out_limit($row['price']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_category = filer_out_limit($row['ititle']);
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_dateadded = filer_out_limit($row['date_created']);
	$field_t_dateedited = filer_out_limit($row['date_edited']);
	$field_t_status = filer_out_limit($row['status']);
	
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}
	
		$finalString .= '<tr>
                      <td class="add-img-selector">
                        <div class="checkbox">
                          <label>
                            <span class="checkbox-material">' . $num_listings . '.</span>
                          </label>
                        </div>
                      </td>
                      <td class="add-img-td">
                        <a href="">
                          <img alt="' . safe_alt($field_t_title) . '" src="files/restaurants/small/' . $field_t_img1 . '" title="' . safe_alt($field_t_title) . '" class="img-responsive">
                        </a>
                      </td>
                      <td class="ads-details-td">
                        <h4><a href="ads-details.html">' . $field_t_title . '</a></h4>
                        <p> <strong> Posted On </strong>:' . date('d M \'y', $field_t_dateadded) . ' </p>
                        <p> ' . $field_t_category . ' </p>
						<p> <strong>Visitors </strong>: 221 <strong>Located In:</strong> New York </p>
                      </td>
                      <td class="price-td">
                        <strong>'.$field_t_price.'</strong>
                      </td>
					  
					  <td class="price-td">
                        <strong> '.date('d M \'y', $field_t_dateedited).'</strong>
                      </td>
                      <td class="action-td">
                        <p><a class="btn btn-primary btn-xs" href="my-restaurants-manage/' . $field_t_id . '" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 950 } )"> <i class="fa fa-pencil-square-o"></i> Edit</a></p>
                        <p><a class="btn btn-info btn-xs"> <i class="fa fa-share-square-o"></i> Share</a></p>
                        <p><a class="btn btn-danger btn-xs" href="my-restaurants-delete/' . $field_t_id . '" onclick="if(confirm(\'Are you sure you want to delete this listing?\')){window.location.href=this.href;}else{return false;}"> <i class=" fa fa-trash"></i> Delete</a></p>
                      </td>
                    </tr>';
	
	
	/*$finalString .= '<div class="addrows' . ($field_t_status == 0 ? ' addrowspending' : '') . '"><span class="addentries addentry1">' . $num_listings . '.</span><span class="addentries addentry2"><img src="files/restaurants/small/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></span><span class="addentries addentry3">' . $field_t_title . '<span class="addprice">' . $field_t_price . '</span><span class="addrent">' . $field_t_category . '</span></span><span class="addentries addentry4">' . date('d M \'y', $field_t_dateadded) . '</span><span class="addentries addentry5">' . date('d M \'y', $field_t_dateedited) . '</span><span class="addentries addentry6"><a href="my-restaurants-manage/' . $field_t_id . '" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 950 } )"><img src="graphics/icons/memberadd-edit.png" alt="Edit" title="Edit" height="16" width="15" /></a>&nbsp;&nbsp;<a href="my-restaurants-delete/' . $field_t_id . '" onclick="if(confirm(\'Are you sure you want to delete this listing?\')){window.location.href=this.href;}else{return false;}"><img src="graphics/icons/memberadd-delete.png" alt="Delete" title="Delete" height="16" width="14" /></a></span></div>';*/

}

if($numResults > $pp){
		
	$lbound++;
	$toArticles = $lbound + $pp - 1;
	if($toArticles > $numResults){ 
		$toArticles = $numResults;
	}
		
	// START PAGING ************************************************************************************************************
		
	$finalPaging .= '<div class="memberpaging"> <span class="total">Page <strong>' . $page . '</strong> of <strong>' . $numPages . '</strong> (' . $numResults . ' listing' . ($numResults == 1 ? '' : 's') . ')</span> <span class="splitter">|</span> <a class="lastlink" href="my-restaurants/1' . $paging_extra . '">First</a> <span class="splitter">|</span>';
			
	// Many pages paging
	if($numPages > 5){
		$int__curpage = $page;
		$int__maxpages = $numPages;
		$int__l_bound = $int__curpage - 2;
		$int__h_bound = $int__curpage + 2;
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
				$finalPaging .= '<a href="my-restaurants/' . $i . $paging_extra . '" class="selected">' . $i . '</a> ';
			}else{
				$finalPaging .= '<a href="my-restaurants/' . $i . $paging_extra . '">' . $i . '</a> ';
			}
		}
		
	}else{
		for($i = 1; $i<=$numPages; $i++){
			if($i == $page){
				$finalPaging .= '<a href="my-restaurants/' . $i . $paging_extra . '" class="selected">' . $i . '</a> ';
			}else{
				$finalPaging .= '<a href="my-restaurants/' . $i . $paging_extra . '">' . $i . '</a> ';
			}
		}
	}
	//
	
	$finalPaging .= '<span class="splitter">|</span> <a class="lastlink" href="my-restaurants/' . $numPages . $paging_extra . '">Last</a></div>';
	
	// END PAGING **************************************************************************************************************
		
}
if($num_listings == 0){
	$finalString = '<tr><td class="add-img-selector">There are currently no results available for your search.</td></tr>';
}else{
	$finalString = '<thead><tr><th data-type="numeric"></th><th>Image</th><th>Ads Information</th><th>Price</th><th>Updated</th><th>Actions</th></tr>
                  </thead><tbody>' . $finalString . '</tbody>';
}

?>