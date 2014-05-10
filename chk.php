<?
require_once("db.inc.php");


$a = $db->fetch_all_array("SELECT * FROM bud13_status");

$n = sizeof($a);

for( $i = 0 ; $i < $n ; ++$i ) {
	$a[$i]['output'] = filesize($a[$i]['output']);
	$a[$i]['solution'] = max( 0,filesize($a[$i]['solution']) );
}

for( $i = 0 ; $i < $n ; ++$i ) {
	for( $j = $i+1; $j < $n ; ++$j ) {
		if( $a[$i]['team_id'] == $a[$j]['team_id'] ) continue;
		if( $a[$i]['pid'] != $a[$j]['pid'] ) continue;
		echo $a[$i]['pid'] . "\t";
		echo $a[$i]['run_id'] . "\t";
		echo $a[$j]['run_id'] . "\t";
		echo $a[$i]['output'] . "\t";
		echo $a[$j]['output'] . "\t";
		echo $a[$i]['solution'] . "\t";
		echo $a[$j]['solution'] . "\n";
	}
}

