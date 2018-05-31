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
		
      
		  
		  <div class="col-md-8">
            <div class="head-faq text-center">
			  <?php echo $page_data[2]; ?>
            </div>
            <!-- accordion start -->
            <div class="panel-group" id="accordion">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                      How do I place an ad? 
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                  <div class="panel-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam consectetur sit amet ante nec vulputate. Nulla aliquam, justo auctor consequat tincidunt, arcu erat mattis lorem, lacinia lacinia dui enim at eros. Pellentesque ut gravida augue. Duis ac dictum tellus </p>
                    <br>
                    <p>
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute. non cupidatat skateboard dolor brunch. Foosd truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt alqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim ke ffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. 
                    </p>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                      Who shouldi to contact if i Have any question?
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                  <div class="panel-body">
                    <p>
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute. non cupidatat skateboard dolor brunch. Foosd truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt alqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim ke ffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. 
                    </p>
                    <br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam consectetur sit amet ante nec vulputate. Nulla aliquam, justo auctor consequat tincidunt, arcu erat mattis lorem, lacinia lacinia dui enim at eros. Pellentesque ut gravida augue. Duis ac dictum tellus </p>                    
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
                      How can i cancel or change my order?
                    </a>
                  </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false">
                  <div class="panel-body">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas expedita, repellendus est nemo cum quibusdam optio, voluptate hic a tempora facere, nihil non itaque alias similique quas quam odit consequatur.
                    </p>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="collapsed" aria-expanded="false">
                      How can i Return A Product?
                    </a>
                  </h4>
                </div>
                <div id="collapseFour" class="panel-collapse collapse" aria-expanded="false">
                  <div class="panel-body">
                    <p>
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute. non cupidatat skateboard dolor brunch. Foosd truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt alqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. 
                    </p>
                    <br>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident iure ab nisi, magnam vitae. Laboriosam laborum suscipit recusandae officia laudantium, consectetur adipisci voluptates doloremque quisquam. Id rerum iusto reprehenderit assumenda!
                    </p>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="collapsed" aria-expanded="false">
                      How Long will it take to get my package?
                    </a>
                  </h4>
                </div>
                <div id="collapseFive" class="panel-collapse collapse" aria-expanded="false">
                  <div class="panel-body">
                    <p>
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute. non cupidatat skateboard dolor brunch. Foosd truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt alqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                    </p>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix" class="collapsed" aria-expanded="false">
                      What shipping methods are available?
                    </a>
                  </h4>
                </div>
                <div id="collapseSix" class="panel-collapse collapse" aria-expanded="false">
                  <div class="panel-body">
                    <p>
                       Nihil anim ke ffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lome. Leggings occaecat. craft beer farmto-tab le, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Nihil anim keffiyeh helvetica, craft beer labore wes ande rso cred nesciunt sapiente ea proident Ad vegan excepteur butcher vice lomo. Leggings occaecat caaft beer farmto-tab le,
                    </p>
                    <br>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, aspernatur officia eos quibusdam sapiente ipsum a voluptas eum nihil at molestias doloremque praesentium inventore sint suscipit nobis eligendi atque omnis!
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <!-- accordion End -->    
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