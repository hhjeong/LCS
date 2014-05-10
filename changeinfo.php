<?
	require_once("header.php");
	$id = $_SESSION['id'];
	$record = $db->query_first("SELECT * FROM bud13_account WHERE id LIKE '$id'");
	

?>

	<div class="row">
		<div class="span6 offset3">
			<form class="form-horizontal" method="POST" action="changeinfo.proc.php">
				<div class="control-group"> 
					<label class="control-label" for="handle">팀명</label>
					<div class="controls">
						<input readonly type="text" id="id" name="id" class="input-large" value='<?=$id;?>'>
					</div>
				</div>
				<div class="control-group"> 
					<label class="control-label" for="opassword">기존 비밀번호</label>
					<div class="controls">
						<input type="password" id="opassword" name="opassword" class="input-large">
					</div>
				</div>
				<div class="control-group"> 
					<label class="control-label" for="password">새로운 비밀번호</label>
					<div class="controls">
						<input type="password" id="password" name="password" class="input-large">
					</div>
				</div>
				<div class="control-group"> 
					<label class="control-label" for="password_c">한번 더 입력하기</label>
					<div class="controls">
						<input type="password" id="password_c" name="password_c" class="input-large">
					</div>
				</div>

				<div class="form-actions" style='text-align:center'>
					<button type="submit" class="btn btn-primary">변경!</button>
				</div>
			</form>
		</div>
	</div>
<?
	require_once("footer.php");
?>
