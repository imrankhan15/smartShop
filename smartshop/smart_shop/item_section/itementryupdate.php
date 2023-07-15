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
	 if(!isset($_POST['store_id'])||empty($_POST['store_id'])){
		$errors[]='store_id';
	 }
	  if(!isset($_POST['sell_price'])||empty($_POST['sell_price'])){
		$errors[]='sell_price';
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
		$store_id=mysql_prep($_POST['store_id']);
		$sell_price=mysql_prep($_POST['sell_price']);
		   $user_id=$_SESSION['userId'];
		   
		   $query ="UPDATE item SET
					name='{$name}',
					store_id={$store_id},
					sell_price={$sell_price}
					WHERE id={$row_id}";
			
			$result=mysql_query($query,$connection);
			if(mysql_affected_rows()==1){
			header("Location: ..\success.php");
				exit;
			}
			else{
			$message= "Update Failed";
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
		<h1>Update Item</h1>
		<?php
		$item_id=$_GET["id"];
		$entry_set=get_item_by_id($item_id);
		$entry= mysql_fetch_array($entry_set);
		?>
		</div>
	</div>
	 <div class="container">
		<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
		 <form class="form-signin" method="post" action="itementryupdate.php">
       
		</br>
		<input name="id" class="form-control" type=hidden  value="<?php echo $_GET["id"]?>">
		</br>
        <input name="name" class="form-control" placeholder="Item Name" required="" autofocus="" value="<?php echo $entry["name"]?>">
		</br>
         <input name="sell_price" class="form-control" placeholder="Item Sell Price" required="" autofocus="" value="<?php echo $entry["sell_price"]?>">
		</br>
		<p>Select Store: 
		<select name="store_id">
		
		<?php
		$store_set=get_store_by_id($entry["store_id"]);
				$store= mysql_fetch_array($store_set);?>
		<option value="<?php echo $entry["store_id"]?>"><?php echo $store["name"]?></option>	
		<?php
		$store_set = get_all_stores();
		
			
		while ($store = mysql_fetch_array($store_set)) {
			
			echo "<option value=".$store["id"].">".$store["name"]."</option>";
			
		}
		
		?>
		
		</select>
		</p></br>
		
	   
		
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Update</button>
      </form>

   
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>

		