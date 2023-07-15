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

	 if(!isset($_POST['product_name'])||empty($_POST['product_name'])){
		$errors[]='product_name';
	 }
	  
	 if(!isset($_POST['productQuantity'])||empty($_POST['productQuantity'])||(intval($_POST['productQuantity'])==0)){
		$errors[]='productQuantity';
	 }
	 if(!isset($_POST['productPrice'])||empty($_POST['productPrice'])||(intval($_POST['productPrice'])==0)){
		$errors[]='productPrice';
	 }
	  if(!isset($_POST['paymentBy'])||empty($_POST['paymentBy'])){
		$errors[]='paymentBy';
	 }
	 
	 if(!isset($_POST['schedule'])||empty($_POST['schedule'])){
		$errors[]='schedule';
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
		 $buy_id=$_SESSION['current_buy_id'];
		 $name=mysql_prep($_POST['product_name']);
		  $store_id=$_SESSION['current_store_id'];
		 $date=date("Y-m-d");
		 $supplier_id=$_SESSION['current_supplier_id'];
		 $quantity=mysql_prep($_POST['productQuantity']);
		 $price=mysql_prep($_POST['productPrice']);
		 $paid_by=mysql_prep($_POST['paymentBy']);
		 
		 if(!isset($_POST['due_amount'])||empty($_POST['due_amount'])){
			 $due_amount=0;
		 }
		 else{
			$due_amount=mysql_prep($_POST['due_amount']);
		 }
		 if(!isset($_POST['due_description'])||empty($_POST['due_description'])){
			 $due_description=@""; 
		 }
		 else{
		  $due_description=mysql_prep($_POST['due_description']); 
		 }
		 
		    $user_id=$_SESSION['userId'];
			$schedule=mysql_prep($_POST['schedule']);
		  
				
				
				 $code_name=$name.time();

		   
			 
			   $query = "INSERT INTO item (name,userId,quantity,store_id,buy_price) VALUES (
				'{$code_name}',{$user_id},{$quantity},{$store_id},{$price}
				)";

				if(mysql_query($query,$connection)){
				
					$result =mysql_query("SELECT MAX(id) FROM item WHERE userId = {$user_id} ",$connection);
					
					if(!$result){
						die("Database query failed: ".mysql_error());
					}
					
					  if( mysql_num_rows($result)>0)
					{
						while($row=mysql_fetch_array($result)){
							$item_id=$row[0];
						
							$query = "INSERT INTO daily_item_buy (item_id,buy_id,quantity,price,paid_by,due_amount,due_description,userId,supplier_delivery_schedule) VALUES (
							{$item_id},{$buy_id},{$quantity},{$price},'{$paid_by}',{$due_amount},'{$due_description}',{$user_id},'{$schedule}')";
								
							if(mysql_query($query,$connection)){
								if(isset($_POST['complete'])){
									header("Location: print_buy.php");
								}
							}
							else{
								$message= "Item Buy Failed";
							}
						}
						
						
					}
				}
				else{
					$message= "Item Buy Failed";
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
		<form class="form-signin" method="post" action="itembuyTwo.php">
		 <input name="product_name" class="form-control" placeholder="Product Name" required="" autofocus="">
		</br>
		 <input name="productQuantity" class="form-control" placeholder="Product Quantity" required="">
		</br>
        <input name="productPrice" class="form-control" placeholder="Product Buy Price" required="">
		</br>
		 <input name="paymentBy" class="form-control" placeholder="Payment Given By" required="" >
		</br>
        <input name="due_amount" class="form-control" placeholder="Due Amount, Enter if Exists Only" >
		</br>
		<input name="due_description" class="form-control" placeholder="Due Description, Enter if Exists Only" >
		</br>
			<input name="schedule" class="form-control" placeholder="Supplier Delivery Schedule Description" required="">
       </br>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Add More Product</button>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="complete">Complete</button>
      </form>
   
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>

		
		