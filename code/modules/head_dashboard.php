<base href="<?php echo COMPANY_URL; ?>" />
<meta http-equiv="pragma" content="no-cache" />
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">  
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
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
	
	
<!-- BROWSER DETECTION SCRIPTS -->
<script type="text/javascript" src="code/scripts/browser.js"></script>
<script type="text/javascript" src="code/scripts/detect.js"></script>

<script type="text/javascript" charset="utf-8">
     $(function(){ 
	 //$("select").uniform();
	  });
    </script>
    
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
function change_geo2(intParent){
	$.ajax({type: "POST", url: "code/includes/locations_ajax_geo2.php?_r=" + Math.random(), complete: geo2_update, data: {pid: intParent}});
	$.ajax({type: "POST", url: "code/includes/locations_ajax_geo3.php?_r=" + Math.random(), complete: geo3_update, data: {pid: -1}}); // Reset geo 3 box
}
function geo2_update(transport){
	response = transport.responseText;
	$("#geo2_zone").html(response);
}
function change_geo3(intParent){
	$.ajax({type: "POST", url: "code/includes/locations_ajax_geo3.php?_r=" + Math.random(), complete: geo3_update, data: {pid: intParent}});
}
function geo3_update(transport){
	response = transport.responseText;
	$("#geo3_zone").html(response);
}
//]]>
</script>    


