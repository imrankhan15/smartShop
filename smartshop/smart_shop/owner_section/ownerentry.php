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

	 if(!isset($_POST['name'])||empty($_POST['name'])){
		$errors[]='name';
	 }
	 if(!isset($_POST['percentage'])||empty($_POST['percentage'])){
		$errors[]='percentage';
	 }

	  if(!isset($_POST['storeId'])||empty($_POST['storeId'])){
		$errors[]='storeId';
	 }
	 if($_POST['storeId']==-1){
		$errors[]='storeId';
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
		 
		 $name=mysql_prep($_POST['name']);
		 $percentage=mysql_prep($_POST['percentage']);
		 $storeId=mysql_prep($_POST['storeId']);
		  
		   $user_id=$_SESSION['userId'];
		  
		  $query = "INSERT INTO owner (name,percentage,store_id,userId) VALUES (
					'{$name}',{$percentage},{$storeId},{$user_id}
					)";
					
			if(mysql_query($query,$connection)){
				header("Location: ..\success.php");
				exit;
			}
			else{
				$message = "Owner Creation Failed";
			
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
		<h1>Enter New Owner </h1>
		
		</div>
	</div>
	 <div class="container">
			<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
		<form class="form-signin" method="post" action="ownerentry.php">
        
		
		</br>
        <input name="name" class="form-control" placeholder="Owner Name, Shop Name" required="" autofocus="">
		</br>
        <input name="percentage" class="form-control" placeholder="Owner Percentage(0.01 to .99)" required="">
		</br>
		<p>Select Store: 
		<select name="storeId">
		<option value=-1>Please select a store</option>
		<?php
		$store_set = get_all_stores();
		
		while ($store = mysql_fetch_array($store_set)) {
			
			echo "<option value=".$store["id"].">".$store["name"]."</option>";
			
		}
		
		?>
		
		</select>
		</br>
		</br>
		
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Submit</button>
      </form>
	  
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
