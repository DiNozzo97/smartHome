
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<title>Login|SmartHouse</title>

	<link href="./css/bootstrap.css" rel="stylesheet">


	<script src="js/bootstrap.js"></script>

	<link href="./css/signin.css" rel="stylesheet">
	<link href="./css/styles.css" rel="stylesheet">

</head>

<body>
	<?php require 'assets/header.php';?>


	<div class="container">

		<form class="form-signin" method="post" action="/assets/processLogin.php">
			<h2 class="form-signin-heading">Please sign in</h2>
			<label for="inputEmail" class="sr-only">Email address</label>
			<input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>

			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		<?php 
		if (isset($_GET["msg"])) {
			switch($_GET["msg"]) {
				case '1':
					echo '<div class="alert alert-danger" role="alert">Incorrect email address and password combination</div>';
					break;
				case '2':
					echo '<div class="alert alert-success" role="alert">You have successfully Signed Out</div>';
					break;
				case '3':
					echo "<div class='alert alert-danger' role='alert'>You are currently not authenticated to access this page. Please login and try again.</div>";
					break;

			}
		}
		?>
		</form>


	</div>

</body>
</html>
