<?php if(!isset($is_caller)){die('Restricted access.');} ?>
<base href="<?php echo COMPANY_URL . SYSTEM_ADMIN_FOLDER . '/'; ?>" />
<link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
<!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta name="robots" content="noindex, nofollow" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="cache-control" content="no-cache, must-revalidate" />
<meta name="GOOGLEBOT" content="noarchive" />

<script type="text/javascript" src="js/behaviour.js"></script>
<script type="text/javascript" src="code/scripts/jquery.js"></script>

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
		var fv = eval('fm.' + arFields[i] + '.value'); // Field Value
		var f = eval('fm.' + arFields[i]); // Field object reference
		var choice = arChecks[i];
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
		}
	}
	
	return true;
}
function permission_check(strPerm){
	if(strPerm == 'SUPERADMIN'){
		$('#permissions_row').hide();
	}else{
		$('#permissions_row').show();
	}
}
function send_nl(intID, strType){
	if(strType == 'SEND'){
		if(confirm('Are you sure you want to send the newsletter to all the subscribers?')){
			$('#ajxl' + intID).show();
			$('#ajxb1' + intID).hide();
			$('#ajxb2' + intID).hide();
			$('#nfmdo' + intID).val(strType);
			$('#nfm' + intID).submit();
		}
	}else{
		if(confirm('This will send the newsletter to the "From Email" address specified. Would you like to continue?')){
			$('#ajxl' + intID).show();
			$('#ajxb1' + intID).hide();
			$('#ajxb2' + intID).hide();
			$('#nfmdo' + intID).val(strType);
			$('#nfm' + intID).submit();
		}
	}
	
}
function show_pages_list(intParent){
	$.ajax({type: "POST", url: "code/includes/banners_ajax_pages.php?_r=" + Math.random(), complete: show_pages_list_update, data: {pid: intParent}});
}
function show_pages_list_update(transport){
	response = transport.responseText;
	$("#banner_pages_zone").html('<ul class="inline">' + response + '</ul>');
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