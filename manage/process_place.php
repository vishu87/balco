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
$sql="SELECT * from city WHERE city_name='$_POST[city]'";
$result=mysql_query($sql);
$tot= mysql_num_rows($result);
if($tot<=0)
{
mysql_query("INSERT INTO city (city_name)
			VALUES ('$_POST[city]' )");

header("Location: ../manage.php?type=city");
}
else
{

header("Location: ../manage.php?type=city&err=1");
}

}
if($_GET["type"] == 2)
{
$sql="SELECT * from city WHERE city_name='$_POST[city_name_edit]'";
$result=mysql_query($sql);
$tot= mysql_num_rows($result);
if($tot<=0)
{
$sql="SELECT * from city WHERE id='$_GET[id]' ";
$result=mysql_query($sql);
$row= mysql_fetch_array($result);
$old_city = $row["city_name"];
mysql_query("UPDATE city SET city_name = '$_POST[city_name_edit]' WHERE id='$_GET[id]' ");

mysql_query("UPDATE attendance SET city_name = '$_POST[city_name_edit]' WHERE city_name='$old_city' ");

mysql_query("UPDATE center SET city_name = '$_POST[city_name_edit]' WHERE city_name='$old_city' ");

mysql_query("UPDATE coach_groups SET city_name = '$_POST[city_name_edit]' WHERE city_name='$old_city' ");

mysql_query("UPDATE groups SET city_name = '$_POST[city_name_edit]' WHERE city_name='$old_city' ");

mysql_query("UPDATE members SET train_city = '$_POST[city_name_edit]' WHERE train_city='$old_city' ");

mysql_query("UPDATE students SET train_city = '$_POST[city_name_edit]' WHERE train_city='$old_city' ");

header("Location: ../manage.php?type=city");
}
else
{

header("Location: ../manage.php?type=city&err=2");
}
}


if($_GET["type"] == 6)
{

mysql_query("DELETE FROM city WHERE id='$_GET[id]'");



header("Location: ../manage.php?type=city");
}




?>