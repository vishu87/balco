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

   if (validate_required(name,"Please fill the name!")==false)
  {name.focus();return false;}
   if (validate_required(username,"Please fill username!")==false)
  {username.focus();return false;}

  
  }
}

function edit_priv() {
	 if (document.getElementById('priv').value == 'coach'){
	 
	 document.getElementById('edit_priv').innerHTML = '<br><br>Editing Privilege: <select name="edit_pr"><option value="0">Yes</option><option value="1">No</option></select>';
	 
	 }
	 else{
	 
	 document.getElementById('edit_priv').innerHTML = ' ';
	 
	 }
	
	
	
      }
	  
</script>
<style type="text/css">
	#priv td, #priv th{
		border: 1px solid #CCC;
		padding:5px;
	}
</style>


<?php
if($_GET["edit_id"]){
$qry="SELECT * FROM members_priv WHERE id='$_GET[edit_id]'";
$result=mysql_query($qry);
$row_edit = mysql_fetch_array($result);
}
$tr_state = array('Andaman and Nicobar','Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chandigarh', 'Chhattisgarh', 'Dadra and Nagar Haveli', 'Daman and Diu', 'Delhi', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jammu and Kashmir', 'Jharkhand', 'Karnataka', 'Kerala', 'Lakshadweep', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Orissa', 'Pondicherry', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Tripura', 'Uttar Pradesh', 'Uttrakhand', 'West Bengal');
?>
						<div class="top_m color1">Member Priviledge</div>
							<form action="manage/member_priv_process.php?type=<?php echo ($_GET["edit_id"])?'2':'1' ?>&amp;user_id=<?php echo $_GET["id"] ?>" method="post">
							<?php
							if($_GET["edit_id"]){
							?>	
								<input type="hidden" readonly name="edit_id" value="<?php echo $row_edit["id"] ?>">
							<?php } ?>
						<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr>
								


								<td align="left" valign="top" width="60%">
								     <?php 
								     	if($_GET["id"]){
							     		$user_id = mysql_real_escape_string($_GET["id"]);
							     		?>
							     		<div id="gen_form">
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
																	<tbody><tr class="color2">
								<td align="left" valign="top" colspan="2">
								<?php echo ($_GET["edit_id"])?'EDIT':'ADD' ?> Priviledge
								</td>
								
							</tr>
							<tr>
							<td align="right">Center
							</td>
							<td >
								<select name="center" id="ct1centerid">
									<option value="-1" >ALL</option>
									<?php	
										$sql_center="SELECT * from center order by center_name asc";
										$result_center=mysql_query($sql_center);
													
										while($row_center = mysql_fetch_array($result_center)){
											echo '<option value="'.$row_center["id"].'" ';
											if($row_center["id"] == $row_edit["center_id"]) echo 'selected';
											echo '>'.$row_center["center_name"].'</option>';
											$count_center++;
										}
									?>
							
								</select>
							</td>
							</tr>
							<tr>
							<td align="right">Group
							</td>
							<td >
								<select name="groups[]" id="ct1groupid" multiple style="padding:10px; height:100px">
									<?php 
									$cen_array = explode(',', $row_edit["groups"]);
									$sql_group="SELECT * from groups where center_id = $row_edit[center_id] order by group_name asc";
									$result_group=mysql_query($sql_group);
									$count_group = 1;
									while($row_group = mysql_fetch_array($result_group)){
										echo '<option value="'.$row_group["id"].'"';
										if(in_array($row_group["id"], $cen_array)){
											echo " selected";
										}
										echo '>'.$row_group["group_name"].'</option>';
										$count_group++;
									}
									?>
								</select>
							</td>
							</tr>
							<tr>
								<td align="right">Student's Profile</td>
								<td>
									View: <?php select_fields('sp_view',$row_edit["sp_view"]) ?>
									Edit: <?php select_fields('sp_edit',$row_edit["sp_edit"]) ?>
								</td>
							</tr>
							<tr>
								<td align="right">Student's Evaluations</td>
								<td>
									View: <?php select_fields('eval_view',$row_edit["eval_view"]) ?>
									Edit: <?php select_fields('eval_edit',$row_edit["eval_edit"]) ?>
								</td>
							</tr>
							<tr>
								<td align="right">Student's Attendance</td>
								<td>
									View: <?php select_fields('att_view',$row_edit["att_view"]) ?>
									Edit: <?php select_fields('att_edit',$row_edit["att_edit"]) ?>
								</td>
							</tr>
							<tr>
								<td align="right">Coaches's Profile</td>
								<td>
									View: <?php select_fields('c_att_view',$row_edit["c_att_view"]) ?>
									Edit: <?php select_fields('c_att_edit',$row_edit["c_att_edit"]) ?>
								</td>
							</tr>
							<tr>
								<td align="right">Payments</td>
								<td>
									<?php select_fields('payments',$row_edit["payments"]) ?>
								</td>
							</tr>
							<tr>
								<td align="right">Adjustment</td>
								<td>
									<?php select_fields('adjustment',$row_edit["adjustment"]) ?>
								</td>
							</tr>
							<tr>
								<td align="right">Add New Group</td>
								<td>
									<?php select_fields('add_new_group',$row_edit["add_new_group"]) ?>
								</td>
							</tr>
							<tr>
								<td align="right">Add Member</td>
								<td>
									<?php select_fields('add_member',$row_edit["add_member"]) ?>
								</td>
							</tr><tr>
								<td align="right">Manage Member</td>
								<td>
									<?php select_fields('manage_member',$row_edit["manage_member"]) ?>
								</td>
							</tr>
							<tr>
								<td align="right">Level (1 Hightest)</td>
								<td>
									<select name="level">
										<?php
											for ($i=1; $i <= 10 ; $i++) { 
												?>
												<option value="<?php echo $i ?>" <?php echo ($i == $row_edit["level"])?'selected':'' ?>><?php echo $i ?></option>
												<?php
											}
										?>
									</select>
								</td>
							</tr>
							</tbody></table>
							<div align="center"><input type="submit" value="<?php echo ($_GET["edit_id"])?'EDIT':'ADD' ?>"></div>
							</form>
									
									</div>
									<div id="gen_form">	
									Privileges
									<table id="priv" cellspacing="0" cellpadding="0">
										<tr class="top_m color1">

											<th>Center</th>
											<th>Groups</th>
											<th>Student Profile</th>
											<th>Student Evaluation</th>
											<th>Student Attendance</th>
											<th>Coach Attendance</th>
											<th>Payments</th>
											<th>Adjustment</th>
											<th>Add New Group</th>
											<th>Manage Member</th>
											<th>Level</th>
											<th>Edit</th>
										</tr>
											<?php 
											$sql_priv = mysql_query("SELECT members_priv.*, center.center_name from members_priv inner join center on members_priv.center_id = center.id where members_priv.user_id = '$user_id' ");
											while ($row_priv = mysql_fetch_array($sql_priv)) {
												
											?>
											<tr>
	
												<th><?php echo $row_priv["center_name"] ?></th>
												<th><?php 
												$sql_grp = mysql_query("SELECT group_name from groups where id in ($row_priv[groups]) order by group_name asc ");
												while ($row_grp = mysql_fetch_array($sql_grp)) {
													echo $row_grp["group_name"].', ';
												}
												?></th>
												<th><?php echo 'View: '.yesno($row_priv["sp_view"]).' Edit:'.yesno($row_priv["sp_edit"]) ?></th>
												<th><?php echo 'View: '.yesno($row_priv["eval_view"]).' Edit:'.yesno($row_priv["eval_edit"]) ?></th>
												<th><?php echo 'View: '.yesno($row_priv["att_view"]).' Edit:'.yesno($row_priv["att_edit"]) ?></th>
												<th><?php echo 'View: '.yesno($row_priv["c_att_view"]).' Edit:'.yesno($row_priv["c_att_edit"]) ?></th>
												<th><?php echo yesno($row_priv["payments"]) ?></th>
												<th><?php echo yesno($row_priv["adjustment"]) ?></th>
												<th><?php echo yesno($row_priv["add_new_group"]) ?></th>
												<th><?php echo 'Add: '.yesno($row_priv["add_member"]).' Manage:'.yesno($row_priv["manage_member"]) ?></th>
												<th><?php echo $row_priv["level"] ?></th>
												<th><a href="?type=member_priv&amp;id=<?php echo $user_id ?>&amp;edit_id=<?php echo $row_priv["id"] ?>"><img src="edit.png"></a></th>
											</tr>
											<?php } ?>
									</table>
							     		<?php 



							     }  ?>
								  
								</td>
							</tr>
						
							
						</table>
					</div>

							

							<br><br>
						
						Available Members:
						<?php
						
								$qry="SELECT * FROM members ";
								if($priv != 'admin'){
								$qry = $qry." WHERE train_city='$city' ";}
								$qry = $qry."ORDER BY train_city ASC";
								$result=mysql_query($qry);
								//$row_num_qry = mysql_num_rows($result);
						?>
						<div id="gen_form">
						<table cellspacing="2" >
						<tr class="top_m color1"><td width="150"  align="center">Name</td><td width="100"  align="center">Username</td><td width="100"  align="center">Privledge</td><td>City</td><td>Center</td><td>Edit</td>
						</tr>
						<?php
						$count_mem =0;
						while($row = mysql_fetch_array($result))
						{
						if($count_mem%2 == 0)
						{
						echo '<tr >';
						}
						else
						{
						echo '<tr style="background:#EEE">';
						}
						  echo '<td width="150" align="left">'.$row["name"].'</td><td align="center">'.$row["username"].'</td><td align="center">'.$row["priv"].'</td><td align="center">'.$row["train_city"].'</td><td align="center">'.$row["center"].'</td><td><a href="?type=member_priv&amp;id='.$row["id"].'"><img src="edit.png"></a></td>';
						  echo '</tr>';
						$count_mem++;
						}
						
						 ?>
						 </table></div>
						</div>
						</div>
		<?php
			function select_fields($name,$value){
				echo '<select name="'.$name.'">';
				echo '<option value="0">No</option>';
				echo '<option value="1" ';
				echo ($value == 1)?'selected':'';
				echo '>Yes</option>';
				echo '</select>';
			}
			function yesno($field){
				if($field == 0){
					return 'N';
				} else return 'Y';
			}
		?>

						