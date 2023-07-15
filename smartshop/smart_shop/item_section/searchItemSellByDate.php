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
		<h1>Show all sold Items </h1>
		
		
	<table>	
 <?php

 $user_id=$_SESSION['userId'];
 
  $query= "SELECT * ";
  $query .= "FROM daily_item_sale ";
  $query .= "WHERE userId = {$user_id} ";
 
  
  $result_set= mysql_query($query,$connection);
   if(!$result_set){
					die("Database query failed: ".mysql_error());
		}
   if( mysql_num_rows($result_set)>0)
				{
  echo "<tr><td>"."SELL ID"."</td><td>"."ITEM"."</td><td>"."QUANTITY"."</td><td>"."SELL PRICE"."</td><td>"."SOLD BY"."</td></tr>";
				
  
  while($row=mysql_fetch_array($result_set)){
	$item_set=get_item_by_id($row["item_id"]);
	$item= mysql_fetch_array($item_set);
	
	echo "<tr><td>".$row["sell_id"]."</td><td>".$item["name"]."</td><td>".$row["quantity"]."</td><td>".$row["price"]."</td><td>".$row["sold_by"]."</td></tr>";

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
