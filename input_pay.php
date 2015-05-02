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

    
  $dom = DOMDocument::load( '4pay.xml');
  $rows = $dom->getElementsByTagName( 'Row' );
  $first_row = true;
  $count =0;
  foreach ($rows as $row)
  {
  if($count!=0)
  {
  $index = 1;
  $cells = $row->getElementsByTagName( 'Cell' );
  foreach( $cells as $cell )
  { 
  $ind = $cell->getAttribute( 'Index' );
  if ( $ind != null ) $index = $ind;
  

  if ( $index == 2 ) 
  
  {
  
   $sql_case="SELECT * from students WHERE name='".addslashes($cell->nodeValue)."' AND center='Noida'";
$sql_student =$sql_case." ORDER BY center DESC";
$result_case=mysql_query($sql_student);

$row_student = mysql_fetch_array($result_case);
 $id = $row_student["id"];
  
  
  
  }
  if ( $index == 3 ) { if($cell->nodeValue != 'N/A')$dos = strtotime($cell->nodeValue);
  else $dos = '';}
  if ( $index == 4 ) { if($cell->nodeValue != 'N/A')$dop = strtotime($cell->nodeValue);
  else $dop = '';}
  if ( $index == 5 ) { if($cell->nodeValue != 'N/A')$doe = strtotime($cell->nodeValue);
  else $doe = '';}
  if ( $index == 6 ) $amount =$cell->nodeValue;
  if ( $index == 7 ) { if($cell->nodeValue != 'N/A')$adjust = $cell->nodeValue;
  else $adjust = '';}
   if ( $index == 8 ) { if($cell->nodeValue != 'N/A')$mplan = $cell->nodeValue;
  else $mplan = '';}
  if ( $index == 10 ) $p_remark = $cell->nodeValue;
  
  if ( $index == 11 ) $a_remark = $cell->nodeValue;
 
  
  $index++;
  }
$feed_date =strtotime("now");
mysql_query("INSERT INTO payment_history (student_id, email, dos, dor, doe, amount, months, adjustment, p_remark, a_remark, date, added_by)
			VALUES ('$id', '', '$dos', '$dop', '$doe' ,'$amount', '$mplan','$adjust','$p_remark','$a_remark','$feed_date','anurag')");

  
  }
    $count += 1;
  if($count == 13) break;
  }
  ?>
 