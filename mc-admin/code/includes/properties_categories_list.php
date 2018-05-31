<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$form_item_data = '';
$form_item_paging = '';
$form_item_count = 0;

$sqlquery = mysql_query('SELECT id,title,date_created,status FROM properties_categories ORDER BY title ASC');

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_count++;
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	$form_item_date = filter_out($row['date_created']);
	$form_item_status = filter_out($row['status']);
	
	$del_str = '';
	
		$del_str .= '<li><a class="a_delete" href="properties-categories/delete-' . $form_item_id . '" title="Delete" onclick="if(confirm(\'Are you sure you want to delete this listing?\')){window.location.href=this.href;}else{return false;}"></a></li>';
	
	
	$form_item_data .= '<tr class="' . ($form_item_count % 2 == 1 ? 'first' : 'second') . '"><td style="width: 75px;">' . date('d M Y', $form_item_date) . '</td><td><a href="properties-categories/edit-' . $form_item_id . '" class="product_name">' . $form_item_title . '</a></td><td style="width: 57px;"><div class="actions"><ul><li><a class="a_edit" href="properties-categories/edit-' . $form_item_id . '" title="Edit"></a></li>' . $del_str . '</ul></div></td></tr>';
	
}

?>