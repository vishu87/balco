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
						$dos = strtotime($_GET["dos"]);
						$doe = strtotime($_GET["doe"]);
						$sql_case="SELECT * from payment_history WHERE dor >= '$dos' AND dor<='$doe' ORDER BY dor DESC";
						$result_case=mysql_query($sql_case);
							?>		
						
						
<div style="margin:10px;">
							Payments
						
						<div class="gen_table">
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
									</th>
									<th>Reg Fee</th>
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
										$qry="SELECT name,train_city,center,groupid,father,father_mob FROM students WHERE id='$row[student_id]' ";

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
									<a href="fpdf/payment/payment_print.php?id='.$row["id"].'" ><img src="icons/pdf_icon.png"</a>
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
									<span style="';
									if($row["verified"] == 1) echo 'background:#0f0; padding:3px 10px;';
									echo '">'.$row["amount"].'</span>
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
							
							<BR>Check all: <input type='checkbox' name='checkall' onclick='checkedAll();' checked="true">&nbsp;&nbsp;&nbsp;<a href="list_payment_xl.php?case=<?php echo base64_encode($sql_case);?>">Export to excel</a>
    



						</div>
						</div>
					<?php
					}
					else
					{
					
					echo "Please select from the left";
					}
					
					?>
					
					
					