<?php if(!isset($caller)){exit('Direct access not allowed.');} ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title><?php echo $page_data[1]; ?> : <?php echo COMPANY_NAME; ?></title>
<?php include 'code/modules/head.php'; ?>
<?php include 'code/modules/head_carousel.php'; ?>
</head><?php include 'code/modules/body_tag.php'; ?>
<?php include 'code/modules/preload.php'; ?>
<?php include 'code/modules/peel.php'; ?>
<div id="container">
<?php include 'code/modules/login.php'; ?>
<?php include 'code/modules/emirates.php'; ?>
<?php include 'code/modules/menu.php'; ?>
<?php include 'code/modules/banners_top.php'; ?>
<?php include 'code/modules/quick_search.php'; ?>
<?php echo get_crumbs(array($page_data[1]), array($page_data[5])); ?>
<div class="leftside">
<div class="item">
<p class="header"><?php echo make_fancy($page_data[1]); ?></p>
<div class="middle">
<?php if(strlen($page_data[10]) > 0){echo $page_data[10];} ?>
<?php echo $page_data[2]; ?><br />&nbsp;<br />
</div>
<img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" />
</div>
</div>
<?php include 'code/modules/banners_right.php'; ?>
<div class="clear">&nbsp;</div>
<?php include 'code/modules/magadh_banner.php'; ?>
</div>
<?php include 'code/modules/footer.php'; ?>
</body></html>