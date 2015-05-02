
<?php
$sql_case="SELECT * from payment_history WHERE student_id='$_GET[id]'";
$sql_case =$sql_case." ORDER BY doe DESC";
$result_case=mysql_query($sql_case);
$num_pay = mysql_num_rows($result_case);
$row_payment = mysql_fetch_array($result_case);
									
?>
							<tr>
							<td width="40%" align="right">Renewal Due On:
							</td>
							<td><?php if($row_payment["doe"]) echo date("d M Y", $row_payment["doe"]);?></td>
							</tr>
							<tr>
							<td width="40%" align="left" colspan="2">Renewal Details :
							</td>
							</tr>
							<tr>
							<td colspan="2" align="left">
							<table cellspacing="1" cellpadding="0" width="100%">
							<tr class="color3">
									<td>
									SN
									</td>
									<td>
									Start
									</td>
									<td>
									End
									</td>
									<td>
									Amount
									</td>
									<td>
									Details
									</td>
										
									<td>
									Plan<br><font style="font-size:10px;">(Months)</font>
									</td>
									<td>
									Adjustment<br><font style="font-size:10px;">(Days)</font>
									</td>
									<td>
									Remark<br><font style="font-size:10px;">(Payment/Adjustsment)</font>
									</td>
									<?php if(in_array($row_student["first_group"], $all_groups_access_edit)): ?>
									<td>Edit</td>
									<td>Delete</td>
									<?php endif; ?>								
								</tr>
								<?php
								$result_case=mysql_query($sql_case);
								while($row_payment = mysql_fetch_array($result_case))
								{
									
									if($num_pay%2 ==1)
										{
									echo '<tr class="color2">';
									}
									else
									{
									echo '<tr>';
									}
									echo'
									
									<td>
									'.($num_pay).'
									</td>
									<td>
									';
									 echo date("d M Y", $row_payment["dos"]);
									
									echo '
									</td>
									<td>
									'.date("d M Y", $row_payment["doe"]).'
									</td>
									<td>
									'.$row_payment["amount"].'
									</td>
									<td>
									Reg. Fee: '.$row_payment["reg_fee"].'
									/Sub. Fee: '.$row_payment["sub_fee"].'
									/Kit. Fee: '.$row_payment["kit_fee"].'
									</td>
									<td>
									'.$row_payment["months"].'
									</td>
									<td>
									'.$row_payment["adjustment"].'
									</td>
									<td>
									'.$row_payment["p_remark"].' / '.$row_payment["a_remark"].'
									</td>';
									if(in_array($row_student["first_group"], $all_groups_access_edit)){
									echo '<td><a href="students.php?type=edit_pay&amp;pay_id='.$row_payment["id"].'&amp;id='.$_GET["id"].'&amp;update=yes" ><img src="edit.png"></a></td>
									<td align="center"><a href= "students/process_student.php?type=6&amp;id='.$row_payment["id"].'"  onclick="return confirm(\'Do You Really Want to Delete? \');"><img src="erase.png"></a></td>'; };
								echo '</tr>';
								$num_pay--;
								}
								
								?>
							</table>
							</td>
							<tr>
							
							<td ></td>
							</tr>