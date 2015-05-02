 <?php
   require_once('config.php');
   set_time_limit ( 500 ) ;
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}

    
  for ($i = 2673; $i<= 2676; $i = $i+1)
  {
  mysql_query(" UPDATE attendance set group_name='U08' where id='$i'");
  }
  
  ?>
 