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
if($_GET["type"] == 1)
{
$feed_date =strtotime("now");

$month = $_GET["month"];
$year = $_GET["year"];
$group = $_GET["group"];
$city = $_GET["city"];
$center = $_GET["center"];
$sql_case="SELECT * from coach_groups WHERE ( city_name='$city' AND center_name='$center') AND group_name='$group' ";
$sql_case =$sql_case." ORDER BY coach_name ASC";
$result_att=mysql_query($sql_case);
$count=1;
$dummy = "dm";
for($i=1;$i<=31;$i++)
			{
				if($_POST["cl".$i] == 1) 
				{	
					$sql_check="SELECT * from coach_attendance WHERE (student_id='dm' AND city_name='$city') AND (center_name= '$center' AND group_name='$group') AND (date='$i' AND month='$month') AND year='$year' ";
					$sql_check =$sql_check." ORDER BY id DESC";
					
					$result_check=mysql_query($sql_check);
					$num_check = mysql_num_rows($result_check);
					if($num_check == 0)
					{
					mysql_query("INSERT INTO coach_attendance (student_id, date, month, year, city_name, center_name, group_name)
						VALUES ('dm', '$i','$month', '$year', '$city', '$center', '$group')");
					}
				}
				else
				{
					$sql_check="SELECT * from coach_attendance WHERE (student_id='dm' AND city_name='$city') AND (center_name= '$center' AND group_name='$group') AND (date='$i' AND month='$month') AND year='$year' ";
					$sql_check =$sql_check." ORDER BY id DESC";
					$result_check=mysql_query($sql_check);
					$num_check = mysql_num_rows($result_check);
					if($num_check > 0)
					{	
						while($row_del = mysql_fetch_array($result_check))
						{
							mysql_query("DELETE FROM coach_attendance WHERE id='$row_del[id]'");
						}
					}
				}
			}
			
while($row = mysql_fetch_array($result_att))
	{
		
	
		for($i=1;$i<=31;$i++)
			{
				if($_POST["cl".$i] == 1) 
				{	
				
					$sql_check="SELECT id from coach_attendance WHERE (student_id='$row[coach_id]' AND date='$i') AND (month='$month' AND year='$year') AND (city_name='$city' AND center_name='$center') AND group_name='$group' ";
					$sql_check =$sql_check." ORDER BY id DESC";
					$result_check=mysql_query($sql_check);
					$num_check = mysql_num_rows($result_check);
					$num_check_id = mysql_fetch_array($result_check);
					$num_id = $num_check_id["id"];
					if($_POST["st".$count.'_'.$i] == 1) 
					{
						$pre = 'P';
					}
					else 
					{

						$pre = 'A';
			
					}
					if($num_check == 0)
					{
						
						mysql_query("INSERT INTO coach_attendance (student_id, date, month,year,attendance, city_name, center_name, group_name) VALUES ('$row[coach_id]', '$i','$month', '$year', '$pre', '$city', '$center', '$group')");
					}
					else
					{
						mysql_query("UPDATE coach_attendance SET attendance = '$pre' WHERE id='$num_id'");
					}
				
				}
				
				
				else
				{
					$sql_check="SELECT id from coach_attendance WHERE (student_id='$row[coach_id]' AND date='$i') AND (month='$month' AND year='$year') AND (city_name='$city' AND center_name='$center') AND group_name='$group' ";
					$sql_check =$sql_check." ORDER BY id DESC";
					$result_check=mysql_query($sql_check);
					$num_check = mysql_num_rows($result_check);
					if($num_check > 0)
					{	
						while($row_del = mysql_fetch_array($result_check))
						{
							mysql_query("DELETE FROM coach_attendance WHERE id='$row_del[id]'");
						}
					}
				}
			}
	
	$count++;
																									

	}
	



}
if($_SESSION['PRIV'] == 'admin')
{
header("Location: ../coach.php?month=".base64_encode($month)."&year=".base64_encode($year)."&train_city=".$city."&train_center=".$center."&group=".$group);
}
else
{
header("Location: ../coach.php?month=".base64_encode($month)."&year=".base64_encode($year)."&train_city=".base64_encode($city)."&train_center=".$center."&group=".$group);
}
?>