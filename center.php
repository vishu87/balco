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
   if (validate_required(city,"Please fill city!")==false)
  {city.focus();return false;}
  }
}
</script>																													<div class="top_m color1">City Information</a></div>
						<div style="margin:10px;">
						<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr>
								<td align="left" valign="top" width="50%">
									<div id="gen_form">
									
									<form action="manage/process_center.php?type=1" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
									
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Add Center
								</td>
								
							</tr>
							<tr>
							<td width="40%" align="right">New Center
							</td>
							<td><input type="text" name="center" value="" ></td>
							</tr>
							<tr>
							<?php
							if($_GET["err"]== '1')
							echo '
							<td width="40%" align="right">
							</td>
							<td style="color:#f00;">Center With Same Name Exists in this City</td>
							</tr>';
							?>
							<tr>
							<td width="40%" align="right">Select City
							</td>
							<td>
							<?php
							
							if($priv == 'admin')
							{
								echo '<select name="city" >';
								$sql_case="SELECT * from city ORDER BY city_name ASC";
								$result_case=mysql_query($sql_case);
								while($row = mysql_fetch_array($result_case))
								{
									echo '<option>'.$row["city_name"].'</option>';
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
						Available Centers:
						<?php
						
								$qry="SELECT * FROM center ";
								if($priv != 'admin'){
								$qry = $qry." WHERE city_name='$city' ";}
								$qry = $qry."ORDER BY city_name ASC";
								$result=mysql_query($qry);
								//$row_num_qry = mysql_num_rows($result);
								?>	
								<span style="color:#f00;">
								<?php
								if($_GET["err"] == 2)
								{
									echo "<br><br>Can't Change! This name is already present.";
								}
								?>
								</span>
								<?php
								
								echo '<table cellspacing="10" cellpadding="10">';
						while($row = mysql_fetch_array($result))
						{
						if($_GET["id"] == $row["id"])
						  {
						  echo '<form action="manage/process_center.php?type=2&amp;id='.$row["id"].'" method="post"><tr><td><input type="text" name="center_name_edit" value="'.$row["center_name"].'"></td><td><input type="hidden" name="city_name_edit" value="'.$row["city_name"].'">'.$row["city_name"].'</td><td><input type="submit" value="GO"></td></form></tr>';
						  
						  }
						  else{
						  echo '<tr><td width="150" align="right">'.$row["center_name"].'</td><td>'.$row["city_name"].'</td><td><a href="?type=center&amp;id='.$row["id"].'"><img src="edit.png"> </a></td></tr>';}
						}
						echo '</table>'; ?>
						</div>