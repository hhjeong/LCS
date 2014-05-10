<?
require_once("header.php");
require_once("func.inc.php");
$names = get_names();
$team_id = $_SESSION['id'];
$record = $db->fetch_all_array("SELECT * FROM $db_status_tb WHERE team_id = '$team_id' ORDER BY run_id DESC;");
$isa=false;

if( $_SESSION['perm'] == "admin" ) {
	$isa=true;
	$record = $db->fetch_all_array("SELECT * FROM $db_status_tb");
}

function t( $s ) {
	if( strlen($s) < 6 ) return $s;
	else {
		$t = "";
		for( $i = 0 ; $i < 6 ; ++$i )  $t =  $t . $s[$i];
		return $t;
	}
}
?>

<table class='table' id='status'>
<thead>
<th>제출 번호</th>
<?
if($isa) echo"<th>제출 팀</th>";
?>

<th>문제</th>
<th>결과</th>

<th>제출 시간</th>
<th>해답 파일</th>
<th>소스 파일</th>
</thead>
<tbody>
<?
foreach( $record as $row ) { 
	$run_id = $row['run_id'];
	$pid = $row['pid'];
	$result = $row['result'];
	$submission_time = $row['time'];
	$ans_path = "get.php?c=o&id=$run_id";
	$sol_path = "get.php?c=s&id=$run_id";

	$check_a = "info";
	$check_s = "info";
	$l_a = "DOWN";
	$l_s = "DOWN";
	if( $row['output'] == "" ) {
		$ans_path = "#";
		$check_a = "important";
		$l_a = "NONE";
	}
	if( $row['solution'] == "" ) {
		$sol_path = "#";
		$check_s = "important";
		$l_s = "NONE";
	}
	$team_id = $row['team_id'];
	$team_id = $team_id ."(". t($names[$team_id]) . ")";
	$rowclass = "";	
	if( $row['result'] == "PENDING" ) {
		$result = "대기";
		$rowClass = "warning";
	}
	else if( $row['result'] == "NO" ) {
		$result = "오답";
		$rowClass = "";
	}
	else if( $row['result'] == "YES" ) {
		$result = "정답";
		$rowClass = "success";
	}

?>
<tr class='<?=$rowClass;?>' >
<td><?=$run_id;?></td>
<?
if($isa) echo "<td>$team_id</td>";
?>
<td><?=$pid;?></td>
<td><?=$result;?></td>
<td><?=$submission_time;?></td>
<td><a href="<?=$ans_path;?>"><span class='label label-<?=$check_a;?>'><?=$l_a;?></span></a></td>
<td><a href="<?=$sol_path;?>"><span class='label label-<?=$check_s;?>'><?=$l_s;?></span></a></td>
</tr>
<?
}
?>
</tbody>
</table>
<?
require_once("footer.php");
?>

<script>
/* Table initialisation */
$(document).ready(function() {
	$('#status').dataTable( {
		// "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
		"aaSorting": [[ 0, "desc" ]], // 0-based index
<? if( $isa ) { ?>
		"aoColumns": [null, null, null, { "bSortable":false }, null, { "bSortable":false }, { "bSortable":false } ],
<? } else { ?>
		"aoColumns": [null, null, { "bSortable":false }, null, { "bSortable":false }, { "bSortable":false } ],

<? } ?>
		"sPaginationType": "bootstrap",
		"oLanguage": {
			"sLengthMenu": "_MENU_ records per page"
		}
	} );
} );
</script>
