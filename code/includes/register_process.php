<?php 

if(!isset($caller)){exit('Direct access not allowed.');}

$process_result = '';
			
$sqlquery = mysql_query(sprintf("UPDATE profiles SET status=1 WHERE activation_guid = '%s'",
			mysql_real_escape_string($listing_id)
			));

$num_affected = mysql_affected_rows();

if($num_affected > 0){
	$process_result = '<strong>Thank You</strong>, your account has now been activated, you may now login to the top of this page.';
}else{
	$process_result = '<strong>Error</strong>, your membership could not be activated. This may be because:<br /><br /><ul><li>Your account is already activated.</li><li>The activation token was invalid or does not exist.</li></ul>';
}

?>