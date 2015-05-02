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

	
					$sql_check="SELECT * from attendance  ";
					$sql_check =$sql_check." ORDER BY id DESC";
					$result_check=mysql_query($sql_check);
					while($row = mysql_fetch_array($result_check))
					{
					echo $row["student_id"].','.$row["date"].','.$row["month"].','.$row["year"].','.$row["attendance"].'<br>';
					
					}
?>