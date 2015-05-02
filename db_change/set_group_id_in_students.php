 <?php
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

    
  
  
$sql_case="SELECT id,train_city, center, groupid from students where first_group = 0 ";
$sql_student =$sql_case."";
$result_case=mysql_query($sql_student);

while($row_student = mysql_fetch_array($result_case)){

$sql_group = mysql_query("SELECT id from groups where city_name='$row_student[train_city]' AND center_name ='$row_student[center]' AND group_name='$row_student[groupid]' limit 1");
$row_group = mysql_fetch_array($sql_group);
$groupid = $row_group["id"];

mysql_query("UPDATE students SET first_group= '$groupid' WHERE id='$row_student[id]'");

}
    
$sql_case="SELECT id,train_city, center, groupid from students where first_group = 0 ";
$sql_student =$sql_case."";
$result_case=mysql_query($sql_student);

while($row_student = mysql_fetch_array($result_case)){

$sql_group = mysql_query("SELECT id from deleted_groups where city_name='$row_student[train_city]' AND center_name ='$row_student[center]' AND group_name='$row_student[groupid]' limit 1");
$row_group = mysql_fetch_array($sql_group);
$groupid = $row_group["id"];

mysql_query("UPDATE students SET first_group= '$groupid' WHERE id='$row_student[id]'");

}
  ?>
 