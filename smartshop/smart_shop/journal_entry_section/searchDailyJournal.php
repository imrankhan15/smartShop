<?php
session_start();

if (!isset($_SESSION['username'])){
	header("Location: ..\index.php");
		exit;
}
?>
<?php include("../includes/header.php"); ?>
	<div class="container">
		<div class="jumbotron">
		<h1>Notes For Specific Date</h1>
		
		</div>
	</div>
	 <div class="container">
		<form class="form-signin" method="post" action="dbDailyJournalByDate.php">
        
        <input name="date" class="form-control" placeholder="Please insert the date as yyyy-mm-dd" required="" autofocus="">
		</br>
        
		
	   
		
        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      </form>

   </div>
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>



		