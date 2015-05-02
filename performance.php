<?php 
session_start();
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
						Evaluation
						</div>
						<br>
					<?php	include('performance/left.php'); ?>
						
					</div>
				</td>
				<td align="left" valign="top">
					<div id="right1">
					<?php 
						if(!$_GET["type"])
						{
							include('performance/month_att.php');
						}
						else
						{
								if($_GET["type"]=='att')
							{
								include('performance/month_att_student.php');
							}
						
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

