<?php if(!isset($caller)){exit('Direct access not allowed.');} ?>
<?php include 'code/includes/events_list.php'; ?>
<?php include 'code/includes/events_featured.php'; ?>
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
    <!-- Search wrapper Start -->
    <div id="search-row-wrapper">
      <div class="container">
        <div class="search-inner">
            <!-- Start Search box -->
              <?php include 'code/modules/quick_events_search.php'; ?>
            <!-- End Search box -->
        </div>
      </div>
    </div>
    <!-- Search wrapper End -->  

    <!-- Main container Start -->  
    <div class="main-container">
     <div class="container">
        <div class="row">
          <div class="col-sm-3 page-sidebar">
            <?php include 'code/modules/search-result-leftpanel.php'; ?> 
          </div>
          <div class="col-sm-9 page-content">
            <!-- Product filter Start -->
            <div class="product-filter">
              <div class="grid-list-count">
                <a href="#" class="list switchToGrid"><i class="fa fa-list"></i></a>
                <a href="#" class="grid switchToList"><i class="fa fa-th-large"></i></a>
              </div>
            
            </div>
            <!-- Product filter End -->

            <!-- Adds wrapper Start -->
			
			 <div class="adds-wrapper">
             <?php if(strlen($featured_listings) > 0){echo $featured_listings;} ?>
            </div>
			
			<?php include 'code/modules/post-your-ad-banner.php'; ?>
			
            <div class="adds-wrapper">
			<div class="widget-title">
                  <h4>Listings</h4></div>
            <?php echo $finalString?> 
            </div>
            <!-- Adds wrapper End -->
            
            <!-- Start Pagination -->
            <?php echo $finalPaging;?>
            <!-- End Pagination -->

           
          </div>
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