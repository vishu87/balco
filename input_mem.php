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
function generatePassword($length=8, $strength=8) {
	$vowels = 'aeuy';
	$consonants = 'bdghjmnpqrstvz';
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength & 2) {
		$vowels .= "AEUY";
	}
	if ($strength & 4) {
		$consonants .= '23456789';
	}
	if ($strength & 8) {
		$consonants .= '@#$%';
	}
 
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
    }
  $dom = DOMDocument::load( 'mem.xml');
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
  

  if ( $index == 1 ) $username = addslashes($cell->nodeValue);
  
  if ( $index == 2 ) $name = addslashes($cell->nodeValue);
  
  if ( $index == 3 ) 
  { 
	$pass = generatePassword(8,4);
	$password = md5($pass);
  
  }
  if ( $index == 4 ) { $priv = $cell->nodeValue;}
  
  if ( $index == 5 ) { if($cell->nodeValue != 'N/A')$dob = $cell->nodeValue;
  else $dob='';}
  
  if ( $index == 6 ) { if($cell->nodeValue != 'N/A')$email = $cell->nodeValue;
  else $email='';}
  
  if ( $index == 7 ) { if($cell->nodeValue != 'N/A')$mobile = $cell->nodeValue;
  else $mobile='';}
  if ( $index == 8 ) $center = $cell->nodeValue;
  if ( $index == 9 ) $address= $cell->nodeValue;
  if ( $index == 10 ) $city= addslashes($cell->nodeValue);
  if ( $index == 11 ) $state= $cell->nodeValue;

   if ( $index == 12 )
   {
	if($cell->nodeValue == 'Active') $active = '0';
	else $active ='1';
   }
   
  $index++;
  }
mysql_query("INSERT INTO members (name, username, password, pass, priv, dob, email, mobile, train_city, center, address, city, state, pic, active)
			VALUES ('$name', '$username', '$password', '$pass', '$priv', '$dob', '$email', '$mobile', 'Delhi', '$center', '$address',' $city','$state', '', '$active' )");
}
  $count += 1;
  if($count == 26) break;
  }
  
  ?>