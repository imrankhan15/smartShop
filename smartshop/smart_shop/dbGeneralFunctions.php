<?php
if (!isset($_SESSION['username'])){
	header("Location: index.php");
		exit;
}


define("DB_SERVER","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","smart_shop_db");

?>
<?php

	function mysql_prep( $value ) {
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
		if( $new_enough_php ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysql_real_escape_string( $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}
	
	function display_errors($error_array) {
		echo "<p>";
		echo "Please review the following fields:<br />";
		foreach($error_array as $error) {
			echo " - " . $error . "<br />";
		}
		echo "</p>";
	}


	function get_all_suppliers() {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		 $user_id=$_SESSION['userId'];
		$query = "SELECT * 
				FROM supplier WHERE userId = {$user_id}";
		$result_set = mysql_query($query, $connection);
		
		return $result_set;
		
	}
	
	function get_supplier_by_id($supplier_id) {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		 $user_id=$_SESSION['userId'];
		$query = "SELECT * 
				FROM supplier WHERE userId = {$user_id} AND id = {$supplier_id} ";
		$result_set = mysql_query($query, $connection);
		
		return $result_set;
		
	}
	
	function get_supplier_by_buy_id($buy_id) {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		 $user_id=$_SESSION['userId'];
		$query = "SELECT supplier_id 
				FROM buy WHERE userId = {$user_id} AND id = {$buy_id} ";
		$result_set = mysql_query($query, $connection);
		
		if( mysql_num_rows($result_set)>0)
				{
				   $result=mysql_fetch_array($result_set);
				   $supplier_id=$result[0];
				   $result_set=get_supplier_by_id($supplier_id);
				}
		
		return $result_set;
		
	}
	
	function get_buy_by_id($buy_id) {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		 $user_id=$_SESSION['userId'];
		$query = "SELECT * 
				FROM buy WHERE userId = {$user_id} AND id = {$buy_id} ";
		$result_set = mysql_query($query, $connection);
		
		return $result_set;
		
	}
	
	function get_bankEntry_by_id($bank_id) {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		 $user_id=$_SESSION['userId'];
		$query = "SELECT * 
				FROM bank_history WHERE userId = {$user_id} AND id = {$bank_id} ";
		$result_set = mysql_query($query, $connection);
		
		return $result_set;
		
	}
	
	function get_all_owners() {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		 $user_id=$_SESSION['userId'];
		$query = "SELECT * 
				FROM owner WHERE userId = {$user_id}";
		$owner_set = mysql_query($query, $connection);
		
		return $owner_set;
	}
	
	function get_owner_by_id($id) {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		 $user_id=$_SESSION['userId'];
		$query = "SELECT * 
				FROM owner WHERE userId = {$user_id} AND id = {$id}";
		$owner_set = mysql_query($query, $connection);
		
		return $owner_set;
	}
	
	function get_all_staffs() {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		  $user_id=$_SESSION['userId'];
		$query = "SELECT * 
				FROM staff WHERE userId = {$user_id}";
		$supplier_set = mysql_query($query, $connection);
		
		return $supplier_set;
	}
	function get_staff_by_id($id) {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		  $user_id=$_SESSION['userId'];
		$query = "SELECT * 
				FROM staff WHERE userId = {$user_id} AND id = {$id}";
		$supplier_set = mysql_query($query, $connection);
		
		return $supplier_set;
	}
	function get_all_stores() {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		 $user_id=$_SESSION['userId'];
		$query = "SELECT * 
				FROM store WHERE userId = {$user_id}";
		$supplier_set = mysql_query($query, $connection);
		
		return $supplier_set;
	}
	
	function get_store_by_id($id) {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		 $user_id=$_SESSION['userId'];
		$query = "SELECT * 
				FROM store WHERE userId = {$user_id} AND id = {$id}";
		$supplier_set = mysql_query($query, $connection);
		
		return $supplier_set;
	}
	
	function get_all_items() {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		  $user_id=$_SESSION['userId'];
		  
		$query = "SELECT * 
				FROM item WHERE userId = {$user_id}";
		$item_set = mysql_query($query, $connection);
		
		return $item_set;
	}
	
	function get_item_by_id($item_id) {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		 $user_id=$_SESSION['userId'];
		$query = "SELECT * 
				FROM item WHERE userId = {$user_id} AND id = {$item_id} ";
		$result_set = mysql_query($query, $connection);
		return $result_set;
		
	}
	
	function get_items_by_store_id($store_id) {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		 $user_id=$_SESSION['userId'];
		$query = "SELECT * 
				FROM item WHERE userId = {$user_id} AND store_id = {$store_id} ";
		$result_set = mysql_query($query, $connection);
		return $result_set;
		
	}
	function get_all_customers() {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		  $user_id=$_SESSION['userId'];
		$query = "SELECT * 
				FROM customer WHERE userId = {$user_id}";
		$customer_set = mysql_query($query, $connection);
		
		return $customer_set;
	}
	function get_customer_by_id($id) {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		  $user_id=$_SESSION['userId'];
		$query = "SELECT * 
				FROM customer WHERE userId = {$user_id} AND id = {$id}";
		$customer_set = mysql_query($query, $connection);
		
		return $customer_set;
	}
	function get_customer_by_sell_id($sell_id) {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		 $user_id=$_SESSION['userId'];
		$query = "SELECT customer_id 
				FROM sell WHERE userId = {$user_id} AND id = {$sell_id} ";
		$result_set = mysql_query($query, $connection);
		
		if( mysql_num_rows($result_set)>0)
				{
				   $result=mysql_fetch_array($result_set);
				   $customer_id=$result[0];
				   $result_set=get_customer_by_id($customer_id);
				}
		
		return $result_set;
		
	}
	function get_sell_by_id($sell_id) {
		$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
		 
		 if(!$db_select){
			 die("Database selection failed: ". mysql_error());
		 }
		 $user_id=$_SESSION['userId'];
		$query = "SELECT * 
				FROM sell WHERE userId = {$user_id} AND id = {$sell_id} ";
		$result_set = mysql_query($query, $connection);
		
		return $result_set;
		
	}

?>
