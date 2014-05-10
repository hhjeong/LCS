<?
require_once("header.php");
?>

<?

function set_path( $p, $c, $i ) {
	$fi = pathinfo($p);
	$ex = strtolower($fi['extension']);
	$fn = strtolower($fi['filename']);

	//if( $ex == "php" || $ex == "cgi" ) $ex = ".txt";

	return $fn . ".$ex";
}

function moveUploadedFile($file, $c, $ri ) {
	if( $file["size"] == 0 ) {
		return "";
	}
	
	if( $file["error"] != UPLOAD_ERR_OK ) {
		return "";
	}
	$path = "";
	while(true) {
		$dir = sha1(microtime(true).mt_rand(0,32767));
		$path = "upload/" . $dir;
		if( !is_dir( $path ) ) {
			mkdir( $path );
		}

		$path = $path . "/" . set_path($file["name"], $c, $ri);
		if( !file_exists( $path ) ) {
			break;
		}
	}

	move_uploaded_file( $file["tmp_name"], $path );
	return $path;
}

function appendSubmission(&$msg) {	


	
	global $db, $isRunning, $isEnd, $authKey, $restriction_submit_interval, $maximum_submission_try;
	global $db_problemset_tb, $db_status_tb;
	$pid = $_POST['pid'];

	

	if( !isset( $_POST['pid'] ) || $_SESSION['key'] !=  $authKey ) {
		$msg = "올바르지 않은 접근입니다.";
		return false;
	}

	$row = $db->query_first("SELECT count(*) AS num FROM $db_problemset_tb WHERE pid = '$pid';");

	if( $row['num'] == 0 ) {
		$msg = "올바르지 않은 접근입니다.";
		return false;
	}

	$team_id = $_SESSION['id'];
	$pid = $_POST['pid'];

	$record = $db->query_first("SELECT MAX(time) FROM $db_status_tb WHERE team_id = '$team_id'");
	$lastest_submission = $record["MAX(time)"];

	$inteval = time() - strtotime($lastest_submission);
	
	if( $isEnd ) {
		$msg = "대회 시간이 아닙니다.";
		return false;
	}

	if( $inteval < $restriction_submit_interval ) {
		$msg = "$restriction_submit_interval 초 내로는 다시 제출 할 수 없습니다.";
		return false;
	}

	$record = $db->query_first("SELECT COUNT(*) AS num FROM $db_status_tb WHERE team_id = '$team_id' AND pid = '$pid';");

	if( $record['num'] >= $maximum_submission_try ) {
		$msg = "해당 문제에 대해서 더이상의 제출이 불가능합니다.";
		return false;
	}
	
	$record = $db->query_first("SELECT MAX(run_id) AS num FROM $db_status_tb");

	$run_id = $record['num'];

	$ans_path = moveUploadedFile($_FILES['answer'],"out", $run_id);
	
	if( strlen( $ans_path ) == 0 ) {
		$msg = "해답 파일이 올바르게 첨부되지 않았습니다.";
		return false;
	}

	$sol_path = moveUploadedFile($_FILES['solution'], "sol", $run_id );


	$record = array();
	$record["pid"] = $pid;
	$record["team_id"] = $team_id;
	$record["result"] = "PENDING";
	$record["output"] = $ans_path;
	$record["solution"] = $sol_path;
	$record["ip"] = get_real_ip_addr();
	$now = $db->query_insert( $db_status_tb, $record );

	$msg = "성공적으로 제출이 완료 되었습니다.<br/>제출 번호 : $now";	
	return true;


}
?>

<?
	$msg = "";
	$ret = appendSubmission($msg);
	$msgClass = "alert alert-success";
	if( !$ret ) {
		$msg = "<h4>제출 실패!</h4>" . $msg;
		$msgClass = "alert alert-error";
	}
	else {
		$msg = "<h4>제출 성공!</h4>" . $msg;
	}
?>

<div class='<?=$msgClass;?>'>
<?=$msg;?>
</div>
<?
require_once("footer.php");
?>
