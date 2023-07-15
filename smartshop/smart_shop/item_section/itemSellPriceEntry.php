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

	 if(!isset($_POST['sell_price'])||empty($_POST['sell_price'])){
		$errors[]='name';
	 }
	  if(!isset($_POST['id'])||empty($_POST['id'])){
		$errors[]='id';
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
		 
		 $sell_price=mysql_prep($_POST['sell_price']);
		 $id=mysql_prep($_POST['id']);
		  
		   
		    $query ="UPDATE item SET
					sell_price={$sell_price}
					WHERE id={$id}";
			
			$result=mysql_query($query,$connection);
			if(mysql_affected_rows()==1){
			header("Location: ..\success.php");
				exit;
			}
			else{
			$message= "Update Failed";
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
		<h1>Enter Sell Price For an Item</h1>
		
		</div>
	</div>
	 <div class="container">
		<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
		 <form class="form-signin" method="post" action="itemSellPriceEntry.php">
       
		
		
		</br>
       
		<p>Select Item: 
		<select name="id">
		<option value=-1>Please select a item</option>
		<?php
		$item_set = get_all_items();
		
		while ($item = mysql_fetch_array($item_set)) {
			$store=get_store_by_id($item["store_id"]);
			$store= mysql_fetch_array($store);
			
			echo "<option value=".$item["id"].">".$item["name"]."| buy_price: ".$item["buy_price"]."| store_name: ".$store["name"]."</option>";
			
		}
		
		?>
		
		</select>
		</p></br>
	   <input name="sell_price" class="form-control" placeholder="Item Sell Price" required="" autofocus="">
		</br>
		
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Submit</button>
      </form>

   
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>

		