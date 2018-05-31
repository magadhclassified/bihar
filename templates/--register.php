<?php if(!isset($caller)){exit('Direct access not allowed.');} ?><!DOCTYPE html>
<html lang="en">
  <head>
  <title><?php echo $page_data[11]; ?></title> 
    <?php include 'code/modules/head.php'; ?> 
  </head>
  <body>  
    <!-- Header Section Start -->
    <?php include 'code/modules/header.php'; ?> 
    <!-- Header Section End -->
    <!-- Page Header Start -->
    <?php include 'code/modules/titlebanner.php'; ?> 
    <!-- Page Header End --> 

    <!-- Content section Start --> 
    <section id="content">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="page-login-form">
             			
              <form role="form" class="login-form" method="post" onsubmit="return check_form(this, ['name', 'email', 'pass1', 'pass2', 'pass1-pass2'], ['TEXT', 'EMAIL', 'PASSWORD', 'PASSWORD', 'MATCH']);" action="code/includes/register.php" method="post">
			  
			  <div class="col-sm-6">
			  <div class="form-group">
                  <div class="input-icon">
                    <i class="icon fa fa-user"></i>
                    <input type="text" id="sender-email" class="form-control" name="name" placeholder="Full Name">
                  </div>
                </div> 
				</div>
				<div class="col-sm-6">
				<div class="form-group">
                  <div class="input-icon">
                    <i class="icon fa fa-user"></i>
                    <input type="text" id="sender-email" class="form-control" name="company" placeholder="Company">
                  </div>
                </div>
			</div>				
				<div class="col-sm-6">
                <div class="form-group">
                  <div class="input-icon">
                    <i class="icon fa fa-user"></i>
                    <input type="text" id="sender-email" class="form-control" name="email" placeholder="Email">
                  </div>
                </div>
				</div> 
				<div class="col-sm-6">
				   <div class="form-group">
                  <div class="input-icon">
                    <i class="icon fa fa-unlock-alt"></i>
                    <input type="password" class="form-control" name="pass1" placeholder="Password">
                  </div>
                </div>
				</div>  
				<div class="col-sm-6">
				   <div class="form-group">
                  <div class="input-icon">
                    <i class="icon fa fa-unlock-alt"></i>
                    <input type="password" class="form-control" name="pass2" placeholder="Retype Password">
                  </div>
                </div>
				</div> 
				<div class="col-sm-6">				
                <div class="form-group">
                  <div class="input-icon">
                    <i class="fa fa-address-book"></i>
                    <input type="text" id="sender-email" class="form-control" name="address" placeholder="Address">
                  </div>
                </div>
				</div>
				<div class="col-sm-6">
				 <div class="form-group">
                  <div class="input-icon">
                    <i class="fa fa-volume-control-phone"></i>
                    <input type="text" id="sender-email" class="form-control" name="tel" placeholder="Contact Number">
                  </div>
                </div>
				</div>
				<div class="col-sm-6">
				 <div class="form-group">
                  <div class="input-icon">
                    <i class="icon fa fa-envelope"></i>
                    <input type="text" id="sender-email" class="form-control" name="fax" placeholder="Fax">
                  </div>
                </div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
                  <div class="input-icon">
                    <i class="icon fa fa-envelope"></i>
                    <input type="text" id="sender-email" class="form-control" name="website" placeholder="Website">
                  </div>
                </div> 
             </div>
                <div class="col-sm-6">          
                <div class="checkbox">
                  <input type="checkbox" id="remember" name="rememberme" value="forever" style="float: left;">
                  <label for="remember">By creating account you agree to our Terms & Conditions</label>
                </div>
				</div>
				<div class="col-sm-6" style="float: right;margin-top:10px;" > 
                <button class="btn btn-common log-btn">Register</button>
				</div>
				<div class="col-sm-6"> 
				<a href="auth-facebook" class="btn btn-common log-btn facebook"  alt="Sign in with Facebook" title="Sign in with Facebook"><i class="fa fa-facebook"></i> Login With Facebook<div class="ripple-container"></div></a>
				</div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Content section End --> 

    
    <!-- Footer Section Start -->
    <footer>
    	<!-- Footer Area Start -->
    	<?php include 'code/modules/footer.php'; ?>
    	<!-- Footer area End -->
    	<!-- Copyright-social Start  -->
    	<?php include 'code/modules/social.php'; ?>
    	<!-- Copyright End -->
    </footer>
    <!-- Footer Section End -->  
	<?php include 'code/modules/footerjs.php'; ?>
  </body>
</html>