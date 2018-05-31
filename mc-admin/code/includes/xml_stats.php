<?php
header('Content-type: text/xml');
include '../../../config.php';
include 'conn.php';

$directory_active = 0;
$directory_inactive = 0;
$jobs_active = 0;
$jobs_inactive = 0;
$motors_active = 0;
$motors_inactive = 0;
$properties_active = 0;
$properties_inactive = 0;
$recycle_active = 0;
$recycle_inactive = 0;
$restaurants_active = 0;
$restaurants_inactive = 0;
$accommodation_active = 0;
$accommodation_inactive = 0;
$events_active = 0;
$events_inactive = 0;

$sqlquery = mysql_query('SELECT status FROM directory');
while($row = mysql_fetch_array($sqlquery)){ 
	if($row['status'] == 1){$directory_active++;}else{$directory_inactive++;}
}

$sqlquery = mysql_query('SELECT status FROM jobs');
while($row = mysql_fetch_array($sqlquery)){ 
	if($row['status'] == 1){$jobs_active++;}else{$jobs_inactive++;}
}

$sqlquery = mysql_query('SELECT status FROM motors');
while($row = mysql_fetch_array($sqlquery)){ 
	if($row['status'] == 1){$motors_active++;}else{$motors_inactive++;}
}

$sqlquery = mysql_query('SELECT status FROM properties');
while($row = mysql_fetch_array($sqlquery)){ 
	if($row['status'] == 1){$properties_active++;}else{$properties_inactive++;}
}

$sqlquery = mysql_query('SELECT status FROM recycle');
while($row = mysql_fetch_array($sqlquery)){ 
	if($row['status'] == 1){$recycle_active++;}else{$recycle_inactive++;}
}

$sqlquery = mysql_query('SELECT status FROM restaurants');
while($row = mysql_fetch_array($sqlquery)){ 
	if($row['status'] == 1){$restaurants_active++;}else{$restaurants_inactive++;}
}

$sqlquery = mysql_query('SELECT status FROM accommodation');
while($row = mysql_fetch_array($sqlquery)){ 
	if($row['status'] == 1){$accommodation_active++;}else{$accommodation_inactive++;}
}

$sqlquery = mysql_query('SELECT status FROM events');
while($row = mysql_fetch_array($sqlquery)){ 
	if($row['status'] == 1){$events_active++;}else{$events_inactive++;}
}

?>
<chart caption="Active and Inactive Listings" shownames="1" showvalues="0" decimals="0" bgColor="e7f3f8" showBorder="0" borderThickness="0" baseFontSize="10" labelDisplay="ROTATE" slantLabels="1">
<categories>
<category label="Accommodation" />
<category label="Directory" />
<category label="Events" />
<category label="Jobs" />
<category label="Motors" />
<category label="Properties" />
<category label="Recycle" />
<category label="Restaurants" />
</categories>
<dataset seriesName="Active" color="00FF00" showValues="0">
<set value="<?php echo $accommodation_active; ?>" />
<set value="<?php echo $directory_active; ?>" />
<set value="<?php echo $events_active; ?>" />
<set value="<?php echo $jobs_active; ?>" />
<set value="<?php echo $motors_active; ?>" />
<set value="<?php echo $properties_active; ?>" />
<set value="<?php echo $recycle_active; ?>" />
<set value="<?php echo $restaurants_active; ?>" />
</dataset>
<dataset seriesName="Inactive" color="FF0000" showValues="0">
<set value="<?php echo $accommodation_inactive; ?>" />
<set value="<?php echo $directory_inactive; ?>" />
<set value="<?php echo $events_inactive; ?>" />
<set value="<?php echo $jobs_inactive; ?>" />
<set value="<?php echo $motors_inactive; ?>" />
<set value="<?php echo $properties_inactive; ?>" />
<set value="<?php echo $recycle_inactive; ?>" />
<set value="<?php echo $restaurants_inactive; ?>" />
</dataset>
</chart>