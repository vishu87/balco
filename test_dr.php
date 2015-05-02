<?php
require_once('config.php');
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
			mysql_query("ALTER TABLE students ADD COLUMN status_email VARCHAR(2) AFTER email, ADD COLUMN mobile VARCHAR(2) AFTER status_email, ADD COLUMN status_mob VARCHAR(2) AFTER mobile, ADD COLUMN father_status_email VARCHAR(2), ADD COLUMN father_status_mob VARCHAR(2), ADD COLUMN mother_status_email VARCHAR(2),ADD COLUMN mother_status_mob VARCHAR(2) ");
?>
