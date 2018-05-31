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

$extra_sql = '';
$extra_paging = '';
if($album > 0){
	$extra_sql = ' WHERE gallery.album_id = ' . (int)$album;
	$extra_paging = '-' . $album;
}

$sqlquery = mysql_query("SELECT gallery.*, gallery_albums.title galbum FROM gallery INNER JOIN gallery_albums ON gallery.album_id = gallery_albums.id " . $extra_sql . " ORDER BY date_created DESC LIMIT " . $lbound . ", " . $pp);

// Get information to determine the paging
$numResults = mysql_num_rows(mysql_query("SELECT * FROM gallery " . $extra_sql . " ORDER BY date_created DESC"));
$numPages = ceil($numResults / $pp);
//

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_count++;
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	$form_item_date = filter_out($row['date_created']);
	$form_item_status = filter_out($row['status']);
	$form_item_img = filter_out($row['img_url']);
	$form_item_album = filter_out($row['galbum']);
	
	if($form_item_status == 1){
		$form_item_status_str = '<li><a class="a_active" href="gallery/deactivate-' . $form_item_id . '" title="Click to de-activate" onclick="if(confirm(\'Are you sure you want to de-activate this listing?\')){window.location.href=this.href;}else{return false;}"></a></li>';
	}else{
		$form_item_status_str = '<li><a class="a_inactive" href="gallery/activate-' . $form_item_id . '" title="Click to activate" onclick="if(confirm(\'Are you sure you want to activate this listing?\')){window.location.href=this.href;}else{return false;}"></a></li>';
	}	
	
	$form_item_data .= '<tr class="' . ($form_item_count % 2 == 1 ? 'first' : 'second') . '"><td style="width: 75px;">' . date('d M Y', $form_item_date) . '</td><td style="width: 80px;"><a href="gallery/edit-' . $form_item_id . '"><img src="../files/gallery/thumb/' . $form_item_img . '" alt="" title="" style="margin-top:12px;margin-bottom:3px;" /></a></td><td><a href="gallery/edit-' . $form_item_id . '" class="product_name">' . $form_item_title . '</a><br /><strong>Album:</strong> ' . $form_item_album . '</td><td style="width: 57px;"><div class="actions"><ul>' . $form_item_status_str . '<li><a class="a_edit" href="gallery/edit-' . $form_item_id . '" title="Edit"></a></li><li><a class="a_delete" href="gallery/delete-' . $form_item_id . '" title="Delete" onclick="if(confirm(\'Are you sure you want to delete this listing?\')){window.location.href=this.href;}else{return false;}"></a></li></ul></div></td></tr>';
	
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
			$form_item_paging .= '<li><a href="gallery/page-1' . $extra_paging . '" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a></li>';
		}else{
			$form_item_paging .= '<li><a href="gallery/page-' . ($page-1) . $extra_paging . '" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a></li>';
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
					$form_item_paging .= '<li><a href="gallery/page-' . $i . $extra_paging . '" class="current_page"><span><span>' . $i . '</span></span></a></li>';
				}else{
					$form_item_paging .= '<li><a href="gallery/page-' . $i . $extra_paging . '">' . $i . '</a></li>';
				}
			}
			
			if($int__h_bound < $int__maxpages){$form_item_paging .= '<li>...</li>';}
			
		}else{
			for($i = 1; $i<=$numPages; $i++){
				if($i == $page){
					$form_item_paging .= '<li><a href="gallery/page-' . $i . $extra_paging . '" class="current_page"><span><span>' . $i . '</span></span></a></li>';
				}else{
					$form_item_paging .= '<li><a href="gallery/page-' . $i . $extra_paging . '">' . $i . '</a></li>';
				}
			}
		}
		//
		
		if($page == $numPages){
			$form_item_paging .= '<li><a href="gallery/page-' . $numPages . $extra_paging . '" class="button light_blue_btn"><span><span>NEXT</span></span></a></li>';
		}else{
			$form_item_paging .= '<li><a href="gallery/page-' . ($page+1) . $extra_paging . '" class="button light_blue_btn"><span><span>NEXT</span></span></a></li>';
		}
		
		$form_item_paging .= '</ul>';
	}
	
	$form_item_paging .= '</div>';
	
	// END PAGING **************************************************************************************************************
	
}

?>