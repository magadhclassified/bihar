<?php

/*
By: Ranjeet Kumar
*/

error_reporting(E_ALL);
session_start();

include('config.php');
date_default_timezone_set('Asia/Kolkata');
include('code/includes/functions.php');
include('code/includes/conn.php');

if(isset($_GET['p'])){
	$p = $_GET['p'];
}else{
	$p = 'home';
}

$caller = true; //Prevent direct template access, force through __controller
$mm_sel = 0; // Selected menu item
$global_banner_page = 0;
$show_big_magadh = false;
$site_section = 'PROPERTY'; // Used to determine which Quick Search button to select and criteria to display, PROPERTY is default

$global_emirate_id = 0;
if(isset($_SESSION['Emirate'])){
	$global_emirate_id = $_SESSION['Emirate'];
}

// ***************** GLOBAL INFO ***************** //

$global_info = array();

$sqlquery = mysql_query("SELECT google_analytics, google_webmaster_tools, google_maps_api, facebook_link, twitter_link, google_maps_zoom, code_head, code_footer, google_maps_lat, google_maps_lng, addthis_username, peel_enabled, peel_image_thumb, peel_image, peel_link, bg_enabled, bg_image, facebook_app_id, surf_safe_text FROM settings WHERE id = 1");
while($row = mysql_fetch_assoc($sqlquery)){ 
	$global_info[0] = $row['google_analytics'];
	$global_info[1] = $row['google_webmaster_tools'];
	$global_info[2] = $row['google_maps_api'];
	$global_info[3] = $row['facebook_link'];
	$global_info[4] = $row['twitter_link'];
	$global_info[5] = $row['google_maps_zoom'];
	$global_info[6] = $row['code_head'];
	$global_info[7] = $row['code_footer'];
	$global_info[8] = $row['google_maps_lat'];
	$global_info[9] = $row['google_maps_lng'];
	$global_info[10] = $row['addthis_username'];
	$global_info[11] = $row['peel_enabled'];
	$global_info[12] = $row['peel_image_thumb'];
	$global_info[13] = $row['peel_image'];
	$global_info[14] = $row['peel_link'];
	$global_info[15] = $row['bg_enabled'];
	$global_info[16] = $row['bg_image'];
	$global_info[17] = $row['facebook_app_id'];
	$global_info[18] = $row['surf_safe_text'];
}

// ***************** MEMBER INFO ***************** //

$member_name = '';
$member_email = '';
$member_number = '';
if(isset($_SESSION['Member_ID'])){
	include 'code/includes/member_info.php';
}

// *********************************************** //

function getPage($data, $type){
	$page_in = array();
	$field_gallery = 0;
	if($type == 'ID'){
		$sqlquery = mysql_query(sprintf("SELECT * FROM pages WHERE id = %d AND status = 1",
					mysql_real_escape_string($data)
					));
	}else{
		$sqlquery = mysql_query(sprintf("SELECT * FROM pages WHERE seo = '%s' AND status = 1",
					mysql_real_escape_string($data)
					));
	}
	
	while($row = mysql_fetch_assoc($sqlquery)){ 
		$page_in[0] = filer_out_limit($row['id']);
		$page_in[1] = filer_out_limit($row['title']);
		$page_in[2] = $row['contents'];
		$page_in[3] = filer_out_limit($row['brief']);
		$page_in[4] = filer_out_limit($row['keywords']);
		$page_in[5] = filer_out_limit($row['seo']);
		$page_in[6] = filer_out_limit($row['form_title']);
		$page_in[7] = filer_out_limit($row['form_brief']);
		$page_in[8] = filer_out_limit($row['form_email']);
		$page_in[9] = filer_out_limit($row['banner_page_id']);
		$page_in[11] = filer_out_limit($row['seotitle']);
		$field_gallery = (int)$row['gallery_id'];
	}
	
	// =============================================================================================================================
	// Get gallery images for this item if specified
	// =============================================================================================================================

	$str_carousel_gallery = '';

	if($field_gallery > 0){

		$sqlquery = mysql_query(sprintf('SELECT title, img_url FROM gallery WHERE album_id = %d AND status = 1 ORDER BY id DESC',
					mysql_real_escape_string($field_gallery)
					));

		while($row = mysql_fetch_array($sqlquery)){ 
			$field_gallery_title = filer_out_limit($row['title']);
			$field_gallery_image = filer_out_limit($row['img_url']);
			
			$str_carousel_gallery .= '<li><img src="files/gallery/large/' . $field_gallery_image . '" alt="' . safe_alt($field_gallery_title) . '" title="' . safe_alt($field_gallery_title) . '" /><span>' . $field_gallery_title . '</span></li>';
		}
		
	}
	if(strlen($str_carousel_gallery) > 0){
		$str_carousel_gallery = '<div class="detailsslider"><div class="detailsslide"><ul>' . $str_carousel_gallery . '</ul></div><p class="paging"><a class="sliderback" href="#"><img src="graphics/buttons/detailsslider-previous.png" alt="Previous" title="Previous" height="30" width="25" /></a><a class="slidernext" href="#"><img src="graphics/buttons/detailsslider-next.png" alt="Next" title="Next" height="30" width="25" /></a></p><script type="text/javascript" src="ajax/carousel/detailsslider-settings.js"></script></div>';
	}
	
	// =============================================================================================================================
	
	$page_in[10] = $str_carousel_gallery;
	
	return $page_in;
}

