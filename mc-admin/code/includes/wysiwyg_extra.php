<?php if(!isset($is_caller)){exit('Direct access not allowed.');} ?><script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce_gzip.js"></script>

<script type="text/javascript">
//<![CDATA[
	tinyMCE_GZ.init({
		theme : "advanced",
		plugins : "paste,spellchecker,save,imagemanager,filemanager"
	});
//]]>
</script>

<script type="text/javascript">
//<![CDATA[
	tinyMCE.init({
		theme : "advanced",
		skin:"o2k7",
		mode : "exact",
		plugins : "paste,spellchecker,save,imagemanager,filemanager",
		elements : "elm2",
		content_css : "<?php echo COMPANY_URL . SYSTEM_ADMIN_FOLDER; ?>/cms.css",
		//doctype : '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
		theme_advanced_styles : "Bold=bold;Italic=italic;Underline=underline;Clear=clear;Image Left=image_left;Image Left with Border=image_left_with_border;Image Right=image_right;Image Right with Border=image_right_with_border;Image Wrap=image_wrap",
		theme_advanced_toolbar_align : "left",
		theme_advanced_toolbar_location : "top",
		theme_advanced_buttons1 : "bold,italic,separator,bullist,numlist,separator,cut,copy,paste,pasteword,removeformat,separator,undo,redo,separator,link,unlink,image,separator,charmap,code,separator,formatselect,separator,spellchecker",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		document_base_url : "<?php echo WEBSITE_ROOT; ?>",
		force_br_newlines : true,
        forced_root_block : "",
        spellchecker_rpc_url : "<?php echo COMPANY_URL . SYSTEM_ADMIN_FOLDER; ?>/tinymce/jscripts/tiny_mce/plugins/spellchecker/rpc.php",
		debug : true,
		valid_elements : "@[id|class|style|title|dir<ltr?rtl|lang|xml::lang|onclick|ondblclick|"
+ "onmousedown|onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|"
+ "onkeydown|onkeyup],a[rel|rev|charset|hreflang|tabindex|accesskey|type|"
+ "name|href|target|title|class|onfocus|onblur],strong/b,em/i,strike,u,"
+ "#p,-ol[type|compact],-ul[type|compact],-li,br,img[longdesc|usemap|"
+ "src|border|alt=|title|hspace|vspace|width|height|align],-sub,-sup,"
+ "-blockquote,-table[border=0|cellspacing|cellpadding|width|frame|rules|"
+ "height|align|summary|bgcolor|background|bordercolor],-tr[rowspan|width|"
+ "height|align|valign|bgcolor|background|bordercolor],tbody,thead,tfoot,"
+ "#td[colspan|rowspan|width|height|align|valign|bgcolor|background|bordercolor"
+ "|scope],#th[colspan|rowspan|width|height|align|valign|scope],caption,div,"
+ "-span,-code,-pre,address,-h1,-h2,-h3,-h4,-h5,-h6,hr[size|noshade],-font[face"
+ "|size|color],dd,dl,dt,cite,abbr,acronym,del[datetime|cite],ins[datetime|cite],"
+ "object[classid|width|height|codebase|*],param[name|value|_value],embed[type|width"
+ "|height|src|*],script[src|type],map[name],area[shape|coords|href|alt|target],bdo,"
+ "button,col[align|char|charoff|span|valign|width],colgroup[align|char|charoff|span|"
+ "valign|width],dfn,fieldset,form[action|accept|accept-charset|enctype|method],"
+ "input[accept|alt|checked|disabled|maxlength|name|readonly|size|src|type|value],"
+ "kbd,label[for],legend,noscript,optgroup[label|disabled],option[disabled|label|selected|value],"
+ "q[cite],samp,select[disabled|multiple|name|size],small,"
+ "textarea[cols|rows|disabled|name|readonly],tt,var,big"

	});
//]]>
</script>

<textarea id="elm2" name="elm2" style="width:645px;height:300px" rows="25" cols="20">
<?php if(isset($html_text2)){echo $html_text2;} ?>
</textarea>