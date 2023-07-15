<?php
session_start();

if (!isset($_SESSION['username'])){
	header("Location: ..\index.php");
		exit;
}
?>
<?php include("..\dbGeneralFunctions.php"); ?>
<?php 
if (isset($_POST['submit'])) {
	$errors=array();

	if(!isset($_POST['id'])||empty($_POST['id'])){
	 
		$errors[]='id';
	 }
	 if(!isset($_POST['name'])||empty($_POST['name'])){
		$errors[]='name';
	 }
	 if(!isset($_POST['address'])||empty($_POST['address'])){
		$errors[]='address';
	 }

	  if(!isset($_POST['email'])||empty($_POST['email'])){
		$errors[]='email';
	 }
	 if(!isset($_POST['mobile'])||empty($_POST['mobile'])){
		$errors[]='mobile';
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
		 $row_id=mysql_prep($_POST['id']);
		 $name=mysql_prep($_POST['name']);
		 $address=mysql_prep($_POST['address']);
		 $email=mysql_prep($_POST['email']);
		  $mobile=mysql_prep($_POST['mobile']);
		  $description=mysql_prep($_POST['description']);
		 
		   $user_id=$_SESSION['userId'];
		  
		  $query ="UPDATE supplier SET
					name='{$name}',
					mobile='{$mobile}',
					email='{$email}',
					address='{$address}',
					description='{$description}'
					
					WHERE id={$row_id}";
			
			$result=mysql_query($query,$connection);
			if(mysql_affected_rows()==1){
			header("Location: ..\success.php");
				exit;
			}
			else{
			$message= "Supplier Update Failed";
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
		<h1>Update Supplier</h1>
		<?php
		$id=$_GET["id"];
		$entry_set=get_supplier_by_id($id);
		$entry= mysql_fetch_array($entry_set);
		?>
		</div>
	</div>
	 <div class="container">
		<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
		<?php if (!empty($errors)) { display_errors($errors); } ?>
		
		<form class="form-signin" method="post" action="supplierentryupdate.php">
      
		</br>
		<input name="id" class="form-control" type=hidden  value="<?php echo $_GET["id"]?>">
		</br>
        <input name="name" class="form-control" placeholder="Supplier Name" required="" autofocus="" value="<?php echo $entry["name"]?>">
		</br>
        <input name="mobile" class="form-control" placeholder="mobile number" required="" value="<?php echo $entry["mobile"]?>">
		</br>
		<input name="email" class="form-control" placeholder="Email" required="" value="<?php echo $entry["email"]?>">
       </br>
	   
	   <input name="address" class="form-control" placeholder="Address" required="" value="<?php echo $entry["address"]?>">
       </br>
	   <input name="description" class="form-control" placeholder="Supplier Product Type" required="" value="<?php echo $entry["description"]?>">
       </br>
	
		
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Submit</button>
      </form>
	  
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
