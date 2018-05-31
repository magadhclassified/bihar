<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$item_name = '';
$item_email = '';
$item_type = 'SUPERADMIN';
$item_active = 1;
$item_perms = '';
$item_perms_array = array();

if($listing_id > 0){
	$sqlquery = mysql_query(sprintf("SELECT * FROM users WHERE id = %d",
				mysql_real_escape_string($listing_id)
				));

	while($row = mysql_fetch_array($sqlquery)){ 
		$item_name = filter_out($row['full_name']);
		$item_email = filter_out($row['email']);
		$item_type = filter_out($row['acc_type']);
		$item_active = filter_out($row['active']);
		$item_perms = filter_out($row['acc_permissions']);
		$item_perms_array = explode(',', $item_perms);
	}
}

// Permissions
$permissions_list = '';

$sqlquery = mysql_query('SELECT * FROM settings_components WHERE available=1 ORDER BY title ASC');

while($row = mysql_fetch_array($sqlquery)){ 
	$perms_title = filter_out($row['title']);
	$perms_perm = filter_out($row['section_permission']);
	$perms_parent = filter_out($row['parent_permission']);
	
	if(strlen($perms_parent) > 0){
		$perms_parent = ',' . $perms_parent . '';
	}else{
		$perms_parent = '';
	}
	
	if(in_array($perms_perm, $item_perms_array)){
		$perms_checked = ' checked="checked"';
	}else{
		$perms_checked = '';
	}
	
	$permissions_list .= '<li><input class="checkbox" name="perms[]" value="' . $perms_perm . '' . $perms_parent . '" type="checkbox"' . $perms_checked . ' />&nbsp;&nbsp;' . $perms_title . '</li>';
}

?>