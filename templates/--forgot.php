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
          <div class="col-sm-6 col-sm-offset-4 col-md-4 col-md-offset-4">
            <div class="page-login-form box">
              <h3>
                Forgot Password
              </h3>
			  

             <form method="post" action="code/includes/forgot_password.php" onsubmit="return check_form(this, ['email'], ['EMAIL']);">
			 	<?php if(isset($_SESSION['Form_Forgot'])){ ?>
<p class="popfield dropfield" style="color:#FF0000;"><?php echo $_SESSION['Form_Forgot']; ?><br />&nbsp;</p><div class="clear">&nbsp;</div>
<?php unset($_SESSION['Form_Forgot']);}else{ ?>
                <div class="form-group">
                  <div class="input-icon">
                    <i class="icon fa fa-user"></i>
                   <input type="text" id="sender-email" class="form-control" name="form_email" value="" placeholder="Email"/>
                  </div>
                </div> 
			<?php } ?>	
               <input type="submit" class="btn btn-common log-btn" value="Submit" />
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