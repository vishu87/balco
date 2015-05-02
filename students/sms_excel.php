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
        
        
        
		$str ='"Title","First name","Middle name","Last name","Suffix","Job title","Company","Birthday","SIP address","Push-to-talk","Share view","User ID","Notes","General mobile","General phone","General e-mail","General fax","General video call","General web address","General VOIP address","General P.O.Box","General extension","General street","General postal/ZIP code","General city","General state/province","General country/region","Home mobile","Home phone","Home e-mail","Home fax","Home video call","Home web address","Home VOIP address","Home P.O.Box","Home extension","Home street","Home postal/ZIP code","Home city","Home state/province","Home country/region","Business mobile","Business phone","Business e-mail","Business fax","Business video call","Business web address","Business VOIP address","Business P.O.Box","Business extension","Business street","Business postal/ZIP code","Business city","Business state/province","Business country/region",""';
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
						
						if($row["status_mob"] == 1)
						{
							
							if($row["mobile"])
							{
								$str='"","'.$row["name"].'","","","","","","","","","","","","'.$row["mobile"].'","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","",""';
								$str .= "\n";
								$str_nums = $str_nums.$str;
							}
						
						}
						
						
						if($row["father_status_mob"] == '1')
						{
							
							if($row["father_mob"])
							{
								$str='"","'.$row["father"].'","","","","","","","","","","","","'.$row["father_mob"].'","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","",""';
								$str .= "\n";
							$str_nums = $str_nums.$str;	
							}
						
						}
						
						if($row["mother_status_mob"] == '1')
						{
							
							if($row["mother_mob"])
							{
								$str='"","'.$row["mother"].'","","","","","","","","","","","","'.$row["mother_mob"].'","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","",""';
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