<?php if(!isset($is_caller)){exit('Direct access not allowed.');} ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SYSTEM_NAME; ?>: My Account</title>
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
<h2>My Account</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span>
</div>
<div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<?php if(isset($_SESSION['FormAction'])){if($_SESSION['FormAction'] == 'OK'){$_SESSION['FormAction']=''; ?> 
<ul class="system_messages"><li class="green"><span class="ico"></span><strong class="system_title">Your settings have been saved!</strong></li></ul>
<?php }} ?>
<?php if(isset($_SESSION['FormAction'])){if($_SESSION['FormAction'] == 'ERROR'){$_SESSION['FormAction']=''; ?> 
<ul class="system_messages"><li class="red"><span class="ico"></span><strong class="system_title">Your settings could not be saved!</strong></li></ul>
<?php }} ?>
<p>You may update your name and password using the form below.</p>							
<form action="code/includes/my_edit.php" class="search_form general_form" method="post">
<fieldset>
<div class="forms">
<div class="row"><label>Full Name:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="name" type="text" value="<?php echo $account_name; ?>" /></span>														
</div></div>												
<div class="row"><label>Password:</label>
<div class="inputs"><span class="input_wrapper"><input class="text" name="password" type="password" value="" /></span>
<span class="system neutral">Leave blank to retain current password</span>
</div></div>										
<div class="row"><div class="buttons">															
<ul><li><span class="button send_form_btn"><span><span>SAVE SETTINGS</span></span><input name="" type="submit" /></span></li></ul>															       
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