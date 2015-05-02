

						<div class="top_m color1">
						Add New Adjustment
						</div>
						<div style="margin:5px;">
						
						<form action="adjustment/process.php" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
						<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr>
								<td align="left" valign="top" width="50%">
									<div id="gen_form">
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Information
								</td>
								
							</tr>
							
							<tr>
											<td align="right">City</td><td>
											
									<?php
				
								if($priv == 'admin')
								{
									echo '<select name="train_city" id="ct2city">
									<option>Select</option>';
									$sql_case="SELECT * from city ";
									
									$sql_case = $sql_case.'ORDER BY city_name ASC';
									$result_case=mysql_query($sql_case);
									$count_city =1;
									while($row = mysql_fetch_array($result_case))
									{
										echo '<option value="'.$row["city_name"].'"';
										
										if($row["city_name"] == $_GET["stu_city"]){ echo "selected";}
										echo '>'.$row["city_name"].'</option>';
										$count_city++;
									}
									echo'</select>';
								}
								else
								{
									
											$sql_city="SELECT * from members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
											$result_city=mysql_query($sql_city);
											$row_city = mysql_fetch_array($result_city);
											$city = $row_city["train_city"];
											
											$sql_case = $sql_case." WHERE city_name ='$city'";
									
									
									echo '<input name="train_city" type="hidden" id="ct1city" value="'.$city.'">';
									
									echo $city;
								}
								
								
								
							?>
							</td>
							
									</tr>
							<tr>
									<td align="right">Traning Center
							</td>
							<td >
							<?php
							
							if($priv == 'admin')
							{
								echo '<select name="train_center" id="ct2center">
								<option>Select	</option>';
								if($_GET["stu_city"])
								{
									$sql_center="SELECT * from center WHERE city_name='$_GET[stu_city]'";
									$result_center=mysql_query($sql_center);
									while($row_center= mysql_fetch_array($result_center))
									{
										echo '<option value="'.$row_center["center_name"].'" ';
										if($row_center["center_name"] == $_GET["stu_center"]){ echo 'selected';}
										echo'>'.$row_center["center_name"].'</option>';
									}
								}
								echo '</select>';
								//echo "yes";
							}
							else
							{
								//echo $priv;
								if($priv == 'citycord')
								{
									//echo "yes";
									echo '<select name="train_center" id="ct1center"><option>Select	</option>';
									$sql_center="SELECT * from center WHERE city_name='$city'";
									$result_center=mysql_query($sql_center);
									while($row_center= mysql_fetch_array($result_center))
									{
										echo '<option>'.$row_center["center_name"].'</option>';
									}
									echo '</select>';
								}
								else
								{
								//echo "yesmm";
									if($priv == 'centercord')
									{
																			
											echo '<input type="hidden" name="train_center" value="'.$center.'">';
											echo $center;
										
									}
									
							
								}	
							
							
							
							}
							?>
							
							
							</td>
							</tr>
							
							<tr>
							<td align="right">Group
							</td>
							<td >
							<?php
							if($priv == 'admin')
							{
								echo '<select name="groupid" id="">
								<option>Select	</option>';
								if($_GET["stu_city"] && $_GET["stu_center"])
								{
									$sql_center="SELECT * from groups WHERE city_name='$_GET[stu_city]' AND center_name='$_GET[stu_center]'";
									$result_center=mysql_query($sql_center);
									while($row_center= mysql_fetch_array($result_center))
									{
										echo '<option>'.$row_center["group_name"].'</option>';
									}
								}
								echo '</select>';
							}
							else
							{
							if($priv != 'centercord')
							{
								echo '<select name="groupid" id="ct1group"><option>Select	</option>';
							}
							else
							{
								echo '<select name="groupid" id="ct1center"><option>Select	</option>';
									$sql_center="SELECT * from groups WHERE city_name='$city' AND center_name='$center'";
									$result_center=mysql_query($sql_center);
									while($row_center= mysql_fetch_array($result_center))
									{
										echo '<option>'.$row_center["group_name"].'</option>';
									}
									echo '</select>';
							}
							}
							
							?>
							
							</td>
							</tr>
							
							
							
							<tr>
							<td width="40%" align="right">Days
							</td>
							<td><input type="text" name="days"></td>
							</tr>
							<tr>
							<td align="right">Month </td>
							<td align="left" colspan="2">
							
							<select name="month">
							<?php
							for($i=1; $i<13;$i++)
							{
								echo '<option>'.$i.'</option>';
							}
							?>
							</select>
							
							</td>
							</tr>
							<tr>
							<td align="right">Remark
							</td>
							<td>
							<input type="text" name="remark">
							</td>
							
							</tr>
							
							
							
							
							
							
						
							
							
							
							
							</table>
									
									</div>
								  </td>
								
							</tr>
							
						</table>
						<div align="center">
						<input type="SUBMIT" name="add" Value="ADJUST">
						
						</div>
						</form>
						</div>
						
						