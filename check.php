 <?php
   require_once('config.php');
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}

    echo "<div>";
  $result = mysql_query("select * from coach_attendance where (month='3' and year='2012') and (student_id = 'dm' AND city_name='Mumbai') order by group_name ASC");
  while($row = mysql_fetch_array($result))
  {
	echo $row["city_name"].$row["student_id"].$row["date"].$row["group_name"].'<br>';
  
  }
  echo "</div>"
  ?>
 