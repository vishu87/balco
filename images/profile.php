<script type="text/javascript">
function select_validate_required(field,alerttxt)
{
with (field)
  {
  if (value==null||value=="Select1"||value=="")
    {
    alert(alerttxt);return false;
    }
  else
    {
    return true;
    }
  }
}
function validate_required(field,alerttxt)
{
with (field)
  {
  if (value==null||value=="")
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

  if (select_validate_required(old_p,"Please Fill Old Password!")==false)
  {old_p.focus();return false;}
  if (select_validate_required(new_p,"Please Fill New Password!")==false)
  {new_p.focus();return false;}
   if (validate_required(re_new_p,"Please Retype New Password!")==false)
  {re_new_p.focus();return false;}

  
  }
}
</script>

						<div class="top_m color1">
						My Profile
						</div>
						<div style="margin:10px;">
						<?php echo 'Username: '.$_SESSION["SESS_MEMBER_ID"];
						$sql="SELECT * from members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
											$result=mysql_query($sql);
											$row = mysql_fetch_array($result);
											$dob=date("j/n/Y", $row["dob"]);
$dob_str = explode("/", $dob);
						$tr_state = array('Andaman and Nicobar','Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chandigarh', 'Chhattisgarh', 'Dadra and Nagar Haveli', 'Daman and Diu', 'Delhi', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jammu and Kashmir', 'Jharkhand', 'Karnataka', 'Kerala', 'Lakshadweep', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Orissa', 'Pondicherry', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Tripura', 'Uttar Pradesh', 'Uttrakhand', 'West Bengal');
						?>
						
						
						<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr>
								<td align="left" valign="top" width="40%">
									<div id="gen_form">
									<form action="manage/process_member.php?type=2" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Genral Information
								</td>
								
							</tr>
							<?php 
							if($row["pic"]){
							echo '<tr><td align="center" colspan="2"><img src="images/tn_'.$row["pic"].'">
							</td></tr>';} ?>
							<tr>
							<td width="40%" align="right">Name
							</td>
							<td><input type="text" name="name" value="<?php echo $row["name"]?>"></td>
							</tr>
							
							<tr><td colspan="2">
							DOB:&nbsp;&nbsp;&nbsp;Date <select name="date">
							<?php
							for($i=1; $i<32;$i++)
							{
							if($i == $dob_str[0])
							{
								echo '<option selected>'.$i.'</option>';
							}
							else
							{
								echo '<option>'.$i.'</option>';
							}
							}
							?>
							</select>
							Month <select name="month">
							<?php
							for($i=1; $i<13;$i++)
							{
								if($i == $dob_str[1])
							{
								echo '<option selected>'.$i.'</option>';
							}
							else
							{
								echo '<option>'.$i.'</option>';
							}
							}
							?>
							</select>
							Year <select name="year">
							<?php
							for($i=1990; $i<2010;$i++)
							{
								if($i == $dob_str[2])
							{
								echo '<option selected>'.$i.'</option>';
							}
							else
							{
								echo '<option>'.$i.'</option>';
							}
							}
							?>
							</select>
							</td></tr>
							
							<tr>
							<td align="right">Email
							</td>
							<td ><input type="text" name="email" value="<?php echo $row["email"]?>" ></td>
							</tr>
							<tr>
							<td align="right">Traning City
							</td>
							<td ><?php echo $row["train_city"]?></td>
							</tr>
							<tr>
							<td align="right">Traning Center
							</td>
							<td ><?php echo $row["center"]?></td>
							</tr>
							
							<tr>
							<td align="right">Mobile No.
							</td>
							<td ><input type="text" name="mobile" value="<?php echo $row["mobile"]?>"></td>
							</tr>
							
							<tr>
							<td align="right">Address
							</td>
							<td ><input type="text" name="address" value="<?php echo $row["address"]?>"></td>
							</tr>
							<tr>
							<td align="right">City
							</td>
							<td ><input type="text" name="city" value="<?php echo $row["city"]?>"></td>
							</tr>
							<tr>
							<td align="right">State
							</td>
							<td ><select name="state" id="state" class="input_field" value="<?php echo $row_student["state"];?>">
							<?php
							foreach($tr_state as $tr)
								{
									if($tr == $row["state"] )
									{
									echo '<option selected>'.$tr.'</option>';
									}
									else
									{
									echo '<option>'.$tr.'</option>';
									}
								
								}
							?>
							</select></td>
							</tr>
							<tr>
							<td align="right">Upload Pic
							</td>
							<td ><input type="file" name="file"></td>
							</tr>
							<tr>
							<td align="center" colspan="2">
							
						<input type="SUBMIT" Value="SUBMIT">
						
							</td>
							</tr>
							
							</table>
									</form>
									</div>
								  </td>
								<td align="left" valign="top" width="60%">
								   <div id="gen_form">  
								  <form action="manage/process_member.php?type=3" method="post" onsubmit="return validate_form(this)" >
								  <table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Change Password
								</td>
								
							</tr>
							
							<tr>
							<td width="40%" align="right">Old Password
							</td>
							<td><input type="password" name="old_p" ></td>
							</tr>
							<tr>
							<td width="40%" align="right">New Password
							</td>
							<td><input type="password" name="new_p" ></td>
							</tr>
							<tr>
							<td width="40%" align="right">Retype Password
							</td>
							<td><input type="password" name="re_new_p" ></td>
							</tr>
							<?php
							if($_GET["err"] == 3)
							{
								echo '<tr><td colspan="2">Sucessfully Changed</td></tr>';
							}
							if($_GET["err"] == 1)
							{
								echo '<tr><td colspan="2">Old Password Doesn\'t Match</td></tr>';
							}
							if($_GET["err"] == 2)
							{
								echo '<tr><td colspan="2">New Passwords Doesn\'t Match</td></tr>';
							}
							
							
							
							?>
							
							
							<tr>
							<td align="center" colspan="2">
							
						<input type="SUBMIT" Value="SUBMIT">
						
							</td>
							</tr>
							
							</table></form></div>
									
									
									
								</td>
							</tr>
							
						</table>
						
						
						</div>
						
						