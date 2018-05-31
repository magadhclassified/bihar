<script type="text/javascript" src="code/scripts/jquery-ui-dialog/script.js"></script>
<link media="screen" rel="stylesheet" type="text/css" href="code/scripts/jquery-ui-dialog/redmond/jquery-ui-1.8rc1.custom.css"  />
<script type="text/javascript">
$(document).ready(function() {
	$("#dialog").dialog("destroy");
		
	$(".dialogs").dialog({
		height: 250,
		width: 350,
		autoOpen: false,
		modal: true
	});
});
function get_entry(){
    $('body').css('overflow','hidden'); //IE8 scrollbars fix
	$('#dialog-modal').dialog('open');
}
</script>