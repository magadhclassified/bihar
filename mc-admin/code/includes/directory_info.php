<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$item_title = '';
$item_cat = 0;
$item_geo1 = 0;
$item_geo2 = 0;
$item_geo3 = 0;
$item_physical = '';
$item_postal = '';
$item_tel = '';
$item_fax = '';
$item_web = '';
$item_member = 0;
$item_contact_email = '';
$item_brief = '';
$item_keywords = '';
$item_image_file1 = '';
$item_maps_lat = '';
$item_maps_lng = '';
$item_contents_intro = '';
$item_contents = '';
$item_featured = 0;
$item_fp = 0;
$item_album = 0;
$item_active = 1;

if($listing_id > 0){
	$sqlquery = mysql_query(sprintf("SELECT * FROM directory WHERE id = %d",
				mysql_real_escape_string($listing_id)
				));

	while($row = mysql_fetch_array($sqlquery)){ 
		$item_title = filter_out($row['title']);
		$item_cat = filter_out($row['category_id']);
		$item_geo1 = filter_out($row['geo1_id']);
		$item_geo2 = filter_out($row['geo2_id']);
		$item_geo3 = filter_out($row['geo3_id']);
		$item_physical = filter_out($row['company_physical']);
		$item_postal = filter_out($row['company_postal']);
		$item_tel = filter_out($row['company_tel']);
		$item_fax = filter_out($row['company_fax']);
		$item_web = filter_out($row['company_web']);
		$item_member = filter_out($row['member_id']);
		$item_contact_email = filter_out($row['contact_email']);
		$item_brief = filter_out($row['brief']);
		$item_keywords = filter_out($row['keywords']);
		$item_image_file1 = filter_out($row['img1']);
		$item_maps_lat = filter_out($row['gps_lat']);
		$item_maps_lng = filter_out($row['gps_lon']);
		$item_contents_intro = filter_out($row['contents_intro']);
		$item_contents = filter_out($row['contents']);
		$item_featured = filter_out($row['is_featured']);
		$item_fp = filter_out($row['is_fp']);
		$item_album = filter_out($row['gallery_id']);
		$item_active = filter_out($row['status']);
	}
}

// -------------------------------------------------------------------------------------------------------------------------
// Categories
// -------------------------------------------------------------------------------------------------------------------------

$categories_listbox = '';

$sqlquery = mysql_query("SELECT id, title FROM directory_categories WHERE parent_id = 0 ORDER BY ordering ASC");

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	
	$categories_listbox .= '<optgroup label="' . $form_item_title . '">';
	
	$sqlquery2 = mysql_query("SELECT id, title FROM directory_categories WHERE parent_id = " . $form_item_id . " ORDER BY ordering ASC");
	while($row2 = mysql_fetch_array($sqlquery2)){ 
		$form_item_id2 = filter_out($row2['id']);
		$form_item_title2 = filter_out($row2['title']);
		
		if($form_item_id2 == $item_cat){
			$categories_listbox .= '<option value="' . $form_item_id2 . '" selected="selected">' . $form_item_title2 . '</option>';
		}else{
			$categories_listbox .= '<option value="' . $form_item_id2 . '">' . $form_item_title2 . '</option>';
		}
	}
	
	$categories_listbox .= '</optgroup>';
}

// -------------------------------------------------------------------------------------------------------------------------
// Geographic
// -------------------------------------------------------------------------------------------------------------------------

$geo1_listbox = '';
$geo2_listbox = '';
$geo3_listbox = '';

$sqlquery = mysql_query('SELECT id, title FROM locations WHERE parent_id = 0 ORDER BY title ASC');

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	
	if($form_item_id == $item_geo1){
		$geo1_listbox .= '<option value="' . $form_item_id . '" selected="selected">' . $form_item_title . '</option>';
	}else{
		$geo1_listbox .= '<option value="' . $form_item_id . '">' . $form_item_title . '</option>';
	}
}

if($item_geo1 > 0){
	$sqlquery = mysql_query('SELECT id, title FROM locations WHERE parent_id = ' . (int)$item_geo1 . ' ORDER BY title ASC');

	while($row = mysql_fetch_array($sqlquery)){ 
		$form_item_id = filter_out($row['id']);
		$form_item_title = filter_out($row['title']);
		
		if($form_item_id == $item_geo2){
			$geo2_listbox .= '<option value="' . $form_item_id . '" selected="selected">' . $form_item_title . '</option>';
		}else{
			$geo2_listbox .= '<option value="' . $form_item_id . '">' . $form_item_title . '</option>';
		}
	}
}

if($item_geo2 > 0){
	$sqlquery = mysql_query('SELECT id, title FROM locations WHERE parent_id = ' . (int)$item_geo2 . ' ORDER BY title ASC');

	while($row = mysql_fetch_array($sqlquery)){ 
		$form_item_id = filter_out($row['id']);
		$form_item_title = filter_out($row['title']);
		
		if($form_item_id == $item_geo3){
			$geo3_listbox .= '<option value="' . $form_item_id . '" selected="selected">' . $form_item_title . '</option>';
		}else{
			$geo3_listbox .= '<option value="' . $form_item_id . '">' . $form_item_title . '</option>';
		}
	}
}

// -------------------------------------------------------------------------------------------------------------------------
// Members
// -------------------------------------------------------------------------------------------------------------------------

$members_listbox = '';

$sqlquery = mysql_query("SELECT id, contact_person, company_name FROM profiles ORDER BY contact_person ASC");

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['contact_person']);
	$form_item_company = filter_out($row['company_name']);
	
	if(strlen($form_item_company) > 0){$form_item_title .= ' (' . $form_item_company . ')';}
	
	if($form_item_id == $item_member){
		$members_listbox .= '<option value="' . $form_item_id . '" selected="selected">' . $form_item_title . '</option>';
	}else{
		$members_listbox .= '<option value="' . $form_item_id . '">' . $form_item_title . '</option>';
	}
	
}

// Albums listbox
$albums_listbox = '';

$sqlquery = mysql_query('SELECT gallery_albums.*, (SELECT COUNT(id) FROM gallery WHERE gallery.album_id = gallery_albums.id) cnt FROM gallery_albums ORDER BY title ASC');
while($row = mysql_fetch_array($sqlquery)){ 
	$item_album_id = filter_out($row['id']);
	$item_album_title = filter_out($row['title']);
	$item_album_count = filter_out($row['cnt']);
	if($item_album_id == $item_album){
		$albums_listbox .= '<option value="' . $item_album_id . '" selected="selected">' . $item_album_title . ' (' . $item_album_count . ')</option>';
	}else{
		$albums_listbox .= '<option value="' . $item_album_id . '">' . $item_album_title . ' (' . $item_album_count . ')</option>';
	}
}

?>