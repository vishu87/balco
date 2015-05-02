<?php session_start();

require_once('../auth.php');
require_once('../config.php');

if($_SESSION["PRIV"] != 'admin') die('You are not authorized');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}

	if($_POST["verify"] != ''){
		foreach ($_POST["verify"] as $payment_id) {
			$verified_by  = $_SESSION["SESS_MEMBER_ID"];
			$verified_on = strtotime("now");
			mysql_query("UPDATE payment_history set verified='1', verified_by='$verified_by', verified_on='$verified_on' where id='$payment_id' ");
		}
	}

	header("Location: ../payments.php?type=verify");		

?>