<?php

	
?>
<!DOCTYPE html>
<html>
	<head>
	<title> Business Mate</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href = "css/bootstrap.min.css" rel="stylesheet">
	<link href = "css/styles.css" rel ="stylesheet">
		
	</head>
	<body>
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<a href="index.php" class="navbar-brand">Business Mate</a>
			
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
		<h1>Business Mate</h1>
		<p>Accounting, Credit Management, Inventory Management</p>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h3>may be you want </h3>
				<p>to view your daily, weekly, monthly and yearly incomes from multlple shared stores</p>
			</div>
			<div class="col-md-4">
				<h3>or you want </h3>
				<p>to view your current customer credits and upcoming payments to give to your supplier ...?  Is any supplier on delay of due date? What amount the supplier has not given on date? What is your upcoming payment date for supplier? What items are corrupt and should be returned?</p>
			</div>
			<div class="col-md-4">
				<h3>or .. </h3>
				<p>you want to see items in inventory everyday. You want to know how many are left after selling today or you may want to keep an eye on one of your other share holder's money withdrawal from shop</p>
			</div>
			<div class="col-md-4">
				<h3>enjoy free trial for first 7 days</h3>
				<p>only $15 for next each month.</p>
			</div>
		</div>
	</div>
	
	
	<script src="jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
