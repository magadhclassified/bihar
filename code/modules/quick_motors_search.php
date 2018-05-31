<?php

// =================================================================================================================
// MOTORS
// =================================================================================================================

if(!isset($search_data_m_make)){
	$search_data_m_make = 0;
	$search_data_m_colour = 0;
	$search_data_m_type = 0;
	$search_data_m_kw = '';
}

$motors_makes_list = '';

$sqlquery = mysql_query('SELECT id, title FROM motors_makes_models WHERE status = 1 AND parent_id = 0 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$motors_makes_id = filer_out_limit($row['id']);
	$motors_makes_title = filer_out_limit($row['title']);
	$motors_makes_list .= '<option value="' . $motors_makes_id . '"' . ($search_data_m_make == $motors_makes_id ? ' selected="selected"' : '') . '>&nbsp;' . $motors_makes_title . '</option>';
}

$motors_colours_list = '';

$sqlquery = mysql_query('SELECT id, title FROM motors_colours WHERE status = 1 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$motors_colours_id = filer_out_limit($row['id']);
	$motors_colours_title = filer_out_limit($row['title']);
	$motors_colours_list .= '<option value="' . $motors_colours_id . '"' . ($search_data_m_colour == $motors_colours_id ? ' selected="selected"' : '') . '>&nbsp;' . $motors_colours_title . '</option>';
}

$motors_types_list = '';

$sqlquery = mysql_query('SELECT id, title FROM motors_types WHERE status = 1 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$motors_types_id = filer_out_limit($row['id']);
	$motors_types_title = filer_out_limit($row['title']);
	$motors_types_list .= '<option value="' . $motors_types_id . '"' . ($search_data_m_type == $motors_types_id ? ' selected="selected"' : '') . '>&nbsp;' . $motors_types_title . '</option>';
}
?>

 <div class="row search-bar">
              <div class="advanced-search">
                <form class="search-form" method="post" action="code/includes/search_proxy.php">
                  <div class="col-md-3 col-sm-6 search-col">
                    <div class="input-group-addon search-category-container">
                      <label class="styled-select">
                        <div class="btn-group bootstrap-select dropdown-product">
						
						<select class="dropdown-product selectpicker" name="mmake" tabindex="-98">
                          <option value="0">&nbsp;Show all Makes</option><?php echo $motors_makes_list; ?>
                        </select></div>                                    
                      </label>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6 search-col">
                    <div class="input-group-addon search-category-container">
                      <label class="styled-select location-select">
                        <div class="btn-group bootstrap-select dropdown-product">
						
						<select class="dropdown-product selectpicker" name="mcolour" tabindex="-98">
                          <option value="0">&nbsp;Show all Colours</option><?php echo $motors_colours_list; ?>
                        </select></div>                                    
                      </label>
                    </div>
                  </div>
				    <div class="col-md-3 col-sm-6 search-col">
                    <div class="input-group-addon search-category-container">
                      <label class="styled-select location-select">
                        <div class="btn-group bootstrap-select dropdown-product">
						
						<select class="dropdown-product selectpicker" name="mtype" tabindex="-98">
                          <option value="0">&nbsp;Show all Types</option><?php echo $motors_types_list; ?>
                        </select></div>                                    
                      </label>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6 search-col">
                    <div class="form-group is-empty"><input class="form-control keyword" name="kw" value="<?php if(strlen($search_data_m_kw) > 0){echo $search_data_m_kw;}else{echo 'Type your search...';} ?>" onfocus="if(this.value=='Type your search...'){this.value='';}" onblur="if(this.value==''){this.value='Type your search...';}" type="text"><span class="material-input"></span>
					<input type="hidden" name="origin" value="MOTORS" />
					</div>
                    <i class="fa fa-search"></i>
                  </div>
                  <div class="col-md-3 col-sm-6 search-col">
                    <button class="btn btn-common btn-search btn-block"><strong>Search</strong></button>
                  </div>
                </form>
              </div>
            </div>
            


