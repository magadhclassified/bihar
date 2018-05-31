<?php if(!isset($is_caller)){exit('Direct access not allowed.');} ?><?php include 'code/includes/users_info.php'; ?><?php include 'code/includes/users_list.php'; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SYSTEM_NAME; ?>: System: Admin Accounts</title>
<?php include 'code/modules/head.php'; ?>
<?php include 'code/modules/head_extra.php'; ?>
</head>
<body>
<div id="wrapper">
<?php include 'code/modules/header.php'; ?>
<div id="content">
<div id="page">
<div class="inner">

<div class="section"><div class="title_wrapper"><h2>Admin Accounts</h2><span class="title_wrapper_left"></span><span class="title_wrapper_right"></span></div><div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<p>Manage your admin accounts below. Admin accounts have access to this admin panel and have permissions to manage the sections assigned to them. To add a new account, please click the ADD NEW button below.<br /><br />
<a href="users/add" class="button add_new"><span><span>ADD NEW</span></span></a><br />
</p>																															
</div></div></div></div></div><span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span></div></div>

<?php if($form_item_count > 0 && !$listing_form){ ?>
<div class="section table_section"><div class="title_wrapper">
<h2>Accounts</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span></div><div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">							<div  id="product_list"><div class="table_wrapper"><div class="table_wrapper_inner">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<th>Created</th>													
<th>Accounts</th>										
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
<h2>Account</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span>
</div>
<div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<form action="code/includes/users_manage.php" class="search_form general_form" method="post" id="webdev_form" onsubmit="return check_form(this, ['name', 'email'], ['TEXT', 'EMAIL']);">
<fieldset>
<div class="forms">
<div class="row"><label>Full Name:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="name" type="text" value="<?php echo $item_name; ?>" /></span>														
</div></div>		
<div class="row"><label>Email:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="email" type="text" value="<?php echo $item_email; ?>" /></span>														
</div></div>	
<div class="row"><label>Password:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="password" type="password" value="" /></span>
<span class="system neutral">Leave blank to retain current password</span>													
</div></div>	

<div class="row">
<label>Account Type:</label>
<div class="inputs"><ul class="inline">
<li><input class="radio" name="type" value="SUPERADMIN" onclick="permission_check('SUPERADMIN');" type="radio"<?php if($item_type == 'SUPERADMIN'){echo ' checked="checked"';} ?> />&nbsp;&nbsp;Super Administrator</li>
<li><input class="radio" name="type" value="ADMIN" onclick="permission_check('ADMIN');" type="radio"<?php if($item_type == 'ADMIN'){echo ' checked="checked"';} ?> />&nbsp;&nbsp;Administrator (Limited Permissions)</li>
</ul></div></div>

<div id="permissions_row" class="row"<?php if($item_type == 'SUPERADMIN'){echo ' style="display:none;"';} ?>>
<label>Permissions:</label>
<div class="inputs"><ul class="inline">
<?php echo $permissions_list; ?>
</ul></div></div>

<div class="row">
<label>Active?</label>
<div class="inputs">							
<ul class="inline">
<li><input class="checkbox" name="active" value="yes" type="checkbox"<?php if($item_active == 1){echo ' checked="checked"';} ?> />&nbsp;&nbsp;Tick this box to allow this admin to login</li>
</ul></div></div>
								
<div class="row"><div class="buttons">															
<ul><li><span class="button send_form_btn"><span><span>SAVE</span></span><input type="hidden" name="id" value="<?php echo $listing_id; ?>" /><input name="" type="submit" /></span></li></ul>															       
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