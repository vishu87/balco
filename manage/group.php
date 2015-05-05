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
</script>																													
<div class="top_m color1">Group Information</a></div>
<div style="margin:10px;">
	<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
		<tr>
			<td align="left" valign="top" width="50%">
				<div id="gen_form">

					<form action="manage/process_group.php?type=1" method="post" onsubmit="return validate_form(this)">

						<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
									Add Group
								</td>
								
							</tr>
							
							<tr>
								<td width="40%" align="right">Select City
								</td>
								<td>
									<?php
										echo '
										<select id="ctlcityid" name="city">
										<option value="0">Select City</option>';

										$sql_case="SELECT * from city ORDER BY city_name ASC";
										$result_case=mysql_query($sql_case);
										$count_city =1;
										while($row = mysql_fetch_array($result_case))
										{
											echo '<option value="'.$row["id"].'">'.$row["city_name"].'</option>';
											$count_city++;
										}
										echo '</select>';
									?>




								</td>
							</tr>
							<tr>
								<td width="40%" align="right">Select Center
								</td>
								<td>
									<?php

										echo '<select id="ctlcenterid" name="center">
										</select>';
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

			$qry="SELECT groups.id, groups.group_name, groups.center_id, center.center_name, city.city_name FROM groups join center on groups.center_id = center.id join city on center.city_id = city.id order by city_name,center_name asc  ";
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
			<div id="gen_form">
				<table cellspacing="2" >
					<tr class="top_m color1"><td width="50"  align="center">Group Name</td><td width="150"  align="center">Center Name</td><td width="150"  align="center">City Name</td><td>Edit</td><td>Delete</td></tr>
					<?php

					while($row = mysql_fetch_array($result))
					{
						
						if($_GET["id"] == $row["id"])
						{
							echo '<form action="manage/process_group.php?type=2&amp;id='.$row["id"].'" method="post"><tr><td align="center"><input type="text" name="group_name_edit" value="'.$row["group_name"].'"></td><td align="center"><input type="hidden" name="center_id" value="'.$row["center_id"].'">'.$row["center_name"].'</td><td align="center"s><input type="hidden" name="city_name_edit" value="'.$row["city_name"].'">'.$row["city_name"].'</td><td><input type="submit" value="GO"></td></form><td align="center"><a href= "manage/process_group.php?type=6&amp;id='.$row["id"].'"  onclick="return confirm(\'Do You Really Want to Delete '.$row["group_name"].', '.$row["center_name"].'\');"><img src="erase.png"></a></td></tr>';

						}

						
						else{

							echo '<tr><td width="150" align="center">'.$row["group_name"].'</td><td align="center">'.$row["center_name"].'</td><td align="center">'.$row["city_name"].'</td><td><a href="?type=group&amp;id='.$row["id"].'"><img src="edit.png"></a></td><td align="center"><a href= "manage/process_group.php?type=6&amp;id='.$row["id"].'"  onclick="return confirm(\'Do You Really Want to Delete '.$row["group_name"].', '.$row["center_name"].'\');"><img src="erase.png"></a></td></tr>';
						}
					}
					?>
				</table></div>



			</div>