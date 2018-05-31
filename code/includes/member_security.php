<?php

if(!isset($_SESSION['Member_ID'])){
	header('Location: ' . WEBSITE_ROOT . 'home');
	exit();
}

?>