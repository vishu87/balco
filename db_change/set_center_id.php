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


$sql = mysql_query("SELECT * from center order by id asc ");
while ($row = mysql_fetch_array($sql)) {
	$center_id = $row["id"];
	$center_name = $row["center_name"];
	mysql_query("UPDATE groups set center_id='$center_id' where center_name = '$center_name' ");
}
  ?>
 