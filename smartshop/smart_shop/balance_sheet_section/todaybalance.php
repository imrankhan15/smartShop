<?php
session_start();

if (!isset($_SESSION['username'])){
	header("Location: ..\index.php");
		exit;
}
?>
<?php require_once("..\dbGeneralFunctions.php");?>
<?php
$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
 
 if(!$db_select){
	 die("Database selection failed: ". mysql_error());
 }

?>
<?php include("../includes/header.php"); ?>
	<div class="container">
		<div class="jumbotron">
		<h1>Show Todays Balance</h1>
		
		<table>
		<caption>Sales Balance</caption>
		<?php
		 $date=date("Y-m-d");
		  $user_id=$_SESSION['userId'];
		   $query= "SELECT A.sell_id,A.item_id,A.quantity,A.price,A.sold_by,B.name,C.date ";
		  $query .= "FROM daily_item_sale A,store B, sell C ";
		  $query .= "WHERE A.userId = {$user_id} ";
		  $query .= "AND C.id = A.sell_id ";
		  $query .= "AND C.date ='{$date}'  ";
		  $query .= "AND C.store_id = B.id ";
		  
		  $query .="ORDER BY  C.store_id ";
		  $result_set= mysql_query($query,$connection);
		   if(!$result_set){
					die("Database query failed: ".mysql_error());
		}
		    if( mysql_num_rows($result_set)>0)
				{
				  echo "<tr><td>"."STORE NAME"."</td><td>"."ITEM "."</td><td>"."DATE"."</td><td>"."QUANTITY"."</td><td>"."PRICE"."</td><td>"."SOLD BY"."</td></tr>";
								
				  
				  while($row=mysql_fetch_array($result_set)){
					$item_set=get_item_by_id($row["item_id"]);
					$item= mysql_fetch_array($item_set);
					
					echo "<tr><td>".$row["name"]."</td><td>".$item["name"]."</td><td>".$row["date"]."</td><td>".$row["quantity"]."</td><td>".$row["price"]."</td><td>".$row["sold_by"]."</td></tr>";

				  }
			}
				else {
					echo "Sorry, no data yet.";
				 }

		?>
				
				</table></br></br></br><table>
		  <caption>Sales Total</caption>
		  <?php
		  $query= "SELECT SUM(A.quantity*A.price),B.name,A.sell_id ";
		  $query .= "FROM daily_item_sale A,store B,sell C ";
		  $query .= "WHERE A.userId = {$user_id} ";
		   $query .= "AND C.id = A.sell_id ";
		  $query .= "AND C.date = '{$date}' ";
		  $query .= "AND C.store_id = B.id ";
		  $query .="GROUP BY  C.store_id ";
		  
		 
		  $result_set= mysql_query($query,$connection);
		   if(!$result_set){
					die("Database query failed: ".mysql_error());
		}
		  if( mysql_num_rows($result_set)>0)
				{
		  echo "<tr><td>"."REVENUE"."</td><td>"."SHOP NAME"."</td></tr>";
						
		  
		  while($row=mysql_fetch_array($result_set)){
			
			echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr>";

		  }
		  }
				else {
					echo "Sorry, no data yet.";
				 }

			

		?>
		
				
				
				</table></br></br></br><table>
				
				
				<caption>Buy Balance</caption>
				 <?php
				 
				 $date=date("Y-m-d");
				 
				 $query= "SELECT A.buy_id,A.item_id,A.quantity,A.price,A.paid_by,B.name,C.date ";
					  $query .= "FROM daily_item_buy A,store B, buy C ";
					  $query .= "WHERE A.userId = {$user_id} ";
					  $query .= "AND C.id = A.buy_id ";
					  $query .= "AND C.date = '{$date}' ";
					  $query .= "AND C.store_id = B.id ";
					  
					  $query .="ORDER BY  C.store_id ";
					  
				 
					  $result_set= mysql_query($query,$connection);
					   if(!$result_set){
					die("Database query failed: ".mysql_error());
		}
					  if( mysql_num_rows($result_set)>0)
				{
					 echo "<tr><td>"."STORE NAME"."</td><td>"."ITEM "."</td><td>"."DATE"."</td><td>"."QUANTITY"."</td><td>"."PRICE"."</td><td>"."PAID BY"."</td></tr>";
									
					  
					  while($row=mysql_fetch_array($result_set)){
						$item_set=get_item_by_id($row["item_id"]);
						$item= mysql_fetch_array($item_set);
						
						echo "<tr><td>".$row["name"]."</td><td>".$item["name"]."</td><td>".$row["date"]."</td><td>".$row["quantity"]."</td><td>".$row["price"]."</td><td>".$row["paid_by"]."</td></tr>";

					  }
					   }
				else {
					echo "Sorry, no data yet.";
				 }
					

				?>
				
				</table></br></br></br><table>
		  <caption>Buy Total</caption>
		  <?php
		 
		  $query= "SELECT SUM(A.quantity*A.price),B.name,A.buy_id ";
		  $query .= "FROM daily_item_buy A,store B,buy C ";
		  $query .= "WHERE A.userId = {$user_id} ";
		   $query .= "AND C.id = A.buy_id ";
		  $query .= "AND C.date = '{$date}' ";
		  $query .= "AND C.store_id = B.id ";
		  $query .="GROUP BY  C.store_id ";
		  
		  $result_set= mysql_query($query,$connection);
		   if(!$result_set){
					die("Database query failed: ".mysql_error());
		}
		    if( mysql_num_rows($result_set)>0)
				{
		  echo "<tr><td>"."COST"."</td><td>"."SHOP NAME"."</td></tr>";
						
		  
		  while($row=mysql_fetch_array($result_set)){
			
			echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr>";

		  }
			}
				else {
					echo "Sorry, no data yet.";
				 }

		?>
				
				</table></br></br></br><table>
				
				
				<caption>Other Cost</caption>
				 <?php
				 
				 $date=date("Y-m-d");
				   $query= "SELECT A.description,A.date,A.paid_by,A.cost,B.name ";
					  $query .= "FROM daily_other_cost A,store B ";
					  $query .= "WHERE A.userId = {$user_id} ";
					  $query .= "AND A.date = '{$date}' ";
					  $query .= "AND A.store_id = B.id ";
					  $query .="ORDER BY  A.store_id ";
					  $result_set= mysql_query($query,$connection);
					   if(!$result_set){
					die("Database query failed: ".mysql_error());
		}
					   if( mysql_num_rows($result_set)>0)
				{
					 echo "<tr><td>"."STORE NAME"."</td><td>"."DESCRIPTION"."</td><td>"."Date"."</td><td>"."PAID_BY"."</td><td>"."COST"."</td></tr>";
								
				  
				  while($row=mysql_fetch_array($result_set)){
					
					echo "<tr><td>".$row["name"]."</td><td>".$row["description"]."</td><td>".$row["date"]."</td><td>".$row["paid_by"]."</td><td>".$row["cost"]."</td></tr>";

				  }
				  }
				else {
					echo "Sorry, no data yet.";
				 }
					

				?>
				
				</table></br></br></br><table>
				<?php
				
				$date=date("Y-m-d");
				
				
				 $query= "SELECT SUM(A.cost),B.name ";
				  $query .= "FROM daily_other_cost A,store B ";
				  $query .= "WHERE A.userId = {$user_id} ";
				  $query .= "AND A.date = '{$date}' ";
				  $query .= "AND A.store_id = B.id ";
				  $query .="GROUP BY  A.store_id ";
				  $result_set= mysql_query($query,$connection);
				   if(!$result_set){
					die("Database query failed: ".mysql_error());
		}
				  if( mysql_num_rows($result_set)>0)
				{
				  echo "<tr><td>"."TOTAL OTHER COST"."</td><td>"."SHOP NAME"."</td></tr>";
								
				  
				  while($row=mysql_fetch_array($result_set)){
					
					echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr>";

				  }
				  }
				else {
					echo "Sorry, no data yet.";
				 }
 
				?>  
			
		
			
		</table>
		</br></br></br>
		</br></br></br>
		<table>
				
				<caption>Total Credit(Customer)</caption>
				 
				
				<?php
				
				$date=date("Y-m-d");
 
 
				 $query= "SELECT SUM(A.due_amount),B.name,C.date,A.sell_id ";
				  $query .= "FROM daily_item_sale A,store B,sell C ";
				  $query .= "WHERE A.userId = {$user_id} ";
				   $query .= "AND C.id = A.sell_id ";
				  $query .= "AND C.date = '{$date}'";
				  $query .= "AND C.store_id = B.id ";
				  $query .="GROUP BY  C.store_id ";
				  $result_set= mysql_query($query,$connection);
				   if(!$result_set){
					die("Database query failed: ".mysql_error());
		}
				  
				  
				if( mysql_num_rows($result_set)>0)
				{
				
				
				  echo "<tr><td>"."DUE YOU WILL GET FROM CUSTOMER"."</td><td>"."SHOP NAME"."</td></tr>";
								
				  
				  while($row=mysql_fetch_array($result_set)){
					
					echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr>";

				  }
				  
				   }
				else {
					echo "Sorry, no data yet.";
				 }
				  ?>
				
				</table></br></br></br>
				<table>
				
				<caption>Total Debit(Supplier)</caption>
				 
				
				<?php
				
				$date=date("Y-m-d");
 
 
					  $query= "SELECT SUM(A.due_amount),B.name,C.date,A.buy_id ";
				  $query .= "FROM daily_item_buy A,store B,sell C ";
				  $query .= "WHERE A.userId = {$user_id} ";
				 $query .= "AND C.id = A.buy_id ";
				  $query .= "AND C.date = '{$date}'";
				  $query .= "AND C.store_id = B.id ";
				  $query .="GROUP BY  C.store_id ";
				  
				  $result_set= mysql_query($query,$connection);
				   if(!$result_set){
					die("Database query failed: ".mysql_error());
		}
				  
				  
				if( mysql_num_rows($result_set)>0)
				{
				
				
				  echo "<tr><td>"."DUE YOU NEED TO PAY TO SUPPLIER"."</td><td>"."SHOP NAME"."</td></tr>";
								
				  
				  while($row=mysql_fetch_array($result_set)){
					
					echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr>";

				  }
				  }
				else {
					echo "Sorry, no data yet.";
				 }
				  
				 
				?>
				
				</table></br></br></br>
				<table>
				 <caption>Owner Assets</caption>
				  <?php
				  $query ="SELECT  A.name, A.percentage,SUM(B.amount) ";
				  $query .= "FROM owner_history B , owner A ";
				  $query .= "WHERE A.userId = {$user_id} AND B.userId = {$user_id} ";
				  $query .= "AND B.date = '{$date}' ";
				  $query .= "AND A.id = B.owner_id  ";
				  $query .="GROUP BY  B.owner_id ";
				  
				  $result_set= mysql_query($query,$connection);
				   if(!$result_set){
					die("Database query failed: ".mysql_error());
		}
				  if( mysql_num_rows($result_set)>0)
				{
				  echo "<tr><td>"."Owner Name, Shop Name"."</td><td>"."Owner Share"."</td><td>"."Owner Assets"."</td></tr>";
								
				  
				  while($row=mysql_fetch_array($result_set)){
					
					echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td></tr>";

				  }
					}
				else {
					echo "Sorry, no data yet.";
				 }

				?>
				
				</table></br></br></br>
    </div>
		
	</div>	
		
		

    
	<script src="../jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<div id="footer">Copyright 2016, Anirban Chittagong</div>
	</body>
</html>
<?php
	// 5. Close connection
	mysql_close($connection);
?>