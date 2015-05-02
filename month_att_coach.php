
<?php
$sql_case="SELECT * from students WHERE train_city='$city' AND center='$center'";
$sql_case =$sql_case." ORDER BY id DESC";
$result_att=mysql_query($sql_case);

?>

						<div class="top_m color1">
						Attendance
						</div>
						<?php
						//echo $month.'<br>'.$year.'<br>'.$city.'<br>'.$center.'<br>';
						if( ($month && $year) && (city && $center))
						{
						?>
						<br>
						<div style="margin:5px 5px 0px 5px;">
						<?php
							
								$sql_mem="SELECT * from members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
								$result_mem=mysql_query($sql_mem);
								$row_mem = mysql_fetch_array($result_mem);

								$sql_groups="SELECT * from coach_groups WHERE city_name='$city' AND center_name='$center' ";
							
							$sql_groups =$sql_groups." ORDER BY coach_id ASC";
							
							$result_groups=mysql_query($sql_groups);
							$count_groups =0;
							while($row_groups = mysql_fetch_array($result_groups))
							{
								if(!$_GET["group"] && $count_groups == 0)
								{
									$group = $row_groups["coach_name"];
								}
								else
								{
									$coach = $_GET["coach"];
								}
								if(	$row_groups["coach_name"] == $coach)
								{
								
									echo '&nbsp;&nbsp;&nbsp;<span style="padding:3px; border-top:2px solid #bbb;
									border-bottom:2px solid #fff;
									border-left:2px solid #bbb;
									border-right:2px solid #bbb;"><a href="?month='.$_GET["month"].'&amp;year='.$_GET["year"].'&amp;city='.$_GET["train_city"].'&amp;train_center='.$_GET["train_center"].'&amp;coach='.$row_groups["group_name"].'">'.$row_groups["group_name"].'</a></span>&nbsp;&nbsp;&nbsp;';
								}
								else
								{
									echo '&nbsp;&nbsp;&nbsp;<span style="padding:3px; background:#bbb; color:#fff; border:2px solid #bbb;"><a href="?month='.$_GET["month"].'&amp;year='.$_GET["year"].'&amp;city='.$_GET["train_city"].'&amp;train_center='.$_GET["train_center"].'&amp;coach='.$row_groups["group_name"].'">'.$row_groups["group_name"].'</a></span>&nbsp;&nbsp;&nbsp;';
								
								}
								$count_groups++;
							}
						
						?>
						</div>
						<div style="margin:3px 5px 5px 5px;padding:5px; border:2px solid #bbb;">
						Monthly Attendance
						<div id="atten" align="center">
						<form action="attendance/process_attendance.php?type=1&amp;month=<?php echo $month;?>&amp;year=<?php echo $year;?>&amp;sql=<?php echo $sql_case;?>&amp;city=<?php echo $city;?>&amp;group=<?php echo $group;?>" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
						<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<?php
							echo '<tr class="color3">';
							for($i=0;$i<=31;$i++)
							{
								if( $i== 0) echo '<td></td>';
								else echo '<td width="20">'.$i.'</td>';
							}
							echo '</tr>';
							$sql_dummy="SELECT * from attendance WHERE student_id='dm_".$city."_".$group."_".$month."_".$year."'";
							$sql_dummy=$sql_dummy." ORDER BY id ASC";
							$result_dummy=mysql_query($sql_dummy);
							$dummy_array = array();
							while($row_dummy = mysql_fetch_array($result_dummy))
							{
							 array_push($dummy_array,"$row_dummy[date]");
							}

							echo '<tr class="color1">';
							for($i=0;$i<=31;$i++)
							{
								if( $i== 0) echo '<td>Classes</td>';
								else {
								
								echo '<td width="20"><input type="text" name="cl';
								if($i<10) echo $i;
								else echo $i;							
								echo '"class="color1" style="width:18px; border:none; text-align:center;" value="';
									if (in_array($i, $dummy_array))
									echo "1";
								echo '"></td>';
								
								}
							}
							echo '</tr>';
							$count=1;
							
							
							while($row_att = mysql_fetch_array($result_att))
							{
								$sql_st_at="SELECT * from attendance WHERE (student_id='$row_att[id]' AND attendance='P') AND (month='$month' AND year='$year')";
								$sql_st_at=$sql_st_at." ORDER BY id ASC";
								$result_st_at=mysql_query($sql_st_at);
								$st_at = array();
								while($row_st_at = mysql_fetch_array($result_st_at))
								{
									array_push($st_at,"$row_st_at[date]");
								}
								
								$sql_st_at="SELECT * from attendance WHERE (student_id='$row_att[id]' AND attendance='A') AND (month='$month' AND year='$year')";
								$sql_st_at=$sql_st_at." ORDER BY id ASC";
								$result_st_at=mysql_query($sql_st_at);
								$st_at_abs = array();
								while($row_st_at = mysql_fetch_array($result_st_at))
								{
									array_push($st_at_abs,"$row_st_at[date]");
								}
								
								
								//$att = $row_att["attendance"];
								echo '<tr class="color2">';
								for($i=0;$i<=31;$i++)
								{
								if( $i== 0) echo '<td>'.$row_att["name"].'</td>';
								else {
								
								echo '<td width="20"><input type="text" name="st'.$count;
								if($i<10) echo $i;
								else echo $i;							
								echo '"class="color2" style="width:18px; border:none; text-align:center;" value="';
									if (in_array($i, $st_at))
									echo "1";
									if(in_array($i, $st_at_abs))
									echo "0";
								echo '"></td>';
								}
								}
								echo '</tr>';
								$count++;
							
							}
							?>
							
						</table>
						<div align="center">
						<input type="SUBMIT" Value="SUBMIT">
						</div>
						</form>
						</div>
						</div>
						<?php
						}
						else
						{
							echo "Please select parameters from left";
						}
						
						?>
						