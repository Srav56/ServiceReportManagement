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
  //echo "Connected successfully";

  if (isset($_COOKIE['uname']) || isset($_SESSION['uname'])) {
      header("location:homepage.php");
  }

  
  mysqli_select_db($conn,'servicereportmanagement');
  if (isset($_POST["submit"])) {
    # code...
    $checkbox=isset($_POST['loggedIn']);
    $uname=$_POST['uname'];
    $pswd=$_POST['pwd'];
    //echo $uname;
    $result=mysqli_query($conn,"SELECT * FROM engineer WHERE Emp_ID='$uname';");
    //echo $result;
    if (mysqli_num_rows($result)) {
      # code...
      $resultarr=mysqli_fetch_assoc($result);
      if ($pswd != $resultarr['Pwd']) {  //consider encryption of password
        # code...
        echo '<script language="javascript">Incorrect Password</script>';
        $error="Incorrect password";
      }
      else{
        $_SESSION['uname']=$uname;
        if($checkbox=="on"){
          setcookie("uname",$uname,time()+86400*30);
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
    <div class="container d-flex justify-content-center">
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
    		<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
    		<div class="valid-feedback">Valid.</div>
    		<div class="invalid-feedback">Please fill out this field.</div>
  		</div>

      <div class="form-check row col-sm-12" style="margin-left:20px">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="loggedIn" value="">Keep me logged in
        </label>  
      </div>
      <label style="margin-right: 25px"><?php echo $error; ?></label>

      <div class="row col-sm-12" style="margin-left:5px">
        <input type="submit" name="submit" class="btn btn-dark" value="Submit">      
      </div>
    </div>
  		
</form>
</body>
</html>
