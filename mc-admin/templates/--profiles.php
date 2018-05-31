<?php if(!isset($is_caller)){exit('Direct access not allowed.');} ?><?php include 'code/includes/profiles_info.php'; ?><?php include 'code/includes/profiles_list.php'; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SYSTEM_NAME; ?>: Listings: Profiles</title>
<?php include 'code/modules/head.php'; ?>
<?php include 'code/modules/head_extra.php'; ?>
</head>
<body>
<div id="wrapper">
<?php include 'code/modules/header.php'; ?>
<div id="content">
<div id="page">
<div class="inner">

<div class="section"><div class="title_wrapper"><h2>Profiles</h2><span class="title_wrapper_left"></span><span class="title_wrapper_right"></span></div><div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<?php if(isset($_SESSION['FormAction'])){if($_SESSION['FormAction'] == 'ERROR'){$_SESSION['FormAction']=''; ?> 
<ul class="system_messages"><li class="red"><span class="ico"></span><strong class="system_title">There was an error processing the selected image!</strong></li></ul>
<?php }} ?>
<p>Manage your current profiles below. <br /><br />
<a href="profiles/add" class="button add_new"><span><span>ADD NEW</span></span></a><br />
</p>																															
</div></div></div></div></div><span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span></div></div>

<?php if($form_item_count > 0 && !$listing_form){ ?>
<div class="section table_section"><div class="title_wrapper">
<h2>Profiles</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span></div><div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">							<div  id="product_list"><div class="table_wrapper"><div class="table_wrapper_inner">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<th>Created</th>													
<th>Contact Name</th>	
<th>Company Name</th>	
<th>Member Type</th>									
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
<h2>Profile</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span>
</div>
<div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<form action="code/includes/profiles_manage.php" class="search_form general_form" method="post" id="webdev_form" enctype="multipart/form-data" onsubmit="return check_form(this, ['name', 'email'], ['TEXT', 'EMAIL']);">
<fieldset>
<div class="forms">
<div class="row"><label>Contact Person:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="name" type="text" value="<?php echo $item_name; ?>" /></span>														
</div></div>	
<div class="row"><label>Email Address:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="email" type="text" value="<?php echo $item_email; ?>" /></span>														
</div></div>	
<div class="row"><label>Company Name:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="company" type="text" value="<?php echo $item_company; ?>" /></span>														
</div></div>
<div class="row"><label>Address:</label>
<div class="inputs"><span class="input_wrapper huge_input"><input class="text" name="address" type="text" value="<?php echo $item_address; ?>" /></span>														
</div></div>	
<div class="row"><label>Telephone:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="tel" type="text" value="<?php echo $item_tel; ?>" /></span>														
</div></div>
<div class="row"><label>Fax:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="fax" type="text" value="<?php echo $item_fax; ?>" /></span>														
</div></div>
<div class="row"><label>Website:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="website" type="text" value="<?php echo $item_website; ?>" /></span>														
</div></div>

<div class="row"><label>Logo Image:</label>
<div class="inputs"><span class="input_wrapper blank"><input name="frm_upload1" type="file" /></span><?php if(strlen($item_image_file) > 0){ ?><span class="system">&nbsp;&nbsp;&nbsp;[<a href="../files/profiles/<?php echo $item_image_file; ?>" onclick="return!window.open(this.href);" title="header=[Preview] body=[&lt;img src='../files/profiles/<?php echo $item_image_file; ?>' alt='' title='' /&gt;]">Current</a>]</span><?php } ?></div>
</div>

<div class="row"><label>Password:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="password" type="password" value="" /></span>
<span class="system neutral">Leave blank to retain current password</span>													
</div></div>	

<div class="row">
<label>Active?</label>
<div class="inputs">							
<ul class="inline">
<li><input class="checkbox" name="active" value="yes" type="checkbox"<?php if($item_active == 1){echo ' checked="checked"';} ?> /></li>
</ul></div></div>
					
<div class="row"><div class="buttons">															
<ul><li><span class="button send_form_btn"><span><span>SAVE</span></span><input type="hidden" name="id" value="<?php echo $listing_id; ?>" /><input type="hidden" name="oldimg1" value="<?php echo $item_image_file; ?>" /><input name="" type="submit" /></span></li></ul>															       
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