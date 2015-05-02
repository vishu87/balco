<script type="text/javascript">

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
   if (validate_required(group,"Please fill group!")==false)
  {group.focus();return false;}
  }
}
</script>																													<div class="top_m color1">City Information</a></div>
						<div style="margin:10px;">
						<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr>
								<td align="left" valign="top" width="50%">
									<div id="gen_form">
									
									<form action="manage/process_group.php?type=1" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
									
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Add Center
								</td>
								
							</tr>
							
							<tr>
							<td width="40%" align="right">Select City
							</td>
							<td>
							<?php
							if($priv == 'admin')
							{
							echo '
							<select id="ctlcity" name="city">
							<option value="0">Select City</option>';
							
							
							
								$sql_case="SELECT * from city ORDER BY city_name ASC";
								$result_case=mysql_query($sql_case);
								$count_city =1;
								while($row = mysql_fetch_array($result_case))
								{
									echo '<option value="'.$row["city_name"].'">'.$row["city_name"].'</option>';
									$count_city++;
								}
								echo '</select>';
							}
							else
							{	
								echo '<input type="hidden" name="city" value="'.$city.'">';
								echo $city;
							}
							?>
		
		
							
							
							</td>
							</tr>
							<tr>
							<td width="40%" align="right">Select Center
							</td>
							<td>
							<?php
							if($priv == 'admin')
							{
							echo '<select id="ctlcenter" name="center">

			
							</select>';
							
							}
							if($priv == 'citycord')
							{
							echo '<select id="ctlcenter" name="center">';
							$sql_center="SELECT * from center WHERE city_name='$city'";
									$result_center=mysql_query($sql_center);
									while($row_center= mysql_fetch_array($result_center))
									{
										echo '<option value="'.$row_center["center_name"].'" ';
										if($row_center["center_name"] == $_GET["stu_center"]){ echo 'selected';}
										echo'>'.$row_center["center_name"].'</option>';
									}
			
							echo '</select>';
							
							}
							if($priv == 'centercord')
							{
							echo '<input type="hidden" name="center" value="'.$center.'">';
							echo $center;
							
							}
							?>
							</td>
							</tr>									
							<tr>
							<td width="40%" align="right" >New Group
							</td>
							<td><input type="text" name="group"></td>
							</tr>
							<tr>
							<?php
							if($_GET["err"]== '1')
							echo '
							<td width="40%" align="right">
							</td>
							<td style="color:#f00;">Group With Same Name Exists in this Center</td>
							</tr>';
							?>
							<tr>
							</table>
							
							
							<div align="center">
						<input type="SUBMIT" Value="SUBMIT">
						</div>
								</form>	
									</div>
								  </td>
								<td align="left" valign="top" width="50%">
										 <?php 
											//$sql_city="SELECT * from city ORDER BY city_name ASC ";
											
											
										 ?>
								  
								</td>
							</tr>
							
						</table>
					

Available Groups:
						<?php
						
								$qry="SELECT * FROM groups ";
								if($priv != 'admin'){
								
								
								$qry = $qry." WHERE city_name='$city' ";
								
								if($priv == 'centercord')
								{
								$qry = $qry." AND center_name='$center' ";
								}
								
								}
								$qry = $qry."ORDER BY city_name ASC";
								$result=mysql_query($qry);
								//$row_num_qry = mysql_num_rows($result);
								?>
								<span style="color:#f00;">
								<?php
								if($_GET["err"] == 2)
								{
									echo "<br><br>Can't Change! This group name is already present in this center.";
								}
								?>
								</span>
								<?php
								echo '<table cellspacing="10" cellpadding="0">';
						while($row = mysql_fetch_array($result))
						{
						
						if($_GET["id"] == $row["id"])
						  {
						  echo '<form action="manage/process_group.php?type=2&amp;id='.$row["id"].'" method="post"><tr><td><input type="text" name="group_name_edit" value="'.$row["group_name"].'"></td><td><input type="hidden" name="center_name_edit" value="'.$row["center_name"].'">'.$row["center_name"].'</td><td><input type="hidden" name="city_name_edit" value="'.$row["city_name"].'">'.$row["city_name"].'</td><td><input type="submit" value="GO"></td></form></tr>';
						  
						  }
						  
						
						else{
						
						  echo '<tr><td width="150" align="right">'.$row["group_name"].'</td><td >'.$row["center_name"].'</td><td>'.$row["city_name"].'</td><td><a href="?type=group&amp;id='.$row["id"].'"><img src="edit.png"></a></td></tr>';
						  }
						}
						echo '</table>'; ?>


						
						
						</div>