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

	 if(!isset($_POST['storeId'])||empty($_POST['storeId'])){
	 
		$errors[]='store_id';
	 }
	 if(!isset($_POST['name'])||empty($_POST['name'])){
		$errors[]='name';
	 }
	 if(!isset($_POST['address'])||empty($_POST['address'])){
		$errors[]='address';
	 }
	  if(!isset($_POST['reason'])||empty($_POST['reason'])){
		$errors[]='reason';
	 }
	  if(!isset($_POST['transaction'])||empty($_POST['transaction'])){
		$errors[]='transaction';
	 }
	 
	  if(!isset($_POST['madeBy'])||empty($_POST['madeBy'])){
		$errors[]='madeBy';
	 }
	 if($_POST['storeId']==-1){
		$errors[]='store_id';
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
			 
			$store_id=mysql_prep($_POST['storeId']);
			$bank_name=mysql_prep($_POST['name']);
			$branch_name=mysql_prep($_POST['address']);

			$date=date("Y-m-d");
			$description=mysql_prep($_POST['reason']);
			$bank_transaction_id=mysql_prep($_POST['transaction']);
		  
			  $transaction_made_by=mysql_prep($_POST['madeBy']);
			  $user_id=$_SESSION['userId'];
		  
			  $query = "INSERT INTO bank_history (store_id,bank_name,branch_name,date,description,bank_transaction_id,transaction_made_by,userId) VALUES (
						{$store_id},'{$bank_name}','{$branch_name}','{$date}','{$description}','{$bank_transaction_id}','{$transaction_made_by}',{$user_id})";
						
				if(mysql_query($query,$connection)){
					header("Location: ..\success.php");
					exit;
				}
				else{
					$message = "Bank_Entry_Creation Failed";
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
		<h1>Enter Bank Transaction Entry</h1>
		
		</div>
	</div>
	 <div class="container">
			<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
		 <form class="form-signin" method="post" action="bankEntry.php">
		
		</br>
        <input name="reason" class="form-control" placeholder="Transaction Reason" required="" autofocus="">
		</br>
        <input name="transaction" class="form-control" placeholder="Bank Transaction No" required="">
		</br>
		<input name="name" class="form-control" placeholder="Bank Name" required="">
       </br>
	   
	   <input name="address" class="form-control" placeholder="Address" required="">
       </br>
	    <input name="madeBy" class="form-control" placeholder="Transaction Made By" required="">
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
		</p></br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Submit</button>
		</br>
      </form>
	</div>	
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
