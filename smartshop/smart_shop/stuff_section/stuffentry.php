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

	 if(!isset($_POST['name'])||empty($_POST['name'])){
		$errors[]='name';
	 }
	 if(!isset($_POST['salary'])||empty($_POST['salary'])){
		$errors[]='salary';
	 }
	 if(!isset($_POST['storeId'])||empty($_POST['storeId'])){
		$errors[]='storeId';
	 }
	  if($_POST['storeId']==-1){
		$errors[]='storeId';
	 }
	 if(!isset($_POST['mobile'])||empty($_POST['mobile'])){
		$errors[]='mobile';
	 }
	 if(!isset($_POST['email'])||empty($_POST['email'])){
		$errors[]='email';
	 }
	 if(!isset($_POST['address'])||empty($_POST['address'])){
		$errors[]='address';
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
		 
		 $name=mysql_prep($_POST['name']);
		 $salary=mysql_prep($_POST['salary']);
		 $storeId=mysql_prep($_POST['storeId']);
		  $mobile_number=mysql_prep($_POST['mobile']);
		  $email=mysql_prep($_POST['email']);
		  $address=mysql_prep($_POST['address']);
		  $user_id=$_SESSION['userId'];
		  
		  $query = "INSERT INTO staff (store_id,name,mobile_number,email,salary,address,userId) VALUES (
					{$storeId},'{$name}','{$mobile_number}','{$email}','{$salary}','{$address}',{$user_id}
					)";
					
			if(mysql_query($query,$connection)){
				header("Location: ..\success.php");
				exit;
			}
			else{
				$message= "Staff Creation Failed";
	
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

?><?php include("../includes/header.php"); ?>
	<div class="container">
		<div class="jumbotron">
		<h1>Enter New Staff</h1>
		<p>The new staff for your Shop...........</p>
		</div>
	</div>
	 <div class="container">
	 <?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
		<?php if (!empty($errors)) { display_errors($errors); } ?>
		 <form class="form-signin" method="post" action="stuffentry.php">
       
		
		</br>
        <input name="name" class="form-control" placeholder="Staff Name" required="" autofocus="">
		</br>
        <input name="salary" class="form-control" placeholder="Staff Salary" required="">
		</br>
		<p>Select Store: 
		<select name="storeId">
		<option value=-1>Please select a store</option>
		<?php
		$store_set = get_all_stores();
		
		while ($store = mysql_fetch_array($store_set)) {
			
			echo "<option value=".$store["id"].">".$store["name"]."</option>";
			
		}
		
		?>
		
		</select>
		</p>
		</br>
		<input name="mobile" class="form-control" placeholder="Mobile" required="">
       </br>
		<input name="email" class="form-control" placeholder="Email" required="">
       </br>
	   
	   <input name="address" class="form-control" placeholder="Address" required="">
       </br>
	   
		
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Submit</button>
      </form>
	  
		<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	</body>
</html>
<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
