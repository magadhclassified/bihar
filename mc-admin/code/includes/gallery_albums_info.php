<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$item_title = '';

if($listing_id > 0){
	$sqlquery = mysql_query(sprintf("SELECT * FROM gallery_albums WHERE id = %d",
				mysql_real_escape_string($listing_id)
				));

	while($row = mysql_fetch_array($sqlquery)){ 
		$item_title = filter_out($row['title']);
	}
}

?>