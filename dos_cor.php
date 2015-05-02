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



$sql="SELECT * from students ";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{


$id= $row["id"];

$sql_case="SELECT * from payment_history WHERE student_id='$id' ORDER by dos ASC ";
$result_case=mysql_query($sql_case);
$row_student = mysql_fetch_array($result_case);
mysql_query("UPDATE students SET dos= '$row_student[dos]' WHERE id='$id'");

}





?>