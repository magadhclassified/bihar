<?php

// =================================================================================================================
// JOBS
// =================================================================================================================

if(!isset($search_data_industry)){
	$search_data_industry = 0;
	$search_data_commitment = 0;
	$search_data_type = 0;
	$search_data_kw = '';
}

$jobs_industries_list = '';

$sqlquery = mysql_query('SELECT id, title FROM jobs_industries WHERE status = 1 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$jobs_industries_id = filer_out_limit($row['id']);
	$jobs_industries_title = filer_out_limit($row['title']);
	$jobs_industries_list .= '<option value="' . $jobs_industries_id . '"' . ($search_data_industry == $jobs_industries_id ? ' selected="selected"' : '') . '>&nbsp;' . $jobs_industries_title . '</option>';
}

$jobs_commitments_list = '';

$sqlquery = mysql_query('SELECT id, title FROM jobs_commitments WHERE status = 1 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$jobs_commitments_id = filer_out_limit($row['id']);
	$jobs_commitments_title = filer_out_limit($row['title']);
	$jobs_commitments_list .= '<option value="' . $jobs_commitments_id . '"' . ($search_data_commitment == $jobs_commitments_id ? ' selected="selected"' : '') . '>&nbsp;' . $jobs_commitments_title . '</option>';
}

$jobs_types_list = '';

$sqlquery = mysql_query('SELECT id, title FROM jobs_types WHERE status = 1 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$jobs_types_id = filer_out_limit($row['id']);
	$jobs_types_title = filer_out_limit($row['title']);
	$jobs_types_list .= '<option value="' . $jobs_types_id . '"' . ($search_data_type == $jobs_types_id ? ' selected="selected"' : '') . '>&nbsp;' . $jobs_types_title . '</option>';
}

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

// =================================================================================================================
// RECYCLE
// =================================================================================================================

if(!isset($search_data_r_category)){
	$search_data_r_category = 0;
	$search_data_r_condition = 0;
	$search_data_r_type = 0;
	$search_data_r_kw = '';
}

$recycle_categories_list = '';

$sqlquery = mysql_query('SELECT id, title FROM recycle_categories WHERE status = 1 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$recycle_categories_id = filer_out_limit($row['id']);
	$recycle_categories_title = filer_out_limit($row['title']);
	$recycle_categories_list .= '<option value="' . $recycle_categories_id . '"' . ($search_data_r_category == $recycle_categories_id ? ' selected="selected"' : '') . '>&nbsp;' . $recycle_categories_title . '</option>';
}

$recycle_conditions_list = '';

$sqlquery = mysql_query('SELECT id, title FROM recycle_conditions WHERE status = 1 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$recycle_conditions_id = filer_out_limit($row['id']);
	$recycle_conditions_title = filer_out_limit($row['title']);
	$recycle_conditions_list .= '<option value="' . $recycle_conditions_id . '"' . ($search_data_r_condition == $recycle_conditions_id ? ' selected="selected"' : '') . '>&nbsp;' . $recycle_conditions_title . '</option>';
}

$recycle_types_list = '';

$sqlquery = mysql_query('SELECT id, title FROM recycle_types WHERE status = 1 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$recycle_types_id = filer_out_limit($row['id']);
	$recycle_types_title = filer_out_limit($row['title']);
	$recycle_types_list .= '<option value="' . $recycle_types_id . '"' . ($search_data_r_type == $recycle_types_id ? ' selected="selected"' : '') . '>&nbsp;' . $recycle_types_title . '</option>';
}

// =================================================================================================================
// DIRECTORY
// =================================================================================================================

if(!isset($search_data_d_category)){
	$search_data_d_category = 0;
	$search_data_d_kw = '';
}

$directory_categories_list = '';

$sqlquery = mysql_query('SELECT id, title FROM directory_categories WHERE status = 1 AND parent_id = 0 ORDER BY ordering ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$directory_categories_id = filer_out_limit($row['id']);
	$directory_categories_title = filer_out_limit($row['title']);
	
	$directory_categories_list .= '<optgroup label="' . $directory_categories_title . '">';
	
	// ----------------------------------------------------------------------------------------------------------------------------------
	
	$sqlquery2 = mysql_query('SELECT id, title FROM directory_categories WHERE status = 1 AND parent_id = ' . (int)$directory_categories_id . ' ORDER BY ordering ASC');
	while($row2 = mysql_fetch_assoc($sqlquery2)){ 
		$directoryx_categories_id = filer_out_limit($row2['id']);
		$directoryx_categories_title = filer_out_limit($row2['title']);
		
		$directory_categories_list .= '<option value="' . $directoryx_categories_id . '"' . ($search_data_d_category == $directoryx_categories_id ? ' selected="selected"' : '') . '>&nbsp; - &nbsp;' . $directoryx_categories_title . '</option>';
	}
	
	// ----------------------------------------------------------------------------------------------------------------------------------
	
	$directory_categories_list .= '</optgroup>';
	
}

