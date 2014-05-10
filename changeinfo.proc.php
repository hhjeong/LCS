<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?
	require_once("db.inc.php");

	$backScript = "<script>history.back(-1)</script>";
	$fmt = "<script>alert(\"Error : %s\");</script>" . $backScript;

	$id = $_POST["id"];
	$opassword = $_POST["opassword"];
	$password = $_POST["password"];
	$password_c = $_POST["password_c"];
	$mail = $_POST["mail"];

	$sha1_opass = SHA1($opassword);
	$db->query("SELECT count(*) FROM bud13_account WHERE id LIKE '$id' AND password LIKE '$opassword'");
	
	if( $db->affected_rows == 0 ) {
		echo sprintf( $fmt, "옛 비밀번호가 올바르지 않습니다");
		return;
	}

	if( $password != $password_c ) {
		echo sprintf( $fmt, "입력한 두개의 새로운 password가 다릅니다.");
		return;
	}

	if( strlen( $password ) < 4 || strlen( $password ) > 32 ) {
		echo sprintf( $fmt, "password의 길이는 4자 이상 32자 이하여야 합니다!");
		return;
	}


	if( ctype_alnum( $password ) == false ) {
		echo sprintf( $fmt, "password는 영문 대소문자와 숫자로만 이뤄져야 합니다." );
		return;
	}

	$dat['password'] = $password;
	$db->query_update("bud13_account", $dat, "id LIKE '$id'");

?>

<?
	require_once("header.php");

	require_once("db.inc.php");

?>
	<div class='span6 offset2 alert alert-success'>
		<h3>변경 성공</h3>
		<p class='lead text-success'>비밀번호가 성공적으로 변경되었습니다.</p>
		<a href='main.php'>
			<button class='btn btn-primary btn-large'>Go to main</button>
		</a>
	</div>

<?
	require_once("footer.php");
?>