<!--
<div id="quicksearch">
<p class="title">Quick Search</p>
<a id="quickt__property" class="typelinks qsproperty<?php echo ($site_section == 'PROPERTY' ? ' typelinksselected' : ''); ?>" href="#" onclick="switch_qs('property');return false;"><img src="graphics/icons/quicksearch-properties.png" alt="Property" title="Property" height="19" width="21" /><span>Property</span><img class="border" src="graphics/fillers/quicksearch-links-right-bg.png" alt="" /></a>
<a id="quickt__jobs" class="typelinks qsjobs<?php echo ($site_section == 'JOBS' ? ' typelinksselected' : ''); ?>" href="#" onclick="switch_qs('jobs');return false;"><img src="graphics/icons/quicksearch-jobs.png" alt="Jobs" title="Jobs" height="19" width="18" /><span>Jobs</span><img class="border" src="graphics/fillers/quicksearch-links-right-bg.png" alt="" /></a>
<a id="quickt__motors" class="typelinks qsmotors<?php echo ($site_section == 'MOTORS' ? ' typelinksselected' : ''); ?>" href="#" onclick="switch_qs('motors');return false;"><img src="graphics/icons/quicksearch-motors.png" alt="Motors" title="Motors" height="19" width="20" /><span>Motors</span><img class="border" src="graphics/fillers/quicksearch-links-right-bg.png" alt="" /></a>
<a id="quickt__directory" class="typelinks qsdirectory<?php echo ($site_section == 'DIRECTORY' ? ' typelinksselected' : ''); ?>" href="#" onclick="switch_qs('directory');return false;"><img src="graphics/icons/quicksearch-directory.png" alt="Directory" title="Directory" height="19" width="18" /><span>Directory</span><img class="border" src="graphics/fillers/quicksearch-links-right-bg.png" alt="" /></a>
<a id="quickt__recycle" class="typelinks qsrecycle<?php echo ($site_section == 'RECYCLE' ? ' typelinksselected' : ''); ?>" href="#" onclick="switch_qs('recycle');return false;"><img src="graphics/icons/quicksearch-recycle.png" alt="Recycle" title="Recycle" height="19" width="14" /><span>Recycle</span><img class="border" src="graphics/fillers/quicksearch-links-right-bg.png" alt="" /></a>
<a id="quickt__restaurants" class="typelinks qsrestaurants<?php echo ($site_section == 'RESTAURANTS' ? ' typelinksselected' : ''); ?>" href="#" onclick="switch_qs('restaurants');return false;"><img src="graphics/icons/quicksearch-restaurants.png" alt="Restaurants" title="Restaurants" /><span>Restaurants</span><img class="border" src="graphics/fillers/quicksearch-links-right-bg.png" alt="" /></a>
<a id="quickt__accommodation" class="typelinks qsaccommodation<?php echo ($site_section == 'ACCOMMODATION' ? ' typelinksselected' : ''); ?>" href="#" onclick="switch_qs('accommodation');return false;"><img src="graphics/icons/quicksearch-accommodation.png" alt="Accommodation" title="Accommodation" /><span>Hotels</span><img class="border" src="graphics/fillers/quicksearch-links-right-bg.png" alt="" /></a>
<a id="quickt__events" class="typelinks qsevents<?php echo ($site_section == 'EVENTS' ? ' typelinksselected' : ''); ?>" href="#" onclick="switch_qs('events');return false;"><img src="graphics/icons/quicksearch-events.png" alt="Events" title="Events" /><span>Events</span><img class="border" src="graphics/fillers/quicksearch-links-right-bg.png" alt="" /></a>
<div id="search">

<div id="quicks__jobs"<?php echo ($site_section == 'JOBS' ? '' : ' style="display:none;"'); ?>>
<form method="post" action="code/includes/search_proxy.php"><div>
<img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" /><span class="selectbox">
<select class="styled" name="jindustry" id="search-industries"><option value="0">&nbsp;Show all Industries</option><?php echo $jobs_industries_list; ?></select>
</span>
<span class="selectbox"><img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" />
<select class="styled" name="jcommitment" id="search-emirates"><option value="0">&nbsp;Show all Commitments</option><?php echo $jobs_commitments_list; ?></select>
</span>
<span class="selectbox"><img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" />
<select class="styled2" name="jtype" id="search-permajobs"><option value="0">&nbsp;Show all Types</option><?php echo $jobs_types_list; ?></select>
</span>
<span class="field"><input type="text" name="kw" id="search-keyword" value="<?php if(strlen($search_data_kw) > 0){echo $search_data_kw;}else{echo 'Type your search...';} ?>" onfocus="if(this.value=='Type your search...'){this.value='';}" onblur="if(this.value==''){this.value='Type your search...';}" /></span>
<input type="hidden" name="origin" value="JOBS" /><input type="submit" name="search-submit" id="search-submit" value="" />
</div>
</form>
</div>

