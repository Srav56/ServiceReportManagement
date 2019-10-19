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
  <title>Home Page</title>
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
				<a class="navlink btn text-light" href="./searchpage.html">View report</a>
			</li> <!--save entries so far?-->
			<li class="navbar-item">
				<a class="navlink btn text-light" href="./login.html">Logout</a>
			</li>
		</ul>
	</nav>
	<div class="container-fluid " style="margin-top:50px">
		<div class="row" style="margin-top:30px">
				<div class="col-sm-12 d-flex justify-content-center">
		  			<a href="./registercomplaint.html" class="btn btn-outline-dark">Register New Complaint</a>
		  		</div>			
		</div>
		<div class="row" style="margin-top:30px">
				<div class="col-sm-12 d-flex justify-content-center">
		  			<a href="./EditReport.html" class="btn btn-outline-dark">Generate Report</a>
		  		</div>			
		</div>
		<div class="row" style="margin-top:30px">
				<div class="col-sm-12 d-flex justify-content-center">
		  			<a href="./searchpage.html" type="registerNewComplaint" class="btn btn-outline-dark"">Search report</a>
		  		</div>			
		</div>		
	</div>
</body>

