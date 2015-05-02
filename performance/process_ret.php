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
	




$month = $_GET["month"];
$year = $_GET["year"];
$group = $_GET["group"];
$city = $_GET["city"];
$center = $_GET["center"];
$count=1;


$sql_ret="SELECT * from evaluation_ret WHERE  city='$city' AND (center= '$center' AND group_id='$group') AND (quarter='$month' AND year='$year') ";
$result_ret=mysql_query($sql_ret);
while($ret=mysql_fetch_array($result_ret))
{
 if($_GET["type"] == 1)
 {
	mysql_query("update evaluation set performa='$ret[performa]' where id='$ret[id]' ");
 }
 if($_GET["type"] == 2)
 {
	mysql_query("update evaluation set comments='$ret[comments]' where id='$ret[id]' ");
 }
 if($_GET["type"] == 3)
 {
	mysql_query("update evaluation set performa='$ret[performa]', comments='$ret[comments]' where id='$ret[id]' ");
 }

}
	





if($_SESSION['PRIV'] == 'admin')
{
header("Location: ../performance.php?month=".base64_encode($month)."&year=".base64_encode($year)."&train_city=".$city."&train_center=".$center."&group=".$group);
}
else
{
header("Location: ../performance.php?month=".base64_encode($month)."&year=".base64_encode($year)."&train_city=".base64_encode($city)."&train_center=".$center."&group=".$group);
}


?>