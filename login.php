<!DOCTYPE html>
<?php
session_start();session_destroy();
?>

<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" href="bootstrap.min.css">
	<script src="jquery.min.js"></script>
	<script src="bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<style>
		body{
			width:100%;
			height:100%;
			background-image:url('background-3.jpg');
			background-size:cover;
			padding: 15px;
		}
		#one{
			width:100%;
			height:100%;
			background-image:url('background-6.jpg');
			background-position: center;
			background-size:cover;
		}
		.nav-pills > li.active > a, .nav-pills > li.active > a:focus {
			color: black;
			background-color: #810541;
		}
		.nav-pills > li.inactive{
			background-color: #ADD8E6;
			border-radius:5px;
		}

        .nav-pills > li.active > a:hover {
            background-color: #000000;
            color:white;
        }
	</style>
</head>

<body>
<br>
<!--navigation bar-->
<div class="container" id="one">
	<br>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8" align="center"><h2><font color="#FF2400">Old Boy Association - Login</font></h2></div>
		<div class="col-md-2">
			<ul class="nav nav-pills">
				<li><a href="home.php"><span class="glyphicon glyphicon-home" style="color:#FFFFFF"></span><font color="#FFFFFF"> Home</font></a></li>
				<li class="active"><a><span class="glyphicon glyphicon-user"></span> Login</a></li>
			</ul>
		</div>
	</div>
	<br>
</div>

<br><br>

<div class="container">
	<!--login logo-->
	<fieldset>
	<div class="container" align="center" >
		<div>
		<img src="login-3.png" class="img-circle" alt="Cinque Terre" width="176" height="176"> 
		</div>
	</div>
	</fieldset>

	<br><br>

	<!--login form area-->
	<form action="login.php" method="post">
		<div class="row">
			<div class="col-md-4" align="right"><label><font color="#ff0000">Membership ID : </font></label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="memID" placeholder="ex: 123" required></div><div class='col-md-1'><a href="temp_login.php" class="btn btn-info btn-lg" >
          <span class="glyphicon glyphicon-question-sign"></span></a></div>
		</div>
		<div class="row" align="center">
			<div class="col-md-4" align="right"><label><font color="#ff0000">Password : </font></label></div>
			<div class="col-md-4"><input class="form-control" type="password" name="password" placeholder="ex: ****" required></div>
		</div><h6></h6>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4"><input class="form-control" style="background-color:#38ACEC;color:black;" type="submit" value="LOGIN" name="submit"></div>
		</div>
	</form>
</div>

</body>
</html>

<?php
if(isset($_POST["submit"])){
	$error =array();
	if(empty(trim($_POST["memID"]))){
		$error="memID";	
	}
	if(empty(trim($_POST["password"]))){
		$error="password";	
	}
	if(empty($error)){
		session_start();
		require 'connect.php';
		$memID = mysqli_real_escape_string($connect, $_POST['memID']);
		$password = mysqli_real_escape_string($connect, $_POST['password']);
		$query="SELECT * FROM members_login_details WHERE MembershipID='{$memID}' AND Password='{$password}' LIMIT 1";
		if($is_query_run=mysqli_query($connect,$query)){
			if(mysqli_num_rows($is_query_run) == 1){
				$_SESSION['memID']=$_POST["memID"];
				$_SESSION['password']=$_POST["password"];
				//$row =  mysqli_fetch_assoc($is_query_run);
				if($_SESSION['memID']=="reg000"){
					header ("location:reg.php");
				}
				else if($_SESSION['memID']=="sec000"){
					header ("location:sec.php");
				}
				else{
					header ("location:user.php");
				}
			}
			else{ echo '<div class="container">
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<div class="alert alert-danger alert-dismissable">
								<a href="login.php" class="close" data-dismiss="alert" arial-label="close">&times</a>
								<strong>Incorrect username or password</strong></div><br>
							</div>
							<div class="col-md-4"></div>
						</div>
					</div>';
			}
		}
		
	}
}

?>