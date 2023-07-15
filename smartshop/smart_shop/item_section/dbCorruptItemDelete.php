<?php
session_start();
require("..\constants.php");
if (!isset($_SESSION['username'])){
	header("Location: ..\index.php");
		exit;
}
?>
<?php require_once("..\otherFunctions.php");?>

<?php 
$errors=array();

if(!isset($_GET['id'])||empty($_GET['id'])){
 
	$errors[]='id';
 }
 
 if(!empty($errors)){
 //
	header("Location: bankentryupdate.php");
	exit;
 }
?>
<?php
$connection =mysql_connect(DB_SERVER,DB_USER,DB_PASS);

		if(!$connection){
		 die("Database connection failed: ". mysql_error());
		 
		 }
		 $db_select=mysql_select_db(DB_NAME,$connection);
 
 if(!$db_select){
	 die("Database selection failed: ". mysql_error());
 }
$row_id=mysql_prep($_GET['id']);

   $query ="DELETE FROM corrupt_item WHERE id={$row_id} LIMIT 1";
	
	$result=mysql_query($query,$connection);
	if(mysql_affected_rows()==1){
	header("Location: ..\success.php");
		exit;
	}
	else{
	echo "Delete Failed";
	}
			
	
	
  

?>
<?php 
	mysql_close($connection);
?>
