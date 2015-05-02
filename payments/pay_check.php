
<div class="top_m color1">
						<a href="students.php?type=browse" style="text-decoration:underline">Payments Verifications</a> :
						</div>
						<?php

						$sql_case="SELECT * from payment_history WHERE verified='0' ORDER BY dor ASC";
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
										$qry="SELECT * FROM students WHERE id='$row[student_id]' ";
										$result_qry=mysql_query($qry);
										$row_qry = mysql_fetch_array($result_qry);
										
									
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
									echo date("M j, Y", $row["dor"]);
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
									'.$row_qry["name"].'
									</td>
									<td class="'.$schol.'">
									'.$row_qry["train_city"].'
									</td>
									<td class="'.$schol.'">
									'.$row_qry["center"].'
									</td>
									<td class="'.$schol.'">
									'.$row_qry["groupid"].'
									</td>';
									
									
									
									echo '
									<td class="'.$schol.'" >
									'.$row_qry["father"].'<br>'.$row_qry["father_mob"].'
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
					
					
					
					