<?php
session_start();

if (!isset($_SESSION['username'])){
	header("Location: ..\index.php");
		exit;
}
?>

<?php include("..\dbGeneralFunctions.php"); ?>

<?php 
if (isset($_POST['submit'])) {
	$errors=array();

	 if(!isset($_POST['staffId'])||empty($_POST['staffId'])){
		$errors[]='staffId';
	 }
	  if($_POST['staffId']==-1){
		$errors[]='staffId';
	 }
	 if(!isset($_POST['report'])||empty($_POST['report'])){
		$errors[]='report';
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
		 



		 $staff_id=mysql_prep($_POST['staffId']);
		  $date=date("Y-m-d");
		  $staff_report=mysql_prep($_POST['report']);
		  $user_id=$_SESSION['userId'];
		  
		  $query = "INSERT INTO staff_daily_history (date,staff_id,staff_report,userId) VALUES (
					'{$date}','{$staff_id}','{$staff_report}',{$user_id})";
					
			if(mysql_query($query,$connection)){
				header("Location: ..\success.php");
				exit;
			}
			else{
				$message= "Staff_History_Entry Failed";
			
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
	  <?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
		<?php if (!empty($errors)) { display_errors($errors); } ?>
		 <form class="form-signin" method="post" action="stuffDailyHistory.php">
        <h2 class="form-signin-heading">Enter Staff History Details</h2>
		
		</br>
	
		 <p>Select Staff: 
					<select name="staffId">
					<option value=-1>Please select a staff</option>
					<?php
					$staff_set = get_all_staffs();
					
					while ($staff = mysql_fetch_array($staff_set)) {
						
						echo "<option value=".$staff["id"].">".$staff["name"]."</option>";
						
					}
					
					?>
					
					</select>
				</p>
        
		</br>
        <input name="report" class="form-control" placeholder="Staff Today's Report" required="">
		</br>
		
		
		 <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Submit</button>
      </form>

   </div>
   </div>
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
