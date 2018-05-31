<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

$_SESSION = array();
session_regenerate_id();
session_destroy();

header('Location: login');

?>