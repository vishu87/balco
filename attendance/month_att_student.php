<div class="top_m color1">
						Attendance
</div>
<br>
						
						
						<?php
							
								$sql_mem="SELECT * from students WHERE id='$_GET[id]'";
								$result_mem=mysql_query($sql_mem);
								$row_mem = mysql_fetch_array($result_mem);
					
							
						?>
						
						<?php
						echo '<span style="padding:10px; font-size:16px; color:#0E3DCA;"><a href="students.php?type=browse&id='.$row_mem["id"].'">'.$row_mem["name"].'</a>, '.$row_mem["groupid"].', '.$row_mem["center"].', '.$row_mem["train_city"].'</span><br>';
						echo '<span style="padding:10px; font-size:14px; color:#3f0f33;">Status: ';
						if($row_mem["active"] == 0) echo 'Active';
						else echo 'Inactive';
						echo '</span><br>';
						?>
					
						<div style="margin:3px 5px 5px 5px;padding:5px; border:2px solid #bbb;">
						Student's Attendance:
						<div id="atten" align="center">
						
<table cellspacing="0" cellpadding="0"  style="margin-top:10px;">
	<?php
	$gt_class=0;
	$gt_p =0;
	echo '<tr class="color3">';
							for($i=0;$i<=31;$i++)
							{
								if( $i== 0) echo '<td>Month</td><td >Year</td>';
								else echo '<td width="20" id="dt_'.$i.'">'.$i.'</td>';
							}
							echo '<td width="20">P</td>';
							echo '<td width="20">TL</td>';
							echo '</tr>';
	$sql_sel_year = "SELECT distinct year from attendance WHERE student_id='$_GET[id]' order by year desc";
	
	$result_sel_year=mysql_query($sql_sel_year);
	
	while($row_sel_year = mysql_fetch_array($result_sel_year))
		{
		
			$sql_sel_month = "SELECT distinct month from attendance WHERE (student_id='$_GET[id]' AND year='$row_sel_year[year]') order by month desc ";
	
				$result_sel_month=mysql_query($sql_sel_month);
				
				while($row_sel_month = mysql_fetch_array($result_sel_month))
					{
						$sql_st_at="SELECT date,ds from attendance WHERE student_id='$_GET[id]' AND (month='$row_sel_month[month]' AND year='$row_sel_year[year]') AND attendance='P' ";
								$sql_st_at=$sql_st_at." ORDER BY id ASC";
								$result_st_at=mysql_query($sql_st_at);
								$st_at = array();
								$ds_st_at = array();
								while($row_st_at = mysql_fetch_array($result_st_at))
								{
									array_push($st_at,"$row_st_at[date]");
									if($row_st_at["ds"] == 1) array_push($ds_st_at, "$row_st_at[date]");
								}
								
								$sql_st_at="SELECT date from attendance WHERE student_id='$_GET[id]' AND (month='$row_sel_month[month]' AND year='$row_sel_year[year]') AND attendance='A'";
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
								
								echo '<td>'.$row_sel_month["month"].'</td>';
								echo '<td>'.$row_sel_year["year"].'</td>';
								}
								else {
								
								
								echo '<td width="20" ><input type="text" name="st'.$count.'_';
															
								echo '" id = "st'.$count.'_'.$i.'" style="width:18px; border:none; text-align:center; cursor:pointer;" value="';
									if (in_array($i, $st_at))
									{
										if(in_array($i, $ds_st_at)){
											echo '1" class="ds_present';
										} else {
											echo '1" class="present'; 
										}
										$tot_att++;$tot_class++;
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
						