if($p == 'home'){
	
	$page_data = getPage(1, 'ID');
	$mm_sel = 1;
	$global_banner_page = 33;
	$show_big_magadh = true;
	include TEMPLATES . 'index.php';
	
}else if($p == 'register'){
	$page_data = getPage(31, 'ID');
	include TEMPLATES . 'register.php';
	
}else if($p == 'login'){
	$page_data = getPage(30, 'ID');
	include TEMPLATES . 'login.php';
	
}else if($p == 'forgot-password'){
	$page_data = getPage(1, 'ID');
	include TEMPLATES . 'forgot.php';
	
}else if($p == 'login-error'){
    $page_data = getPage(1, 'ID');
	$status_title = 'Login Error';
	$status_url = 'login-error';
	$status_msg = 'You could not be logged in with the supplied credentials. Please try again and keep in mind that passwords are case-sensitive.<br /><br />Forgot your password? Reset it <a class="red" style="font-size:12px;" href="forgot-password" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 500 } )">here</a>.<br /><br />Not a registered member yet? Register <a class="red" style="font-size:12px;" href="register" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',  objectWidth: 900, objectHeight: 950 } )">here</a>.';
	$global_banner_page = 32;
	include TEMPLATES . 'member-process.php';
	
}else if($p == 'register-error'){
    $page_data = getPage(1, 'ID');
	$status_title = 'Registration Error';
	$status_url = 'register-error';
	$status_msg = $_SESSION['Form_Feedback'];
	
	$global_banner_page = 41;
	
	include TEMPLATES . 'member-process.php';
	
}else if($p == 'register-status'){
    $page_data = getPage(1, 'ID');
	$status_title = 'Registration Status';
	$status_url = 'register-status';
	$status_msg = $_SESSION['Form_Feedback'];
	$global_banner_page = 41;	
	include TEMPLATES . 'member-process.php';
	
}else if(preg_match("/^auth-facebook.*$/i", $p)){

	include 'code/includes/auth_fb.php';
	
}else if($p == 'my-dashboard'){
	
	include 'code/includes/member_security.php';
	include 'code/includes/member_dashboard_info.php';
	$global_banner_page = 28;
	include TEMPLATES . 'my-dashboard.php';
	
}else if($p == 'my-ads'){
	
	include 'code/includes/member_security.php';
	include 'code/includes/member_dashboard_info.php';
	$global_banner_page = 28;
	include TEMPLATES . 'my-ads.php';
	
}else if($p == 'my-pending-ads'){
	
	include 'code/includes/member_security.php';
	include 'code/includes/member_dashboard_info.php';
	$global_banner_page = 28;
	include TEMPLATES . 'my-ads.php';
	
}else if($p == 'my-archived-ads'){
	
	include 'code/includes/member_security.php';
	include 'code/includes/member_dashboard_info.php';
	$global_banner_page = 28;
	include TEMPLATES . 'my-ads.php';
	
}



