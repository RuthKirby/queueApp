<?php
require_once('phpScripts/connectScript.php');
require('phpScripts/queueScript.php');
?>
<!DOCTYPE html>
<html>
<head> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<!-- Navigation links to the three forms -->
		<a href="citizen.php" class="btn btn-lg btn-info"><span class="glyphicon glyphicon-user"></span> Citizen</a>
		<a href="organisation.php" class="btn btn-lg btn-info"><span class="glyphicon glyphicon-briefcase"></span> Organisation</a>
		<a href="#" class="btn btn-lg btn-info disabled"><span class="glyphicon glyphicon-question-sign"></span> Anonymous</a>
	</div>
	<div class="container">
		<div class="row">
		  <div class="col-sm-6">
			<h2>Book new customer</h2>
			<form class="form-horizontal" name="bookingForm" action="" method="post" >
				<fieldset>

					<!-- The service that the customer needs: radio buttons -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="radios">Services</label>
					  <div class="col-md-4">
					  <div class="radio">
						<label for="radios-0">
						  <input type="radio" name="service" id="radios-0" value="Housing" checked="checked">
						  Housing
						</label>
						</div>
					  <div class="radio">
						<label for="radios-1">
						  <input type="radio" name="service" id="radios-1" value="Benefits">
						  Benefits
						</label>
						</div>
					  <div class="radio">
						<label for="radios-2">
						  <input type="radio" name="service" id="radios-2" value="Council Tax">
						  Council Tax
						</label>
						</div>
					  <div class="radio">
						<label for="radios-3">
						  <input type="radio" name="service" id="radios-3" value="Fly-tipping">
						  Fly-tipping
						</label>
						</div>
					  <div class="radio">
						<label for="radios-4">
						  <input type="radio" name="service" id="radios-4" value="Missed Bin">
						  Missed Bin
						</label>
						</div>
					  </div>
					</div>

					<!-- Clicking will add customer to the queue table in database -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="singlebutton"></label>
					  <div class="col-md-4">
						<button id="singlebutton" name="singlebutton" type="submit" class="btn btn-success">Queue</button>
					  </div>
					</div>

					</fieldset>
			</form>
		  
		  
		  <?php
			if (isset($_POST["service"])) {
				$successInsert = false; 
				$conn = makeConnection();
				$service = $_POST["service"];
				$firstName = "Anonymous";
				$sql = "INSERT INTO Queue (LastName, FirstName, Service, Title, Organisation) VALUES('Anonymous', 'Anonymous', '$service', 'N/A', 'Anonymous')";
				$handle = $conn->prepare($sql);
				$successInsert = $handle->execute();
				
				$conn = null;
		
				if ($successInsert) { //receipt displayed if information is inserted into table successfully
					echo '<div class="alert alert-success"><strong>Success!</strong> ' . $firstName . ' has been added to the queue.</div>';
				}
				
				else {
					echo "Unfortunately, this queuing action has failed, please try again."; //If information is there but cannot be inputted this error message is printed
				}
				
			}
		  
		  ?>
		  </div>
		  <div class="col-sm-6">
			  <h2>Queue</h2>
			  <table class="table-striped table">
				  <tr>
					<th>Position</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Organisation</th>
					<th>Service</th>
				  </tr>
			  <?php
				displayQueue();
			  ?>
			  </table>
			</div>
		</div>
	</div>
</body>