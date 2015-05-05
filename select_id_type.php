<?php
session_start();
include('login.php');

if($_SESSION["PRIV"] != 'admin'){
	$sql_center="SELECT distinct(center.id), center.center_name from center join members_priv on center.id = members_priv.center_id WHERE center.city_id='$_GET[id]' and members_priv.$_GET[type] = 1 and members_priv.user_id = $_SESSION[MEM_ID] ORDER BY center.center_name ASC";
} else {
	$sql_center="SELECT center.id, center.center_name FROM center WHERE center.city_id='$_GET[id]' ORDER BY center.center_name ASC";
}
	$result_center=mysql_query($sql_center);
	echo '[';
	$count_center = 0;
	echo '{optionValue:\'Select\', optionDisplay: \'Select\'}';
		while($row2 = mysql_fetch_array($result_center))
			{
			
			 echo ', {optionValue:\''.$row2["id"].'\', optionDisplay: \''.$row2["center_name"].'\'}';
			 
			$count_center++;
			}
	
	
	
	echo ']';

 
$count++;

?>