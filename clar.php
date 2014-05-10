<?
session_start();
if( $_SESSION['perm'] == "admin" ) {
	header("Location: clar.admin.php");
}

require_once("header.php");
?>

<div class="row" style='text-align:center;margin-top:50px;'>
<a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal">문의 하기</a>
</div>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">문의하기</h3>
  </div>
  <div class='modal-body'>
	  <form class='form' action='clar.proc.php' method="POST">
	  <div class='control-group'>
	    <label class='contro-label'>구분</label>
	    <div class='controls'>
	    <select name="category" class="input-block-level">
	    <option value='N'>일반</option>
	    <option value='A'>문제 A</option>
	    <option value='B'>문제 B</option>
	    <option value='C'>문제 C</option>
	    <option value='D'>문제 D</option>
	    <option value='E'>문제 E</option>
	    <option value='F'>문제 F</option>
	    <option value='G'>문제 G</option>
	    <option value='H'>문제 H</option>
	    <option value='I'>문제 I</option>
	    <option value='J'>문제 J</option>
	    </select>
	    </div>
	  </div>
	  <div class='control-group'>
	    <label class='contro-label'>문의 내용</label>
	    <div class='controls'>
	    <textarea name="question" class="input-block-level" rows="4"></textarea>
	    </div>
	  </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">닫기</button>
    <button type="submit" class="btn btn-primary">문의하기</button>
  </div>

  </form>
</div>

<div class="row" style="text-align:center;margin-top:50px;">


<table class='table table-hover table-bordered'>
<thead>
<th>번호</th>
<th>구분</th>
<th>질문 내용</th>
<th>질문 답변</th>
<th>전체 공개</th>
</thead>

<?
$team_id = $_SESSION['id'];

$visible_clars = $db->fetch_all_array("SELECT clar_id, category, content, response, public FROM bud13_clar WHERE public = 1 OR team_id = '$team_id' ORDER BY clar_id DESC;");
?>

<tbody>
<?
foreach( $visible_clars as $row ) {
	$no = $row['clar_id'];
	$ca = $row['category'];
	if( $ca == "N" ) $ca = "일반";
	else $ca = "문제 " . $ca;
	$rq = $row['content'];
	$rp = strlen( $row['response'] ) == 0 ? "미응답" : $row['response'];
	$pb =  $row['public'] == 1 ? "네" : "아니오";
?>
<tr>
<td class='td-width'><?=$no;?></td>
<td class='td-clar-category'><?=$ca;?></td>
<td><?=$rq;?></td>
<td><?=$rp;?></td>
<td class='td-width'><?=$pb;?></td>
</tr>
<?
}
?>
</tbody>
</table>
</div>
<?
require_once("footer.php");
?>

