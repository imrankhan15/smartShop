<?php
session_start();

if (!isset($_SESSION['username'])){
	header("Location: index.php");
		exit;
}
?>
<?php include("includes/header_home.php"); ?>
	<div class="container">
		<div class="jumbotron">
		
		<p>Your process was successful.</p>
		</div>
	</div>
	
	<script src="jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
