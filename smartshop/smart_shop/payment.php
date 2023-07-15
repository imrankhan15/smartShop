<?php
session_start();
require("constants.php");

if (isset($_POST['submit'])) { 

		

		$errors=array();

		 if(!isset($_POST['username'])||empty($_POST['username'])){
			$errors[]='username';
		 }
		 
		  if(!isset($_POST['password'])||empty($_POST['password'])){
			$errors[]='password';
		 }
		 
		 if(!isset($_POST['card'])||empty($_POST['card'])){
			$errors[]='card';
		 }
		 
		  if(!isset($_POST['security'])||empty($_POST['security'])){
			$errors[]='security';
		 }
		  if(!isset($_POST['expMon'])||empty($_POST['expMon'])){
			$errors[]='password';
		 }
		 
		  if(!isset($_POST['expYear'])||empty($_POST['expYear'])){
			$errors[]='security';
		 }
		 if(empty($errors)){
			$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

				if(!$connection){
				 die("Database connection failed: ". mysql_error());
				 
				 }
				 $db_select=mysql_select_db(DB_NAME,$connection);
		 
				 if(!$db_select){
					 die("Database selection failed: ". mysql_error());
				 }
				$username=$_POST['username'];
				$password=$_POST['password'];
				 
				$join_date=date("Y-m-d");

				 $end_date= mktime(0,0,0,date("m"),date("d")+30,date("Y"));
				 $end_date =date("Y-m-d", $end_date);
			 
				$query ="UPDATE login SET
				last_date='{$end_date}'
				
				
				WHERE username='{$username}' AND password='{$password}'";
			
				$result=mysql_query($query,$connection);
				if(mysql_affected_rows()==1){
				
					header("Location: transaction_success.php");//message please try login again.
						exit;
					
				}
				else{
				
					$message = "Update failed<br />
						Please try again.";
					
				}
		
			 
		 
		 }
}
?>

<!DOCTYPE html>
<html>
	<head>
	<title> Home Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href = "css/bootstrap.min.css" rel="stylesheet">
	<link href = "css/styles.css" rel ="stylesheet">
		
	</head>
	<body>
	<div class="container">
		<div class="jumbotron">
		<h1>Please pay for next month premium services</h1>
		
		</br>
		<p>Send your monthly or yearly subscription check by mail in this address</p>
		
		<b>Shatadal, 177, R.S. Road, Reazuddin Bazar, Chittagong-4000, Bangladesh</b>
		</div>
	</div>
	<div class="container">
		<div class="jumbotron">
		
		<p>Or insert your credit card info(We accept only Visa Card Payment)</p>
		<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
			
			<form class="form-signin" method="post" action="dbCreditCardEntry.php">
			<input name="username"  class="form-control" placeholder="Username" required="">
		   </br>
			<input name="password" type="password" class="form-control" placeholder="Password" required="">
		   </br>
			
			<input name="card" class="form-control" placeholder="Card Number" required="" autofocus="">
			</br>
			<input name="security" class="form-control" placeholder="Security Code" required="">
			</br>
			<input name="expMon" class="form-control" placeholder="Expiring Month" required="">
			 </br>
			<input name="expYear" class="form-control" placeholder="Expiring Year" required="">
		   </br>
		   
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Submit</button>
			</br>
		  </form>
		</div>
		
	</div>
	
	
	
	
	
	<script src="jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
<?php
	// 5. Close connection
	mysql_close($connection);
?>
