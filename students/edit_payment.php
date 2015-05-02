<script type="text/javascript">
function validate_required(field,alerttxt)
{
with (field)
  {
  if (value==null||value=="Select"|| value=="")
    {
    alert(alerttxt);return false;
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
	   if (validate_required(dos,"Please Choose Starting Date!")==false)
	  {dos.focus();return false;}
	   if (validate_required(doe,"Please Calculate End Date!")==false)
	  {doe.focus();return false;}

	 if (validate_required(dor,"Please Choose Payment Date!")==false)
	  {doe.focus();return false;}
    
    var arr = $("#inputField").val().split('-');
    var date1 = new Date(arr[1]+'/'+arr[0]+'/'+arr[2]);

    var arr2 = $("#inputField1").val().split('-');
    var date2 = new Date(arr2[1]+'/'+arr2[0]+'/'+arr2[2]);
    
    if(date2 < date1 ){
    	alert("Payment date can not be less than subscription start date");
    	return false;
    } 

  }
}
</script>
<?php
$row_student = mysql_fetch_array($result_top);

if(!in_array($row_student["first_group"], $all_groups_access_edit)) die('You are not authorized to edit');

$city = $row_student["train_city"];
$center = $row_student["center"];
$group = $row_student["groupid"];
$dob=date("j/n/Y", $row_student["dob"]);
$dob_str = explode("/", $dob);
$tr_city = array('Sikkim','New Delhi', 'Guwahati');
$tr_state = array('Andaman and Nicobar','Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chandigarh', 'Chhattisgarh', 'Dadra and Nagar Haveli', 'Daman and Diu', 'Delhi', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jammu and Kashmir', 'Jharkhand', 'Karnataka', 'Kerala', 'Lakshadweep', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Orissa', 'Pondicherry', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Tripura', 'Uttar Pradesh', 'Uttrakhand', 'West Bengal');
?>
<div class="top_m color1"><a href="students.php?type=browse" class="deco">Students</a>:</div>
						<div style="margin:10px;">
						Edit Student Information
						
						<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr>
								<td align="left" valign="top" width="30%">
									<div id="gen_form">
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Genral Information 
								<?php
								if($priv != 'coach'){
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
								
								</td>
								</tr>
								<tr>
									<td align="right" valign="top">Mother
									</td>
									<td ><?php echo $row_student["mother"].'';?><br><br>
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
										include('students/student_payment.php');
									 ?>
									 
							
								  
								</td>
							</tr>
							
						</table>
						
						
						</div>