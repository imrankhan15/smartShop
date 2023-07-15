<?php
session_start();
require("constants.php");
if (!isset($_SESSION['username'])){
	header("Location: index.php");
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
 
 ?>
<?php include("includes/header_home.php"); ?>
	
	<div class="container">
		<div class="jumbotron">
		<h1>Business Mate</h1>
		<p>Accounting, Credit Management, Inventory Management...........</p>
		
		</div>
		
	</div>
	
		<div class="container">
		<div class="jumbotron">
			<div class="col-md-4">
				<p>How to start??</p>
		Start with browsing the navigation bar buttons. If still problem go through the user guide to know how to start accounting for your stores
		
		</div>
		
			<div class="col-md-4">
				 <p>Todays Tasks: </p>
				<table>	
			 <?php
			 $date=date("Y-m-d");;
			 $user_id=$_SESSION['userId'];
			 
			  $query= "SELECT * ";
			  $query .= "FROM daily_journal ";
			  $query .= "WHERE userId = {$user_id} ";
			  $query .= "AND date = '{$date}' ";
			  
			  $result_set= mysql_query($query,$connection);
			   if(!$result_set){
								die("Database query failed: ".mysql_error());
					}
			   if( mysql_num_rows($result_set)>0)
							{
			   echo "<tr><td>"."Task_Description"."</td><td>"."Complete??"."</td></tr>";
							
			  while($daily_entry=mysql_fetch_array($result_set)){
				
				echo "<tr><td>".$daily_entry["work_description"]."</td><td><a href=\"journal_entry_section/dbDailyEntryDelete.php?id=".$daily_entry["id"]."\"> Delete Entry</a></td></tr>";

				

			  }
			  }
							else {
								echo "Sorry, no tasks yet.";
							 }	
				

			?>

			</table>
			</br>
			if you want to insert tasks for a day go to <a href="journal_entry_section/dailyjournal.php"> Daily Journal</a>
		</div>
		<div class="col-md-4">
		 <p>New Items(need's sell price): </p>
				<table>	
			 <?php
			 $date=date("Y-m-d");;
			 $user_id=$_SESSION['userId'];
			 
			  $query= "SELECT * ";
			  $query .= "FROM item ";
			  $query .= "WHERE userId = {$user_id} ";
			  $query .= "AND sell_price = 0 ";
			  
			  $result_set= mysql_query($query,$connection);
			   if(!$result_set){
								die("Database query failed: ".mysql_error());
					}
			   if( mysql_num_rows($result_set)>0)
							{
			   echo "<tr><td>"."Item_Code"."</td></tr>";
							
			  while($item=mysql_fetch_array($result_set)){
				
				echo "<tr><td>".$item["name"]."</td></tr>";

				

			  }
			  }
							else {
								echo "Sorry, no tasks yet.";
							 }	
				

			?>

			</table>
			</br>
			if you want to insert price for a item go to <a href="item_section/itemSellPriceEntry.php">ItemSellPriceEntry</a>
		
		</div>
		
			
		</div>
	</div>
	
	
	 
	
	<script src="jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
<?php
	// 5. Close connection
	mysql_close($connection);
?>
