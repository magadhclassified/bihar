<?php

session_start();

include '../../config.php';
include 'conn.php';
include 'functions.php';

$target = '';
$search_criteria = array();
if(isset($_POST['origin'])){$origin = $_POST['origin'];}
if(!isset($_POST['kw'])){$kw = '';}else{$kw = safe_input($_POST['kw']);}
$kw = str_replace('Type your search...', '', $kw);

switch($origin){
	case 'JOBS':
		$search_criteria['kw'] = $kw;
		$search_criteria['industry'] = (int)$_POST['jindustry'];
		$search_criteria['commitment'] = (int)$_POST['jcommitment'];
		$search_criteria['type'] = (int)$_POST['jtype'];
		$search_criteria['member'] = 0;
		$target = 'jobs/1-';
		break;
	case 'MOTORS':
		$search_criteria['kw'] = $kw;
		$search_criteria['make'] = (int)$_POST['mmake'];
		$search_criteria['colour'] = (int)$_POST['mcolour'];
		$search_criteria['type'] = (int)$_POST['mtype'];
		$search_criteria['member'] = 0;
		$target = 'motors/1-';
		break;
	case 'RECYCLE':
		$search_criteria['kw'] = $kw;
		$search_criteria['category'] = (int)$_POST['rcategory'];
		$search_criteria['condition'] = (int)$_POST['rcondition'];
		$search_criteria['type'] = (int)$_POST['rtype'];
		$target = 'recycle/1-';
		break;
	case 'DIRECTORY':
		$search_criteria['kw'] = $kw;
		$search_criteria['category'] = (int)$_POST['dcategory'];
		$target = 'directory/1-';
		break;
	case 'PROPERTY':
		$search_criteria['kw'] = $kw;
		$search_criteria['category'] = (int)$_POST['pcategory'];
		$search_criteria['location'] = (int)$_POST['plocation'];
		$search_criteria['type'] = (int)$_POST['ptype'];
		$search_criteria['member'] = 0;
		$search_criteria['main_type'] = 0;
		$target = 'property/1-';
		break;
	case 'RESTAURANTS':
		$search_criteria['kw'] = $kw;
		$search_criteria['cuisine'] = (int)$_POST['xcuisine'];
		$search_criteria['menu'] = (int)$_POST['xmenu'];
		$search_criteria['dresscode'] = (int)$_POST['xdresscode'];
		$target = 'restaurants/1-';
		break;
	case 'ACCOMMODATION':
		$search_criteria['kw'] = $kw;
		$search_criteria['type'] = (int)$_POST['atype'];
		$search_criteria['rating'] = (int)$_POST['arating'];
		$target = 'accommodation/1-';
		break;
	case 'EVENTS':
		$search_criteria['kw'] = $kw;
		$search_criteria['type'] = (int)$_POST['etype'];
		$target = 'events/1-';
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