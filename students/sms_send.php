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

	$ch = curl_init();
$user="vishu.iitd@gmail.com:rajalka";
$senderID="TEST SMS";
	
	$arr = explode(',', $_POST["student_id"]);
	foreach($arr as $ar)
{
$tot_num =0;
$str_num ='';

$sql_case="SELECT * from students WHERE id='$ar' ";
$result_case=mysql_query($sql_case);
$row = mysql_fetch_array($result_case);
						
						if($row["status_mob"] == 1)
						{
							
							if($row["mobile"])
							{
								if($tot_num != 0){$str_num = $str_num.',';  }
								$str_num = $str_num.$row["mobile"];
								$tot_num++;
							}
						
						}
						
						
						if($row["father_status_mob"] == '1')
						{
							
							if($row["father_mob"])
							{
								if($tot_num != 0){$str_num = $str_num.',';}
								$str_num = $str_num.$row["father_mob"];
								$tot_num++;
								
							}
						
						}
						
						if($row["mother_status_mob"] == '1')
						{
							
							if($row["mother_mob"])
							{
								if($tot_num != 0){$str_num = $str_num.',';}
								$str_num = $str_num.$row["mother_mob"];
								$tot_num++;
								
							}
						
						}

					echo '<br>'.$row["id"]."processing.....";	
					$receipientno=$str_num;
					
					
						$feed_date =strtotime("now");
						$f_name = explode(' ',$row["name"]);
						$msgtxt = $_POST["message"];
						curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt&&state=2");
$buffer = curl_exec($ch);
if(empty ($buffer))
{ echo " buffer is empty "; }
else
{ echo $buffer; }

mysql_query("INSERT INTO info (student_id, message, type, numbers, feedtime, response)
			VALUES ('$ar', '$msgtxt', 'SMS','$str_num','$feed_date', '$buffer' )");

}

curl_close($ch);
echo "Now, You can click <a href=\"../students.php?type=browse\">Here </a>";

?>