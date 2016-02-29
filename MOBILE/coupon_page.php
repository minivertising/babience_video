<?
	include_once   "./header.php";

	$serial		= $_REQUEST['serial'];

	$query 	= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_serial='".$serial."'";
	$result 	= mysqli_query($my_db, $query);
	$member_info	= mysqli_fetch_array($result);
?>
<body>
<div class="sec_top">
  <div class="inner_sec_top">
    <a href="#"><img src="images/logo.png" width="80" /></a>
  </div>
</div>
<div class="popup_wrap">
  <div class="p_mid p_position">
    <div class="block_content movie">
      <div class="inner">
        <div class="title img">
          <img src="images/popup/top_2.jpg" />
        </div>
        <div class="mv">
          <div class="title">
            <div class="text">
            "폭풍성장의 비밀"
            </div>
            <div class="bg img"><img src="images/popup/title_movie_c_1.png" /></div>
          </div>
          <div class="name">
          <?=$member_info['mb_baby_name']?><span><img src="images/popup/label_baby.png" width="35" /></span>
          </div>
          <div class="youtube">
            <video src="../files/<?=$serial?>/growmovie.mp4" controls preload="auto" id="video_player"></video>
          </div>
        </div>
      </div><!--inner-->
    </div>  
    <div class="block_content ending_sns">
      <div class="inner">
        <div class="share">
          <img src="images/popup/txt_sns.png" class="txt_sns"/>
        <div>
        <a href="#" onclick="sns_share('kt','share');return false;"><img src="images/popup/btn_kt.png" /></a>
        <a href="#" onclick="sns_share('ks','share');return false;"><img src="images/popup/btn_ks.png" /></a>
        <a href="#" onclick="sns_share('fb','share');return false;"><img src="images/popup/btn_fb.png" /></a>
      </div>
    </div>
    <div class="btn_block">
      <a href="http://grow.babience-event.com" target="_blank" class="img"><img src="images/popup/btn_onemore.png" /></a>
    </div>
  </div><!--inner-->
</div>
        </div>
	</div> 
 
    
</body>
</html>
<script type="text/javascript">

$(document).ready(function(){
	$("#video_player").width($(".youtube").width());
});
</script>