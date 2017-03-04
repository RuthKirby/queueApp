<?php

/** Function responsible for connection to database**/
function makeConnection(){
	
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));	
	$host = $url["host"];
	$dbname = substr($url["path"], 1);
	$user = $url["user"];
	$pwd = $url["pass"];
	try {
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if ($conn) {
			//echo 'Connected to '.$dbname;
		} 
		
		else {
			echo 'Failed to connect';
		}
	} 
	
	catch (PDOException $e) {
		echo "PDOException: ".$e->getMessage();
	}
	return $conn;
		
}
	
	
	
?>