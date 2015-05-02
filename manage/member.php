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


<?php
if($_GET["id"])
{
$qry="SELECT * FROM members WHERE id='$_GET[id]'";
$result=mysql_query($qry);
$row_edit = mysql_fetch_array($result);
if($row_edit["dob"]){
$dob=date("j/n/Y", $row_edit["dob"]);}
else
{
$dob ='';
}
$dob_str = explode("/", $dob);

}
$tr_state = array('Andaman and Nicobar','Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chandigarh', 'Chhattisgarh', 'Dadra and Nagar Haveli', 'Daman and Diu', 'Delhi', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jammu and Kashmir', 'Jharkhand', 'Karnataka', 'Kerala', 'Lakshadweep', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Orissa', 'Pondicherry', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Tripura', 'Uttar Pradesh', 'Uttrakhand', 'West Bengal');
?>
						<div class="top_m color1">
						<?php
						if(!$_GET["id"])
						{
						echo 'Add New Member';
						}
						else
						{
						echo 'Edit: '.$row_edit["username"];
						}
						
						?>
						
						</div>
						
						<div style="margin:10px;">
						<?php
						if(!$_GET["id"])
						{
						echo 'New Member';
						}
						else
						{
						echo 'Edit: '.$row_edit["username"].'&nbsp;&nbsp;&nbsp;
						<a href="?type=member">Add New</a>';
						}
						
						?>
						<form action="manage/process_member.php?type=<?php
						if(!$_GET["id"])
						{
						echo '1';
						}
						else
						{
						echo '4&amp;id='.$row_edit["id"];
						}
						
						?>" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
						<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr>
								<td align="left" valign="top" width="40%">


									<div id="gen_form">
										<form action="manage/process_member.php?type=<?php
						if(!$_GET["id"])
						{
						echo '1';
						}
						else
						{
						echo '4&amp;id='.$row_edit["id"];
						}
						
						?>" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
										<?php
							if($_GET["info"]== 'yes')
							echo '
							<tr><td width="40%" align="right">
							</td>
							<td style="color:#20A62C;"><img src="check.png">Sucessfully Saved</td>
							</tr>';
							if($_GET["info"]== 'del')
							echo '
							<tr><td width="40%" align="right">
							</td>
							<td style="color:#20A62C;"><img src="erase.png">Sucessfully Deleted</td>
							</tr>';
							?>
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Genral Information
								</td>
								
							</tr>
							<tr>
							<td width="40%" align="right">Name
							</td>
							<td><input type="text" name="name" value="<?php echo $row_edit["name"];?>"></td>
							</tr>
							<tr>
							<td width="40%" align="right"><input type="hidden" name="user_id" value="<?php echo $row_edit["id"];?>">Username
							</td>
							<td>
							<?php
							if(!$_GET["id"])
							{
							?>
							<input type="text" name="username">
							<?php
							}
							else
							{
								echo $row_edit["username"];
							}
							?>
							</td>
							</tr>
							
							<?php
							if($_GET["err"]== '1')
							echo '
							<tr><td width="40%" align="right">
							</td>
							<td style="color:#f00;">User Name Already Exists</td>
							</tr>';
							?>
							
							<?php
							if(!$_GET["id"])
							{
							?>
							<tr>
							
							<td  align="right" colspan="2">
							Intial Password will be same as username</td>
							</tr>
							
							<?php
							}
							?>
							<tr>
							<td colspan="2">
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
							for($i=1950; $i<2010;$i++)
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
							</td>
							</tr>
							<tr>
							<td align="right">Email
							</td>
							<td ><input type="text" name="email" value="<?php echo $row_edit["email"];?>"></td>
							</tr>
							
							
							<tr>
							<td align="right">Mobile No.
							</td>
							<td ><input type="text" name="mobile" value="<?php echo $row_edit["mobile"];?>"></td>
							</tr>
							
							<tr>
							<td align="right">Address
							</td>
							<td ><input type="text" name="address" value="<?php echo $row_edit["address"];?>"></td>
							</tr>
							<tr>
							<td align="right">City
							</td>
							<td ><input type="text" name="city" value="<?php echo $row_edit["city"];?>"></td>
							</tr>
							<tr>
							<td align="right">State
							</td>
							<td ><select name="state" id="state" class="input_field" >
							<?php
							foreach($tr_state as $tr)
								{
									if($tr == $row_edit["state"] )
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
								<td align="right">Updates</td>
								<td>
									<?php select_fields('updates',$row_edit["updates"]) ?>
								</td>
							</tr>
							<tr>
								<td align="right">Query</td>
								<td>
									<?php select_fields('query_table',$row_edit["query_table"]) ?>
								</td>
							</tr>
							
							<tr>
								<td align="right">Structure</td>
								<td>
									<?php select_fields('structure',$row_edit["structure"]) ?>
								</td>
							</tr>
							<tr>
								<td align="right">Add City</td>
								<td>
									<?php select_fields('add_city',$row_edit["add_city"]) ?>
								</td>
							</tr>
								<tr>
								<td align="right">Add Center</td>
								<td>
									<?php select_fields('add_center',$row_edit["add_center"]) ?>
								</td>
							</tr>


							<?php 
							if($row_edit["pic"]){
							echo '<tr><td align="center" colspan="2"><img src="images/tn_'.$row_edit["pic"].'">
							</td></tr>';} ?>
							<tr>
							<td align="right">Upload Pic
							</td>
							<td ><input type="file" name="file"></td>
							</tr>
							
							</table>
									<div align="center">
						<input type="SUBMIT" Value="<?php
						
						if(!$_GET["id"])
						{
						echo "SUBMIT";
						}
						else
						{
						echo "SAVE";
						}
						?>">
						</div>
					</form>
									</div>
								  </td>



								<td align="left" valign="top" width="60%">

								</td>
						</table>
						
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
						<?php
						if($priv=='admin')
						{
						?>
						<td>Status</td><td>Delete</td>
						<?php } ?>
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
						  echo '<td width="150" align="left">'.$row["name"].'</td><td align="center">'.$row["username"].'</td><td align="center">'.$row["priv"].'</td><td align="center">'.$row["train_city"].'</td><td align="center">'.$row["center"].'</td><td><a href="?type=member&amp;id='.$row["id"].'"><img src="edit.png"></a></td>';
						  if($priv=='admin')
						  {
						  echo'
						  <td><a href= "manage/process_member.php?type=5&amp;id='.$row["id"].'">';
						  if($row["active"] == 0)
						  {
						    echo '<img src="status_ok.png">';
						  }
						  else
						  {
						  echo '<img src="status_block.png">';
						  }
						  echo '</a></td><td align="center"><a href= "manage/process_member.php?type=6&amp;id='.$row["id"].'"  onclick="return confirm(\'Do You Really Want to Delete '.$row["name"].'\');"><img src="erase.png"></a></td>';
						  }
						  
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
		?>

						