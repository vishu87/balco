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



$sql="SELECT * from payment_history ";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{


$id= $row["id"];

mysql_query("UPDATE payment_history SET dor= '$row[dos]' WHERE id='$id'");

}





?>