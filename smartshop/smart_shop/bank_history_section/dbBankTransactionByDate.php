<?php
session_start();
require("..\constants.php");
if (!isset($_SESSION['username'])){
	header("Location: ..\index.php");
		exit;
}
?>
<?php require_once("..\otherFunctions.php");?>

<?php 
$errors=array();

 if(!isset($_POST['date'])||empty($_POST['date'])){
	
	$errors[]='date';
 }
/*
 
 if(!empty($errors)){
	header("Location: searchBankTransaction.php");
	exit;
 }
 */
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
 <?php include("../includes/header.php"); ?>
	<div class="container">
		<div class="jumbotron">
		<h1>Show Bank Transactions of <?php echo mysql_prep($_POST['date']); ?></h1>
		
	<table>	
	
 <?php 
  $date=mysql_prep($_POST['date']);

  $user_id=$_SESSION['userId'];
  
  $query= "SELECT * ";
  $query .= "FROM bank_history ";
  $query .= "WHERE date = '{$date}' ";
  $query .= "AND userId = {$user_id} ";
  $query .= "ORDER BY store_id ASC";
  
  $result_set= mysql_query($query,$connection);
   if(!$result_set){
					die("Database query failed: ".mysql_error());
		}
   if( mysql_num_rows($result_set)>0)
				{
  echo "<tr><td>"."STORE ID"."</td><td>"."BANK NAME"."</td><td>"."BRANCH NAME"."</td><td>"."DATE"."</td><td>"."Description"."</td><td>"."BANK_TRANSACTION_ID"."</td><td>"."TRANSACTION MADE BY"."</td><td>"."DELETE"."</td></tr>";
				
  while($row=mysql_fetch_array($result_set)){
  
	echo "<tr><td>".$row["store_id"]."</td><td>".$row["bank_name"]."</td><td>".$row["branch_name"]."</td><td>".$row["date"]."</td><td>".$row["description"]."</td><td>".$row["bank_transaction_id"]."</td><td>".$row["transaction_made_by"]."</td><td><a href=\"dbBankEntryDelete.php?id=".$row["id"]."\"> Delete Entry</a></td></tr>";


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