<?php if(!isset($is_caller)){exit('Direct access not allowed.');} ?><?php include 'code/includes/services_info.php'; ?><?php include 'code/includes/services_list.php'; ?><?php include 'code/includes/services_search_fields.php'; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SYSTEM_NAME; ?>: Listings: Services</title>
<?php include 'code/modules/head.php'; ?>
<?php include 'code/modules/head_extra.php'; ?>
</head>
<body>
<div id="wrapper">
<?php include 'code/modules/header.php'; ?>
<div id="content">
<div id="page">
<div class="inner">

<div class="section"><div class="title_wrapper"><h2>Services</h2><span class="title_wrapper_left"></span><span class="title_wrapper_right"></span></div><div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<?php if(isset($_SESSION['FormAction'])){if($_SESSION['FormAction'] == 'ERROR'){$_SESSION['FormAction']=''; ?> 
<ul class="system_messages"><li class="red"><span class="ico"></span><strong class="system_title">There was an error processing the selected image!</strong></li></ul>
<?php }} ?>
<p>Manage your Services listings below. To add a new listing, please click the ADD NEW button below.<br /><br />
<a href="services/add" class="button add_new"><span><span>ADD NEW</span></span></a><br />
</p>																															
</div></div></div></div></div><span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span></div></div>

<form action="code/includes/search_proxy.php" class="search_form general_form" method="post">
<div class="section"><div class="title_wrapper"><h2>Search Services</h2><span class="title_wrapper_left"></span><span class="title_wrapper_right"></span></div><div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<table style="width:660px;border:0px;" cellspacing="2" cellpadding="2">
  <tr>
    <td style="width:34%;"><input name="kw" type="text" class="text web_form_search_item" value="<?php if(strlen($search_data_kw) > 0){echo $search_data_kw;}else{echo 'Listing Title';} ?>" onfocus="if(this.value=='Listing Title'){this.value='';}" onblur="if(this.value==''){this.value='Listing Title';}" /></td>
    <td style="width:33%;"><?php echo $srch_order_listbox; ?></td>
	<td style="width:33%;"><?php echo $srch_sort_listbox; ?></td>
  </tr>
  <tr>
  <td><?php echo $srch_active_listbox; ?></td>
  <td>&nbsp;</td>
  <td style="text-align:right;padding-right:13px;"><input type="hidden" name="origin" value="SERVICES" /><input type="submit" value="Search" /></td>
  </tr>
</table>																															
</div></div></div></div></div><span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span></div></div>
</form>

<?php if($form_item_count > 0 && !$listing_form){ ?>
<div class="section table_section"><div class="title_wrapper">
<h2>Services<?php echo $result_title_append; ?></h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span></div><div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">							<div  id="product_list"><div class="table_wrapper"><div class="table_wrapper_inner">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<th>Created</th>	
<th>Title</th>																					
<th>Actions</th>
</tr>
<?php echo $form_item_data; ?>											
</tbody></table>
</div></div></div>
<?php echo $form_item_paging; ?>	
</div></div></div></div></div><span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span></div></div>
<?php }else if($form_item_count == 0 && !$listing_form){ ?>
<div class="section table_section"><div class="title_wrapper"><h2>Services<?php echo $result_title_append; ?></h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span></div><div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">							<div  id="product_list"><div class="table_wrapper"><div class="table_wrapper_inner">
<table cellpadding="0" cellspacing="0" width="100%"><tbody><tr class="first"><td>There are currently no listings available<?php echo $no_result_append; ?>.</td></tr></tbody></table>
</div></div></div></div></div></div></div></div><span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span></div></div>
<?php } ?>

