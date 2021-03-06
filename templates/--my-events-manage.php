<?php if(!isset($caller)){exit('Direct access not allowed.');} ?><?php include 'code/includes/member_events_info.php'; ?><!DOCTYPE html>
<html lang="en">
  <head>
  <title>My Event: My Dashboard: <?php echo COMPANY_NAME; ?></title>
    <?php include 'code/modules/head_dashboard.php'; ?> 
  </head>

  <body>  
   <!-- Header Section Start -->
	<?php include 'code/modules/header.php'; ?> 
    <!-- Header Section End -->

    <!-- Start Content -->
    <div id="content">
      <div class="container">
        <div class="row">
          <div class="col-sm-3 page-sideabr">
            <?php include 'code/modules/dashboard_leftpanel.php';?>
          </div>
          <div class="col-sm-9 page-content">
            <div class="inner-box">
              <div class="welcome-msg">
                <h3 class="page-sub-header2 clearfix no-padding">Hello <?php echo ucfirst($member_name); ?> </h3>
                <span class="page-sub-header-sub small">You last logged in at: 01-03-2016 12:40 AM</span> 
              </div>
              <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title"> <a data-toggle="collapse" href="#collapseB1"> Post Your Event </a> </h4>
                  </div>
                  <div id="collapseB1" class="panel-collapse collapse in">
                    <div class="panel-body">
					<form method="post" action="code/includes/member_events_manage.php" enctype="multipart/form-data" 
