<?php if(!isset($is_caller)){exit('Direct access not allowed.');} ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SYSTEM_NAME; ?>: Dashboard</title>
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
<h2>Dashboard</h2>
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
<?php if(check_perms('content', $account_permissions)){ ?><li><a href="content" class="d5"><span>Content</span></a></li><?php } ?>
<?php if(check_perms('listings', $account_permissions)){ ?><li><a href="listings" style="background-image:url(css/layout/site/dasboard_icons/partners.png);"><span>Listings</span></a></li><?php } ?>
<?php if(check_perms('system', $account_permissions)){ ?><li><a href="system" class="d8"><span>System</span></a></li><?php } ?>
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

<div class="section">
<div class="title_wrapper">
<h2>Quick Statistics</h2>
<span class="title_wrapper_left"></span>
<span class="title_wrapper_right"></span>
</div>	
<div class="section_content">	
<div class="sct">
<div class="sct_left">
<div class="sct_right">
<div class="sct_left">
<div class="sct_right">		

<div id="graph_zone">Please wait while the graph loads. If the graph does not load, you may need to download the latest <a href="http://get.adobe.com/flashplayer/" onclick="return!window.open(this.href);">Flash plugin</a>.</div>			
<script type="text/javascript" src="code/scripts/swfobject.js"></script>
<script type="text/javascript">
// <![CDATA[
swfobject.embedSWF("charts/MSColumn3D.swf", "graph_zone", "645", "400", "8.0.0", false, {dataURL:"<?php echo urlencode('code/includes/xml_stats.php?' . time()); ?>"}, {quality: "high"}, false);
// ]]>
</script>		
								
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
