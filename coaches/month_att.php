<script language='JavaScript'>
      checked = false;
      function checkedAll (dt,tot) {
	 if (document.getElementById('cl'+dt).value == ''){checked = true; val = 1;}else{checked = false; val ='';}
	for (var i = 1; i <= tot; i++) {
	document.getElementById('cl'+dt).value = val;
	  document.getElementById('st'+i+'_'+dt).value = val;
	}
      }
	  
	  function toggle_cl (dt) {
	 if (document.getElementById('cl'+dt).value == 1){
	 
	document.getElementById('cl'+dt).value = '';
	 document.getElementById('chk'+dt).checked= false;
	 }
	 else{
	 document.getElementById('cl'+dt).value = 1;
	 document.getElementById('chk'+dt).checked= true;
	 }
	
      }
	  
	  
	  function toggle (count,dt) {
	 if (document.getElementById('st'+count+'_'+dt).value == 1){
	 
	document.getElementById('st'+count+'_'+dt).value = 0;
	 
	 }
	 else{
	 document.getElementById('st'+count+'_'+dt).value = 1;
	 
	 }
	
      }
	  
	   function show_date (dt) {
	
	 document.getElementById('dt_'+dt).style.backgroundColor='#DBDDDE';
	 document.getElementById('dt2_'+dt).style.backgroundColor='#DBDDDE';

      }
	   function hide_date (dt) {
	
	 document.getElementById('dt_'+dt).style.backgroundColor='#5F6888';
	  document.getElementById('dt2_'+dt).style.backgroundColor='#5F6888';

      }
	  
    </script>

						<div class="top_m color1">
						Attendance
						</div><br>
						<?php
						echo '<span style="padding:10px; font-size:16px; color:#0E3DCA;">'.$center.', '.$city.'</span><br>';
						if( ($month && $year) && (city && $center))
						{
						?>
						<br>
						<div style="margin:5px 5px 0px 5px;">
						<?php
							if($priv != 'coach')
							{
								$sql_groups="SELECT * from groups WHERE city_name='$city' AND center_name='$center'";
							}
							else
							{
								$sql_mem="SELECT id from members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
								$result_mem=mysql_query($sql_mem);
								$row_mem = mysql_fetch_array($result_mem);
								
								$sql_groups="SELECT group_name from coach_groups WHERE (city_name='$city' AND center_name='$center') AND coach_id='$row_mem[id]' ";
							}
							$sql_groups =$sql_groups." ORDER BY group_name ASC";
							
							$result_groups=mysql_query($sql_groups);
							$count_groups =0;
							while($row_groups = mysql_fetch_array($result_groups))
							{
								if(!$_GET["group"] && $count_groups == 0)
								{
									
									$group = $row_groups["group_name"];
								}
								else
								{
									if($_GET["group"]){
									$group = $_GET["group"];}
								}
								//echo $group;
								if(	$row_groups["group_name"] == $group)
								{
								
									echo '&nbsp;&nbsp;&nbsp;<span style="padding:3px; border-top:2px solid #bbb;
									border-bottom:2px solid #fff;
									border-left:2px solid #bbb;
									border-right:2px solid #bbb;"><a href="?month='.$_GET["month"].'&amp;year='.$_GET["year"].'&amp;city='.$_GET["train_city"].'&amp;train_center='.$_GET["train_center"].'&amp;group='.$row_groups["group_name"].'">'.$row_groups["group_name"].'</a></span>&nbsp;&nbsp;&nbsp;';
								}
								else
								{
									echo '&nbsp;&nbsp;&nbsp;<span style="padding:3px; background:#bbb; color:#fff; border:2px solid #bbb;"><a href="?month='.$_GET["month"].'&amp;year='.$_GET["year"].'&amp;train_city='.$_GET["train_city"].'&amp;train_center='.$_GET["train_center"].'&amp;group='.$row_groups["group_name"].'">'.$row_groups["group_name"].'</a></span>&nbsp;&nbsp;&nbsp;';
								
								}
								$count_groups++;
							}
						
						?>
						</div>
						<?php
$sql_case="SELECT * from coach_groups WHERE ( city_name='$city' AND center_name='$center') AND group_name='$group' ";
$sql_case =$sql_case." ORDER BY coach_name ASC";
$result_case=mysql_query($sql_case);
$tot_st = mysql_num_rows($result_case);
							
?>
						<div style="margin:3px 5px 5px 5px;padding:5px; border:2px solid #bbb;">
						Monthly Attendance: <?php echo $month.', '.$year;?>
						<div id="atten" align="center">
						<form action="coaches/process_attendance.php?type=1&amp;month=<?php echo $month;?>&amp;year=<?php echo $year;?>&amp;center=<?php echo $center;?>&amp;city=<?php echo $city;?>&amp;group=<?php echo $group;?>" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
						<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<?php
							$sql_dummy="SELECT date from coach_attendance WHERE (student_id='dm' AND city_name='$city') AND (center_name='$center' AND group_name='$group') AND (month='$month' AND year='$year') ";
							$sql_dummy=$sql_dummy." ORDER BY id ASC";
							$result_dummy=mysql_query($sql_dummy);
							$dummy_array = array();
							$tot_class= 0;
							while($row_dummy = mysql_fetch_array($result_dummy))
							{
							 array_push($dummy_array,"$row_dummy[date]");
							 $tot_class++;
							}
							
							echo '<tr class="color2">';
							for($i=0;$i<=31;$i++)
							{
								if( $i== 0) echo '<td></td><td width="120"></td>';
								else 
								{
							if (in_array($i, $dummy_array))
{							
								echo '<td width="20"><input type="checkbox" id="chk'.$i.'" name="checkall" onclick="checkedAll('.$i.','.$tot_st.');" checked="true"></td>';
}
else
{
echo '<td width="20"><input type="checkbox" id="chk'.$i.'" name="checkall" onclick="checkedAll('.$i.','.$tot_st.');" ></td>';
}							
							
							}
							}
							echo '<td width="20">TL</td>';
							echo '<td width="20">%</td>';
							echo '</tr>';
							
							echo '<tr class="color3">';
							for($i=0;$i<=31;$i++)
							{
								if( $i== 0) echo '<td></td><td width="120"></td>';
								else echo '<td width="20" id="dt_'.$i.'">'.$i.'</td>';
							}
							echo '<td width="20">TL</td>';
							echo '<td width="20">%</td>';
							echo '</tr>';
							

							echo '<tr >';
							for($i=0;$i<=31;$i++)
							{
								if( $i== 0) echo '<td>Classes</td><td>Number</td>';
								else {
								
								echo '<td width="20"><input type="text" name="cl';
								if($i<10) echo $i;
								else echo $i;							
								echo '" id="cl'.$i.'" onclick="toggle_cl('.$i.');" style="width:18px; border:none; text-align:center; cursor:pointer;';
									if (in_array($i, $dummy_array))
									{ echo 'font-weight:bold; color:#EEE;" class="color_sel" value="1';}
									else
									{
										echo '" class="color1 ';
									}
								echo '" readonly></td>';
								
								}
							}
							echo '<td class="color3">'.$tot_class.'</td>';
							echo '<td class="color3">NA</td>';
							echo '</tr>';
							$count=1;
							$sql_case="SELECT * from coach_groups WHERE ( city_name='$city' AND center_name='$center') AND group_name='$group' ";
							$sql_case =$sql_case." ORDER BY coach_name ASC";
							//echo $group.$sql_case;
							$result_att=mysql_query($sql_case);

							while($row_att = mysql_fetch_array($result_att))
							{
								
								$sql_st_at="SELECT * from coach_attendance WHERE (student_id='$row_att[coach_id]' AND city_name='$city') AND (center_name='$center' AND group_name='$group') AND (month='$month' AND year='$year') AND attendance='P' ";
								$sql_st_at=$sql_st_at." ORDER BY id ASC";
								$result_st_at=mysql_query($sql_st_at);
								$st_at = array();
								while($row_st_at = mysql_fetch_array($result_st_at))
								{
									array_push($st_at,"$row_st_at[date]");
								}
								
								$sql_st_at="SELECT * from coach_attendance WHERE (student_id='$row_att[coach_id]' AND city_name='$city') AND (center_name='$center' AND group_name='$group') AND (month='$month' AND year='$year') AND attendance='A' ";
								$sql_st_at=$sql_st_at." ORDER BY id ASC";
								$result_st_at=mysql_query($sql_st_at);
								$st_at_abs = array();
								$tot_att= 0;
								while($row_st_at = mysql_fetch_array($result_st_at))
								{
									array_push($st_at_abs,"$row_st_at[date]");
								}
								
								
								//$att = $row_att["attendance"];
								echo '<tr class="color2" id="tr_'.$count.'" onMouseOver="this.style.backgroundColor=\'#DBDDDE\' ; " onMouseOut="this.style.backgroundColor=\'#E3E9FF\';">';
								for($i=0;$i<=31;$i++)
								{
								if( $i== 0) {
								
								echo '<td>'.$row_att["coach_name"].'</td>';
								echo '<td>'.$row_att["mobile"].'</td>';
								}
								else {
								
								if($tag_m == 1)
								{
								$date_daily =strtotime( $month.'/'.$i.'/'.$year);
								if($row_att["end"] < $date_daily)
								{
									echo '<td style="background:#CCC;"></td>';
								}
								else
								{
								echo '<td width="20" onMouseOver="show_date('.$i.');" onMouseOut="hide_date('.$i.');"><input type="text" name="st'.$count.'_';
								if($i<10) echo $i;
								else echo $i;							
								echo '" id = "st'.$count.'_'.$i.'" onclick="toggle('.$count.','.$i.');" style="width:18px; border:none; text-align:center; cursor:pointer;" value="';
									if (in_array($i, $st_at))
									{ echo '1" class="present'; $tot_att++;}
									else
									{
									if(in_array($i, $st_at_abs))
									echo '0" class="absent';
									else
									echo '" class="color2';
									}
								echo '" readonly></td>';
								
								
								}
								}
								else
								{
								echo '<td width="20" onMouseOver="show_date('.$i.');" onMouseOut="hide_date('.$i.');"><input type="text" name="st'.$count.'_';
								if($i<10) echo $i;
								else echo $i;							
								echo '" id = "st'.$count.'_'.$i.'" onclick="toggle('.$count.','.$i.');" style="width:18px; border:none; text-align:center; cursor:pointer;" value="';
									if (in_array($i, $st_at))
									{ echo '1" class="present'; $tot_att++;}
									else
									{
									if(in_array($i, $st_at_abs))
									echo '0" class="absent';
									else
									echo '" class="color2';
									}
								echo '" readonly></td>';
								}
								}
								}
								echo '<td class="color3">'.$tot_att.'</td>';
								echo '<td class="color3">';
								if($tot_class == 0)
								{
									echo '0';
								}
								else
								{
									echo ceil($tot_att/$tot_class*100);
								}
								
								
								echo '</td>';
								echo '</tr>';
								$count++;
							
							}
							echo '<tr class="color3">';
							for($i=0;$i<=31;$i++)
							{
								if( $i== 0) echo '<td></td><td width="120"></td>';
								else echo '<td width="20" id="dt2_'.$i.'">'.$i.'</td>';
							}
							echo '<td width="20">TL</td>';
							echo '<td width="20">%</td>';
							echo '</tr>';
							?>
							
						</table>
						<br>
						<div align="center">
						<input type="SUBMIT" Value="SAVE">
						</div>
						</form>
						</div>
						</div>
						<a href="atten_xl.php?city=<?php echo $city;?>&center=<?php echo $center;?>&group=<?php echo $group;?>&month=<?php echo $month;?>&year=<?php echo $year;?>">Export to excel</a>
						<?php
						}
						else
						{
							echo "Please select parameters from left";
						}
						
						?>
						