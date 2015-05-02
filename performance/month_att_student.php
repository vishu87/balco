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
						$id = mysql_real_escape_string($_GET["id"]);
						$sql_case="SELECT id,name,dos from students WHERE id='$id' ";
							$sql_case =$sql_case." ORDER BY name ASC";
							$result_att=mysql_query($sql_case);
							$stu = mysql_fetch_array($result_att);
							
						echo '<span style="padding:10px; font-size:16px; color:#0E3DCA;">'.$stu["name"].'</span><br>';
						
						if($id)
						{
						?>
						<br>
						<div style="margin:5px 5px 0px 5px;">
						
						</div>
						<?php
						
							
							$sql_case="SELECT id from evaluation WHERE student_id ='$id' order by id desc ";
							$result_case=mysql_query($sql_case);
							$tot_st = mysql_num_rows($result_case);
							//echo $tot_st;
							?>
						<div style="margin:3px 5px 5px 5px;padding:5px; border:2px solid #bbb;">
						Quarterly Evaluation: 
						<div id="atten" align="center">
						<form action="performance/process_stu.php?stu_id=<?php echo $id;?>" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
						<table cellspacing="0" cellpadding="0"  style="margin-top:10px;">
							<?php
							
							
							
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
							echo '<td class="color3" width="20">View</td>';
							echo '<td class="color3" width="20">SentOn</td>';
							echo '</tr>';


							$count=1;
							$sql_st_at="SELECT id,performa,comments,sending_date,quarter,year from evaluation WHERE student_id='$id' order by id desc";
							$result_att = mysql_query($sql_st_at);

							while($row_st_at = mysql_fetch_array($result_att))
							{
								
								$st_at = explode(",", $row_st_at["performa"]);
								
								$month = $row_st_at["quarter"];
								$year = $row_st_at["year"];
								
								
								//$att = $row_att["attendance"];
								
								echo '<tr class="color2" id="tr_'.$count.'" onMouseOver="this.style.backgroundColor=\'#DBDDDE\' ; " onMouseOut="this.style.backgroundColor=\'#E3E9FF\';">';
								
								for($i=0;$i<=32;$i++)
								{
								if( $i== 0) {
								
									echo '<td>';
									if($count ==1)
									{
									echo '<input type="checkbox" name="list" value="'.$row_st_at["id"].'" checked="true"></td><td>';
									}
									else
									{
										echo '</td><td>';
									}
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
									echo ", ".$year;
									
									echo '</td>';
								//echo '<td>'.$row_att["father_mob"].'</td>';
								}
								else {
										if($count ==1)
										{
											echo '<td width="20" class="'.$arr_class[$i-1].'" onMouseOver="show_date('.$i.');" onMouseOut="hide_date('.$i.');"><input type="text" class="color2 '.$arr_class[$i-1].'" name="st'.$id.'_';
											if($i<10) echo $i;
											else echo $i;							
											echo '" id = "st'.$count.'_'.$i.'" onclick="toggle('.$count.','.$i.');" style="width:18px; border:none; text-align:center; cursor:pointer;" value="';
												echo $st_at[$i-1];
											echo '" readonly></td>';
										}
										else
										{
											echo '<td width="20" class="'.$arr_class[$i-1].'" >'.$st_at[$i-1].'</td>';
										}
									}
								}
								echo '<td style="background:#FEF2FF;">';
								if($count ==1)
								{
									echo '<textarea name="comment_'.$id.'" rows="4" style="width:250px; background:inherit; border:0px;">'.$row_st_at["comments"].'
								</textarea>';
								}
								else
								{
								echo '<span name="comment_'.$id.'" rows="4" style="width:250px; background:inherit; border:0px;">'.$row_st_at["comments"].'
								</span>';
								}
								echo '</td>';
								echo '<td><a href="fpdf/performance/evaluation.php?id='.base64_encode($id).'&amp;q='.base64_encode($month).'&y='.base64_encode($year).'" target="_blank">V</a></td>';
								
									echo '<td>';
								if($row_st_at["sending_date"]) 
								echo date("d M y", $row_st_at["sending_date"]);
								echo '</td>';
								
								echo '</tr>';
								$count++;
							
							}
							//echo '<tr><td><input type="checkbox" name="list[]" value="'.$id.'" checked="false"></td><td colspan="5">check/uncheck inactive</td><td colspan="32">INACTIVE STUDENTS</td></tr>';
							
							
							
							///end inactive students
							
							
							
							echo '<tr class="color3">';
							for($i=0;$i<=32;$i++)
							{
								if( $i== 0) echo '<td></td><td width="120"></td>';
								else echo '<td  class="'.$arr_class[$i - 1].'" valign= "bottom" style="height:120px; line-height:0.3;" id="dt2_'.$i.'"><div class="rotat">'.$arr_prop[$i -1].'</div></td>';
							
							}
							echo '<td width="20">C</td>';
							echo '<td class="color3" width="20"></td>';
							echo '<td class="color3" width="20"></td>';
							echo '';
							echo '</tr>';
							?>
							
						</table>
						<br>
						<div align="center">
						<input type="SUBMIT" Value="SAVE"><br><br><br>
						<?php if($priv == 'admin')
							{
							?>
						<input type="SUBMIT" value="EMAIL TO PARENTS" name="send_email">
						
						<?php } ?>
						
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
						