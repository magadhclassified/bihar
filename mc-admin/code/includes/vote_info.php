<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$item_title = '';
$item_brief = '';
$html_text = '';

if($listing_id > 0){
	$sqlquery = mysql_query(sprintf("SELECT * FROM vote_options WHERE id = %d",
				mysql_real_escape_string($listing_id)
				));

	while($row = mysql_fetch_array($sqlquery)){ 
		$item_title = filter_out($row['title']);
		$item_brief = filter_out($row['brief']);
		$html_text = filter_out($row['contents']);
	}
}

?>