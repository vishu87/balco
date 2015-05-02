<?php
include('login.php');
$sql_case="SELECT * from center WHERE city_name='$_GET[city]' ORDER BY center_name ASC";
$result_case=mysql_query($sql_case);
$count=1;
while($row = mysql_fetch_array($result_case))
{

if ($_GET['id'] == $row["center_name"] ) {
	$sql_center="SELECT * from groups WHERE center_name='$row[center_name]'ORDER BY group_name ASC";
	$result_center=mysql_query($sql_center);
	echo '[';
	$count_center = 0;
	echo '{optionValue:\'Select\', optionDisplay: \'Select\'}';
		while($row = mysql_fetch_array($result_center))
			{
				
			
			 echo ', {optionValue:\''.$row["group_name"].'\', optionDisplay: \''.$row["group_name"].'\'}';
			 
			$count_center++;
			}
	
	
	
	echo ']';

 
}

$count++;
}

?>