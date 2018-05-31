<?php if(!isset($caller)){exit('Direct access not allowed.');} ?><?php include 'code/includes/directory_info.php'; ?>
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
                <p class="item-intro"><span class="poster">Posted  <?php if(strlen($field_uprofile_company) > 0){ ?>  by <span class="ui-bubble is-member"><?php echo $field_uprofile_company ;?></span><?php } ?> on <span class="date"> <?php echo date('d M, Y',$field_date);?></span> <?php if(strlen($field_uprofile_address) > 0){ ?>from <span class="location"><?php echo $field_uprofile_address;?></span><?php } ?></span></p>
              </div>

              <div class="Ads-Details">
                <h2 class="title-2"><strong>Ads Details</strong></h2>
                  <div class="row">
                  <div class="ads-details-info col-md-7">
				  
				   <ul>
					   <?php if(strlen($field_title) > 0){ ?>
                        <li>
                        <p class=" no-margin "><strong>Company Name:</strong> <?php echo $field_title; ?></p>
                        </li>
					   <?php } ?>
					   
					   <?php if(strlen($field_profile_address_physical) > 0){ ?>
                        <li>
                        <p class="no-margin"><strong>Physical Address:</strong> <?php echo $field_profile_address_physical; ?></p>
                        </li>
						 <?php } ?>
						 
						<?php if(strlen($field_profile_address_postal) > 0){ ?>
                        <li>
                        <p class="no-margin"><strong>Postal Address:</strong> <?php echo $field_profile_address_postal; ?></p>
                        </li>
						<?php } ?>
						
						
						
                      </ul>
				  
				  
                      <p>
          
		  
						<?php echo nl2br($field_content); ?>
 
                    </div>
                  <div class="col-md-5">
                    <aside class="panel panel-body panel-details">
                      <ul>
					  	<li>
												<?php if(strlen($field_profile_web) > 0){ ?><a href="<?php echo test_link($field_profile_web); ?>" rel="nofollow" onclick="return!window.open(this.href);"><?php } ?>
						<?php if(strlen($field_profile_img) > 0){ ?><img class="companydetailsimg" src="files/directory/thumb/<?php echo $field_profile_img; ?>" alt="<?php echo safe_alt($field_title); ?>" title="<?php echo safe_alt($field_title); ?>" /><?php } ?>
						<?php if(strlen($field_profile_web) > 0){ ?></a><?php } ?>

                        </li>
						<?php if(strlen($field_profile_tel) > 0){ ?>
						<li>
                        <p class="no-margin"><strong>Telephone:</strong> <?php echo $field_profile_tel; ?></p>
                        </li>
						<?php } ?>
						<?php if(strlen($field_profile_fax) > 0){ ?>
						<li>
                        <p class="no-margin"><strong>Facsimile:</strong> <?php echo $field_profile_fax; ?></p>
                        </li>
						<?php } ?>
						<?php if(strlen($field_profile_web) > 0){ ?>
						<li>
                        <p class="no-margin"><strong>Web Address:</strong> <a href="<?php echo test_link($field_profile_web); ?>" rel="nofollow" onclick="return!window.open(this.href);"><?php echo $field_profile_web; ?></a></p>
                        </li>
						<?php } ?>
					
                      </ul>
                    </aside>

                    <div class="ads-action">
                      <ul class="list-border">
					  <li>
					  <i class="fa fa-user"></i><?php if(strlen($field_uprofile_contact) > 0){ ?>  <?php echo $field_uprofile_contact ;?><?php } ?>
					  </li>
                        <li>					
                          <i class="fa fa-phone"></i> <?php if(strlen($field_uprofile_tel) > 0){  echo $field_uprofile_tel; ?><?php } ?>
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
                <h2 class="title-2"><strong>Send enquiry to this Company</strong></h2>
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
<img class="eventmap" src="files/property/medium/<?php echo $field_img; ?>" alt="<?php echo safe_alt($field_title); ?>" title="<?php echo safe_alt($field_title); ?>" />
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