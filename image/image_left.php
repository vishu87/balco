<?php

	$sql_priv="SELECT * from members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
											$result_priv=mysql_query($sql_priv);
											$row_priv = mysql_fetch_array($result_priv);
											$city = $row_priv["train_city"];
											$center = $row_priv["center"];

?>
<table width="100%" cellspacing="0" cellpadding="0">
						
						<?php
						
						?>
						<tr>
							<td class="<?php 
							if(!$_GET["type"])
							echo "color1";
							?>"><a href="images.php">Upload Image</a></td>
						</tr>
						<?php
						
						?>
						
						
						
						</table>