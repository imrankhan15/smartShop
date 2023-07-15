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
		<h1>Sorry Item Low In Stock. Can not make the sale.</h1>
		</div>
		
	</div>
	 
		
		
		

    
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
