<?php
set_time_limit ( 240 ) ;
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
	
$subject = 'BBFS - Football training fee due';
$headers = "From: info@bbfootballschools.com \r\n";
$headers .= "Reply-To: info@bbfootballschools.com \r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$headers1 = "From: Bhaichung Bhutia Football Schools <bbfootballschools@gmail.com> \r\n";
$headers1 .= "Reply-To: bbfootballschools@gmail.com \r\n";
$headers1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$arr = explode(',', $_POST["student_id"]);
	
foreach($arr as $ar)
{
sleep(3);

$tot_num_email =0;
$str_email ='';

$sql_case="SELECT * from students WHERE id='$ar' ";
$result_case=mysql_query($sql_case);
$row = mysql_fetch_array($result_case);
$sql_pay="SELECT * from payment_history WHERE student_id='$row[id]' ORDER BY doe DESC";
								$result_pay=mysql_query($sql_pay);
								$row_pay = mysql_fetch_array($result_pay);
$message = '<html><body><div style="width:800px; text-align:justify;">
<p style="font-size:13px;padding:5px; font-family:arial; line-height:1.5">Dear Parent, </p>

<p style="font-size:13px;padding:5px; font-family:arial;" >
Your child <b>'.$row["name"].'</b> is enrolled for <b>'.$row_pay["months"].'</b>month(s) for football coaching and his/her
subscription period is coming to an end/ended  on <b>'.date("d/m/y", $row["doe"]).'.</b> Request you to kindly renew his/her subscription by paying a fee of Rs.<b>'.$row_pay["sub_fee"].'</b> on a timely basis at the training center. Kindly ignore if already paid.</p>

<p style="font-size:13px;padding:5px; font-family:arial; line-height:1.5" >All cheque payments are to be made in favor of <b><i>"Talent Invigoration and Sports Management Pvt. Ltd".</i></b>

</p>';
if($row_pay["adjustment"] >0)
{
$message .='<p style="font-size:13px;padding:5px; font-family:arial; line-height:1.5" >Please also note that an adjustment of <b>'.$row_pay["adjustment"].'</b>days has been made on account of <b>';

if($row_pay["a_remark"])
{
$message .=$row_pay["a_remark"];
}
else
{
$message .= '(N/A)';
}

$message .='</b>.
</p>';
}

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

echo '<br>'.$row["id"]."processing.....".date("H:i:s",strtotime("now"));
					
$feed_date =strtotime("now");
mail($to, $subject, $message, $headers);					
//mail($to, $subject, $message, $headers1);
			echo $message;		
$message_enc = addslashes($message);

mysql_query("INSERT INTO info (student_id, message, type, numbers, feedtime, response)
			VALUES ('$ar', '$message_enc', 'EMAIL','$str_email','$feed_date', 'NA' )");

}






echo "Now, You can click <a href=\"../students.php?type=browse\">Here </a>";
?>