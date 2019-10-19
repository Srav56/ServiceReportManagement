<?php
  $servername = "localhost";
  $username = "root";
  $password = "";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password);

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  //echo "Connected successfully";

  if (isset($_COOKIE['uname']) || isset($_SESSION['uname'])) {
      header("location:homepage.php");
  }

  

  if (isset($_POST["submit"])) {
    # code...
    $checkbox=isset($_POST['loggedIn']);
    $uname=$_POST["uname"];
    $pswd=$_POST['pwd'];
    $result=mysqli_query($conn,"SELECT * FROM Engineer WHERE EmpID='$uname'");
    if (mysqli_num_rows($result)>=1) {
      # code...
      $resultarr=mysqli_fetch_assoc($result);
      if ($pswd != $resultarr["pwd"]) {  //consider encryption of password
        # code...
        $error="Incorrect password";
      }
      else{
        $_SESSION['uname']=$uname;
        if($checkbox=="on"){
          setcookie("uname",$uname,86400*30);
        }
        header("location:homepage.php");
      }
    }
    else{
      $error="Incorrect Username";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="jumbotron jumbotron-fluid bg-dark text-light">
    <div class="container">
      <h1>Service Report Management System</h1>
    </div>
  </div>
	<form action="./login.php" method="post" class="was-validated">
 		 <div class="form-group col-sm-12">
    		<label for="uname">Username:</label>
    		<input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
    		<div class="valid-feedback">Valid.</div>
    		<div class="invalid-feedback">Please fill out this field.</div>
  		</div>
  		<div class="form-group col-sm-12">
		    <label for="pwd">Password:</label>
    		<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
    		<div class="valid-feedback">Valid.</div>
    		<div class="invalid-feedback">Please fill out this field.</div>
  		</div>

      <input type="checkbox" name="loggedIn">
      <label>Keep me logged in</label>

      <input type="submit" name="submit" value="Submit">      
	 	</div>
  		
</form>
</body>
</html>
