<?php if(!isset($is_caller)){exit('Direct access not allowed.');} ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SYSTEM_NAME; ?>: Listings</title>
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
<h2>Listings</h2>
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

<?php if(check_perms('accommodation', $account_permissions)){ ?><li><a href="accommodation" style="background-image:url(css/layout/site/dasboard_icons/d11.gif);"><span>Accommodation</span></a></li><?php } ?>
<?php if(check_perms('directory', $account_permissions)){ ?><li><a href="directory" style="background-image:url(css/layout/site/dasboard_icons/dir.png);"><span>Directory</span></a></li><?php } ?>
<?php if(check_perms('events', $account_permissions)){ ?><li><a href="events" style="background-image:url(css/layout/site/dasboard_icons/events.png);"><span>Events</span></a></li><?php } ?>
<?php if(check_perms('jobs', $account_permissions)){ ?><li><a href="jobs" style="background-image:url(css/layout/site/dasboard_icons/vacancies.png);"><span>Jobs</span></a></li><?php } ?>
<?php if(check_perms('motors', $account_permissions)){ ?><li><a href="motors" style="background-image:url(css/layout/site/dasboard_icons/forms.png);"><span>Motors</span></a></li><?php } ?>
<?php if(check_perms('properties', $account_permissions)){ ?><li><a href="properties" style="background-image:url(css/layout/site/dasboard_icons/d7.gif);"><span>Properties</span></a></li><?php } ?>
<?php if(check_perms('recycle', $account_permissions)){ ?><li><a href="recycle" style="background-image:url(css/layout/site/dasboard_icons/classifieds.png);"><span>Recycle</span></a></li><?php } ?>
<?php if(check_perms('restaurants', $account_permissions)){ ?><li><a href="restaurants" style="background-image:url(css/layout/site/dasboard_icons/boardroom.png);"><span>Restaurants</span></a></li><?php } ?>
<?php if(check_perms('services', $account_permissions)){ ?><li><a href="services" style="background-image:url(css/layout/site/dasboard_icons/economics.png);"><span>Services</span></a></li><?php } ?>
<?php if(check_perms('locations', $account_permissions)){ ?><li><a href="locations" style="background-image:url(css/layout/site/dasboard_icons/subsites.png);"><span>Locations</span></a></li><?php } ?>
<?php if(check_perms('profiles', $account_permissions)){ ?><li><a href="profiles" style="background-image:url(css/layout/site/dasboard_icons/accounts.png);"><span>Profiles</span></a></li><?php } ?>

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
