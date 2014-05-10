<?

require_once("db.inc.php");
$title = '접수완료';
$alert_class =  "success";
$msg = "문의가 접수되었습니다. 문의하기 메뉴로 돌아가셔서 답변을 확인할 수 있습니다.";

if( ! $isRunning ) {
	$title ="접수 실패";
	$msg = "대회 시간이 아닙니다";
	$alert_class = "error";	
} else if( $_SERVER['REQUEST_METHOD'] == "POST" ) {
	session_start();	
	$request = array();
	$request["team_id"] = $_SESSION['id'];
	$request["category"] = strip_tags($_POST['category']);

	$ok = true;

	if( strlen( $request["category"] ) != 1 ) {
		$ok = false;
	}
	else if( $request["category"] != "N" ) {
		if( $request["category"] < "A" || $request["category"] > "J" ) $ok = false;
	}
	$request["content"] = strip_tags($_POST['question']);
	if( strlen( $request['content'] ) == 0 ) $ok = false;
	$request["public"] = false;
	
	if($ok) {
		$db->query_insert( "bud13_clar", $request );
		header("Location: clar.proc.php", true, 303);
		exit();
	}
	else {
		$title = "접수 실패";
		$msg = "올바르지 않은 입력입니다.";
		$alert_class = "error";
	}
}
require_once("header.php");
?>
<div class="row" style="margin-top:50px">
<h4><?=$title;?></h4>
<p class='alert alert-<?=$alert_class;?>'>
<?=$msg;?>
</p>
</div>

<?
require_once("footer.php");
?>
