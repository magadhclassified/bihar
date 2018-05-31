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
			  
			  
			  
			  
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=<?php echo $global_info[2]; ?>"></script>
<script type="text/javascript">
function initialize() {
var myLatlng = new google.maps.LatLng(<?php echo $global_info[8]; ?>, <?php echo $global_info[9]; ?>);
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
<?php echo $page_data[2]; ?>
		  
<?php if(isset($_SESSION['Form_Status'])){echo '<strong style="color:#FF0000;">An error occurred: please ensure you enter the security code correctly!</strong><br /><br />';unset($_SESSION['Form_Status']);} ?>
<?php echo $page_data_feedback[2]; ?>
<form method="post" action="code/includes/send_feedback.php" onsubmit="return check_form(this, ['feedbackname', 'feedbackemail', 'feedbacknumber', 'feedsubject', 'message', 'capbox'], ['TEXT', 'EMAIL', 'TEXT', 'TEXT', 'TEXT', 'TEXT']);">

                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group is-empty">
                          <input data-error="Please enter your name" placeholder="Full Name" name="feedbackname" id="feedback-fullname" value="<?php echo $member_name; ?>" class="form-control" type="text">
                          <div class="help-block with-errors"></div>
                        <span class="material-input"></span><span class="material-input"></span><span class="material-input"></span></div>                    
                      </div>
                      <div class="col-md-12">
                        <div class="form-group is-empty">                      
                          <input data-error="Please enter your email" placeholder="mail@sitename.com" name="feedbackemail" id="feedback-email" value="<?php echo $member_email; ?>" class="form-control" type="email">
                          <div class="help-block with-errors"></div>
                        <span class="material-input"></span><span class="material-input"></span><span class="material-input"></span></div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group is-empty"> 
                          <input data-error="Please enter your Phone Number" placeholder="Phone" name="feedbacknumber" id="feedback-contactnumber" value="<?php echo $member_number; ?>" class="form-control" type="text">
                          <div class="help-block with-errors"></div>
                        <span class="material-input"></span><span class="material-input"></span><span class="material-input"></span></div>
                      </div>
					  
					   <div class="col-md-12">
                        <div class="form-group is-empty"> 
						<input class="form-control" type="text" name="feedsubject" id="feedback-subject" placeholder="Please enter subject" data-error="Please enter subject"/>
                          <div class="help-block with-errors"></div>
                        <span class="material-input"></span><span class="material-input"></span><span class="material-input"></span></div>
                      </div>
					  
					    <div class="col-md-12">
                        <div class="form-group is-empty"> 
					  <img id="captc" src="code/includes/cap/securimage_show.php" alt="Click to load a different image" title="Click to load a different image" onclick="document.getElementById('captc').src = '<?php echo COMPANY_URL; ?>code/includes/cap/securimage_show.php?' + Math.random();return false" style="cursor:pointer;" />
					  <input class="form-control" type="text" name="capbox" id="feedback-entry" /><span><br />
            Please enter the word in the image on the right in the text field below.</span>
			
					  </div>
                      </div>
					  
					
                      <div class="col-md-12">
                         <input class="btn btn-common disabled" name="feedback-submit" id="feedback-submit" style="pointer-events: all; cursor: pointer;" value="Send Your Message" type="submit">
                        <div class="h3 text-center hidden" id="msgSubmit"></div> 
                        <div class="clearfix"></div>   
                      </div>
                    </div>
                  </div>    
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group is-empty"> 
                          <textarea data-error="Write your message" name="message" id="feedback-message" rows="12" placeholder="Massage" class="form-control"></textarea>
                         <span class="material-input"></span></div>
                      </div>
                    </div>
                  </div>                   
                </div> 
				
			      </form>
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