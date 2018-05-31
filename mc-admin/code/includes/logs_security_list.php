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

$sqlquery = mysql_query("SELECT * FROM logs_security ORDER BY date_created DESC LIMIT " . $lbound . ", " . $pp);

// Get information to determine the paging
$numResults = mysql_num_rows(mysql_query("SELECT * FROM logs_security ORDER BY date_created DESC"));
$numPages = ceil($numResults / $pp);
//

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_count++;
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	$form_item_ip = filter_out($row['ip']);
	$form_item_date = filter_out($row['date_created']);
	$form_item_log = filter_out($row['status']);
	
	$er_row = '';
	if($form_item_log == 'FAILED_LOGIN' || $form_item_log == 'FORGOT_PASSWORD_TOKEN_ERROR'){
		$er_row = ' style="color:#FF0000;"';
	}
	
	$form_item_data .= '<tr class="' . ($form_item_count % 2 == 1 ? 'first' : 'second') . '"' . $er_row . '><td style="width: 120px;">' . date('d M Y - H:i', $form_item_date) . '</td><td>' . $form_item_title . '</td><td style="width: 57px;">' . $form_item_ip . '</td></tr>';
	
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
			$form_item_paging .= '<li><a href="logs-security/page-1" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a></li>';
		}else{
			$form_item_paging .= '<li><a href="logs-security/page-' . ($page-1) . '" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a></li>';
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
					$form_item_paging .= '<li><a href="logs-security/page-' . $i . '" class="current_page"><span><span>' . $i . '</span></span></a></li>';
				}else{
					$form_item_paging .= '<li><a href="logs-security/page-' . $i . '">' . $i . '</a></li>';
				}
			}
			
			if($int__h_bound < $int__maxpages){$form_item_paging .= '<li>...</li>';}
			
		}else{
			for($i = 1; $i<=$numPages; $i++){
				if($i == $page){
					$form_item_paging .= '<li><a href="logs-security/page-' . $i . '" class="current_page"><span><span>' . $i . '</span></span></a></li>';
				}else{
					$form_item_paging .= '<li><a href="logs-security/page-' . $i . '">' . $i . '</a></li>';
				}
			}
		}
		//
		
		if($page == $numPages){
			$form_item_paging .= '<li><a href="logs-security/page-' . $numPages . '" class="button light_blue_btn"><span><span>NEXT</span></span></a></li>';
		}else{
			$form_item_paging .= '<li><a href="logs-security/page-' . ($page+1) . '" class="button light_blue_btn"><span><span>NEXT</span></span></a></li>';
		}
		
		$form_item_paging .= '</ul>';
	}
	
	$form_item_paging .= '</div>';
	
	// END PAGING **************************************************************************************************************
	
}

?>