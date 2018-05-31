<?php
// This file also used when checking permissions in includes like add, edit, delete, etc.
if(!isset($is_caller)){exit('Direct access not allowed.');}

$sqlquery = mysql_query(sprintf("SELECT * FROM users WHERE id = %d",
			mysql_real_escape_string($_SESSION['Admin_ID'])
			));

while($row = mysql_fetch_array($sqlquery)){ 
	$account_name = filter_out($row['full_name']);
	$account_email = filter_out($row['email']);
	$account_type = filter_out($row['acc_type']);
	$account_permissions = filter_out($row['acc_permissions']);
	$account_temp = explode(' ', $account_name);
	$account_first_name = $account_temp[0];
}

?>