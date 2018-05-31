<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$item_title = '';

if($listing_id > 0){
	$sqlquery = mysql_query(sprintf("SELECT * FROM locations WHERE id = %d",
				mysql_real_escape_string($listing_id)
				));

	while($row = mysql_fetch_array($sqlquery)){ 
		$item_title = filter_out($row['title']);
		$item_parent_id = filter_out($row['parent_id']); // Variable delcared in the __controller
	}
}

?>