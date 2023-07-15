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

if (isset($_POST['submit'])) {
	$errors=array();

	 if(!isset($_POST['id'])||empty($_POST['id'])){
		$errors[]='id';
	 }
	 if(!isset($_POST['amount'])||empty($_POST['amount'])||(intval($_POST['amount'])==0)){
		$errors[]='amount';
	 }
	  if(!isset($_POST['description'])||empty($_POST['description'])){
		$errors[]='description';
	 }
	 
	 
	 if(empty($errors)){
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		 
		 $id=mysql_prep($_POST['id']);
		 $amount=mysql_prep($_POST['amount']);
		  $description=mysql_prep($_POST['description']);
		   $user_id=$_SESSION['userId'];
		   
		  $query= "SELECT * ";
		  $query .= "FROM daily_item_buy ";
		  $query .= "WHERE id = {$id} AND userId={$user_id}";
		  
		  $result_set= mysql_query($query,$connection);
		   if( mysql_num_rows($result_set)>0)
						{
			   $result=mysql_fetch_array($result_set);
			   $new_amount=$result["due_amount"]-$amount;
			   if($new_amount<0){
					$message= "More then due cannot be paid";
			   }
			   else{
					$query ="UPDATE daily_item_buy SET
						due_description='{$description}',
						due_amount={$new_amount}
						WHERE id={$id}";
				
					$result=mysql_query($query,$connection);
					if(mysql_affected_rows()==1){
						header("Location: ..\success.php");
						exit;
					}
					else{
						$message= "Update Failed";
					}
			   }
		   
					
			}else{
				$message= "Sorry Cannot find the buy_id";
			}	
			mysql_close($connection);
	
	 }
	 else{
		if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
	 }
}

?>
<?php include("../includes/header.php"); ?>
	<div class="container">
		<div class="jumbotron">
		<h1>Pay Supplier Due</h1>
		
		</div>
	</div>
	 <div class="container">
		<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
			
		<form class="form-signin" method="post" action="paySupplierDue.php">
        <h2 class="form-signin-heading">Enter Paying Amount Details</h2>
		
		</br>
        <input name="id" class="form-control" placeholder="ROW_ID" required="" autofocus="">
		</br>
        <input name="amount" class="form-control" placeholder="Amount" required="">
		</br>
		<input name="description" class="form-control" placeholder="Description" required="">
       </br>
	   
	  
	   
		
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Submit</button>
      </form>

   </div>
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
