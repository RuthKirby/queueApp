<?php
require_once('phpScripts/connectScript.php');
/** Function responsible for displaying those in the queue**/
function displayQueue() {
	
	$conn = makeConnection();
		$sql = "SELECT * FROM Queue;";
		$handle = $conn->prepare($sql);
		$handle->execute();
		$conn = null;
		$res = $handle->fetchAll();
		$queuePosition = 1;
		
		foreach($res as $row) {
			echo '<tr><td>' . $queuePosition . '</td><td>' 
			. $row['FirstName'] . '</td><td>' 
			. $row['LastName'] . '</td><td>' 
			. $row['Organisation'] . '</td><td>' 
			. $row['Service'] . '</td></tr>';
			++$queuePosition;
		}
	
}
				
?>