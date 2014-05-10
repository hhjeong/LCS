<?
require_once("db.inc.php");
$id = $_POST['clar_id'];

unset( $_POST['clar_id'] );

$db->query_update("bud13_clar", $_POST, "clar_id=$id");

header("Location: clar.admin.php", true, 303);
?>
