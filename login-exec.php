<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$login = clean($_POST['login']);
	$password = clean($_POST['password']);
	
	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
		exit();
	}
	
	//Create 												
	$qry="SELECT * FROM members WHERE (username='$login' AND active='0') AND password='".md5($_POST['password'])."'";
	
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['username'];
			$_SESSION['PRIV'] = $member['priv'];
			$_SESSION['MEM_ID'] = $member['id'];
			$_SESSION['SUPER_ADMIN'] = $member["super_admin"];

			$check = mysql_query("SELECT COUNT(id) as count from members_priv where att_view = 1 and user_id = '$_SESSION[MEM_ID]' ");
			$row = mysql_fetch_array($check);
			$_SESSION["attendance"] = $row["count"];

			$check = mysql_query("SELECT COUNT(id) as count from members_priv where eval_view = 1 and user_id = '$_SESSION[MEM_ID]' ");
			$row = mysql_fetch_array($check);
			$_SESSION["evaluation"] = $row["count"];

			$check = mysql_query("SELECT COUNT(id) as count from members_priv where c_att_view = 1 and user_id = '$_SESSION[MEM_ID]' ");
			$row = mysql_fetch_array($check);
			$_SESSION["coach"] = $row["count"];

			$check = mysql_query("SELECT COUNT(id) as count from members_priv where payments = 1 and user_id = '$_SESSION[MEM_ID]' ");
			$row = mysql_fetch_array($check);
			$_SESSION["payments"] = $row["count"];

			$check = mysql_query("SELECT COUNT(id) as count from members_priv where adjustment = 1 and user_id = '$_SESSION[MEM_ID]' ");
			$row = mysql_fetch_array($check);
			$_SESSION["adjustment"] = $row["count"];
			
			unset($_SESSION['timeout']);
			session_write_close();
			header("location: students.php?type=browse&limit=100");
			exit();
		}else {
			//Login failed
			header("location: login-failed.php");
			exit();
		}
	}else {
		die("Query failed");
	}
?>