else if($p == 'directory'){
	
	$site_section = 'DIRECTORY';
	$mm_sel = 5;
	$global_banner_page = 27;
	$page_data = getPage(26, 'ID');
	include TEMPLATES . 'directory.php';
		
}else if(preg_match("/^directory[\/][0-9]+[\-][0-9]+$/i", $p)){

	$page = 1;
	$search_id = 0;
	$my_category = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	
	$site_section = 'DIRECTORY';
	$mm_sel = 5;
	$global_banner_page = 27;
	$page_data = getPage(26, 'ID');
	include TEMPLATES . 'directory-results.php';
		
}else if(preg_match("/^directory-category[\/][0-9]+[\-][0-9]+[\/].*$/i", $p)){

	$page = 1;
	$search_id = 0;
	$my_category = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$my_category = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	
	$site_section = 'DIRECTORY';
	$mm_sel = 5;
	$global_banner_page = 27;
	$page_data = getPage(26, 'ID');
	include TEMPLATES . 'directory-results.php';
		
}else if(preg_match("/^directory-details[\/][0-9]+[\/].*$/i", $p)){

	$listing_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}

	$site_section = 'DIRECTORY';
	$mm_sel = 5;
	$global_banner_page = 26;
	$page_data = getPage(26, 'ID'); // Used for title and bread crumbs
	include TEMPLATES . 'directory-details.php';	
	
}
















else if(preg_match("/^property-details[\/][0-9]+[\/].*$/i", $p)){

	$listing_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}

	$site_section = 'PROPERTY';
	$mm_sel = 2;
	$global_banner_page = 14;
	$page_data = getPage(18, 'ID'); // Used for title and bread crumbs
	include TEMPLATES . 'property-details.php';	
	
}else if(preg_match("/^property[\/]{0,1}[0-9]*[\-]{0,1}[0-9]*$/i", $p)){

	$page = 1;
	$search_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	
	$site_section = 'PROPERTY';
	$mm_sel = 2;
	$global_banner_page = 15;
	$page_data = getPage(18, 'ID');
	$show_big_magadh = true;
	include TEMPLATES . 'property.php';
		
}else if(preg_match("/^jobs[\/]{0,1}[0-9]*[\-]{0,1}[0-9]*$/i", $p)){

	$page = 1;
	$search_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	
	$site_section = 'JOBS';
	$mm_sel = 3;
	$global_banner_page = 13;
	$page_data = getPage(13, 'ID');
	$show_big_magadh = true;
	include TEMPLATES . 'jobs.php';
		
}else if(preg_match("/^job-details[\/][0-9]+[\/].*$/i", $p)){

	$listing_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}

	$site_section = 'JOBS';
	$mm_sel = 3;
	$global_banner_page = 12;
	$page_data = getPage(13, 'ID'); // Used for title and bread crumbs
	include TEMPLATES . 'jobs-details.php';	
	
}else if(preg_match("/^motors[\/]{0,1}[0-9]*[\-]{0,1}[0-9]*$/i", $p)){

	$page = 1;
	$search_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	
	$site_section = 'MOTORS';
	$mm_sel = 4;
	$global_banner_page = 17;
	$page_data = getPage(15, 'ID');
	$show_big_magadh = true;
	include TEMPLATES . 'motors.php';
		
}else if(preg_match("/^motor-details[\/][0-9]+[\/].*$/i", $p)){

	$listing_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}

	$site_section = 'MOTORS';
	$mm_sel = 4;
	$global_banner_page = 16;
	$page_data = getPage(15, 'ID'); // Used for title and bread crumbs
	include TEMPLATES . 'motors-details.php';	
	
}else if(preg_match("/^recycle-details[\/][0-9]+[\/].*$/i", $p)){

	$listing_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}

	$site_section = 'RECYCLE';
	$mm_sel = 10;
	$global_banner_page = 22;
	$page_data = getPage(27, 'ID'); // Used for title and bread crumbs
	include TEMPLATES . 'recycle-details.php';	
	
}else if(preg_match("/^recycle[\/]{0,1}[0-9]*[\-]{0,1}[0-9]*$/i", $p)){

	$page = 1;
	$search_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	
	$site_section = 'RECYCLE';
	$mm_sel = 10;
	$global_banner_page = 23;
	$page_data = getPage(27, 'ID');
	$show_big_magadh = true;
	include TEMPLATES . 'recycle.php';
		
}else if($p == 'contact-us'){

	$page_data = getPage(8, 'ID');
	$page_data_feedback = getPage(9, 'ID');
	$global_banner_page = 2;
	include TEMPLATES . 'contact-us.php';
	
}else if($p == 'partners'){

	$page_data = getPage(5, 'ID');
	$global_banner_page = 8;
	include TEMPLATES . 'partners.php';
	
}else if($p == 'advantage'){

	$page_data = getPage(3, 'ID');
	$global_banner_page = 34;
	include TEMPLATES . 'advantage.php';
	
}else if($p == 'about-us'){

	$page_data = getPage(2, 'ID');
	$global_banner_page = 1;
	include TEMPLATES . 'about-us.php';
	
}else if($p == 'terms-and-conditions'){

	$page_data = getPage(7, 'ID');
	$global_banner_page = 7;
	include TEMPLATES . 'terms-and-conditions.php';
	
}else if($p == 'how-to-advertise'){

	$page_data = getPage(6, 'ID');
	$global_banner_page = 7;
	include TEMPLATES . 'how-to-advertise.php';
	
}else if($p == 'faqs'){

	$page_data = getPage(12, 'ID');
	$global_banner_page = 6;
	include TEMPLATES . 'faqs.php';
	
}else if($p == 'thank-you-enquiry'){

	$page_data = getPage(12, 'ID');
	$global_banner_page = 6;
	include TEMPLATES . 'thank-you-enquiry.php';
	
}



