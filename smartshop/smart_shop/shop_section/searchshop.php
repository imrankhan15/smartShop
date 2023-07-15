<?php
session_start();
require("..\constants.php");
if (!isset($_SESSION['username'])){
	header("Location: ..\index.php");
		exit;
}
?>

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
		<h1>Show all Shops</h1>
		
		<table>
		
				<?php
				$user_id=$_SESSION['userId'];
				
				$result =mysql_query("SELECT * FROM store WHERE userId = {$user_id}",$connection);
				
				if(!$result){
					die("Database query failed: ".mysql_error());
				}
				
				 if( mysql_num_rows($result)>0)
				{
				echo "<tr><td>"."ID"."</td><td>"."NAME"."</td><td>"."ADDRESS"."</td><td>"."CONTACT NUMBER"."</td><td>"."Update"."</td></tr>";
				
				
				while($row=mysql_fetch_array($result)){
					echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["address"]."</td><td>".$row["contact_number"]."</td><td><a href=\"shopentryupdate.php?id=".$row["id"]."\"> Update Entry</a></td></tr>";
				
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