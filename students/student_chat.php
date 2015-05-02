<div style="padding:10px;">
	Student Chat<br><br>
	<form action="students/process_student.php?type=chat&amp;id=<?php echo $_GET["id"]?>" id="chat_form" method="post">
		<textarea name="chat" id="chat" style="width:500px; height:90px; padding:10px; font-family:arial;"></textarea><br><br>
		<button type="button" onclick="check_submit()" style="padding:5px 10px">Add</button>
	</form>
</div>
<div id="gen_form">
	<table cellspacing="1" cellpadding="0" width="100%">
		<tbody>
			<tr class="color3">
				<td>SN</td>
				<td>Chat</td>
				<td>Date/Time</td>
				<td>Added By</td>									
			</tr>
			<?php 
				$sql_chat = mysql_query("SELECT * from student_chat where student_id='$_GET[id]' order by add_date desc ");
				$count_chat = 1;
				while ($row_chat = mysql_fetch_array($sql_chat)) {
					echo '<tr class="';
					if($count_chat%2 == 0) echo 'color2';
					echo '">';
					echo '<td>'.$count_chat.'</td>';
					echo '<td>'.$row_chat["chat"].'</td>';
					echo '<td>'.date("d-M-y h:i:s",$row_chat["add_date"]).'</td>';
					echo '<td>'.$row_chat["added_by"].'</td>';
					$count_chat++;
				}

			?>		
		</tbody>
	</table>
</div>			
<script type="text/javascript">
	function check_submit(){
		if($("#chat").val() != ''){
			$("#chat_form").submit();
		} else {
			alert('Please input some content');
			$("#chat").focus();
		}
	}
</script>