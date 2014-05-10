<?
require_once("header.public.php");
session_start();
if( $_SESSION['perm'] != "admin" ) exit();

?>

<?
require_once("db.inc.php");

$problemset_info = array();
foreach( $db->fetch_all_array("SELECT pid, score FROM bud13_problemset") as $record ) {
	$problemset_info[$record['pid']] = $record['score'];
}

$submissions = $db->fetch_all_array("SELECT team_id, pid, result, time  FROM bud13_status ORDER BY time ASC");

$solved = array();
$nTry = array();
$yesTime = array();
$detail = array();
foreach( $submissions as $row ) {
	$team_id = $row['team_id'];
	$pid = $row['pid'];
	$result = $row['result'];
	$time = strtotime($row['time']) - $startTime;
	if( $time > $contestDuration ) continue;
	$time = (int)$time/60;

	if( !isset( $solved[$team_id] ) ) {
		$solved[$team_id] = array();
		$nTry[$team_id] = array();
		$yesTime[$team_id] = array();
		$detail[$team_id] = "";
		foreach( $problemset_info as $_pid => $weight ) {
			$solved[$team_id][$_pid] = false;
			$nTry[$team_id][$_pid] = 0;
			$yesTime[$team_id][$_pid] = NULL;
		}
	}

	if( $nTry[$team_id][$pid] >= 10 ) continue;
	if( $solved[$team_id][$pid] ) continue;

	$nTry[$team_id][$pid]++;
	if( $result == "YES" ) {
		$solved[$team_id][$pid] = true;
		$yesTime[$team_id][$pid] = $time;
	}

}

function appendResult( $pid, $solved, $nwtry ) {
	if( $solved ) {
		if( $nwtry == 0 ) return "<span class='label label-success'>$pid</span>";
		else return "<span class='label label-success'>$pid+$nwtry</span>";
	}
	else {	
		return "<span class='label label-important'>$pid+$nwtry</span>";
	}

}

foreach( $solved as $team_id => $values ) {
	foreach( $problemset_info as $pid => $weight ) {
			
		if( !isset( $solved[$team_id][$pid] ) ) continue;
		if( $solved[$team_id][$pid] ) {
			$detail[$team_id] = $detail[$team_id] .  " " . appendResult( $pid, true, $nTry[$team_id][$pid] - 1 );
		}
		else if( !$solved[$team_id][$pid] && $nTry[$team_id][$pid] ) {
			$detail[$team_id] = $detail[$team_id] . " " .appendResult( $pid, false, $nTry[$team_id][$pid] );

		}
	}
}



function cmp( $a, $b ) {
	if( $a['score'] != $b['score'] ) {
		return ( $a['score'] > $b['score'] ? -1 : 1 );
	}

	if( $a['penalty'] != $b['penalty'] ) {
		return ( $a['penalty'] < $b['penalty'] ? -1 : 1 );
	}

	return 0;
}

$teams_info = $db->fetch_all_array("SELECT *  FROM bud13_account WHERE nmember > 1 ");

foreach( $teams_info as $index => $value ) {
	unset( $teams_info[$index]["perm"] );
	unset( $teams_info[$index]["password"] );

	$teams_info[$index]['score'] = 0;
	$teams_info[$index]['penalty'] = 0;
		
	$team_id = $teams_info[$index]['id'];
	$lastYes = 0;
	$nwrongTries = 0;

	if( !isset($solved[$team_id]) ) {
		unset( $teams_info[$index] );
		continue;
	}

	foreach( $problemset_info as $pid => $weight ) {
		if( isset( $solved[$team_id][$pid] ) && $solved[$team_id][$pid] ) {
			$lastYes = (int)max( $lastYes, $yesTime[$team_id][$pid] );
			$nwrongTries += $nTry[$team_id][$pid] - 1;
			$teams_info[$index]['score'] += (int)$weight;	
		}
	}
	$teams_info[$index]['penalty'] = $lastYes + $nwrongTries * 4;
	$teams_info[$index]['rank'] = 0;

	if( $teams_info[$index]["ad"] == 1 ) {
		$teams_info[$index]['penalty'] = max(0,$lastYes + $nwrongTries * 4-20);
	}

}

uasort( $teams_info, "cmp" );

$r = 1;
$prev = NULL;
foreach( $teams_info as $index => $value ) {
	if( $prev == NULL || cmp( $prev, $teams_info[$index] ) != 0 ) {
		$teams_info[$index]["rank"] = $r;
	}
	else {
		$teams_info[$index]["rank"] = $prev["rank"];
	}
	++$r;
	$prev = $teams_info[$index];
}

?>

<div class="page-header">
<h1>순위표(단체)</h1>
</div> 

<div class='alert alert-success'>
<i class='icon-time'></i> <b>최종 갱신 시간 : </b> <?=date('H시 i분', mktime());?> <b>(<?=$minFmt;?>)</b>

</div>


<table class='table table-hover table-bordered'>
<thead>
<th>순위</th>
<th>팀명</th>
<th>점수</th>
<th>벌점</th>
<th>상태</th>
</thead>

<?
foreach( $teams_info as $index => $value ) {
	$rank = $teams_info[$index]["rank"];
	$team_id = $teams_info[$index]["id"];
	$team_name = $teams_info[$index]["name"];
	$score = (int)$teams_info[$index]["score"] ;
	$penalty = $teams_info[$index]["penalty"];


	if( $teams_info[$index]["ad"] == 1 ) {
		$team_name = $team_name . " <span class='badge badge-important'><small>SNS</small></span>";
	}
	$badgeClass = "";
	if( $rank == 1 ) $badgeClass = "badge-gold";
	else if( $rank == 2 ) $badgeClass = "badge-silver";
	else if( $rank == 3 ) $badgeClass = "badge-bronze";

?>
<tr>

<td>
<span class='badge <?=$badgeClass;?>'>
<?=$rank;?>
</span>
</td>

<td><?=$team_name;?></td>

<td>
<?=$score;?>
</td>
<td>
<?=$penalty;?>
</td>
<td>
<?=$detail[$team_id];?>
</td>
</tr>

<?
}
?>

</table>

<?
require_once("footer.php");
?>
