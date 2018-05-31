<?php if(!isset($is_caller)){die('Restricted access.');} ?>

<?php if(isset($section_items)){ ?>
<div class="section">				
<div class="title_wrapper">
<h2>Section Menu</h2>
<span class="title_wrapper_left"></span>
<span class="title_wrapper_right"></span>
</div>				
<div class="section_content">						
<div class="sct">
<div class="sct_left">
<div class="sct_right">
<div class="sct_left">
<div class="sct_right">
<ul class="sidebar_menu">
<?php
$section_cnt = 0;
$section_str = '';
for($g=0; $g<count($section_items); $g++){
	$section_cnt++;
	if($section_cnt == count($section_items)){
		$section_str .= '<li class="last"><a href="' . $section_items[$g][1] . '">' . $section_items[$g][0] . '</a></li>';
	}else{
		$section_str .= '<li><a href="' . $section_items[$g][1] . '">' . $section_items[$g][0] . '</a></li>';
	}
}
echo $section_str;
?>
</ul>
</div>
</div>
</div>
</div>
</div>						
<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
</div>
</div>
<?php } ?>

<div class="section">				
<div class="title_wrapper">
<h2>Recently Accessed</h2>
<span class="title_wrapper_left"></span>
<span class="title_wrapper_right"></span>
</div>				
<div class="section_content">						
<div class="sct">
<div class="sct_left">
<div class="sct_right">
<div class="sct_left">
<div class="sct_right">
<ul class="sidebar_menu">
<?php
$recent_l = unserialize($_SESSION['Recently_Accessed']);
$recent_str = '';
$recent_cnt = 0;
foreach($recent_l as $k => $v){
	$recent_cnt++;
	if($recent_cnt == 1){
		$recent_str = '<li class="last"><a href="' . $v . '">' . $k . '</a></li>' . $recent_str;
	}else{
		$recent_str = '<li><a href="' . $v . '">' . $k . '</a></li>' . $recent_str;
	}
}
echo $recent_str;
?>
</ul>
</div>
</div>
</div>
</div>
</div>						
<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
</div>
</div>