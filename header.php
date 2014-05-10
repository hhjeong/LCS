<?
	require_once("db.inc.php");
	require_once("func.inc.php");
	session_start();
	$name = $_SESSION['name'];

	if( $_SESSION['key'] != $authKey ) {
?>
		<script>alert("Invalid Access!");</script>
		<script>window.location="index.php";</script>
		exit();

<?
	}

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?=$title;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<link type="text/css" rel="stylesheet" href="assets/css/table.css"/>
<!-- Le styles -->
<link href="assets/css/bootstrap.css" rel="stylesheet">
<style type="text/css">
body {
	padding-top: 60px;
	padding-bottom: 40px;
}
</style>
<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
<link href="assets/css/DT_bootstrap.css" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Fav and touch icons -->
<link rel="shortcut icon" href="assets/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
<link type="text/css" rel="stylesheet" href="assets/css/custom.css"/>
</head>


<body>

<div class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-inner">
<div class="container">
<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</a>
<a class="brand" href="main.php"><?=$title;?></a>
<div class="nav-collapse collapse">
<ul class="nav">
<li><a href="index.php">공지사항</a></li>
<li><a href="problemset.php">문제</a></li>
<li><a href="submit.php">채점하기</a></li>
<li><a href="clar.php">문의하기</a></li>
<li><a href="standing.php">순위</a></li>
<li><a href="status.php">채점기록</a></li>
</ul>

<ul class='nav pull-right'>
<li class='dropdown'><a class="dropdown-toggle" data-toggle="dropdown" href="#" style='color:#ffffff'><b class="caret"></b> 팀명 :  [ <?=$name;?>! ]</a>
<ul class='dropdown-menu'>
<li><a href="logout.php">로그 아웃</a></li>
</li>
</ul>


</ul>

</div><!--/.nav-collapse -->
</div>
</div>
</div>

<div class="container" id='container'>

