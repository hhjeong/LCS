<?php
	require_once("header.php");
	require_once("lib/markdown.php");
?>

 <div class="hero-unit">
        <h1><?=$title;?> 페이지입니다!</h1>
	<p></p>
	<h3>공지사항</h3>
	<?=Markdown(file_get_contents("notice.md"));?>
	<h3>일정</h3>
	<p>&nbsp;</p>
	<p class='alert alert-success'> 현재시간 : <?=date('Y년 n월 j일 H:i', mktime());?></p>

	<p>&nbsp;</p>
        <p style='text-align:right'>
		<a class="btn btn-primary btn-large" href="https://sites.google.com/site/2013algospotsaessagkonteseuteu/home/daehoe-gaeyo" target="_blank">대회 규정 보기 &raquo;</a>
        	<a class="btn btn-info btn-large" href="faq.php" target="_blank">사이트 사용법 보기 &raquo;</a>
	</p>
</div>

<div id="push"></div>

<?php
	require_once("footer.php");
?>
