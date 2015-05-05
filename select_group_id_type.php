<?php
session_start();
include('login.php');
$center_id = $_GET["id"];
	if($_SESSION["PRIV"] != 'admin'){
	$sql_check=mysql_query("SELECT members_priv.groups from members_priv WHERE members_priv.center_id='$center_id' and members_priv.$_GET[type] = 1 and members_priv.user_id = $_SESSION[MEM_ID]");
	$row_check = mysql_fetch_array($sql_check);
	$groups = $row_check["groups"];

	$sql_center = "SELECT id, group_name from groups where id IN ($groups) order by group_name asc ";
} else {
	$sql_center = "SELECT id, group_name from groups where center_id = $center_id order by group_name asc ";

}
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