<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$item_title = '';
$item_date = time();
$item_image = '';
$item_active = 1;
$item_album = 0;

if($listing_id > 0){
	$sqlquery = mysql_query(sprintf("SELECT * FROM gallery WHERE id = %d",
				mysql_real_escape_string($listing_id)
				));

	while($row = mysql_fetch_array($sqlquery)){ 
		$item_title = filter_out($row['title']);
		$item_date = filter_out($row['date_created']);
		$item_image = filter_out($row['img_url']);
		$item_active = filter_out($row['status']);
		$item_album = filter_out($row['album_id']);
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

// Albums search listbox
$albums_search_listbox = '';

$sqlquery = mysql_query('SELECT gallery_albums.*, (SELECT COUNT(id) FROM gallery WHERE gallery.album_id = gallery_albums.id) cnt FROM gallery_albums ORDER BY title ASC');
while($row = mysql_fetch_array($sqlquery)){ 
	$item_album_id = filter_out($row['id']);
	$item_album_title = filter_out($row['title']);
	$item_album_count = filter_out($row['cnt']);
	if($item_album_id == $album){
		$albums_search_listbox .= '<option value="' . $item_album_id . '" selected="selected">' . $item_album_title . ' (' . $item_album_count . ')</option>';
	}else{
		$albums_search_listbox .= '<option value="' . $item_album_id . '">' . $item_album_title . ' (' . $item_album_count . ')</option>';
	}
}

?>