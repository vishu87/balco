<?php
$sql_priv="SELECT * from members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
$result_priv=mysql_query($sql_priv);
$row_priv = mysql_fetch_array($result_priv);
$city = $row_priv["train_city"];
$center = $row_priv["center"];

$sql_manage_member = mysql_query("SELECT id from members_priv where user_id='$_SESSION[MEM_ID]' ");
$manage_members = mysql_num_rows($sql_manage_member);

?>
<table width="100%" cellspacing="0" cellpadding="0">
						
						<?php
						if($priv == 'admin'	&& $_SESSION["SUPER_ADMIN"]){
						?>
						<tr>
							<td class="<?php 
							if($_GET["type"] == 'city')
							echo "color1";
							?>"><a href="manage.php?type=city">Cities</a></td>
						</tr>
						<?php
						}
						?>
						
						<?php 
						if($priv == 'admin'	&& $_SESSION["SUPER_ADMIN"])
						{
							echo '<tr class="';
							if($_GET["type"] == 'center')
							{
							echo 'color1';
							}
							echo '"><td><a href="manage.php?type=center">Centers</a></td></tr>';
						}	
						
							?>
							
						
						
						
						<?php
						
						if($priv == 'admin'	&& $_SESSION["SUPER_ADMIN"]){
						
													echo '<tr class="';
													if($_GET["type"] == 'group')
													{
														echo 'color1';
													}
													echo'"><td><a href="manage.php?type=group"> Groups</a></td></tr>	';
													
							
							}
						?>
						<?php
						if($priv == 'admin'	&& $_SESSION["SUPER_ADMIN"]){
						?>
						<tr>
							<td class="<?php 
							if($_GET["type"] == 'member')
							echo "color1";
							?>"><a href="manage.php?type=member">Add Members</a></td>
						</tr>
						
						<?php
						}
						?>

						<?php
						if($priv == 'admin'){
						?>
						<tr>
							<td class="<?php 
							if($_GET["type"] == 'member_priv')
							echo "color1";
							?>"><a href="manage.php?type=member_priv">Members Priv</a></td>
						</tr>
						
						<?php
						}
						?>


						<tr style="display:none">
							<td class="<?php 
							if($_GET["type"] == 'coach')
							echo "color1";
							?>"><a href="manage.php?type=coach">Manage Coaches</a></td>
						</tr>
						

						<tr>
							<td class="<?php 
							if($_GET["type"] == 'profile')
							echo "color1";
							?>"><a href="manage.php?type=profile">My Profile</a></td>
						</tr>
						
						</table>