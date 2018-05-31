<?php

$target = '';
$search_criteria = array();

switch($qs_type){
	case 'PROP_RENT_TYPE':
		$search_criteria['kw'] = '';
		$search_criteria['category'] = 2; // Rent
		$search_criteria['location'] = 0;
		$search_criteria['type'] = $data1_id;
		$search_criteria['member'] = 0;
		$search_criteria['main_type'] = 0;
		$target = 'property/1-';
		break;
	case 'PROP_SALE_TYPE':
		$search_criteria['kw'] = '';
		$search_criteria['category'] = 1; // Sale
		$search_criteria['location'] = 0;
		$search_criteria['type'] = $data1_id;
		$search_criteria['member'] = 0;
		$search_criteria['main_type'] = 0;
		$target = 'property/1-';
		break;
	case 'PROP_BY_AGENT':
		$search_criteria['kw'] = '';
		$search_criteria['category'] = 0;
		$search_criteria['location'] = 0;
		$search_criteria['type'] = 0;
		$search_criteria['member'] = $data1_id;
		$search_criteria['main_type'] = 0;
		$target = 'property/1-';
		break;
	case 'PROP_SALE':
		$search_criteria['kw'] = '';
		$search_criteria['category'] = 1; // Sale
		$search_criteria['location'] = 0;
		$search_criteria['type'] = 0;
		$search_criteria['member'] = 0;
		$search_criteria['main_type'] = 0;
		$target = 'property/1-';
		break;
	case 'PROP_RENT':
		$search_criteria['kw'] = '';
		$search_criteria['category'] = 2; // Rent
		$search_criteria['location'] = 0;
		$search_criteria['type'] = 0;
		$search_criteria['member'] = 0;
		$search_criteria['main_type'] = 0;
		$target = 'property/1-';
		break;
	case 'PROP_BY_MAIN':
		$search_criteria['kw'] = '';
		$search_criteria['category'] = 0;
		$search_criteria['location'] = 0;
		$search_criteria['type'] = 0;
		$search_criteria['member'] = 0;
		$search_criteria['main_type'] = $data1_id;
		$target = 'property/1-';
		break;
		
	case 'JOB_BY_ADVERTISER':
		$search_criteria['kw'] = '';
		$search_criteria['industry'] = 0;
		$search_criteria['commitment'] = 0;
		$search_criteria['type'] = 0;
		$search_criteria['member'] = $data1_id;
		$target = 'jobs/1-';
		break;
	case 'JOB_OFFERED_INDUSTRY':
		$search_criteria['kw'] = '';
		$search_criteria['industry'] = $data1_id;
		$search_criteria['commitment'] = 0;
		$search_criteria['type'] = 1;
		$search_criteria['member'] = 0;
		$target = 'jobs/1-';
		break;
	case 'JOB_WANTED_INDUSTRY':
		$search_criteria['kw'] = '';
		$search_criteria['industry'] = $data1_id;
		$search_criteria['commitment'] = 0;
		$search_criteria['type'] = 2;
		$search_criteria['member'] = 0;
		$target = 'jobs/1-';
		break;
	case 'JOB_OFFERED':
		$search_criteria['kw'] = '';
		$search_criteria['industry'] = 0;
		$search_criteria['commitment'] = 0;
		$search_criteria['type'] = 1;
		$search_criteria['member'] = 0;
		$target = 'jobs/1-';
		break;
	case 'JOB_WANTED':
		$search_criteria['kw'] = '';
		$search_criteria['industry'] = 0;
		$search_criteria['commitment'] = 0;
		$search_criteria['type'] = 2;
		$search_criteria['member'] = 0;
		$target = 'jobs/1-';
		break;
		
	case 'MOTORS_BY_DEALER':
		$search_criteria['kw'] = '';
		$search_criteria['make'] = 0;
		$search_criteria['colour'] = 0;
		$search_criteria['type'] = 0;
		$search_criteria['member'] = $data1_id;
		$target = 'motors/1-';
		break;
	case 'MOTORS_SALE_MAKE':
		$search_criteria['kw'] = '';
		$search_criteria['make'] = $data1_id;
		$search_criteria['colour'] = 0;
		$search_criteria['type'] = 1;
		$search_criteria['member'] = 0;
		$target = 'motors/1-';
		break;
	case 'MOTORS_RENT_MAKE':
		$search_criteria['kw'] = '';
		$search_criteria['make'] = $data1_id;
		$search_criteria['colour'] = 0;
		$search_criteria['type'] = 2;
		$search_criteria['member'] = 0;
		$target = 'motors/1-';
		break;
	case 'MOTORS_SALE':
		$search_criteria['kw'] = '';
		$search_criteria['make'] = 0;
		$search_criteria['colour'] = 0;
		$search_criteria['type'] = 1;
		$search_criteria['member'] = 0;
		$target = 'motors/1-';
		break;
	case 'MOTORS_RENT':
		$search_criteria['kw'] = '';
		$search_criteria['make'] = 0;
		$search_criteria['colour'] = 0;
		$search_criteria['type'] = 2;
		$search_criteria['member'] = 0;
		$target = 'motors/1-';
		break;
	
	case 'RECYCLE_CAT':
		$search_criteria['kw'] = '';
		$search_criteria['category'] = $data1_id;
		$search_criteria['condition'] = 0;
		$search_criteria['type'] = 0;
		$target = 'recycle/1-';
		break;
		
	case 'RESTAURANTS_CUISINE':
		$search_criteria['kw'] = '';
		$search_criteria['cuisine'] = $data1_id;
		$search_criteria['menu'] = 0;
		$search_criteria['dresscode'] = 0;
		$target = 'restaurants/1-';
		break;
		
	case 'ACCOMMODATION_TYPE':
		$search_criteria['kw'] = '';
		$search_criteria['type'] = $data1_id;
		$search_criteria['rating'] = 0;
		$target = 'accommodation/1-';
		break;
		
	case 'EVENTS_TYPE':
		$search_criteria['kw'] = '';
		$search_criteria['type'] = $data1_id;
		$target = 'events/1-';
		break;
}

$search_storable = serialize($search_criteria);

$sqlquery = mysql_query(sprintf("INSERT INTO searches(search, date_created, site_section) VALUES('%s', %d, '%s')",
			mysql_real_escape_string($search_storable),
			mysql_real_escape_string(time()),
			mysql_real_escape_string('')
			));
			
$search_id = mysql_insert_id();

header('Location: ' . COMPANY_URL . $target . $search_id);
exit();

?>