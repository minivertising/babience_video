<?
	include_once   "./header.php";
?>
<body>
<div class="popup_wrap">
  <div class="p_mid p_position">
    <div class="block_close clearfix">
      <a href="#" class="btn_close"><img src="images/popup/btn_close.png" /></a>
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
            <div class="label img"><img src="images/popup/label_concept_1.png" /></div>
            <div class="c_btn clearfix">
              <div class="btn"><a href="#" onclick="sel_concept('1');return false;"><img src="images/popup/btn_c_1.png" /></a></div>
              <div class="thumb"><a href="#"><img src="images/popup/btn_c_thumb_1.png" /></a></div>
            </div>
          </div>  
          <div class="concept">
            <div class="label img"><img src="images/popup/label_concept_2.png" /></div>
            <div class="c_btn clearfix">
              <div class="btn"><a href="#" onclick="sel_concept('2');return false;"><img src="images/popup/btn_c_2.png" /></a></div>
              <div class="thumb"><a href="#"><img src="images/popup/btn_c_thumb_2.png" /></a></div>
            </div>
          </div>  
          <div class="concept">
            <div class="label img"><img src="images/popup/label_concept_3.png" /></div>
            <div class="c_btn clearfix">
              <div class="btn"><a href="#" onclick="sel_concept('3');return false;"><img src="images/popup/btn_c_3.png" /></a></div>
              <div class="thumb"><a href="#"><img src="images/popup/btn_c_thumb_3.png" /></a></div>
            </div>
          </div>  
           <div class="concept">
            <div class="label img"><img src="images/popup/label_concept_4.png" /></div>
            <div class="c_btn clearfix">
              <div class="btn"><a href="#" onclick="sel_concept('4');return false;"><img src="images/popup/btn_c_4.png" /></a></div>
              <div class="thumb"><a href="#"><img src="images/popup/btn_c_thumb_4.png" /></a></div>
            </div>
          </div>
        </div>
      </div><!--inner-->
    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">
var video_concept	= null;
function sel_concept(param)
{
	video_concept = param;

	$("#concept_div").hide();
	$("#input_baby_div").show();
}
</script>