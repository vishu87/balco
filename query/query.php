<script type="text/javascript">
function validate_required(field,alerttxt)
{
with (field)
  {
  if (value==null||value=="Select"|| value=="")
    {
    alert(alerttxt);return false;
    }
  else
    {
    return true;
    }
  }
}
function validate_form(thisform)
{
with (thisform)
  {
   if (validate_required(query,"Please fill Query!")==false)
  {query.focus();return false;}
  
  
  }
}
</script>

						<div class="top_m color1">
						Query
						</div>
						<div style="margin:5px;">
						New Query
						<form action="query.php" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
						<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr>
								<td align="left" valign="top" width="100%">
									<div id="gen_form">
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								
								</td>
								
							</tr>
							
							
							<tr>
							<td width="10%" align="right">Query
							</td>
							<td><input type="text" name="query" style="padding:5px; width:700px;" value="<?php 
							$query = stripslashes($_POST["query"]);
							echo  $query;?>"></td>
							<td><input type="SUBMIT" name="add" Value="GO"></td>
							</tr>
							
							
						</table>
						
						</form>
						</div>
						<div class="gen_table">
						<?php
						echo 'Results for: '.$query.'<br><br>';
						$i_count=0;
						if($query)
						{
							echo '<table><tr class="color3" >';
							$result = mysql_query($query);
							$field = mysql_num_fields( $result );
    
								for ( $i = 0; $i < $field; $i++ ) {
								
									echo '<th style="padding:5px">'.strtoupper(mysql_field_name( $result, $i )).'</th>';
								
								}
							echo '</tr>';
						while($row = mysql_fetch_array($result))
						{
						if($i_count%2 == 0)
						{
							echo '<tr>';
						}
						else
						{
						echo '<tr class="color2">';
						}
						for ( $i = 0; $i < $field; $i++ ) {
								
									echo '<td>'.$row[mysql_field_name( $result, $i )].'</td>';
								
								}
							echo '</tr>';
							$i_count++;
						}
							echo '</tr></table>';
						}
						else
						{
						
						}
						
						
						?>
						</div>
						
						