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

    
  $dom = DOMDocument::load( 'attendance.xml');
  $rows = $dom->getElementsByTagName( 'Row' );
  $first_row = true;
  $count =0;
  foreach ($rows as $row)
  {
 
  $index = 1;
  $cells = $row->getElementsByTagName( 'Cell' );
  foreach( $cells as $cell )
  { 
  $ind = $cell->getAttribute( 'Index' );
  if ( $ind != null ) $index = $ind;
  if ( $index == 2 ) $city_name = $cell->nodeValue;
  if ( $index == 3 ) $center_name= $cell->nodeValue;
  if ( $index == 4 ) $group_name= $cell->nodeValue;
  if ( $index == 5 ) $student_id= $cell->nodeValue;
  if ( $index == 6 ) $date= $cell->nodeValue;
  if ( $index == 7 ) $month= $cell->nodeValue;
  if ( $index == 8 ) $year= $cell->nodeValue;
  if ( $index == 9 ) $attendance= $cell->nodeValue;
   
   
  $index++;
  }
$feed_date =strtotime("now");
mysql_query("INSERT INTO attendance (city_name, center_name, group_name, student_id, date, month, year, attendance)
			VALUES ('$city_name', '$center_name','$group_name','$student_id', '$date', '$month', '$year', '$attendance' )");
	$count++;

  }
  
  ?>
 