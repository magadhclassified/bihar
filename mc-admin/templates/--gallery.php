<?php if(!isset($is_caller)){exit('Direct access not allowed.');} ?><?php include 'code/includes/gallery_info.php'; ?><?php include 'code/includes/gallery_list.php'; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SYSTEM_NAME; ?>: Content: Gallery</title>
<?php include 'code/modules/head.php'; ?>
<?php include 'code/modules/head_extra.php'; ?>
</head>
<body>
<div id="wrapper">
<?php include 'code/modules/header.php'; ?>
<div id="content">
<div id="page">
<div class="inner">

<div class="section"><div class="title_wrapper"><h2>Gallery</h2><span class="title_wrapper_left"></span><span class="title_wrapper_right"></span></div><div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<?php if(isset($_SESSION['FormAction'])){if($_SESSION['FormAction'] == 'ERROR'){$_SESSION['FormAction']=''; ?> 
<ul class="system_messages"><li class="red"><span class="ico"></span><strong class="system_title">There was an error processing the selected image!</strong></li></ul>
<?php }} ?>
<p>Manage your gallery photos below. To add a new photo, please click the ADD NEW button below. Galleries may be assigned to editor pages and directory listings.<br /><br />
<a href="gallery/add" class="button add_new"><span><span>ADD NEW</span></span></a><br />
</p>																															
</div></div></div></div></div><span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span></div></div>

<div class="section"><div class="title_wrapper"><h2>Show Photos by Album</h2><span class="title_wrapper_left"></span><span class="title_wrapper_right"></span></div><div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<table style="width:660px;border:0px;" cellspacing="2" cellpadding="2">
  <tr>
    <td><select name="album" style="width:200px;" id="gal__album"><option value="0">All Albums</option><?php echo $albums_search_listbox; ?></select> <input type="button" value="Show" onclick="window.location.href='<?php echo COMPANY_URL . SYSTEM_ADMIN_FOLDER; ?>/gallery/page-1-' + $('#gal__album').val();" /></td>
  </tr>
</table>																															
</div></div></div></div></div><span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span></div></div>

<?php if($form_item_count > 0 && !$listing_form){ ?>
<div class="section table_section"><div class="title_wrapper">
<h2>Gallery</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span></div><div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">							<div  id="product_list"><div class="table_wrapper"><div class="table_wrapper_inner">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<th>Date</th>												
<th>Photo</th>			
<th>Title</th>										
<th>Actions</th>
</tr>
<?php echo $form_item_data; ?>											
</tbody></table>
</div></div></div>
<?php echo $form_item_paging; ?>	
</div></div></div></div></div><span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span></div></div>
<?php } ?>

<?php if($listing_form){ ?>
<div class="section">
<div class="title_wrapper">
<h2>Photo</h2>
<span class="title_wrapper_left"></span><span class="title_wrapper_right"></span>
</div>
<div class="section_content"><div class="sct"><div class="sct_left"><div class="sct_right"><div class="sct_left"><div class="sct_right">
<form action="code/includes/gallery_manage.php" class="search_form general_form" method="post" enctype="multipart/form-data" id="webdev_form" onsubmit="return check_form(this, ['title', 'cat'], ['TEXT', 'LISTBOX']);">
<fieldset>
<div class="forms">
<div class="row"><label>Title:</label>
<div class="inputs"><span class="input_wrapper huge_input"><input class="text" name="title" type="text" value="<?php echo $item_title; ?>" /></span>														
</div></div>		
<div class="row"><label>Date:</label>
<div class="inputs"><span class="input_wrapper large_input"><input readonly="readonly" class="text datepicker" name="date" type="text" value="<?php echo date('d F Y', $item_date); ?>" /></span>														
</div></div>											

<div class="row"><label>Album:</label><div class="inputs"><span class="input_wrapper blank">
<select name="cat">
<option value="0">Please Select...</option>
<?php echo $albums_listbox; ?>
</select></span></div></div>	

<div class="row"><label>Image:</label>
<div class="inputs"><span class="input_wrapper blank"><input name="frm_upload" type="file" /></span><?php if(strlen($item_image) > 0){ ?><span class="system">&nbsp;&nbsp;&nbsp;[<a href="../files/gallery/large/<?php echo $item_image; ?>" onclick="return!window.open(this.href);" title="header=[Preview] body=[&lt;img src='../files/gallery/large/<?php echo $item_image; ?>' alt='' title='' /&gt;]">Current</a>]</span><?php } ?></div>
</div>

<div class="row">
<label>Active?</label>
<div class="inputs">							
<ul class="inline">
<li><input class="checkbox" name="active" value="yes" type="checkbox"<?php if($item_active == 1){echo ' checked="checked"';} ?> /></li>
</ul></div></div>
								
<div class="row"><div class="buttons">															
<ul><li><span class="button send_form_btn"><span><span>SAVE</span></span><input type="hidden" name="id" value="<?php echo $listing_id; ?>" /><input type="hidden" name="oldimg" value="<?php echo $item_image; ?>" /><input name="" type="submit" /></span></li></ul>															       
</div></div></div>
</fieldset>
</form>																										
</div></div></div></div></div>					
<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>					
</div></div>
<?php } ?>
			
</div>
</div>
<div id="sidebar">
<div class="inner">
<?php include 'code/modules/side_menu.php'; ?>
<?php include 'code/modules/side_quick.php'; ?>
</div>
</div>
</div>
</div>
<?php include 'code/modules/footer.php'; ?>
</body>
</html>