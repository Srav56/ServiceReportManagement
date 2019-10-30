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


  if (isset($_POST['Search'])) {
  	# code...
  	  $reportid=$_POST['reportid'];
  	
  	  $sql="SELECT Report_id, Emp_id, Work_Done from report where Report_id = '$reportid';";
  	  if (!mysqli_query($conn,$sql)) {
  	      $error="Invalid entry!!";
  	  }
  	  $result = $conn->query($sql);

	  if ($result->num_rows > 0) {
    	  while($row = $result->fetch_assoc())
      	      echo "Report ID: " . $row["Report_id"]. " - Employee ID: " . $row["Emp_id"]. " - Work Done: " . $row["Work_Done"]. "<br>";
      } 
	  else {
      echo "0 results";
	  }
	  $conn->close();

  	
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
				<a class="navlink btn text-light" href="./searchpage.html">View report</a>
			</li> <!--save entries so far?-->
			<li class="navbar-item">
				<a class="navlink btn text-light" href="./login.html">Logout</a>
			</li>
		</ul>
	</nav>	
	<div class="container-fluid d-flex justify-content-center">
		<div class="input-group col-sm-6" style="margin-top:50px">
    		<input type="text" id="reportid" class="form-control" placeholder="Search">
    		<div class="input-group-append">
    			<button class="btn btn-dark" onclick="" type="button">Search</button>
    		</div>
		</div>
 	</div>

</body>
</html>
