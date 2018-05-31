<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$pp = SYSTEM_PAGING;

$form_item_data = '';
$form_item_paging = '';
$form_item_count = 0;

if($page == 0 || $page == 1){
	$page = 1;
	$lbound = 0;
}else{
	$lbound = ($pp * $page) - $pp;
}

// -------------------------------------------------------------------------------------------------
// Search
// -------------------------------------------------------------------------------------------------

$paging_append = '';
$result_title_append = '';
$no_result_append = '';
$search_criteria = array('kw'=>'', 'order'=>'date_created', 'sort'=>'DESC', 'show'=>0); // Setup defaults
if($search_id > 0){
	$paging_append = '-' . $search_id;
	$result_title_append = ' (Search Result)';
	$no_result_append = ' for your search';
	
	$sqlquery = mysql_query(sprintf("SELECT * FROM admin_searches WHERE id = %d", mysql_real_escape_string($search_id)));
	while($row = mysql_fetch_assoc($sqlquery)){ 
		$search_criteria = unserialize($row['search']);
	}
}

// Populate variables used to set the search criteria boxes
$search_data_kw = $search_criteria['kw'];
$search_data_order = $search_criteria['order'];
$search_data_sort = $search_criteria['sort'];
$search_data_show = $search_criteria['show'];

// -------------------------------------------------------------------------------------------------

$extra_sql = '';
switch($search_data_show){
	case 1: $extra_sql .= ' AND motors.status = 1'; break;
	case 2: $extra_sql .= ' AND motors.status = 0'; break;
	case 3: $extra_sql .= ' AND motors.is_featured = 1'; break;
	case 4: $extra_sql .= ' AND motors.is_featured = 0'; break;
	case 5: $extra_sql .= ' AND motors.is_fp = 1'; break;
	case 6: $extra_sql .= ' AND motors.is_fp = 0'; break;
}

// -------------------------------------------------------------------------------------------------

$sqlquery = mysql_query(sprintf("SELECT * FROM motors WHERE (title LIKE '%s') " . $extra_sql . " ORDER BY " . $search_data_order . " " . $search_data_sort . " LIMIT " . $lbound . ", " . $pp, 
			mysql_real_escape_string(kwit($search_data_kw))
			));

// Get information to determine the paging
$numResults = mysql_num_rows(mysql_query(sprintf("SELECT id FROM motors WHERE (title LIKE '%s')" . $extra_sql, 
			  mysql_real_escape_string(kwit($search_data_kw))
			  )));
$numPages = ceil($numResults / $pp);
//

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_count++;
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	$form_item_date = filter_out($row['date_created']);
	$form_item_status = filter_out($row['status']);
	$form_item_featured = filter_out($row['is_featured']);
	$form_item_fp = filter_out($row['is_fp']);
	
	if($form_item_featured == 1){$form_item_featured = '<span class="xx_feat">&nbsp;Featured&nbsp;</span>&nbsp;';}else{$form_item_featured = '';}
	if($form_item_fp == 1){$form_item_fp = '<span class="xx_fp">&nbsp;FP&nbsp;</span>&nbsp;';}else{$form_item_fp = '';}
	
	if($form_item_status == 1){
		$form_item_status_str = '<li><a class="a_active" href="motors/deactivate-' . $form_item_id . '" title="Click to de-activate" onclick="if(confirm(\'Are you sure you want to de-activate this listing?\')){window.location.href=this.href;}else{return false;}"></a></li>';
	}else{
		$form_item_status_str = '<li><a class="a_inactive" href="motors/activate-' . $form_item_id . '" title="Click to activate" onclick="if(confirm(\'Are you sure you want to activate this listing?\')){window.location.href=this.href;}else{return false;}"></a></li>';
	}	
	
	$form_item_data .= '<tr class="' . ($form_item_count % 2 == 1 ? 'first' : 'second') . '"><td style="width: 75px;">' . date('d M Y', $form_item_date) . '</td><td>' . $form_item_featured . $form_item_fp . ' <a href="motors/edit-' . $form_item_id . '" class="product_name">' . $form_item_title . '</a></td><td style="width: 57px;"><div class="actions"><ul>' . $form_item_status_str . '<li><a class="a_edit" href="motors/edit-' . $form_item_id . '" title="Edit"></a></li><li><a class="a_delete" href="motors/delete-' . $form_item_id . '" title="Delete" onclick="if(confirm(\'Are you sure you want to delete this listing?\')){window.location.href=this.href;}else{return false;}"></a></li></ul></div></td></tr>';
	
}

if(strlen($form_item_data) > 0){
	
	$lbound++;
	$toArticles = $lbound + $pp - 1;
	if($toArticles > $numResults){ 
		$toArticles = $numResults;
	}
	
	// START PAGING ************************************************************************************************************

	$form_item_paging .= '<div class="pagination"><span class="page_no">Page ' . $page . ' of ' . $numPages . '</span>';
	
	if($numResults > SYSTEM_PAGING){
	
		$form_item_paging .= '<ul class="pag_list">';
		
		if($page == 1){
			$form_item_paging .= '<li><a href="motors/page-1' . $paging_append . '" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a></li>';
		}else{
			$form_item_paging .= '<li><a href="motors/page-' . ($page-1) . $paging_append . '" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a></li>';
		}
		
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
			
			if($int__l_bound > 1){$form_item_paging .= '<li>...</li>';}
			
			for($i = $int__l_bound; $i<=$int__h_bound; $i++){
				if($i == $page){
					$form_item_paging .= '<li><a href="motors/page-' . $i . $paging_append . '" class="current_page"><span><span>' . $i . '</span></span></a></li>';
				}else{
					$form_item_paging .= '<li><a href="motors/page-' . $i . $paging_append . '">' . $i . '</a></li>';
				}
			}
			
			if($int__h_bound < $int__maxpages){$form_item_paging .= '<li>...</li>';}
			
		}else{
			for($i = 1; $i<=$numPages; $i++){
				if($i == $page){
					$form_item_paging .= '<li><a href="motors/page-' . $i . $paging_append . '" class="current_page"><span><span>' . $i . '</span></span></a></li>';
				}else{
					$form_item_paging .= '<li><a href="motors/page-' . $i . $paging_append . '">' . $i . '</a></li>';
				}
			}
		}
		//
		
		if($page == $numPages){
			$form_item_paging .= '<li><a href="motors/page-' . $numPages . $paging_append . '" class="button light_blue_btn"><span><span>NEXT</span></span></a></li>';
		}else{
			$form_item_paging .= '<li><a href="motors/page-' . ($page+1) . $paging_append . '" class="button light_blue_btn"><span><span>NEXT</span></span></a></li>';
		}
		
		$form_item_paging .= '</ul>';
	}
	
	$form_item_paging .= '</div>';
	
	// END PAGING **************************************************************************************************************
	
}

?>