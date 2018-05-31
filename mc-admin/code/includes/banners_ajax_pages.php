<?php

session_start();

if(!isset($_SESSION['Admin_Logged_In']) ||  $_SESSION['Admin_Logged_In'] != "YES"){
	echo "Restricted access.";
	exit();
}

include '../../../config.php';
include 'conn.php';
include 'functions.php';

$is_caller = true;
include 'my_info.php';
if(!check_perms('banners', $account_permissions)){die('Unauthorised access.');}

$zone_id = (int)$_POST['pid'];
$banner_pages_list = '';
//$sqlquery = mysql_query("SELECT id, title FROM banners_pages WHERE linkage LIKE '%%%$zone_id%%' ORDER BY title ASC");
$sqlquery = mysql_query(sprintf("SELECT id, title FROM banners_pages WHERE linkage LIKE '%%%s%%' ORDER BY title ASC",
			mysql_real_escape_string($zone_id)
			));
while($row = mysql_fetch_array($sqlquery)){ 
	$banner_p_id = filter_out($row['id']);
	$banner_p_title = filter_out($row['title']);
	
	$banner_pages_list .= '<li><input class="checkbox" name="pages[]" value="' . $banner_p_id . '" type="checkbox" />&nbsp;&nbsp;' . $banner_p_title . '</li>';
	
}

if(strlen($banner_pages_list) == 0){
	$banner_pages_list = 'First select Zone above.';
}

echo $banner_pages_list;

?>