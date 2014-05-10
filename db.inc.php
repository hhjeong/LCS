<?php
require_once("lib/db.class.php");

// address, account, password and name of db
$db = new Database("localhost", "root", "root", "test" );

$db->connect();
$db->query( "set character_set_client = utf8;" );
$db->query( "set character_set_connection = utf8;" );
$db->query( "set character_set_results = utf8;" );

$startTime = strtotime("2014-05-09 00:20:00"); // start time
$deadline = strtotime("2014-05-15 18:00:00"); // end time
$contestDuration = $deadline - $startTime;
$isStarted = time() >= $startTime;
$isEnd = time() > $deadline;

$curMin = (int)((time() - $startTime) / 60);
$title = "insert name of the contest here";

$minFmt = $curMin < 0 ? -$curMin . "분 전" : $curMin . "분 지남";
$minFmtStatement = $curMin < 0 ? "대회 시작까지 " .  ( -$curMin ) . "분 남았습니다!" : "대회가 시작 되었습니다. 현재 " . $curMin . "분 지났습니다.";
$isRunning = $isStarted && !$isEnd;
$lastLetter = "B"; // letter for last problem

$restriction_submit_interval = 10; // per second
$maximum_submission_try = 20; // 횟수 

$authKey = "your random auth key here";

$db_prefix = "test"; // insert prefix of table
$db_account_tb = $db_prefix . "_account";
$db_login_tb = $db_prefix . "_login";
$db_problemset_tb = $db_prefix . "_problemset";
$db_clar_tb = $db_prefix . "_clar";
$inp_dir = "input/contest2013";
$prob_dir = "problemset/contest";

?>
