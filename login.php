<?php

require_once("db.inc.php");
require_once("func.inc.php");

$db_account_tb = $db_prefix . "_account";
$db_login_tb = $db_prefix . "_login";

if( isset( $_POST ) ) {

	$id = $_POST['id'];
	$password = $_POST['password'];

	$id = mysql_real_escape_string( $id );
	$password = mysql_real_escape_string( $password );
	

	$row = $db->query( "SELECT id, name, perm FROM $db_account_tb WHERE id = '$id' AND password = '$password';");
	$record = $db->fetch_array( $row );

	$success = true;

	$inp = array();
	$inp['team_id'] = $id;
	$inp['ip'] = get_real_ip_addr();
	if( $db->affected_rows == 0 ) {
		$success = false;
		$inp['success'] = false;	
	}
	else {
		$inp['success'] = true;
	}
	$db->query_insert($db_login_tb, $inp ); 
	if( $success == false  ) {
		session_destroy();
?>
		<script>alert("Invalid Login!");</script>
		<script>history.back();</script>
<?
		exit();
	}

	session_start();
	$_SESSION['id'] = $record['id'];
	$_SESSION['name'] = $record['name'];
	$_SESSION['key'] = "$authKey";
	$_SESSION['perm'] = $record['perm'];

	
	header("Location:index.php");
}
?>


