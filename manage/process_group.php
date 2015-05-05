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
$qry="SELECT * FROM groups WHERE group_name='$_POST[group]' AND center_id='$_POST[center]'";
$result=mysql_query($qry);
$row_num_qry = mysql_num_rows($result);
if($row_num_qry > 0)
{
 header("Location: ../manage.php?type=group&err=1");
}
else
{
mysql_query("INSERT INTO groups (group_name, center_id)
			VALUES ('$_POST[group]', '$_POST[center]' )");

			header("Location: ../manage.php?type=group");
			}						



}

if($_GET["type"] == 2)
{
$sql="SELECT * from groups WHERE group_name='$_POST[group_name_edit]' AND center_id='$_POST[center_id]' ";
$result=mysql_query($sql);
$tot= mysql_num_rows($result);
if($tot<=0)
{

mysql_query("UPDATE groups SET group_name = '$_POST[group_name_edit]' WHERE id='$_GET[id]' ");

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

if(mysql_query("INSERT into deleted_groups (id, group_name, center_name, remark) VALUES ('$row_group[id]','$row_group[group_name]','$row_group[center_id]','$row_group[remark]') ")){
	mysql_query("DELETE FROM groups WHERE id='$_GET[id]'");
}

header("Location: ../manage.php?type=group");
}


?>