else if(preg_match("/^switch-division[\/][0-9]+$/i", $p)){

	$emirate = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$emirate = (int)$temp[1];
	}
	
	$_SESSION['Emirate'] = $emirate;
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit();

}else if(preg_match("/^restaurant-details[\/][0-9]+[\/].*$/i", $p)){

	$listing_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}

	$site_section = 'RESTAURANTS';
	$mm_sel = 7;
	$global_banner_page = 20;
	$page_data = getPage(20, 'ID'); // Used for title and bread crumbs
	include TEMPLATES . 'restaurant-details.php';	
	
}else if(preg_match("/^restaurants[\/]{0,1}[0-9]*[\-]{0,1}[0-9]*$/i", $p)){

	$page = 1;
	$search_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	
	$site_section = 'RESTAURANTS';
	$mm_sel = 7;
	$global_banner_page = 21;
	$page_data = getPage(20, 'ID');
	$show_big_magadh = true;
	include TEMPLATES . 'restaurants.php';
		
}else if(preg_match("/^accommodation-details[\/][0-9]+[\/].*$/i", $p)){

	$listing_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}

	$site_section = 'ACCOMMODATION';
	$mm_sel = 8;
	$global_banner_page = 18;
	$page_data = getPage(25, 'ID'); // Used for title and bread crumbs
	include TEMPLATES . 'accommodation-details.php';	
	
}else if(preg_match("/^accommodation[\/]{0,1}[0-9]*[\-]{0,1}[0-9]*$/i", $p)){

	$page = 1;
	$search_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	
	$site_section = 'ACCOMMODATION';
	$mm_sel = 8;
	$global_banner_page = 19;
	$page_data = getPage(25, 'ID');
	$show_big_magadh = true;
	include TEMPLATES . 'accommodation.php';		
	
}else if(preg_match("/^event-details[\/][0-9]+[\/].*$/i", $p)){

	$listing_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}

	$site_section = 'EVENTS';
	$mm_sel = 9;
	$global_banner_page = 24;
	$page_data = getPage(28, 'ID'); // Used for title and bread crumbs
	include TEMPLATES . 'event-details.php';	
	
}else if(preg_match("/^events[\/]{0,1}[0-9]*[\-]{0,1}[0-9]*$/i", $p)){

	$page = 1;
	$search_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	
	$site_section = 'EVENTS';
	$mm_sel = 9;
	$global_banner_page = 25;
	$page_data = getPage(28, 'ID');
	include TEMPLATES . 'events.php';
}else if(preg_match("/^services-details[\/][0-9]+[\/].*$/i", $p)){

	$listing_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}

	$site_section = 'SERVICES';
	$mm_sel = 11;
	$global_banner_page = 36;
	$page_data = getPage(29, 'ID'); // Used for title and bread crumbs
	include TEMPLATES . 'services-details.php';	
	
}else if(preg_match("/^services-category[\/][0-9]+[\-][0-9]+[\/].*$/i", $p)){

	$page = 1;
	$search_id = 0;
	$my_category = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$my_category = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	
	$site_section = 'SERVICES';
	$mm_sel = 11;
	$global_banner_page = 36;
	$page_data = getPage(29, 'ID');
	include TEMPLATES . 'services-results.php';
		
}else if(preg_match("/^services[\/]{0,1}[0-9]*[\-]{0,1}[0-9]*$/i", $p)){

	$page = 1;
	$search_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	
	$site_section = 'SERVICES';
	$mm_sel = 11;
	$show_big_magadh = true;
	$global_banner_page = 35;
	$page_data = getPage(29, 'ID');
	include TEMPLATES . 'services.php';
	
				
/* ---------------------------------------------------------------------------------------- */
// QS searches for PROPERTY		
/* ---------------------------------------------------------------------------------------- */

}else if(preg_match("/^properties-for-rent-by-type[\/][0-9]+[\/].*$/i", $p)){

	$qs_type = 'PROP_RENT_TYPE';
	$data1_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$data1_id = (int)$temp[1];
	}

	include 'code/includes/search_proxy_qs.php';
}else if(preg_match("/^properties-for-sale-by-type[\/][0-9]+[\/].*$/i", $p)){

	$qs_type = 'PROP_SALE_TYPE';
	$data1_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$data1_id = (int)$temp[1];
	}

	include 'code/includes/search_proxy_qs.php';
}else if(preg_match("/^properties-by-agent[\/][0-9]+[\/].*$/i", $p)){

	$qs_type = 'PROP_BY_AGENT';
	$data1_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$data1_id = (int)$temp[1];
	}

	include 'code/includes/search_proxy_qs.php';
}else if($p == 'properties-for-sale'){

	$qs_type = 'PROP_SALE';

	include 'code/includes/search_proxy_qs.php';
}else if($p == 'properties-for-rent'){

	$qs_type = 'PROP_RENT';

	include 'code/includes/search_proxy_qs.php';
}else if(preg_match("/^properties-by-main-type[\/][0-9]+[\/].*$/i", $p)){

	$qs_type = 'PROP_BY_MAIN';
	$data1_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$data1_id = (int)$temp[1];
	}

	include 'code/includes/search_proxy_qs.php';
	
