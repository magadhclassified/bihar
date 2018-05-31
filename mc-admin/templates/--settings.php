<?php if(!isset($is_caller)){exit('Direct access not allowed.');} ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SYSTEM_NAME; ?>: System: Settings</title>
<?php include 'code/modules/head.php'; ?>
<?php include 'code/modules/head_extra.php'; ?>
</head>
<body>
<div id="wrapper">
<?php include 'code/modules/header.php'; ?>
<div id="content">
<div id="page">
<div class="inner">

<div class="section">
<div class="title_wrapper">
<h2>Contact Settings</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span>
</div>
<div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<?php if(isset($_SESSION['FormAction'])){if($_SESSION['FormAction'] == 'OK'){$_SESSION['FormAction']=''; ?> 
<ul class="system_messages"><li class="green"><span class="ico"></span><strong class="system_title">Your settings have been saved!</strong></li></ul>
<?php }} ?>
<?php if(isset($_SESSION['FormAction'])){if($_SESSION['FormAction'] == 'ERROR'){$_SESSION['FormAction']=''; ?> 
<ul class="system_messages"><li class="red"><span class="ico"></span><strong class="system_title">Your settings could not be saved!</strong></li></ul>
<?php }} ?>
<p>Please complete the settings below to be used for the feedback form on the website.</p>							
<form action="code/includes/settings_contact_edit.php" class="search_form general_form" method="post" id="webdev_form" onsubmit="return check_form(this, ['feedback'], ['EMAIL']);">
<fieldset>
<div class="forms">												
<div class="row"><label>Feedback Email:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="feedback" type="text" value="<?php echo $global_admin_email_feed; ?>" /></span>
<span class="system neutral">Recipient for website feedback</span>
</div></div>	
<div class="row"><div class="buttons">															
<ul><li><span class="button send_form_btn"><span><span>SAVE SETTINGS</span></span><input name="" type="submit" /></span></li></ul>															       
</div></div></div>
</fieldset>
</form>																										
</div></div></div></div></div>					
<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>					
</div></div>

























<div class="section">
<div class="title_wrapper">
<h2>Google Settings</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span>
</div>
<div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<p>Please enter the relevant Google options below.</p>							
<form action="code/includes/settings_google_edit.php" class="search_form general_form" method="post" id="webdev_form1">
<fieldset>
<div class="forms">												
<div class="row"><label>GA UA Code:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="ga" type="text" value="<?php echo $global_admin_google_ga; ?>" /></span>
<span class="system neutral">E.g. UA-1234567-8</span>
</div></div>	
<div class="row"><label>Webmaster Tools:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="wt" type="text" value="<?php echo $global_admin_google_wt; ?>" /></span>
<span class="system neutral">Unique WT String</span>
</div></div>
<div class="row"><label>Maps API Key:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="maps" type="text" value="<?php echo $global_admin_google_maps_api; ?>" /></span>
<span class="system neutral">Google Maps API Key</span>
</div></div>
<div class="row"><label>Map Latitude:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="lat" type="text" value="<?php echo $global_admin_google_maps_lat; ?>" /></span>
</div></div>
<div class="row"><label>Map Longitude:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="lng" type="text" value="<?php echo $global_admin_google_maps_lng; ?>" /></span>
</div></div>
<div class="row"><label>Map Zoom:</label><div class="inputs"><span class="input_wrapper blank">
<select name="zoom">
<?php
for($i=1; $i<20; $i++){
	if($global_admin_google_maps_zoom == $i){
		echo '<option value="' . $i . '" selected="selected">' . $i . '</option>';
	}else{
		echo '<option value="' . $i . '">' . $i . '</option>';
	}
}
?>
</select></span><span class="system neutral">Higher value means more zoomed in</span></div></div>									
<div class="row"><div class="buttons">															
<ul><li><span class="button send_form_btn"><span><span>SAVE SETTINGS</span></span><input name="" type="submit" /></span></li></ul>															       
</div></div></div>
</fieldset>
</form>																										
</div></div></div></div></div>					
<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>					
</div></div>









