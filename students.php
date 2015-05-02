<?php 
	 session_start();
	 require_once('auth.php');
	 include('top.php');
	 ?>
<body>
	<div id="wrapper">
		<div id="topmenu">
			<?php 
			
			include('top_menu.php');?>
		</div>
		<div id="header">
		   <?php include('header.php'); ?>
		</div>
	
	
	<div id="content">
		<table cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<td align="left" valign="top" width="200" >
					<div id="left1">
						<div class="top_m color2">
						Students
						</div>
						<br>
					<?php	include('students/student_left.php'); ?>
						
					</div>
				</td>
				<td align="left" valign="top">
					<div id="right1">
					<?php 
						if(!$_GET["type"])
						{
							include('students/new_student.php');
						}
						else
						{
							if($_GET["type"] == 'edit'){
							include('students/edit_student.php');	
							}
						}	

						if($_GET["type"] == 'approve_inactive'){
							include('students/approve_inactive.php');	
							}

						if($_GET["type"] == 'browse')
							{
							if(!$_GET["id"])
							{
							include('students/students_list.php');
							}
							else
							{
							include('students/student_info.php');
							}
							}
						if($_GET["type"] == 'edit_pay'){
							include('students/edit_payment.php');	
							}
							
							if($_GET["type"] == 'in_stu'){
							include('students/inactive_students_list.php');	
							}
							if($_GET["type"] == 'pay_due'){
							include('students/pay_due_students_list.php');	
							}
							if($_GET["type"] == 'sms'){
							include('students/sms_list.php');	
							}
					
					
					?>
					</div>
				</td>
			
			
			</tr>
		
		
		</table>
	
	
	</div>
	
	
	
	
		      
		</div>
	 
	
	</body>
</html>

