<?php

function is_leap_year($year){
	if(date('L', strtotime('01 January ' . $year))){
		return true;
	}else{
		return false;
	}
}

function sift($str, $option){
	
	$string = '';
	
	switch($option){
		case 'ALPHA':
			$allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
			break;
		case 'URL':
			$allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_ /';
			$str = html_entity_decode($str); // Convert HTML entities to their actual characters to prevent incorrect SEO URL, e.g. &amp; may cause -amp- in URL
			break;
	}

	for($i=0; $i<strlen($str); $i++){
		if(strpos($allowed, $str[$i]) !== false){
			$string .= $str[$i];
		}
	}
	
	if($option == 'URL'){
		$string = str_replace(' ', '-', $string);
	}
	
	return $string;
	
}

function month_to_number($month){
	$months = array(
	'January' => 1,
	'February' => 2,
	'March' => 3,
	'April' => 4,
	'May' => 5,
	'June' => 6,
	'July' => 7,
	'August' => 8,
	'September' => 9,
	'October' => 10,
	'November' => 11,
	'December' => 12
	);
	return $months[$month];
}

function url_strip($str){
	$str = str_replace('http://', '', $str);
	if($str[strlen($str)-1] === '/'){
		$str = substr($str, 0, strlen($str)-1);
	}
	return $str;
}

function email_scramble($str){
	$str = str_replace('@', '&#64;', $str);
	$str = str_replace('.', '&#46;', $str);
	return $str;
}

function log_error($str, $status){
	$sqlquery = mysql_query(sprintf("INSERT INTO logs_security(title, ip, status, date_created) VALUES('%s', '%s', '%s', " . time() . ")",
				mysql_real_escape_string($str),
				mysql_real_escape_string($_SERVER['REMOTE_ADDR']),
				mysql_real_escape_string($status)
				));
}

function create_guid($max) {

    $chars = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //srand((double)microtime()*1000000);
    $i = 0;
    $pass = '';

    while ($i < $max) {
        $num = rand() % 62;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }

    return $pass;

}

function text_mail($to, $from, $from_display_name='', $subject, $message){
     $headers = $from_display_name == '' ? "From: ".$from : "From: ".$from_display_name." <".$from.">";       
     return @mail($to, $subject, $message, $headers);     
}

function text_mail_cc($to, $from, $from_display_name='', $subject, $message, $cc){
     $headers = ($from_display_name == '' ? "From: ".$from : "From: ".$from_display_name." <".$from.">") . "\r\n";  
     if(strlen($cc) > 2){$headers .= 'Cc: ' . $cc . "\r\n";}
     return @mail($to, $subject, $message, $headers);     
}

function safe_alt($str){
	$str = str_replace('"', '&quot;', $str);
	$str = str_replace(' & ', ' &amp; ', $str);
	return $str;
}

function number_f($num){
	return number_format($num, 0, '.', ',');
}

function filter_out($str){
	//return htmlentities($str);
	return htmlspecialchars($str);
}

function filer_out_limit($str){
	$str = str_replace(' & ', ' &amp; ', $str);
	return $str;
}

function filter_in($str){
	return $str;
}

function month_by_number($num){
	$m = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	return $m[$num-1];
}

function chop_text($string, $limit, $break, $pad) { 

	if(strlen($string) <= $limit){
		return $string; 
	}

	if(false !== ($breakpoint = strpos($string, $break, $limit))) { 
		if($breakpoint < strlen($string) - 1) { 
			$string = substr($string, 0, $breakpoint) . $pad; 
		} 
	} 
	
	return $string; 
}

function seo($str){
	$seo_string = '';
	$seo_allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_ /'; // [space] char between _ and /
	
	// Convert HTML entities to their actual characters to prevent incorrect SEO URL, e.g. &amp; may cause -amp- in URL
	$str = html_entity_decode($str);
	
	for($i=0; $i<strlen($str); $i++){
		if(strpos($seo_allowed, $str[$i]) !== false){
			$seo_string .= $str[$i];
		}
	}
	
	$seo_string = str_replace(' ', '-', $seo_string);
	
	return $seo_string;
}

function seofile($str){
	$seo_string = '';
	$seo_allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_ '; // [space] char between _ and /
	
	// Convert HTML entities to their actual characters to prevent incorrect SEO URL, e.g. &amp; may cause -amp- in URL
	$str = html_entity_decode($str);
	
	for($i=0; $i<strlen($str); $i++){
		if(strpos($seo_allowed, $str[$i]) !== false){
			$seo_string .= $str[$i];
		}
	}
	
	$seo_string = str_replace(' ', '-', $seo_string);
	
	return $seo_string;
}

