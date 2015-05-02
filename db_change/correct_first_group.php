 <?php
   	require_once('../config.php');
   	set_time_limit(3000);
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}


$sql = mysql_query("SELECT id, first_group, second_group from students where active = 0  order by id asc ");
while ($row = mysql_fetch_array($sql)) {
	$group = mysql_query("SELECT * from groups where id = '$row[first_group]' limit 1");
	$row_group = mysql_fetch_array($group);
	mysql_query("UPDATE students set train_city = '$row_group[city_name]' , center  = '$row_group[center_name]', groupid  = '$row_group[group_name]' where id='$row[id]' ");
}
  ?>
 