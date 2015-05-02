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
						<a href="students.php?type=browse" style="text-decoration:underline">Payments</a> :
						</div>
						<?php
						
						if($_GET["dos"] && $_GET["doe"])
						{
						$sql_case="SELECT * from students ";
						$result_case=mysql_query($sql_case);
							?>		
						
						
<div style="margin:10px;">
							Payments
						
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
									if($priv != 'general')
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
									<td>';
									
									if($priv != 'general')
									{
									echo'
									<a href="students.php?type=browse&amp;id='.$row["id"].'" style="text-decoration:underline;">'.$row["name"].'
									</a>';
									
									}
									else
									{
									echo $row["name"];
									}
									
									echo '</td>
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
									</td>';
									
									if($priv == 'general')
									{
									echo '
									<td>
									'.$row["school"].'
									</td>';
									}
									else
									{
									echo '
									<td>
									'.$row["father"].'<br>'.$row["father_mob"].'
									</td>';
									}
									echo'
									<td>';
									if($row["doe"])
									{
									echo date("d M y",$row["doe"]);
									}
									echo '</td>';
									
									if($priv == 'general')
									{}
									else
									{
									if($priv != 'coach' )
									{
									
									echo '<td>
									<a href="students.php?type=edit&amp;id='.$row["id"].'"><img src="icons/edit_profile.png" title="Edit Profile"></a>
									<a href="students.php?type=browse&amp;id='.$row["id"].'"><img src="icons/money.png" title="Edit Payment"></a>
									<a href="students.php?type=sms&amp;email=yes&amp;id='.$row["id"].'"><img src="icons/email.png" title="EMAIL"></a>
									<a href="students.php?type=sms&amp;id='.$row["id"].'"><img src="icons/mobile.png" title="SMS" ></a>
									</td>';
									
									}
									else
									{
									echo '<td>';
									if($edit_priv == '0')
									echo '<a href="students.php?type=edit&amp;id='.$row["id"].'"><img src="icons/edit_profile.png" title="Edit Profile"></a>';
									echo '<a href="students.php?type=sms&amp;email=yes&amp;id='.$row["id"].'"><img src="icons/email.png" title="EMAIL"></a>
									<a href="students.php?type=sms&amp;id='.$row["id"].'"><img src="icons/mobile.png" title="SMS" ></a>';
									
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
							
							<BR>Check all: <input type='checkbox' name='checkall' onclick='checkedAll();' checked="true">&nbsp;&nbsp;&nbsp;<a href="list_xl.php?case=<?php echo base64_encode($sql_case);?>">Export to excel</a>
    



						</div>
						</div>
					<?php
					}
					else
					{
					
					echo "Please select from the left";
					}
					
					?>
					
					
					