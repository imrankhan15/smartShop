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

	if(!isset($_POST['id'])||empty($_POST['id'])){
	 
		$errors[]='id';
	 }
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
		$row_id=mysql_prep($_POST['id']);
		echo $row_id;

		 $store_id=mysql_prep($_POST['storeId']);
		echo $store_id;

		$bank_name=mysql_prep($_POST['name']);
		echo $bank_name;
		$branch_name=mysql_prep($_POST['address']);
		echo $branch_name;
		$description=mysql_prep($_POST['reason']);
		echo $description;
		 $bank_transaction_id=mysql_prep($_POST['transaction']);
		  echo $bank_transaction_id;
		  $transaction_made_by=mysql_prep($_POST['madeBy']);
		  echo $transaction_made_by;
		   $query ="UPDATE bank_history SET
					store_id={$store_id},
					bank_name='{$bank_name}',
					branch_name='{$branch_name}',
					description='{$description}',
					bank_transaction_id='{$bank_transaction_id}',
					transaction_made_by='{$transaction_made_by}'
					WHERE id={$row_id}";
			
			$result=mysql_query($query,$connection);
			if(mysql_affected_rows()==1){
			header("Location: ..\success.php");
				exit;
			}
			else{
			
			$message = "Update Failed.";
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
		<h1>Update Bank Transaction Entry</h1>
		<?php
		$bank_entry_id=$_GET["id"];
		$entry_set=get_bankEntry_by_id($bank_entry_id);
				$entry= mysql_fetch_array($entry_set);
		?>
		</div>
	</div>
	 <div class="container">
	 
		 <form class="form-signin" method="post" action="bankentryupdate.php">
		<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
		
		<input name="id" class="form-control" type=hidden  value="<?php echo $_GET["id"]?>">
		</br>
        <input name="reason" class="form-control" placeholder="Transaction Reason" required="" autofocus="" value="<?php echo $entry["description"]?>">
		</br>
        <input name="transaction" class="form-control" placeholder="Bank Transaction No" required="" value="<?php echo $entry["bank_transaction_id"]?>">
		</br>
		<input name="name" class="form-control" placeholder="Bank Name" required="" value="<?php echo $entry["bank_name"]?>">
       </br>
	   
	   <input name="address" class="form-control" placeholder="Address" required="" value="<?php echo $entry["branch_name"]?>">
       </br>
	    <input name="madeBy" class="form-control" placeholder="Transaction Made By" required="" value="<?php echo $entry["transaction_made_by"]?>">
       </br>
	   
		<p>Select Store: 
		<?php
		$store_set=get_store_by_id($entry["store_id"]);
				$store= mysql_fetch_array($store_set);?>
				
				
		<select name="storeId">
		<option value="<?php echo $entry["store_id"]?>"><?php echo $store["name"]?></option>
		<?php
		$store_set = get_all_stores();
		
		while ($store = mysql_fetch_array($store_set)) {
			
			echo "<option value=".$store["id"].">".$store["name"]."</option>";
			
		}
		
		?>
		
		</select>
		</p></br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Update</button>
		</br>
      </form>
	</div>	
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
