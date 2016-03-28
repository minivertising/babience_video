<?
	include_once   "./header.php";

	$mb_phone		= $_REQUEST['mb_phone'];
	$serial			= $_REQUEST['serial'];
?>
<body>
<div id="loading_div" class="popup_wrap" style="display:none;">
  <div class="p_mid p_position">
    <div class="block_close clearfix">
      <a href="index.php" class="btn_close"><img src="images/popup/btn_close.png" /></a>
    </div>
    <div class="block_content loading">
      <div class="inner">
        <div class="img">
          <img src="images/popup/loading.gif" />
        </div>
      </div><!--inner-->
    </div>
  </div>
</div>

<!------------------ 컨셉 선택 페이지 ------------------>
<div id="concept_div" class="popup_wrap">
  <div class="p_mid p_position">
    <div class="block_close clearfix">
      <a href="index.php" class="btn_close"><img src="images/popup/btn_close.png" /></a>
    </div>        
    <div class="block_content gate">
      <div class="title_pop_main">
        <img src="images/popup/title_pop_main.png" />
      </div>            	
      <div class="inner">
        <div class="block_gate">
          <div class="title img">
            <img src="images/popup/title_gate.png" />
          </div>  
          <div class="concept">
            <div class="c_btn clearfix">
              <div class="btn"><a href="#" onclick="sel_concept('1','<?=$mb_phone?>','<?=$serial?>');return false;"><img src="images/popup/btn_c_1.png" /></a></div>
              <div class="thumb"><a href="#" onclick="open_pop('exam1_popup');return false;"><img src="images/popup/btn_c_thumb_1.png" /></a></div>
            </div>
          </div>  
          <div class="concept">
            <div class="c_btn clearfix">
              <div class="btn"><a href="#" onclick="sel_concept('2','<?=$mb_phone?>','<?=$serial?>');return false;"><img src="images/popup/btn_c_2.png" /></a></div>
              <div class="thumb"><a href="#" onclick="open_pop('exam2_popup');return false;"><img src="images/popup/btn_c_thumb_2.png" /></a></div>
            </div>
          </div>  
          <div class="concept">
            <div class="c_btn clearfix">
              <div class="btn"><a href="#" onclick="sel_concept('3','<?=$mb_phone?>','<?=$serial?>');return false;"><img src="images/popup/btn_c_3.png" /></a></div>
              <div class="thumb"><a href="#" onclick="open_pop('exam3_popup');return false;"><img src="images/popup/btn_c_thumb_3.png" /></a></div>
            </div>
          </div>  
          <div class="concept last">
            <div class="c_btn clearfix">
              <div class="btn"><a href="#" onclick="sel_concept('4','<?=$mb_phone?>','<?=$serial?>');return false;"><img src="images/popup/btn_c_4.png" /></a></div>
              <div class="thumb"><a href="#" onclick="open_pop('exam4_popup');return false;"><img src="images/popup/btn_c_thumb_4.png" /></a></div>
            </div>
          </div>
        </div>
      </div><!--inner-->
    </div>
  </div>
</div>
<!------------------ 컨셉 선택 페이지 ------------------>

<?
	include_once   "./popup_div.php";
?>
</body>
</html>
<script type="text/javascript">
var video_concept	= null;

$(document).ready(function() {
	$("#cboxTopLeft").hide();
	$("#cboxTopRight").hide();
	$("#cboxBottomLeft").hide();
	$("#cboxBottomRight").hide();
	$("#cboxMiddleLeft").hide();
	$("#cboxMiddleRight").hide();
	$("#cboxTopCenter").hide();
	$("#cboxBottomCenter").hide();
	Kakao.init('d58dc6bc022da9c054b20aff9c23e0f9');

	var yt_width = $(document).width()-20;
	var youtube_height = (yt_width / 16) * 9;
	$("#ytplayer1").width(yt_width);
	$("#ytplayer1").height(youtube_height);
	$("#ytplayer2").width(yt_width);
	$("#ytplayer2").height(youtube_height);
	$("#ytplayer3").width(yt_width);
	$("#ytplayer3").height(youtube_height);
	$("#ytplayer4").width(yt_width);
	$("#ytplayer4").height(youtube_height);

});

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74531465-1', 'auto');
  ga('send', 'pageview');

</script>