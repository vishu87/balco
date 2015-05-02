
<?
$sql_case = "select * from updates ORDER BY pri DESC";
$result_case=mysql_query($sql_case);
$tot = mysql_num_rows($result_case);
?>

						<div class="top_m color1">
						Latest Updates
						</div>
						<div style="margin:5px;">
						Manage Updates
						
						</div>
						<div class="gen_table">
							<table cellspacing="0" cellpadding="0" width="100%" id="myTable" border="0">
							<thead>
								<tr class="color_sel">
									
									<th>
									
									</th>
									<th>
									Update
									</th>
									<th width="40">
									Date
									</th>
									<th width="50">
									Up
									</th>
									
									<th width ="40">
									Edit
									</th>
									<th width ="40">
									Delete
									</th>
									
								</tr>
								</thead>
								<tbody>
								<?php
									
									$count =1;
									while($row = mysql_fetch_array($result_case))
									{
									
									$schol = 'schol1';
									
									
									
									echo '<tr class="';
									if($count%2 == 0)
									{
									echo 'color2';
									}
									
									echo '">';
									
									echo '
									
									<td class="'.$schol.'"  >
									'.$count.'
									</td>
									
									<td class="'.$schol.'" style="text-align:left" >';
									
									
									echo $row["title"];
									
									
									echo '</td>
									<td class="'.$schol.'" width="80">
									'.date("d-M-y", $row["timestamp"]).'
									</td>
									<td class="'.$schol.'" width="10">';
									if($count != 1) echo'
									<a href="updates/process_updates.php?type=up&amp;id='.$row["id"].'&amp;pri='.$row["pri"].'&amp;up_pri='.$up_pri.'&amp;up_id='.$up_id.'">UP</a>';
									echo '</td>
									
									<td class="'.$schol.'" width="10">
									<a href="updates.php?type=edit&amp;id='.$row["id"].'">Edit</a>
									</td>
									<td class="'.$schol.'" width="10">
									<a href="updates/process_updates.php?type=delete&amp;id='.$row["id"].'">Delete</a>
									</td>';
									
									
									echo'
								</tr>';
									$up_pri = $row["pri"];
									$up_id = $row["id"];
									$count++;
									}
								
								?>
								</tbody>
							</table>
							
</div>
						