<?php
set_time_limit ( 240 ) ;

$ch = curl_init();
$str_mob = "9634628573,9871289689,8860816546";
$arr = explode(',', $str_mob);
foreach($arr as $ar)
{

	echo '<br>'.$row["id"]."processing.....";	
	$receipientno=$ar;
	
	$msgtxt = "Demo Message";
	curl_setopt($ch,CURLOPT_URL,  "http://bbfootballschools.com/admin/students/try.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "PhoneNumber=$receipientno&Text=$msgtxt");
	$buffer = curl_exec($ch);
	echo $ar;
	if(empty ($buffer))
	{ echo " buffer is empty "; }
	else
	{ echo $buffer; }

}

curl_close($ch);
echo "<br><br>Now, You can click <a href=\"../students.php?type=browse\">Here </a>";

?>