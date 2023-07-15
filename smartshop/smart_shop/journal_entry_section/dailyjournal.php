<?php
session_start();
require("..\constants.php");
if (!isset($_SESSION['username'])){
	header("Location: ..\index.php");
		exit;
}
?>

<?php require_once("..\otherFunctions.php");?>

<?php 

if (isset($_POST['submit'])) {
	$errors=array();

	 if(!isset($_POST['date'])||empty($_POST['date'])){
		$errors[]='date';
	 }
	 
	  if(!isset($_POST['description'])||empty($_POST['description'])){
		$errors[]='description';
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
		 

		 $date=mysql_prep($_POST['date']);
		 $work_description=mysql_prep($_POST['description']);
		  $user_id=$_SESSION['userId'];
		  
		  
		  $query = "INSERT INTO daily_journal (date,work_description,userId) VALUES (
					'{$date}','{$work_description}',{$user_id})";
					
			if(mysql_query($query,$connection)){
				header("Location: ..\success.php");
				exit;
			}
			else{
				$message = "Daily_Journal_Entry Failed";
				
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

<?php include("../includes/header.php"); ?>
	<div class="container">
		<div class="jumbotron">
		<h1>Enter Remainder Notes</h1>
		
		</div>
	</div>
	 <div class="container">
		<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
		<form class="form-signin" method="post" action="dailyjournal.php">
        
        <input name="date" class="form-control" placeholder="Please insert the date as yyyy-mm-dd" required="" autofocus="">
		</br>
        <input name="description" class="form-control" placeholder="Description" required="">
		</br>
		
	   
		
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Submit</button>
      </form>

   </div>
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>


