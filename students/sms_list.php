<div class="top_m color1">
						<a href="students.php?type=browse" style="text-decoration:underline">
						
						<?php
						if(!$_POST["send_email"])
{

echo 'SMS';
}
else
{
echo 'EMAIL';
}
?></a> :
						
						<?php
if($_POST["list"])
{
$arr =  $_POST["list"];
}						
else
{
$arr =  array("$_GET[id]");
}
$str_num = '';
$str_email = '';
$notifications ='';
$count_student = 0;
$count_sms_valid =0;
$count_email_valid =0;
$tot_num =0;
$tot_num_email=0;
$notifications_email='';
$str_id_sms='';
$str_id_email='';

foreach($arr as $ar)
{
$flag=0;
$flag2=0;


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
								$flag=1;
							}
						
						}
						//if($row["status_email"] == 1)
						//{
							
							if($row["email"])
							{
								if($tot_num_email != 0){$str_email = $str_email.',';}
								$str_email = $str_email.$row["email"];
								$tot_num_email++;
								$flag2=1;
							}
						
						//}
						
						//if($row["father_status_email"] == 1)
						//{
							
							if($row["father_email"])
							{
								if($tot_num_email != 0){$str_email = $str_email.',';}
								$str_email = $str_email.$row["father_email"];
								$tot_num_email++;
								$flag2=1;
							}
						
						//}
						//if($row["mother_status_email"] == 1)
						//{
							
							if($row["mother_email"])
							{
								if($tot_num_email != 0){$str_email = $str_email.',';}
								$str_email = $str_email.$row["mother_email"];
								$tot_num_email++;
								$flag2=1;
							}
						
						//}
						if($row["father_status_mob"] == '1')
						{
							
							if($row["father_mob"])
							{
								if($tot_num != 0){$str_num = $str_num.',';}
								$str_num = $str_num.$row["father_mob"];
								$tot_num++;
								$flag=1;
							}
						
						}
						
						if($row["mother_status_mob"] == '1')
						{
							
							if($row["mother_mob"])
							{
								if($tot_num != 0){$str_num = $str_num.',';}
								$str_num = $str_num.$row["mother_mob"];
								$tot_num++;
								$flag=1;
							}
						
						}
						
						if($flag== 0)
						{
						
							$notifications = $notifications.'<br>No Contact Available for '.$row["name"].', '.$row["groupid"].', '.$row["center"].', '.$row["train_city"];
						}
						else
						{
								if($count_sms_valid != 0) {$str_id_sms = $str_id_sms.',';}
								$str_id_sms = $str_id_sms.$row["id"];
								$count_sms_valid++;
							
						}
						if($flag2== 0)
						{
						
							$notifications_email = $notifications_email.'<br>No Email Available for '.$row["name"].', '.$row["groupid"].', '.$row["center"].', '.$row["train_city"];
						}
						else
						{
						if($count_email_valid != 0) {$str_id_email= $str_id_email.',';}
								$str_id_email = $str_id_email.$row["id"];
								$count_email_valid++;
						}
									
$count_student++;
}			?>		
						</div>
<?php 
if(!$_POST["send_email"] && !$_GET["email"])
{
?>				
<div style="margin:10px;">
							SEND SMS
						<form method="post" action="students/sms_send.php" id="students" >	
						<input name="student_id"  type="hidden" style="width:700px;" value="<?php echo $str_id_sms;?>">
						<textarea name="send_num" style="width:700px;" readonly><?php echo $str_num;?></textarea>
						<br><br>Message:<br><Br>
						<textarea name="message" style="width:700px;"></textarea><br><br>
						<input type="Submit" value="SEND">&nbsp;&nbsp;&nbsp;<input onclick="javascript:window.history.back()" type="BUTTON" name="cancel" value="CANCEL">
						</form>
						<div style="margin-top:10px;">
						Total Number of Students:<?php echo $count_student;?><br><br>
						Total Number of Mobile Contacts:<?php echo $tot_num;?>
						</div>
						<div style="margin-top:10px;">
						<span style="color:#f00;">Notifications:</span>
						<?php echo $notifications;?>
						</div>
						</div>
						<form method="post" target="_blank" action="students/sms_excel.php">
						<input name="student_id"  type="hidden" style="width:700px;" value="<?php echo $str_id_sms;?>"><input type="Submit" value="GENERATE EXCEL">
						</form>
<?php
}
else
{
?>
	<div style="margin:10px;">
							SEND EMAIL
						<form method="post" action="students/email_send.php" id="students" enctype="multipart/form-data">
<input name="student_id"  type="hidden" style="width:700px;" value="<?php echo $str_id_email;?>">						
						<textarea name="send_email" style="width:700px;"><?php echo $str_email;?></textarea>
						<br><br>Subject:<br><Br>
						<textarea name="subject" style="width:700px;"></textarea><br><br>Message:<br><Br>
						<textarea class="ckeditor" cols="80" id="message" name="message" rows="10"></textarea>
<br><br>
						Select A File To Upload 1: <input type="file" name="uploaded_file">
						<br><br>
						Select A File To Upload 2: <input type="file" name="uploaded_file2">
						<br><br>
						<input type="Submit" value="SEND">&nbsp;&nbsp;&nbsp;<input onclick="javascript:window.history.back()" type="BUTTON" name="cancel" value="CANCEL">
						</form>
						<br><Br>
						<form method="post" action="students/email_send_payment.php" id="students" enctype="multipart/form-data">
<input name="student_id"  type="hidden" style="width:700px;" value="<?php echo $str_id_email;?>">
<input type="Submit" value="PAYMENT INFO EMAIL">
</form>
<br><br>
						<div style="margin-top:10px;">
						Total Number of Students:<?php echo $count_student;?><br><br>
						Total Number of EMAIL:<?php echo $tot_num_email;?>
						</div>
						<div style="margin-top:10px;">
							<form method="post" target="_blank" action="students/email_excel.php">
						<input name="student_id"  type="hidden" style="width:700px;" value="<?php echo $str_id_email;?>"><input type="Submit" value="GENERATE EXCEL">
						</form>
						<span style="color:#f00;">Notifications:</span>
						<?php echo $notifications_email;?>
						</div>
						</div>				
<?php
?>


<?php

}
?>