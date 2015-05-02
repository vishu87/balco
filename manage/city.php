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
									
									<form action="manage/process_place.php?type=1" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
									
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Add City
								</td>
								
							</tr>
							<tr>
							<td width="40%" align="right">New City
							</td>
							<td><input type="text" name="city" value="" ></td>
							</tr>
							</table>
							<div align="center">
						<input type="SUBMIT" Value="SUBMIT">
						</div>
								</form>	
								<span style="color:#f00;">
								<?php
								if($_GET["err"] ==1)
								{
									echo "City with this name already present.";
								}
								
								?>
								
								</span>
									</div>
								  </td>
								<td align="left" valign="top" width="50%">
										 <?php 
											//$sql_city="SELECT * from city ORDER BY city_name ASC ";
											
											
										 ?>
								  
								</td>
							</tr>
							
						</table>
						Available Cities:
						<?php
						
								$qry="SELECT * FROM city";
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
						<tr class="top_m color1"><td width="150">City Name</td><td>Edit</td><td>Delete</td></tr>
						<?php
						while($row = mysql_fetch_array($result))
						{
						  if($_GET["id"] == $row["id"])
						  {
						  echo '<form action="manage/process_place.php?type=2&amp;id='.$row["id"].'" method="post"><tr><td><input type="text" name="city_name_edit" value="'.$row["city_name"].'"></td><td><input type="submit" value="GO"></td><td align="center"><a href= "manage/process_place.php?type=6&amp;id='.$row["id"].'"   onclick="return confirm(\'Do You Really Want to Delete '.$row["city_name"].'\');"><img src="erase.png"></a></td></form></tr>';
						  
						  }
						  else{
						  echo '<tr><td>'.$row["city_name"].'</td><td><a href="?type=city&amp;id='.$row["id"].'"><img src="edit.png"> </a></td><td align="center"><a href= "manage/process_place.php?type=6&amp;id='.$row["id"].'"  onclick="return confirm(\'Do You Really Want to Delete '.$row["city_name"].'\');"><img src="erase.png"></a></td></tr>';
						  
						  }
						}
						?>
						</table></div>
						</div>