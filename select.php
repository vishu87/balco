<?php
include('login.php');
$sql_case="SELECT * from city ORDER BY city_name ASC";
$result_case=mysql_query($sql_case);
$count=1;
while($row = mysql_fetch_array($result_case))
{

if ($_GET['id'] == $row["city_name"]) {
	$sql_center="SELECT center_name from center WHERE city_name='$row[city_name]' ORDER BY center_name ASC";
	$result_center=mysql_query($sql_center);
	echo '[';
	$count_center = 0;
	echo '{optionValue:\'Select\', optionDisplay: \'Select\'}';
		while($row2 = mysql_fetch_array($result_center))
			{
			
			 echo ', {optionValue:\''.$row2["center_name"].'\', optionDisplay: \''.$row2["center_name"].'\'}';
			 
			$count_center++;
			}
	
	
	
	echo ']';

 
}

$count++;
}

?>