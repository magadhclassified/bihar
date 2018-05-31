<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$item_title = '';
$item_seotitle = '';
$item_brief = '';
$item_keywords = '';
$html_text = '';
$item_seo = '';
$item_album = 0;
$can_edit_seo = 0;

if($listing_id > 0){
	$sqlquery = mysql_query(sprintf("SELECT * FROM pages WHERE id = %d",
				mysql_real_escape_string($listing_id)
				));

	while($row = mysql_fetch_array($sqlquery)){ 
		$item_title = filter_out($row['title']);
		$item_seotitle = filter_out($row['seotitle']);
		$item_brief = filter_out($row['brief']);
		$item_keywords = filter_out($row['keywords']);
		$item_seo = filter_out($row['seo']);
		$can_edit_seo = filter_out($row['can_edit_seo']);
		$item_album = filter_out($row['gallery_id']);
		$html_text = $row['contents'];
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