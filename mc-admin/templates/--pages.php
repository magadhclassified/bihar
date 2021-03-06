<?php if(!isset($is_caller)){exit('Direct access not allowed.');} ?><?php include 'code/includes/pages_info.php'; ?><?php include 'code/includes/pages_list.php'; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SYSTEM_NAME; ?>: Content: Pages</title>
<?php include 'code/modules/head.php'; ?>
<?php include 'code/modules/head_extra.php'; ?>
</head>
<body>
<div id="wrapper">
<?php include 'code/modules/header.php'; ?>
<div id="content">
<div id="page">
<div class="inner">

<div class="section"><div class="title_wrapper"><h2>Pages</h2><span class="title_wrapper_left"></span><span class="title_wrapper_right"></span></div><div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<?php if(isset($_SESSION['FormAction'])){if($_SESSION['FormAction'] == 'ERROR'){$_SESSION['FormAction']=''; ?> 
<ul class="system_messages"><li class="red"><span class="ico"></span><strong class="system_title">There was an error processing the selected image!</strong></li></ul>
<?php }} ?>
<p>Manage your current pages below. Please note that some pages are used for meta keywords and description data only. Assigned galleries will only display on specific content pages.<br />
</p>																															
</div></div></div></div></div><span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span></div></div>

<?php if($form_item_count > 0 && !$listing_form){ ?>
<div class="section table_section"><div class="title_wrapper">
<h2>Pages</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span></div><div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">							<div  id="product_list"><div class="table_wrapper"><div class="table_wrapper_inner">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<th>Edited</th>													
<th>Title</th>									
<th>Actions</th>
</tr>
<?php echo $form_item_data; ?>											
</tbody></table>
</div></div></div>
<?php echo $form_item_paging; ?>	
</div></div></div></div></div><span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span></div></div>
<?php } ?>

<?php if($listing_form){ ?>
<div class="section">
<div class="title_wrapper">
<h2>Page</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span>
</div>
<div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<form action="code/includes/pages_manage.php" class="search_form general_form" method="post" enctype="multipart/form-data" id="webdev_form" onsubmit="return check_form(this, ['title'], ['TEXT']);">
<fieldset>
<div class="forms">
<div class="row"><label>Page Title:</label>
<div class="inputs"><span class="input_wrapper huge_input"><input class="text" name="title" type="text" value="<?php echo $item_title; ?>" /></span>														
</div></div>		
<div class="row"><label>Seo Title:</label>
<div class="inputs"><span class="input_wrapper huge_input"><input class="text" name="seotitle" type="text" value="<?php echo $item_seotitle; ?>" /></span>														
</div></div>
	

<div class="row">
<label>Brief:</label>
<div class="inputs">
<span class="input_wrapper textarea_wrapper">
<textarea rows="" cols="" name="brief" class="text"><?php echo $item_brief; ?></textarea>
</span>
</div>
</div>

<div class="row"><label>Keywords:</label>
<div class="inputs"><span class="input_wrapper large_input"><input class="text" name="keywords" type="text" value="<?php echo $item_keywords; ?>" /></span><span class="system neutral">Comma separate keywords</span>
</div></div>

<?php if($can_edit_seo == 1){ ?>
<div class="row"><label>Page URL:</label>
<div class="inputs"><span class="input_wrapper large_input"><input class="text" name="seo" type="text" value="<?php echo $item_seo; ?>" /></span><span class="system neutral">Use valid URL naming conventions</span>														
</div></div>
<?php }else{ ?>
<input type="hidden" name="seo" value="<?php echo $item_seo; ?>" />
<?php } ?>

<div class="row"><label>Gallery:</label><div class="inputs"><span class="input_wrapper blank">
<select name="gallery">
<option value="0">No Gallery</option>
<?php echo $albums_listbox; ?>
</select></span></div></div>	

<div class="row">
<?php include 'code/includes/wysiwyg.php'; ?>
</div>	
					
<div class="row"><div class="buttons">															
<ul><li><span class="button send_form_btn"><span><span>SAVE</span></span><input type="hidden" name="id" value="<?php echo $listing_id; ?>" />
<input name="" type="submit" /></span></li></ul>															       
</div></div></div>
</fieldset>
</form>																										
</div></div></div></div></div>					
<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>					
</div></div>
<?php } ?>
			
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