/* ---------------------------------------------------------------------------------------- */
// QS searches for DIRECTORY		
/* ---------------------------------------------------------------------------------------- */

}else if(preg_match("/^business-directory[\/][0-9]+[\/].*$/i", $p)){

	$emirate = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$emirate = (int)$temp[1];
	}
	
	$_SESSION['Emirate'] = $emirate;

	header('Location: ' . COMPANY_URL . 'directory');
	exit();

/* ---------------------------------------------------------------------------------------- */
// QS searches for JOBS		
/* ---------------------------------------------------------------------------------------- */

}else if(preg_match("/^jobs-offered-by-industry[\/][0-9]+[\/].*$/i", $p)){

	$qs_type = 'JOB_OFFERED_INDUSTRY';
	$data1_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$data1_id = (int)$temp[1];
	}

	include 'code/includes/search_proxy_qs.php';
}else if(preg_match("/^jobs-wanted-by-industry[\/][0-9]+[\/].*$/i", $p)){

	$qs_type = 'JOB_WANTED_INDUSTRY';
	$data1_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$data1_id = (int)$temp[1];
	}

	include 'code/includes/search_proxy_qs.php';
}else if(preg_match("/^jobs-by-advertiser[\/][0-9]+[\/].*$/i", $p)){

	$qs_type = 'JOB_BY_ADVERTISER';
	$data1_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$data1_id = (int)$temp[1];
	}

	include 'code/includes/search_proxy_qs.php';
	
}else if($p == 'jobs-offered'){

	$qs_type = 'JOB_OFFERED';

	include 'code/includes/search_proxy_qs.php';
}else if($p == 'jobs-wanted'){

	$qs_type = 'JOB_WANTED';

	include 'code/includes/search_proxy_qs.php';

/* ---------------------------------------------------------------------------------------- */
// QS searches for MOTORS		
/* ---------------------------------------------------------------------------------------- */

}else if(preg_match("/^motors-for-sale-by-make[\/][0-9]+[\/].*$/i", $p)){

	$qs_type = 'MOTORS_SALE_MAKE';
	$data1_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$data1_id = (int)$temp[1];
	}

	include 'code/includes/search_proxy_qs.php';
}else if(preg_match("/^motors-for-rent-by-make[\/][0-9]+[\/].*$/i", $p)){

	$qs_type = 'MOTORS_RENT_MAKE';
	$data1_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$data1_id = (int)$temp[1];
	}

	include 'code/includes/search_proxy_qs.php';
}else if(preg_match("/^motors-by-dealer[\/][0-9]+[\/].*$/i", $p)){

	$qs_type = 'MOTORS_BY_DEALER';
	$data1_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$data1_id = (int)$temp[1];
	}

	include 'code/includes/search_proxy_qs.php';
	
}else if($p == 'motors-for-sale'){

	$qs_type = 'MOTORS_SALE';

	include 'code/includes/search_proxy_qs.php';
}else if($p == 'motors-for-rent'){

	$qs_type = 'MOTORS_RENT';

	include 'code/includes/search_proxy_qs.php';

/* ---------------------------------------------------------------------------------------- */
// QS searches for RECYCLE		
/* ---------------------------------------------------------------------------------------- */

}else if(preg_match("/^recycle-items-by-category[\/][0-9]+[\/].*$/i", $p)){

	$qs_type = 'RECYCLE_CAT';
	$data1_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$data1_id = (int)$temp[1];
	}

	include 'code/includes/search_proxy_qs.php';
	
