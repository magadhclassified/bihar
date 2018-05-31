<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$form_item_data = '';
$form_item_paging = '';
$form_item_count = 0;

// ----------------------------

$sqlquery = mysql_query("SELECT pg.*, (SELECT COUNT(*) FROM properties WHERE properties.geo1_id = pg.id OR properties.geo2_id = pg.id OR properties.geo3_id = pg.id) num_recs, (SELECT COUNT(*) FROM locations WHERE locations.parent_id = pg.id) num_recs2 FROM locations pg WHERE pg.parent_id = 0 ORDER BY pg.title ASC");

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_count++;
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	$form_item_date = filter_out($row['date_created']);
	
	$del_str = '';
	if(($row['num_recs'] + $row['num_recs2']) > 0){
		$del_str .= '<li><a class="a_deletedis" href="#" title="Cannot delete"></a></li>';
	}else{
		$del_str .= '<li><a class="a_delete" href="locations/delete-' . $form_item_id . '" title="Delete" onclick="if(confirm(\'Are you sure you want to delete this listing?\')){window.location.href=this.href;}else{return false;}"></a></li>';
	}
	
	$form_item_data .= '<tr class="' . ($form_item_count % 2 == 1 ? 'first' : 'second') . '"><td style="width: 75px;">' . date('d M Y', $form_item_date) . '</td><td><a href="locations/edit-' . $form_item_id . '" class="product_name">' . $form_item_title . '</a></td><td style="width: 57px;"><div class="actions"><ul><li><a class="a_add" href="locations/add-' . $form_item_id . '" title="Add child location"></a></li><li><a class="a_edit" href="locations/edit-' . $form_item_id . '" title="Edit"></a></li>' . $del_str . '</ul></div></td></tr>';
	
	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	// LEVEL 2 LOCATIONS
	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	$form_item_count2 = 0;
	
	$sqlquery2 = mysql_query("SELECT pg.*, (SELECT COUNT(*) FROM properties WHERE properties.geo1_id = pg.id OR properties.geo2_id = pg.id OR properties.geo3_id = pg.id) num_recs, (SELECT COUNT(*) FROM locations WHERE locations.parent_id = pg.id) num_recs2 FROM locations pg WHERE pg.parent_id = " . $form_item_id . " ORDER BY pg.title ASC");

	while($row2 = mysql_fetch_array($sqlquery2)){ 
		$form_item_count2++;
		$form_item_id2 = filter_out($row2['id']);
		$form_item_title2 = filter_out($row2['title']);
		$form_item_date2 = filter_out($row2['date_created']);
		
		$del_str2 = '';
		if(($row2['num_recs'] + $row2['num_recs2']) > 0){
			$del_str2 .= '<li><a class="a_deletedis" href="#" title="Cannot delete"></a></li>';
		}else{
			$del_str2 .= '<li><a class="a_delete" href="locations/delete-' . $form_item_id2 . '" title="Delete" onclick="if(confirm(\'Are you sure you want to delete this listing?\')){window.location.href=this.href;}else{return false;}"></a></li>';
		}
		
		$form_item_data .= '<tr class="' . ($form_item_count2 % 2 == 1 ? 'first' : 'second') . '"><td style="width: 75px;">' . date('d M Y', $form_item_date2) . '</td><td>&nbsp;&nbsp;&nbsp;&ndash;&nbsp;&nbsp;&nbsp;<a href="locations/edit-' . $form_item_id2 . '" class="product_name">' . $form_item_title2 . '</a></td><td style="width: 57px;"><div class="actions"><ul><li><a class="a_add" href="locations/add-' . $form_item_id2 . '" title="Add child location"></a></li><li><a class="a_edit" href="locations/edit-' . $form_item_id2 . '" title="Edit"></a></li>' . $del_str2 . '</ul></div></td></tr>';
		
		// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		// LEVEL 3 LOCATIONS
		// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		
		$form_item_count3 = 0;
	
		$sqlquery3 = mysql_query("SELECT pg.*, (SELECT COUNT(*) FROM properties WHERE properties.geo1_id = pg.id OR properties.geo2_id = pg.id OR properties.geo3_id = pg.id) num_recs, (SELECT COUNT(*) FROM locations WHERE locations.parent_id = pg.id) num_recs2 FROM locations pg WHERE pg.parent_id = " . $form_item_id2 . " ORDER BY pg.title ASC");

		while($row3 = mysql_fetch_array($sqlquery3)){ 
			$form_item_count3++;
			$form_item_id3 = filter_out($row3['id']);
			$form_item_title3 = filter_out($row3['title']);
			$form_item_date3 = filter_out($row3['date_created']);
			
			$del_str3 = '';
			if(($row3['num_recs'] + $row3['num_recs2']) > 0){
				$del_str3 .= '<li><a class="a_deletedis" href="#" title="Cannot delete"></a></li>';
			}else{
				$del_str3 .= '<li><a class="a_delete" href="locations/delete-' . $form_item_id3 . '" title="Delete" onclick="if(confirm(\'Are you sure you want to delete this listing?\')){window.location.href=this.href;}else{return false;}"></a></li>';
			}
			
			$form_item_data .= '<tr class="' . ($form_item_count3 % 2 == 1 ? 'first' : 'second') . '"><td style="width: 75px;">' . date('d M Y', $form_item_date3) . '</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&ndash;&nbsp;&nbsp;&nbsp;<a href="locations/edit-' . $form_item_id3 . '" class="product_name">' . $form_item_title3 . '</a></td><td style="width: 57px;"><div class="actions"><ul><li><a class="a_blank" href="#"></a></li><li><a class="a_edit" href="locations/edit-' . $form_item_id3 . '" title="Edit"></a></li>' . $del_str3 . '</ul></div></td></tr>';
		
		}
		
		// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	}
	
	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
}

?>