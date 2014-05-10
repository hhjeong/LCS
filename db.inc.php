<?php
require_once("lib/db.class.php");
$db = new Database("localhost", "your account", "your password", "you dbname" );
$db->connect();
$db->query( "set character_set_client = utf8;" );
$db->query( "set character_set_connection = utf8;" );
$db->query( "set character_set_results = utf8;" );

$startTime = strtotime("2013-05-01 16:30:00"); // start time
$deadline = strtotime("2013-05-05 18:00:00"); // end time
$contestDuration = $deadline - $startTime;
$isStarted = time() >= $startTime;
$isEnd = time() > $deadline;

$curMin = (int)((time() - $startTime) / 60);
$title = "insert name of the contest here";

$minFmt = $curMin < 0 ? -$curMin . "분 전" : $curMin . "분 지남";
$minFmtStatement = $curMin < 0 ? "대회 시작까지 " .  ( -$curMin ) . "분 남았습니다!" : "대회가 시작 되었습니다. 현재 " . $curMin . "분 지났습니다.";
$isRunning = $isStarted && !$isEnd;

$restriction_submit_interval = 10; // per second
$maximum_submission_try = 20; // 횟수 
$authKey = "your random auth key here";

$db_prefix = "bud";
?>
