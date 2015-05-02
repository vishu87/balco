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
$qry="SELECT * FROM groups WHERE ( group_name='$_POST[group]' AND city_name ='$_POST[city]') AND center_name='$_POST[center]'";
$result=mysql_query($qry);
$row_num_qry = mysql_num_rows($result);
if($row_num_qry > 0)
{
 header("Location: ../manage.php?type=group&err=1");
}
else
{
mysql_query("INSERT INTO groups (group_name, center_name,city_name)
			VALUES ('$_POST[group]', '$_POST[center]', '$_POST[city]' )");

			header("Location: ../manage.php?type=group");
			}						



}

if($_GET["type"] == 2)
{
$sql="SELECT * from groups WHERE group_name='$_POST[group_name_edit]' AND (center_name='$_POST[center_name_edit]' AND city_name='$_POST[city_name_edit]')";
$result=mysql_query($sql);
$tot= mysql_num_rows($result);
if($tot<=0)
{
$sql="SELECT * from groups WHERE id='$_GET[id]' ";
$result=mysql_query($sql);
$row= mysql_fetch_array($result);
$old_group = $row["group_name"];
$old_center = $row["center_name"];
$old_city = $row["city_name"];


mysql_query("UPDATE groups SET group_name = '$_POST[group_name_edit]' WHERE id='$_GET[id]' ");

mysql_query("UPDATE coach_groups SET group_name = '$_POST[group_name_edit]' WHERE group_name='$old_group' AND (city_name='$old_city' AND center_name='$old_center')");


mysql_query("UPDATE students SET groupid = '$_POST[group_name_edit]' WHERE groupid='$old_group' AND  (train_city='$old_city' AND center='$old_center')");

header("Location: ../manage.php?type=group");
}
else
{

header("Location: ../manage.php?type=group&err=2");
}
}

if($_GET["type"] == 6){

$fetch_group = mysql_query("SELECT * from groups where id='$_GET[id]' limit 1 ");
$row_group = mysql_fetch_array($fetch_group);

if(mysql_query("INSERT into deleted_groups (id, group_name, center_name, city_name, remark) VALUES ('$row_group[id]','$row_group[group_name]','$row_group[center_name]','$row_group[city_name]','$row_group[remark]') ")){
	mysql_query("DELETE FROM groups WHERE id='$_GET[id]'");
}

header("Location: ../manage.php?type=group");
}


?>