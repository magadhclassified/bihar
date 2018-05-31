<?php

session_start();
if(!isset($_SESSION['Member_ID'])){
	exit();
}
include('../../config.php');
include('functions.php');
include('conn.php');

$select_box = '<select name="geo3" class="form-control"><option value="-1">&nbsp;Please Select...</option>';

$sqlquery = mysql_query('SELECT id, title FROM locations WHERE parent_id = ' . (int)$_POST['pid'] . ' ORDER BY title ASC');

while($row = mysql_fetch_array($sqlquery)){ 
	$form_item_id = filter_out($row['id']);
	$form_item_title = filter_out($row['title']);
	$select_box .= '<option value="' . $form_item_id . '">&nbsp;' . $form_item_title . '</option>';
}

$select_box .= '</select>';

echo $select_box;

?>