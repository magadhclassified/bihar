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
    <!-- Start header banner section -->
    <?php include 'code/modules/searchbanner.php'; ?> 
    <!-- end header banner section -->
    <div class="wrapper">
      <!-- Categories Homepage Section Start -->
	<section id="categories-homepage">
	<div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="box-title no-border">
                <div class="inner">
                  <h3 class="section-title"><span>Browse by</span> Category</h3>   
                  <a href="/directory" class="sell-your-item"><i class="fa fa-th-large"></i> View more 
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-12">   

			  <div style="visibility: visible;-webkit-animation-delay: 1s; -moz-animation-delay: 1s; animation-delay: 1s;" class="col-md-2 col-sm-3 col-xs-6 f-category wow fadeIn animated animated" data-wow-delay="1s">
                <a href="/property">
                  <div class="icon-img">
                    <img src="graphics/category/img-6.png" class="img-responsive" alt="img">
                  </div> 
                  <h6>Real Estate</h6> 
                </a>
              </div>
				<div style="visibility: visible;-webkit-animation-delay: 2s; -moz-animation-delay: 2s; animation-delay: 2s;" class="col-md-2 col-sm-3 col-xs-6 f-category wow fadeIn animated animated" data-wow-delay="2s">
                <a href="/jobs">
                  <div class="icon-img">
                    <img src="graphics/category/img-11.png" class="img-responsive" alt="img">
                  </div>
                  <h6>Jobs</h6> 
                </a>
              </div>
              <div style="visibility: visible;-webkit-animation-delay: 0s; -moz-animation-delay: 0s; animation-delay: 0s;" class="col-md-2 col-sm-3 col-xs-6 f-category wow fadeIn animated animated" data-wow-delay="0s">
                <a href="/motors">
                  <div class="icon-img">
                    <img src="graphics/category/img-1.png" class="img-responsive" alt="img">
                  </div>
                  <h6>Automobiles</h6> 
                </a>
              </div>
			  <div style="visibility: visible;-webkit-animation-delay: 0s; -moz-animation-delay: 0s; animation-delay: 0s;" class="col-md-2 col-sm-3 col-xs-6 f-category wow fadeIn animated animated" data-wow-delay="0s">
                <a href="/accommodation">
                  <div class="icon-img">
                    <img src="graphics/category/accomodation.png" class="img-responsive" alt="img">
                  </div>
                  <h6>Accomodation</h6> 
                </a>
              </div>
			  <div style="visibility: visible;-webkit-animation-delay: 0s; -moz-animation-delay: 0s; animation-delay: 0s;" class="col-md-2 col-sm-3 col-xs-6 f-category wow fadeIn animated animated" data-wow-delay="0s">
                <a href="/restaurants">
                  <div class="icon-img">
                    <img src="graphics/category/restaurants.png" class="img-responsive" alt="img">
                  </div>
                  <h6>Restaurants</h6> 
                </a>
              </div>
			  <div style="visibility: visible;-webkit-animation-delay: 0s; -moz-animation-delay: 0s; animation-delay: 0s;" class="col-md-2 col-sm-3 col-xs-6 f-category wow fadeIn animated animated" data-wow-delay="0s">
                <a href="/events">
                  <div class="icon-img">
                    <img src="graphics/category/events.png" class="img-responsive" alt="img">
                  </div>
                  <h6>Events</h6> 
                </a>
              </div>
			  
			  
			  
			  
             <!-- <div style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s;" class="col-md-2 col-sm-3 col-xs-6 f-category wow fadeIn animated animated" data-wow-delay="0.2s">
                <a href="category.html">
                  <div class="icon-img">
                    <img src="graphics/category/img-2.png" class="img-responsive" alt="img">
                  </div>
                  <h6>Laptops</h6> 
                </a>
              </div>
              <div style="visibility: visible;-webkit-animation-delay: 0.4s; -moz-animation-delay: 0.4s; animation-delay: 0.4s;" class="col-md-2 col-sm-3 col-xs-6 f-category wow fadeIn animated animated" data-wow-delay="0.4s">
                <a href="category.html">
                  <div class="icon-img">
                    <img src="graphics/category/img-3.png" class="img-responsive" alt="img">
                  </div>
                  <h6>Mobiles</h6> 
                </a>
              </div>
              <div style="visibility: visible;-webkit-animation-delay: 0.6s; -moz-animation-delay: 0.6s; animation-delay: 0.6s;" class="col-md-2 col-sm-3 col-xs-6 f-category wow fadeIn animated animated" data-wow-delay="0.6s">
                <a href="category.html">
                  <div class="icon-img">
                    <img src="graphics/category/img-4.png" class="img-responsive" alt="img">
                  </div>
                  <h6>Electronics</h6> 
                </a>
              </div>
              <div style="visibility: visible;-webkit-animation-delay: 0.8s; -moz-animation-delay: 0.8s; animation-delay: 0.8s;" class="col-md-2 col-sm-3 col-xs-6 f-category wow fadeIn animated animated" data-wow-delay="0.8s">
                <a href="category.html">
                  <div class="icon-img">
                    <img src="graphics/category/img-5.png" class="img-responsive" alt="img">
                  </div>
                  <h6>Computer</h6> 
                </a>
              </div>
              
              <div style="visibility: visible;-webkit-animation-delay: 1.2s; -moz-animation-delay: 1.2s; animation-delay: 1.2s;" class="col-md-2 col-sm-3 col-xs-6 f-category wow fadeIn animated animated" data-wow-delay="1.2s">
                <a href="category.html">
                  <div class="icon-img">
                    <img src="graphics/category/img-7.png" class="img-responsive" alt="img">
                  </div>
                  <h6>Home Appliances</h6> 
                </a>
              </div>
              <div style="visibility: visible;-webkit-animation-delay: 1.4s; -moz-animation-delay: 1.4s; animation-delay: 1.4s;" class="col-md-2 col-sm-3 col-xs-6 f-category wow fadeIn animated animated" data-wow-delay="1.4s">
                <a href="category.html">
                  <div class="icon-img">
                    <img src="graphics/category/img-8.png" class="img-responsive" alt="img">
                  </div>
                  <h6>Cameras</h6>
                </a>
              </div>
              <div style="visibility: visible;-webkit-animation-delay: 1.6s; -moz-animation-delay: 1.6s; animation-delay: 1.6s;" class="col-md-2 col-sm-3 col-xs-6 f-category  wow fadeIn animated animated" data-wow-delay="1.6s">
                <a href="category.html">
                  <div class="icon-img">
                    <img src="graphics/category/img-9.png" class="img-responsive" alt="img">
                  </div>
                  <h6>Fashion &amp; Beauty</h6> 
                </a>
              </div>
              <div style="visibility: visible;-webkit-animation-delay: 1.8s; -moz-animation-delay: 1.8s; animation-delay: 1.8s;" class="col-md-2 col-sm-3 col-xs-6 f-category wow fadeIn animated animated" data-wow-delay="1.8s">
                <a href="category.html">
                  <div class="icon-img">
                    <img src="graphics/category/img-10.png" class="img-responsive" alt="img">
                  </div>
                  <h6>Kids &amp; Baby Products</h6> 
                </a>
              </div>
              
              <div style="visibility: visible;-webkit-animation-delay: 2.2s; -moz-animation-delay: 2.2s; animation-delay: 2.2s;" class="col-md-2 col-sm-3 col-xs-6 f-category wow fadeIn animated animated" data-wow-delay="2.2s">
                <a href="category.html">
                  <div class="icon-img">
                    <img src="graphics/category/img-12.png" class="img-responsive" alt="img">
                  </div>
                  <h6>Home &amp; Furniture</h6> 
                </a>
              </div> -->
            </div>
          </div>
        </div>
      </section>
      <!-- Categories Homepage Section End -->
      <!-- Featured Listings Start -->
	  
	  
		<?php include 'code/modules/fp_slider_properties.php';?>
		
		<?php include 'code/modules/fp_slider_jobs.php';?>
		
		<?php include 'code/modules/fp_slider_directory.php';?>
		  
		<?php include 'code/modules/fp_slider_events.php';?>
	  
		<?php include 'code/modules/fp_slider_accommodation.php';?>
	  	
		<?php include 'code/modules/fp_slider_motors.php';?>
		
		<?php include 'code/modules/fp_slider_recycle.php';?>
		
		<?php include 'code/modules/fp_slider_restaurants.php';?>
	  
		
		
		
      <!-- Featured Listings End -->
      <!-- Start Services Section -->
      <!--<div class="features">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="0.3s">
                <div class="features-icon">
                  <i class="fa fa-book">
                  </i>
                </div>
                <div class="features-content">
                  <h4>
                    Full Documented
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="0.6s">
                <div class="features-icon">
                  <i class="fa fa-paper-plane"></i>
                </div>
                <div class="features-content">
                  <h4>
                    Clean & Modern Design
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="0.9s">
                <div class="features-icon">
                  <i class="fa fa-map"></i>
                </div>
                <div class="features-content">
                  <h4>
                    Great Features
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                  </p>
                </div>
              </div>
            </div> 
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="1.2s">
                <div class="features-icon">
                  <i class="fa fa-cogs"></i>
                </div>
                <div class="features-content">
                  <h4>
                    Completely Customizable
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                  </p>
                </div>
              </div>
            </div>           
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="1.5s">
                <div class="features-icon">
                 <i class="fa fa-hourglass"></i>
                </div>
                <div class="features-content">
                  <h4>
                    100% Responsive Layout
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="1.8s">
                <div class="features-icon">
                  <i class="fa fa-hashtag"></i>
                </div>
                <div class="features-content">
                  <h4>
                    User Friendly
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="2.1s">
                <div class="features-icon">
                  <i class="fa fa-newspaper-o"></i>
                </div>
                <div class="features-content">
                  <h4>
                    Awesome Layout
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="2.4s">
                <div class="features-icon">
                  <i class="fa fa-leaf"></i>
                </div>
                <div class="features-content">
                  <h4>
                    High Quality
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="2.7s">
                <div class="features-icon">
                  <i class="fa fa-google"></i>
                </div>
                <div class="features-content">
                  <h4>
                    Free Google Fonts Use
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>-->
      <!-- End Services Section -->
     
	 <section class="location">
        <div class="container">
          <div class="row localtion-list">
           
            <div data-wow-delay="1s" class="col-md-12 col-sm-12 col-xs-12 wow fadeInRight animated" style="visibility: visible;-webkit-animation-delay: 1s; -moz-animation-delay: 1s; animation-delay: 1s;">
              <h3 class="title-2"><i class="fa fa-search"></i> Popular Searches</h3>
			  
				<ul class="cat-list col-sm-3">
			    <li> <a href="#">Property in the Bihar</a></li>
                <li> <a href="properties-for-sale">Properties for sale in the Bihar</a></li>
                <li> <a href="properties-for-rent">Properties for rent in the Bihar</a></li>
                <li> <a href="properties-by-main-type/2/Commercial">Commercial Properties</a></li>
                <li> <a href="how-to-advertise">Advertise a Property</a></li>
                <li> <a href="property">Search Properties</a></li>
              </ul>
              <ul class="cat-list col-sm-3">
			    <li> <a href="#">Jobs in the Bihar</a></li> 
                <li> <a href="jobs-offered">Jobs available in the Bihar</a></li>
                <li> <a href="jobs-wanted">Jobs wanted in the Bihar</a></li>
                <li> <a href="directory-category/1-101/Recruitment-Agencies">Recruitment Agencies</a></li>
                <li> <a href="how-to-advertise">Advertise a Job</a></li>
                <li> <a href="jobs">Browse all Jobs	 </a></li>
              </ul>
			  <ul class="cat-list col-sm-3">
			    <li> <a href="#">Jobs in the Bihar</a></li> 
				<li> <a href="motors-for-sale">Motors for sale in the Bihar</a></li>
                <li> <a href="motors-for-rent">Motors for rent in the Bihar</a></li>
                <li> <a href="directory-category/1-5/Commercial-Motors">Commercial Motors</a></li>
                <li> <a href="motors">Browse all Motors</a></li>
                <li> <a href="motors">Search Motors</a></li>
              </ul>
				<ul class="cat-list col-sm-3">
			    <li> <a href="#">Directory</a></li> 
				<li> <a href="business-directory/9/bihar">Business directory for Bihar</a></li>
                <li> <a href="business-directory/1/patna">Business directory for Patna</a></li>      
                <li> <a href="business-directory/7/bhagalpur">Business directory for Bhagalpur</a></li>
                <li> <a href="business-directory/4/darbhanga">Business directory for Darbhanga</a></li>
                <li> <a href="business-directory/6/purnia">Business directory for Purnia</a></li>
              </ul>
             
             
            </div>
          </div>
        </div>
      </section>
	 
	 
      <!-- Location Section Start -->
 	 <section class="location">
        <div class="container">
          <div class="row localtion-list">
            <div data-wow-delay="0.5s" class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft animated" style="visibility: visible;-webkit-animation-delay: 0.5s; -moz-animation-delay: 0.5s; animation-delay: 0.5s;">
              <h3 class="title-2"><i class="fa fa-envelope"></i> Subscribe for updates</h3>
            <form action="" id="subscribe">
              <p>Join our subscriber list and get updates of new properties, jobs, events etc.</p>
              <div class="subscribe">
                <div class="form-group is-empty"><input type="email" required="" placeholder="Your email here" name="EMAIL" class="form-control"><span class="material-input"></span></div>
                <button type="submit" class="btn btn-common btn-newsletter">Subscribe</button>
              </div>
            </form>
            </div>
            <div data-wow-delay="1s" class="col-md-6 col-sm-6 col-xs-12 wow fadeInRight animated" style="visibility: visible;-webkit-animation-delay: 1s; -moz-animation-delay: 1s; animation-delay: 1s;">
              <h3 class="title-2"><i class="fa fa-search"></i> Popular Searches</h3>
			  
		
              <ul class="cat-list col-sm-6">
			    <li> <a href="#">Jobs in the Bihar</a></li> 
                <li> <a href="#">Jobs available in the Bihar</a></li>
                <li> <a href="#">Jobs wanted in the Bihar</a></li>
                <li> <a href="#">Recruitment Agencies</a></li>
                <li> <a href="#">Advertise a Job</a></li>
                <li> <a href="#">Browse all Jobs	 </a></li>
              </ul>
              <ul class="cat-list col-sm-6">
			    <li> <a href="#">Property in the Bihar</a></li>
                <li> <a href="#">Properties for sale in the Bihar</a></li>
                <li> <a href="#">Properties for rent in the Bihar</a></li>
                <li> <a href="#">Commercial Properties</a></li>
                <li> <a href="#">Advertise a Property</a></li>
                <li> <a href="#">Search Properties</a></li>

              </ul>
             
            </div>
          </div>
        </div>
      </section>
      <!-- Location Section End -->

    </div>

    <!-- Counter Section Start -->
    <section id="counter">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="counting wow fadeInDownQuick" data-wow-delay=".5s">
              <div class="icon">
                <span>
                  <i class="lnr lnr-tag"></i>
                </span>
              </div>
              <div class="desc">
                <h3 class="counter">12090</h3>
                <p>Regular Ads</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="counting wow fadeInDownQuick" data-wow-delay="1s">
              <div class="icon">
                <span>
                  <i class="lnr lnr-map"></i>
                </span>
              </div>
              <div class="desc">
                <h3 class="counter">350</h3>
                <p>Locations</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="counting wow fadeInDownQuick" data-wow-delay="1.5s">
              <div class="icon">
                <span>
                  <i class="lnr lnr-users"></i>
                </span>
              </div>
              <div class="desc">
                <h3 class="counter">23453</h3>
                <p>Reguler Members</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="counting wow fadeInDownQuick" data-wow-delay="2s">
              <div class="icon">
                <span>
                  <i class="lnr lnr-license"></i>
                </span>
              </div>
              <div class="desc">
                <h3 class="counter">150</h3>
                <p>Premium Ads</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Counter Section End -->

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