/* ---------------------------------------------------------------------------------------- */
// QS searches for RESTAURANTS		
/* ---------------------------------------------------------------------------------------- */	
	
}else if(preg_match("/^restaurants-by-cuisine[\/][0-9]+[\/].*$/i", $p)){

	$qs_type = 'RESTAURANTS_CUISINE';
	$data1_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$data1_id = (int)$temp[1];
	}

	include 'code/includes/search_proxy_qs.php';
	
/* ---------------------------------------------------------------------------------------- */
// QS searches for ACCOMMODATION		
/* ---------------------------------------------------------------------------------------- */	
	
}else if(preg_match("/^accommodation-by-type[\/][0-9]+[\/].*$/i", $p)){

	$qs_type = 'ACCOMMODATION_TYPE';
	$data1_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$data1_id = (int)$temp[1];
	}

	include 'code/includes/search_proxy_qs.php';
	
/* ---------------------------------------------------------------------------------------- */
// QS searches for EVENTS		
/* ---------------------------------------------------------------------------------------- */	
	
}else if(preg_match("/^events-by-type[\/][0-9]+[\-][0-9]+[\/].*$/i", $p)){

	$qs_type = 'EVENTS_TYPE';
	$data1_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$data_id = $temp[1];
		list($pageid,$data1_id) = explode('-', $data_id);
	}

	 include 'code/includes/search_proxy_qs.php';