function seoemail($str){
	$seo_string = '';
	$seo_allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_.'; // [space] char between _ and /
	
	// Convert HTML entities to their actual characters to prevent incorrect SEO URL, e.g. &amp; may cause -amp- in URL
	$str = html_entity_decode($str);
	
	for($i=0; $i<strlen($str); $i++){
		if(strpos($seo_allowed, $str[$i]) !== false){
			$seo_string .= $str[$i];
		}
	}
	
	$seo_string = str_replace(' ', '-', $seo_string);
	
	return $seo_string;
}

function email_safe($str){
	// Prevent SMTP injection by preventing addition of more headers
	$str = str_replace("\r", '', $str);
    $str = str_replace("\n", '', $str);
    $str = trim($str);
    
	if (ereg("[\r\n]", $str)) {
		return '';
	}else{
		return htmlentities($str);
	}
}

function unix_diff($time1, $time2){

	$time_period = ($time1 - $time2);

	$days = 0;
	$hours = 0;
	$minutes = 0;
	$seconds = 0;

	$time_increments = array('Days' => 86400,
	'Hours' => 3600,
	'Minutes' => 60,
	'Seconds' => 1);

	$time_span = array();

	while(list($key, $value) = each( $time_increments )) {
		$this_value = (int)($time_period / $value);
		$time_period = ($time_period % $value);
		$time_span[$key] = $this_value;
	}

	$final_send = $time_span['Days'];
	if($final_send == 1){
		$final_send .= ' day';
	}else{
		$final_send .= ' days';
	}
	
	return $final_send;

}

function safe_input($str){
	$str = strip_tags($str);
	$str = htmlentities($str);
	return $str;
}

function js_esc($str){
	$str = str_replace("'", "\'", $str);
	return $str;
}

function test_link($str){
	if(strpos($str, 'http://') === false){
		$str = 'http://' . $str;
	}
	return $str;
}

function get_the_ip(){
	return $_SERVER['REMOTE_ADDR'];
}

function send_mail_text($to_email, $to_cc, $to_bcc, $from_email, $from_name, $subject, $msg){
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = EMAIL_HOST;
	$mail->SMTPKeepAlive = true;
		
	if(strlen(EMAIL_USERNAME) > 0){
		$mail->SMTPAuth = true;
		$mail->Host = EMAIL_HOST;
		$mail->Port = EMAIL_PORT;
		$mail->Username = EMAIL_USERNAME;
		$mail->Password = EMAIL_PASSWORD;
	}
		
	$mail->SetFrom($from_email, $from_name);
	$mail->AddReplyTo($from_email, $from_name);
	$mail->Subject = $subject;
					
	//$mail->AltBody = 'This message is in HTML format and requires a HTML compatible email client. Alternatively, you may view this newsletter online at ' . COMPANY_URL . 'newsletter/' . $id;
	//$mail->MsgHTML($msg);
	$mail->Body = $msg;
	
	// For multiple
	$ar_emails = explode(',', $to_email);
	foreach($ar_emails as $to_email){
		$mail->AddAddress($to_email);
	}
	
	if(!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	
	$mail->ClearAddresses();	
}

function check_perms($section, $permission_string){
	$perms = explode(',', $permission_string);
	if(in_array($section, $perms)){
		return true;
	}else{
		return false;
	}
}

function push_recent($title, $url){

	if(isset($_SESSION['Recently_Accessed'])){
		$recent_list = unserialize($_SESSION['Recently_Accessed']);
	}else{
		$recent_list = array();
	}
	
	// Now check if it exists, if it does, remove it and add it
	foreach($recent_list as $k => $v){
		if($k == $title){
			unset($recent_list[$k]);
		}
	}
	$recent_list[$title] = $url;
	
	// Check if items not more than 10, if it is, pop off last one
	if(count($recent_list) > 10){
		//$recent_list = array_shift($recent_list);
		array_shift($recent_list);
	}
	
	$_SESSION['Recently_Accessed'] = serialize($recent_list);
}

function encrypt($string, $key) {
$result = '';
for($i=0; $i<strlen($string); $i++) {
$char = substr($string, $i, 1);
$keychar = substr($key, ($i % strlen($key))-1, 1);
$char = chr(ord($char)+ord($keychar));
$result.=$char;
}

return base64_encode($result);
}

function decrypt($string, $key) {
$result = '';
$string = base64_decode($string);

for($i=0; $i<strlen($string); $i++) {
$char = substr($string, $i, 1);
$keychar = substr($key, ($i % strlen($key))-1, 1);
$char = chr(ord($char)-ord($keychar));
$result.=$char;
}

return $result;
} 

function int_phone($str){
	if(strlen($str) == 10){
		$t = '+27 (0)';
		for($i=0; $i<10; $i++){
			if($i == 3){$t .= ' ';}
			if($i == 6){$t .= ' ';}
			if($i > 0){$t .= $str[$i];}
		}
		return $t;
	}else{
		return $str;
	}
}

function kwit($kw_sr){
	$kw_sr = '%' . str_replace(' ', '%', $kw_sr) . '%';
	return $kw_sr;
}

?>