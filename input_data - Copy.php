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

    
  $dom = DOMDocument::load( '4New.xml');
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
  

  if ( $index == 2 ) $name = addslashes($cell->nodeValue);
  
  if ( $index == 3 ) { if($cell->nodeValue != 'N/A')$dob = strtotime($cell->nodeValue);
  else $dob = '';}
  if ( $index == 4 ) { if($cell->nodeValue != 'N/A')$email = $cell->nodeValue;
  else $email='';}
  if ( $index == 5 ) $school = addslashes($cell->nodeValue);
  if ( $index == 6 ) $status_email ='';
  if ( $index == 7 ) { if($cell->nodeValue != 'N/A')$mobile = $cell->nodeValue;
  else $mobile='';}
  if ( $index == 8 ) $status_mob = '';
  if ( $index == 9 ) $train_city= $cell->nodeValue;
  if ( $index == 10 ) $center= addslashes($cell->nodeValue);
  if ( $index == 11 ) $groupid= $cell->nodeValue;
  if ( $index == 12 ) $father= addslashes($cell->nodeValue);
  if ( $index == 13 ) $mother= addslashes($cell->nodeValue);
  if ( $index == 14 ) $father_mob= $cell->nodeValue;
  if ( $index == 15 ) 
  { if($cell->nodeValue != 'N/A')$father_email = $cell->nodeValue;
  else $father_email='';}
  if ( $index == 16 ) $mother_mob= $cell->nodeValue;
  if ( $index == 17 ) 
  { if($cell->nodeValue != 'N/A')$mother_email = $cell->nodeValue;
  else $mother_email='';}
  if ( $index == 18 ) $address= addslashes($cell->nodeValue);
  if ( $index == 19 ) $city= addslashes($cell->nodeValue);
  if ( $index == 20 ) $state= $cell->nodeValue;
  if ( $index == 21 ) $dos= strtotime($cell->nodeValue);
  if ( $index == 22 ) $doe= strtotime($cell->nodeValue);
   if ( $index == 27 )
   {
	if($cell->nodeValue == 'Active') $active = '0';
	else $active ='1';
   }
    if ( $index == 28 ) 
   {
	if($cell->nodeValue == 'Active') $father_status_email = '1';
	else $father_status_email ='0';
   }
   if ( $index == 29 ) 
   {
	if($cell->nodeValue == 'Active') $father_status_mob = '1';
	else $father_status_mob ='0';
   }
   if ( $index == 30 ) {
	if($cell->nodeValue == 'Active') $mother_status_email = '1';
	else $mother_status_email ='0';
   }
   if ( $index == 31 ) {
	if($cell->nodeValue == 'Active') $mother_status_mob = '1';
	else $mother_status_mob ='0';
   }
   
  $index++;
  }
$feed_date =strtotime("now");
mysql_query("INSERT INTO students (name, dob, email, school, mobile, status_email, status_mob, train_city, center,  groupid, father, father_mob, father_email, father_status_mob, father_status_email, mother, mother_mob, mother_email, mother_status_mob , mother_status_email, address, city, state, pic, dos, doe, add_date, added_by, active)
			VALUES ('$name', '$dob','$email','$school', '$mobile', '$status_email', '$status_mob', '$train_city', '$center','$groupid','$father','$father_mob', '$father_email','$father_status_mob', '$father_status_email' , '$mother','$mother_mob', '$mother_email','$mother_status_mob', '$mother_status_email', '$address','$city','$state','', '$dos', '$doe','$feed_date','anurag', '$active' )");
			}
  $count += 1;
  if($count == 13) break;
  }
  
  ?>
 