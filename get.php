<?require_once("db.inc.php");
session_start();
$c = $_GET['c'];
if( $c != 'o' && $c != 's' ) exit();
$id = stripslashes(strip_tags($_GET['id']));
$r = $db->query_first("SELECT team_id, output, solution FROM $db_status_tb WHERE run_id = '$id'");
if( $db->affected_rows == 0 ) exit();
if( $c == 'o' ) $filename = $r['output'];
else if( $c == 's' ) $filename = $r['solution'];
header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\"");
header("Content-Type: application/force-download");
header("Content-Length: " . filesize($filename));
header("Connection: close");
readfile($filename);?>
