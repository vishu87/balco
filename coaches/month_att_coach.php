<div class="top_m color1">
						Monthly Attendance
						</div><br>
						
						
						<?php
							
								$sql_mem="SELECT id,name from members WHERE id='$_GET[coach_id]'";
								$result_mem=mysql_query($sql_mem);
								$row_mem = mysql_fetch_array($result_mem);
					
							
						?>
						
						<?php
						echo '<span style="padding:10px; font-size:16px; color:#0E3DCA;">'.$row_mem["name"].'</span><br>';
						
						?>
					
						<div style="margin:3px 5px 5px 5px;padding:5px; border:2px solid #bbb;">
						Monthly Attendance: <?php echo $month.', '.$year;?>
						<div id="atten" align="center">
						
<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
	<?php
	$gt_class=0;
	$gt_p =0;
	echo '<tr class="color3">';
							for($i=0;$i<=31;$i++)
							{
								if( $i== 0) echo '<td>Center</td><td width="120">Group</td>';
								else echo '<td width="20" id="dt_'.$i.'">'.$i.'</td>';
							}
							echo '<td width="20">P</td>';
							echo '<td width="20">TL</td>';
							echo '</tr>';
	$sql_sel_center = "SELECT distinct center_name from coach_attendance WHERE student_id='$_GET[coach_id]' AND  (month='$month' AND year='$year') order by center_name asc ";
	
	$result_sel_center=mysql_query($sql_sel_center);
	
	while($row_sel_center = mysql_fetch_array($result_sel_center))
		{
		
			$sql_sel_group = "SELECT distinct group_name from coach_attendance WHERE (student_id='$_GET[coach_id]' AND center_name='$row_sel_center[center_name]') AND  (month='$month' AND year='$year') order by center_name asc ";
	
				$result_sel_group=mysql_query($sql_sel_group);
				
				while($row_sel_group = mysql_fetch_array($result_sel_group))
					{
						$sql_st_at="SELECT date from coach_attendance WHERE student_id='$_GET[coach_id]'  AND (center_name='$row_sel_center[center_name]' AND group_name='$row_sel_group[group_name]') AND (month='$month' AND year='$year') AND attendance='P' ";
								$sql_st_at=$sql_st_at." ORDER BY id ASC";
								$result_st_at=mysql_query($sql_st_at);
								$st_at = array();
								while($row_st_at = mysql_fetch_array($result_st_at))
								{
									array_push($st_at,"$row_st_at[date]");
								}
								
								$sql_st_at="SELECT date from coach_attendance WHERE student_id='$_GET[coach_id]'  AND (center_name='$row_sel_center[center_name]' AND group_name='$row_sel_group[group_name]') AND (month='$month' AND year='$year') AND attendance='A' ";
								$sql_st_at=$sql_st_at." ORDER BY id ASC";
								$result_st_at=mysql_query($sql_st_at);
								$st_at_abs = array();
								$tot_att= 0;
								$tot_class = 0;
								while($row_st_at = mysql_fetch_array($result_st_at))
								{
									array_push($st_at_abs,"$row_st_at[date]");
								}
								
								
								
								for($i=0;$i<=31;$i++)
								{
								if( $i== 0) {
								
								echo '<td>'.$row_sel_center["center_name"].'</td>';
								echo '<td>'.$row_sel_group["group_name"].'</td>';
								}
								else {
								
								
								echo '<td width="20" ><input type="text" name="st'.$count.'_';
															
								echo '" id = "st'.$count.'_'.$i.'" style="width:18px; border:none; text-align:center; cursor:pointer;" value="';
									if (in_array($i, $st_at))
									{
										echo '1" class="present'; $tot_att++;$tot_class++;
									}
									else
									{
										if(in_array($i, $st_at_abs))
										{
											echo '0" class="absent';
											$tot_class++;
										}
										else
										echo '" class="color2';
									}
										echo '" readonly></td>';
								
								
								
								
								
								}
								}
								$gt_class= $gt_class + $tot_class;
								$gt_p= $gt_p + $tot_att;
								echo '<td class="color3">'.$tot_att.'</td>';
								echo '<td class="color3">';
								
									echo $tot_class;
								
								
								
								echo '</td>';
								echo '</tr>';
								
								
								
					}
		}
		
							
							
							
							
							?>
							
						</table>
						<br>
						<br>
						<span class="color2" style="padding:5px 10px;">Total Attendace <?php echo $gt_p;?> Out of <?php echo $gt_class;?></span>
						<br><br>
						</div>
						</div>
						