// =================================================================================================================
// PROPERTY
// =================================================================================================================

if(!isset($search_data_p_category)){
	$search_data_p_category = 0;
	$search_data_p_location = 0;
	$search_data_p_type = 0;
	$search_data_p_kw = '';
}

$properties_categories_list = '';

$sqlquery = mysql_query('SELECT id, title FROM properties_categories WHERE status = 1 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$properties_categories_id = filer_out_limit($row['id']);
	$properties_categories_title = filer_out_limit($row['title']);
	$properties_categories_list .= '<option value="' . $properties_categories_id . '"' . ($search_data_p_category == $properties_categories_id ? ' selected="selected"' : '') . '>&nbsp;' . $properties_categories_title . '</option>';
}

$properties_location_list = '';

$sqlquery = mysql_query('SELECT id, title FROM locations WHERE status = 1' . ($global_emirate_id > 0 ? ' AND parent_id=' . (int)$global_emirate_id : ' AND parent_id IN (1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14)') . ' ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$properties_locations_id = filer_out_limit($row['id']);
	$properties_locations_title = filer_out_limit($row['title']);
	$properties_location_list .= '<option value="' . $properties_locations_id . '"' . ($search_data_p_location == $properties_locations_id ? ' selected="selected"' : '') . '>&nbsp;' . $properties_locations_title . '</option>';
}

$properties_types_list = '';

$sqlquery = mysql_query('SELECT id, title FROM properties_types WHERE status = 1 AND parent_id = 0 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$properties_types_id = filer_out_limit($row['id']);
	$properties_types_title = filer_out_limit($row['title']);
	
	$properties_types_list .= '<optgroup label="' . $properties_types_title . '">';
	
	// ----------------------------------------------------------------------------------------------------------------------------------
	
	$sqlquery2 = mysql_query('SELECT id, title FROM properties_types WHERE status = 1 AND parent_id = ' . (int)$properties_types_id . ' ORDER BY title ASC');
	while($row2 = mysql_fetch_assoc($sqlquery2)){ 
		$properties_typesx_id = filer_out_limit($row2['id']);
		$properties_typesx_title = filer_out_limit($row2['title']);
		
		$properties_types_list .= '<option value="' . $properties_typesx_id . '"' . ($search_data_p_type == $properties_typesx_id ? ' selected="selected"' : '') . '>&nbsp; - &nbsp;' . $properties_typesx_title . '</option>';
	}
	
	// ----------------------------------------------------------------------------------------------------------------------------------
	
	$properties_types_list .= '</optgroup>';
	
}

// =================================================================================================================
// RESTAURANTS
// =================================================================================================================

if(!isset($search_data_x_cuisine)){
	$search_data_x_cuisine = 0;
	$search_data_x_menu = 0;
	$search_data_x_dresscode = 0;
	$search_data_x_kw = '';
}

$restaurants_cuisines_list = '';

$sqlquery = mysql_query('SELECT id, title FROM restaurants_cuisines WHERE status = 1 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$restaurant_cuisine_id = filer_out_limit($row['id']);
	$restaurant_cuisine_title = filer_out_limit($row['title']);
	$restaurants_cuisines_list .= '<option value="' . $restaurant_cuisine_id . '"' . ($search_data_x_cuisine == $restaurant_cuisine_id ? ' selected="selected"' : '') . '>&nbsp;' . $restaurant_cuisine_title . '</option>';
}

$restaurants_menus_list = '';

$sqlquery = mysql_query('SELECT id, title FROM restaurants_menus WHERE status = 1 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$restaurant_menu_id = filer_out_limit($row['id']);
	$restaurant_menu_title = filer_out_limit($row['title']);
	$restaurants_menus_list .= '<option value="' . $restaurant_menu_id . '"' . ($search_data_x_menu == $restaurant_menu_id ? ' selected="selected"' : '') . '>&nbsp;' . $restaurant_menu_title . '</option>';
}

