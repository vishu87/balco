<?php

	$sql_priv="SELECT * from members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
											$result_priv=mysql_query($sql_priv);
											$row_priv = mysql_fetch_array($result_priv);
											$city = $row_priv["train_city"];
											$center = $row_priv["center"];

?>
<table width="100%" cellspacing="0" cellpadding="0">
						
						<?php
						$result = mysql_list_tables(DB_DATABASE);
$num_rows = mysql_num_rows($result);
for ($i = 0; $i < $num_rows; $i++) {
?>
<tr>
							<td class="<?php 
							if($_GET["type"]== mysql_tablename($result, $i))
							echo "color1";
							?>">
							<a href="schema.php?type=<?php echo mysql_tablename($result, $i); ?>"><?php echo mysql_tablename($result, $i); ?></a></td>
</tr>

	
	<?php

}
						?>
						
						<?php
						
						?>
						
						
						
						</table>