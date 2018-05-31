<?php

$app_id = FB_APP_ID;
$app_secret = FB_APP_SECRET;
$my_url = COMPANY_URL . 'auth-facebook';

$code = '';
if(isset($_GET["code"])){
	$code = $_GET["code"];
}

if(strlen($code) == 0) {
    $dialog_url = 'http://www.facebook.com/dialog/oauth?client_id=' . $app_id . '&redirect_uri=' . urlencode($my_url) . '&scope=email';
    //echo("<script> top.location.href='" . $dialog_url . "'</script>");
    header('Location: ' . $dialog_url);
    exit();
}

$token_url = 'https://graph.facebook.com/oauth/access_token?client_id=' . $app_id . '&redirect_uri=' . urlencode($my_url) . '&client_secret=' . $app_secret . '&code=' . $code;

$access_token = file_get_contents($token_url);
$graph_url = 'https://graph.facebook.com/me?' . $access_token;
$user = json_decode(file_get_contents($graph_url));

// See if this member exists
$fb_member_id = 0;
$sqlquery = mysql_query(sprintf("SELECT id FROM profiles WHERE member_id = '%s' AND member_type = '%s'",
			mysql_real_escape_string($user->id),
			mysql_real_escape_string('FACEBOOK')
			));
while($row = mysql_fetch_array($sqlquery)){ 
	$fb_member_id = $row['id'];
}

// If they exist, log them in
// If they don't exist, create profile and log them in
if($fb_member_id > 0){
	$_SESSION['Member_ID'] = $fb_member_id;
	mysql_query("UPDATE profiles SET date_login = " . time() . " WHERE id = " . $fb_member_id);
}else{
	$activation = sha1(time() . $user->email . create_guid(32));
	$salt = create_guid(40);
	$pass = create_guid(40);

	$sqlquery = mysql_query(sprintf("INSERT INTO profiles(company_name, contact_person, email, address, tel, fax, web, img1, member_id, member_type, date_created, date_edited, pass_word, salt, activation_guid, forgot_token, date_login, status) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d, %d, '%s', '%s', '%s', '%s', %d, %d)",
				mysql_real_escape_string(''),
				mysql_real_escape_string($user->name),
				mysql_real_escape_string($user->email),
				mysql_real_escape_string(''),
				mysql_real_escape_string(''),
				mysql_real_escape_string(''),
				mysql_real_escape_string(''),
				mysql_real_escape_string(''),
				mysql_real_escape_string($user->id),
				mysql_real_escape_string('FACEBOOK'),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(sha1($pass . $salt)),
				mysql_real_escape_string($salt),
				mysql_real_escape_string($activation),
				mysql_real_escape_string(''),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(1)
				));
				
	$new_fb_member_id = mysql_insert_id();
	
	$_SESSION['Member_ID'] = $new_fb_member_id;
}

header("Location: " . COMPANY_URL);
exit();

?>
