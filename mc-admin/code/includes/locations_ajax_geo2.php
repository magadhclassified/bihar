<?php

session_start();
if(!isset($_SESSION['Admin_Logged_In'])){
	exit();
}
include('../../../config.php');
include('functions.php');
include('conn.php');

$select_box = '<select name="geo2" onchange="change_geo3(this.value);"><option value="-1">Please Select...</option>';

$sqlquery = mysql_query('SELECT id, title FROM locations WHERE parent_id = ' . (int)$_POST['pid'] . ' ORDER BY title ASC');

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	$select_box .= '<option value="' . $form_item_id . '">' . $form_item_title . '</option>';
}

$select_box .= '</select>';

echo $select_box;

?>