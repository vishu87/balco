<?php 
error_reporting(E_ALL);
set_time_limit(5000);
$con = mysql_connect("localhost","bbfoomlp_main","!delMUMc#@ndig@rh!");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("bbfoomlp_bbfs", $con);

$query = mysql_query("SELECT * from deleted_groups ");
while ($row = mysql_fetch_array($query)) {
	mysql_query("UPDATE attendance set groupid = '$row[id]' where group_name='$row[group_name]' and center_name ='$row[center_name]' and city_name = '$row[city_name]' and groupid = 0 ");
}
?>