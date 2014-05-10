<?
require_once("header.php");

$id = $_GET['id'];

$r = $db->query_first("SELECT * FROM bud13_clar WHERE clar_id = $id");

$team_id = $r['team_id'];
$category = $r['category'];
$content = $r['content'];
$response = $r['response'];
$public = $r['public'];

$checked = array();
$checked[0] = $public == 0 ? "checked" : "";
$checked[1] = $public == 1 ? "checked" : "";
?>

<div class="row span6 offset2" style='margin-top:50px'>
<form action="clar.response.proc.php" method="POST">

<div class="content-group">
<label>번호</label>
<div class="controls">
	<input class='input-block-level' type="text" name="clar_id" readonly value='<?=$id;?>'>
</div>
</div>

<div class="content-group">
<label>구분</label>
<div class="controls">
	<input class='input-block-level' type="text" readonly name="category" value='<?=$category;?>'>
</div>
</div>

<div class="content-group">
<label>질문</label>
<div class="controls">
	<textarea class='input-block-level' type="text" name="content" rows=5 readonly><?=$content;?></textarea>
</div>
</div>


<div class="content-group">
<label>답변</label>
<div class="controls">
	<textarea class='input-block-level' type="text" name="response" rows=5><?=$response;?></textarea>
</div>
</div>


<div class="content-group">
<label>공개여부</label>
<div class="controls">
<label class="radio">
<input type="radio" name="public" value="0" <?=$checked[0];?> > 아니오
</label>

<label class="radio">
<input type="radio" name="public" value="1" <?=$checked[1];?> > 예
</label>
</div>
</div>


<button type="submit" class="btn btn-primary">제출</button>
</form>
</div>
<?
require_once("footer.php");
?>

