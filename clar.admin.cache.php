
<?
session_start();

if( $_SESSION['perm'] != "admin" ) {
	exit();
}
require_once("db.inc.php");
require_once("func.inc.php");
?>


<table class='table table-hover table-bordered'>
<thead>
<th>번호</th>
<th>질문자</th>
<th>구분</th>
<th>질문 내용</th>
<th>질문 답변</th>
<th>전체 공개</th>
<th>답변하기</th>
</thead>
<?

$visible_clars = $db->fetch_all_array("SELECT clar_id, team_id, category, content, response, public FROM bud13_clar ORDER BY clar_id DESC;");
?>

<tbody>
<?
$names = get_names();
$last = 0;
foreach( $visible_clars as $row ) {
	$no = $row['clar_id'];
	$last = max( $last, $no );
	$id = $names[$row['team_id']];
	$ca = $row['category'];
	$rq = $row['content'];
	$rp = strlen( $row['response'] ) == 0 ? "미응답" : $row['response'];
	$pb =  $row['public'] == 1 ? "네" : "아니오";
	$rowColor = $rp == "미응답" ? "warning" : "";
?>
<tr class='<?=$rowColor;?>'>
<td class='td-width'><?=$no;?></td>
<td><?=$id;?></td>
<td class='td-clar-category'><?=$ca;?></td>
<td><small><?=$rq;?></small></td>
<td><small><?=$rp;?></small></td>
<td class='td-width'><?=$pb;?></td>
<td class='td-width'><a href='clar.response.php?id=<?=$no;?>'>답변하기</a></td>
</tr>
<?
}
?>
</tbody>
</table>
<input type='hidden' id='last' value='<?=$last;?>'>

<?
if($_GET['last'] != $last ) {
?>
<!--new-->
<?
}
?>
