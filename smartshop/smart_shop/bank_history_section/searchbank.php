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
		<h1>Show all Bank Transactions</h1>
	
		<table>
		
				<?php
				$user_id=$_SESSION['userId'];
				$result =mysql_query("SELECT * FROM bank_history WHERE userId = {$user_id}",$connection);
				
				if(!$result){
					die("Database query failed: ".mysql_error());
				}
				 if( mysql_num_rows($result)>0)
				{
					echo "<tr><td>"."STORE NAME"."</td><td>"."BANK NAME"."</td><td>"."BRANCH NAME"."</td><td>"."DATE"."</td><td>"."Description"."</td><td>"."BANK_TRANSACTION_ID"."</td><td>"."TRANSACTION MADE BY"."</td><td>"."Update"."</td></tr>";
					
					while($row=mysql_fetch_array($result)){
						$store_set=get_store_by_id($row["store_id"]);
						$store= mysql_fetch_array($store_set);
						
						echo "<tr><td>".$store["name"]."</td><td>".$row["bank_name"]."</td><td>".$row["branch_name"]."</td><td>".$row["date"]."</td><td>".$row["description"]."</td><td>".$row["bank_transaction_id"]."</td><td>".$row["transaction_made_by"]."</td><td><a href=\"bankentryupdate.php?id=".$row["id"]."\"> Update Entry</a></td></tr>";
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