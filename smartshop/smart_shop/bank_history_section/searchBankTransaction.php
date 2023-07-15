<?php
session_start();

if (!isset($_SESSION['username'])){
	header("Location: ..\index.php");
		exit;
}
?>
<?php include("../includes/header.php"); ?>
	 <div class="container">
	 
		<form class="form-signin" method="post" action="dbBankTransactionByDate.php">
        <h2 class="form-signin-heading">Enter Date in specific format</h2>
		  <input name="date" class="form-control" placeholder="Date in YYYY-MM-DD format" required="">
      </br>
		 
		<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      </form>
	</div>	
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
