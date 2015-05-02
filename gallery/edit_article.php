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
   if (validate_required(name,"Please fill the name!")==false)
  {name.focus();return false;}
   if (validate_required(train_city,"Please fill Training City!")==false)
  {train_city.focus();return false;}
   if (validate_required(train_center,"Please fill Center Name!")==false)
  {train_center.focus();return false;}
   if (validate_required(groupid,"Please fill Group Name!")==false)
  {groupid.focus();return false;}
  
  }
}
</script>
<?php
$sql_case="SELECT * from articles WHERE id='$_GET[id]'";
$result_case=mysql_query($sql_case);
$row_a = mysql_fetch_array($result_case);
?>
						<div class="top_m color1">
						Edit Article
						</div>
						<div style="margin:5px;">
						Edit Article
						<form action="pages/process_article.php?type=2&amp;id=<?php echo $row_a["id"]; ?>" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
						
						<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr>
								<td align="left" valign="top" width="50%">
									<div id="gen_form">
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							
						<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Genral Information
								</td>
							<tr>
							<td width="40%" align="right">Title
							</td>
							<td><input type="text" name="title" value="<?php echo $row_a["title"]; ?>"></td>
							</tr>
							<tr>
							<td align="right">Subname
							</td>
							<td ><input type="text" name="subname" value="<?php echo $row_a["subname"]; ?>"></td>
							</tr>
							<tr>
							<td align="right">Top Header
							</td>
							<td >
							<select name="top_header">
							<?php
							$sql_case="SELECT * from top_header";
$result_case=mysql_query($sql_case);
while($row = mysql_fetch_array($result_case))
{

echo '<option ';
if($row["name"] == $row_a["top_header"])
echo "selected";
echo '>'.$row["name"].'<option>';
}
							
							?>
							</select>
							
							
							</td>
							</tr>
							<tr>
							<td align="right">Top Heading
							</td>
							<td ><input type="text" name="top_heading" value="<?php echo $row_a["top_heading"]; ?>"></td>
							</tr>
							
							
							
							</table>
									
									</div>
								  </td>
								<td align="left" valign="top" width="50%">
								     <div id="gen_form">
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Images
								</td>
								
							</tr>
							<tr>
							<td width="40%" align="right">Choose Header Pic
							</td>
							<td><input type="text" name="top_img" name="top_img" style="text-align:right"></td>
							</tr>
							
							
							</table>
									
									</div>
								  
								</td>
							</tr>
							
						</table>
						<div align="left">
						<p>
			<label for="editor1">
				<b>Editor 1:</b></label></p><p>
			<textarea cols="100" id="editor1" name="content" rows="40"><?php echo stripslashes($row_a["content"]); ?>"</textarea>
			<script type="text/javascript">
			//<![CDATA[

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using the "bbcode" plugin, shaping some of the
			// editor configuration to fit BBCode environment.
			CKEDITOR.replace( 'editor1',
				{
					toolbar :
					[
						['Source', '-', '-','NewPage','-','Undo','Redo'],
						[ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ],
						['Find','Replace','-','SelectAll','RemoveFormat'],
						['Link', 'Unlink'],[ 'Image','Flash','Table','HorizontalRule' ],
						'/',
						['Bold', 'Italic','Underline'],
						
						[ '-','Format','-','-' ],
						['-'],
						['NumberedList','BulletedList','-','Blockquote'],
						['Maximize']
					],
					// Strip CKEditor smileys to those commonly used in BBCode.
					
			} );

			//]]>
			</script>
		</p>
						</div>
						
						
						
						<div align="center">
						<input type="SUBMIT" name="add" Value="Update">&nbsp;&nbsp;&nbsp;&nbsp;<input onclick="javascript:window.history.back()" type="BUTTON" name="cancel" value="CANCEL">
						</div>
						</form>
						</div>
						
						