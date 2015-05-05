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
</script>
<div class="top_m color1">Center Information</a></div>
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

								echo '<select name="city" >';
								$sql_case="SELECT * from city ORDER BY city_name ASC";
								$result_case=mysql_query($sql_case);
								while($row = mysql_fetch_array($result_case))
								{
									echo '<option value="'.$row["id"].'">'.$row["city_name"].'</option>';
								}
								echo '</select>';
								
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
						
								$qry="SELECT center.id, center.center_name, city.city_name, center.city_id FROM center join city on center.city_id = city.id order by city_name ASC ";
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
								<div id="gen_form">
						<table cellspacing="2" >
						<tr class="top_m color1"><td width="150"  align="center">Center Name</td><td width="150"  align="center">City Name</td><td>Edit</td><td>Delete</td></tr>
								<?php
								
								
						while($row = mysql_fetch_array($result))
						{
						if($_GET["id"] == $row["id"])
						  {
						  echo '<form action="manage/process_center.php?type=2&amp;id='.$row["id"].'" method="post"><tr><td><input type="text" name="center_name_edit" value="'.$row["center_name"].'"></td><td align="center">';
						  echo '<select name="city_edit" >';
								$sql_case_city="SELECT * from city ORDER BY city_name ASC";
								$result_case_city=mysql_query($sql_case_city);
								while($row_city = mysql_fetch_array($result_case_city))
								{
									echo '<option value="'.$row_city["id"].'" ';
									echo ($row_city["id"] == $row["city_id"])?'selected':'';
									echo '>'.$row_city["city_name"].'</option>';
								}
						  echo '</select>';
						  echo '<td  align="center"><input type="submit" value="GO"></td></form><td align="center"><a href= "manage/process_center.php?type=6&amp;id='.$row["id"].'"  onclick="return confirm(\'Do You Really Want to Delete '.$row["center_name"].', '.$row["city_name"].'\');"><img src="erase.png"></a></td></tr>';
						  
						  }
						  else{
						  echo '<tr><td width="150" align="center">'.$row["center_name"].'</td><td  align="center">'.$row["city_name"].'</td><td align="center"><a href="?type=center&amp;id='.$row["id"].'"><img src="edit.png"> </a></td><td align="center"><a href= "manage/process_center.php?type=6&amp;id='.$row["id"].'"  onclick="return confirm(\'Do You Really Want to Delete '.$row["center_name"].', '.$row["city_name"].'\');"><img src="erase.png"></a></td></tr>';}
						}
						 ?>
						 </table></div>
						</div>