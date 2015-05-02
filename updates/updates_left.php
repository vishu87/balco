

<?php
							
?>
<table id="left_table" width="100%" cellspacing="0" cellpadding="0">
						
						
						<tr>
							<td class="<?php 
							if(!$_GET["type"])
							echo "color1";
							?>"><a href="updates.php">Add Update</a></td>
						</tr>
						<tr>
							<td class="<?php 
							if($_GET["type"] == 'view_all')
							echo "color1";
							?>"><a href="updates.php?type=view_all">Manage Updates</a></td>
						</tr>
						<tr>
							<td class="<?php 
							if($_GET["type"] == 'edit')
							echo "color1";
							?>">Edit</td>
						</tr>
					
						
						</table>