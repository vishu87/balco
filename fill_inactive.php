 <?php

   require_once('config.php');
set_time_limit ( 1200 );
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}

    
  /*
 
   $sql_case=mysql_query("SELECT * from students where active ='1' order by doe asc ");

   while ($row = mysql_fetch_array($sql_case)) {
   	$query = "INSERT into inactive_history (student_id,inactive_on,add_date,added_by) values ('$row[id]','$row[doe]','$row[doe]','anurag')";
   	mysql_query($query);
   	echo $query.date("d-M-y",$row["doe"]).'<br>';
   }

 
   $sql_case = mysql_query("SELECT * from payment_history");
   while ($row = mysql_fetch_array($sql_case)) {
   	mysql_query("UPDATE payment_history set sub_fee = '$row[amount]' where id='$row[id]' ");
   }
  */
  
  ?>
 