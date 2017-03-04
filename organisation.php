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
		<a href="#" class="btn btn-lg btn-info disabled" aria-disabled="true"><span class="glyphicon glyphicon-briefcase"></span> Organisation</a>
		<a href="anonymous.php" class="btn btn-lg btn-info"><span class="glyphicon glyphicon-question-sign"></span> Anonymous</a>
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

					<!-- Titles: radio buttons -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="radios2">Title</label>
					  <div class="col-md-4"> 
						<label class="radio-inline" for="radios-0">
						  <input type="radio" name="title" id="radios2-0" value="Miss." checked="checked">
						  Miss.
						</label> 
						<label class="radio-inline" for="radios-1">
						  <input type="radio" name="title" id="radios2-1" value="Ms">
						  Ms.
						</label> 
						<label class="radio-inline" for="radios-2">
						  <input type="radio" name="title" id="radios2-2" value="Mrs">
						  Mrs.
						</label> 
						<label class="radio-inline" for="radios-3">
						  <input type="radio" name="title" id="radios2-3" value="Mr.">
						  Mr.
						</label>
					  </div>
					</div>

					<!-- First name textbox -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="textinput">First Name</label>  
					  <div class="col-md-4">
					  <input id="firstName" name="firstName" type="text" placeholder="Jon" class="form-control input-md" required="">
						
					  </div>
					</div>
					
					<!-- Last name textbox-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="textinput">Last Name</label>  
					  <div class="col-md-4">
					  <input id="lastName" name="lastName" type="text" placeholder="Snow" class="form-control input-md" required="">
						
					  </div>
					</div>
					
					<!-- Name of the organisation textbox-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="textinput">Organisation</label>  
					  <div class="col-md-4">
					  <input id="organisation" name="organisation" type="text" placeholder="Lord of Winterfell" class="form-control input-md" required="">
						
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
			if (isset($_POST["firstName"], $_POST["lastName"], $_POST["service"], $_POST["title"], $_POST['organisation'])) {
				$successInsert = false; 
				$conn = makeConnection();
				$firstName = $_POST["firstName"];
				$lastName = $_POST["lastName"];
				$service = $_POST["service"];
				$title = $_POST["title"];
				$organisation = $_POST["organisation"];
				
				$sql = "INSERT INTO Queue (LastName, FirstName, Service, Title, Organisation) VALUES('$lastName', '$firstName', '$service', '$title', '$organisation')";
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