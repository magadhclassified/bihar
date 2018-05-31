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

    <!-- Start Content -->
    <div id="content">
    <div class="container">
        <div class="row">
          <div class="col-sm-3 page-sideabr">
            <aside>
              <div class="inner-box">
                <div class="user-panel-sidebar">
                  <div class="collapse-box">
                    <h5 class="collapset-title no-border">My Classified <a href="#myclassified" data-toggle="collapse" class="pull-right" aria-expanded="true"><i class="fa fa-angle-down"></i></a></h5>
                    <div class="panel-collapse collapse in" id="myclassified" aria-expanded="true">
                      <ul class="acc-list">
                        <li>
                          <a href="account-home.html"><i class="fa fa-home"></i> Personal Home</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="collapse-box">
                    <h5 class="collapset-title">My Ads <a href="#myads" data-toggle="collapse" class="pull-right" aria-expanded="true"><i class="fa fa-angle-down"></i></a></h5>
                    <div class="panel-collapse collapse in" id="myads" aria-expanded="true">
                      <ul class="acc-list">
                        <li class="active">
                          <a href="account-myads.html"><i class="fa fa-credit-card"></i> My Ads <span class="badge">44</span></a>
                        </li>
                        <li>
                          <a href="account-favourite-ads.html"><i class="fa fa-heart-o"></i> Favourite Ads <span class="badge">19</span></a>
                        </li>
                        <li>
                          <a href="account-saved-search.html"><i class="fa fa-star-o"></i> Saved Search <span class="badge">13</span></a>
                        </li>
                        <li>
                          <a href="account-archived-ads.html"><i class="fa fa-folder-o"></i> Archived Ads <span class="badge">49</span></a>
                        </li>
                        <li>
                          <a href="account-pending-approval-ads.html"><i class="fa fa-hourglass-o"></i> Pending Approval <span class="badge">33</span></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="collapse-box">
                    <h5 class="collapset-title">Terminate Account <a href="#close" data-toggle="collapse" class="pull-right" aria-expanded="true"><i class="fa fa-angle-down"></i></a></h5>
                    <div class="panel-collapse collapse in" id="close" aria-expanded="true">
                      <ul class="acc-list">
                        <li>
                          <a href="account-close.html"><i class="fa fa-close"></i> Close Account</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="inner-box">
                <div class="widget-title">
                  <h4>Advertisement</h4>
                </div>
                <img alt="" src="assets/img/img1.jpg">
              </div>
            </aside>
          </div>
          <div class="col-sm-9 page-content">
            <div class="inner-box">
              <h2 class="title-2"><i class="fa fa-hourglass-o"></i> Padding Approval</h2>
              <div class="table-responsive">
                <div class="table-action">
                  <div class="checkbox">
                    <label for="checkAll">
                      <input type="checkbox" onclick="checkAll(this)" id="checkAll"><span class="checkbox-material"></span>
                      Select: All | <a class="btn btn-xs btn-danger" href="#">Delete <i class="fa fa-close"></i></a>
                    </label>
                  </div>
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
                </div>
                <table class="table table-striped table-bordered add-manage-table">
                  <thead>
                    <tr>
                      <th data-type="numeric"></th>
                      <th>Photo</th>
                      <th>Adds Details</th>
                      <th>Price</th>
                      <th>Option</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="add-img-selector">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"><span class="checkbox-material"></span>
                          </label>
                        </div>
                      </td>
                      <td class="add-img-td">
                        <a href="ads-details.html">
                          <img alt="img" src="graphics/item/img-1.jpg" class="img-responsive">
                        </a>
                      </td>
                      <td class="ads-details-td">
                        <h4><a href="ads-details.html">Brand New All about iPhones</a></h4>
                        <p> <strong> Posted On </strong>:
                        02-Oct-2016, 04:38 PM </p>
                        <p> <strong>Visitors </strong>: 221 <strong>Located In:</strong> New York </p>
                      </td>
                      <td class="price-td">
                        <strong> $199</strong>
                      </td>
                      <td class="action-td">
                        <p><a class="btn btn-primary btn-xs"> <i class="fa fa-pencil-square-o"></i> Edit</a></p>
                        <p><a class="btn btn-info btn-xs"> <i class="fa fa-share-square-o"></i> Share</a></p>
                        <p><a class="btn btn-danger btn-xs"> <i class=" fa fa-trash"></i> Delete</a></p>
                      </td>
                    </tr>
                    <tr>
                      <td class="add-img-selector">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"><span class="checkbox-material"></span>
                          </label>
                        </div>
                      </td>
                      <td class="add-img-td">
                        <a href="ads-details.html">
                          <img alt="img" src="graphics/item/img-2.jpg" class="img-responsive">
                        </a>
                      </td>
                      <td class="ads-details-td">                        
                        <h4><a href="ads-details.html">Sony Xperia dual sim 100% brand new iPad</a></h4>
                        <p> <strong> Posted On </strong>:
                        02-Oct-2016, 04:38 PM </p>
                        <p> <strong>Visitors </strong>: 221 <strong>Located In:</strong> New York </p>                        
                      </td>
                      <td class="price-td">                        
                        <strong> $74</strong>                        
                      </td>
                      <td class="action-td">
                        <p><a class="btn btn-primary btn-xs"> <i class="fa fa-pencil-square-o"></i> Edit</a></p>
                        <p><a class="btn btn-info btn-xs"> <i class="fa fa-share-square-o"></i> Share</a></p>
                        <p><a class="btn btn-danger btn-xs"> <i class=" fa fa-trash"></i> Delete</a></p>
                      </td>
                    </tr>
                    <tr>
                      <td class="add-img-selector">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"><span class="checkbox-material"></span>
                          </label>
                        </div>
                      </td>
                      <td class="add-img-td">
                        <a href="ads-details.html">
                          <img alt="img" src="graphics/item/img-3.jpg" class="img-responsive">
                        </a>
                      </td>
                      <td class="ads-details-td">
                        <h4><a href="ads-details.html">Digital Cameras brand new</a></h4>
                        <p> <strong> Posted On </strong>:
                        02-Oct-2016, 04:38 PM </p>
                        <p> <strong>Visitors </strong>: 221 <strong>Located In:</strong> New York </p>
                      </td>
                      <td class="price-td">
                        <strong> $49</strong>
                      </td>
                      <td class="action-td">
                        <p><a class="btn btn-primary btn-xs"> <i class="fa fa-pencil-square-o"></i> Edit</a></p>
                        <p><a class="btn btn-info btn-xs"> <i class="fa fa-share-square-o"></i> Share</a></p>
                        <p><a class="btn btn-danger btn-xs"> <i class=" fa fa-trash"></i> Delete</a></p>
                      </td>
                    </tr>
                    <tr>
                      <td class="add-img-selector">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"><span class="checkbox-material"></span>
                          </label>
                        </div>
                      </td>
                      <td class="add-img-td">
                        <a href="ads-details.html">
                          <img alt="img" src="graphics/item/img-4.jpg" class="img-responsive">
                        </a>
                      </td>
                      <td class="ads-details-td">
                        <h4><a href="ads-details.html">Samsung Galaxy dual sim 100% brand new</a></h4>
                        <p> <strong> Posted On </strong>:
                        02-Oct-2016, 04:38 PM </p>
                        <p> <strong>Visitors </strong>: 221 <strong>Located In:</strong> New York </p>
                      </td>
                      <td class="price-td">
                        <strong> $149</strong>
                      </td>
                      <td class="action-td">
                        <p><a class="btn btn-primary btn-xs"> <i class="fa fa-pencil-square-o"></i> Edit</a></p>
                        <p><a class="btn btn-info btn-xs"> <i class="fa fa-share-square-o"></i> Share</a></p>
                        <p><a class="btn btn-danger btn-xs"> <i class=" fa fa-trash"></i> Delete</a></p>
                      </td>
                    </tr>
                    <tr>
                      <td class="add-img-selector">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"><span class="checkbox-material"></span>
                          </label>
                        </div>
                      </td>
                      <td class="add-img-td">
                        <a href="ads-details.html">
                          <img alt="img" src="graphics/item/img-5.jpg" class="img-responsive">
                        </a>
                      </td>
                      <td class="ads-details-td">
                        <h4><a href="ads-details.html">Brand New Macbook Pro</a></h4>
                        <p><strong> Posted On </strong>: <span>02-Oct-2016, 04:38 PM </span></p>
                        <p><strong>Visitors</strong>: <span>221</span> <strong>Located In:</strong> <span>New York</span></p>
                      </td>
                      <td class="price-td">
                        <strong> $168</strong>
                      </td>
                      <td class="action-td">
                        <p><a class="btn btn-primary btn-xs"> <i class="fa fa-pencil-square-o"></i> Edit</a></p>
                        <p><a class="btn btn-info btn-xs"> <i class="fa fa-share-square-o"></i> Share</a></p>
                        <p><a class="btn btn-danger btn-xs"> <i class=" fa fa-trash"></i> Delete</a></p>
                      </td>
                    </tr>
                  </tbody>
                </table>
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