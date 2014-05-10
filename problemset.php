<?
require_once("header.php");
require_once("view.problem.php");
?>

<?
if( $_SESSION['perm'] != "admin" && !$isStarted ) {
?>
<div class="hero-unit">
<h1>대회 시간이 아닙니다!</h1>
</div>

<?
	require_once("footer.php");
	exit();
} else {

?>


<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tabA" data-toggle="tab">문제 A</a></li>
    <? for( $a = 'B' ; $a <= $lastLetter ; ++$a ) { ?>
	    <li><a href="#tab<?=$a;?>" data-toggle="tab">문제 <?=$a;?></a></li>
    <? } ?>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tabA">
	<?=get_p('A');?>
    </div>
    <? for( $a = 'B' ; $a <= $lastLetter ; ++$a ) { ?>
    <div class="tab-pane" id="tab<?=$a;?>">
	<?=get_p($a);?>
    </div>
    <? } ?>
  </div>
</div>
<? 
}
?>

<?
require_once("footer.php");
?>
