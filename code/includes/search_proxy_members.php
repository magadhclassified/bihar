<?php

session_start();

include '../../config.php';
include 'conn.php';
include 'functions.php';

$target = '';
$search_criteria = array();

if(isset($_POST['origin'])){$origin = $_POST['origin'];}
if(!isset($_POST['kw'])){$kw = '';}else{$kw = safe_input($_POST['kw']);}
$kw = str_replace('Listing Title...', '', $kw);

switch($origin){
	case 'PROPERTIES':
		$search_criteria['kw'] = $kw;
		$search_criteria['status'] = (int)$_POST['status'];
		$target = 'my-properties/1-';
		break;
	case 'MOTORS':
		$search_criteria['kw'] = $kw;
		$search_criteria['status'] = (int)$_POST['status'];
		$target = 'my-motors/1-';
		break;
	case 'RECYCLE':
		$search_criteria['kw'] = $kw;
		$search_criteria['status'] = (int)$_POST['status'];
		$target = 'my-recycle/1-';
		break;
	case 'JOBS':
		$search_criteria['kw'] = $kw;
		$search_criteria['status'] = (int)$_POST['status'];
		$target = 'my-jobs/1-';
		break;
	case 'DIRECTORY':
		$search_criteria['kw'] = $kw;
		$search_criteria['status'] = (int)$_POST['status'];
		$target = 'my-directory/1-';
		break;
	case 'RESTAURANTS':
		$search_criteria['kw'] = $kw;
		$search_criteria['status'] = (int)$_POST['status'];
		$target = 'my-restaurants/1-';
		break;
	case 'ACCOMMODATION':
		$search_criteria['kw'] = $kw;
		$search_criteria['status'] = (int)$_POST['status'];
		$target = 'my-accommodation/1-';
		break;
	case 'EVENTS':
		$search_criteria['kw'] = $kw;
		$search_criteria['status'] = (int)$_POST['status'];
		$target = 'my-events/1-';
		break;
}

$search_storable = serialize($search_criteria);

$sqlquery = mysql_query(sprintf("INSERT INTO searches(search, date_created, site_section) VALUES('%s', %d, '%s')",
			mysql_real_escape_string($search_storable),
			mysql_real_escape_string(time()),
			mysql_real_escape_string($origin)
			));
			
$search_id = mysql_insert_id();

header('Location: ../../' . $target . $search_id);
exit();

?>