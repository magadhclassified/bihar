<?php if(!isset($is_caller)){exit('Direct access not allowed.');} ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SYSTEM_NAME; ?>: Content: Promo Banners</title>
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
<h2>Promo Banners</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span>
</div>
<div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<?php if(isset($_SESSION['FormAction'])){if($_SESSION['FormAction'] == 'OK'){$_SESSION['FormAction']=''; ?> 
<ul class="system_messages"><li class="green"><span class="ico"></span><strong class="system_title">Your banners have been saved!</strong></li></ul>
<?php }} ?>
<?php if(isset($_SESSION['FormAction'])){if($_SESSION['FormAction'] == 'ERROR'){$_SESSION['FormAction']=''; ?> 
<ul class="system_messages"><li class="red"><span class="ico"></span><strong class="system_title">Your banners could not be saved!</strong></li></ul>
<?php }} ?>
<p>Manage your special promotional banners below. Please note that these banners are not resized automatically and should be uploaded in their intended size.</p>							
<form action="code/includes/promo_manage.php" class="search_form general_form" method="post" id="webdev_form" enctype="multipart/form-data">
<fieldset>
<div class="forms">												

<div class="row"><label>&nbsp;</label><div class="inputs"><ul class="inline"><li><input class="checkbox" name="ppenable" value="yes" type="checkbox"<?php if($global_admin_peel_enabled == 1){echo ' checked="checked"';} ?> />&nbsp;&nbsp;Enable Page Peel Banner</li></ul></div></div>

<div class="row"><label>Page Peel Link:</label>
<div class="inputs"><span class="input_wrapper huge_input"><input class="text" name="pplink" type="text" value="<?php echo $global_admin_peel_link; ?>" /></span>														
</div></div>	

<div class="row"><label>Page Peel Thumb:</label>
<div class="inputs"><span class="input_wrapper blank"><input name="frm_upload1" type="file" /></span><?php if(strlen($global_admin_peel_thumb) > 0){ ?><span class="system">&nbsp;&nbsp;&nbsp;[<a href="../files/promo/<?php echo $global_admin_peel_thumb; ?>" onclick="return!window.open(this.href);" title="header=[Preview] body=[&lt;img src='../files/promo/<?php echo $global_admin_peel_thumb; ?>' alt='' title='' /&gt;]">Current</a>]</span><?php } ?></div>
</div>

<div class="row"><label>Page Peel Image:</label>
<div class="inputs"><span class="input_wrapper blank"><input name="frm_upload2" type="file" /></span><?php if(strlen($global_admin_peel_image) > 0){ ?><span class="system">&nbsp;&nbsp;&nbsp;[<a href="../files/promo/<?php echo $global_admin_peel_image; ?>" onclick="return!window.open(this.href);" title="header=[Preview] body=[&lt;img src='../files/promo/<?php echo $global_admin_peel_image; ?>' alt='' title='' /&gt;]">Current</a>]</span><?php } ?></div>
</div>

<div class="row"><label>&nbsp;</label><div class="inputs"><ul class="inline"><li><input class="checkbox" name="bgenable" value="yes" type="checkbox"<?php if($global_admin_bg_enabled == 1){echo ' checked="checked"';} ?> />&nbsp;&nbsp;Enable Background Image</li></ul></div></div>

<div class="row"><label>Background Image:</label>
<div class="inputs"><span class="input_wrapper blank"><input name="frm_upload3" type="file" /></span><?php if(strlen($global_admin_bg_image) > 0){ ?><span class="system">&nbsp;&nbsp;&nbsp;[<a href="../files/promo/<?php echo $global_admin_bg_image; ?>" onclick="return!window.open(this.href);">Current</a>]</span><?php } ?></div>
</div>

<div class="row"><div class="buttons">															
<ul><li><span class="button send_form_btn"><span><span>SAVE SETTINGS</span></span><input name="" type="submit" />

<input type="hidden" name="oldimg1" value="<?php echo $global_admin_peel_thumb; ?>" />
<input type="hidden" name="oldimg2" value="<?php echo $global_admin_peel_image; ?>" />
<input type="hidden" name="oldimg3" value="<?php echo $global_admin_bg_image; ?>" />
</span></li></ul>															       
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