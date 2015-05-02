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
	  
	  switch (document.getElementById('st'+count+'_'+dt).value)
	  {
			case '':
			document.getElementById('st'+count+'_'+dt).value = 1;
			break;
			case '1':
			document.getElementById('st'+count+'_'+dt).value = 2;
			break;
			case '2':
			document.getElementById('st'+count+'_'+dt).value = 3;
			break;
			case '3':
			document.getElementById('st'+count+'_'+dt).value = 4;
			break;
			case '4':
			document.getElementById('st'+count+'_'+dt).value = 5;
			break;
			case '5':
			document.getElementById('st'+count+'_'+dt).value = 1;
			break;
	  }
			
	
      }
	  
	  function show_date (dt) {
	
	 document.getElementById('dt_'+dt).style.backgroundColor='#DBDDDE';
	 document.getElementById('dt2_'+dt).style.backgroundColor='#DBDDDE';

      }
	   function hide_date (dt) {
	
	 document.getElementById('dt_'+dt).style.backgroundColor='';
	  document.getElementById('dt2_'+dt).style.backgroundColor='';

      }
	  
    </script>
	<script language='JavaScript'>
      checked_inactive = false;
      function checkedInactive() {
        if (checked_inactive == false){checked_inactive = true}else{checked_inactive = false}
	for (var i = 0; i < document.getElementById('students').elements.length; i++) {
	  document.getElementById('students').elements[i].checked = checked_inactive;
	}
      }
    </script>
	
<?php
$arr_cat=array('Technical', 'Technical', 'Technical', 'Technical', 'Technical', 'Technical',
'Tactical', 'Tactical', 'Tactical', 'Tactical', 'Tactical', 'Tactical', 'Tactical', 'Tactical', 'Tactical', 'Tactical', 'Tactical', 'Tactical', 
'Physical', 'Physical','Physical','Physical','Physical','Physical','Physical','Physical',
'Social', 'Social',
'Mental','Mental','Mental','Mental'
);

$arr_class=array('yellow', 'yellow', 'yellow', 'yellow', 'yellow', 'yellow',
'green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 
'red', 'red','red','red','red','red','red','red',
'magenta', 'magenta',
'blue','blue','blue','blue'
);


$arr_prop=array('Ball_Control', 'Dribbling', 'Receiving', 'Tackling', 'Passing', 'Finishing',
'Progression', 'Pressure', 'Supprt_&amp;_Cover', 'Off_The_Ball', 'Delay', 'Defensive_Cover', 'Support', 'Mobility', 'Space', 'Concentration', 'Balance', 'Switch_Play', 
'Flexibility', 'Agility/Balance','Agility','Pace','Endurance','Reaction','Speed','Coordination',
'Behaviour', 'Communication',
'Perseverance','Teamwork','Passion','Fairplay'
);