$restaurants_dresscode_list = '';

$sqlquery = mysql_query('SELECT id, title FROM restaurants_dresscodes WHERE status = 1 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$restaurant_dresscode_id = filer_out_limit($row['id']);
	$restaurant_dresscode_title = filer_out_limit($row['title']);
	$restaurants_dresscode_list .= '<option value="' . $restaurant_dresscode_id . '"' . ($search_data_x_dresscode == $restaurant_dresscode_id ? ' selected="selected"' : '') . '>&nbsp;' . $restaurant_dresscode_title . '</option>';
}

// =================================================================================================================
// ACCOMMODATION
// =================================================================================================================

if(!isset($search_data_a_type)){
	$search_data_a_type = 0;
	$search_data_a_rating = 0;
	$search_data_a_kw = '';
}

$accommodation_types_list = '';

$sqlquery = mysql_query('SELECT id, title FROM accommodation_types WHERE status = 1 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$accommodation_types_id = filer_out_limit($row['id']);
	$accommodation_types_title = filer_out_limit($row['title']);
	$accommodation_types_list .= '<option value="' . $accommodation_types_id . '"' . ($search_data_a_type == $accommodation_types_id ? ' selected="selected"' : '') . '>&nbsp;' . $accommodation_types_title . '</option>';
}

$accommodation_ratings_list = '';

$sqlquery = mysql_query('SELECT id, title FROM accommodation_ratings WHERE status = 1 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$accommodation_ratings_id = filer_out_limit($row['id']);
	$accommodation_ratings_title = filer_out_limit($row['title']);
	$accommodation_ratings_list .= '<option value="' . $accommodation_ratings_id . '"' . ($search_data_a_rating == $accommodation_ratings_id ? ' selected="selected"' : '') . '>&nbsp;' . $accommodation_ratings_title . '</option>';
}

// =================================================================================================================
// EVENTS
// =================================================================================================================

if(!isset($search_data_e_type)){
	$search_data_e_type = 0;
	$search_data_e_kw = '';
}

$events_types_list = '';

$sqlquery = mysql_query('SELECT id, title FROM events_types WHERE status = 1 ORDER BY title ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$events_types_id = filer_out_limit($row['id']);
	$events_types_title = filer_out_limit($row['title']);
	$events_types_list .= '<option value="' . $events_types_id . '"' . ($search_data_e_type == $events_types_id ? ' selected="selected"' : '') . '>&nbsp;' . $events_types_title . '</option>';
}

?>

 <div class="row search-bar">
              <div class="advanced-search">
                <form class="search-form" method="post" action="code/includes/search_proxy.php">
                  <div class="col-md-3 col-sm-6 search-col">
                    <div class="input-group-addon search-category-container">
                      <label class="styled-select">
                        <div class="btn-group bootstrap-select dropdown-product">
						
						<select class="dropdown-product selectpicker" name="pcategory" tabindex="-98">
                          <option value="0">&nbsp;Show all Categories</option><?php echo $properties_categories_list; ?>
                        </select></div>                                    
                      </label>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6 search-col">
                    <div class="input-group-addon search-category-container">
                      <label class="styled-select location-select">
                        <div class="btn-group bootstrap-select dropdown-product">
						
						<select class="dropdown-product selectpicker" name="plocation" tabindex="-98">
                          <option value="0">&nbsp;Show all Locations</option><?php echo $properties_location_list; ?>
                        </select></div>                                    
                      </label>
                    </div>
                  </div>
				    <div class="col-md-3 col-sm-6 search-col">
                    <div class="input-group-addon search-category-container">
                      <label class="styled-select location-select">
                        <div class="btn-group bootstrap-select dropdown-product">
						
						<select class="dropdown-product selectpicker" name="ptype" tabindex="-98">
                          <option value="0">&nbsp;Show all Types</option><?php echo $properties_types_list; ?>
                        </select></div>                                    
                      </label>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6 search-col">
                    <div class="form-group is-empty"><input class="form-control keyword" name="kw" value="<?php if(strlen($search_data_p_kw) > 0){echo $search_data_p_kw;}else{echo 'Type your search...';} ?>" onfocus="if(this.value=='Type your search...'){this.value='';}" onblur="if(this.value==''){this.value='Type your search...';}" type="text"><span class="material-input"></span>
					<input type="hidden" name="origin" value="PROPERTY" />
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