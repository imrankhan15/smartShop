<?php
session_start();

if (!isset($_SESSION['username'])){
	header("Location: ..\index.php");
		exit;
}
?>
<?php require_once("..\dbGeneralFunctions.php");?>
<?php
$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
 
 if(!$db_select){
	 die("Database selection failed: ". mysql_error());
 }

?>
<?php
if (isset($_POST['submit'])) { // Form has been submitted.
	
				unset($_SESSION['current_sell_id']);
				unset($_SESSION['current_customer_id']);
				unset($_SESSION['current_store_id']);
				header("Location: itemsell.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
	<title> print_sale</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
	<div>
		
		<h1>Sale Summary Page</h1></br>
		
		
      </form>
		Shop Name: <?php 
			$store_set=get_store_by_id($_SESSION['current_store_id']);
				$store= mysql_fetch_array($store_set);
				echo $store["name"];
		 ?>
		 </br>
		 Shop Address: <?php echo $store["address"];
		 ?>
		 </br>
		 Shop Contact Number: <?php echo $store["contact_number"];
		 ?>
		 </br>
		 Customer Name: <?php 
			$customer_set=get_customer_by_id($_SESSION['current_customer_id']);
				$customer= mysql_fetch_array($customer_set);
				echo $customer["name"];
		 ?>
		 </br>
		 Customer Address: <?php
				echo $customer["address"];
			?>
		</br>
		Customer Contact Number: <?php
			echo $customer["mobile"];
		?>
		 
		
	</div>
	 <div >
		<div >
		<table>
		
				<?php
				
				 $user_id=$_SESSION['userId'];
				 $sale_id=$_SESSION['current_sell_id'];
				$result =mysql_query("SELECT item_id,quantity,price,quantity*price FROM daily_item_sale WHERE userId = {$user_id} AND sell_id = {$sale_id} ",$connection);
				
				if(!$result){
					die("Database query failed: ".mysql_error());
				}
				
				  if( mysql_num_rows($result)>0)
				{
				
					echo "<tr><td>"."ITEM"."</td><td>"."QUANTITY"."</td><td>"."PRICE"."</td><td>"."TOTAL"."</td></tr>";
				
				
					while($row=mysql_fetch_array($result)){
						
						$item_set=get_item_by_id($row["item_id"]);
						$item= mysql_fetch_array($item_set);
						
						echo "<tr><td>".$item['name']."</td><td>".$row['quantity']."</td><td>".$row["price"]."</td><td>".$row[3]."</td></tr>";
					
					}
					
				}
				
				else {
					echo "Sorry, no data yet.";
				 }
				$result_set =mysql_query("SELECT SUM(quantity*price) FROM daily_item_sale WHERE userId = {$user_id} AND sell_id = {$sale_id} ",$connection);
				
				if(!$result_set){
					die("Database query failed: ".mysql_error());
				}
				
				
				  if( mysql_num_rows($result_set)>0)
				  {
					 
									
					  
					  while($row=mysql_fetch_array($result_set)){
						
						echo "<tr><td>GROSS TOTAL</td><td>----</td><td>----</td><td>".$row[0]."</td></tr>";

					  }
					
				 }
				  else {
					echo "Sorry, no data yet.";
				  }
				  $result_set =mysql_query("SELECT SUM(due_amount) FROM daily_item_sale WHERE userId = {$user_id} AND sell_id = {$sale_id} ",$connection);
				
				if(!$result_set){
					die("Database query failed: ".mysql_error());
				}
				
				
				  if( mysql_num_rows($result_set)>0)
				  {
					 
									
					  
					  while($row=mysql_fetch_array($result_set)){
						
						echo "<tr><td>DUE TOTAL</td><td>----</td><td>----</td><td>".$row[0]."</td></tr>";

					  }
					
				 }
				  else {
					echo "Sorry, no data yet.";
				  }
				  $result_set =mysql_query("SELECT SUM(quantity*price-due_amount) FROM daily_item_sale WHERE userId = {$user_id} AND sell_id = {$sale_id} ",$connection);
				
				if(!$result_set){
					die("Database query failed: ".mysql_error());
				}
				
				
				  if( mysql_num_rows($result_set)>0)
				  {
					 
									
					  
					  while($row=mysql_fetch_array($result_set)){
						
						echo "<tr><td>CASH RECEIVED TOTAL</td><td>----</td><td>----</td><td>".$row[0]."</td></tr>";

					  }
					
				 }
				  else {
					echo "Sorry, no data yet.";
				  }
				?>
			    

		</table>
	 </div>
	</div>	
		
		</br>
		</br>
		

    
	THANKS FOR SHOPPING WITH US. WE ARE HAPPY TO SERVE YOU.
	</br>
	<form  method="post" action="print_sale.php" >
        
        <button  type="submit" name="submit">Smart Shops</button>
		</br>
		
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
<?php
	// 5. Close connection
	mysql_close($connection);
?>