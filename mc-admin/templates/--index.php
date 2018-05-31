<?php if(!isset($is_caller)){exit('Direct access not allowed.');} ?><?php include 'code/includes/forgot_reset.php'; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SYSTEM_NAME; ?></title>
<?php include 'code/modules/head_login.php'; ?>
</head>
<body onload="$('#admin_form_1_u').focus();">
<!--[if !IE]>start wrapper<![endif]-->
<div id="wrapper">
<!--[if !IE]>start login wrapper<![endif]-->
<div id="login_wrapper">
<?php
if(isset($_SESSION['Login_Error'])){
	if($_SESSION['Login_Error'] == 'LOGIN'){
		echo '<div class="error"><div class="error_inner"><strong>Access Denied</strong> | <span>Invalid login details supplied!</span></div></div>';
	}else if($_SESSION['Login_Error'] == 'LOCKED'){
		echo '<div class="error"><div class="error_inner"><strong>Account Locked</strong> | <span>Please contact support!</span></div></div>';
	}
	$_SESSION['Login_Error'] = '';
}
if(strlen($p_data) > 0){
	switch($p_data){
		case 'notfound':
			echo '<div class="error"><div class="error_inner"><strong>Error</strong> | <span>Specified email not found!</span></div></div>';
			break;
		case 'error':
			echo '<div class="error"><div class="error_inner"><strong>Error</strong> | <span>Invalid token specified!</span></div></div>';
			break;
		case 'sent':
			echo '<div class="thanks"><div class="thanks_inner"><strong>Thank You</strong> | <span>Reset instructions have been sent!</span></div></div>';
			break;
		case 'reset':
			echo '<div class="thanks"><div class="thanks_inner"><strong>Thank You</strong> | <span>Reset complete! You may now login.</span></div></div>';
			break;
	}
}
?>
<!--[if !IE]>start login<![endif]-->
<form action="code/includes/login.php" method="post" id="admin_form_1">
<fieldset>
<h1 class="logo"><a href="login"><?php echo SYSTEM_NAME; ?></a></h1>
<div class="formular">
<div class="formular_inner">				
<label>
<strong>Email:</strong>
<span class="input_wrapper">
<input name="u" type="text" id="admin_form_1_u" value="<?php if(isset($_COOKIE['Remember_Username'])){echo $_COOKIE['Remember_Username'];} ?>" />
</span>
</label>
<label>
<strong>Password:</strong>
<span class="input_wrapper">
<input name="p" type="password" value="" />
</span>
</label>
<label class="inline">
<input class="checkbox" name="remember" type="checkbox" value="yes" />
Remember My Username
</label>								
<ul class="form_menu">
<li><span class="button"><span><span>Login</span></span><input type="submit" name=""/></span></li>				
<li><a href="#" onclick="$('#admin_form_1').hide();$('#admin_form_2').show();return false;"><span><span>Forgot Password</span></span></a></li>
</ul>				
</div>
</div>
</fieldset>
</form>

<form action="code/includes/forgot_password.php" method="post" id="admin_form_2" style="display:none;">
<fieldset>
<h1 class="logo"><a href="login"><?php echo SYSTEM_NAME; ?></a></h1>
<div class="formular">
<div class="formular_inner">				
<label>
<strong>Email:</strong>
<span class="input_wrapper">
<input name="u" type="text" value="" />
</span>
</label>
<label class="inline">
&nbsp;Enter your admin email above.
</label>								
<ul class="form_menu">
<li><span class="button"><span><span>Reset Password</span></span><input type="submit" name=""/></span></li>				
<li><a href="#" onclick="$('#admin_form_2').hide();$('#admin_form_1').show();return false;"><span><span>Login</span></span></a></li>
</ul>				
</div>
</div>
</fieldset>
</form>
<!--[if !IE]>end login<![endif]-->
</div>
<!--[if !IE]>end login wrapper<![endif]-->
</div>
<!--[if !IE]>end wrapper<![endif]-->
</body>
</html>