<div id="quicks__motors"<?php echo ($site_section == 'MOTORS' ? '' : ' style="display:none;"'); ?>>
<form method="post" action="code/includes/search_proxy.php"><div>
<img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" /><span class="selectbox">
<select class="styled" name="mmake"><option value="0">&nbsp;Show all Makes</option><?php echo $motors_makes_list; ?></select>
</span>
<span class="selectbox"><img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" />
<select class="styled" name="mcolour"><option value="0">&nbsp;Show all Colours</option><?php echo $motors_colours_list; ?></select>
</span>
<span class="selectbox"><img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" />
<select class="styled2" name="mtype"><option value="0">&nbsp;Show all Types</option><?php echo $motors_types_list; ?></select>
</span>
<span class="field"><input type="text" name="kw" value="<?php if(strlen($search_data_m_kw) > 0){echo $search_data_m_kw;}else{echo 'Type your search...';} ?>" onfocus="if(this.value=='Type your search...'){this.value='';}" onblur="if(this.value==''){this.value='Type your search...';}" /></span>
<input type="hidden" name="origin" value="MOTORS" /><input type="submit" name="search-submit" id="search-submit2" value="" />
</div>
</form>
</div>

<div id="quicks__recycle"<?php echo ($site_section == 'RECYCLE' ? '' : ' style="display:none;"'); ?>>
<form method="post" action="code/includes/search_proxy.php"><div>
<img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" /><span class="selectbox">
<select class="styled" name="rcategory"><option value="0">&nbsp;Show all Categories</option><?php echo $recycle_categories_list; ?></select>
</span>
<span class="selectbox"><img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" />
<select class="styled" name="rcondition"><option value="0">&nbsp;Show all Conditions</option><?php echo $recycle_conditions_list; ?></select>
</span>
<span class="selectbox"><img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" />
<select class="styled2" name="rtype"><option value="0">&nbsp;Show all Types</option><?php echo $recycle_types_list; ?></select>
</span>
<span class="field"><input type="text" name="kw" value="<?php if(strlen($search_data_r_kw) > 0){echo $search_data_r_kw;}else{echo 'Type your search...';} ?>" onfocus="if(this.value=='Type your search...'){this.value='';}" onblur="if(this.value==''){this.value='Type your search...';}" /></span>
<input type="hidden" name="origin" value="RECYCLE" /><input type="submit" name="search-submit" id="search-submit3" value="" />
</div>
</form>
</div>

<div id="quicks__directory"<?php echo ($site_section == 'DIRECTORY' ? '' : ' style="display:none;"'); ?>>
<form method="post" action="code/includes/search_proxy.php"><div>
<img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" /><span class="selectbox">
<select class="styled" name="dcategory"><option value="0">&nbsp;Show all Categories</option><?php echo $directory_categories_list; ?></select>
</span>
<span class="field"><input type="text" name="kw" value="<?php if(strlen($search_data_d_kw) > 0){echo $search_data_d_kw;}else{echo 'Type your search...';} ?>" onfocus="if(this.value=='Type your search...'){this.value='';}" onblur="if(this.value==''){this.value='Type your search...';}" /></span>
<input type="hidden" name="origin" value="DIRECTORY" /><input type="submit" name="search-submit" id="search-submit4" value="" />
</div>
</form>
</div>

<div id="quicks__property"<?php echo ($site_section == 'PROPERTY' ? '' : ' style="display:none;"'); ?>>
<form method="post" action="code/includes/search_proxy.php"><div>
<img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" /><span class="selectbox">
<select class="styled" name="pcategory"><option value="0">&nbsp;Show all Categories</option><?php echo $properties_categories_list; ?></select>
</span>
<span class="selectbox"><img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" />
<select class="styled" name="plocation"><option value="0">&nbsp;Show all Locations</option><?php echo $properties_location_list; ?></select>
</span>
<span class="selectbox"><img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" />
<select class="styled2" name="ptype"><option value="0">&nbsp;Show all Types</option><?php echo $properties_types_list; ?></select>
</span>
<span class="field"><input type="text" name="kw" value="<?php if(strlen($search_data_p_kw) > 0){echo $search_data_p_kw;}else{echo 'Type your search...';} ?>" onfocus="if(this.value=='Type your search...'){this.value='';}" onblur="if(this.value==''){this.value='Type your search...';}" /></span>
<input type="hidden" name="origin" value="PROPERTY" /><input type="submit" name="search-submit" id="search-submit5" value="" />
</div>
</form>
</div>

