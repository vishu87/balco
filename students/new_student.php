<script type="text/javascript">
var get_type = "sp_edit";
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
   if (validate_required(name,"Please fill the name!")==false)
  {name.focus();return false;}
   if (validate_required(first_group,"Please fill Group Name!")==false)
  {first_group.focus();return false;}
  
  }
}
</script>

						<div class="top_m color1">
						Add New Student
						</div>
						<div style="margin:5px;">
						New Student
						<form action="students/	process_student.php?type=1" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
						<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr>
								<td align="left" valign="top" width="50%">
									<div id="gen_form">
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Genral Information
								</td>
								
							</tr>
							
							<tr>
											<td align="right">City</td><td>
											
									<?php
				
									echo '<select  id="ctlcityidtype">
									<option>Select</option>';
									foreach($cities as $key => $city)
									{
										echo '<option value="'.$key.'"';
										echo '>'.$city.'</option>';
										$count_city++;
									}
									echo'</select>';
								
								
								
							?>
							</td>
							
									</tr>
							<tr>
									<td align="right">Traning Center
							</td>
							<td >
							<?php
							
								echo '<select  id="ctlcenteridtype">
								<option>Select	</option>';

								echo '</select>';
								//echo "yes";

							?>
							
							
							</td>
							</tr>
							
							<tr>
							<td align="right">Group
							</td>
							<td >
							<?php

								echo '<select name="first_group" id="ct1groupidtype">
								<option>Select	</option>';

								echo '</select>';

							?>
							
							</td>
							</tr>
							
							
							
							<tr>
							<td width="40%" align="right">Name
							</td>
							<td><input type="text" name="name"></td>
							</tr>
							<tr>
							<td align="center" colspan="2">
							DOB:&nbsp;&nbsp;&nbsp;Date <select name="date">
							<?php
							for($i=1; $i<32;$i++)
							{
								echo '<option>'.$i.'</option>';
							}
							?>
							</select>
							Month <select name="month">
							<?php
							for($i=1; $i<13;$i++)
							{
								echo '<option>'.$i.'</option>';
							}
							?>
							</select>
							Year <select name="year">
							<?php
							for($i=1990; $i<2010;$i++)
							{
								echo '<option>'.$i.'</option>';
							}
							?>
							</select>
							</td>
							</tr>
							<tr>
							<td align="right">School Name
							</td>
							<td ><input type="text" name="school"></td>
							</tr>
							<tr>
							<td align="right">Email
							</td>
							<td ><input type="text" name="email">&nbsp;&nbsp;<input type="checkbox" name="status_email" value="1"></td>
							</tr>
							<tr>
							<td align="right">Mobile Number
							</td>
							<td ><input type="text" name="mobile">&nbsp;&nbsp;<input type="checkbox" name="status_mob" value="1"></td>
							</tr>
							
							
							
							
							
							<tr>
							<td align="right">Father's Name
							</td>
							<td ><input type="text" name="father"></td>
							</tr>
							<tr>
							<td align="right">Father's Mobile No.
							</td>
							<td ><input type="text" name="father_mob">&nbsp;&nbsp;<input type="checkbox" name="father_status_mob" value="1"></td>
							</tr>
							<tr>
							<td align="right">Father's Email
							</td>
							<td ><input type="text" name="father_email">&nbsp;&nbsp;<input type="checkbox" name="father_status_email" value="1"></td>
							</tr>
							<tr>
							<td align="right">Mother's Name
							</td>
							<td ><input type="text" name="mother"></td>
							</tr>
							<tr>
							<td align="right">Mother's Mob No.
							</td>
							<td ><input type="text" name="mother_mob">&nbsp;&nbsp;<input type="checkbox" name="mother_status_mob" value="1"></td>
							</tr>
							<tr>
							<td align="right">Mother's Email
							</td>
							<td ><input type="text" name="mother_email">&nbsp;&nbsp;<input type="checkbox" name="mother_status_email" value="1"></td>
							</tr>
							<tr>
							<td align="right">Address
							</td>
							<td ><input type="text" name="address"></td>
							</tr>
							<tr>
							<td align="right">City
							</td>
							<td ><input type="text" name="city"></td>
							</tr>
							<tr>
							<td align="right">State
							</td>
							<td ><select name="state" id="state" class="input_field">
							
							<option value='Andaman and Nicobar'>Andaman and Nicobar</option>
