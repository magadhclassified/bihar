<?php

$featured_fp_events = '';
$featured_fp_events_extras = '';
$num_items_recycle = 0;

// ------------------------------------------------------------------------------------------------------------------------------

$sqlquery = mysql_query('SELECT id, title FROM events_types ORDER BY RAND() LIMIT 3');
while($row = mysql_fetch_assoc($sqlquery)){ 
	$field_t_id = filer_out_limit($row['id']);
	$field_t_title = filer_out_limit($row['title']);
	
	$featured_fp_events_extras .= '<a href="events-by-type/' . $field_t_id . '/' . seo($field_t_title) . '">' . $field_t_title . '</a>, ';
}

if(strlen($featured_fp_events_extras) > 0){$featured_fp_events_extras = substr($featured_fp_events_extras, 0, strlen($featured_fp_events_extras)-2);}

// ------------------------------------------------------------------------------------------------------------------------------

$sql = "SELECT events.id, events.member_id, events.title, events.price, events.date_to, events.date_from, events.img1, events.venue, events.brief, locations.title ltitle, profiles.company_name FROM events INNER JOIN locations ON events.geo2_id = locations.id INNER JOIN profiles ON events.member_id = profiles.id WHERE events.status=1 AND locations.status=1 AND events.is_fp = 1";
if($global_emirate_id > 0){$sql .= ' AND events.geo1_id = ' . $global_emirate_id;}
$sql .= ' ORDER BY events.date_created DESC LIMIT 10';

$sqlquery = mysql_query($sql);

while($row = mysql_fetch_assoc($sqlquery)){ 
	$num_items_recycle++;
	$field_t_id = filer_out_limit($row['id']);
	$field_t_member_id = filer_out_limit($row['member_id']);
	$field_t_member_company = filer_out_limit($row['company_name']);
	$field_t_title = filer_out_limit($row['title']);
	$field_t_price = filer_out_limit($row['price']);
	$field_t_brief = filer_out_limit($row['brief']);
	$field_t_img1 = filer_out_limit($row['img1']);
	$field_t_location = filer_out_limit($row['ltitle']);
	$field_t_venue = filer_out_limit($row['venue']);
	
	$field_t_dfrom = filer_out_limit($row['date_from']);
	$field_t_dto = filer_out_limit($row['date_to']);
	
	$event_string = date('d M', $field_t_dfrom);
	if(date('d M Y', $field_t_dto) != date('d M Y', $field_t_dfrom)){$event_string .= ' - ' . date('d M', $field_t_dto);}
	
	$url = 'event-details/' . $field_t_id . '/' . seo($field_t_title);
	if(strlen($field_t_img1) == 0){$field_t_img1 = 'none.jpg';}
	
	$featured_fp_events .= '<div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <a href="' . $url . '"><img src="files/events/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a>
                      <div class="overlay">
                        <a href="' . $url . '"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>
                    <a href="' . $url . '">' . $field_t_title . '<br>
                    '.$field_t_venue.', '. $field_t_location . '</a>   
                  </div>
                </div>';

	/*$featured_fp_events .= '<p><span class="frame"><a href="' . $url . '"><img src="files/events/promo/' . $field_t_img1 . '" alt="' . safe_alt($field_t_title) . '" title="' . safe_alt($field_t_title) . '" /></a></span><span class="text"><span class="title"><a href="' . $url . '">' . $field_t_title . '</a></span><span class="category">Location:</span> <strong class="category">' . $field_t_location . '</strong><span class="category">Venue:</span> <strong class="category">' . $field_t_venue . '</strong><br /><span class="category">Date:</span> <strong class="category">' . $event_string . '</strong><br />&nbsp;<br />' . substr($field_t_brief,0,355) . '...<br /><a class="buttons viewdetails" href="' . $url . '"><span class="leftborder">&nbsp;</span><span class="buttondetail">View Details</span><span class="rightborder">&nbsp;</span></a><a class="buttons" href="events"><span class="leftborder">&nbsp;</span><span class="buttondetail">View&nbsp;all&nbsp;Events</span><span class="rightborder">&nbsp;</span></a></span><span class="clear">&nbsp;</span><span class="viewmore">View events by type: ' . $featured_fp_events_extras . '</span></p>';*/

}

// ------------------------------------------------------------------------------------------------------------------------------

if(strlen($featured_fp_events) > 0){
?>
<section class="featured-lis" >
        <div class="container">
          <div class="row">
            <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
              <h3 class="section-title">Featured Events</h3>
              <div id="new-events" class="owl-carousel">
                <?php echo $featured_fp_events; ?>
              </div>
            </div> 
          </div></section>

<?php } ?>


<!--<div class="item">
<p class="header">
<strong>Featured Events</strong>
</p>

<div class="middle">
<div class="slideshow11">
<?php //echo $featured_fp_events; ?>
</div>
<span class="controlscontainers">
<a class="jFlowPlay" id="jFPlay11" href="#">&nbsp;</a>
<span class="controls11"></span>
</span>
</div>

<img class="bottomborder" src="graphics/fillers/content-bottom-borders-bg.png" alt="" />
</div> -->



