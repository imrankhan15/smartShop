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


  if($_POST['ownerId']==-1){
	$errors[]='ownerId';
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
		 
		 $owner_id=mysql_prep($_POST['ownerId']);
		 $amount=mysql_prep($_POST['amount']*$_POST['type']);
		 $description=mysql_prep($_POST['description']);
		 
		  $date=date("Y-m-d");
		   $user_id=$_SESSION['userId'];
		   
		  
		  $query = "INSERT INTO owner_history (owner_id,amount,description,date,userId) VALUES (
					{$owner_id},{$amount},'{$description}','{$date}',{$user_id}
					)";
					
			if(mysql_query($query,$connection)){
				header("Location: ..\success.php");
				exit;
			}
			else{
				$message= "Transactin Entry for Owner Failed";
			
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
		<h1>Enter New Owner Transaction</h1>
		
		</div>
	</div>
	 <div class="container">
		<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
		<?php if (!empty($errors)) { display_errors($errors); } ?>
		
		<form class="form-signin" method="post" action="ownerTransactionEntry.php">
        
		
		</br>
       
		<p>Select owner: 
		<select name="ownerId">
		<option value=-1>Please select a owner</option>
		<?php
		$owner_set = get_all_owners();
		
		while ($owner = mysql_fetch_array($owner_set)) {
			$store_set=get_store_by_id($owner["store_id"]);
				$store= mysql_fetch_array($store_set);
			echo "<option value=".$owner["id"].">".$owner["name"].",".$store["name"]."</option>";
			
		}
		
		?>
		
		</select>
		</p>
		</br>
	
		 <input name="amount" class="form-control" placeholder="Amount" required="" autofocus="">
		</br>
		<p>Select Type: 
		<select name="type">
		<option value=-1>Please select a type</option>
			<option value=-1>WithDrawal</option>
			<option value=1>Funding</option>
		</select>
		</p>
		</br>
        <input name="description" class="form-control" placeholder="description of funding or withdrawal" required="">
		</br>
	
		
		
       
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Submit</button>
      </form>
	  
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
