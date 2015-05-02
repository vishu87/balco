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


$sql = mysql_query("SELECT id, second_group from students order by id asc ");
while ($row = mysql_fetch_array($sql)) {
	$student_id = $row["id"];
	$second_group = $row["second_group"];
	$old_group = 0;
	$sql_at = mysql_query("SELECT groupid,month,year from attendance where student_id='$student_id' order by id asc");
	while ($at = mysql_fetch_array($sql_at)) {
		if($old_group == 0) $old_group = $at["groupid"];
		if($at["groupid"] != $old_group){
			if($at["groupid"] != $second_group){
				$date_mon =strtotime( $at["month"].'/1/'.$at["year"]);
				mysql_query("INSERT into group_shift (student_id,old_group, new_group,shift_date) values ('$student_id','$old_group','$at[groupid]','$date_mon') ");
				$old_group = $at["groupid"];
			}
		} else {

		}
	}
}
  ?>
 