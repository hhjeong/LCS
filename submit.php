<?
	require_once("header.php");
?>
<?
if(1) {
?>


<div class='row'>

<div class="span6 offset3">
<div class='docs' style='padding-top:10px;'>
<h3>제출하기</h3>
<hr/>
<form class='form' action="submit.proc.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="MAX_FILE_SIZE" value="1048576">
<div class='control-group'>
	<label class='control-label'>제출 문제</label>
	<div class='controls'>
		<select name='pid'>
		<?
			$sql = "SELECT * FROM $db_problemset_tb";
			
			$rows = $db->fetch_all_array($sql);

			foreach( $rows as $record ) {

				$content = $record['pid'] . " - " . $record['title'];
		?>
				<option value=<?=$record['pid'];?>>
				<?=$content;?>
				</option>
		<?
			}

		?>
		</select>
	</div>
</div>
<div class='control-group'>
	<label class='control-label'>정답 파일</label>
	<div class="input-append">
		<input type='file' name='answer' id='input_answer'>
	</div>
</div>

<div class='control-group'>
	<label class='control-label'>소스 파일(묶음)</label>
	<div class="input-append">
		<input type='file' name='solution' id='input_solution'>
	</div>
</div>
<div class='' style='text-align:right'>
<button type="submit" class="btn btn-primary">제출</button>
</div>

</form>

</div>

<h4>주의 사항</h4>
<ul>
<li><strong>정답 파일</strong>은 문제에 주어진 입력 파일을 자신이 작성한 프로그램을 통해서 출력된 파일을 뜻합니다.</li>
<li><strong>소스 파일</strong>은 문제를 풀기 위해 자신이 작성한 프로그램의 코드를 뜻합니다. 만약에 프로그램을 이용해서 풀지 않았을 경우 간단한 해법을 txt파일형식으로 작성하여 올려주시기 바랍니다.</li>
<li>정답 파일과 소스파일의 용량제한을 각각 1M로 제한되니 유의하시길 바랍니다.</li>
<li>반드시 정답 파일과 소스 파일이 제출되야 하며, 소스파일이 여럿일 경우 압축하여 제출해주세요.</li>
</ul>
</div> 

</div> <!-- end of row class -->

<?
}
	require_once("footer.php");
?>

