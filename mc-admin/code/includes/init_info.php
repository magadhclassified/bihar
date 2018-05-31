<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$sqlquery = mysql_query('SELECT * FROM settings WHERE id=1');
while($row = mysql_fetch_array($sqlquery)){ 
	$global_admin_email_feed = filter_out($row['email_feedback']);
	$global_admin_google_ga = filter_out($row['google_analytics']);
	$global_admin_google_wt = filter_out($row['google_webmaster_tools']);
	$global_admin_google_maps_api = filter_out($row['google_maps_api']);
	$global_admin_google_maps_zoom = filter_out($row['google_maps_zoom']);
	$global_admin_google_maps_lat = filter_out($row['google_maps_lat']);
	$global_admin_google_maps_lng = filter_out($row['google_maps_lng']);
	$global_admin_fb_link = filter_out($row['facebook_link']);
	$global_admin_twitter_link = filter_out($row['twitter_link']);
	$global_admin_code_head = filter_out($row['code_head']);
	$global_admin_code_footer = filter_out($row['code_footer']);
	$global_admin_fb_appid = filter_out($row['facebook_app_id']);
	$global_admin_addthis_username = filter_out($row['addthis_username']);
	$global_admin_peel_enabled = filter_out($row['peel_enabled']);
	$global_admin_peel_thumb = filter_out($row['peel_image_thumb']);
	$global_admin_peel_image = filter_out($row['peel_image']);
	$global_admin_peel_link = filter_out($row['peel_link']);
	$global_admin_bg_enabled = filter_out($row['bg_enabled']);
	$global_admin_bg_image = filter_out($row['bg_image']);
	$global_admin_safesurf_text = filter_out($row['surf_safe_text']);
}

?>