<?

require_once("db.inc.php");
//http://maddog.tistory.com/188
function get_real_ip_addr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function get_names() {
	global $db, $db_account_tb;
	$all = $db->fetch_all_array("SELECT id, name FROM $db_account_tb");
	$ret = array();

	foreach( $all as $a ) $ret[$a['id']] = $a['name'];
	return $ret;
}


function get_probs() {
	global $db, $db_problemset_tb;
	$all = $db->fetch_all_array("SELECT pid, title FROM $db_problemset_tb");
	$ret = array();

	foreach( $all as $a ) $ret[$a['pid']] = $a['title'];
	return $ret;
}

function get_submit_stats() {
	global $db, $db_status;
	$p = get_probs();

	$ret = array();
	foreach( $p as $i => $t ) {
		$ret[$i] = array();
		$ret[$i]['t'] = $t;
	
		$r = $db->query_first("SELECT COUNT(*) AS T FROM $db_status WHERE pid = '$i'");
		$ret[$i]['a'] = $r['T'];

		$r = $db->query_first("SELECT COUNT(*) AS Y FROM $db_status WHERE pid = '$i' AND result = 'YES'");
		$ret[$i]['y'] = $r['Y'];

	}
	return $ret;	
}



?>
