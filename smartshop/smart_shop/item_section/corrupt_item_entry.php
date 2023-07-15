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

	 if(!isset($_POST['itemId'])||empty($_POST['itemId'])){
		$errors[]='itemId';
	 }
	 if(!isset($_POST['supplierId'])||empty($_POST['supplierId'])){
		$errors[]='supplierId';
	 }
	 if(!isset($_POST['description'])||empty($_POST['description'])){
		$errors[]='description';
	 }
	  if($_POST['itemId']==-1){
		$errors[]='itemId';
	 }
	   if($_POST['supplierId']==-1){
		$errors[]='supplierId';
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
		 
		 $item_id=mysql_prep($_POST['itemId']);
		 $supplier_id=mysql_prep($_POST['supplierId']);
		 $description=mysql_prep($_POST['description']);
		  $user_id=$_SESSION['userId'];
		 
		  $query = "INSERT INTO corrupt_item (item_id,supplier_id,description,userId) VALUES (
					{$item_id},{$supplier_id},'{$description}',{$user_id}
					)";
					
			if(mysql_query($query,$connection)){
				header("Location: ..\success.php");
				exit;
			}
			else{
				$message= "Corrupt Item Entry Failed";
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
		<h1>Enter Corrupt Item Details</h1>
		
		</div>
	</div>
	 <div class="container">
		<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
		 <form class="form-signin" method="post" action="corrupt_item_entry.php">
     
		<p>Select Item: 
		<select name="itemId">
		<option value=-1>Please select a Item</option>
		<?php
		$item_set = get_all_items();
		
		while ($item = mysql_fetch_array($item_set)) {
			$store_set=get_store_by_id($item["store_id"]);
				$store= mysql_fetch_array($store_set);
			echo "<option value=".$item["id"].">".$item["name"].",".$store["name"]."</option>";
			
		}
		
		?>
		
		</select></p>
		</br>
	   <p>Select Supplier: 
		<select name="supplierId">
		<option value=-1>Please select a supplier</option>
		<?php
		$supplier_set = get_all_suppliers();
		
		while ($supplier = mysql_fetch_array($supplier_set)) {
			
			echo "<option value=".$supplier["id"].">".$supplier["name"]."</option>";
			
		}
		
		?>
		
		</select></p>
		</br>
		 <input name="description" class="form-control" placeholder="Item Description" required="">
		</br>
		</br>
		
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Submit</button>
      </form>

   
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	
<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
