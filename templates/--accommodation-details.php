<?php if(!isset($caller)){exit('Direct access not allowed.');} ?>
<?php include 'code/includes/accommodation_info.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <title><?php echo $page_data[11]; ?></title> 
    <?php include 'code/modules/head.php'; ?> 
  </head>


  <body>  
  <?php include 'code/modules/header.php'; ?> 
    <!-- Start Content -->
    <div id="content">
     <div class="container">
        <div class="row">
          <!-- Product Info Start -->
          <div class="product-info">
            <div class="col-sm-8">
              <div class="inner-box ads-details-wrapper">
                <h2><?php echo $field_title; ?></h2>
                <p class="item-intro"><span class="poster">Posted  <?php if(strlen($field_contact_name) > 0){ ?>  by <span class="ui-bubble is-member"><?php echo $field_contact_name ;?></span><?php } ?> on <span class="date"> <?php echo date('d M, Y',$field_date);?></span> <?php if(strlen($field_profile_address) > 0){ ?>from <span class="location"><?php echo $field_profile_address;?></span><?php } ?></span></p>
                
				
				<?php if(strlen($field_img1) > 0){ ?>
				<div class="owl-carousel owl-theme" id="owl-demo">
                    <div class="owl-wrapper-outer">
					<div class="owl-wrapper" >
				<?php if(strlen($field_img1) > 0){ ?>
				<div class="owl-item" style="width: 688px;">
				<div class="item">
                       <img src="files/property/medium/<?php echo $field_img1; ?>" alt="" rel="files/property/small/<?php echo $field_img1; ?>" />
				</div>
				</div>
				<?php } ?>
				<?php if(strlen($field_img2) > 0){ ?>
				<div class="owl-item" style="width: 688px;">
				<div class="item">
						<img src="files/property/medium/<?php echo $field_img2; ?>" alt="" rel="files/property/small/<?php echo $field_img2; ?>" />
				</div>
				</div>
				<?php } ?>
				<?php if(strlen($field_img3) > 0){ ?>
				<div class="owl-item" style="width: 688px;">
				<div class="item">
						<img src="files/property/medium/<?php echo $field_img3; ?>" alt="" rel="files/property/small/<?php echo $field_img3; ?>" />
				</div>
				</div>
				<?php } ?>
				<?php if(strlen($field_img4) > 0){ ?>
				<div class="owl-item" style="width: 688px;">
				<div class="item">
						<img src="files/property/medium/<?php echo $field_img4; ?>" alt="" rel="files/property/small/<?php echo $field_img4; ?>" />
				</div>
				</div>
				<?php } ?>
				</div>
				</div>
				
				
				
				<div class="owl-controls"></div>
				
					</div>
				<?php } ?>
              </div>


              <div class="Ads-Details">
                <h2 class="title-2"><strong>Ads Details</strong></h2>
                  <div class="row">
                  <div class="ads-details-info col-md-8">
                      <p>
          
		  
		  
		  
          <?php echo nl2br($field_content); ?>
          
 
                    </div>
                  <div class="col-md-4">
                    <aside class="panel panel-body panel-details">
                      <ul>
					   <?php if(strlen($field_price) > 0){ ?>
                        <li>
                        <p class=" no-margin "><strong>Pricing:</strong> <?php echo $field_price; ?></p>
                        </li>
					   <?php } ?>
                        <li>
                        <p class="no-margin"><strong>Division/District:</strong> <?php echo $field_emirate . ', ' . $field_location; ?></p>
                        </li>
						<?php if(strlen($field_development) > 0){ ?>
                        <li>
                        <p class="no-margin"><strong>Block/Town:</strong> <?php echo $field_development; ?></p>
                        </li>
						<?php } ?>
						<?php if(strlen($field_address) > 0){ ?>
						<li>
                        <p class="no-margin"><strong>Address:</strong> <?php echo $field_address; ?></p>
                        </li>
						<?php } ?>
						
						<li>
                        <p class="no-margin"><strong>Type:</strong> <?php echo $field_type; ?></p>
                        </li>
						<li>
                        <p class="no-margin"><strong>Rating:</strong> <?php echo $rating_stars; ?></p>
                        </li>
						<li>
                        <p class="no-margin"><strong>From Airport:</strong> <?php echo $field_airport; ?></p>
                        </li>
						<?php if(strlen($facilities_list) > 0){ ?>
						<li>
                        <p class="no-margin"><strong>Facilities:</strong> <?php echo $facilities_list; ?></p>
                        </li>
						<?php } ?>
                        
		            
						<li><?php echo get_fb_like($url); ?><?php include 'code/modules/social_twitter.php'; ?></li>
                      </ul>
                    </aside>

                    <div class="ads-action">
                      <ul class="list-border">
					  <li>
					  <i class="fa fa-user"></i><?php if(strlen($field_contact_name) > 0){ ?>  <?php echo $field_contact_name ;?><?php } ?>
					  </li>
                        <li>					
                          <i class="fa fa-phone"></i> <?php if(strlen($field_contact_number) > 0){  echo $field_contact_number; ?><?php } ?>
							<a class="detailsbuttons" href="#" onclick="sto('contactFormDiv');return false;">Reply to this</a>
							</li>
                        <!--<li>
                          <a href="#"> <i class=" fa fa-user"></i> More ads by User </a> </li>
                        <li>
                          <a href="#"> <i class=" fa fa-heart"></i> Save ad </a> </li>-->
                        <li>
                         <i class="fa fa-share-alt"></i> Share ad 
                      <div class="social-link">  
                      <a data-placement="top" data-toggle="tooltip" href="http://twitter.com/share?text=<?php echo $field_title; ?>" data-original-title="twitter" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a>
                      <a data-placement="top" data-toggle="tooltip" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo $url;?>" data-original-title="facebook" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
                      <a data-placement="top" data-toggle="tooltip" href="https://plus.google.com/share?url=<?php echo $url;?>" data-original-title="google-plus" target="_blank" class="google"><i class="fa fa-google"></i></a>
                      <a data-placement="top" data-toggle="tooltip" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url;?>&title=<?php echo $field_title; ?>&summary=<?php echo nl2br($field_content); ?>&source=<?php echo COMPANY_NAME;?>" data-original-title="linkedin" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a>
                      </div>

                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
			
			  
			  
			  
			  
			  <div class="Ads-Details" id="contactFormDiv">
                <h2 class="title-2"><strong>Enquire about this <?php echo $field_type;?></strong></h2>
                  <div class="row">
		<?php if(isset($_SESSION['Form_Status'])){echo '<strong style="color:#FF0000;">An error occurred: please ensure you enter the security code correctly!</strong><br /><br />';unset($_SESSION['Form_Status']);} ?>
		<form data-toggle="validator" class="contact-form" id="contactForm" method="post" action="code/includes/send_enquiry.php" onsubmit="return check_form(this, ['feedbackname', 'feedbackemail', 'feedbacknumber', 'message', 'capbox', 'enquiryagree'], ['TEXT', 'EMAIL', 'TEXT', 'TEXT', 'TEXT', 'CHECK']);" novalidate="true">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group is-empty">
                          <input data-error="Please enter your name" required="" placeholder="Full Name" name="feedbackname" id="feedback-fullname" value="<?php echo $member_name; ?>" class="form-control" type="text">
                          <div class="help-block with-errors"></div>
                        <span class="material-input"></span><span class="material-input"></span></div>                    
                      </div>
                      <div class="col-md-12">
                        <div class="form-group is-empty">                      
                          <input data-error="Please enter your email" required="" placeholder="mail@sitename.com" name="feedbackemail" id="feedback-email" value="<?php echo $member_email; ?>" class="form-control" type="email">
                          <div class="help-block with-errors"></div>
                        <span class="material-input"></span><span class="material-input"></span></div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group is-empty"> 
                          <input data-error="Please enter your Phone Number" required="" placeholder="Phone" name="feedbacknumber" id="feedback-contactnumber" value="<?php echo $member_number; ?>" class="form-control" type="text">
                          <div class="help-block with-errors"></div>
                        <span class="material-input"></span><span class="material-input"></span></div>
                      </div>
					  
					  <div class="col-md-12">
                        <div class="form-group is-empty"> 
					  <img id="captc" src="code/includes/cap/securimage_show.php" alt="Click to load a different image" title="Click to load a different image" onclick="document.getElementById('captc').src = '<?php echo COMPANY_URL; ?>code/includes/cap/securimage_show.php?' + Math.random();return false" style="cursor:pointer;" />
					  <input class="form-control" type="text" name="capbox" id="feedback-entry" /><span><br />
            Please enter the word in the image on the right in the text field below.</span>
			
					  </div>
                      </div>
					  
					  
					  
					   <div class="col-md-12">
                        <div class="form-group is-empty"> 
						
                     <input type="checkbox" id="remember" name="enquiryagree">
            I agree to the <a href="terms-and-conditions" onclick="return!window.open(this.href);">Terms and Conditions</a>.</span>
			  </div>
                      </div>
                      <div class="col-md-12">
                         <input type="submit" class="btn btn-common disabled" name="feedback-submit" id="feedback-submit" style="pointer-events: all; cursor: pointer;" value="Send Your Message" />
                        <div class="h3 text-center hidden" id="msgSubmit"></div> 
                        <div class="clearfix"></div>   
                      </div>
                    </div>
                  </div>    
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group is-empty"> 
                          <textarea required="" data-error="Write your message" name="message" id="feedback-message" rows="9" placeholder="Massage" class="form-control"></textarea>
                         </div>
						 <div class="form-group is-empty"><?php echo $global_info[18]; ?> </div>
                      </div>
                    </div>
                  </div>                   
                </div> 
				
			<input type="hidden" name="id" value="<?php echo $listing_id; ?>" />
            <input type="hidden" name="section" value="<?php echo $site_section; ?>" />
              </form>   
                </div>
              </div>
			  
			  
			  <div class="Ads-Details">
                <h2 class="title-2"><strong>Location Map</strong></h2>
                  <div class="row">
			  <?php if(strlen($field_gps_lat) > 0 && strlen($field_gps_lon) > 0){ ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=<?php echo $global_info[2]; ?>"></script>
<script type="text/javascript">
  function initialize() {
    var myLatlng = new google.maps.LatLng(<?php echo $field_gps_lat; ?>, <?php echo $field_gps_lon; ?>);
    var myOptions = {
      zoom: <?php echo $global_info[5]; ?>,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
	  streetViewControl: false
    }
    var map = new google.maps.Map(document.getElementById("googlemap"), myOptions);
    
    var marker = new google.maps.Marker({
        position: myLatlng, 
        map: map
    });   
  }
  $(document).ready(function() {
  	initialize();
  });
</script>
<div class="fancyborder_gm" id="googlemap" style="width: 720px; height: 300px;"></div>
<?php }else{ ?>
<img class="eventmap" src="files/accommodation/medium/<?php echo $field_img; ?>" alt="<?php echo safe_alt($field_title); ?>" title="<?php echo safe_alt($field_title); ?>" />
<?php } ?>
	 </div>
              </div>		  
			  
			  
			  
			  
			  
			  
			  
			  
            </div>
			
			<div class="col-sm-4">
             <?php include 'code/modules/detailpage-right-panel.php'; ?> 
            </div>
			
            <?php include 'code/modules/banners_fp_top_right.php'; ?> 
			
			 <?php include 'code/modules/banners_fp_bottom_right.php'; ?> 
			 
            <div class="col-sm-4 col-xs-12">
              <div class="inner-box">
                <div class="widget-title">
                  <h4>Random Ads</h4>
                </div>
                
                <ul class="featured-list">
                  <li>
                    <img src="graphics/featured/img1.jpg" alt="">
                    <div class="hover">
                      <a href="#"><span>$49</span></a>
                    </div>
                  </li>
                  <li>
                    <img src="graphics/featured/img2.jpg" alt="">
                    <div class="hover">
                      <a href="#"><span>$49</span></a>
                    </div>
                  </li>
                  <li>
                    <img src="graphics/featured/img3.jpg" alt="">
                    <div class="hover">
                      <a href="#"><span>$49</span></a>
                    </div>
                  </li>
                  <li>
                    <img src="graphics/featured/img4.jpg" alt="">
                    <div class="hover">
                      <a href="#"><span>$49</span></a>
                    </div>
                  </li>
                  <li>
                    <img src="graphics/featured/img5.jpg" alt="">
                    <div class="hover">
                      <a href="#"><span>$49</span></a>
                    </div>
                  </li>
                  <li>
                    <img src="graphics/featured/img6.jpg" alt="">
                    <div class="hover">
                      <a href="#"><span>$49</span></a>
                    </div>
                  </li>
                </ul>             
              </div>
            </div>
          </div>
          <!-- Product Info End -->
        </div>
      </div>       
    </div>
    <!-- End Content -->

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