<?php if($listing_form){ ?>
<form action="code/includes/services_manage.php" class="search_form general_form" method="post" enctype="multipart/form-data" id="webdev_form" onsubmit="return check_form(this, ['title', 'cat', 'geo1', 'geo2', 'member', 'contact_name', 'contact_number', 'contact_email'], ['TEXT', 'LISTBOX', 'LISTBOX', 'LISTBOX', 'LISTBOX','TEXT','TEXT', 'EMAIL']);">
<div class="section">
<div class="title_wrapper">
<h2>Services Details</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span>
</div>
<div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<fieldset>
<div class="forms">
<div class="row"><label>Title:</label>
<div class="inputs"><span class="input_wrapper huge_input"><input class="text" name="title" type="text" value="<?php echo $item_title; ?>" /></span>														
</div></div>		
<div class="row"><label>Category:</label><div class="inputs"><span class="input_wrapper blank">
<select name="cat">
<option value="0">Please Select...</option>
<?php echo $categories_listbox; ?>
</select></span></div></div>	
<div class="row"><label>Division:</label><div class="inputs"><span class="input_wrapper blank">
<select name="geo1" onchange="change_geo2(this.value);">
<option value="-1">Please Select...</option>
<?php echo $geo1_listbox; ?>
</select></span></div></div>
<div class="row"><label>SubDivision/Distict:</label><div class="inputs"><span class="input_wrapper blank" id="geo2_zone">
<select name="geo2" onchange="change_geo3(this.value);">
<option value="-1">Please Select...</option>
<?php echo $geo2_listbox; ?>
</select></span></div></div>
<div class="row"><label>Block/Town:</label><div class="inputs"><span class="input_wrapper blank" id="geo3_zone">
<select name="geo3">
<option value="-1">Please Select...</option>
<?php echo $geo3_listbox; ?>
</select></span><span class="system neutral">Optional</span></div></div>
<div class="row"><label>Physical Address:</label>
<div class="inputs"><span class="input_wrapper huge_input"><input class="text" name="physical" type="text" value="<?php echo $item_physical; ?>" /></span>														
</div></div>	
<div class="row"><label>Postal Address:</label>
<div class="inputs"><span class="input_wrapper huge_input"><input class="text" name="postal" type="text" value="<?php echo $item_postal; ?>" /></span>														
</div></div>	
<div class="row"><label>Telephone:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="tel" type="text" value="<?php echo $item_tel; ?>" /></span>														
</div></div>	
<div class="row"><label>Fax:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="fax" type="text" value="<?php echo $item_fax; ?>" /></span>														
</div></div>	
<div class="row"><label>Website:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="website" type="text" value="<?php echo $item_web; ?>" /></span>														
</div></div>	
</div>
</fieldset>																					
</div></div></div></div></div>					
<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>					
</div></div>

<div class="section">
<div class="title_wrapper">
<h2>Contact Details</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span>
</div>
<div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<fieldset>
<div class="forms">
<div class="row"><label>Profile / Member:</label><div class="inputs"><span class="input_wrapper blank">
<select name="member">
<option value="0">Please Select...</option>
<?php echo $members_listbox; ?>
</select></span></div></div>


<div class="row"><label>Contact Name:</label>
<div class="inputs"><span class="input_wrapper"><input type="text" name="contact_name" class="text" value="<?php echo $item_contact_name; ?>"></span>													
</div></div>

<div class="row"><label>Contact Number:</label>
<div class="inputs"><span class="input_wrapper"><input type="text" name="contact_number" class="text" value="<?php echo $item_contact_number; ?>"></span>												
</div></div>

<div class="row"><label>Contact Email:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="contact_email" type="text" value="<?php echo $item_contact_email; ?>" /></span><span class="system neutral">For enquiries</span>													
</div></div>	
<div class="row"><label>Map Latitude:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="lat" type="text" value="<?php echo $item_maps_lat; ?>" /></span><span class="system neutral">In decimal, e.g. 12.34567</span>
</div></div>
<div class="row"><label>Map Longitude:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="lng" type="text" value="<?php echo $item_maps_lng; ?>" /></span><span class="system neutral">In decimal, e.g. 12.34567</span>
</div></div>
</div>
</fieldset>																					
</div></div></div></div></div>					
<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>					
</div></div>

<div class="section">
<div class="title_wrapper">
<h2>Content</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span>
</div>
<div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<fieldset>
<div class="forms">
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

<div class="row"><label>Content Intro:</label><div class="inputs"><span class="input_wrapper textarea_wrapper_large"><textarea rows="" cols="" name="content_intro" class="text"><?php echo $item_contents_intro; ?></textarea></span></div></div>
<div class="row"><label>Content Full:</label><div class="inputs"><span class="input_wrapper textarea_wrapper_huge"><textarea rows="" cols="" name="content_full" class="text"><?php echo $item_contents; ?></textarea></span></div></div>

<div class="row"><label>Gallery:</label><div class="inputs"><span class="input_wrapper blank">
<select name="gallery">
<option value="0">No Gallery</option>
<?php echo $albums_listbox; ?>
</select></span></div></div>

<div class="row"><label>Image #1:</label>
<div class="inputs"><span class="input_wrapper blank"><input name="frm_upload1" type="file" /></span><?php if(strlen($item_image_file1) > 0){ ?><span class="system">&nbsp;&nbsp;&nbsp;[<a href="../files/directory/medium/<?php echo $item_image_file1; ?>" onclick="return!window.open(this.href);" title="header=[Preview] body=[&lt;img src='../files/directory/thumb/<?php echo $item_image_file1; ?>' alt='' title='' /&gt;]">Current</a>]</span><?php } ?></div>
</div>
</div>
</fieldset>																					
</div></div></div></div></div>					
<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>					
</div></div>

<div class="section">
<div class="title_wrapper">
<h2>Administrative Functions</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span>
</div>
<div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<fieldset>
<div class="forms">
<div class="row"><label>Featured?</label><div class="inputs"><ul class="inline"><li><input class="checkbox" name="featured" value="yes" type="checkbox"<?php if($item_featured == 1){echo ' checked="checked"';} ?> /></li></ul></div></div>
<div class="row"><label>Front Page?</label><div class="inputs"><ul class="inline"><li><input class="checkbox" name="fp" value="yes" type="checkbox"<?php if($item_fp == 1){echo ' checked="checked"';} ?> /></li></ul></div></div>
<div class="row"><label>Active?</label><div class="inputs"><ul class="inline"><li><input class="checkbox" name="active" value="yes" type="checkbox"<?php if($item_active == 1){echo ' checked="checked"';} ?> /></li></ul></div></div>
<div class="row"><div class="buttons">															
<ul><li><span class="button send_form_btn"><span><span>SAVE</span></span><input type="hidden" name="id" value="<?php echo $listing_id; ?>" /><input type="hidden" name="oldimg1" value="<?php echo $item_image_file1; ?>" /><input name="" type="submit" /></span></li></ul>															
</div></div></div>
</fieldset>																					
</div></div></div></div></div>					
<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>					
</div></div>
</form>		
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