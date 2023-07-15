<?php

	
?>
<!DOCTYPE html>
<html>
	<head>
	<title> Smart Shops</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href = "css/bootstrap.min.css" rel="stylesheet">
	<link href = "css/styles.css" rel ="stylesheet">
		
	</head>
	<body>
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<a href="index.php" class="navbar-brand">POS Services</a>
			
			<button class ="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
			<span class ="icon-bar"></span>
			<span class ="icon-bar"></span>
			<span class ="icon-bar"></span>
			</button>
			
			<div class="collapse navbar-collapse navHeaderCollapse">
			
			
				<ul class="nav navbar-nav navbar-right">
					<li ><a href ="login.php">Login</a></li>
					
					<li ><a href ="Contact.php">Contact</a></li>
				
				</ul>
			</div>
		</div>
	</div>
	<?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
	<div class="container">
		<div class="jumbotron">
		<h1>Smart Shops</h1>
		<p>User Creation is Successful. Please login Now.</p>
		</div>
	</div>
	
	
	
	
	<script src="jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