onsubmit="return check_form(this, ['title', 'type', 'price', 'geo1', 'geo2', 'contact_name', 'contact_number', 'contact_email'], 
['TEXT', 'LISTBOX', 'TEXT', 'LISTBOX', 'LISTBOX', 'TEXT', 'TEXT', 'EMAIL']);">
					
					<?php if(isset($_SESSION['MemUpdate'])){ ?>
					<p class="popfield dropfield" style="color:#FF0000;"><?php echo $_SESSION['MemUpdate']; ?></p><div class="clear">&nbsp;</div>
					<?php unset($_SESSION['MemUpdate']);} ?>



                        <div class="form-group is-empty">
                    <label class="control-label">Title</label>
					<input placeholder="Title" class="form-control" type="text" name="title" value="<?php echo $item_title; ?>" />
                        <span class="material-input"></span></div>
						
						     <div class="form-group is-empty">
                          <label class="control-label">Date From</label>
						  <input class="form-control" type="text" placeholder="Date From" name="fdate" value="<?php echo date('d F Y', $item_date_from); ?>" />
                        <span class="material-input"></span></div>
						
						<div class="form-group is-empty">
                          <label class="control-label">Date To</label>
						  <input class="form-control" type="text" placeholder="Date To" name="tdate" value="<?php echo date('d F Y', $item_date_to); ?>" />
                        <span class="material-input"></span></div>
                   
                        <div class="form-group is-empty">
                          <label class="control-label">Type:</label>
						  <select name="type" class="form-control"><option value="0">&nbsp;Please Select...</option><?php echo $types_listbox; ?></select>
                        
                        <span class="material-input"></span></div>
                   
                        <div class="form-group is-empty">
                          <label class="control-label">Times</label>
                          <input type="text" placeholder="Times" class="form-control" name="times" value="<?php echo $item_times; ?>">
						  <small>E.g. open daily 9am - late</small>
                        <span class="material-input"></span></div>
						
						  <div class="form-group is-empty">
                          <label class="control-label">Entry Fee</label>
                          <input type="text" placeholder="Entry Fee" class="form-control" name="price" value="<?php echo $item_price; ?>">
                        <span class="material-input"></span></div>
						
						 <div class="form-group is-empty">
                          <label class="control-label" for="Phone">Venue</label>
					<input type="text" placeholder="Venue" id="rentaltime" class="form-control" name="venue" value="<?php echo $item_venue; ?>"  />
                        <span class="material-input"></span></div>
						
						  <div class="form-group is-empty">
                          <label class="control-label">Division</label>
                          <select name="geo1" onchange="change_geo2(this.value);" class="form-control"><option value="-1">&nbsp;Please Select...</option><?php echo $geo1_listbox; ?></select>
                        <span class="material-input"></span></div>
						
			
			
						
						  <div class="form-group is-empty">
                          <label class="control-label">SubDivision/Distict</label>
						  <span class="memberselect" id="geo2_zone">
                          <select name="geo2" onchange="change_geo3(this.value);" class="form-control"><option value="-1">&nbsp;Please Select...</option><?php echo $geo2_listbox; ?></select></span>
                        <span class="material-input"></span></div>
						
						
						
						
						  <div class="form-group is-empty">
                          <label class="control-label">Block/Town</label>
						  <span class="memberselect" id="geo3_zone">
                         <select name="geo3" class="form-control"><option value="-1">&nbsp;Please Select...</option><?php echo $geo3_listbox; ?></select></span>
                        <span class="material-input"></span></div>
						
						
						  <div class="form-group is-empty">
                          <label class="control-label">Contact Name</label>
                          <input type="text" placeholder="Contact Name" class="form-control" name="contact_name" value="<?php echo $item_contact_name; ?>">
                        <span class="material-input"></span></div>
						
						 <div class="form-group is-empty">
                          <label class="control-label">Contact Number</label>
                          <input type="text" placeholder="Contact Number" class="form-control" name="contact_number" value="<?php echo $item_contact_number; ?>">
                        <span class="material-input"></span></div>
						 <div class="form-group is-empty">
                          <label class="control-label">Contact Email</label>
                          <input type="text" placeholder="Contact Email" class="form-control" name="contact_email" value="<?php echo $item_contact_email; ?>">
                        <span class="material-input"></span></div>
						
						 <div class="form-group is-empty">
                          <label class="control-label">Event Website</label>
                          <input type="text" placeholder="Event Website" class="form-control" name="contact_email" value="<?php echo $item_contact_email; ?>">
                        <span class="material-input"></span></div>
						
						
						
						 <div class="form-group is-empty">
                          <label class="control-label">Map Latitude</label>
                          <input type="text" placeholder="Map Latitude" class="form-control" name="lat" value="<?php echo $item_maps_lat; ?>">
						  <small>In decimal, e.g. 12.34567</small>
                        <span class="material-input"></span></div> <div class="form-group is-empty">
                          <label class="control-label">Map Longitude</label>
                          <input type="text" placeholder="Map Longitude" class="form-control" name="lng" value="<?php echo $item_maps_lng; ?>">
						  <small>In decimal, e.g. 12.34567</small>
                        <span class="material-input"></span></div>
						
						 <div class="form-group is-empty">
                          <label class="control-label">Brief</label>
                          <input type="text" placeholder="Brief" class="form-control" name="brief" value="<?php echo $item_brief; ?>">
                        <span class="material-input"></span></div>
						 
						 <div class="form-group is-empty">
                          <label class="control-label">Keywords</label>
                          <input type="text" placeholder="Keywords" class="form-control" name="keywords" value="<?php echo $item_keywords; ?>">
						  <small>Comma separate keywords</small>
                        <span class="material-input"></span></div>
						 
					 <div class="form-group is-empty">
                          <label class="control-label">Full Text</label>
						  <textarea data-error="Write your message" name="content_full" id="feedback-message" rows="9" placeholder="Event Info" class="form-control"><?php echo $item_contents; ?></textarea>
						 
                        <span class="material-input"></span></div>
						
				
									
					
						
						
						<div class="form-group is-empty">
                         <label class="control-label">Image #1: </label> <div class="btn btn-primary btn-file">
                          <i class="glyphicon glyphicon-folder-open"></i> &nbsp;Browse … 
                          <input id="input-upload-img1" name="frm_upload1" class="file" data-preview-file-type="text" type="file">
                        <div class="ripple-container"></div>
						<?php if(strlen($item_image_file1) > 0){ ?><p class="poplabel2">&nbsp;</p><p class="normalfield"><a href="files/events/medium/<?php echo $item_image_file1; ?>" onclick="return!window.open(this.href);">Current Image</a></p><?php } ?>
						</div></div>

						
                        <div class="form-group">
                          <button class="btn btn-common" type="submit">Submit</button>
                        </div>

						<input type="hidden" name="id" value="<?php echo $listing_id; ?>" />
						<input type="hidden" name="oldimg1" value="<?php echo $item_image_file1; ?>" />

						
                      </form>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
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