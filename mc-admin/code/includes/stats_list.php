<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$form_item_data = '';
$form_item_paging = '';
$form_item_count = 0;

$sqlquery = mysql_query('SELECT id, title, (SELECT SUM(votes) FROM vote_options WHERE vote_options.category_id = categories.id) numtot FROM categories ORDER BY ordering ASC');

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_count++;
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	$form_item_total = filter_out($row['numtot']);
	
	$form_item_data .= '<tr class="' . ($form_item_count % 2 == 1 ? 'first' : 'second') . '"><td style="font-weight:bold;font-size:12px;">' . $form_item_title . '</td><td style="width: 77px;"></td><td></td></tr>';
	
	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	// Sub Sections
	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	$sqlquery2 = mysql_query('SELECT id, title, votes FROM vote_options WHERE category_id=' . (int)$form_item_id . ' ORDER BY ordering ASC');
	
	while($row2 = mysql_fetch_array($sqlquery2)){ 
		$form_item_count++;
		$form_item_id2 = filter_out($row2['id']);
		$form_item_title2 = filter_out($row2['title']);
		$form_item_votes2 = filter_out($row2['votes']);
		
		if($form_item_total == 0){
			$form_item_total = 1; // Prevent division by 0
		}
		
		$votes_perc = $form_item_votes2 / $form_item_total * 100;
		$votes_perc_div = floor($votes_perc * 2);
		
		$form_item_data .= '<tr class="' . ($form_item_count % 2 == 1 ? 'first' : 'second') . '"><td style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&mdash;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $form_item_title2 . '</td><td style="width: 200px;">
		
		<table cellpadding="0" cellspacing="0" border="0" style="width:200px;"><tr><td style="width:200px;height:12px;background-color:#e0e0e0;background-image:none;text-align:left;padding:0px;margin:0px;"><div style="width:' . $votes_perc_div . 'px;height:12px;background-color:#197b32;background-image:none;"></div></td></tr></table>
		
		</td><td style="width: 77px;">' . number_f($votes_perc, 1) . '% (' . $form_item_votes2 . ')</td></tr>';
		
	}
	
	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
}

?>