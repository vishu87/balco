<?php

	$sql_priv="SELECT * from members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
											$result_priv=mysql_query($sql_priv);
											$row_priv = mysql_fetch_array($result_priv);
											$city = $row_priv["train_city"];
											$center = $row_priv["center"];
$space_str1 = '&nbsp;&nbsp;&nbsp;<img src="bullet1.jpg" />&nbsp;';
$space_str2 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$space_str3 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
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
<table width="100%" cellspacing="0" cellpadding="0">
						
						<?php
						if($priv != 'coach'	)
						{
						?>
						<tr>
							<td class="<?php 
							if(!$_GET["type"])
							echo "color1";
							?>"><a href="students.php">Add New Student</a></td>
						</tr>
						<tr><td><br><br></td></tr>
						<?php
						}
						?>
						
						<?php 
							echo '<tr class="';
							if($_GET["type"] == 'browse' ||$_GET["type"] == 'edit')
							{
							echo 'color1';
							}
							echo '"><td><a href="students.php?type=browse">Browse All Students</a></td></tr>';
							
							if($priv == 'admin')
							{
							$sql_case="SELECT * from city ";
							$sql_case = $sql_case.'ORDER BY city_name ASC';
									$result_case=mysql_query($sql_case);
									$count_city =1;
									while($row = mysql_fetch_array($result_case))
									{
										echo '<tr class="';
							if($row["city_name"] == $_GET["city"])
							{
							echo 'color_c';
							}
							echo '"><td>'.$space_str1.'<a href="?type=browse&amp;city='.$row["city_name"].'">'.$row["city_name"].'</a></td></tr>';
										if($row["city_name"] == $_GET["city"])
										{
											$sql_center="SELECT * from center WHERE city_name='$_GET[city]'";
											$result_center=mysql_query($sql_center);
											while($row_center= mysql_fetch_array($result_center))
											{
											echo '<tr class="';
							if($row_center["center_name"] == $_GET["center"])
							{
							echo 'color_ce';
							}
							echo '"><td>'.$space_str2.'<a href="?type=browse&amp;city='.$_GET["city"].'&amp;center='.$row_center["center_name"].'">'.$row_center["center_name"].'</a></td></tr>';
												
											if($row_center["center_name"] == $_GET["center"])
											{
												//echo 'yes';
												$sql_groups="SELECT * from groups WHERE city_name='$_GET[city]' AND center_name='$_GET[center]'";
												$sql_groups =$sql_groups." ORDER BY group_name ASC";
												$result_groups=mysql_query($sql_groups);
												$count_groups =0;
												while($row_groups = mysql_fetch_array($result_groups))
												{
													echo '<tr class="';
							if($row_groups["group_name"] == $_GET["group"])
							{
							echo 'color_g';
							}
							echo '"><td>'.$space_str3.'<a href="?type=browse&amp;city='.$_GET["city"].'&amp;center='.$row_center["center_name"].'&amp;group='.$row_groups["group_name"].'">'.$row_groups["group_name"].'</a></td></tr>';
												
												}
												
											}
										
										}
										}
										$count_city++;
									}
							
							}
							
							if($priv == 'citycord')
							{
							
								$sql_center="SELECT * from center WHERE city_name='$city'";
								$result_center=mysql_query($sql_center);
								while($row_center= mysql_fetch_array($result_center))
								{
											echo '<tr class="';
							if($row_center["center_name"] == $_GET["center"])
							{
							echo 'color_ce';
							}
							echo '"><td>'.$space_str2.'<a href="?type=browse&amp;center='.$row_center["center_name"].'">'.$row_center["center_name"].'</a></td></tr>';
												
											if($row_center["center_name"] == $_GET["center"])
											{
												//echo 'yes';
												$sql_groups="SELECT * from groups WHERE city_name='$city' AND center_name='$_GET[center]'";
												$sql_groups =$sql_groups." ORDER BY group_name ASC";
												$result_groups=mysql_query($sql_groups);
												$count_groups =0;
												while($row_groups = mysql_fetch_array($result_groups))
												{
													echo '<tr class="';
							if($row_groups["group_name"] == $_GET["group"])
							{
							echo 'color_g';
							}
							echo '"><td>'.$space_str3.'<a href="?type=browse&amp;center='.$row_center["center_name"].'&amp;group='.$row_groups["group_name"].'">'.$row_groups["group_name"].'</a></td></tr>';
												
												}
												
											}
										
										}
							}
							
							
							if($priv == 'centercord')
							{
							
											
												//echo 'yes';
												$sql_groups="SELECT * from groups WHERE city_name='$city' AND center_name='$center'";
												$sql_groups =$sql_groups." ORDER BY group_name ASC";
												$result_groups=mysql_query($sql_groups);
												$count_groups =0;
												while($row_groups = mysql_fetch_array($result_groups))
												{
													echo '<tr class="';
							if($row_groups["group_name"] == $_GET["group"])
							{
							echo 'color_g';
							}
							echo '"><td>'.$space_str2.'<a href="?type=browse&amp;center='.$center.'&amp;group='.$row_groups["group_name"].'">'.$row_groups["group_name"].'</a></td></tr>';
												
												}
												
											
							}
							
							if($priv == 'coach')
									{	
										$qry="SELECT * FROM members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
										$result=mysql_query($qry);
										$row_qry = mysql_fetch_array($result);
										$id_coach = $row_qry["id"];
										
										$sql_coach_centers ="SELECT DISTINCT center_name from coach_groups WHERE coach_id='$id_coach'";
										$result_coach_center=mysql_query($sql_coach_centers);
										
										while($row_center = mysql_fetch_array($result_coach_center))
										{
											echo '<tr class="';
							if($row_center["center_name"] == $_GET["center"])
							{
							echo 'color_ce';
							}
							echo '"><td>'.$space_str2.'<a href="?type=browse&amp;center='.$row_center["center_name"].'">'.$row_center["center_name"].'</a></td></tr>';
											if($row_center["center_name"] == $_GET["center"])
											{
												//echo 'yes';
												$sql_groups="SELECT * from coach_groups WHERE city_name='$city' AND ( center_name='$_GET[center]' AND coach_id='$id_coach')";
												$sql_groups =$sql_groups." ORDER BY group_name ASC";
												$result_groups=mysql_query($sql_groups);
												$count_groups =0;
												while($row_groups = mysql_fetch_array($result_groups))
												{
													echo '<tr class="';
							if($row_groups["group_name"] == $_GET["group"])
							{
							echo 'color_g';
							}
							echo '"><td>'.$space_str3.'<a href="?type=browse&amp;center='.$row_center["center_name"].'&amp;group='.$row_groups["group_name"].'">'.$row_groups["group_name"].'</a></td></tr>';
												
												}
												
											}
										}
										
										
									
									}
							
									
							?>
							<tr><td><br><br></td></tr>
							<tr><td></td></tr>
						
						<?php 
							echo '<tr class="';
							if($_GET["type"] == 'in_stu')
							{
							echo 'color1';
							}
							echo '"><td><a href="students.php?type=in_stu">Inactive Students</a>';
							
						
							?>
							
						</td></tr>
						<?php 	
						if($priv != 'coach')
							{
							echo '<tr class="';
							if($_GET["type"] == 'pay_due')
							{
							echo 'color1';
							}
							echo '"><td><a href="students.php?type=pay_due">Payment Notifications</a></td></tr>';
							}
						
							?>
							
						
						
					
						
						</table>