<div id="quicks__restaurants"<?php echo ($site_section == 'RESTAURANTS' ? '' : ' style="display:none;"'); ?>>
<form method="post" action="code/includes/search_proxy.php"><div>
<img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" /><span class="selectbox">
<select class="styled" name="xcuisine"><option value="0">&nbsp;Show all Cuisines</option><?php echo $restaurants_cuisines_list; ?></select>
</span>
<span class="selectbox"><img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" />
<select class="styled" name="xmenu"><option value="0">&nbsp;Show all Menus</option><?php echo $restaurants_menus_list; ?></select>
</span>
<span class="selectbox"><img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" />
<select class="styled2" name="xdresscode"><option value="0">&nbsp;Show all Dress Codes</option><?php echo $restaurants_dresscode_list; ?></select>
</span>
<span class="field"><input type="text" name="kw" value="<?php if(strlen($search_data_x_kw) > 0){echo $search_data_x_kw;}else{echo 'Type your search...';} ?>" onfocus="if(this.value=='Type your search...'){this.value='';}" onblur="if(this.value==''){this.value='Type your search...';}" /></span>
<input type="hidden" name="origin" value="RESTAURANTS" /><input type="submit" name="search-submit" id="search-submit6" value="" />
</div>
</form>
</div>

<div id="quicks__accommodation"<?php echo ($site_section == 'ACCOMMODATION' ? '' : ' style="display:none;"'); ?>>
<form method="post" action="code/includes/search_proxy.php"><div>
<img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" /><span class="selectbox">
<select class="styled" name="atype"><option value="0">&nbsp;Show all Types</option><?php echo $accommodation_types_list; ?></select>
</span>
<span class="selectbox"><img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" />
<select class="styled" name="arating"><option value="0">&nbsp;Show all Ratings</option><?php echo $accommodation_ratings_list; ?></select>
</span>
<span class="field"><input type="text" name="kw" value="<?php if(strlen($search_data_a_kw) > 0){echo $search_data_a_kw;}else{echo 'Type your search...';} ?>" onfocus="if(this.value=='Type your search...'){this.value='';}" onblur="if(this.value==''){this.value='Type your search...';}" /></span>
<input type="hidden" name="origin" value="ACCOMMODATION" /><input type="submit" name="search-submit" id="search-submit7" value="" />
</div>
</form>
</div>

<div id="quicks__events"<?php echo ($site_section == 'EVENTS' ? '' : ' style="display:none;"'); ?>>
<form method="post" action="code/includes/search_proxy.php"><div>
<img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" /><span class="selectbox">
<select class="styled" name="etype"><option value="0">&nbsp;Show all Types</option><?php echo $events_types_list; ?></select>
</span>
<span class="field"><input type="text" name="kw" value="<?php if(strlen($search_data_e_kw) > 0){echo $search_data_e_kw;}else{echo 'Type your search...';} ?>" onfocus="if(this.value=='Type your search...'){this.value='';}" onblur="if(this.value==''){this.value='Type your search...';}" /></span>
<input type="hidden" name="origin" value="EVENTS" /><input type="submit" name="search-submit" id="search-submit8" value="" />
</div>
</form>
</div>

<?php if(DB_USER != 'root'){ ?>
<div class="addthis_toolbox addthis_default_style addthisdiv">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_11"></a>
<span class="addthis_separator">|</span>
<a href="http://www.addthis.com/bookmark.php?v=250&amp;username=<?php echo $global_info[10]; ?>" class="addthis_button_compact">Share</a>
<a class="addthis_button_facebook_like" fb:like:action="recommend" fb:like:width="125" style="float:right; margin-top:-3px;"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=<?php echo $global_info[10]; ?>"></script>
<?php } ?>

</div>
</div>
-->