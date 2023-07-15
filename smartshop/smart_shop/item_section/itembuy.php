<?php
session_start();

if (!isset($_SESSION['username'])){
	header("Location: ..\index.php");
		exit;
}
?>
<?php include("..\dbGeneralFunctions.php"); ?>

<?php 
if (isset($_POST['submit'])||isset($_POST['complete'])) {
	$errors=array();

	 
	  if(!isset($_POST['storeId'])||empty($_POST['storeId'])){
		$errors[]='storeId';
	 }
	 if(!isset($_POST['supplierId'])||empty($_POST['supplierId'])){
		$errors[]='supplierId';
	 }

	  if($_POST['storeId']==-1){
		$errors[]='store_id';
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
		 
		
		  $store_id=mysql_prep($_POST['storeId']);
		 $date=date("Y-m-d");
		 $supplier_id=mysql_prep($_POST['supplierId']);
		
		 $user_id=$_SESSION['userId'];
			
			$query = "INSERT INTO buy (supplier_id,date,store_id,userId) VALUES (
						{$supplier_id},'{$date}',{$store_id},{$user_id})";

			if(mysql_query($query,$connection)){
				
					$user_id=$_SESSION['userId'];
					 
					$result =mysql_query("SELECT MAX(id) FROM buy WHERE userId = {$user_id} ",$connection);
					
					if(!$result){
						die("Database query failed: ".mysql_error());
					}
					
					  if( mysql_num_rows($result)>0)
					{
						while($row=mysql_fetch_array($result)){
							$current_buy_id=$row[0];
							$_SESSION['current_buy_id']=$current_buy_id;
							$_SESSION['current_store_id']=$store_id;
							$_SESSION['current_supplier_id']=$supplier_id;
							header("Location: itembuyTwo.php");
						}
					
					}
				
				}
				else{
					$message= "Buy Failed";
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
		<h1>Buy Item From Supplier </h1>
		
		</div>
	</div>
	 <div class="container">
	 <?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
		<form class="form-signin" method="post" action="itembuy.php">
		
        
		
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
		
		
	
       <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Add Products</button>
       
      </form>
	 
   
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>

		
		