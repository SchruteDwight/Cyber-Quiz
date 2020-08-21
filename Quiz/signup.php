
<?php
session_start();
$salt = 'XyZzy12*_';
    require_once "pdo.php";
    require_once "util.php";

if ( isset($_POST["new_email"]) && isset($_POST["new_password"]) && isset($_POST["new_username"])) 
{
 
 $msg=signup_insert_validate($salt,$conn);

	if(is_string($msg))
	{
		$_SESSION["error"]=$msg;
		header("location:signup.php");
		return;
	}

header("Location: login.php");
 }
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Signup</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/signup.css">
<style type="text/css" media="screen">
	#error{
		font-size: 3rem;
	}
	
</style>
 
</head>
<body >
	
		<nav class="navbar navbar-expand-md navbar-light">

		<a class="navbar-brand mx-auto" href="#">Cyber Quiz </a>
				
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    				<span class="navbar-toggler-icon"></span>
  			</button>



		<div class="collapse navbar-collapse pr-4" id="collapsibleNavbar">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active pr-4">
					<a class="nav-link" href="#home">Home<span class="sr-only">(current)</span></a>
				</li>
				
				<li class="nav-item pr-4">
					<a class="nav-link" href="login.php">Log In</a>
				</li>
				
				<li class="nav-item pr-4">
					<a class="nav-link" href="#gallery">Connect</a>
				</li>
				
				<li class="nav-item pr-4">
					<a class="nav-link"  href="#contact-us">About</a>
				</li>
				
			</ul>
		</div>
			
		</nav>
<div class="main">
	<div class="row">
<div class="col-lg-4 col-md-6  img-fluid">
	<div class="quiz-img">
	<img src="img/quiz-4.svg" alt="">
	</div>
</div>
	

   
  <div class="col-lg-8 col-md-6 col-12">
  <div class="signup-main">
	<div class="signupbox">
			<h1>Sign Up</h1>
			
		<form method="post" autocomplete="off">

			<div class="s_textbox">
				<i class="fa fa-user" aria-hidden="true"></i>
				<input class="s_input" type="text" id="u_name" name="new_username" placeholder="Username" value="">
			</div>
			
			<div class="s_textbox">
				<i class="fa fa-envelope" aria-hidden="true"></i>
				<input class="s_input" type="text" id="email" name="new_email" placeholder="Email" value="">
			</div>

			<div class="s_textbox">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input class="s_input" type="password" id="pwd" name="new_password" placeholder="Password" value="">
			</div>

			<input type="submit" class="btn_signup" name="submit"  value="Register">

				
					<?php

			    if ( isset($_SESSION["error"]) ) {
			        echo('<div><p class="text-capitalize font-weight-bold mt-3 text-center text-danger" id="error_message">'.htmlentities($_SESSION["error"])."</p></div>\n");
			        unset($_SESSION["error"]);
			    }
				?>


				

		</form>
		</div>
	</div>

</div>
</div>
</div>

   
	

</body>
</html>