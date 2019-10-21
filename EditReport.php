<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $error="";
  // Create connection
  $conn = mysqli_connect($servername, $username, $password);

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  if (isset($_POST['logout'])) {
      //unset(uname);
      setcookie("uname","",time()-86400*1);
      header("location:login.php");
  }


  if (isset($_POST['submit'])) {
  	# code...
  	$enggfname=$_POST['FirstName'];
  	$engglname=$_POST['LastName'];
  	$empid=$_POST['EngineerID'];
  	$compid=$_POST['ComplaintID'];
  	$complaintdate=$_POST['yearofCompletion']."-".$_POST['monthOfCompletion']."-".$_POST['dayOfCompletion'];
  	$complainttime=$_POST['timeCompletion'];
  	$completed="";
  	if (isset($_POST['radio'])) {
  		$completed=$_POST['radio'];
  	}
  	
  	while(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM Complaint WHERE compid='$compid';"))>=1){
  		$compid=rand();
  	}
  	$sql="INSERT INTO Customer VALUES('$custid','$custname');";
  	$sql.="INSERT INTO Complaint() VALUES('$compid','$complaintdate','$complainttime','$respdate','$resptime','$typecomplaint');";
  	if (!mysqli_multi_query($conn,$sql)) {
  		$error="Error carrying out query";
  	}
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register complaint</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		<ul class="navbar-nav">
			<li class="navbar-item active">
				<a class="navlink btn text-light" href="./homepage.php">Home</a>
			</li>
			<li class="navbar-item">
				<a class="navlink btn text-light" href="./searchpage.php">View report</a>
			</li> <!--save entries so far?-->
			<li class="navbar-item">
				<!-- <button class="navlink btn text-light" method="post" action="./homepage.php" name="logout">Logout</button> -->
        		<form class ="" method = "post" action=EditReport.php" enctype="multipart/form-data"> 
        			<input type="submit" class="navlink btn text-light" name="logout" value="Logout">
      			</form>
			</li>
		</ul>
	</nav>
	<div class="container-fluid">

		<div class="row">	
			<div class = "form-group col-sm-3 my-sm-3">
				<label for = "FirstName">Engineer First Name</label>
				<input type="text" class = "form-control form-control-sm" id = "FirstName"  placeholder = "First Name" name="FirstName" required>
			</div>
			<div class = "form-group col-sm-3 my-sm-3">
				<label for = "LastName">Engineer Last Name</label>
				<input type="text" class = "form-control form-control-sm" id = "LastName"  placeholder = "Last Name" name="FirstName" required>

			</div>
			<div class = "form-group col-sm-3 my-sm-3">
				<label for = "EngineerID">Engineer ID</label>
				<input type="text" class = "form-control form-control-sm" id = "EngineerID"  placeholder = "EngineerID" name="EngineerID" required>
			</div>
			<div class = "form-group col-sm-3 my-sm-3">
				<label for = "ComplaintID">Complaint ID</label>
				<input type="text" class = "form-control form-control-sm" id = "ComplaintID"  placeholder = "Complaint ID" name="ComplaintID" required>
			</div>
		</div>
					
		<div class="row">
			<div class = "col-sm-12">
				<form class = "" method = "post" action="echo.php" enctype="multipart/form-data"> 
					<label for="MachineDetails" class="bg-dark text-light col-sm-12">Provide the following details about the machine</label>
					<div class="row">	
						<div class = "form-group col-sm-4 my-sm-3">
							<label for = "Unit">Unit</label>
							<input type="text" class = "form-control form-control-sm" id = "Unit"  placeholder = "Machine unit" name="Unit" required>
						</div>
						<div class = "form-group col-sm-4 my-sm-3">
							<label for = "makeAndModel">Make and Model</label>
							<input type="text" class = "form-control form-control-sm" id = "makeAndModel"  placeholder = "Make and Model" name="makeAndModel" required>
						</div>
						<div class = "form-group col-sm-4 my-sm-3">
							<label for = "slNo">Sl. No.</label>
							<input type="text" class = "form-control form-control-sm" id = "slNo"  placeholder = "Serial Number" name="slNo" required>
						</div>
					</div>
					<label for="CallDetails" class="bg-dark text-light col-sm-12">Provide the following details about the call</label>
		  			<div class = "row" >
		  				<div class="form-group col-sm-2">
		  					<label for = "dateOfBirth">Date of Call Completion</label>
		  				</div>
		  				<div class="form-group col-sm-2">
		  					<input type="number" name="dayOfCompletion" id = "dayOfCompletion" class="form-control form-control-sm" placeholder="dd" max = "31" min="1">
		  				</div>
		  				<div class="form-group col-sm-2">
		  					<input type="number" name="monthOfCompletion" id = "monthOfCompletion" class="form-control form-control-sm" placeholder="mm" max="12">
		  				</div>
		  				<div class="form-group col-sm-3">
		  					<input type="number" name="yearofCompletion" id = "yearofCompletion" class="form-control form-control-sm" placeholder="yyyy">
		  				</div>
		  			</div>
		  			<div class="row">
		  				<div class="form-group col-sm-2">
		  					<label for = "timeOfCompletion">Time of Completion</label>
		  				</div>
		  				<div class="form-group col-sm-2 my-sm-3">
		  					<input type="time" name="timeCompletion" id="timeCompletion" class="form-control form-control-sm" placeholder="hh:mm:ss (24 hour format)">
		  				</div>
		  			</div>

					<div class="row">
				  		<div class="form-group col-md-5">
			  				<label for = "Category">Call Completed</label>
				  			<div class="form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="optradio">Yes
								</label>
							</div>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="optradio">No
								</label>
							</div>
				  		</div>
				  		

				  	</div>
				  	<label for="WorkDetails" class="bg-dark text-light col-sm-12">Provide the following details about the work done</label>
				  	<div class="row">
				  		<div class="form-group col-sm-12 my-sm-6">
				  			<label for = "problemReported">Reported problem</label>
				  			<textarea class = "form-control form-control-sm" id = "problemReported" rows = "2"></textarea>
				  		</div>
			  		</div>
			  		<div class="row">
			  			<div class="form-group col-sm-8 my-sm-6">
			  				<label for = "sparesRequired">Spares Required</label>
			  				<input type="text" class = "form-control form-control-sm" id = "slNoSpares" name="slNoSpares">

			  				<textarea class = "form-control form-control-sm" id = "sparesRequired" rows = "2" placeholder="Description"></textarea>
			  			</div>

				  		<div class="form-group col-sm-8 my-sm-4">
				  			<label for = "workDone">Work Done</label>
				  			<textarea class = "form-control form-control-sm" id = "workDone" rows = "2"></textarea>
				  		</div>
			  		</div>
			  		<div class="row">
				  		<div class="form-group col-sm-8 my-sm-4">
				  			<label for = "sparesReplaced">Spares Replaced</label>
			  				<textarea class = "form-control form-control-sm" id = "sparesReplaced" rows = "2"></textarea>
			  			</div>
			  		</div>
			  		<h4 class = "messageLine form-group">&nbsp;</h4>
					<div class="row">
						<div class="col-sm-6">
		  					<a href="./homepage.html" class="btn btn-outline-dark"">Save</a>
		  				</div>
						<div class="col-sm-6">
		  					<a href="./homepage.html" class="btn btn-outline-dark"">Submit</a>
		  				</div>
		  				
		  			</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