<option value='Andhra Pradesh'>Andhra Pradesh</option>
<option value='Arunachal Pradesh'>Arunachal Pradesh</option>
<option value='Assam'>Assam</option>
<option value='Bihar'>Bihar</option>
<option value='Chandigarh'>Chandigarh</option>
<option value='Chhattisgarh'>Chhattisgarh</option>
<option value='Dadra and Nagar Haveli'>Dadra and Nagar Haveli</option>
<option value='Daman and Diu'>Daman and Diu</option>
<option value='Delhi'>Delhi</option>
<option value='Goa'>Goa</option>
<option value='Gujarat'>Gujarat</option>
<option value='Haryana'>Haryana</option>
<option value='Himachal Pradesh'>Himachal Pradesh</option>
<option value='Jammu and Kashmir'>Jammu and Kashmir</option>
<option value='Jharkhand'>Jharkhand</option>
<option value='Karnataka'>Karnataka</option>
<option value='Kerala'>Kerala</option>
<option value='Lakshadweep'>Lakshadweep</option>
<option value='Madhya Pradesh'>Madhya Pradesh</option>
<option value='Maharashtra'>Maharashtra</option>
<option value='Manipur'>Manipur</option>
<option value='Meghalaya'>Meghalaya</option>
<option value='Mizoram'>Mizoram</option>
<option value='Nagaland'>Nagaland</option>
<option value='Orissa'>Orissa</option>
<option value='Pondicherry'>Pondicherry</option>
<option value='Punjab'>Punjab</option>
<option value='Rajasthan'>Rajasthan</option>
<option value='Sikkim'>Sikkim</option>
<option value='Tamil Nadu'>Tamil Nadu</option>
<option value='Tripura'>Tripura</option>
<option value='Uttar Pradesh'>Uttar Pradesh</option>
<option value='Uttrakhand'>Uttrakhand</option>
<option value='West Bengal'>West Bengal</option>
						
							</select></td>
							</tr>
							<tr>
							<td align="right">Upload Pic
							</td>
							<td ><input type="file" name="file"></td>
							</tr>
							
							</table>
									
									</div>
								  </td>
								<td align="left" valign="top" width="50%">
								     <div id="gen_form">
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Subscription
								</td>
								
							</tr>
							<tr>
							<td width="40%" align="right">Registration Fees
							</td>
							<td><input type="text" id="reg_fee" name="reg_fee" style="text-align:right" value="0">&nbsp; Rs.</td>
							</tr>
							<tr>
								<tr>
							<td width="40%" align="right">Subscription Fee
							</td>
							<td><input type="text" id="sub_fee" name="sub_fee" style="text-align:right" value="0">&nbsp; Rs.</td>
							</tr>
							<tr>
							<td width="40%" align="right">Kit Fee
							</td>
							<td><input type="text" id="kit_fee" name="kit_fee" style="text-align:right" value="0">&nbsp; Rs.</td>
							</tr>
							<tr>
							<tr>
							<td width="40%" align="right">Amount
							</td>
							<td><input type="text" id="amount" name="amount" style="text-align:right" readonly>&nbsp; Rs.</td>
							</tr>
							<tr>
							<td align="right">Subscription Start
							</td>
							<td ><input type="text" size="12" name="dos" id="inputField" /></td>
							</tr>
							<tr>
							<td align="right">Date of Payment
							</td>
							<td ><input type="text" size="12" name="dor" id="inputField1" /></td>
							</tr>
							<tr>
							<td align="right">Month Plan
							</td>
							<td ><select type="text" name="mplan" id="mplan" />
						<?php $tr_pay_months = array( '1', '2', '3','4','5', '6', '12');
					foreach($tr_pay_months as $tr)
							{
								echo '<option value="'.$tr.'" ';
								echo' >'.$tr.' Month</option>';
							}
						?>

							</select>
							</td>
							</tr>
							<tr>
							<td align="right">Adjustment
							</td>
							<td ><input type="text" size="12" name="adjust" id="adjust"  /> Days</td>
							</tr>
							<tr>
							<td align="right">
							</td>
							<td ><a id="calculate" href="#doe">Calculate End Date</a></td>
							</tr>
							<tr>
							<td align="right">Subscription End
							</td>
							<td ><input type="text" size="12" name="doe" id="sub_end" value="" readonly/>
						
							
							</td>
							</tr>
							<tr>
							<td align="right">Payment Remark
							</td>
							<td ><input type="text" name="p_remark"><span id="reg_out"></span></td>
							</tr>
							<tr>
							<td align="right">Adjustment Remark
							</td>
							<td ><input type="text" name="a_remark"><span id="reg_out"></span></td>
							</tr>
							
							</table>
									
									</div>
								  
								</td>
							</tr>
							
						</table>
						<div align="center">
						<input type="SUBMIT" name="add" Value="ADD">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="SUBMIT" name="addmore" value="ADD MORE IN SAME GROUP">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input onclick="javascript:window.history.back()" type="BUTTON" name="cancel" value="CANCEL">
						</div>
						</form>
						</div>
						
						<script type="text/javascript">
		$("#reg_fee").keyup(function(){
			value = parseInt($("#reg_fee").val())+parseInt($("#sub_fee").val())+parseInt($("#kit_fee").val());
			$("#amount").val(value);

		});

		$("#sub_fee").keyup(function(){
			value = parseInt($("#reg_fee").val())+parseInt($("#sub_fee").val())+parseInt($("#kit_fee").val());
			$("#amount").val(value);

		});

		$("#kit_fee").keyup(function(){
			value = parseInt($("#reg_fee").val())+parseInt($("#sub_fee").val())+parseInt($("#kit_fee").val());
			$("#amount").val(value);

		});
	</script>	