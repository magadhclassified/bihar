<?php if(!isset($caller)){exit('Direct access not allowed.');} ?>
<?php include 'code/includes/member_events_list.php';?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <title>My Events : My Dashboard : <?php echo COMPANY_NAME; ?></title> 
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
              <h2 class="title-2"><i class="fa fa-credit-card"></i> My Events <a class="btn btn-danger btn-post" href="/my-events-manage"><span class="fa fa-plus-circle"></span> Add new Events<div class="ripple-container"></div></a></h2>
              <div class="table-responsive">
			  <?php $filter_options = array('EVENTS', 'Event', 'my-events-manage', 900, 950); include 'code/modules/members_manage_filter.php'; ?>
               <!-- <div class="table-action">
                  
                  <div class="table-search pull-right col-xs-7">
                    <div class="form-group is-empty">
                      <label class="col-xs-5 control-label text-right">Search <br>
                        <a href="#clear" class="clear-filter" title="clear filter">[clear]</a> 
                      </label>
                      <div class="col-xs-7 searchpan">
                        <input type="text" id="filter" class="form-control">
                      </div>
                    <span class="material-input"></span></div>
                  </div>
                </div>-->
				<?php echo $finalPaging; ?>
                <table class="table table-striped table-bordered add-manage-table">
                  <?php echo $finalString; ?>
                </table>
				<?php include 'code/modules/members_manage_filter.php'; ?>
				<?php echo $finalPaging; ?>
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