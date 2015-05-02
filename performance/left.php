<?php
$months_name = array ("Jan-Mar", "Apr-Jun", "Jul-Sep", "Oct-Dec");
$month_val = array("1","4","7","10");
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
	$sql_priv="SELECT train_city,center from members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
	$result_priv=mysql_query($sql_priv);
	$row_priv = mysql_fetch_array($result_priv);
	$city = $row_priv["train_city"];
	$center = $row_priv["center"];
}
//echo $month;
?>

<?php


?>
<table width="100%" cellspacing="0" cellpadding="0">
						<tr class="color2">
							<td >
							<form action="?" method="get"><table cellspacing="0" cellpadding="0" width="100%">
									<tr>
											<td align="right" width="50%">Select Period</td>
											<td><select name="month">
							
							<?php
							
							for($i=1; $i<5;$i++)
							{
								
								
								echo '<option value="'.base64_encode($month_val[$i -1]).'"';
								if($month_val[$i -1] == $month) echo " selected";
								echo '>'.$months_name[$i - 1].'</option>';
								
							}
							?>
							</select></td>
									</tr>
									<tr>
											<td align="right">Select Year</td>
											<td><select name="year"><?php
							for($i=2011; $i<=2015;$i++)
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
										echo ' >'.$row["city_name"].'</option>';
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
										echo '<option ';
										if($row_center["center_name"] == $center)
										{echo 'selected';}
										echo '>'.$row_center["center_name"].'</option>';
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
						
						<?php 
							echo '<tr class="';
							if($_GET["type"] == 'browse' ||$_GET["type"] == 'edit')
							{
							echo 'color1';
							}
							echo '"><td><a href="students.php?type=browse">Browse Students</a>';
							
						
							?>
							
						</td></tr>
						
						
						
						</table>