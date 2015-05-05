<script type="text/javascript">
var get_type = "adjustment";
</script>

						<div class="top_m color1">
						Add New Adjustment
						</div>
						<div style="margin:5px;">
						
						<form action="adjustment/process.php" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
						<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr>
								<td align="left" valign="top" width="50%">
									<div id="gen_form">
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Information
								</td>
								
							</tr>
							
							<tr>
											<td align="right">City</td><td>
											
									<?php

									echo '<select id="ctlcityidtype">
									<option>Select</option>';
									$count_city =1;
									foreach($cities as $city_id => $city_name)
									{
										echo '<option value="'.$city_id.'"';
										echo '>'.$city_name.'</option>';
										$count_city++;
									}
									echo'</select>';

								
								
								
							?>
							</td>
							
									</tr>
							<tr>
									<td align="right">Traning Center
							</td>
							<td >
							<?php
								echo '<select id="ctlcenteridtype">
								<option>Select	</option>';
								echo '</select>';
							?>
							
							
							</td>
							</tr>
							
							<tr>
							<td align="right">Group
							</td>
							<td >
							<?php

								echo '<select name="groupid" id="ct1groupidtype">
								<option>Select	</option>';
								
								echo '</select>';
							
							
							?>
							
							</td>
							</tr>
							
							
							
							<tr>
							<td width="40%" align="right">Days
							</td>
							<td><input type="text" name="days"></td>
							</tr>
							<tr>
							<td align="right">Month </td>
							<td align="left" colspan="2">
							
							<select name="month">
							<?php
							for($i=1; $i<13;$i++)
							{
								echo '<option>'.$i.'</option>';
							}
							?>
							</select>
							
							</td>
							</tr>
							<tr>
											<td align="right">Select Year</td>
											<td><select name="year"><?php
							for($i=2014; $i<=2020;$i++)
							{
								echo '<option value="'.$i.'"';
								if($i == $year) echo " selected";
								
								echo '>'.$i.'</option>';
							}
							?></select></td>
									</tr>

							<tr>
							<td align="right">Remark
							</td>
							<td>
							<input type="text" name="remark">
							</td>
							
							</tr>

							</table>
									
									</div>
								  </td>
								
							</tr>
							
						</table>
						<div align="center">
						<input type="SUBMIT" name="add" Value="ADJUST">
						
						</div>
						</form>
						</div>
						
						