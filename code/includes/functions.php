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

function kwit($kw_sr){
	$kw_sr = '%' . str_replace(' ', '%', $kw_sr) . '%';
	return $kw_sr;
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



function safe_alt($str){
	$str = str_replace('"', '&quot;', $str);
	$str = str_replace(' & ', ' &amp; ', $str);
	return $str;
}

function number_f($num){
	return number_format($num, 0, '.', ',');
}

function number_f2($num){
	return number_format($num, 2, '.', ',');
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
        $str = strtolower($str);
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
	/*if($final_send == 1){
		$final_send .= ' day';
	}else{
		$final_send .= ' days';
	}*/
	
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

function get_page_title($title){
	// See if a title file exists, if not, create it dynamically and pass the path if it wasn't already dynamically created
	//clearstatcache();

	if(file_exists('graphics/titles/' . strtolower(seo($title)) . '.gif')){
		return 'graphics/titles/' . strtolower(seo($title)) . '.gif';
	}else if(file_exists('files/dyn_titles/' . strtolower(seo($title)) . '.gif')){
		return 'files/dyn_titles/' . strtolower(seo($title)) . '.gif';
	}else{
		// Build the image
		$im = imagecreatetruecolor(460, 65);
		$text = imagecolorallocate($im, 0xE2, 0xAD, 0x1D);
		$bg = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);

		imagefilledrectangle($im, 0, 0, 460, 65, $bg);

		$font_file = 'files/dyn_titles/dali.ttf';

		imagefttext($im, 27, 0, 1, 38, $text, $font_file, $title);

		imagegif($im, 'files/dyn_titles/' . strtolower(seo($title)) . '.gif');
		imagedestroy($im);

		return 'files/dyn_titles/' . strtolower(seo($title)) . '.gif';
	}
}

function get_the_ip(){
	return $_SERVER['REMOTE_ADDR'];
}

function send_mail_text($to_email, $to_cc, $to_bcc, $from_email, $from_name, $subject, $msg){
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = EMAIL_HOST;
	$mail->SMTPKeepAlive = true;
	$mail->CharSet = 'UTF-8';
		
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

function seotag($str){
	$seo_string = '';
	$seo_allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_ '; // [space] char between _ and /
	
	// Convert HTML entities to their actual characters to prevent incorrect SEO URL, e.g. &amp; may cause -amp- in URL
	$str = html_entity_decode(trim($str));
	
	for($i=0; $i<strlen($str); $i++){
		if(strpos($seo_allowed, $str[$i]) !== false){
			$seo_string .= $str[$i];
		}
	}
	
	$seo_string = str_replace(' ', '-', $seo_string);
	
	return $seo_string;
}

function make_clickable($text) {

	$text = preg_replace('/(((f|ht){1}tp:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1">\\1</a>', $text);
	$text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2">\\2</a>', $text);
	$text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1">\\1</a>', $text);

	return $text;

}

function get_bookmarks($title, $url){
	$title = urlencode($title);
	$url = urlencode($url);
	
	$str = '<div class="book-rollover"><a rel="nofollow" href="http://delicious.com/save?url=' . $url . '&amp;title=' . $title . '" class="del">Delicious</a></div>
			<div class="book-rollover"><a rel="nofollow" href="http://digg.com/submit?url=' . $url . '&amp;title=' . $title . '" class="dig">Digg</a></div>
			<div class="book-rollover"><a rel="nofollow" href="http://www.facebook.com/share.php?u=' . $url . '&amp;t=' . $title . '" class="fac">Facebook</a></div>
			<div class="book-rollover"><a rel="nofollow" href="http://www.google.com/bookmarks/mark?op=edit&amp;bkmk=' . $url . '" class="goo">Google</a></div>
			<div class="book-rollover"><a rel="nofollow" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=' . $url . '&amp;title=' . $title . '&amp;summary=' . $title . '" class="lin">Linkedin</a></div>
			<div class="book-rollover"><a rel="nofollow" href="http://www.myspace.com/Modules/PostTo/Pages/?u=' . $url . '" class="mys">Myspace</a></div>
			<div class="book-rollover"><a rel="nofollow" href="http://reddit.com/submit?url=' . $url . '&amp;title=' . $title . '" class="red">Reddit</a></div>
			<div class="book-rollover"><a rel="nofollow" href="http://www.stumbleupon.com/submit?url=' . $url . '&amp;title=' . $title . '" class="stu">Stumbleupon</a></div>
			<div class="book-rollover"><a rel="nofollow" href="http://technorati.com/faves?add=' . $url . '" class="tec">Technorati</a></div>
			<div class="book-rollover"><a rel="nofollow" href="http://buzz.yahoo.com/submit/?submitUrl=' . $url . '&amp;submitHeadline=' . $title . '" class="buz">Buzz Yahoo</a></div>';
	return $str;
}

function get_fb_like($url){
	if(strpos($url, 'http://') === false){
		$url = COMPANY_URL . $url;
	}
	return '<fb:like href="' . $url . '" layout="button_count" show_faces="false"></fb:like>';
}

function safe_word($str){
	$seo_string = '';
	$seo_allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_ '; // [space] char between _ and /
	
	// Convert HTML entities to their actual characters to prevent incorrect SEO URL, e.g. &amp; may cause -amp- in URL
	$str = html_entity_decode($str);
	
	for($i=0; $i<strlen($str); $i++){
		if(strpos($seo_allowed, $str[$i]) !== false){
			$seo_string .= $str[$i];
		}
	}
	
	//$seo_string = str_replace(' ', '-', $seo_string);
	
	return $seo_string;
}

function make_fancy($str){
	$finalstr = '';
	$parts = explode(' ', $str);
	if(count($parts) > 1){
		$finalstr = $parts[0] . ' ';// . $parts[1] . ' ';
		// Remove these 2 words
		//array_shift($parts);
		array_shift($parts);
		//$finalstr .= '<strong>' . implode(' ', $parts) . '</strong>';
		$finalstr .= implode(' ', $parts);
	}else{
		$finalstr = $str ;
	}
	return '<strong>'.$finalstr. '</strong>';
}

function get_crumbs($titles, $urls){
	$crumb_count = 0;
	$str_bread = '<div id="breadcrumbs"><a class="first" href="home">Home</a>';
	
	foreach($titles as $v){
		if(strlen($v) > 0){
			$str_bread .= '<a ' . (($crumb_count+1) == count($titles) ? ' class="currentpage"' : '') . ' href="' . $urls[$crumb_count] . '">' . $v . '</a>';
			$crumb_count++;
		}
	}
	
	$str_bread .= '</div>';
	return $str_bread;
}

function get_banners($zone, $page){
	$str_banner = '';
	$sqlquery = mysql_query(sprintf('SELECT banners.id, banners.title, banners.image_file, banners.image_link, banners.banner_code FROM banners INNER JOIN banners_details ON banners_details.banner_id = banners.id WHERE banners_details.zone_id = %d AND banners_details.page_id = %d AND banners.date_from < %d AND banners.date_to > %d AND banners.status=1 ORDER BY banners.id DESC',
				mysql_real_escape_string($zone),
				mysql_real_escape_string($page),
				mysql_real_escape_string(time()),
				mysql_real_escape_string(time())
				));

	while($row = mysql_fetch_array($sqlquery)){ 
		$banner_id = filer_out_limit($row['id']);
		$banner_title = filer_out_limit($row['title']);
		$banner_img = filer_out_limit($row['image_file']);
		$banner_url = filer_out_limit($row['image_link']);
		$banner_code = filer_out_limit($row['banner_code']);
		
		if(strlen($banner_code) > 0){
			$str_banner .= $banner_code;
		}else{
			$str_banner .= '<div class="col-sm-4"><div class="inner-box"><div class="widget-title"><h4>Advertisement</h4></div><a href="' . $banner_url . '" rel="nofollow"><img src="files/promo/' . $banner_img . '" alt="' . safe_alt($banner_title) . '" title="' . safe_alt($banner_title) . '" /></a> </div>
            </div>';
		}
	}
	return $str_banner;
}

?>