<?php
session_start();

if (!isset($_SESSION['username'])){
	header("Location: ..\index.php");
		exit;
}
?>
<?php include("..\dbGeneralFunctions.php"); ?>
<?php
$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
 
 if(!$db_select){
	 die("Database selection failed: ". mysql_error());
 }

?><?php include("../includes/header.php"); ?>
	<div class="container">
		<div class="jumbotron">
		<h1>Show all Owner Transactions</h1>
		
		<table>
		
				<?php
				$user_id=$_SESSION['userId'];
				
				$result =mysql_query("SELECT * FROM owner_history WHERE userId = {$user_id}",$connection);
				
				if(!$result){
					die("Database query failed: ".mysql_error());
				}
				  if( mysql_num_rows($result)>0)
				{
				echo "<tr><td>"."NAME"."</td><td>"."AMOUNT"."</td><td>"."DESCRIPTION"."</td><td>"."DATE"."</td></tr>";
				
				
				while($row=mysql_fetch_array($result)){
					$owner_set=get_owner_by_id($row["owner_id"]);
				$owner= mysql_fetch_array($owner_set);
					echo "<tr><td>".$owner["name"]."</td><td>".$row["amount"]."</td><td>".$row["description"]."</td><td>".$row["date"]."</td></tr>";
				
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