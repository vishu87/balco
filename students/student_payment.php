<?php $tr_pay_months = array( '1', '2', '3','4','5', '6', '12');?>
<form action="students/process_student.php?type=<?php 
if($_GET["update"] == 'yes')
{
echo 'payedit';
}
else
{
echo 'paystart';
}

?>
&id=<?php echo $_GET["id"]?>" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
<?php
$sql_case="SELECT * from payment_history WHERE id='$_GET[pay_id]'";
$sql_case =$sql_case." ORDER BY id DESC";
$result_case=mysql_query($sql_case);
$num_rows = mysql_num_rows($result_case);
if($_GET["update"] == 'yes')
{
$row_pay_edit = mysql_fetch_array($result_case);
}
?>
<div id="gen_form">
<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Subscription
								</td>
								
							</tr>
							
							
							<tr>
							<td width="40%" align="right">Registration Fee
							</td>
							<td>							
							<input type="text" id="reg_fee" name="reg_fee" style="text-align:right" value="<?php  echo ($row_pay_edit["reg_fee"])?$row_pay_edit["reg_fee"]:'0'; ?>">&nbsp; Rs.</td>
							</tr>
							<tr>
							<td width="40%" align="right">Subscription Fee
							</td>
							<td>							
							<input type="text" id="sub_fee" name="sub_fee" style="text-align:right" value="<?php  echo ($row_pay_edit["sub_fee"])?$row_pay_edit["sub_fee"]:'0'; ?>">&nbsp; Rs.</td>
							</tr>
							<tr>
							<td width="40%" align="right">Kit Fee
							</td>
							<td><input type="text" id="kit_fee" name="kit_fee" style="text-align:right" value="<?php  echo ($row_pay_edit["kit_fee"])?$row_pay_edit["kit_fee"]:'0'; ?>">&nbsp; Rs.</td>
							</tr>
							<tr>
							<td width="40%" align="right">Amount
							</td>
							<td><input type="hidden" name="pay_id" value="<?php  echo $row_pay_edit["id"]; ?>">
							
							<input type="text" id="amount" name="amount" style="text-align:right" value="<?php  echo $row_pay_edit["amount"]; ?>" readonly>&nbsp; Rs.</td>
							</tr>
							<tr>
							<td align="right">Subscription Start
							</td>
							<td ><input type="text" size="12" name="dos" id="inputField" value="<?php  if($_GET["update"] == 'yes')
{echo date("d-m-Y", $row_pay_edit["dos"]); }?>" /></td>
							</tr>
							<tr>
							<td align="right">Date of Payment
							</td>
							<td ><input type="text" size="12" name="dor" id="inputField1" value="<?php  if($_GET["update"] == 'yes')
{echo date("d-m-Y", $row_pay_edit["dor"]); }?>" /></td>
							</tr>
							<tr>
							<td align="right">Month Plan
							</td>
							<td ><select type="text" name="mplan" id="mplan" />
							<?php
							foreach($tr_pay_months as $tr)
							{
								echo '<option value="'.$tr.'" ';
								if($row_pay_edit["months"] == $tr) echo "selected";
								echo' >'.$tr.' Month</option>';
							}
							
							
							?>
							
							
							</select>
							</td>
							</tr>
							<tr>
							<td align="right">Adjustment
							</td>
							<td ><input type="text" size="12" name="adjust" id="adjust" value="<?php echo $row_pay_edit["adjustment"];?>"  /> Days</td>
							</tr>
							<tr>
							<td align="right">
							</td>
							<td ><a id="calculate" href="#doe">Calculate End Date</a></td>
							</tr>
							<tr>
							<td align="right">Subscription End
							</td>
							<td ><input type="text" size="12" name="doe" id="sub_end" value="<?php  
							if($_GET["update"] == 'yes')
{
echo date("d M Y", $row_pay_edit["doe"]);} ?>" readonly/>
						
							
							</td>
							</tr>
							<tr>
							<td align="right">Payment Remark
							</td>
							<td ><input type="text" name="p_remark" value="<?php  echo $row_pay_edit["p_remark"]; ?>" ><span id="reg_out"></span></td>
							</tr>
							<tr>
							<td align="right">Adjustment Remark
							</td>
							<td ><input type="text" name="a_remark" value="<?php  echo $row_pay_edit["a_remark"]; ?>"><span id="reg_out"></span></td>
							</tr>
							
							
							</table>
									
									</div>
<div align="center">
						<input type="SUBMIT" Value="SUBMIT">&nbsp;&nbsp;<input onclick="javascript:window.history.back()" type="BUTTON" name="cancel" value="CANCEL">
						</div>
								</form>
								<div id="gen_form">
								<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<?php
							
							 include('students/payment_info.php');
							 
							?>
								
								</table></div>
								<?php
							
							if( strtotime("now") > $row_student["doe"] || !$row_student["doe"])
							{
								if($row_student["active"] == 1)
								{
									echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#fff; padding:3px 5px 3px 5px; background:#5F6888;">STUDENT IS INACTIVE</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								}
								else
								{
									if(in_array($row_student["first_group"], $all_groups_access_edit)){
							?>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="alert('Please cancel subscription window first')" id="a_inactive" style="color:#fff;  padding:3px 5px 3px 5px; background:#5F6888;">MARK AS INACTIVE</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
							<?php
								}
							}
							}
							
							?>
									<a href="students.php?type=edit_pay&id=<?php echo $_GET["id"]; ?>" style="color:#fff; padding:3px 5px 3px 5px; background:#5F6888;">Start New Subscription</a>
							
							
									</div>
	<script type="text/javascript">
		$("#reg_fee").keyup(function(){
			value = parseInt($("#reg_fee").val())+parseInt($("#sub_fee").val())+parseInt($("#kit_fee").val());;
			$("#amount").val(value);

		});

		$("#sub_fee").keyup(function(){
			value = parseInt($("#reg_fee").val())+parseInt($("#sub_fee").val())+parseInt($("#kit_fee").val());;
			$("#amount").val(value);

		});
		$("#kit_fee").keyup(function(){
			value = parseInt($("#reg_fee").val())+parseInt($("#sub_fee").val())+parseInt($("#kit_fee").val());
			$("#amount").val(value);

		});
	</script>