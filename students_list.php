																																															<script language='JavaScript'>
      checked = true;
      function checkedAll () {
        if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('students').elements.length; i++) {
	  document.getElementById('students').elements[i].checked = checked;
	}
      }
    </script>


<?php

function Duration($s){

/* Find out the seconds between each dates */
$timestamp = strtotime("now") - $s;

/* Cleaver Maths! */
$years=floor($timestamp/(60*60*24*365));$timestamp%=60*60*24*365;
$months=floor($timestamp/(60*60*24*30));
/* Display for date, can be modified more to take the S off */
if ($years >= 1) { $str.= $years; }
if ($months >= 1) { //$str.= $months.'M'; 
}
return $str;

}

?> 
<div class="top_m color1">
						<a href="students.php?type=browse" style="text-decoration:underline">Browse Students</a> :
						
						<?php
						$sql_case="SELECT * from students ";
						if($priv == 'admin')
						{
							if($_GET["city"])
							{
								$sql_case =$sql_case." WHERE train_city = '$_GET[city]'";
								if($_GET["center"])
								{
								
									if($_GET["group"])
									{
										$sql_case =$sql_case." AND ( center='$_GET[center]' AND groupid='$_GET[group]') ";
									}
									else
									{
										$sql_case =$sql_case." AND center='$_GET[center]' ";
									}
								
								}
							
							}
							$sql_case =$sql_case." ORDER BY id DESC";
							
						}
									if($priv == 'citycord')
									{	
										$sql_case =$sql_case." WHERE train_city='$city' ";
										if($_GET["center"])
										{
								
											if($_GET["group"])
											{
												$sql_case =$sql_case." AND ( center='$_GET[center]' AND groupid='$_GET[group]') ";
											}
											else
											{
												$sql_case =$sql_case." AND center='$_GET[center]' ";
											}
								
										}
										
										
										$sql_case =$sql_case." ORDER BY id DESC";
									}
									if($priv == 'centercord')
									{	
										
											
											if($_GET["group"])
											{
												$sql_case =$sql_case." WHERE train_city='$city' AND ( center='$center' AND groupid='$_GET[group]') ";
											}
											else
											{
												$sql_case =$sql_case." WHERE train_city='$city' AND center='$center' ";
											}
								
										$sql_case =$sql_case." ORDER BY id DESC";
									}
									if($priv == 'coach')
									{	
										$qry="SELECT * FROM members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
										$result=mysql_query($qry);
										$row_qry = mysql_fetch_array($result);
										$id_coach = $row_qry["id"];
										
										$sql_coach_centers ="SELECT * from coach_groups WHERE coach_id='$id_coach'";
										$result_coach_center=mysql_query($sql_coach_centers);
										$str_in = '( ';
										$count_in = 0;
										while($row = mysql_fetch_array($result_coach_center))
										{
											if($count_in == 0)
											{
											$str_in = $str_in.'\''.$row["center_name"].'\'';
											}
											else
											{
											$str_in =$str_in.', '.'\''.$row["center_name"].'\'';
											}
										 $count_in++;
										}
										
										$str_in = $str_in.' )';
										//echo $str_in;						
										$sql_case =$sql_case." WHERE train_city='$city'";
										
										if($_GET["center"])
								{
								
									if($_GET["group"])
									{
										$sql_case =$sql_case." AND ( center='$_GET[center]' AND groupid='$_GET[group]') ";
									}
									else
									{
										$sql_case =$sql_case." AND center='$_GET[center]' ";
									}
								
								}
								else
								{

										$sql_case =$sql_case."AND center IN ". $str_in." ORDER BY center ASC";
								}
									}
									//echo $sql_case;
									//$sql_case =$sql_case." ORDER BY id DESC";
									$result_case=mysql_query($sql_case);
							?>		
						</div>
						
<div style="margin:10px;">
							Enrolled Students
							<br>
							<BR>Check all: <input type='checkbox' name='checkall' onclick='checkedAll();' checked="true">&nbsp;&nbsp;&nbsp;<a href="list_xl.php?case=<?php echo base64_encode($sql_case);?>">Export to excel</a>
							<br>
						<form method="post" action="<?php echo "?type=sms&city=$_GET[city]&center=$_GET[center]&group=$_GET[group]"; ?>" id="students">	
						<div class="gen_table">
							<table cellspacing="0" cellpadding="0" width="100%" id="myTable" class="tablesorter">
							<thead>
								<tr >
									<th>
									
									</th>
									<th>
									
									</th>
									<th>
									Name
									</th>
									<th width="40">
									Age
									</th>
									<th width="50">
									City
									</th>
									<th>
									Center
									</th>
									<th width ="40">
									Grp
									</th>
									<th>
									Father
									
									</th>
									<th>
									End Date
									</th>
									
									<?php
									if($priv != 'coach')
									{
										echo '<td>
									Options</td>';
									}
									
									?>
								</tr>
								</thead>
								<tbody>
								<?php
									
									$count =1;
									while($row = mysql_fetch_array($result_case))
									{
									if($row["active"] == 1)
									{
										continue;
									}
									if($priv == 'coach')
									{
										$qry="SELECT * FROM coach_groups WHERE coach_id = '$id_coach' AND ( group_name='$row[groupid]' AND center_name='$row[center]')";
										$result=mysql_query($qry);
										$row_num_qry = mysql_num_rows($result);
										//echo $row_num_qry;
										if($row_num_qry == 0) continue;
									}
									$age = duration($row["dob"]);
									if($count%2 ==0)
									{
										echo '<tr class="color2">';
									}
									else
									{
										echo '<tr >';
									}
									echo '
									
									<td>
									'.$count.'
									</td>
									<td>
									<input type="checkbox" name="list[]" value="'.$row["id"].'" checked="true">
									</td>
									<td>
									<a href="students.php?type=browse&amp;id='.$row["id"].'" style="text-decoration:underline;">'.$row["name"].'
									</a></td>
									<td>
									'.$age.'
									</td>
									<td>
									'.$row["train_city"].'
									</td>
									<td>
									'.$row["center"].'
									</td>
									<td>
									'.$row["groupid"].'
									</td>
									<td>
									'.$row["father"].'<br>'.$row["father_mob"].'
									</td>
									<td>';
									if($row["doe"])
									{
									echo date("d M y",$row["doe"]);
									}
									echo '</td>';
									
									if($priv != 'coach')
									{
									echo '<td>
									<a href="students.php?type=edit&amp;id='.$row["id"].'"><img src="icons/edit_profile.png" title="Edit Profile"></a>
									<a href="students.php?type=browse&amp;id='.$row["id"].'"><img src="icons/money.png" title="Edit Payment"></a>
									<a href="students.php?type=sms&amp;email=yes&amp;id='.$row["id"].'"><img src="icons/email.png" title="EMAIL"></a>
									<a href="students.php?type=sms&amp;id='.$row["id"].'"><img src="icons/mobile.png" title="SMS" ></a>
									</td>';
									}
									
									echo'
								</tr>';
									$count++;
									}
								
								?>
								</tbody>
							</table>
							<BR>Check all: <input type='checkbox' name='checkall' onclick='checkedAll();' checked="true">&nbsp;&nbsp;&nbsp;<a href="list_xl.php?case=<?php echo base64_encode($sql_case);?>">Export to excel</a>
    
	<br>
	<br>
<input type="SUBMIT" name="submit" style="background:url('sms.png') no-repeat #458BE0; height:36px; width:100px; border:none;" value="">
<input type="SUBMIT" value="EMAIL" name="send_email">
</form>

						</div>
						</div>
					