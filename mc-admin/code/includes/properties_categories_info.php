<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$item_title = '';
$item_active = 1;

if($listing_id > 0){
	$sqlquery = mysql_query(sprintf("SELECT * FROM properties_categories WHERE id = %d",
				mysql_real_escape_string($listing_id)
				));

	while($row = mysql_fetch_array($sqlquery)){ 
		$item_title = filter_out($row['title']);
		$item_active = filter_out($row['status']);
	}
}

?>