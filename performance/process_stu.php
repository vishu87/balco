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
	
if(!$_POST["send_email"])
{

$arr =  $_POST["list"];
//echo $arr;
$id = mysql_real_escape_string($_GET["stu_id"]);
$str_stu='';
for($i=1;$i<=32;$i++)
	{
		$val = $_POST["st".$id."_".$i];
		if($i==1) $str_stu .= $val;
		else $str_stu .= ','.$val;
	}
	//echo $str_stu;
$comment = $_POST["comment_".$id];
mysql_query("update evaluation set performa='$str_stu', comments='$comment' where id='$arr' ");
	

header("Location: ../performance.php?type=att&id=".$id);



}
else
{

/************************EMAIL *******************/

$eva_id =  $_POST["list"];
$result_qau =mysql_query("select * from evaluation where id='$eva_id' limit 1");
$eva= mysql_fetch_array($result_qau);
$month = $eva["quarter"];
$year = $eva["year"];
$group = $eva["group"];
$city = $eva["city"];
$center = $eva["center"];

switch($month)
	{
		
		case 1:
			$quar = 'Jan-Mar';
			break;
		
		case 4:
			$quar = 'Apr-Jun';
			break;
		
		case 7:
			$quar = 'Jul-Sep';
			break;
		
		case 10:
			$quar = 'Oct-Dec';
			break;	
	
	}
					

$subject = 'BBFS training evaluation for'.$quar.' '.$year;
$headers = "From: info@bbfootballschools.com \r\n";
$headers .= "Reply-To: info@bbfootballschools.com \r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$feed_date =strtotime("now");

$ar = mysql_real_escape_string($_GET["stu_id"]);

$tot_num_email =0;
$str_email ='';

//student info
$sql_case="SELECT * from students WHERE id='$ar' ";
$result_case=mysql_query($sql_case);
$row = mysql_fetch_array($result_case);

//performa info
$sql_check="SELECT id from evaluation WHERE (student_id='$ar') AND (quarter='$month' AND year='$year') ";
$result_check=mysql_query($sql_check);
$row_check=mysql_fetch_array($result_check);
$idx= $row_check["id"];
$num_check = mysql_num_rows($result_check);

echo '<br>'.$row["id"]."processing.....".date("H:i:s",strtotime("now"));

if($num_check == 1)
{
$message = '<html><body><div style="width:800px; text-align:justify;">
<p style="font-size:13px;padding:5px; font-family:arial; line-height:1.5">Dear Parent, </p>
<p style="font-size:13px;padding:5px; font-family:arial;" >
We thank you for entrusting BBFS with the development of your child.  We are committed to contributing towards his/her football and overall development.
</p>

<p style="font-size:13px;padding:5px; font-family:arial;" >
<a href="http://www.bbfootballschools.com/admin/fpdf/performance/evaluation.php?id='.base64_encode($row["id"]).'&amp;q='.base64_encode($month).'&y='.base64_encode($year).'">Click here</a> to download the 3-month evaluation for the period of '.$quar.' for '.$year.'.
</p>

<p style="font-size:13px;padding:5px; font-family:arial;" >
Each evaluation is carefully carried out after assessing the progress of each child by the coaches. It is designed to be an assessment of the present state of development visa-vis the child\'s true potential, and hence not comparable amongst peers and serves the purpose of communicating the areas of improvement to the child in a positive manner.
</p>

<p style="font-size:13px;padding:5px; font-family:arial;" >
In case of any queries or suggestions,  please feel free to reply to this email and we will get back to you as soon as possible.
</p>

</p>';

$message .='<p style="font-size:13px;padding:5px; font-family:arial; line-height:1.5"><i>
Thanks and Regards,</i><br> <br>
 
BBFS Team<br>
www.bbfootballschools.com</p>
<br>
</div></body></html>';
						
						
							
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
						
						
$to  = $str_email;

mysql_query("UPDATE evaluation set sending_date ='$feed_date' where id='$idx'");				
$feed_date =strtotime("now");
mail($to, $subject, $message, $headers);					
echo $message;		
$message_enc = addslashes($message);

mysql_query("INSERT INTO info (student_id, message, type, numbers, feedtime, response) VALUES ('$ar', '$message_enc', 'EMAIL','$str_email','$feed_date', 'NA' )");
}
else
{
	echo "DATA NOT PRESENT, EMAIL IS NOT SENT<br><br>";
}

sleep(2);


echo "Now, You can click <a href=\"../performance.php?type=att&id=".$ar." \">Here </a>";
}
?>