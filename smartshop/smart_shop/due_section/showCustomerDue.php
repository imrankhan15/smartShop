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
 <?php include("../includes/header.php"); ?>
	<div class="container">
		<div class="jumbotron">
		<h1>Show all Customers Due</h1>
		
	 
	<table>	
	 <?php
	 
	 $user_id=$_SESSION['userId'];
	  $query= "SELECT * ";
	  $query .= "FROM daily_item_sale ";
	   $query .= "WHERE userId = {$user_id} ";
	  $query .= "AND due_amount>0 ";
	  
	  $result_set= mysql_query($query,$connection);
	   if(!$result_set){
					die("Database query failed: ".mysql_error());
		}
	  if( mysql_num_rows($result_set)>0)
				{
	  echo "<tr><td>"."ROW ID"."</td><td>"."SELL ID"."</td><td>"."ITEM ID"."</td><td>"."DATE"."</td><td>"."CUSTOMER NAME"."</td><td>"."QUANTITY"."</td><td>"."PRICE"."</td><td>"."SOLD BY"."</td><td>"."DUE AMOUNT"."</td><td>"."DUE DESCRIPTION"."</td></tr>";
					
	  
	  while($row=mysql_fetch_array($result_set)){
		$item_set=get_item_by_id($row["item_id"]);
						$item= mysql_fetch_array($item_set);
						$customer_set=get_customer_by_sell_id($row["sell_id"]);
						$customer= mysql_fetch_array($customer_set);
						$sell_set=get_sell_by_id($row["sell_id"]);
						$sell= mysql_fetch_array($sell_set);
		echo "<tr><td>".$row["id"]."</td><td>".$row["sell_id"]."</td><td>".$item["name"]."</td><td>".$sell["date"]."</td><td>".$customer["name"]."</td><td>".$row["quantity"]."</td><td>".$row["price"]."</td><td>".$row["sold_by"]."</td><td>".$row["due_amount"]."</td><td>".$row["due_description"]."</td></tr>";

	  }
		}
				else {
					echo "Sorry, no data yet.";
				 }	

	?>
	</table>
    </div>
	</div>
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
<?php
	// 5. Close connection
	mysql_close($connection);
?>