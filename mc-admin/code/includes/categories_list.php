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

// ----------------------------
$index = 0;
$sqlquery = mysql_query('SELECT id, ordering FROM categories ORDER BY ordering ASC');
$orders = array();
while($row = mysql_fetch_array($sqlquery)){ 
	$orders[] = $row['id'] . '_' . $row['ordering'];
}
// ----------------------------

$sqlquery = mysql_query("SELECT categories.*, (SELECT COUNT(*) FROM vote_options WHERE vote_options.category_id = categories.id) num_recs, (SELECT COUNT(*) FROM nominations WHERE nominations.category_id = categories.id) num_recs2 FROM categories ORDER BY ordering ASC LIMIT " . $lbound . ", " . $pp);

// Get information to determine the paging
$numResults = mysql_num_rows(mysql_query("SELECT id FROM categories"));
$numPages = ceil($numResults / $pp);
//

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_count++;
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	$form_item_date = filter_out($row['date_created']);
	$form_item_status = filter_out($row['status']);
	
	$form_item_status_str = '';
	/*if($form_item_status == 1){
		$form_item_status_str = '<li><a class="a_active" href="categories/deactivate-' . $form_item_id . '" title="Click to de-activate" onclick="if(confirm(\'Are you sure you want to de-activate this listing?\')){window.location.href=this.href;}else{return false;}"></a></li>';
	}else{
		$form_item_status_str = '<li><a class="a_inactive" href="categories/activate-' . $form_item_id . '" title="Click to activate" onclick="if(confirm(\'Are you sure you want to activate this listing?\')){window.location.href=this.href;}else{return false;}"></a></li>';
	}	*/
	
	$del_str = '';
	if(($row['num_recs'] + $row['num_recs2']) > 0){
		$del_str .= '<li><a class="a_deletedis" href="#" title="Cannot delete"></a></li>';
	}else{
		$del_str .= '<li><a class="a_delete" href="categories/delete-' . $form_item_id . '" title="Delete" onclick="if(confirm(\'Are you sure you want to delete this category?\')){window.location.href=this.href;}else{return false;}"></a></li>';
	}
	
	$arrows = '';
	// UP?
	if($index > 0){
		$arrows .= '<li><a href="categories/move-' . $row['id'] . '_' . $row['ordering'] . '-' . $orders[$index-1] . '" class="move1" title="Move up"></a></li>';
	}else{
		$arrows .= '<li><a href="#" class="blank"></a></li>';
	}
		
	if($index+1 < count($orders)){
		$arrows .= '<li><a href="categories/move-' . $row['id'] . '_' . $row['ordering'] . '-' . $orders[$index+1] . '" class="move2" title="Move down"></a></li>';
	}else{
		$arrows .= '<li><a href="#" class="blank"></a></li>';
	}
	
	$form_item_data .= '<tr class="' . ($form_item_count % 2 == 1 ? 'first' : 'second') . '"><td style="width: 75px;">' . date('d M Y', $form_item_date) . '</td><td><a href="categories/edit-' . $form_item_id . '" class="product_name">' . $form_item_title . '</a></td><td style="width: 57px;"><div class="actions"><ul>' . $arrows . $form_item_status_str . '<li><a class="a_edit" href="categories/edit-' . $form_item_id . '" title="Edit"></a></li>' . $del_str  . '</ul></div></td></tr>';
	
	$index++;
	
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
			$form_item_paging .= '<li><a href="categories/page-1" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a></li>';
		}else{
			$form_item_paging .= '<li><a href="categories/page-' . ($page-1) . '" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a></li>';
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
					$form_item_paging .= '<li><a href="categories/page-' . $i . '" class="current_page"><span><span>' . $i . '</span></span></a></li>';
				}else{
					$form_item_paging .= '<li><a href="categories/page-' . $i . '">' . $i . '</a></li>';
				}
			}
			
			if($int__h_bound < $int__maxpages){$form_item_paging .= '<li>...</li>';}
			
		}else{
			for($i = 1; $i<=$numPages; $i++){
				if($i == $page){
					$form_item_paging .= '<li><a href="categories/page-' . $i . '" class="current_page"><span><span>' . $i . '</span></span></a></li>';
				}else{
					$form_item_paging .= '<li><a href="categories/page-' . $i . '">' . $i . '</a></li>';
				}
			}
		}
		//
		
		if($page == $numPages){
			$form_item_paging .= '<li><a href="categories/page-' . $numPages . '" class="button light_blue_btn"><span><span>NEXT</span></span></a></li>';
		}else{
			$form_item_paging .= '<li><a href="categories/page-' . ($page+1) . '" class="button light_blue_btn"><span><span>NEXT</span></span></a></li>';
		}
		
		$form_item_paging .= '</ul>';
	}
	
	$form_item_paging .= '</div>';
	
	// END PAGING **************************************************************************************************************
	
}

?>