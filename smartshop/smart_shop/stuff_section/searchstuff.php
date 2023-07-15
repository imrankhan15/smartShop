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

?><?php include("../includes/header.php"); ?>
	<div class="container">
		<div class="jumbotron">
		<h1>Show all Staff</h1>
		
		
	
		<table>
		
				<?php
				$user_id=$_SESSION['userId'];
				$result =mysql_query("SELECT * FROM staff WHERE userId = {$user_id}",$connection);
				
				if(!$result){
					die("Database query failed: ".mysql_error());
				}
				if( mysql_num_rows($result)>0)
				{
				echo "<tr><td>"."STORE"."</td><td>"."NAME"."</td><td>"."MOBILE NUMBER"."</td><td>"."EMAIL"."</td><td>"."SALARY"."</td><td>"."ADDRESS"."</td><td>"."Update"."</td></tr>";
				
				
				while($row=mysql_fetch_array($result)){
				$store_set=get_store_by_id($row["store_id"]);
						$store= mysql_fetch_array($store_set);
					echo "<tr><td>".$store["name"]."</td><td>".$row["name"]."</td><td>".$row["mobile_number"]."</td><td>".$row["email"]."</td><td>".$row["salary"]."</td><td>".$row["address"]."</td><td><a href=\"stuffentryupdate.php?id=".$row["id"]."\"> Update Entry</a></td></tr>";
				
				}
				}
				else {
					echo "Sorry, no data yet.";
				 }	
				?>
			
		</table>
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