?>
						<div class="top_m color1">
						Evaluation
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
								$sql_groups="SELECT group_name from groups WHERE city_name='$city' AND center_name='$center'";
							}
							else
							{
								$sql_mem="SELECT id from members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
								$result_mem=mysql_query($sql_mem);
								$row_mem = mysql_fetch_array($result_mem);
								
								$sql_groups="SELECT group_name from coach_groups WHERE (city_name='$city' AND center_name='$center') AND (coach_id='$row_mem[id]' AND active='0')";
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
$sql_case="SELECT id from students WHERE ( train_city='$city' AND center='$center') AND (groupid='$group' AND active='0') ";
$sql_case2="SELECT id from students WHERE ( train_city='$city' AND center='$center') AND (groupid='$group' AND active='1') ";
$result_case2=mysql_query($sql_case2);
$sql_case =$sql_case." ORDER BY name ASC";
$result_case=mysql_query($sql_case);
$tot_st = mysql_num_rows($result_case);
$tot_st = $tot_st + mysql_num_rows($result_case2);

							
?>
						<div style="margin:3px 5px 5px 5px;padding:5px; border:2px solid #bbb;">
						Quarterly Evaluation: <?php 
						
						switch($month)
						{
							case 1:
								echo 'Jan-Mar';
								break;
							
							case 4:
								echo 'Apr-Jun';
								break;
							
							case 7:
								echo 'Jul-Sep';
								break;
							
							case 10:
								echo 'Oct-Dec';
								break;
							
						}
						echo ', '.$year;?>
						<div id="atten" align="center">
						<form action="performance/process.php?type=1&amp;month=<?php echo $month;?>&amp;year=<?php echo $year;?>&amp;center=<?php echo $center;?>&amp;city=<?php echo $city;?>&amp;group=<?php echo $group;?>" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
						<table cellspacing="0" cellpadding="0"  style="margin-top:10px;">
							<?php
							$sql_dummy="SELECT performa from evaluation WHERE (student_id='0' AND city='$city') AND (center='$center' AND group_id='$group') AND (quarter='$month' AND year='$year') ";
							$sql_dummy=$sql_dummy." ORDER BY id ASC";
							$result_dummy=mysql_query($sql_dummy);
							$dummy_array = array();
							$tot_class= 0;
							$row_dummy = mysql_fetch_array($result_dummy);
							$dummy_array = explode(",", $row_dummy["performa"]);
							
							echo '<tr class="color2">';
							for($i=0;$i<=32;$i++)
							{
								if( $i== 0) echo '<td></td><td width="120"></td>';
								else 
								{
							if ($dummy_array[$i-1] > 0)
{							
								echo '<td width="20"><input type="checkbox" id="chk'.$i.'" name="checkall" onclick="checkedAll('.$i.','.$tot_st.');" checked="true"></td>';
}
else
{
echo '<td width="20"><input type="checkbox" id="chk'.$i.'" name="checkall" onclick="checkedAll('.$i.','.$tot_st.');" ></td>';
}							
							
							}
							}
							echo '<td width="20">Comment</td>';
							echo '<td class="color3" width="20">Name</td>';
							echo '<td class="color3" width="20">View</td>';
							echo '<td class="color3" width="20">Sent On</td>';
							echo '</tr>';
							
							echo '<tr>
							<td></td>
							<td></td>
							<td colspan="6" class="yellow">Technical</td>
							<td colspan="12" class="green">Tactical</td>
							<td colspan="8" class="red">Physical</td>
							<td colspan="2" class="magenta">Social</td>
							<td colspan="4" class="blue">Mental</td>
							<td  ></td>
							<td  ></td>
							<td  ></td>
							<td  ></td>
							</tr>';
							echo '<tr class="color3">';
							for($i=0;$i<=32;$i++)
							{
								if( $i== 0) echo '<td></td><td width="120"></td>';
								else echo '<td  class="'.$arr_class[$i - 1].'" valign= "bottom" style="height:120px; line-height:0.3;" id="dt_'.$i.'"><div class="rotat">'.$arr_prop[$i -1].'</div></td>';
							}
							echo '<td class="color3" width="20">C</td>';
							echo '<td class="color3" width="20">Name</td>';
							echo '<td class="color3" width="20"></td>';
							echo '<td class="color3" width="20"></td>';
							echo '</tr>';

							echo '<tr >';
							for($i=0;$i<=32;$i++)
							{
								if( $i== 0) echo '<td></td><td>Param</td>';
								else {
								
								echo '<td width="20"><input type="text" name="cl';
								if($i<10) echo $i;
								else echo $i;							
								echo '" id="cl'.$i.'" onclick="toggle_cl('.$i.');" style="width:18px; border:none; text-align:center; cursor:pointer;';
									if ($dummy_array[$i-1] > 0)
									{ echo 'font-weight:bold; color:#EEE;" class="color_sel" value="1';}
									else
									{
										echo '" class="color1 ';
									}
								echo '" readonly></td>';
								
								}
							}
							echo '<td class="color3">Comments</td>';
							echo '<td class="color3" width="20">Name</td>';
							echo '<td class="color3" width="20">View</td>';
							echo '<td class="color3" width="20">Sent on</td>';
							echo '</tr>';

							$count=1;
							$sql_case="SELECT id,name,dos from students WHERE ( train_city='$city' AND center='$center') AND (groupid='$group' AND active='0') ";
							$sql_case =$sql_case." ORDER BY name ASC";
							$result_att=mysql_query($sql_case);

							while($row_att = mysql_fetch_array($result_att))
							{
								
								$date_mon1 =strtotime( $month.'/1/'.$year);
								//echo date('d-m-Y',$date_mon1);
								$date_mon = strtotime( '+3 month' ,$date_mon1);
								$qry1= "SELECT DISTINCT group_id from  evaluation  WHERE student_id='$row_att[id]' AND (quarter='$month' AND year='$year')";
								//echo $qry1;
								$result_check = mysql_query($qry1);
								//echo $row_att["dos"]."AA".strtotime($date_mon)."BB";
								$row_group_names= mysql_fetch_array($result_check);
								$total_groups = mysql_num_rows($result_check);
								
								
								if($total_groups == 1 && $row_group_names["group_id"] != $group)
								{
								echo '<tr class="color2" id="tr_'.$count.'" onMouseOver="this.style.backgroundColor=\'#DBDDDE\' ; " onMouseOut="this.style.backgroundColor=\'#E3E9FF\';">';
								echo '<td></td><td><a href="students.php?type=browse&id='.$row_att["id"].'" target="_blank" style="text-decoration:underline;">'.$row_att["name"].'</a></td>';
								//echo '<td>'.$row_att["father_mob"].'</td>';
								echo '<td style="background:#EEE;" colspan="31">PERFORMA IN '.$row_group_names["group_id"].'</td>';
								echo '<td style="background:#EEE;"></td><td style="background:#EEE;"></td><td style="background:#CCC;"></td>';
								echo '<td style="background:#EEE;"></td><td style="background:#EEE;"></td><td style="background:#CCC;"></td>';
								echo'</tr>';
								continue;
								}
								
								if($row_att["dos"] > $date_mon)
								{
								
								for($i=0;$i<=32;$i++)
								{
								if( $i== 0) {
								echo '<tr class="color2" id="tr_'.$count.'" onMouseOver="this.style.backgroundColor=\'#DBDDDE\' ; " onMouseOut="this.style.backgroundColor=\'#E3E9FF\';">';
								echo '<td></td><td><a href="students.php?type=browse&id='.$row_att["id"].'" target="_blank" style="text-decoration:underline;">'.$row_att["name"].'</a></td>';
								//echo '<td>'.$row_att["father_mob"].'</td>';
								}
								else {
								
								echo '<td style="background:#EEE;"></td>';
								}
								}
								echo '<td style="background:#EEE;"></td><td style="background:#EEE;"></td>';
								echo '<td style="background:#EEE;"></td><td style="background:#EEE;"></td>';
								echo '</tr>';
								continue;
								
								}
								
							
								$sql_st_at="SELECT performa,comments,sending_date from evaluation WHERE (student_id='$row_att[id]' ) AND (quarter='$month' AND year='$year') AND group_id='$group'  ";
								$sql_st_at=$sql_st_at." ORDER BY id ASC";
								$result_st_at=mysql_query($sql_st_at);
								$row_st_at= mysql_fetch_array($result_st_at);
								//echo $row_st_at["performa"];
								$st_at = explode(",", $row_st_at["performa"]);
								
								
								
								//$att = $row_att["attendance"];
								echo '<tr class="color2" id="tr_'.$count.'" onMouseOver="this.style.backgroundColor=\'#DBDDDE\' ; " onMouseOut="this.style.backgroundColor=\'#E3E9FF\';">';
								for($i=0;$i<=32;$i++)
								{
								if( $i== 0) {
								
								echo '<td><input type="checkbox" name="list[]" value="'.$row_att["id"].'" checked="true"></td><td><a href="students.php?type=browse&id='.$row_att["id"].'" target="_blank" style="text-decoration:underline;">'.$row_att["name"].'</a></td>';
								//echo '<td>'.$row_att["father_mob"].'</td>';
								}
								else {
								
								echo '<td width="20" class="'.$arr_class[$i-1].'" onMouseOver="show_date('.$i.');" onMouseOut="hide_date('.$i.');"><input type="text" class="color2 '.$arr_class[$i-1].'" name="st'.$row_att["id"].'_';
								if($i<10) echo $i;
								else echo $i;							
								echo '" id = "st'.$count.'_'.$i.'" onclick="toggle('.$count.','.$i.');" style="width:18px; border:none; text-align:center; cursor:pointer;" value="';
									echo $st_at[$i-1];
								echo '" readonly></td>';
								}
								}
								echo '<td style="background:#FEF2FF;">
								<textarea name="comment_'.$row_att["id"].'" rows="4" style="width:250px; background:inherit; border:0px;">'.$row_st_at["comments"].'
								</textarea></td>';
								echo '<td>'.$row_att["name"].'</td>';
								echo '<td><a href="fpdf/performance/evaluation.php?id='.base64_encode($row_att["id"]).'&amp;q='.base64_encode($month).'&y='.base64_encode($year).'" target="_blank">V</a></td>';
								
									echo '<td>';
								if($row_st_at["sending_date"]) 
								echo date("d M y", $row_st_at["sending_date"]);
								echo '</td>';
								
								echo '</tr>';
								$count++;
							
							}
							//echo '<tr><td><input type="checkbox" name="list[]" value="'.$row_att["id"].'" checked="false"></td><td colspan="5">check/uncheck inactive</td><td colspan="32">INACTIVE STUDENTS</td></tr>';
							echo '<tr style="background:#FF8787;"><td colspan="38">INACTIVE STUDENTS</td></tr>';
							
							
							//inactive students
							$sql_case="SELECT id,name,dos,doe from students WHERE (train_city='$city' AND center='$center') AND (groupid='$group' AND active='1') ";
							$sql_case =$sql_case." ORDER BY name ASC";
							$result_att=mysql_query($sql_case);

							while($row_att = mysql_fetch_array($result_att))
							{
								
								$date_mon1 =strtotime( $month.'/1/'.$year);
								$date_mon = strtotime( '+3 month' ,$date_mon1);
								
								if($row_att["doe"] > $date_mon1 && $row_att["dos"] < $date_mon)
								{
								
								$sql_st_at="SELECT performa,comments,sending_date from evaluation WHERE (student_id='$row_att[id]' ) AND (quarter='$month' AND year='$year') AND group_id='$group'  ";
								$sql_st_at=$sql_st_at." ORDER BY id ASC";
								$result_st_at=mysql_query($sql_st_at);
								$check_exists = mysql_num_rows($result_st_at);
								$row_st_at= mysql_fetch_array($result_st_at);
								//echo $row_st_at["performa"];
								$st_at = explode(",", $row_st_at["performa"]);
								
								
								
								//$att = $row_att["attendance"];
								echo '<tr class="color2" id="tr_'.$count.'" onMouseOver="this.style.backgroundColor=\'#DBDDDE\' ; " onMouseOut="this.style.backgroundColor=\'#E3E9FF\';">';
								for($i=0;$i<=32;$i++)
								{
								if( $i== 0) {
								
								echo '<td><input type="checkbox" name="list[]" value="'.$row_att["id"].'" ';
								if($check_exists >0)
								echo " checked";
								echo '></td><td><a href="students.php?type=browse&id='.$row_att["id"].'" target="_blank" style="text-decoration:underline;">'.$row_att["name"].'</a></td>';
								//echo '<td>'.$row_att["father_mob"].'</td>';
								}
								else {
								
								echo '<td width="20" class="'.$arr_class[$i-1].'" onMouseOver="show_date('.$i.');" onMouseOut="hide_date('.$i.');"><input type="text" class="color2 '.$arr_class[$i-1].'" name="st'.$row_att["id"].'_';
								if($i<10) echo $i;
								else echo $i;							
								echo '" id = "st'.$count.'_'.$i.'" onclick="toggle('.$count.','.$i.');" style="width:18px; border:none; text-align:center; cursor:pointer;" value="';
									echo $st_at[$i-1];
								echo '" readonly></td>';
								}
								}
								echo '<td style="background:#FEF2FF;"><input type="text" name="comment_'.$row_att["id"].'" value="'.$row_st_at["comments"].'" style="width:250px; background:inherit; border:0px;"></td>';
								echo '<td>'.$row_att["name"].'</td>';
								echo '<td><a href="fpdf/performance/evaluation.php?id='.base64_encode($row_att["id"]).'&amp;q='.base64_encode($month).'&y='.base64_encode($year).'" target="_blank">V</a></td>';
								
									echo '<td>';
								if($row_st_at["sending_date"]) 
								echo date("d M y", $row_st_at["sending_date"]);
								echo '</td>';
								
								echo '</tr>';
								$count++;
								}
								
							
							}
							
							
							
							
							
							///end inactive students
							
							
							
							echo '<tr class="color3">';
							for($i=0;$i<=32;$i++)
							{
								if( $i== 0) echo '<td></td><td width="120"></td>';
								else echo '<td  class="'.$arr_class[$i - 1].'" valign= "bottom" style="height:120px; line-height:0.3;" id="dt2_'.$i.'"><div class="rotat">'.$arr_prop[$i -1].'</div></td>';
							
							}
							echo '<td width="20">C</td>';
							echo '<td width="20">Name</td>';
							echo '<td class="color3" width="20"></td>';
							echo '<td class="color3" width="20"></td>';
							echo '';
							echo '</tr>';
							?>
							
						</table>
						<br>
						<div align="center">
						<input type="SUBMIT" Value="SAVE"><br><br><br>
						<?php
						$sql_ret=mysql_query("SELECT performa from evaluation_ret WHERE city='$city' AND (center='$center' AND group_id='$group') AND (quarter='$month' AND year='$year') ");
						$num_ret = mysql_num_rows($sql_ret);
						
						if($num_ret >0){
						?>
						<a href="performance/process_ret.php?type=1&city=<?php echo $city;?>&center=<?php echo $center;?>&group=<?php echo $group;?>&month=<?php echo $month;?>&year=<?php echo $year;?>" style="margin:10px; padding:10px; color:#333; background:#EEE"> Retrieve Only Data
						</a>
						<a href="performance/process_ret.php?type=2&city=<?php echo $city;?>&center=<?php echo $center;?>&group=<?php echo $group;?>&month=<?php echo $month;?>&year=<?php echo $year;?>" style="margin:10px; padding:10px; color:#333; background:#EEE"> Retrieve Only Comments
						</a>
						<a href="performance/process_ret.php?type=3&city=<?php echo $city;?>&center=<?php echo $center;?>&group=<?php echo $group;?>&month=<?php echo $month;?>&year=<?php echo $year;?>" style="margin:10px; padding:10px; color:#333; background:#EEE"> Retrieve Data and Comments
						</a><br><br>
						
						<?php 
						}
						if(sizeof($dummy_array) > 1)
						{
						?>
						<a href="list_performa_xl.php?city=<?php echo $city;?>&center=<?php echo $center;?>&group=<?php echo $group;?>&month=<?php echo $month;?>&year=<?php echo $year;?>">Export to excel</a>
						<br><br>
						<?php
							if($priv == 'admin')
							{
							?>
						<input type="SUBMIT" value="EMAIL TO PARENTS" name="send_email">
						
						<?php } ?>
						<br><br>
						
						<?php
						}
						?>
						
						</div>
						</form>
						</div>
						</div>
						<?php
						//echo sizeof($dummy_array);
						
						}
						else
						{
							echo "Please select parameters from left";
						}
						
						?>
						