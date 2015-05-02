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
$sql_case="SELECT id, dos from students WHERE ( train_city='$_GET[city]' AND center='$_GET[center]') AND ( groupid='$_GET[group]' AND active='0')";
$sql_case =$sql_case." ORDER BY name ASC";
$result_att=mysql_query($sql_case);
$month = $_GET["month"];
$year = $_GET["year"];
$group = $_GET["group"];
$city = $_GET["city"];
$center = $_GET["center"];
$count=1;
//echo $center;
$dummy = "dm_".$city."_".$center."_".$group."_".$month.'_'.$year;
//echo $dummy;
for($i=1;$i<=31;$i++)
			{
				if($_POST["cl".$i] == 1) 
				{	
					$sql_check="SELECT id from attendance WHERE (student_id='dm' AND city_name='$city') AND (center_name= '$center' AND group_name='$group') AND (date='$i' AND month='$month') AND year='$year' ";
					$sql_check =$sql_check." limit 1 ";
					$result_check=mysql_query($sql_check);
					$num_check = mysql_num_rows($result_check);
					if($num_check == 0)
					{
						mysql_query("INSERT INTO attendance (student_id, date, month,year, city_name, center_name, group_name)
						VALUES ('dm', '$i','$month', '$year', '$city', '$center', '$group')");
					}
				}
				else
				{
					$sql_check="SELECT id from attendance WHERE (student_id='dm' AND city_name='$city') AND (center_name= '$center' AND group_name='$group') AND (date='$i' AND month='$month') AND year='$year' ";
					$sql_check =$sql_check."  limit 1";
					$result_check=mysql_query($sql_check);
					$num_check = mysql_num_rows($result_check);
					if($num_check > 0)
					{	
						while($row_del = mysql_fetch_array($result_check))
						{
							mysql_query("DELETE FROM attendance WHERE id='$row_del[id]'");
						}
					}
				}
			}
			
while($row = mysql_fetch_array($result_att))
	{
	
	$date_mon1 =strtotime( $month.'/1/'.$year);
		$date_mon = strtotime( '+1 month' ,$date_mon1);
		//echo $row_att["dos"]."AA".strtotime($date_mon)."BB";
		$result_check = mysql_query("SELECT DISTINCT group_name from attendance WHERE student_id='$row[id]' AND (month='$month' AND year='$year')");
		//echo $row_att["dos"]."AA".strtotime($date_mon)."BB";
		$row_group_names= mysql_fetch_array($result_check);
		$total_groups = mysql_num_rows($result_check);
		if($row["dos"] > $date_mon)
		{

		continue;
		
		}
		if($total_groups >= 1 && $row_group_names["group_name"] != $group)
		{
		
		continue;
		}
								
		for($i=1;$i<=31;$i++)
			{
				if($_POST["cl".$i] == 1) 
				{
					//echo $row["id"];
					$sql_check="SELECT id from attendance WHERE (student_id='$row[id]' AND date='$i') AND (month='$month' AND year='$year')  ";
					$sql_check =$sql_check." limit 1";
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
						mysql_query("INSERT INTO attendance (student_id, date, month,year,attendance, city_name, center_name, group_name)
						VALUES ('$row[id]', '$i','$month', '$year', '$pre' , '$city', '$center', '$group')");
					}
					else
					{
						mysql_query("UPDATE attendance SET attendance = '$pre' WHERE id='$num_id'");
					}
				}
				else
				{
					$sql_check="SELECT id from attendance WHERE (student_id='$row[id]' AND date='$i') AND (month='$month' AND year='$year') ";
					$sql_check =$sql_check." limit 1";
					$result_check=mysql_query($sql_check);
					$num_check = mysql_num_rows($result_check);
					if($num_check > 0)
					{	
						while($row_del = mysql_fetch_array($result_check))
						{
							mysql_query("DELETE FROM attendance WHERE id='$row_del[id]'");
						}
					}
				}
			}
	
	$count++;
																									
	echo $count.'<br>';
	}
	



}
// if($_SESSION['PRIV'] == 'admin')
// {
// header("Location: ../attendance.php?month=".base64_encode($month)."&year=".base64_encode($year)."&train_city=".$city."&train_center=".$center."&group=".$group);
// }
// else
// {
// header("Location: ../attendance.php?month=".base64_encode($month)."&year=".base64_encode($year)."&train_city=".base64_encode($city)."&train_center=".$center."&group=".$group);
// }
?>