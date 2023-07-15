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
		<h1>Show all Corrupt Items</h1>
		
		<table>
		
				<?php
				
				 $user_id=$_SESSION['userId'];
				 
				$result =mysql_query("SELECT * FROM corrupt_item WHERE userId = {$user_id} ",$connection);
				
				if(!$result){
					die("Database query failed: ".mysql_error());
				}
				
				  if( mysql_num_rows($result)>0)
				{
				
				echo "<tr><td>"."ITEM"."</td><td>"."SUPPLIER"."</td><td>"."NAME"."</td><td>"."DELETE"."</td></tr>";
				
				
				while($row=mysql_fetch_array($result)){
					
					$item_set=get_item_by_id($row["item_id"]);
					$item= mysql_fetch_array($item_set);
					$supplier_set=get_supplier_by_id($row["supplier_id"]);
					$supplier=mysql_fetch_array($supplier_set);
					echo "<tr><td>".$item['name']."</td><td>".$supplier['name']."</td><td>".$row["description"]."</td><td><a href=\"dbCorruptItemDelete.php?id=".$row["id"]."\"> Delete Entry</a></td></tr>";
				
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