<?php session_start();

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





$dos = $_POST["month"].'/'.$_POST["date"].'/'.$_POST["year"];
$doe = $_POST["month1"].'/'.$_POST["date1"].'/'.$_POST["year1"];
$dos_str = strtotime($dos);
$doe_str = strtotime($doe);
if($doe_str < $dos_str)
{
mysql_query("UPDATE coach_groups SET start = '$dos_str' WHERE id='$_GET[id]'");
}
else
{
mysql_query("UPDATE coach_groups SET start = '$dos_str',end = '$doe_str' WHERE id='$_GET[id]'");
}
header("Location: group_set.php?id=".$_GET["coach_id"]);


?>