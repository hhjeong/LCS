<?
require_once("header.php");
if( $_SESSION['perm'] != "admin" ) exit();
?>
<div class="row" style='text-align:center;margin-top:20px;'>
<a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal">문의 하기</a>
</div>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">문의하기</h3>
  </div>
  <div class='modal-body'>
	  <form class='form' action='clar.proc.php' method="POST">
	  <div class='control-group'>
	    <label class='contro-label'>구분</label>

	    <div class='controls'>
	    <select name="category" class="input-block-level">
	    <option value='N'>일반</option>
	    <option value='A'>문제 A</option>
	    <option value='B'>문제 B</option>
	    <option value='C'>문제 C</option>
	    <option value='D'>문제 D</option>
	    <option value='E'>문제 E</option>
	    <option value='F'>문제 F</option>
	    <option value='G'>문제 G</option>
	    <option value='H'>문제 H</option>
	    <option value='I'>문제 I</option>
	    <option value='J'>문제 J</option>
	    </select>
	    </div>
	  </div>

	  <div class='control-group'>
	    <label class='contro-label'>문의 내용</label>
	    <div class='controls'>
	    <textarea name="question" class="input-block-level" rows="4"></textarea>
	    </div>
	  </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">닫기</button>
    <button type="submit" class="btn btn-primary">문의하기</button>
  </div>

  </form>
</div>


<div id="tb" class="row" style="text-align:center;margin-top:10px;">
<?
require_once("clar.admin.cache.php");
?>
</div>

<?
require_once("footer.php");
?>
<script>
function Notifier() {}

// Returns "true" if this browser supports notifications.
Notifier.prototype.HasSupport = function() {
	if (window.webkitNotifications) {
		return true;
	} else {
		return false;
	}
}

// Request permission for this page to send notifications. If allowed,
// calls function "cb" with true.
Notifier.prototype.RequestPermission = function(cb) {
	window.webkitNotifications.requestPermission(function() {
		if (cb) { cb(window.webkitNotifications.checkPermission() == 0); }
	});
}

// Popup a notification with icon, title, and body. Returns false if
// permission was not granted.
Notifier.prototype.Notify = function(icon, title, body) {
	if (window.webkitNotifications.checkPermission() == 0) {
		var popup = window.webkitNotifications.createNotification(icon, title, body);
		popup.show();
		return true;
	}
	return false;
}

$(function() {

	var notifier = new Notifier();
	notifier.RequestPermission();
	if (!notifier.HasSupport()) {
		$("#error").show();
		return;
	}


        var j = jQuery.noConflict();
	j("#tb").everyTime(10000,function(i){
		j.ajax({
		url: "clar.admin.cache.php?last="+j("#last").val(),
		cache: false,
		success: function(html){
			if( html.indexOf("<!--new-->") != -1 ) notifier.Notify("", "Notifier", "미응답 답안이 있습니다!");
			j("#tb").html(html);
			console.log(j("#last").val());
		}
		})
	})
});
</script>
