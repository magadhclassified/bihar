<form method="post" action="code/includes/search_proxy_members.php">
<div class="table-action">
                  <div class="table-search pull-right col-xs-7">
                    <div class="form-group is-empty">
                      <label class="col-xs-5 control-label text-right">Filter by: <br>
                        <!--<a href="#clear" class="clear-filter" title="clear filter">[clear]</a> -->
                      </label>
                      <div class="col-xs-7 searchpan">

                        <select class="form-control" name="status">
<option value="-1">&nbsp;Show All</option>
<option value="1"<?php if($search_data_m_status == 1){echo ' selected="selected"';} ?>>&nbsp;Active Listings</option>
<option value="0"<?php if($search_data_m_status == 0){echo ' selected="selected"';} ?>>&nbsp;Pending Listings</option>
</select>

<input type="text" name="kw" value="<?php if(strlen($search_data_m_kw) > 0){echo $search_data_m_kw;}else{echo 'Listing Title...';} ?>" onfocus="if(this.value=='Listing Title...'){this.value='';}" onblur="if(this.value==''){this.value='Listing Title...';}" id="filter" class="form-control"/>

<input type="hidden" name="origin" value="<?php echo $filter_options[0]; ?>" />

<input type="submit" name="memberfilter-submit1" class="btn btn-common" value="" />


                      </div>
                    <span class="material-input"></span></div>
                  </div>
                </div>
</form>

<!--
<div class="memberfilterby">
<span class="filterbyspan">Filter by:</span>
<span class="selectbox"><img class="selectleft" src="ajax/custom-forms/select-left-border.png" alt="" height="26" width="3" />
<select class="styled2" name="status">
<option value="-1">&nbsp;Show All</option>
<option value="1"<?php if($search_data_m_status == 1){echo ' selected="selected"';} ?>>&nbsp;Active Listings</option>
<option value="0"<?php if($search_data_m_status == 0){echo ' selected="selected"';} ?>>&nbsp;Pending Listings</option>
</select></span>

<span class="field"><input type="text" name="kw" value="<?php if(strlen($search_data_m_kw) > 0){echo $search_data_m_kw;}else{echo 'Listing Title...';} ?>" onfocus="if(this.value=='Listing Title...'){this.value='';}" onblur="if(this.value==''){this.value='Listing Title...';}" /></span>

<input type="submit" name="memberfilter-submit1" class="memberfilter-submitlion" value="" />

<a class="buttons highslide" href="<?php echo $filter_options[2]; ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe',  objectWidth: <?php echo $filter_options[3]; ?>, objectHeight: <?php echo $filter_options[4]; ?> } )"><span class="leftborder">&nbsp;</span><span class="buttondetail">Add New <?php echo $filter_options[1]; ?> Entry</span><span class="rightborder">&nbsp;</span></a>
<input type="hidden" name="origin" value="<?php echo $filter_options[0]; ?>" />
</div>
</form>

<?php if(strlen($finalPaging) > 0){ ?><div class="membersortby_darren"></div><?php } ?>
-->