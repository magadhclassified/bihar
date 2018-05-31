<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$item_title = '';
$item_image = '';
$item_banner_top = '';
$item_banner_rhs = '';
$html_text = '';

if($listing_id > 0){
	$sqlquery = mysql_query(sprintf("SELECT * FROM categories WHERE id = %d",
				mysql_real_escape_string($listing_id)
				));

	while($row = mysql_fetch_array($sqlquery)){ 
		$item_title = filter_out($row['title']);
		$item_image = filter_out($row['img1']);
		$item_banner_top = filter_out($row['banner_top']);
		$item_banner_rhs = filter_out($row['banner_rhs']);
		$html_text = filter_out($row['contents']);
	}
}

?>