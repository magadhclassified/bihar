<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$form_item_data = '';
$form_item_paging = '';
$form_item_count = 0;

$sqlquery = mysql_query('SELECT dc.*, (SELECT COUNT(id) FROM properties_types WHERE properties_types.parent_id = dc.id) num_recs FROM properties_types dc WHERE parent_id=0 ORDER BY title ASC');

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_count++;
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	$form_item_date = filter_out($row['date_created']);
	$form_item_status = filter_out($row['status']);
	
	$del_str = '';
	if(($row['num_recs']) > 0){
		$del_str .= '<li><a class="a_deletedis" href="#" title="Cannot delete"></a></li>';
	}else{
		$del_str .= '<li><a class="a_delete" href="properties-types/delete-' . $form_item_id . '" title="Delete" onclick="if(confirm(\'Are you sure you want to delete this listing?\')){window.location.href=this.href;}else{return false;}"></a></li>';
	}
	
	$form_item_data .= '<tr class="' . ($form_item_count % 2 == 1 ? 'first' : 'second') . '"><td style="width: 75px;">' . date('d M Y', $form_item_date) . '</td><td><a href="properties-types/edit-' . $form_item_id . '" class="product_name">' . $form_item_title . '</a></td><td style="width: 57px;"><div class="actions"><ul><li><a href="properties-types/add-' . $form_item_id . '" class="a_add_plus" title="Add Content Section"></a></li><li><a class="a_edit" href="properties-types/edit-' . $form_item_id . '" title="Edit"></a></li>' . $del_str . '</ul></div></td></tr>';
	
	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	// Sub Sections
	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	$sqlquery2 = mysql_query('SELECT properties_types.*, (SELECT COUNT(id) FROM properties WHERE properties.type_id = properties_types.id) num_recs FROM properties_types WHERE parent_id=' . (int)$form_item_id . ' ORDER BY title ASC');
	
	while($row2 = mysql_fetch_array($sqlquery2)){ 
		$form_item_count++;
		$form_item_id2 = filter_out($row2['id']);
		$form_item_title2 = filter_out($row2['title']);
		$form_item_date2 = filter_out($row2['date_created']);
		$form_item_status2 = filter_out($row2['status']);
		
		$del_str = '';
		if(($row2['num_recs']) > 0){
			$del_str .= '<li><a class="a_deletedis" href="#" title="Cannot delete"></a></li>';
		}else{
			$del_str .= '<li><a class="a_delete" href="properties-types/delete-' . $form_item_id2 . '" title="Delete" onclick="if(confirm(\'Are you sure you want to delete this listing?\')){window.location.href=this.href;}else{return false;}"></a></li>';
		}
		
		$form_item_data .= '<tr class="' . ($form_item_count % 2 == 1 ? 'first' : 'second') . '"><td style="width: 75px;">' . date('d M Y', $form_item_date2) . '</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&mdash;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="properties-types/edit-' . $form_item_id2 . '" class="product_name" style="font-weight:normal;">' . $form_item_title2 . '</a></td><td style="width: 57px;"><div class="actions"><ul><li><a href="#" class="blank"></a></li><li><a class="a_edit" href="properties-types/edit-' . $form_item_id2 . '" title="Edit"></a></li>' . $del_str . '</ul></div></td></tr>';
		
	}
	
	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
}

?>