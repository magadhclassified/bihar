<?php if(!isset($caller)){exit('Direct access not allowed.');} ?><!DOCTYPE html>
<html lang="en">
  <head>
  <title>My Dashboard: <?php echo COMPANY_NAME; ?></title> 
    <?php include 'code/modules/head.php'; ?> 
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
                    <h4 class="panel-title"> <a data-toggle="collapse" href="#collapseB1"> My details </a> </h4>
                  </div>
                  <div id="collapseB1" class="panel-collapse collapse in">
                    <div class="panel-body">
                      <form method="post" action="code/includes/member_edit.php" enctype="multipart/form-data" onsubmit="return check_form(this, ['company', 'name', 'email'], ['TEXT', 'TEXT', 'EMAIL']);">
                        <div class="form-group is-empty">
                    <label class="control-label">Company</label>
					<input placeholder="Company Name" class="form-control" type="text" name="company" value="<?php echo $member_company; ?>" />
                        
                        <span class="material-input"></span></div>
                        <div class="form-group is-empty">
                          <label class="control-label">Contact Person</label>
						  <input placeholder="Contact Person" class="form-control" type="text" name="name" value="<?php echo $member_name; ?>" />
                       
                        <span class="material-input"></span></div>
                        <div class="form-group is-empty">
                          <label class="control-label">Email</label>
                          <input type="email" name="email" value="<?php echo $member_email; ?>" placeholder="jhon.deo@example.com" class="form-control">
                        <span class="material-input"></span></div>
                        <div class="form-group is-empty">
                          <label class="control-label">Address</label>
						  <input class="form-control" type="text" name="address" value="<?php echo $member_address; ?>" />
                        <span class="material-input"></span></div>
                        <div class="form-group is-empty">
                          <label class="control-label" for="Phone">Telephone</label>
						  <input type="text" id="Phone" class="form-control" name="tel" value="<?php echo $member_number; ?>" placeholder="880 123 456789"  />
                        <span class="material-input"></span></div>
                        <div class="form-group is-empty">
                          <label class="control-label">Fax</label>
                          <input type="text" placeholder="Fax" class="form-control" name="fax" value="<?php echo $member_fax; ?>">
                        <span class="material-input"></span></div>
						  <div class="form-group is-empty">
                          <label class="control-label">Website</label>
                          <input type="text" placeholder="Website" class="form-control" name="website" value="<?php echo $member_website; ?>">
                        <span class="material-input"></span></div>
						
						
						  <div class="form-group is-empty">
                          <label class="control-label">Company Logo</label>
						  <input class="form-control" type="file" name="frm_upload1" id="add-upload" />
						  <?php if($member_logo != 'company-logo.jpg'){ ?>
							<a href="files/profiles/<?php echo $member_logo; ?>" onclick="return!window.open(this.href);">Current Image</a>
							<?php } ?>
                        <span class="material-input"></span></div>
						
						 <div class="form-group is-empty">
                          <label class="control-label">Reset Password</label>
						  <input type="password" name="password" value="" class="form-control"/>
                        <span class="material-input"></span></div>
						
                        <div class="form-group">
                          <button class="btn btn-common" type="submit">Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!--<div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title"> <a data-toggle="collapse" href="#collapseB2" class="" aria-expanded="true"> Settings </a> </h4>
                  </div>
                  <div id="collapseB2" class="panel-collapse collapse in" aria-expanded="true" style="">
                    <div class="panel-body">
                      <form role="form">
                        <div class="form-group">
                          <div class="checkbox">
                            <label><input type="checkbox"><span class="checkbox-material"></span>Comments are enabled on my ads </label>
                          </div>
                        </div>
                        <div class="form-group is-empty">
                          <label class="control-label">New Password</label>
                          <input type="password" placeholder="" class="form-control">
                        <span class="material-input"></span></div>
                        <div class="form-group is-empty">
                          <label class="control-label">Confirm Password</label>
                          <input type="password" placeholder="" class="form-control">
                        <span class="material-input"></span></div>
                        <div class="form-group">
                          <button class="btn btn-common" type="submit">Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>-->
                <!--<div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title"> <a data-toggle="collapse" href="#collapseB3" class="" aria-expanded="true"> Preferences </a> </h4>
                  </div>
                  <div id="collapseB3" class="panel-collapse collapse in" aria-expanded="true" style="">
                    <div class="panel-body">
                      <div class="form-group">
                        <div class="col-sm-12">
                          <div class="checkbox">
                            <label><input type="checkbox"><span class="checkbox-material"></span>I want to receive newsletter. </label>
                          </div>
                          <div class="checkbox">
                            <label><input type="checkbox"><span class="checkbox-material"></span>I want to receive advice on buying and selling. </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>-->
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