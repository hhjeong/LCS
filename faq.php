<?
require_once("header.php");
?>

<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tabA" data-toggle="tab">메뉴 소개</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tabA">
	<h2>메뉴 소개</h2>
	<h3>공지사항</h3>
	<p>대회에 대한 변동 사항등을 공지하는 메뉴입니다.</p>
	<h3>문제</h3>
	<p>대회에 사용되는 문제를 열람할 수 있는 메뉴입니다. 해당 메뉴에서는 대회에서 사용되는 입력 데이터 역시 다운 받을 수 있습니다.</p>

	<h3>문의하기</h3>
	<p>대회 도중 문제에 대해서 궁금한 사항이나, 대회 시스템상의 문제가 있을 경우에 운영진에게 문의하기 위한 메뉴입니다.</p>
	<p>대회 중에는 문의 양이 많을 수 있기 때문에 답변이 늦어질 수 있으며, 문제에 제대로 명시되어 있는 부분에 대해서는 무응답할 수 있습니다.</p>
	
	<h3>순위</h3>
	<p>참가 팀들의 점수와 벌점, 그리고 푼 문제를 확인할 수 있는 메뉴입니다.</p>

	<h3>채점 기록</h3>
	<p>참가 팀에서 제출한 답안들에 대한 기록을 열람할 수 있는 메뉴입니다.</p>
    </div>
  </div>
</div>

<?
require_once("footer.php");
?>
