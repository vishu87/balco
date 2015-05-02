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
					<?php	include('manage/manage_left.php'); ?>
						
					</div>
				</td>
				<td align="left" valign="top">
					<div id="right1" style="min-height:0">
					<?php 
						if(!$_GET["type"])
						{
							echo "Please Select From the left";
						}
						else
						{
							if($_GET["type"] == 'city'){
							include('manage/city.php');	
							}
							else
							{
								if($_GET["type"] == 'center')
								{
									include('manage/center.php');	
								}
								else
								{
								
									if($_GET["type"] == 'group')
									{				
										include('manage/group.php');
									}
									else
									{
										if($_GET["type"] == 'member')
										{				
										include('manage/member.php');
										}
										else
										{
											if($_GET["type"] == 'coach')
											{				
												include('manage/coach.php');
											}
											else
											{
												if($_GET["type"] == 'profile')
												{				
													include('manage/profile.php');
												} else {
													if($_GET["type"] == 'member_priv')
													{				
														include('manage/member_priv.php');
													}
												}
											
											}
									
										}
									
									}
									
								}
							
							
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

