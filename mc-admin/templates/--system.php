<?php if(!isset($is_caller)){exit('Direct access not allowed.');} ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SYSTEM_NAME; ?>: System</title>
<?php include 'code/modules/head.php'; ?>
</head>
<body>
<div id="wrapper">
<?php include 'code/modules/header.php'; ?>
<div id="content">

<div id="page">
<div class="inner">
<div class="section">
<div class="title_wrapper">
<h2>System</h2>
<span class="title_wrapper_left"></span>
<span class="title_wrapper_right"></span>
</div>	
<div class="section_content">	
<div class="sct">
<div class="sct_left">
<div class="sct_right">
<div class="sct_left">
<div class="sct_right">					
<div class="dashboard_menu_wrapper">
<ul class="dashboard_menu">
<?php if(check_perms('users', $account_permissions)){ ?><li><a href="users" style="background-image:url(css/layout/site/dasboard_icons/users.png);"><span>Admin Accounts</span></a></li><?php } ?>
<?php if(check_perms('logs_security', $account_permissions)){ ?><li><a href="logs-security" style="background-image:url(css/layout/site/dasboard_icons/security.png);"><span>Security Logs</span></a></li><?php } ?>
<?php if(check_perms('logs_activity', $account_permissions)){ ?><li><a href="logs-activity" style="background-image:url(css/layout/site/dasboard_icons/activity.png);"><span>CMS Activity Logs</span></a></li><?php } ?>
<?php if(check_perms('settings', $account_permissions)){ ?><li><a href="settings" style="background-image:url(css/layout/site/dasboard_icons/settings.png);"><span>Settings</span></a></li><?php } ?>
</ul>
</div>										
</div>
</div>
</div>
</div>
</div>					
<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>				
</div>				
</div>			
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
