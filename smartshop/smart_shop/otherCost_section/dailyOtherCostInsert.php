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
		$errors[]='storeId';
	 }
	   if($_POST['storeId']==-1){
		$errors[]='storeId';
	 }
	 if(!isset($_POST['cost'])||empty($_POST['cost'])||(intval($_POST['cost'])==0)){
		$errors[]='cost';
	 }
	 if(!isset($_POST['paymentBy'])||empty($_POST['paymentBy'])){
		$errors[]='paymentBy';
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
		 $storeId=mysql_prep($_POST['storeId']);
		 $description=mysql_prep($_POST['description']);
		 $date=date("Y-m-d");
		 $cost=mysql_prep($_POST['cost']);
		 $paid_by=mysql_prep($_POST['paymentBy']);
		  
		  $user_id=$_SESSION['userId'];
		  
		  $query = "INSERT INTO daily_other_cost (store_id,description,cost,paid_by,date,userId) VALUES (
					{$storeId},'{$description}',{$cost},'{$paid_by}','{$date}',{$user_id})";
					
			if(mysql_query($query,$connection)){
				header("Location: ..\success.php");
				exit;
			}
			else{
				$message= "Daily_other_cost_insert Failed";
				//echo mysql_error();
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
		<h1>Enter Other Cost</h1>
		
		</div>
	</div>
	 <div class="container">
		<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
			
		 <form class="form-signin" method="post" action="dailyOtherCostInsert.php">
       
		<p>Select Store: 
		<select name="storeId">
		<option value=-1>Please select a store</option>
		<?php
		$store_set = get_all_stores();
		
		while ($store = mysql_fetch_array($store_set)) {
			
			echo "<option value=".$store["id"].">".$store["name"]."</option>";
			
		}
		
		?>
		
		</select></p>
		</br>
        <input name="description" class="form-control" placeholder="Description" required="" autofocus="">
		</br>
        <input name="cost" class="form-control" placeholder="Cost" required="">
		</br>
		<input name="paymentBy" class="form-control" placeholder="Cash Paid By" required="">
       </br>
	   
	  
	   
		
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Submit</button>
      </form>

   </div>
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>

		