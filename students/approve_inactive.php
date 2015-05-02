<script type="text/javascript">
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
	<a href="students.php?type=browse" style="text-decoration:underline">Approve Inactive Students</a> :
			<?php

						$sql_case="SELECT students.id, active, dob, name, school, father, father_mob, doe, main_reason, other_reason, first_group, group_name as groupid, center.center_name as center, city.city_name as train_city  from students join groups on students.first_group = groups.id join center on groups.center_id = center.id join city on center.city_id = city.id  where  active= -1".$sql_add." order by dos desc";

						if($_SESSION['PRIV'] != 'admin'){
							die("You are not authorized");
						}

									$result_case=mysql_query($sql_case);
							?>		


							
								
						</div>
						
<div style="margin:10px;">
							Inactive Students
							<form method="post" action="<?php echo "?type=sms&city=$_GET[city]&center=$_GET[center]&group=$_GET[group]"; ?>" id="students">
						<div class="gen_table">
							<table cellspacing="0" cellpadding="0" width="100%" id="myTable" class="tablesorter">
							<thead>
								<tr >
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
									<th>Reason</th>
									<th>Inactive Details</th>
									
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
									$schol = 'schol1';

									$query_inactive = mysql_query("SELECT inactive_on, add_date, added_by from inactive_history where student_id ='$row[id]' order by add_date desc limit 1 ");
									$row_inactive = mysql_fetch_array($query_inactive);

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
									<a href="students.php?type=browse&amp;id='.$row["id"].'" style="text-decoration:underline;">'.$row["name"].'
									</a></td>
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
									</td>
									<td class="'.$schol.'">
									'.$row["father"].'<br>'.$row["father_mob"].'
									</td>
									
									<td class="'.$schol.'">';
									if($row["doe"])
									{
									echo date("M j, Y", $row["doe"]);
									}
									echo '</td>
									<td>'.$row["main_reason"].'<br>'.$row["other_reason"].'</td>
									<td class="'.$schol.'">by 
									'.$row_inactive["added_by"].'<br> inactive on ';
									echo ($row_inactive["inactive_on"])?date("d-M-y",$row_inactive["inactive_on"]):'Not Set';
									echo '<br> marked on ';
									echo ($row_inactive["add_date"])?date("d-M-y",$row_inactive["add_date"]):'Not Set';
									echo '
									</td>
									<td class="'.$schol.'">
										<a href="students/process_student.php?type=app_in&amp;id='.$row["id"].'">Approve Inactive</a>&nbsp;&nbsp;&nbsp;&nbsp;
										<a href="students/process_student.php?type=disapp_in&amp;id='.$row["id"].'">Disapprove</a>
									</td>
									</td>
								</tr>';
									$count++;
									}
								
								?>
							</tbody></table>
							
    
</form>
						</div>
						</div>
					