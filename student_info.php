<script type="text/javascript">
function validate_required(field,alerttxt)
{
with (field)
  {
  if (document.getElementById("inactive_reason").value== 'others')
    {
	if(value==null|| value=="")
	{
    alert(alerttxt);return false;
    }
	else
	{
	return true;
	}
	}
  else
    {
    return true;
    }
  }
}
function validate_form(thisform)
{
with (thisform)
  {
   if (validate_required(other_reason,"Please fill the reason!")==false)
  {other_reason.focus();return false;}
  
  
  }
}
</script>
<?php
$sql_case="SELECT * from students WHERE id='$_GET[id]'";
$sql_student =$sql_case." ORDER BY id DESC";
$result_case=mysql_query($sql_case);
									
									$row_student = mysql_fetch_array($result_case);
									
?>
						<div class="top_m color1">
						<a href="students.php?type=browse" class="deco">Students</a> : 
						<?php 
						/*if($priv == 'admin')
						{
echo '<a href="students.php?type=browse&city='.$row_student["train_city"].'" class="deco">'.$row_student["train_city"].'</a> : ';

}
else
{
	echo $row_student["train_city"].' :';
}
if($priv == 'citycord' || $priv == 'admin')
{
echo '<a href="students.php?type=browse&city='.$row_student["train_city"].'&group='.$row_student["groupid"].'" class="deco">'.$row_student["groupid"].'</a> : ';
}
else
{
	echo $row_student["groupid"].' :';
}
											echo '<a href="students.php?type=browse&id='.$row_student["id"].'" class="deco">'.$row_student["name"].'</a> : '; */?>														</div>
						<div style="margin:10px;">
						Student Profile 
						
						<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
						
							<tr>
								<td align="left" valign="top" width="30%">
									<div id="gen_form">
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Genral Information 
								<?php
								if( ($priv == 'coach' && $edit_priv == '1') || $priv == 'general'){
								}
								else
								{
								?>
								<a href="students.php?type=edit&id=<?php echo $_GET["id"]; ?>" style="text-decoration:underline;"><img src="icons/edit_profile.png"></a>
								<?php
								}
								?>
								</td>
								
							</tr>
								<?php 
								if($row_student["pic"]){
								echo '<tr><td align="center" colspan="2"><img src="images/tn_'.$row_student["pic"].'">
								</td></tr>';} ?><tr>
								<td width="40%" align="right" >Name
								</td>
								<td><?php echo $row_student["name"];?></td>
								</tr>
								<tr>
								<td align="right">DOB
								</td>
								<td ><?php echo date("d M Y	", $row_student["dob"])?></td>
								</tr>
								<?php if($priv != 'general')
								{
								?>
								<tr>
								<td align="right">E-mail
								</td>
								<td ><span 
								<?php
								if($row_student["status_email"] == '1')
								echo 'class="in_use"';
								else echo 'class="not_in_use"';
								?>
								
								
								> <?php echo $row_student["email"]?></span></td>
								</tr>
								<tr>
								<td align="right">Student Mobile
								</td>
								<td ><span 
								<?php
								if($row_student["status_mob"] == '1')
								echo 'class="in_use"';
								else echo 'class="not_in_use"';
								?>
								
								
								> <?php echo $row_student["mobile"]?></span></td>
								</tr>
								<?php } ?>
								<tr>
								<td align="right">Training City
								</td>
								<td ><?php echo $row_student["train_city"];?> </td>
								</tr>
								<tr>
								<td align="right">Training Center
								</td>
								<td ><?php echo $row_student["center"];?> </td>
								</tr>
								<tr>
								<td align="right">Group
								</td>
								<td ><?php echo $row_student["groupid"];?></td>
								</tr>
								<tr>
								<td align="right">School Name
								</td>
								<td ><?php echo $row_student["school"];?></td>
								</tr>
								<tr>
								<td align="right" valign="top">Father
								</td>
								<td ><?php echo $row_student["father"].'';?><br><br>
								<?php if($priv != 'general')
								{
								?>
								<span 
								<?php
								if($row_student["father_status_mob"] == '1' && $row_student["father_mob"])
								echo 'class="in_use"';
								else echo 'class="not_in_use"';
								?>
							
								>
								<?php echo $row_student["father_mob"].'';?></span><br><br>
								<span 
								<?php
								if($row_student["father_status_email"] == '1' && $row_student["father_email"])
								echo 'class="in_use"';
								else echo 'class="not_in_use"';
								?>
							
								>
								<?php echo $row_student["father_email"].'';?></span><br>
								<?php } ?>
								</td>
								</tr>
								<tr>
									<td align="right" valign="top">Mother
									</td>
									<td ><?php echo $row_student["mother"].'';?><br><br>
									<?php if($priv != 'general')
								{
								?>
									<span 
								<?php
								if($row_student["mother_status_mob"] == '1' && $row_student["mother_mob"])
								echo 'class="in_use"';
								else echo 'class="not_in_use"';
								?>
									
									>
									<?php echo $row_student["mother_mob"].'';?></span><br><br>
									<span 
								<?php
								if($row_student["mother_status_email"] == '1' && $row_student["mother_email"])
								echo 'class="in_use"';
								else echo 'class="not_in_use"';
								?>
							
								>
								<?php echo $row_student["mother_email"].'';?></span><br>
								<?php } ?>
									</td>
									</tr>
								<tr>
								<td align="right" valign="top">Address
								</td>
								<td >
								<?php echo $row_student["address"].'<br>'.$row_student["city"].'<br>'.$row_student["state"];?>
								</td>
								</tr>
							
							</table>
									
									</div>
								  </td>
								<td align="left" valign="top" width="50%">
								<?php
								if($priv != 'coach' && $priv != 'general')
							{
							?>
									<div id="gen_form">
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Payment History
								</td>
								
							<?php
							$sql_case="SELECT * from payment_history WHERE student_id='$_GET[id]'";
$sql_case =$sql_case." ORDER BY doe DESC";
$result_case=mysql_query($sql_case);
$num_rows = mysql_num_rows($result_case);

							
							 include('students/payment_info.php');
							 
							 
							?>
							
							</table>
							<?php
							
							if( strtotime("now") > $row_student["doe"] || !$row_student["doe"])
							{
								if($row_student["active"] == 1)
								{
									echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#fff; padding:3px 5px 3px 5px; background:#5F6888;">INACTIVE STUDENT</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								}
								else
								{
							?>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="mark_in1" id="a_inactive"style="">MARK AS INACTIVE</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
							<?php
							}
							}
							
							?>
									<a href="students.php?type=edit_pay&id=<?php echo $_GET["id"]; ?>" style="color:#fff; padding:3px 5px 3px 5px; background:#5F6888;">Start New Subscription</a></div>
							
							<?php
							}
							?>	
<div id="inactive_div" class="invisi" style="background:#ff0; ">
<div style="margin:10px">
<form action="students/process_student.php?type=inactive&id=<?php echo $_GET["id"]?>" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
&nbsp;&nbsp;&nbsp;&nbsp;Reason: 
<select name="inactive_reason"  id="inactive_reason" style="padding:2px 5px 2px 5px; margin:10px;">
<option>Studies</option>
<option>Injury</option>
<option>Other Football Institute</option>
<option>Change of Interest</option>
<option>Weather</option>
<option>Conveyance/Timings</option>
<option>Not Happy With Coaching</option>
<option value="others">Others</option>
</select><br>
&nbsp;&nbsp;&nbsp;&nbsp;<font style="font-size:11px; font-weight:bold;">(in case of others)&nbsp;&nbsp;</font><input type="text" name="other_reason" style="padding:2px 5px 2px 5px; margin:10px;">
<br>
&nbsp;&nbsp;&nbsp;&nbsp;Inactive Date <input type="text" size="12" name="doi" id="inputField1" /> (dd-mm-yyyy)
<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;<input type="SUBMIT" Value="SUBMIT">&nbsp;&nbsp;<input onclick="javascript:window.history.back()" type="BUTTON" name="cancel" value="CANCEL"><br><br>
</form>
</div>
</div>		
<div>
<?php
if($row_student["active"] == 1)
{
	$sql_in = mysql_query("SELECT inactive_on,add_date from inactive_history where student_id='$row_student[id]' order by id desc ");
	$row_in = mysql_fetch_array($sql_in);
	echo '&nbsp;&nbsp;&nbsp;&nbsp;Inactive Reason: '.$row_student["main_reason"]."&nbsp;&nbsp;".$row_student["other_reason"];
	echo '&nbsp;&nbsp;&nbsp;&nbsp;Inactivation Date: ';
	echo ($row_in["inactive_on"])?date("d-M-y",$row_in["inactive_on"]):'';
	echo '&nbsp;&nbsp;Marked on: ';
	echo ($row_in["add_date"])?date("d-M-y",$row_in["add_date"]):'';
}

?>

</div>					
<?php
								if($priv != 'general')
							{
							?>
							
							<div id="gen_form">
							
							<?php include('students/injury_info.php');?>
							</div>
							<?php } ?>
								</td>
							</tr>
						</table>
						
						</div>
						
		<?php include('students/student_chat.php') ?>