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

  if (isset($_POST['submit'])) {
  	# code...
  	$custname=$_POST['customerName'];
  	$custid=$_POST['customerID'];
  	$complaintdate=$_POST['yearofComplaint']."-".$_POST['monthOfComplaint']."-".$_POST['dayOfComplaint'];
  	$complainttime=$_POST['timeComplaint'];
  	$respdate=$_POST['yearofResponse']."-".$_POST['monthOfResponse']."-".$_POST['dayOfResponse'];
  	$resptime=$_POST['timeResponse'];
  	$typecomplaint="";
  	if (isset($_POST['radio'])) {
  		$typecomplaint=$_POST['radio'];
  	}
  	$compid=rand();
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
				<a class="navlink btn text-light" href="./homepage.html">Home</a>
			</li>
			<li class="navbar-item">
				<a class="navlink btn text-light" href="#">View report</a>
			</li> <!--save entries so far?-->
			<li class="navbar-item">
				<a class="navlink btn text-light" href="./login.html">Logout</a>
			</li>
		</ul>
	</nav>
	<div class="container-fluid">
		<div class="row">
			<div class = "col-sm-12">
				<form class ="" method = "post" action="registercomplaint.php" enctype="multipart/form-data"> 

					<div class = "row">
						<div class = "form-group col-sm-4 my-sm-3">
							<label for = "customerName">Customer</label>
							<input type="text" class = "form-control form-control-sm" id = "customerName"  placeholder = "Customer Name" name="customerName" required autofocus>
						</div>

						<div class = "form-group col-sm-4 my-sm-3">
							<label for = "customerID">Customer ID</label>
							<input type="text" class = "form-control form-control-sm" id = "customerID"  placeholder = "Customer ID" name="customerID" required>
						</div>
					</div>
		  			<div class = "row" >
		  				<div class="form-group col-sm-2">
		  					<label for = "dateOfBirth">Date of Complaint</label>
		  				</div>
		  				<div class="form-group col-sm-2">
		  					<input type="number" name="dayOfComplaint" id = "dayOfComplaint" class="form-control form-control-sm" placeholder="dd" max = "31" min="1" required>
		  				</div>
		  				<div class="form-group col-sm-2">
		  					<input type="number" name="monthOfComplaint" id = "monthOfComplaint" class="form-control form-control-sm" placeholder="mm" max="12" required>
		  				</div>
		  				<div class="form-group col-sm-3">
		  					<input type="number" name="yearofComplaint" id = "yearofComplaint" class="form-control form-control-sm" placeholder="yyyy" required>
		  				</div>
		  			</div>
		  			<div class="row">
		  				<div class="form-group col-sm-2">
		  					<label for = "timeOfComplaint" required>Time of Complaint</label>
		  				</div>
		  				<div class="form-group my-sm-3">
		  					<input type="time" name="timeComplaint" id="timeComplaint" class="form-control form-control-sm" placeholder="hh:mm:ss (24 hour format)" required>
		  				</div>
		  			</div>
		  			<div class = "row" >
		  				<div class="form-group col-sm-2">
		  					<label for = "dateOfBirth">Date of Response</label>
		  				</div>
		  				<div class="form-group col-sm-2">
		  					<input type="number" name="dayOfResponse" id = "dayOfResponse" class="form-control form-control-sm" placeholder="dd" max = "31" min="1" required>
		  				</div>
		  				<div class="form-group col-sm-2">
		  					<input type="number" name="monthOfResponse" id = "monthOfResponse" class="form-control form-control-sm" placeholder="mm" max="12" required>
		  				</div>
		  				<div class="form-group col-sm-3">
		  					<input type="number" name="yearofResponse" id = "yearofResponse" class="form-control form-control-sm" placeholder="yyyy" required>
		  				</div>
		  			</div>
		  			<div class="row">
		  				<div class="form-group col-sm-2">
		  					<label for = "timeOfResponse">Time of Response</label>
		  				</div>
		  				<div class="form-group my-sm-3">
		  					<input type="time" name="timeResponse" id="timeResponse" class="form-control form-control-sm" placeholder="hh:mm:ss (24 hour format)" required>
		  				</div>
		  			</div>
				  		<div class="form-group col-md-5" style="margin-right: 0px">
			  				<label for = "Category">Category of Complaint</label>
				  			<div class="form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="optradio">AMC
								</label>
							</div>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="optradio">On Call
								</label>
							</div>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="optradio">Others
								</label>
							</div>
				  		</div>
			  		<h4 class = "messageLine form-group">&nbsp;</h4>
					<div class="col-sm-12">
		  				<input type="submit" class="btn btn-outline-dark" name="submit" value="Submit">
		  			</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>