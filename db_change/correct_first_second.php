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


$sql = mysql_query("SELECT id, name, first_group, second_group from students where active = 0  order by id asc ");
while ($row = mysql_fetch_array($sql)) {
	$student_id = $row["id"];
	$first_group = $row["first_group"];
	$second_group = $row["second_group"];

	if($first_group == $second_group){
		$sql_at = mysql_query("SELECT new_group from group_shift where student_id='$student_id' order by shift_date desc limit 1");
		if(mysql_num_rows($sql_at) == 0){ }
		else {
			$at = mysql_fetch_array($sql_at);
			mysql_query("UPDATE students set first_group='$at[new_group]' where id='$student_id' ");
		}
	}
	
}
  ?>
 