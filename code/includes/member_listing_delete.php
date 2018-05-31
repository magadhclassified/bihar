<?php

session_start();

include '../../config.php';
include 'conn.php';
include 'functions.php';

if(!isset($_SESSION['Member_ID'])){
	exit('Not logged in.');
}

$section = $_GET['s'];
$id = (int)$_GET['id'];

switch($section){
	case 'PROPERTY':
		
		$sql = mysql_query("select img1,img2,img3,img4 from properties where id = '$id'");
		$res = mysql_fetch_assoc($sql);
		$img1 = $res['img1'];
		$img2 = $res['img2'];
		$img3 = $res['img3'];
		$img4 = $res['img4'];
		unlink('../../files/property/featured/'.$img1);
		unlink('../../files/property/featured/'.$img2);
		unlink('../../files/property/featured/'.$img3);
		unlink('../../files/property/featured/'.$img4);
		unlink('../../files/property/fp/'.$img1);
		unlink('../../files/property/fp/'.$img2);
		unlink('../../files/property/fp/'.$img3);
		unlink('../../files/property/fp/'.$img4);
		unlink('../../files/property/thumb/'.$img1);
		unlink('../../files/property/thumb/'.$img2);
		unlink('../../files/property/thumb/'.$img3);
		unlink('../../files/property/thumb/'.$img4);
		unlink('../../files/property/small/'.$img1);
		unlink('../../files/property/small/'.$img2);
		unlink('../../files/property/small/'.$img3);
		unlink('../../files/property/small/'.$img4);
		unlink('../../files/property/promo/'.$img1);
		unlink('../../files/property/promo/'.$img2);
		unlink('../../files/property/promo/'.$img3);
		unlink('../../files/property/promo/'.$img4);
		unlink('../../files/property/original/'.$img1);
		unlink('../../files/property/original/'.$img2);
		unlink('../../files/property/original/'.$img3);
		unlink('../../files/property/original/'.$img4);
		unlink('../../files/property/medium/'.$img1);
		unlink('../../files/property/medium/'.$img2);
		unlink('../../files/property/medium/'.$img3);
		unlink('../../files/property/medium/'.$img4);
		
		mysql_query(sprintf("DELETE FROM properties WHERE id = %d AND member_id = %d", mysql_real_escape_string($id), mysql_real_escape_string($_SESSION['Member_ID'])));
		if(mysql_affected_rows() == 1){
			mysql_query(sprintf("DELETE FROM properties_amenities_details WHERE property_id = %d", mysql_real_escape_string($id)));
			mysql_query(sprintf("DELETE FROM properties_views_details WHERE property_id = %d", mysql_real_escape_string($id)));
		}
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", 0, 'MEMBER-DELETE', 'Properties (ID: " . $id . "), Member (ID: " . $_SESSION['Member_ID'] . ")', 'properties', " . $id . ")");
		header('Location: ../../my-properties');
		break;
	case 'MOTORS':
	
		$sql = mysql_query("select img1,img2,img3,img4 from motors where id = '$id'");
		$res = mysql_fetch_assoc($sql);
		$img1 = $res['img1'];
		$img2 = $res['img2'];
		$img3 = $res['img3'];
		$img4 = $res['img4'];
		unlink('../../files/motors/featured/'.$img1);
		unlink('../../files/motors/featured/'.$img2);
		unlink('../../files/motors/featured/'.$img3);
		unlink('../../files/motors/featured/'.$img4);
		unlink('../../files/motors/fp/'.$img1);
		unlink('../../files/motors/fp/'.$img2);
		unlink('../../files/motors/fp/'.$img3);
		unlink('../../files/motors/fp/'.$img4);
		unlink('../../files/motors/thumb/'.$img1);
		unlink('../../files/motors/thumb/'.$img2);
		unlink('../../files/motors/thumb/'.$img3);
		unlink('../../files/motors/thumb/'.$img4);
		unlink('../../files/motors/small/'.$img1);
		unlink('../../files/motors/small/'.$img2);
		unlink('../../files/motors/small/'.$img3);
		unlink('../../files/motors/small/'.$img4);
		unlink('../../files/motors/promo/'.$img1);
		unlink('../../files/motors/promo/'.$img2);
		unlink('../../files/motors/promo/'.$img3);
		unlink('../../files/motors/promo/'.$img4);
		unlink('../../files/motors/original/'.$img1);
		unlink('../../files/motors/original/'.$img2);
		unlink('../../files/motors/original/'.$img3);
		unlink('../../files/motors/original/'.$img4);
		unlink('../../files/motors/medium/'.$img1);
		unlink('../../files/motors/medium/'.$img2);
		unlink('../../files/motors/medium/'.$img3);
		unlink('../../files/motors/medium/'.$img4);
		
		mysql_query(sprintf("DELETE FROM motors WHERE id = %d AND member_id = %d", mysql_real_escape_string($id), mysql_real_escape_string($_SESSION['Member_ID'])));
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", 0, 'MEMBER-DELETE', 'Motors (ID: " . $id . "), Member (ID: " . $_SESSION['Member_ID'] . ")', 'motors', " . $id . ")");
		header('Location: ../../my-motors');
		break;
	case 'RECYCLE':
	
		$sql = mysql_query("select img1,img2,img3,img4 from recycle where id = '$id'");
		$res = mysql_fetch_assoc($sql);
		$img1 = $res['img1'];
		$img2 = $res['img2'];
		$img3 = $res['img3'];
		$img4 = $res['img4'];
		unlink('../../files/recycle/featured/'.$img1);
		unlink('../../files/recycle/featured/'.$img2);
		unlink('../../files/recycle/featured/'.$img3);
		unlink('../../files/recycle/featured/'.$img4);
		unlink('../../files/recycle/fp/'.$img1);
		unlink('../../files/recycle/fp/'.$img2);
		unlink('../../files/recycle/fp/'.$img3);
		unlink('../../files/recycle/fp/'.$img4);
		unlink('../../files/recycle/thumb/'.$img1);
		unlink('../../files/recycle/thumb/'.$img2);
		unlink('../../files/recycle/thumb/'.$img3);
		unlink('../../files/recycle/thumb/'.$img4);
		unlink('../../files/recycle/small/'.$img1);
		unlink('../../files/recycle/small/'.$img2);
		unlink('../../files/recycle/small/'.$img3);
		unlink('../../files/recycle/small/'.$img4);
		unlink('../../files/recycle/promo/'.$img1);
		unlink('../../files/recycle/promo/'.$img2);
		unlink('../../files/recycle/promo/'.$img3);
		unlink('../../files/recycle/promo/'.$img4);
		unlink('../../files/recycle/original/'.$img1);
		unlink('../../files/recycle/original/'.$img2);
		unlink('../../files/recycle/original/'.$img3);
		unlink('../../files/recycle/original/'.$img4);
		unlink('../../files/recycle/medium/'.$img1);
		unlink('../../files/recycle/medium/'.$img2);
		unlink('../../files/recycle/medium/'.$img3);
		unlink('../../files/recycle/medium/'.$img4);
		
		mysql_query(sprintf("DELETE FROM recycle WHERE id = %d AND member_id = %d", mysql_real_escape_string($id), mysql_real_escape_string($_SESSION['Member_ID'])));
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", 0, 'MEMBER-DELETE', 'Recycle (ID: " . $id . "), Member (ID: " . $_SESSION['Member_ID'] . ")', 'recycle', " . $id . ")");
		header('Location: ../../my-recycle');
		break;
	case 'JOBS':
		
		$sql = mysql_query("select img1 from jobs where id = '$id'");
		$res = mysql_fetch_assoc($sql);
		$img1 = $res['img1'];
		unlink('../../files/jobs/featured/'.$img1);
		unlink('../../files/jobs/fp/'.$img1);
		unlink('../../files/jobs/thumb/'.$img1);
		unlink('../../files/jobs/small/'.$img1);
		unlink('../../files/jobs/promo/'.$img1);
		unlink('../../files/jobs/original/'.$img1);
		unlink('../../files/jobs/medium/'.$img1);
		
		mysql_query(sprintf("DELETE FROM jobs WHERE id = %d AND member_id = %d", mysql_real_escape_string($id), mysql_real_escape_string($_SESSION['Member_ID'])));
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", 0, 'MEMBER-DELETE', 'Jobs (ID: " . $id . "), Member (ID: " . $_SESSION['Member_ID'] . ")', 'jobs', " . $id . ")");
		header('Location: ../../my-jobs');
		break;
	case 'DIRECTORY':
	
		$sql = mysql_query("select img1 from directory where id = '$id'");
		$res = mysql_fetch_assoc($sql);
		$img1 = $res['img1'];
		unlink('../../files/directory/featured/'.$img1);
		unlink('../../files/directory/fp/'.$img1);
		unlink('../../files/directory/thumb/'.$img1);
		unlink('../../files/directory/small/'.$img1);
		unlink('../../files/directory/promo/'.$img1);
		unlink('../../files/directory/original/'.$img1);
		unlink('../../files/directory/medium/'.$img1);
		
		mysql_query(sprintf("DELETE FROM directory WHERE id = %d AND member_id = %d", mysql_real_escape_string($id), mysql_real_escape_string($_SESSION['Member_ID'])));
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", 0, 'MEMBER-DELETE', 'Directory (ID: " . $id . "), Member (ID: " . $_SESSION['Member_ID'] . ")', 'directory', " . $id . ")");
		header('Location: ../../my-directory');
		break;
	case 'RESTAURANTS':
	
		$sql = mysql_query("select img1,img2,img3,img4 from restaurants where id = '$id'");
		$res = mysql_fetch_assoc($sql);
		$img1 = $res['img1'];
		$img2 = $res['img2'];
		$img3 = $res['img3'];
		$img4 = $res['img4'];
		unlink('../../files/restaurants/featured/'.$img1);
		unlink('../../files/restaurants/featured/'.$img2);
		unlink('../../files/restaurants/featured/'.$img3);
		unlink('../../files/restaurants/featured/'.$img4);
		unlink('../../files/restaurants/fp/'.$img1);
		unlink('../../files/restaurants/fp/'.$img2);
		unlink('../../files/restaurants/fp/'.$img3);
		unlink('../../files/restaurants/fp/'.$img4);
		unlink('../../files/restaurants/thumb/'.$img1);
		unlink('../../files/restaurants/thumb/'.$img2);
		unlink('../../files/restaurants/thumb/'.$img3);
		unlink('../../files/restaurants/thumb/'.$img4);
		unlink('../../files/restaurants/small/'.$img1);
		unlink('../../files/restaurants/small/'.$img2);
		unlink('../../files/restaurants/small/'.$img3);
		unlink('../../files/restaurants/small/'.$img4);
		unlink('../../files/restaurants/promo/'.$img1);
		unlink('../../files/restaurants/promo/'.$img2);
		unlink('../../files/restaurants/promo/'.$img3);
		unlink('../../files/restaurants/promo/'.$img4);
		unlink('../../files/restaurants/original/'.$img1);
		unlink('../../files/restaurants/original/'.$img2);
		unlink('../../files/restaurants/original/'.$img3);
		unlink('../../files/restaurants/original/'.$img4);
		unlink('../../files/restaurants/medium/'.$img1);
		unlink('../../files/restaurants/medium/'.$img2);
		unlink('../../files/restaurants/medium/'.$img3);
		unlink('../../files/restaurants/medium/'.$img4);
		mysql_query(sprintf("DELETE FROM restaurants WHERE id = %d AND member_id = %d", mysql_real_escape_string($id), mysql_real_escape_string($_SESSION['Member_ID'])));
		if(mysql_affected_rows() == 1){
			mysql_query(sprintf("DELETE FROM restaurants_cuisines_details WHERE restaurant_id = %d", mysql_real_escape_string($id)));
		}
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", 0, 'MEMBER-DELETE', 'Restaurants (ID: " . $id . "), Member (ID: " . $_SESSION['Member_ID'] . ")', 'restaurants', " . $id . ")");
		header('Location: ../../my-restaurants');
		break;
	case 'ACCOMMODATION':
	
		$sql = mysql_query("select img1,img2,img3,img4 from accommodation where id = '$id'");
		$res = mysql_fetch_assoc($sql);
		$img1 = $res['img1'];
		$img2 = $res['img2'];
		$img3 = $res['img3'];
		$img4 = $res['img4'];
		unlink('../../files/accommodation/featured/'.$img1);
		unlink('../../files/accommodation/featured/'.$img2);
		unlink('../../files/accommodation/featured/'.$img3);
		unlink('../../files/accommodation/featured/'.$img4);
		unlink('../../files/accommodation/fp/'.$img1);
		unlink('../../files/accommodation/fp/'.$img2);
		unlink('../../files/accommodation/fp/'.$img3);
		unlink('../../files/accommodation/fp/'.$img4);
		unlink('../../files/accommodation/thumb/'.$img1);
		unlink('../../files/accommodation/thumb/'.$img2);
		unlink('../../files/accommodation/thumb/'.$img3);
		unlink('../../files/accommodation/thumb/'.$img4);
		unlink('../../files/accommodation/small/'.$img1);
		unlink('../../files/accommodation/small/'.$img2);
		unlink('../../files/accommodation/small/'.$img3);
		unlink('../../files/accommodation/small/'.$img4);
		unlink('../../files/accommodation/promo/'.$img1);
		unlink('../../files/accommodation/promo/'.$img2);
		unlink('../../files/accommodation/promo/'.$img3);
		unlink('../../files/accommodation/promo/'.$img4);
		unlink('../../files/accommodation/original/'.$img1);
		unlink('../../files/accommodation/original/'.$img2);
		unlink('../../files/accommodation/original/'.$img3);
		unlink('../../files/accommodation/original/'.$img4);
		unlink('../../files/accommodation/medium/'.$img1);
		unlink('../../files/accommodation/medium/'.$img2);
		unlink('../../files/accommodation/medium/'.$img3);
		unlink('../../files/accommodation/medium/'.$img4);
	
		mysql_query(sprintf("DELETE FROM accommodation WHERE id = %d AND member_id = %d", mysql_real_escape_string($id), mysql_real_escape_string($_SESSION['Member_ID'])));
		if(mysql_affected_rows() == 1){
			mysql_query(sprintf("DELETE FROM accommodation_facilities_details WHERE accommodation_id = %d", mysql_real_escape_string($id)));
		}
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", 0, 'MEMBER-DELETE', 'Accommodation (ID: " . $id . "), Member (ID: " . $_SESSION['Member_ID'] . ")', 'accommodation', " . $id . ")");
		header('Location: ../../my-accommodation');
		break;
	case 'EVENTS':
	
		$sql = mysql_query("select img1 from events where id = '$id'");
		$res = mysql_fetch_assoc($sql);
		$img1 = $res['img1'];
		unlink('../../files/events/featured/'.$img1);
		unlink('../../files/events/fp/'.$img1);
		unlink('../../files/events/thumb/'.$img1);
		unlink('../../files/events/small/'.$img1);
		unlink('../../files/events/promo/'.$img1);
		unlink('../../files/events/original/'.$img1);
		unlink('../../files/events/medium/'.$img1);
		
		mysql_query(sprintf("DELETE FROM events WHERE id = %d AND member_id = %d", mysql_real_escape_string($id), mysql_real_escape_string($_SESSION['Member_ID'])));
		mysql_query("INSERT INTO logs_events(ip, date_created, user_id, c_action, c_location, c_table, c_id) VALUES ('" . get_the_ip() . "', " . time() . ", 0, 'MEMBER-DELETE', 'Events (ID: " . $id . "), Member (ID: " . $_SESSION['Member_ID'] . ")', 'events', " . $id . ")");
		header('Location: ../../my-events');
		break;
}	

?>