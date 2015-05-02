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
   if (validate_required(file,"Please Select a File!")==false)
  {file.focus();return false;}
    
  }
}
</script>

						<div class="top_m color1">
						Table View:
						</div>
					
						<div class="gen_table">
						<?php
						echo 'Results for: '.$_GET["type"].'<br><br>';
						$i_count=0;
						if($_GET["type"])
						{
							echo '<table><tr><th>Field Name</th><th>Field Type</th><th>Length</th><th>Example</th></tr>';
							$sql = "select * from ".$_GET["type"];
							//echo $sql;
							$result = mysql_query($sql);
							$row = mysql_fetch_array($result);
							$field = mysql_num_fields( $result );
    
								for ( $i = 0; $i < $field; $i++ ) {
								
									echo '<tr ><th style="padding:5px" class="color3">'.mysql_field_name( $result, $i ).'</th>';
									echo '<td style="padding:5px">'.strtoupper(mysql_field_type( $result, $i )).'</td>';
									echo '<td style="padding:5px">'.strtoupper(mysql_field_len( $result, $i )).'</td>';
									echo '<td style="padding:5px">'.$row[mysql_field_name( $result, $i )].'</td>';
								
								echo '</tr>';
								
								
								
								
								}
							
						
							echo '</table>';
						}
						else
						{
						
						}
						
						
						?>
						</div>
						
						