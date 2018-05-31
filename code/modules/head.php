<base href="<?php echo COMPANY_URL; ?>" />
<meta http-equiv="pragma" content="no-cache" />
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">  
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

<?php if(isset($page_data[4]) && strlen($page_data[4]) > 0){ ?>
<meta name="keywords" content="<?php echo safe_alt($page_data[4]); ?>" />
<?php }else{ ?>
<meta name="keywords" content="" />
<?php } ?>
<?php if(isset($page_data[3]) && strlen($page_data[3]) > 0){ ?>
<meta name="description" content="<?php echo safe_alt($page_data[3]); ?>" />
<?php }else{ ?>
<meta name="description" content="" />
<?php } ?>
<?php if(isset($url)){echo '<link rel="canonical" href="' . $url . '" />';} ?>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /> 
 
 
     
    <link rel="stylesheet" href="code/css/bootstrap.min.css" type="text/css">    
    <link rel="stylesheet" href="code/css/jasny-bootstrap.min.css" type="text/css">    
    <link rel="stylesheet" href="code/css/jasny-bootstrap.min.css" type="text/css">
    <!-- Material CSS -->
    <link rel="stylesheet" href="code/css/material-kit.css" type="text/css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="code/css/font-awesome.min.css" type="text/css">
        <!-- Line Icons CSS -->
    <link rel="stylesheet" href="code/fonts/line-icons/line-icons.css" type="text/css">
        <!-- Line Icons CSS -->
    <link rel="stylesheet" href="code/fonts/line-icons/line-icons.css" type="text/css">
    <!-- Main Styles -->
    <link rel="stylesheet" href="code/css/main.css" type="text/css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="code/css/animate.css" type="text/css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="code/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="code/css/owl.theme.css" type="text/css">    
    <!-- Responsive CSS Styles -->
    <link rel="stylesheet" href="code/css/responsive.css" type="text/css">
    <!-- Slicknav js -->
    <link rel="stylesheet" href="code/css/slicknav.css" type="text/css">
        <!-- Bootstrap Select -->
    <link rel="stylesheet" href="code/css/bootstrap-select.min.css">

    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>


    <script type="text/javascript">
//<![CDATA[
function trim(text){
	text = text.replace(/^\s+/, "");
	text = text.replace(/\s+$/, "");
	text = text.replace(/\s+/g, " ");
	return text;
}
function check_form(objForm, arFields, arChecks){
	var fm = objForm;
	
	for(var i=0; i<arFields.length; i++){
		var choice = arChecks[i];
		if(choice != 'MATCH'){
			var fv = eval('fm.' + arFields[i] + '.value'); // Field Value
			var f = eval('fm.' + arFields[i]); // Field object reference
		}	
		switch(choice){
			case 'TEXT':
				if(trim(fv).length == 0){
					alert('Please enter a value for this field.');
					f.focus();
					return false;
				}
				break;
			case 'TEXT10':
				if(trim(fv).length != 10){
					alert('Please enter a value for this field.');
					f.focus();
					return false;
				}
				break;
			case 'EMAIL':
				if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(trim(fv)))){
					alert('Please enter a valid email address.');
					f.focus();
					return false;
				}
				break;
			case 'LISTBOX':
				if(f.selectedIndex == 0){
					alert('Please select a value for this field.');
					f.focus();
					return false;
				}
				break;
			case 'PASSWORD':
				if(trim(fv).length < 8){
					alert('Please enter password of at least 8 characters.');
					f.focus();
					return false;
				}
				break;
			case 'PASSWORDEDIT':
				if(trim(fv).length > 0 && trim(fv).length < 8){
					alert('Please enter password of at least 8 characters.');
					f.focus();
					return false;
				}
				break;
			case 'MATCH':
				var f1 = eval('fm.' + arFields[i].split("-")[0]);
				var f2 = eval('fm.' + arFields[i].split("-")[1]);
				if(f1.value != f2.value){
					alert('Entered passwords must match.');
					f2.focus();
					return false;
				}
				break;
			case 'CHECK':
				if(!f.checked){
					alert('Please first check this box before proceeding.');
					f.focus();
					return false;
				}
				break;
		}
	}
	
	return true;
}


	function sto(divid){
	var targetOffset=0;
	if(divid != 0){
		targetOffset = $("#"+divid).offset().top;
	}
	$('html,body').animate({scrollTop: targetOffset}, 1000);
	}

</script>

<?php if(strlen($global_info[0]) > 0){ ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $global_info[0];?>']);
  _gaq.push(['_setDomainName', 'magadhclassified.com']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php } ?>

<?php if(strlen($global_info[1]) > 0){ ?>
<meta name="google-site-verification" content="<?php echo $global_info[1]; ?>" />
<?php } ?>

<?php echo $global_info[6]; ?>
	
