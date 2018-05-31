<?php if(!isset($is_caller)){die('Restricted access.');} ?>
<div id="head">
<div id="logo_user_details">
<h1 id="logo"><a href="dashboard" title="Dashboard"><?php echo SYSTEM_NAME; ?></a></h1>
<div id="user_details">
<ul id="user_details_menu">
<li>Welcome, <strong><?php echo $account_first_name; ?></strong></li>
<li>
<ul id="user_access">
<li class="first"><a href="my">My Account</a></li>
<li class="last"><a href="logout">Log Out</a></li>
</ul>
</li>
</ul>
<div id="server_details">
<dl>
<dt>Server Time:</dt>
<dd><?php echo date('H:i A'); ?></dd>
</dl>
<dl>
<dt>Logged In IP:</dt>
<dd><?php echo get_the_ip(); ?></dd>
</dl>
</div>		
</div>
</div>
<div id="menus_wrapper">
<div id="main_menu">
<ul>
<li><a href="dashboard"<?php if($menu_selected == 'DASHBOARD'){echo ' class="selected"';} ?>><span><span>Dashboard</span></span></a></li>
<?php if(check_perms('content', $account_permissions)){ ?><li><a href="content"<?php if($menu_selected == 'CONTENT'){echo ' class="selected"';} ?>><span><span>Content</span></span></a></li><?php } ?>
<?php if(check_perms('listings', $account_permissions)){ ?><li><a href="listings"<?php if($menu_selected == 'LISTINGS'){echo ' class="selected"';} ?>><span><span>Listings</span></span></a></li><?php } ?>
<?php if(check_perms('system', $account_permissions)){ ?><li class="last"><a href="system"<?php if($menu_selected == 'SYSTEM'){echo ' class="selected"';} ?>><span><span>System</span></span></a></li><?php } ?>
</ul>
</div>
<div id="sec_menu">
<ul>
<?php if($menu_selected == 'DASHBOARD'){ ?>
<li><a href="dashboard" class="sm5">Home</a></li>
<li><a href="my" class="sm5">My Account</a></li>
<li><a href="logout" class="sm5">Log Out</a></li>	
<?php } ?>		
<?php if($menu_selected == 'LISTINGS'){ ?>
<?php if(check_perms('accommodation', $account_permissions)){ ?><li><a href="accommodation" class="sm5">Accommodation</a></li><?php } ?>
<?php if(check_perms('directory', $account_permissions)){ ?><li><a href="directory" class="sm5">Directory</a></li><?php } ?>
<?php if(check_perms('events', $account_permissions)){ ?><li><a href="events" class="sm5">Events</a></li><?php } ?>
<?php if(check_perms('jobs', $account_permissions)){ ?><li><a href="jobs" class="sm5">Jobs</a></li><?php } ?>
<?php if(check_perms('motors', $account_permissions)){ ?><li><a href="motors" class="sm5">Motors</a></li><?php } ?>
<?php if(check_perms('properties', $account_permissions)){ ?><li><a href="properties" class="sm5">Properties</a></li><?php } ?>
<?php if(check_perms('recycle', $account_permissions)){ ?><li><a href="recycle" class="sm5">Recycle</a></li><?php } ?>
<?php if(check_perms('restaurants', $account_permissions)){ ?><li><a href="restaurants" class="sm5">Restaurants</a></li><?php } ?>
<?php if(check_perms('services', $account_permissions)){ ?><li><a href="services" class="sm5">Services</a></li><?php } ?>
<?php if(check_perms('locations', $account_permissions)){ ?><li><a href="locations" class="sm5">Locations</a></li><?php } ?>
<?php if(check_perms('profiles', $account_permissions)){ ?><li><a href="profiles" class="sm5">Profiles</a></li><?php } ?>
<?php } ?>		
<?php if($menu_selected == 'CONTENT'){ ?>
<?php if(check_perms('pages', $account_permissions)){ ?><li><a href="pages" class="sm5">Pages</a></li><?php } ?>
<?php if(check_perms('faqs', $account_permissions)){ ?><li><a href="faqs" class="sm5">FAQs</a></li><?php } ?>
<?php if(check_perms('banners', $account_permissions)){ ?><li><a href="banners" class="sm5">Banners</a></li><?php } ?>
<?php if(check_perms('promo', $account_permissions)){ ?><li><a href="promo" class="sm5">Promo Banners</a></li><?php } ?>
<?php if(check_perms('gallery', $account_permissions)){ ?><li><a href="gallery" class="sm5">Gallery</a></li><?php } ?>
<?php } ?>	
<?php if($menu_selected == 'SYSTEM'){ ?>
<?php if(check_perms('users', $account_permissions)){ ?><li><a href="users" class="sm5">Admin Accounts</a></li><?php } ?>
<?php if(check_perms('logs_security', $account_permissions)){ ?><li><a href="logs-security" class="sm5">Security Logs</a></li><?php } ?>
<?php if(check_perms('logs_activity', $account_permissions)){ ?><li><a href="logs-activity" class="sm5">CMS Activity Logs</a></li><?php } ?>
<?php if(check_perms('settings', $account_permissions)){ ?><li><a href="settings" class="sm5">Settings</a></li><?php } ?>
<?php } ?>	
</ul>
</div>
</div>
</div>