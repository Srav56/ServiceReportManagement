<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $error="";
  $compid="";
  // Create connection
  $conn = mysqli_connect($servername, $username, $password);

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  mysqli_select_db($conn,'servicereportmanagement');
  
  if (isset($_POST['logout'])) {
      //unset(uname);
      setcookie("uname","",time()-86400*1);
      header("location:login.php");
  }


  if (isset($_POST['submit'])) {
  	# code...
  	$custname=$_POST['customerName'];
  	$custid=$_POST['customerID'];
  	$complaintdate=$_POST['yearofComplaint']."-".$_POST['monthOfComplaint']."-".$_POST['dayOfComplaint'];
  	//echo $complaintdate;
  	$complainttime=$_POST['timeComplaint'];
  	$typecomplaint="";
  	if (isset($_POST['optradio'])) {
  		$typecomplaint=$_POST['optradio'];
  	}
  	//echo $typecomplaint;
  	$compid=rand(0,99999);
  	//while(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM complaint WHERE Comp_id='$compid';"))>=1){
  	//	$compid=rand();
  	//}
  	$sql="INSERT INTO Customer VALUES('$custid','$custname');";
  	if (!mysqli_query($conn,$sql)) {
  		$error="Error carrying out query";
  	}

  	$sql="INSERT INTO Complaint(Comp_id,ReceivedTime,ReceivedDate,Type,Customer_is,Completed) VALUES('$compid','$complainttime','$complaintdate','$typecomplaint','$custid','No');";
  	if (!mysqli_query($conn,$sql)) {
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
				<a class="navlink btn text-light" href="./searchpage">View report</a>
			</li> <!--save entries so far?-->
			<li class="navbar-item">
				<!-- <button class="navlink btn text-light" method="post" action="./homepage.php" name="logout">Logout</button> -->
        		<form class ="" method = "post" action="registercomplaint.php" enctype="multipart/form-data"> 
        			<input type="submit" class="navlink btn text-light" name="logout" value="Logout">
      			</form>
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
		  			
				  		<div class="form-group col-md-5" style="margin-right: 0px">
			  				<label for = "Category">Category of Complaint</label>
				  			<div class="form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="optradio" value="AMC">AMC
								</label>
							</div>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="optradio" value="On Call">On Call
								</label>
							</div>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="optradio" value="Others">Others
								</label>
							</div>
				  		</div>
			  		<h4 class = "messageLine form-group">&nbsp;</h4>
					<div class="col-sm-12">
		  				<input type="submit" class="btn btn-outline-dark" name="submit" value="Submit">
		  			</div>
		  			<div class="col-sm-12">
		  				<label><?php echo $error?></label>
		  			</div>
		  			<div class="col-sm-12">   
		  				<label>Complaint ID (Please remember for future reference):<?php echo $compid?></label>
		  			</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
