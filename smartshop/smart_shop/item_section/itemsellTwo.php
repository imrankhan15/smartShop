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

	 if(!isset($_POST['id'])||empty($_POST['id'])){
		$errors[]='id';
	 }
	 
	   if($_POST['id']==-1){
		$errors[]='id';
	 }
	  
	  if(!isset($_POST['productQuantity'])||empty($_POST['productQuantity'])||(intval($_POST['productQuantity'])==0)){
		$errors[]='productQuantity';
	 }
	
	  if(!isset($_POST['sold_by'])||empty($_POST['sold_by'])){
		$errors[]='paymentBy';
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
		 
		 $item_id=mysql_prep($_POST['id']);
		
		  $sell_id=mysql_prep( $_SESSION['current_sell_id']);
		  
		 $customer_id=mysql_prep( $_SESSION['current_customer_id']);
		  $store_id=mysql_prep( $_SESSION['current_store_id']);
		 $quantity=mysql_prep($_POST['productQuantity']);
		 
		 $item_set=get_item_by_id($item_id);
				$item= mysql_fetch_array($item_set);
				
		  $price=mysql_prep($item['sell_price']);
		  $sold_by=mysql_prep($_POST['sold_by']);
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
	  
				 $query= "SELECT * ";
				  $query .= "FROM item ";
				  $query .= "WHERE id = {$item_id} AND store_id = {$store_id} ";
			  
			  $result_set= mysql_query($query,$connection);
				if( mysql_num_rows($result_set)>0)
				{
				
				   $result=mysql_fetch_array($result_set);
				   $new_amount=$result["quantity"]-$quantity;
				   
				   if($new_amount<0){
				   header("Location: no_item.php");
						exit;
				   }
				   
				   else {
				   
						$query = "INSERT INTO daily_item_sale (item_id,sell_id,quantity,price,sold_by,due_amount,due_description,userId) VALUES (
						{$item_id},{$sell_id},{$quantity},{$price},'{$sold_by}',{$due_amount},'{$due_description}',{$user_id})";

						if(mysql_query($query,$connection)){
							 $query ="UPDATE item SET
								quantity={$new_amount}
								
								WHERE id={$item_id} AND store_id = {$store_id}";
						
								$result=mysql_query($query,$connection);
								if(mysql_affected_rows()==1){
									if (isset($_POST['complete'])) {

										header("Location: print_sale.php");
									} 
								}
								else{
									$message= "Daily_item_sale Failed";
								}
						}
						else{
									$message= "Daily_item_sale Failed";
								}
						
				   }
			   }
			   else{
			   header("Location: no_item.php");
					exit;
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
		<h1>Sell Item To Customer </h1>
		
		</div>
	</div>
	 <div class="container">
			<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
			
		<form class="form-signin" method="post" action="itemsellTwo.php">
		
        
		
		<p>Select Product: 
		<select name="id">
		<option value=-1>Please select a Product</option>
		<?php
		$store_id=mysql_prep( $_SESSION['current_store_id']);
		$item_set = get_items_by_store_id($store_id);
		
		while ($item = mysql_fetch_array($item_set)) {
			
			echo "<option value=".$item["id"].">".$item["name"]." , default price: ".$item["sell_price"]." , available quantity: ".$item["quantity"]."</option>";
			
		}
		
		?>
		
		</select></p>
		</br>
		
	
		
		</br>
        <input name="productQuantity" class="form-control" placeholder="Product Quantity" required="" autofocus="">
		</br>
       
		 <input name="sold_by" class="form-control" placeholder="Sold By" required="" autofocus="">
		</br>
        <input name="due_amount" class="form-control" placeholder="Due Amount, Enter if Exists Only" >
		</br>
		<input name="due_description" class="form-control" placeholder="Due Description, Enter if Exists Only" >
		</br>
		
		
	   
		
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Add More Product</button>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="complete">Complete</button>
		</br>
      </form>
	  
		
   
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
