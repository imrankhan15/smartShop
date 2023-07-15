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
	 if(!isset($_POST['contact_number'])||empty($_POST['contact_number'])){
		$errors[]='contact_number';
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
		 $contact_number=mysql_prep($_POST['contact_number']);
		   $user_id=$_SESSION['userId'];
		  
		   $query ="UPDATE store SET
					name='{$name}',
					address='{$address}',
					contact_number='{$contact_number}'
					
					WHERE id={$row_id}";
			
			$result=mysql_query($query,$connection);
			if(mysql_affected_rows()==1){
			header("Location: ..\success.php");
				exit;
			}
			else{
			$message= "Update of shop entry failed";
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
		<h1>Update Shop</h1>
		<?php
		$id=$_GET["id"];
		$entry_set=get_store_by_id($id);
		$entry= mysql_fetch_array($entry_set);
		?>
		</div>
	</div>
	 <div class="container">
		<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
		<?php if (!empty($errors)) { display_errors($errors); } ?>
		
		<form class="form-signin" method="post" action="shopentryupdate.php">
       
		</br>
		<input name="id" class="form-control" type=hidden  value="<?php echo $_GET["id"]?>">
		</br>
        <input name="name" class="form-control" placeholder="Shop Name" required="" autofocus=""  value="<?php echo $entry["name"]?>">
		</br>
        
	   <input name="address" class="form-control" placeholder="Address" required=""  value="<?php echo $entry["address"]?>">
       </br>
	   <input name="contact number" class="form-control" placeholder="Contact Number" required=""  value="<?php echo $entry["contact_number"]?>">
       </br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Update</button>
      </form>
	  
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
