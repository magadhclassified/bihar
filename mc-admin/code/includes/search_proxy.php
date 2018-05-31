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

$from = $_POST['origin'];
$search_criteria = array();
$search_storable = '';
$redirect = '';

if(!isset($_POST['kw'])){$kw = '';}else{$kw = safe_input($_POST['kw']);}
$kw = str_replace('Listing Title or Reference #', '', $kw);
$kw = str_replace('Listing Title', '', $kw);

switch($from){
	case 'DIRECTORY';
		if(!check_perms('directory', $account_permissions)){die('Unauthorised access.');}
		$redirect = 'directory/page-1-{{SID}}';
		$search_criteria['kw'] = $kw;
		$search_criteria['order'] = seo($_POST['order']);
		$search_criteria['sort'] = seo($_POST['sort']);
		$search_criteria['show'] = (int)$_POST['show'];
		break;
	case 'JOBS';
		if(!check_perms('jobs', $account_permissions)){die('Unauthorised access.');}
		$redirect = 'jobs/page-1-{{SID}}';
		$search_criteria['kw'] = $kw;
		$search_criteria['order'] = seo($_POST['order']);
		$search_criteria['sort'] = seo($_POST['sort']);
		$search_criteria['show'] = (int)$_POST['show'];
		break;
	case 'MOTORS';
		if(!check_perms('motors', $account_permissions)){die('Unauthorised access.');}
		$redirect = 'motors/page-1-{{SID}}';
		$search_criteria['kw'] = $kw;
		$search_criteria['order'] = seo($_POST['order']);
		$search_criteria['sort'] = seo($_POST['sort']);
		$search_criteria['show'] = (int)$_POST['show'];
		break;
	case 'RECYCLE';
		if(!check_perms('recycle', $account_permissions)){die('Unauthorised access.');}
		$redirect = 'recycle/page-1-{{SID}}';
		$search_criteria['kw'] = $kw;
		$search_criteria['order'] = seo($_POST['order']);
		$search_criteria['sort'] = seo($_POST['sort']);
		$search_criteria['show'] = (int)$_POST['show'];
		break;
	case 'PROPERTIES';
		if(!check_perms('properties', $account_permissions)){die('Unauthorised access.');}
		$redirect = 'properties/page-1-{{SID}}';
		$search_criteria['kw'] = $kw;
		$search_criteria['order'] = seo($_POST['order']);
		$search_criteria['sort'] = seo($_POST['sort']);
		$search_criteria['show'] = (int)$_POST['show'];
		break;
	case 'RESTAURANTS';
		if(!check_perms('restaurants', $account_permissions)){die('Unauthorised access.');}
		$redirect = 'restaurants/page-1-{{SID}}';
		$search_criteria['kw'] = $kw;
		$search_criteria['order'] = seo($_POST['order']);
		$search_criteria['sort'] = seo($_POST['sort']);
		$search_criteria['show'] = (int)$_POST['show'];
		break;
	case 'ACCOMMODATION';
		if(!check_perms('accommodation', $account_permissions)){die('Unauthorised access.');}
		$redirect = 'accommodation/page-1-{{SID}}';
		$search_criteria['kw'] = $kw;
		$search_criteria['order'] = seo($_POST['order']);
		$search_criteria['sort'] = seo($_POST['sort']);
		$search_criteria['show'] = (int)$_POST['show'];
		break;
	case 'EVENTS';
		if(!check_perms('events', $account_permissions)){die('Unauthorised access.');}
		$redirect = 'events/page-1-{{SID}}';
		$search_criteria['kw'] = $kw;
		$search_criteria['order'] = seo($_POST['order']);
		$search_criteria['sort'] = seo($_POST['sort']);
		$search_criteria['show'] = (int)$_POST['show'];
		break;
	case 'SERVICES';
		if(!check_perms('services', $account_permissions)){die('Unauthorised access.');}
		$redirect = 'services/page-1-{{SID}}';
		$search_criteria['kw'] = $kw;
		$search_criteria['order'] = seo($_POST['order']);
		$search_criteria['sort'] = seo($_POST['sort']);
		$search_criteria['show'] = (int)$_POST['show'];
		break;	
	
}

$search_storable = serialize($search_criteria);

$sqlquery = mysql_query(sprintf("INSERT INTO admin_searches(search, date_created, performed_by) VALUES('%s', %d, %d)",
			mysql_real_escape_string($search_storable),
			mysql_real_escape_string(time()),
			mysql_real_escape_string($_SESSION['Admin_ID'])
			));

header('Location: ../../' . str_replace('{{SID}}', mysql_insert_id(), $redirect));

?>