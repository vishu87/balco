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
	$month  = $_POST["month"];
	$year  = $_POST["year"];
	
	$date_mon1 =strtotime( $month.'/1/'.$year);
	$date_mon = strtotime( '-1 day' ,$date_mon1);
	
	$date_mon_last = strtotime( '+1 month' ,$date_mon1);
	//echo date("d m y ", $date_mon);
	$days = intval(mysql_real_escape_string($_POST["days"]));
	
$query = "SELECT id, name, dos from students where first_group = '$_POST[groupid]' AND active = '0'";

$result  = mysql_query($query);

echo '<table border="1"><tr><th>Id</th><th>Name</th><th>DOJ</th><th>Adjusted Transaction ID</th><th>Initial DOE</th><th>Final DOE</th><th>Initial Adjustment</th><th>Final Adjustment</th><th>Initial Adjustment Remark</th><th>Final Adjustment Remark</th></tr>';
while($row = mysql_fetch_array($result)) {

	if($row["dos"] > $date_mon && $row["dos"] < $date_mon_last){
	echo '<tr style="background:#ccc">';
	}
	else echo '<tr>';
	echo '<td>'.$row["id"].'</td>';
	echo '<td><a href="../students.php?type=browse&id='.$row["id"].'" target="_blank">'.$row["name"].'</a></td>';
	echo '<td>'.date("d M y",$row["dos"]).'</td>';
	$query_a = mysql_query("select id,doe,a_remark, adjustment from payment_history where student_id='$row[id]' order by id desc ");
	$row_a = mysql_fetch_array($query_a);
	echo '<td>'.$row_a["id"].'</td>';
	
	if(is_int($days)) {
	$time_shift = $days*24*3600;
	}
	else $time_shift =0;
	$remark = $row_a["a_remark"].'/'.mysql_real_escape_string($_POST["remark"]);
	$final_time = $row_a["doe"] + $time_shift;
	echo '<td>'.date("d M y",$row_a["doe"]).'</td>';
	$final_adjustment = intval($row_a["adjustment"]) + $days;
	
	mysql_query("update payment_history set doe='$final_time', a_remark='$remark', adjustment='$final_adjustment' where id='$row_a[id]' ");

	$query_u = mysql_query("SELECT doe from payment_history WHERE student_id='$row[id]' ORDER by doe DESC ");
	$row_u = mysql_fetch_array($query_u);
	mysql_query("UPDATE students SET doe = '$row_u[doe]' WHERE id='$row[id]'");
	
	$query_b = mysql_query("select id,doe,a_remark, adjustment from payment_history where id='$row_a[id]'");
	$row_b = mysql_fetch_array($query_b);
	
	echo '<td>'.date("d M y",$row_b["doe"]).'</td>';
	echo '<td>'.$row_a["adjustment"].'</td>';
	echo '<td>'.$row_b["adjustment"].'</td>';
	echo '<td>'.$row_a["a_remark"].'</td>';
	echo '<td>'.$row_b["a_remark"].'</td>';

}
echo '</table><br><br><br><a href="../adjustment.php">Click here to go back</a>';

?>