/* ---------------------------------------------------------------------------------------- */
		
}else if($p == 'my-profile'){
	
	include 'code/includes/member_security.php';
	include TEMPLATES . 'pop-my-profile.php';
	
}else if(preg_match("/^my-properties[\/]{0,1}[0-9]*[\-]{0,1}[0-9]*$/i", $p)){

	include 'code/includes/member_security.php';

	$page = 1;
	$search_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	

	$global_banner_page = 31;

	include TEMPLATES . 'my-property.php';
		
}else if(preg_match("/^my-property-delete[\/][0-9]+$/i", $p)){

	include 'code/includes/member_security.php';

	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$id = (int)$temp[1];
		header('Location: ' . COMPANY_URL . 'code/includes/member_listing_delete.php?s=PROPERTY&id=' . $id);
		exit();
	}
		
}else if(preg_match("/^my-property-manage[\/]{0,1}[0-9]*$/i", $p)){

	include 'code/includes/member_security.php';

	$listing_id = 0;

	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}
	
	include TEMPLATES . 'my-property-manage.php';
		
}else if(preg_match("/^my-motors[\/]{0,1}[0-9]*[\-]{0,1}[0-9]*$/i", $p)){

	include 'code/includes/member_security.php';

	$page = 1;
	$search_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	

	$global_banner_page = 30;

	include TEMPLATES . 'my-motors.php';
		
}else if(preg_match("/^my-motors-delete[\/][0-9]+$/i", $p)){

	include 'code/includes/member_security.php';

	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$id = (int)$temp[1];
		header('Location: ' . COMPANY_URL . 'code/includes/member_listing_delete.php?s=MOTORS&id=' . $id);
		exit();
	}
		
}else if(preg_match("/^my-motors-manage[\/]{0,1}[0-9]*$/i", $p)){

	include 'code/includes/member_security.php';

	$listing_id = 0;

	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}
	
	include TEMPLATES . 'my-motors-manage.php';
		
}else if(preg_match("/^my-recycle[\/]{0,1}[0-9]*[\-]{0,1}[0-9]*$/i", $p)){

	include 'code/includes/member_security.php';

	$page = 1;
	$search_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	

	$global_banner_page = 36;

	include TEMPLATES . 'my-recycle.php';
		
}else if(preg_match("/^my-recycle-delete[\/][0-9]+$/i", $p)){

	include 'code/includes/member_security.php';

	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$id = (int)$temp[1];
		header('Location: ' . COMPANY_URL . 'code/includes/member_listing_delete.php?s=RECYCLE&id=' . $id);
		exit();
	}
		
}else if(preg_match("/^my-recycle-manage[\/]{0,1}[0-9]*$/i", $p)){

	include 'code/includes/member_security.php';

	$listing_id = 0;

	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}
	
	include TEMPLATES . 'my-recycle-manage.php';
		
}else if(preg_match("/^my-jobs[\/]{0,1}[0-9]*[\-]{0,1}[0-9]*$/i", $p)){

	include 'code/includes/member_security.php';

	$page = 1;
	$search_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	

	$global_banner_page = 29;

	include TEMPLATES . 'my-jobs.php';
		
}else if(preg_match("/^my-jobs-delete[\/][0-9]+$/i", $p)){

	include 'code/includes/member_security.php';

	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$id = (int)$temp[1];
		header('Location: ' . COMPANY_URL . 'code/includes/member_listing_delete.php?s=JOBS&id=' . $id);
		exit();
	}
		
}else if(preg_match("/^my-jobs-manage[\/]{0,1}[0-9]*$/i", $p)){

	include 'code/includes/member_security.php';

	$listing_id = 0;

	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}
	
	include TEMPLATES . 'my-jobs-manage.php';
		
}else if(preg_match("/^my-directory[\/]{0,1}[0-9]*[\-]{0,1}[0-9]*$/i", $p)){

	include 'code/includes/member_security.php';

	$page = 1;
	$search_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	

	$global_banner_page = 37;

	include TEMPLATES . 'my-directory.php';
		
}else if(preg_match("/^my-directory-delete[\/][0-9]+$/i", $p)){

	include 'code/includes/member_security.php';

	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$id = (int)$temp[1];
		header('Location: ' . COMPANY_URL . 'code/includes/member_listing_delete.php?s=DIRECTORY&id=' . $id);
		exit();
	}
		
}else if(preg_match("/^my-directory-manage[\/]{0,1}[0-9]*$/i", $p)){

	include 'code/includes/member_security.php';

	$listing_id = 0;

	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}
	
	include TEMPLATES . 'my-directory-manage.php';
		
}else if(preg_match("/^my-restaurants[\/]{0,1}[0-9]*[\-]{0,1}[0-9]*$/i", $p)){

	include 'code/includes/member_security.php';

	$page = 1;
	$search_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	

	$global_banner_page = 38;

	include TEMPLATES . 'my-restaurants.php';
		
}else if(preg_match("/^my-restaurants-delete[\/][0-9]+$/i", $p)){

	include 'code/includes/member_security.php';

	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$id = (int)$temp[1];
		header('Location: ' . COMPANY_URL . 'code/includes/member_listing_delete.php?s=RESTAURANTS&id=' . $id);
		exit();
	}
		
}else if(preg_match("/^my-restaurants-manage[\/]{0,1}[0-9]*$/i", $p)){

	include 'code/includes/member_security.php';

	$listing_id = 0;

	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}
	
	include TEMPLATES . 'my-restaurants-manage.php';
		
}else if(preg_match("/^my-accommodation[\/]{0,1}[0-9]*[\-]{0,1}[0-9]*$/i", $p)){

	include 'code/includes/member_security.php';

	$page = 1;
	$search_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	

	$global_banner_page = 39;

	include TEMPLATES . 'my-accommodation.php';
		
}else if(preg_match("/^my-accommodation-delete[\/][0-9]+$/i", $p)){

	include 'code/includes/member_security.php';

	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$id = (int)$temp[1];
		header('Location: ' . COMPANY_URL . 'code/includes/member_listing_delete.php?s=ACCOMMODATION&id=' . $id);
		exit();
	}
		
}else if(preg_match("/^my-accommodation-manage[\/]{0,1}[0-9]*$/i", $p)){

	include 'code/includes/member_security.php';

	$listing_id = 0;

	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}
	
	include TEMPLATES . 'my-accommodation-manage.php';
		
}else if(preg_match("/^my-events[\/]{0,1}[0-9]*[\-]{0,1}[0-9]*$/i", $p)){

	include 'code/includes/member_security.php';

	$page = 1;
	$search_id = 0;
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$t = explode('-', $temp[1]);
		if(count($t) == 2){
			$page = (int)$t[0];
			$search_id = (int)$t[1];
		}else if(count($t) == 1){
			$page = (int)$t[0];
		}
	}
	

	$global_banner_page = 40;

	include TEMPLATES . 'my-events.php';
		
}else if(preg_match("/^my-events-delete[\/][0-9]+$/i", $p)){

	include 'code/includes/member_security.php';

	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$id = (int)$temp[1];
		header('Location: ' . COMPANY_URL . 'code/includes/member_listing_delete.php?s=EVENTS&id=' . $id);
		exit();
	}
		
}else if(preg_match("/^my-events-manage[\/]{0,1}[0-9]*$/i", $p)){

	include 'code/includes/member_security.php';

	$listing_id = 0;

	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = (int)$temp[1];
	}
	
	include TEMPLATES . 'my-events-manage.php';
		
}else if(preg_match("/^activate[\/][a-z0-9]{40}$/i", $p)){

	$listing_id = '';
	
	$temp = explode('/', $p);
	if(count($temp) >= 2){
		$listing_id = seo($temp[1]);
	}
	
	include 'code/includes/register_process.php';
	$status_title = 'Account Activation';
	$status_url = 'home';
	$status_msg = $process_result;
	
	$global_banner_page = 42;
	
	include TEMPLATES . 'member-process.php';
	
}else if(preg_match("/^forgotten-password-process[\/].*$/i", $p)){

	$action = '';
	$verify_code = '';

	$temp = explode('/', $p);
	if(count($temp) == 2){
		$action = safe_input($temp[1]);
	}else if(count($temp) == 3){
		$action = safe_input($temp[1]);
		$verify_code = safe_input($temp[2]);
	}
	
	include 'code/includes/forgot_password_process.php';
	$status_title = 'Forgot your Password?';
	$status_url = 'home';
	$status_msg = $pass_result;
	
	$global_banner_page = 42;
	
	include TEMPLATES . 'member-process.php';
	
}else if($p == '404'){
	
	$page_data = getPage(11, 'ID');
	$global_banner_page = 5;
	include TEMPLATES . '404.php';
	
}else if($p == 'logoff'){
	
	$_SESSION = array();
	session_regenerate_id();
	session_destroy();

	header('Location: ' . COMPANY_URL);
	exit();
	
}else{

	$page_data = getPage($p, 'SEO');
	
	if(!isset($page_data[0])){
		header('Location: ' . WEBSITE_ROOT . '404');
		exit();
	}
	
	//$mm_sel = $page_data[0];
	$global_banner_page = $page_data[9];
		
	include TEMPLATES . 'content.php';
	
}

?>