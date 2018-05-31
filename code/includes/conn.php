<?php
mysql_connect(DB_HOST,DB_USER,DB_PASS) or die('Could not make the connection!'); 
mysql_select_db(DB_NAME) or die('Could not select database!');
mysql_query("SET character_set_connection='utf8'");
mysql_query("SET collation_connection='utf8_general_ci'");
mysql_query('SET NAMES utf8');
?>