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

 if(!isset($_POST['id'])||empty($_POST['id'])){
	$errors[]='id';
 }
 
 
 
 if(!empty($errors)){
	header("Location: searchStuffHistoryById.php");
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
 <?php include("../includes/header.php"); ?>
	<div class="container">
		
		<h1>Show Staff History</h1>
		
		
	</div>
	<div class="container">
	<table>	
	
		 <?php
		 $staff_id=mysql_prep($_POST['id']);
		 $user_id=$_SESSION['userId'];
		  $query= "SELECT * ";
		  $query .= "FROM staff_daily_history ";
		  $query .= "WHERE userId = {$user_id} ";
		  $query .= "AND staff_id = {$staff_id} ";
		  $query .="LIMIT 0 , 30";
		  
		  $result_set= mysql_query($query,$connection);
		  
		    if( mysql_num_rows($result_set)>0)
				{
		  echo "<tr><td>"."DATE"."</td><td>"."STAFF_ID"."</td><td>"."STAFF_REPORT"."</td><td>"."DELETE"."</td></tr>";
						
		  
		  while($row=mysql_fetch_array($result_set)){
			echo "<tr><td>".$row["date"]."</td><td>".$row["staff_id"]."</td><td>".$row["staff_report"]."</td><td><a href=\"dbStaffHistoryDelete.php?id=".$row["id"]."\"> Delete Entry</a></td></tr>";


			

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
	


