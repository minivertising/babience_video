<?
	include_once   "./header.php";
?>
<body>
<div class="sec_top">
  <div class="inner_sec_top">
    <a href="#"><img src="images/logo.png" width="80" /></a>
  </div>
</div>
<div class="sec_top_visual">
  <div class="inner_sec_top img">
    <img src="images/img_sec_top_visual.jpg" />
  </div>
</div>
<div class="sec_movie">
  <div class="inner_sec_movie" style="background:#a3e2eb">
    <iframe allowfullscreen="1" src="<?=$_gl['youtube_url']?>" frameborder="0" id="ytplayer" class="ytplayer"></iframe>
  </div>
</div>
<div class="sec_btn">
  <div class="inner_sec_btn">
    <div class="img btn_make"><a href="popup_input1.php"><img src="images/btn_make.png" /></a></div>
    <div class="img"><img src="images/bg_btn.jpg" /></div>
  </div>
</div>
<div class="sec_gift">
  <div class="inner_sec_gift">
    <div class="img"><img src="images/img_gift.jpg" /></div>
  </div>
</div>
<div class="sec_banner">
  <div class="inner_sec_banner">
    <div class="img"><a href="#"><img src="images/banner_change.jpg" /></a></div>
  </div>
</div>
<div class="sec_footer">
  <div class="inner_sec_footer">
    <div class="img"><a href="#" onclick="show_notice();return false;"><img src="images/footer.jpg" /></a></div>
    <div class="img txt" id="notice_div" style="display:none;"><img src="images/footer_noti.jpg" /></div>
  </div>
</div>
<?
	include_once   "./popup_div.php";
?>
 </body>
</html>
<script type="text/javascript">
var notice_flag		= 0;
$(document).ready(function() {
	$("#cboxTopLeft").hide();
	$("#cboxTopRight").hide();
	$("#cboxBottomLeft").hide();
	$("#cboxBottomRight").hide();
	$("#cboxMiddleLeft").hide();
	$("#cboxMiddleRight").hide();
	$("#cboxTopCenter").hide();
	$("#cboxBottomCenter").hide();

	var yt_width = $(".inner_sec_movie").width();
	var youtube_height = (yt_width / 16) * 9;
	$("#ytplayer").width(yt_width);
	$("#ytplayer").height(youtube_height);

});

function show_notice()
{
	if (notice_flag == 0)
	{
		$("#notice_div").show();
		document.body.scrollTop = document.body.scrollHeight;
		notice_flag	= 1;
	}else{
		$("#notice_div").hide();
		notice_flag	= 0;
	}
}


</script>