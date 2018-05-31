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
		
		<?php //echo get_crumbs(array($page_data[1]), array($page_data[5])); ?>
		
          <div class="col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-0">
            <div class="page-login-form box">
              <h3>
                <?php echo make_fancy($page_data[1]); ?>
              </h3>
            
				 <?php echo $page_data[2]; ?>
			
            </div>
          </div>
		  
		   <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-0">
            <div class="page-login-form box">
             
            
				<?php include 'code/modules/banners_right.php'; ?>
<div class="clear">&nbsp;</div>
<?php include 'code/modules/magadh_banner.php'; ?>
			
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