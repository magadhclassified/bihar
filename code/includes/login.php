<?php

session_start();

include('../../config.php');
include('conn.php');
include('functions.php');

$user = $_POST['u'];
$pass = $_POST['p'];

$valid = false;

$sqlquery = mysql_query(sprintf("SELECT * FROM profiles WHERE status = 1 AND email = '%s'",
            mysql_real_escape_string($user)));
   
while($row = mysql_fetch_array($sqlquery)){ 
	if($row['pass_word'] === sha1($pass . $row['salt'])){
		$valid = true;
		$member_id = (int)$row['id'];
		$_SESSION['Member_ID'] = $member_id;
		mysql_query("UPDATE profiles SET date_login = " . time() . " WHERE id = " . $member_id);
	}
}

if($valid){
	//header('Location: ' . $_SERVER['HTTP_REFERER']);
	//if(strpos($_SERVER['HTTP_REFERER'], 'error') !== false || strpos($_SERVER['HTTP_REFERER'], 'process') !== false){
		header('Location: ../../home');
	//}else{
		//header('Location: ' . $_SERVER['HTTP_REFERER']);
	//}
}else{
	header('Location: ../../login-error');
}

?>