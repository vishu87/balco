<?php session_start();
require_once('../config.php');
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}

$feed_date =strtotime("now");

$month = $_GET["month"];
$year = $_GET["year"];
$groupid = $_GET["group"];
$count_form = $_POST["count_form"];

if($count_form == 1){
	mysql_query("DELETE from attendance WHERE student_id='dm' and month='$month' AND year = '$year' AND groupid = '$groupid'  ");
	for($i=1;$i<=31;$i++) {
		if($_POST["cl".$i] == 1) {	
			mysql_query("INSERT INTO attendance (student_id, date, month, year, groupid) VALUES ('dm', '$i','$month', '$year', '$groupid')");
		}
	}
}

foreach ($_POST["student_ids"] as $id) {
	mysql_query("DELETE from attendance WHERE student_id='$id' and month='$month' AND year = '$year' AND groupid = '$groupid'  ");
	for($i=1;$i<=31;$i++) {
		if($_POST["cl".$i] == 1) {
			if($_POST["st".$id.'_'.$i] == 1) {
				$pre = 'P';
			} else {
				$pre = 'A';
			}
			mysql_query("INSERT INTO attendance (student_id, date, month, year, groupid, attendance) VALUES ('$id', '$i','$month', '$year', '$groupid', '$pre')");
		
		}
	}
}
?>