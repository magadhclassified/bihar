<?php if(!isset($caller)){exit('Direct access not allowed.');} ?>
<?php include 'code/includes/member_jobs_list.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <title>My Jobs : My Dashboard : <?php echo COMPANY_NAME; ?></title> 
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
              <h2 class="title-2"><i class="fa fa-credit-card"></i> My Jobs <a class="btn btn-danger btn-post" href="/my-jobs-manage"><span class="fa fa-plus-circle"></span> Add new Job<div class="ripple-container"></div></a></h2>
              <div class="table-responsive">
			  
			  <?php $filter_options = array('JOBS', 'Job', 'my-jobs-manage', 900, 950); include 'code/modules/members_manage_filter.php'; ?>
             
				<?php echo $finalPaging; ?>
                <table class="table table-striped table-bordered add-manage-table">
                 <?php echo $finalString; ?>
                  </tbody>
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