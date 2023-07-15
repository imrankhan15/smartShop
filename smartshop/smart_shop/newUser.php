<?php 
session_start();
require("constants.php");


?>
<?php require_once("otherFunctions.php");?>
<?php 

if (isset($_POST['submit'])) { 
		$errors=array();

		 if(!isset($_POST['password'])||empty($_POST['password'])){
			$errors[]='password';
		 }
		 
		  if(!isset($_POST['username'])||empty($_POST['username'])){
			$errors[]='username';
		 }
		 
		 
		  if(!isset($_POST['email'])||empty($_POST['email'])){
			$errors[]='email';
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
				 $username=mysql_prep($_POST['username']);
				 
				 $result =mysql_query("SELECT * FROM login WHERE username = '{$username}'",$connection);
				
				
				
				if(!$result){
					die("Database query failed: ".mysql_error());
				}
				 
				if( mysql_num_rows($result)==1)
				{
					$message="Sorry, this user name already exists ";
				}
				else
				{
					$password=mysql_prep($_POST['password']);

					$hashed_password = sha1($password);
					 $email=mysql_prep($_POST['email']);
					 
					 
					 $join_date=date("Y-m-d");

					 $end_date= mktime(0,0,0,date("m"),date("d")+7,date("Y"));


					$end_date =date("Y-m-d", $end_date);
				 
					$query = "INSERT INTO login (password,username,join_date,last_date,email) VALUES (
							'{$hashed_password}','{$username}','{$join_date}','{$end_date}','{$email}')";
							
					if(mysql_query($query,$connection)){
						header("Location: userSuccess.php");
						exit;
					}
					else{
						$message= "User Creation Failed";
					}
					
				}
				 mysql_close($connection);
				

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
    

    <title>Create a New User</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/signin/signin.css" rel="stylesheet">
<link href = "css/styles.css" rel ="stylesheet">
   
  <style type="text/css"></style></head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" action="newUser.php" >
        <h2 class="form-signin-heading">Be a new User</h2>
		<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
        <input name="username"  class="form-control" placeholder="Username" required="">
       </br>
        <input name="password" type="password" class="form-control" placeholder="Password" required="">
       </br>
	   <input name="email"  class="form-control" placeholder="Email" required="">
       </br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Create</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  

<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
