<?php
set_time_limit ( 3600 ) ;
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

$input = array("1" ,"2", "3" ,"4", "5");
function mail_attachment($filename,$filename2, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
    $file = $path.$filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message."\r\n\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $header .= $content."\r\n\r\n";
	$header .= "--".$uid."\r\n";
	 $file = $path.$filename2;
    $file_size = filesize($file);
	$handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
	$header .= "Content-Type: application/octet-stream; name=\"".$filename2."\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"".$filename2."\"\r\n\r\n";
    $header .= $content."\r\n\r\n";
    $header .= "--".$uid."--";
	
    if (mail($mailto, $subject, "", $header)) {
        echo "mail send ... OK"; // or use booleans here
    } else {
        echo "mail send ... ERROR!";
    }
}


function mail_attachment_1($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
    $file = $path.$filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message."\r\n\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $header .= $content."\r\n\r\n";
    $header .= "--".$uid."--";
	
    if (mail($mailto, $subject, "", $header)) {
        echo "mail send ... OK"; // or use booleans here
    } else {
        echo "mail send ... ERROR!";
    }
}

$subject = stripslashes($_POST["subject"]);
$message = stripslashes($_POST["message"]);

//Get the uploaded file information
$name_of_uploaded_file =
    basename($_FILES['uploaded_file']['name']);

$name_of_uploaded_file2 =
    basename($_FILES['uploaded_file2']['name']);

	//get the file extension of the file
$type_of_uploaded_file =
    substr($name_of_uploaded_file,
    strrpos($name_of_uploaded_file, '.') + 1);
$size_of_uploaded_file =
    $_FILES["uploaded_file"]["size"]/1024;//size in KBs
	//copy the temp. uploaded file to uploads folder
	
	//Settings
//$max_allowed_file_size = 10; // size in KB
//$allowed_extensions = array("jpg", "jpeg", "gif", "bmp");
//Validations
/*if($size_of_uploaded_file > $max_allowed_file_size )
{
  echo "\n Size of file should be less than $max_allowed_file_size";
  exit;
}
//------ Validate the file extension -----
//$allowed_ext = false;
for($i=0; $i<sizeof($allowed_extensions); $i++)
{
  if(strcasecmp($allowed_extensions[$i],$type_of_uploaded_file) == 0)
  {
    $allowed_ext = true;
  }
}
if(!$allowed_ext)
{
  $errors .= "\n The uploaded file is not supported file type. ".
  " Only the following file types are supported: ".implode(',',$allowed_extensions);
}
*/

$path_of_uploaded_file = "../../attachments/". $name_of_uploaded_file;
$path_of_uploaded_file2 = "../../attachments/". $name_of_uploaded_file2;
$tmp_path = $_FILES["uploaded_file"]["tmp_name"];
$tmp_path2 = $_FILES["uploaded_file2"]["tmp_name"];
if(is_uploaded_file($tmp_path))
{
  if(!copy($tmp_path,$path_of_uploaded_file))
  {
    $errors .= '\n error while copying the uploaded file';
  }
}
if(is_uploaded_file($tmp_path2))
{
  if(!copy($tmp_path2,$path_of_uploaded_file2))
  {
    $errors .= '\n error while copying the uploaded file';
  }
}
$my_file = $name_of_uploaded_file;
$my_file2 = $name_of_uploaded_file2;

$my_path = $_SERVER['DOCUMENT_ROOT']."/attachments/";





	$arr = explode(',', $_POST["student_id"]);
	
foreach($arr as $ar)
{
//$rand_keys = array_rand($input, 1);
sleep(5);
$headers = "From: info@bbfootballschools.com \r\n";
$headers .= "Reply-To: info@bbfootballschools.com \r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$tot_num_email =0;
$str_email ='';

$sql_case="SELECT * from students WHERE id='$ar' ";
$result_case=mysql_query($sql_case);
$row = mysql_fetch_array($result_case);
						
						
							
							if($row["email"])
							{
								if($tot_num_email != 0){$str_email = $str_email.',';}
								$str_email = $str_email.$row["email"];
								$tot_num_email++;	
							}
						
						
						
						
						
							
							if($row["father_email"])
							{
								if($tot_num_email != 0){$str_email = $str_email.',';}
								$str_email = $str_email.$row["father_email"];
								$tot_num_email++;
								
							}
						
						
						
							if($row["mother_email"])
							{
								if($tot_num_email != 0){$str_email = $str_email.',';}
								$str_email = $str_email.$row["mother_email"];
								$tot_num_email++;
								
							}
						
						
$to      = $str_email;
					echo '<br>'.$row["id"]."processing.....".date( "H:i:s",strtotime("now") );	
					
						$feed_date =strtotime("now");
if(!$my_file && !$my_file2)
{
mail($to, $subject, $message, $headers);
}
else
{
	if( $my_file && $my_file2)
	
	{
	mail_attachment($my_file,$my_file2, $my_path, $to, "info@bbfootballschools.com" , "Info-BBFS", "info@bbfootballschools.com" , $subject, $message);	

	}
	else
	{
	if($my_file){
	mail_attachment_1($my_file, $my_path, $to, "info@bbfootballschools.com" , "Info-BBFS", "info@bbfootballschools.com" , $subject, $message);
	}
	else
	{
	mail_attachment_1($my_file2, $my_path, $to, "info@bbfootballschools.com" , "Info-BBFS", "info@bbfootballschools.com" , $subject, $message);
	}
	
	}
}
$message_enc = addslashes($message);
mysql_query("INSERT INTO info (student_id, message, type, numbers, feedtime, response)
			VALUES ('$ar', '$message_enc', 'EMAIL','$str_email','$feed_date', 'NA' )");



}




echo "Now, You can click <a href=\"../students.php?type=browse\">Here </a>";
?>