<div class="section">
<div class="title_wrapper">
<h2>Social Networking Settings</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span>
</div>
<div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<p>Please enter the relevant social networking options below.</p>							
<form action="code/includes/settings_social_edit.php" class="search_form general_form" method="post" id="webdev_form1" onsubmit="return check_form(this, ['lat', 'long'], ['TEXT', 'TEXT']);">
<fieldset>
<div class="forms">												
<div class="row"><label>Facebook URL:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="fburl" type="text" value="<?php echo $global_admin_fb_link; ?>" /></span>
<span class="system neutral">Facebook Group/Page URL</span>
</div></div>	
<div class="row"><label>Facebook App ID:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="fbappid" type="text" value="<?php echo $global_admin_fb_appid; ?>" /></span>
<span class="system neutral">Facebook Application ID</span>
</div></div>
<div class="row"><label>Twitter URL:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="twurl" type="text" value="<?php echo $global_admin_twitter_link; ?>" /></span>
<span class="system neutral">Twitter Profile URL</span>
</div></div>		
<div class="row"><label>AddThis User:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="addthisusername" type="text" value="<?php echo $global_admin_addthis_username; ?>" /></span>
<span class="system neutral">AddThis Username for Stats</span>
</div></div>									
<div class="row"><div class="buttons">															
<ul><li><span class="button send_form_btn"><span><span>SAVE SETTINGS</span></span><input name="" type="submit" /></span></li></ul>															       
</div></div></div>
</fieldset>
</form>																										
</div></div></div></div></div>					
<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>					
</div></div>




<div class="section">
<div class="title_wrapper">
<h2>Extra Code</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span>
</div>
<div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<p>If you have extra code you want to appear in the header or footer of every page you may enter this code below.</p>							
<form action="code/includes/settings_code_edit.php" class="search_form general_form" method="post" id="webdev_form1">
<fieldset>
<div class="forms">												
<div class="row"><label>Head Code:</label><div class="inputs"><span class="input_wrapper textarea_wrapper"><textarea rows="" cols="" name="head" class="text"><?php echo $global_admin_code_head; ?></textarea></span></div></div>
<div class="row"><label>Footer Code:</label><div class="inputs"><span class="input_wrapper textarea_wrapper"><textarea rows="" cols="" name="footer" class="text"><?php echo $global_admin_code_footer; ?></textarea></span></div></div>				
<div class="row"><div class="buttons">															
<ul><li><span class="button send_form_btn"><span><span>SAVE SETTINGS</span></span><input name="" type="submit" /></span></li></ul>															       
</div></div></div>
</fieldset>
</form>																										
</div></div></div></div></div>					
<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>					
</div></div>





<div class="section">
<div class="title_wrapper">
<h2>Transact Safely Text</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span>
</div>
<div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<p>The Transact Safely warning visible on all enquiry forms on the website.</p>							
<form action="code/includes/settings_safe_edit.php" class="search_form general_form" method="post" id="webdev_form1">
<fieldset>
<div class="forms">												
<div class="row"><label>Text:</label><div class="inputs"><span class="input_wrapper textarea_wrapper"><textarea rows="" cols="" name="safe" class="text"><?php echo $global_admin_safesurf_text; ?></textarea></span></div></div>			
<div class="row"><div class="buttons">															
<ul><li><span class="button send_form_btn"><span><span>SAVE SETTINGS</span></span><input name="" type="submit" /></span></li></ul>															       
</div></div></div>
</fieldset>
</form>																										
</div></div></div></div></div>					
<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>					
</div></div>


		
</div>
</div>
<div id="sidebar">
<div class="inner">
<?php include 'code/modules/side_menu.php'; ?>
<?php include 'code/modules/side_quick.php'; ?>
</div>
</div>
</div>
</div>
<?php include 'code/modules/footer.php'; ?>
</body>
</html>