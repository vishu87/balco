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
	Students :
	<?php if($_GET["limit"]) echo 'Showing latest '.$_GET["limit"].' students' ?>
						<a href="students.php?type=browse" style="text-decoration:underline">Browse All Students</a>
						
						<?php
						$sql_add = '';
						if(isset($city_id)){

							if(isset($center_id)){
								if(isset($group_id)){
									if(in_array($group_id, $all_groups_access)){
										$sql_add = "and first_group IN (".$group_id.")";
									} else {
										$sql_add = "and first_group IN (-1)";
									}
								} else {
									$sql_add = "and first_group IN (".$priv[$city_id][$center_id].")";
								}
							} else {

								$group_select = array();
								foreach ($priv[$city_id] as $value) {
									array_push($group_select, $value);
								}
								$sql_add = "and first_group IN (".implode(',', $group_select).")";
							}
						} else {
							$sql_add = "and first_group IN (".$group_ids.")";
						}

						$sql_case="SELECT students.id, active, dob, name, email, mobile, school, father, father_mob, father_email, mother, mother_mob, mother_email, students.city, students.state, doe, first_group, group_name as groupid, students.address, center.center_name as center, city.city_name as train_city  from students join groups on students.first_group = groups.id join center on groups.center_id = center.id join city on center.city_id = city.id  where  active IN (0,-1) ".$sql_add." order by dos desc";
						if($_GET["limit"]) $sql_case = $sql_case.' limit '.$_GET["limit"];
						$result_case=mysql_query($sql_case);
							?>		
						</div>
						
<div style="margin:10px;">
							Enrolled Students
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
									<?php
									if($priv == 'general')
									{
									echo '<th>
									School Name
									
									</th>';
									}
									else
									{
									echo '<th>
									Father
									
									</th>';
									}
									
									?>
									<th>
									End Date
									</th>
									
									
									<?php
									if($priv == 'general')
									{
									
									}
									
									else
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
									
									$schol = 'schol1';
									
									
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
									
									<td class="'.$schol.'">
									'.$count.'
									</td>
									<td class="'.$schol.'">
									<input type="checkbox" name="list[]" value="'.$row["id"].'" checked="true">
									</td>
									<td class="'.$schol.'">';
									
									
									echo'
									<a href="students.php?type=browse&amp;id='.$row["id"].'" style="text-decoration:underline;">'.$row["name"].'
									</a>';
									
									
									echo '</td>
									<td class="'.$schol.'">
									'.$age.'
									</td>
									<td class="'.$schol.'">
									'.$row["train_city"].'
									</td>
									<td class="'.$schol.'">
									'.$row["center"].'
									</td>
									<td class="'.$schol.'">
									'.$row["groupid"].'
									</td>';
									
									if($priv == 'general')
									{
									echo '
									<td class="'.$schol.'">
									'.$row["school"].'
									</td>';
									}
									else
									{
									echo '
									<td class="'.$schol.'">
									'.$row["father"].'<br>'.$row["father_mob"].'
									</td>';
									}
									echo'
									<td class="'.$schol.'" style="width:100px; overflow:hidden;">';
									if($row["doe"])
									{
									echo date("M d, Y", $row["doe"]);
									}
									echo '</td>';
									
									if($priv == 'general')
									{}
									else
									{
									if($priv != 'coach' )
									{
									
									echo '<td class="'.$schol.'">
									<a href="students.php?type=edit&amp;id='.$row["id"].'"><img src="icons/edit_profile.png" title="Edit Profile"></a>
									<a href="students.php?type=browse&amp;id='.$row["id"].'"><img src="icons/money.png" title="Edit Payment"></a>
									<a href="students.php?type=sms&amp;email=yes&amp;id='.$row["id"].'"><img src="icons/email.png" title="EMAIL"></a>
									<a href="students.php?type=sms&amp;id='.$row["id"].'"><img src="icons/mobile.png" title="SMS" ></a>
									<a href="attendance.php?type=att&amp;id='.$row["id"].'" target="_blank"><img src="icons/attendance.png" alt="attendance" title="attendance"></a><a href="performance.php?type=att&amp;id='.$row["id"].'" target="_blank"><img src="icons/performance.png" alt="performance" title="performance"></a>
									</td>';
									
									}
									else
									{
									echo '<td class="'.$schol.'">';
									if($edit_priv == '0')
									echo '<a href="students.php?type=edit&amp;id='.$row["id"].'"><img src="icons/edit_profile.png" title="Edit Profile"></a>';
									echo '<a href="students.php?type=sms&amp;email=yes&amp;id='.$row["id"].'"><img src="icons/email.png" title="EMAIL"></a>
									<a href="students.php?type=sms&amp;id='.$row["id"].'"><img src="icons/mobile.png" title="SMS" ></a>
									<a href="attendance.php?type=att&amp;id='.$row["id"].'" target="_blank"><img src="icons/attendance.png" alt="attendance" title="attendance"></a>
'
									;
									
									echo '</td>';
									}
									}
									
									echo'
								</tr>';
									$count++;
									}
								
								?>
								</tbody>
							</table>
							<?php 
							if($priv != 'general')
							{
								//echo $sql_case;
							?>
							<BR>Check all: <input type='checkbox' name='checkall' onclick='checkedAll();' checked="true">&nbsp;&nbsp;&nbsp;<a href="list_xl.php?case=<?php echo base64_encode($sql_case);?>">Export to excel</a>
    
	<br>
	<br>
<input type="SUBMIT" name="submit" style="background:url('sms.png') no-repeat #458BE0; height:36px; width:100px; border:none;" value="">
<input type="SUBMIT" value="EMAIL" name="send_email">
<?php } ?>
</form>
</div>
						</div>
					