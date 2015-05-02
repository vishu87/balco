<?php
include('login.php');
$center_id = $_GET["id"];

	$sql_center="SELECT * from groups WHERE center_id='$center_id' ORDER BY group_name ASC";
	$result_center=mysql_query($sql_center);
	echo '[';
	$count_center = 0;
		while($row = mysql_fetch_array($result_center)) {
			if($count_center != 0) echo ',';
			echo ' {optionValue:\''.$row["id"].'\', optionDisplay: \''.$row["group_name"].'\'}'; 
			$count_center++;
		}
	echo ']';
?>