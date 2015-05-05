
<div class="top_m color1">
						<a href="students.php?type=browse" style="text-decoration:underline">Payments Verifications</a> :
						</div>
						<?php
						if($_SESSION["PRIV"] == 'admin'){
							$query_add='';
						} else {
							$groups = array();
							$query_pay = mysql_query("SELECT groups from members_priv where payments = 1 and user_id = $_SESSION[MEM_ID] ");
							while ($row_pay = mysql_fetch_array($query_pay)) {
								array_push($groups, $row_pay["groups"]);
							}
							$query_add = " and first_group IN (".implode(',', $groups).") ";
						}

						$sql_case="SELECT payment_history.*,  name, father, father_mob, father_email, group_name as groupid, center.center_name as center, city.city_name as train_city from payment_history join students on payment_history.student_id = students.id join groups on students.first_group = groups.id join center on groups.center_id = center.id join city on center.city_id = city.id WHERE verified = 0 ".$query_add." ORDER BY dor ASC";

						$result_case=mysql_query($sql_case);
							?>		
						
						
<div style="margin:10px;">
							Payments
						
						<div class="gen_table">
							<form action="payments/process.php" method="post">
								<button type="submit" style="padding:10px">Verify</button>
							<table cellspacing="0" cellpadding="0" width="100%" id="myTable" class="tablesorter">
							<thead>
								<tr >
									<th>
									SN
									</th>
									<th>
									
									</th>
									<th>
									Payment Date
									</th>
									<th>
									Start
									</th>
									<th>
									End
									</th><th>Reg Fee</th>
									<th>Sub Fee</th>
									<th width="40">
									Amount
									</th>
									<th >
									Month Plan
									</th>
									<th >
									Payment 
									</th>
									<th>
									Name
									</th>
									<th width ="40">
									City
									</th>
									<th width ="40">
									Center
									</th>
									<th width ="40">
									Group
									</th>
									
									<th>
									Father
									</th>
									
									
									
								</tr>
								</thead>
								<tbody>
								<?php
									
									$count =1;
									while($row = mysql_fetch_array($result_case))
									{
									
									$schol = 'schol1';
									
									//$age = duration($row["dob"]);
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
									<input type="checkbox" name="verify[]" value="'.$row["id"].'">
									</td>
									<td class="'.$schol.'">';
									echo ($row["dor"] != '')?date("M j, Y", $row["dor"]):'';
									echo '</td><td class="'.$schol.'">';
									echo date("M j, Y", $row["dos"]);
									echo '</td><td class="'.$schol.'">';
									echo date("M j, Y", $row["doe"]);
										
									echo '</td>

									<td class="'.$schol.'">'.$row["reg_fee"].'</td>
									<td class="'.$schol.'">'.$row["sub_fee"].'</td>
									
									<td class="'.$schol.'">
									'.$row["amount"].'
									</td>
									<td class="'.$schol.'">
									'.$row["months"].'
									</td>
									<td class="'.$schol.'">
									'.$row["p_remark"].'
									</td>
									<td class="'.$schol.'">
									'.$row["name"].'
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
									
									
									
									echo '
									<td class="'.$schol.'" >
									'.$row["father"].'<br>'.$row["father_mob"].'
									</td>';
									
									
									
									
									echo'
								</tr>';
									$count++;
									}
								
								?>
								</tbody>
							</table>
							<button type="submit" style="padding:10px">Verify</button>
							</form>
						</div>
					</div>
					
					
					
					