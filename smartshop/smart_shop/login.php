<?php 
session_start();
require("constants.php");


if (isset($_POST['submit'])) { // Form has been submitted.

	$errors=array();

	 if(!isset($_POST['password'])||empty($_POST['password'])){
		$errors[]='password';
	 }
	 
	  if(!isset($_POST['username'])||empty($_POST['username'])){
		$errors[]='username';
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
		 

		 $password=$_POST['password'];
		 $username=$_POST['username'];
		  $hashed_password = sha1($password);
		  $query = "SELECT * ";
		  $query .= "FROM login ";
		  $query .="WHERE password = '{$hashed_password}' ";
		  $query .="AND username = '{$username}'";
		  $query .="LIMIT 1";
		  
		  $result_set = mysql_query($query,$connection);
				
				
				
		if(mysql_num_rows($result_set)==1){
			$found_user=mysql_fetch_array($result_set);
			 $today=date("Y-m-d");
			 $last_date=$found_user['last_date'];
			 
			 if($last_date<$today)
			 {
			 header("Location: payment.php");
			exit;
			 }
			 else{
			 $_SESSION['userId']=$found_user['id'];
			
			$_SESSION['username']=$username;
			header("Location: homePage.php");
			exit;
			 }
			
		}
		else{
		// username/password combo was not found in the database
					$message = "Username/password combination incorrect.<br />
						Please make sure your caps lock key is off and try again.";
			
		}
	 }
	 else{
		if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
	 }
	 
	 
}

?>

<!DOCTYPE html>
<!-- saved from url=(0040)http://getbootstrap.com/examples/signin/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>Sign IN</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href = "css/styles.css" rel ="stylesheet">
    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/signin/signin.css" rel="stylesheet">

   
  <style type="text/css"></style></head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" action="login.php" >
        <h2 class="form-signin-heading">Please sign in</h2>
		<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
        <input name="username"  class="form-control" placeholder="Username" required="">
       </br>
        <input name="password" type="password" class="form-control" placeholder="Password" required="">
       </br>
	   
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
		</br>
		<a href="newUser.php">Create a New User</a>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  

<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
