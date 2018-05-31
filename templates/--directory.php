<?php if(!isset($caller)){exit('Direct access not allowed.');} ?>
<?php include 'code/includes/directory_list.php'; ?>
<?php include 'code/includes/directory_featured.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <title><?php echo $page_data[11]; ?></title> 
    <?php include 'code/modules/head.php'; ?> 
  </head>
  <body>  
    <!-- Header Section Start -->
	<?php include 'code/modules/header.php'; ?> 
    <!-- Header Section End -->

    <!-- Main container Start -->  
  <div class="main-container">
  <div class="container">
  <div class="col-sm-9 page-content">
			<div class="adds-wrapper">
             <?php if(strlen($featured_listings) > 0){echo $featured_listings;} ?>
            </div>
  </div>
  
  
          <div class="row">
            <div class="col-md-12">
              <h3 class="section-title">Browse Ads from 33 Categories</h3>
            </div>  

				<?php echo $landing_dir_cat_list; ?>
			
           
          </div>
        </div>	
      </div>
    
    <!-- Main container End -->  

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