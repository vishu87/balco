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
$qry="SELECT * FROM center WHERE city_name ='$_POST[city]' AND center_name='$_POST[center]'";
$result=mysql_query($qry);
$row_num_qry = mysql_num_rows($result);
if($row_num_qry > 0)
{
 header("Location: ../manage.php?type=center&err=1");
}
else
{
mysql_query("INSERT INTO center (center_name,city_name)
			VALUES ('$_POST[center]', '$_POST[city]' )");
			header("Location: ../manage.php?type=center");
}

}



if($_GET["type"] == 2)
{
$sql="SELECT * from center WHERE center_name='$_POST[center_name_edit]' AND city_name='$_POST[city_name_edit]'";
$result=mysql_query($sql);
$tot= mysql_num_rows($result);
if($tot<=0)
{
$sql="SELECT * from center WHERE id='$_GET[id]' ";
$result=mysql_query($sql);
$row= mysql_fetch_array($result);
$old_center = $row["center_name"];
$old_city = $row["city_name"];

mysql_query("UPDATE attendance SET center_name = '$_POST[center_name_edit]' WHERE city_name='$old_city' AND center_name='$old_center'");

mysql_query("UPDATE center SET center_name = '$_POST[center_name_edit]' WHERE id='$_GET[id]' ");

mysql_query("UPDATE coach_groups SET center_name = '$_POST[center_name_edit]' WHERE city_name='$old_city' AND center_name='$old_center'");

mysql_query("UPDATE groups SET center_name = '$_POST[center_name_edit]' WHERE city_name='$old_city' AND center_name='$old_center'");

mysql_query("UPDATE members SET center = '$_POST[center_name_edit]' WHERE train_city='$old_city' AND center='$old_center'");

mysql_query("UPDATE students SET center = '$_POST[center_name_edit]' WHERE train_city='$old_city' AND center='$old_center'");

header("Location: ../manage.php?type=center");
}
else
{

header("Location: ../manage.php?type=center&err=2");
}
}

if($_GET["type"] == 6)
{

mysql_query("DELETE FROM center WHERE id='$_GET[id]'");



header("Location: ../manage.php?type=center");
}





?>