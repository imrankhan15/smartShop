<?php
session_start();

if (!isset($_SESSION['username'])){
	header("Location: ..\index.php");
		exit;
}
?>
<?php include("..\dbGeneralFunctions.php"); ?><?php include("../includes/header.php"); ?>
	<div class="container">
		<div class="jumbotron">
		<h1>Show Staff History</h1>
		
		<form action="dbStaffHistoryById.php" method="post">
			
			  
			   <p>Select Staff: 
					<select name="id">
					<?php
					$staff_set = get_all_staffs();
					
					while ($staff = mysql_fetch_array($staff_set)) {
						
						echo "<option value=".$staff["id"].">".$staff["name"]."</option>";
						
					}
					
					?>
					
					</select>
				</p>
			</br>
			
			  <button class="btn btn-lg btn-primary btn-block" type="submit">Show</button>
			  </br>
			</form>
	</div>
	</div>
		
		
		
		

    
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>

