<?php

require_once('../config.php');
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}

	
    function query_to_csv($db_conn, $query, $filename, $attachment = false, $headers = true) {
        
        if($attachment) {
            // send response headers to the browser
            header( 'Content-Type: text/csv' );
            header( 'Content-Disposition: attachment;filename='.$filename);
            $fp = fopen('php://output', 'w');
        } else {
            $fp = fopen($filename, 'w');
        }
        
        
        
		$str ='"Email","First name","Last name"';
		$str .= "\n";
        if($headers) {
            // output header row (if at least one row exists)
            fputs($fp,$str); 
        }
        
		$arr = explode(',', $_POST["student_id"]);
		
		$str_nums ="";
       foreach($arr as $ar)
{

$sql_case="SELECT * from students WHERE id='$ar' ";
$result_case=mysql_query($sql_case);
$row = mysql_fetch_array($result_case);
						
						if($row["status_email"] == 1)
						{
							
							if($row["email"])
							{
								$str='"'.$row["email"].'","'.$row["name"].'",""';
								$str .= "\n";
								$str_nums = $str_nums.$str;
							}
						
						}
						
						
						if($row["father_status_email"] == '1')
						{
							
							if($row["father_email"])
							{
								$str='"'.$row["father_email"].'","'.$row["father"].'",""';
								$str .= "\n";
							$str_nums = $str_nums.$str;	
							}
						
						}
						
						if($row["mother_status_email"] == '1')
						{
							
							if($row["mother_email"])
							{
								$str='"'.$row["mother_email"].'","'.$row["mother"].'",""';
								$str .= "\n";
								$str_nums = $str_nums.$str;
								
							}
						
						}

				

}

        fputs($fp,$str_nums); 
        fclose($fp);
    }

    // Using the function
    $sql = "SELECT * FROM students";
    // $db_conn should be a valid db handle

    // output as an attachment
    query_to_csv($db, $sql, "test.csv", true);

    // output to file system
    query_to_csv($db, $sql, "test.csv", false);
?>