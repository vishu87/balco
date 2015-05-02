<?php
//$tr_city = array('Sikkim','New Delhi', 'Guwahati');
$month = base64_decode($_GET["month"]);
$year = base64_decode($_GET["year"]);

if($priv == 'admin')
	{
		$city = $_GET["train_city"];
	}
else
{
	$city = base64_decode($_GET["train_city"]);
}
$center = $_GET["train_center"];
if($priv == 'centercord')
{
	$sql_priv="SELECT * from members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
	$result_priv=mysql_query($sql_priv);
	$row_priv = mysql_fetch_array($result_priv);
	$city = $row_priv["train_city"];
	$center = $row_priv["center"];
}
//echo $month;
?>
<?php
if($_GET["id"])
{
$sql_top="SELECT * from students WHERE id='$_GET[id]'";
$sql_top =$sql_top." ORDER BY id DESC";
$result_top=mysql_query($sql_top);
$row_top = mysql_fetch_array($result_top);
	}								
?>
<?php
$tr_city = array('Sikkim','New Delhi', 'Guwahati');


?>
<table width="100%" cellspacing="0" cellpadding="0">
						<tr class="color2">
							<td >
							<form action="?" method="get"><table cellspacing="0" cellpadding="0" width="100%">
									<tr>
											<td align="right" width="50%">Select Month</td>
											<td><select name="month">
							<?php
							for($i=1; $i<13;$i++)
							{
								if($i<10)
								{
								echo '<option value="'.base64_encode($i).'"';
								if($i == (int)$month) echo " selected";
								
								echo '>0'.$i.'</option>';
								}
								else
								{
								echo '<option value="'.base64_encode($i).'"';
								if($i == $month) echo " selected";
								echo '>'.$i.'</option>';
								}
							}
							?>
							</select></td>
									</tr>
									<tr>
											<td align="right">Select Year</td>
											<td><select name="year"><?php
							for($i=2011; $i<=2020;$i++)
							{
								echo '<option value="'.base64_encode($i).'"';
								if($i == $year) echo " selected";
								
								echo '>'.$i.'</option>';
							}
							?></select></td>
									</tr>
									<tr>
											<td align="right">City</td><td>
											
									<?php
				
								if($priv == 'admin')
								{
									echo '<select name="train_city" id="ctlcity">
									<option>Select</option>';
									$sql_case="SELECT * from city ";
									
									$sql_case = $sql_case.'ORDER BY city_name ASC';
									$result_case=mysql_query($sql_case);
									$count_city =1;
									while($row = mysql_fetch_array($result_case))
									{
										echo '<option value="'.$row["city_name"].'" ';
										if($row["city_name"] == $city) {echo 'selected';}
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
									
									
									echo '<input name="train_city" type="hidden" id="ctlcity" value="'.base64_encode($city).'">';
									
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
								echo '<select name="train_center" id="ctlcenter"><option>Select	</option>';
								if($city)
								{
									$sql_center="SELECT * from center WHERE city_name='$city'";
									$result_center=mysql_query($sql_center);
									while($row_center= mysql_fetch_array($result_center))
									{
										echo '<option ';
										if($row_center["center_name"] == $center)
										{echo 'selected';}
										echo '>'.$row_center["center_name"].'</option>';
									}
								}
								
								echo '</select>';
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
																			
											echo $center;
										
									}
									else
									{
										
										echo '<select name="train_center" id="ct1center"><option>Select	</option>';
									$sql_center="SELECT * from coach_groups WHERE city_name='$city' ORDER BY center_name ASC";
									$result_center=mysql_query($sql_center);
									$old_var="";
									while($row_center= mysql_fetch_array($result_center))
									{
										if($row_center["center_name"] == $old_var)
										{
										
										}
										else
										{
										$old_var = $row_center["center_name"]; 
										echo '<option ';
										if($row_center["center_name"] == $center)
										{echo ' selected';}
										echo '>'.$row_center["center_name"].'</option>';
										}
									}
									echo '</select>';
									}
							
								}	
							
							
							
							}
							?>
							
							
							</td>
							</tr>
								
								</table>
								<div align="center">
						<input type="SUBMIT" Value="GO" class="color3" style="border:0px; margin:10px;">
						</div>
							</form>
							</td>
						</tr>
					
					
					
						<tr class="color1">
							<td >
							<form action="?" method="get"><table cellspacing="0" cellpadding="0" width="100%">
							<input type="hidden" name="type" value="att"/>
									<tr>
											<td align="right" width="50%">Select Month</td>
											<td><select name="month">
							<?php
							for($i=1; $i<13;$i++)
							{
								if($i<10)
								{
								echo '<option value="'.base64_encode($i).'"';
								if($i == (int)$month) echo " selected";
								
								echo '>0'.$i.'</option>';
								}
								else
								{
								echo '<option value="'.base64_encode($i).'"';
								if($i == $month) echo " selected";
								echo '>'.$i.'</option>';
								}
							}
							?>
							</select></td>
									</tr>
									<tr>
											<td align="right">Select Year</td>
											<td><select name="year"><?php
							for($i=2011; $i<=2012;$i++)
							{
								echo '<option value="'.base64_encode($i).'"';
								if($i == $year) echo " selected";
								
								echo '>'.$i.'</option>';
							}
							?></select></td>
									</tr>
									<tr>
							<td align="right">Coach Name</td><td>
											
									<?php
				
								if($priv == 'admin')
								{
									echo '<select name="coach_id" >
									<option>Select</option>';
									$sql_case="SELECT id,name from members where priv='coach' ";
									
									$sql_case = $sql_case.'ORDER BY name ASC';
									$result_case=mysql_query($sql_case);
									while($row = mysql_fetch_array($result_case))
									{
										echo '<option value="'.$row["id"].'" ';
										if($row["id"] == $_GET["coach_id"]) {echo 'selected';}
										echo '>'.$row["name"].'</option>';
									}
									echo'</select>';
								}
								else
								{
									
											$sql_city="SELECT * from members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
											$result_city=mysql_query($sql_city);
											$row_city = mysql_fetch_array($result_city);
											$city = $row_city["train_city"];
											
									echo '<select name="coach_id" >
									<option>Select</option>';
									$sql_case="SELECT id,name from members where priv='coach' AND train_city = '$city' ";
									
									$sql_case = $sql_case.'ORDER BY name ASC';
									$result_case=mysql_query($sql_case);
									while($row = mysql_fetch_array($result_case))
									{
										echo '<option value="'.$row["id"].'" ';
										if($row["id"] == $_GET["coach_id"]) {echo 'selected';}
										echo '>'.$row["name"].'</option>';
									}
									echo'</select>';
								}
								
								
								
							?>
							</td>
							
									</tr>
							</table>
								<div align="center">
						<input type="SUBMIT" Value="GO" class="color3" style="border:0px; margin:10px;">
						</div>
							</form>
							</td>
						</tr>
						
						
						</table>