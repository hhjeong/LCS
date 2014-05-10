<?
require_once("header.public.php");
require_once("func.inc.php");
?>
<table class='table'>
<thead>
<th>
문제 번호
</th>
<th>
문제 명
</th>
<th>
정답수
</th>
<th>
제출수
</th>
<th>
정답률
</th>

</thead>

<tbody>
<?
foreach( get_submit_stats() as $k => $v ) {
$i = $k;
$t = $v['t'];
$y = max( 0, $v['y'] );
$a = max( 0, $v['a'] );
$r = (int)(max( 0, $v['y'] / $v['a'] ) * 100.0);
$f = "danger";
if( $r >= 70 ) $f = "success";
else if( $r >= 50 ) $f = "warning";
?>
<tr>
<td><?=$i;?></td>
<td><?=$t;?></td>
<td><?=$y;?></td>
<td><?=$a;?></td>
<td><div class='progress progress-<?=$f;?>'><div class='bar' style='width:<?=$r;?>%;'></div></div></td>
</tr>

<?
}
?>
</tbody>
<?
require_once("footer.php");
?>
