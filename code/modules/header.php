    <div class="header">    
      <nav class="navbar navbar-default main-navigation" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <!-- Stat Toggle Nav Link For Mobiles -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- End Toggle Nav Link For Mobiles -->
            <a class="navbar-brand logo" href="/"><img src="assets/img/logo.png" alt=""></a>
          </div>
          <!-- brand and toggle menu for mobile End -->

          <!-- Navbar Start -->
          <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav navbar-right">
			<?php if(isset($_SESSION['Member_ID'])){ ?>
			<li><i class="lnr lnr-enter"></i> Hello, <a href="my-dashboard" title="Click to view your Dashboard"><?php echo ucfirst($member_name); ?></a></li>
              <li><a href="/logoff"><i class="lnr lnr-user"></i> Logout</a></li>
              <li class="postadd">
                <a class="btn btn-danger btn-post" href="/post-ads"><span class="fa fa-plus-circle"></span> Post Free Ad</a>
              </li>
			<?php } else { ?>
			<li><a href="/login"><i class="lnr lnr-enter"></i> Login</a></li>
              <li><a href="/register"><i class="lnr lnr-user"></i> Signup</a></li>
              <li class="postadd">
                <a class="btn btn-danger btn-post" href="/login"><span class="fa fa-plus-circle"></span> Post Free Ad</a>
              </li>
			<?php } ?>
              
            </ul>
          </div>
          <!-- Navbar End -->
        </div>
      </nav>
      <!-- Off Canvas Navigation -->
      <div class="navmenu navmenu-default navmenu-fixed-left offcanvas"> 
      <!--- Off Canvas Side Menu -->
        <div class="close" data-toggle="offcanvas" data-target=".navmenu">
            <i class="fa fa-close"></i>
        </div>
          <h3 class="title-menu">Choose Your State</h3>
          <ul class="nav navmenu-nav"> <!--- Menu -->
            		<li><a href="http://bihar.magadhclassified.com">Bihar</a></li>
			<li><a href="http://jharkhand.magadhclassified.com">Jharkhand</a></li>
			<li><a href="http://uttarpradesh.magadhclassified.com">Uttar Pradesh</a></li>
			<li><a href="http://orissa.magadhclassified.com">Orissa</a></li>
			<li><a href="http://westbengal.magadhclassified.com">West Bengal</a></li>
            
        </ul><!--- End Menu -->
      </div> <!--- End Off Canvas Side Menu -->
      <div class="tbtn wow pulse" id="menu" data-wow-iteration="infinite" data-wow-duration="500ms" data-toggle="offcanvas" data-target=".navmenu">
        <p><i class="fa fa-file-text-o"></i> All States</p>
      </div>
    </div>