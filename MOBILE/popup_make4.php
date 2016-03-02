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

<!------------------ 아기 정보 (이름, 나이, 사진) 입력 페이지 ------------------>
<div id="input_baby_div" class="popup_wrap">
  <div class="p_mid p_position">
    <div class="block_close clearfix">
      <a href="index.php" class="btn_close"><img src="images/popup/btn_close.png" /></a>
    </div>        
    <div class="block_content make">
      <div class="title_make img">
        <img src="images/popup/title_make_sub_4.png" />
      </div>
      <div class="btn_sample img">
        <a href="#" onclick="open_pop('exam4_popup');return false;"><img src="images/popup/btn_sample.png" /></a>
      </div>
      <div class="img_process img">
        <a href="#"><img src="images/popup/img_process.png" /></a>
      </div>
      <div class="input_block">
        <div class="title img">
          <img src="images/popup/title_input_2.png" />
        </div>                    
        <div class="inner_input_block">
          <div class="input_one">
            <div class="inner_input_one clearfix">
              <div class="input"><input type="text" name="mb_baby_name" id="mb_baby_name" placeholder="아기 이름" onkeyup="ins_caption('b_name');return false;"></div>
            </div>
          </div>
          <div class="input_one">
            <div class="inner_input_one clearfix">
              <div class="input"><input type="tel" name="mb_baby_age" id="mb_baby_age" placeholder="아기 나이 (숫자만 넣어주세요)" onkeyup="ins_caption('b_age');return false;"></div>
            </div>
          </div>
        </div>      
      </div>
      <!--프레임1-->
      <div class="pics frame_1">
        <input type="hidden" id="up_images1" value="">
        <div class="inner_pics">
          <div class="title_frame img"><img src="images/popup/title_frame_1_1.png" /></div>
          <div class="pc_frame">
            <div class="upload" id="up_img_div1">
              <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>
                  <div id="files">
                    <a href="#"><img src="images/popup/btn_up.png" id="up_img1" /></a>
                  </div>
                </span>
                <input id="fileupload" type="file" name="files[]" >
              </span>
            </div>
            <div class="text f_4_1" id="imsi_caption1">성장타이틀</div>
            <div class="p_img f_4_1" id="user_img1">소비자 합성 이미지</div><!--소비자 합성 이미지-->
            <div class="front_img img"><img src="images/popup/img_frm_4_1.png" id="user_ex_img1"/></div>
            <div class="bg img"><img src="images/popup/frm_b_bg.jpg" /></div>
          </div>
          <div class="pic_input">
            <div class="input"><input type="text" name="mb_caption1" id="mb_caption1" placeholder="타이틀을 넣어주세요(20자 이내)" onkeyup="ins_caption('1');return false;"></div>
          </div>
        </div>
      </div>
      <!--END:프레임1-->

      <!--프레임2-->
      <div class="pics frame_1">
        <input type="hidden" id="up_images2" value="">
        <div class="inner_pics">
          <div class="title_frame img"><img src="images/popup/title_frame_1_2.png" /></div>
          <div class="pc_frame">
            <div class="upload" id="up_img_div2">
              <!-- <a href="#"><img src="images/popup/btn_up.png" /></a> -->
              <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>
                  <div id="files2">
                    <a href="#"><img src="images/popup/btn_up.png" id="up_img2" /></a>
                  </div>
                </span>
                <input id="fileupload2" type="file" name="files[]" >
              </span>
            </div>
            <div class="name f_4_2 imsi_caption_baby"></div>
            <div class="text f_4_2" id="imsi_caption2">자막</div>
            <div class="p_img f_4_2" id="user_img2">이미지</div><!--소비자 합성 이미지-->
            <div class="front_img img"><img src="images/popup/img_frm_4_2.png" id="user_ex_img2" /></div>
            <div class="bg img"><img src="images/popup/frm_b_bg.jpg" /></div>
          </div>
          <div class="pic_input">
            <div class="input"><input type="text" name="mb_caption2" id="mb_caption2" placeholder="자막을 넣어주세요(20자 이내)" onkeyup="ins_caption('2');return false;"></div>
          </div>
        </div>
      </div>
      <!--END:프레임2-->

      <!--프레임3-->
      <div class="pics frame_1">
        <input type="hidden" id="up_images3" value="">
        <div class="inner_pics">
          <div class="title_frame img"><img src="images/popup/title_frame_1_3.png" /></div>
          <div class="pc_frame">
            <div class="upload" id="up_img_div3">
              <!-- <a href="#"><img src="images/popup/btn_up.png" /></a> -->
              <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>
                  <div id="files3">
                    <a href="#"><img src="images/popup/btn_up.png" id="up_img3" /></a>
                  </div>
                </span>
                <input id="fileupload3" type="file" name="files[]" >
              </span>
            </div>
            <div class="name f_4_2 imsi_caption_baby"></div>
            <div class="text f_4_2" id="imsi_caption3">자막</div>
            <div class="p_img f_4_2" id="user_img3">이미지</div><!--소비자 합성 이미지-->
            <div class="front_img img"><img src="images/popup/img_frm_4_3.png" id="user_ex_img3" /></div>
            <div class="bg img"><img src="images/popup/frm_b_bg.jpg" /></div>
          </div>
          <div class="pic_input">
            <div class="input"><input type="text" name="mb_caption3" id="mb_caption3" placeholder="자막을 넣어주세요(20자 이내)" onkeyup="ins_caption('3');return false;"></div>
          </div>
        </div>
      </div>
      <!--END:프레임3-->

      <!--프레임4-->
      <div class="pics frame_1">
        <input type="hidden" id="up_images4" value="">
        <div class="inner_pics">
          <div class="title_frame img"><img src="images/popup/title_frame_1_4.png" /></div>
          <div class="pc_frame">
            <div class="upload" id="up_img_div4">
              <!-- <a href="#"><img src="images/popup/btn_up.png" /></a> -->
              <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>
                  <div id="files4">
                    <a href="#"><img src="images/popup/btn_up.png" id="up_img4" /></a>
                  </div>
                </span>
                <input id="fileupload4" type="file" name="files[]" >
              </span>
            </div>
            <div class="name f_4_4 imsi_caption_baby"></div>
            <div class="text f_4_4" id="imsi_caption4">자막</div>
            <div class="p_img f_4_4" id="user_img4">예시 이미지</div><!--소비자 합성 이미지-->
            <div class="front_img img"><img src="images/popup/img_frm_4_4.png" id="user_ex_img4" /></div>
            <div class="bg img"><img src="images/popup/frm_b_bg.jpg" /></div>
          </div>
          <div class="pic_input">
            <div class="input"><input type="text" name="mb_caption4" id="mb_caption4" placeholder="자막을 넣어주세요(20자 이내)" onkeyup="ins_caption('4');return false;"></div>
          </div>
        </div>
      </div>
      <!--END:프레임4-->

      <!--프레임5--><!--5번째 컷에는 자막 없음-->
      <div class="pics frame_5">
        <input type="hidden" id="up_images5" value="">
        <div class="inner_pics">
          <div class="title_frame img"><img src="images/popup/title_frame_1_5.png" /></div>
          <div class="pc_frame">
            <div class="upload" id="up_img_div5">
              <!-- <a href="#"><img src="images/popup/btn_up.png" /></a> -->
              <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>
                  <div id="files5">
                    <a href="#"><img src="images/popup/btn_up.png" id="up_img5" /></a>
                  </div>
                </span>
                <input id="fileupload5" type="file" name="files[]" >
              </span>
            </div>
            <div class="p_img f_4_5" id="user_img5">예시 이미지</div><!--소비자 합성 이미지-->
            <div class="front_img img"><img src="images/popup/img_frm_4_5.png" id="user_ex_img5" /></div>
            <div class="bg img"><img src="images/popup/frm_b_bg.jpg" /></div>
          </div>
        </div>
      </div>
      <!--END:프레임5-->

      <div class="btn_make img">
        <a href="#" onclick="create_movie();return false;"><img src="images/popup/btn_make.png" /></a>
      </div>
    </div>
  </div>
</div>
<!------------------ 아기 정보 (이름, 나이, 사진) 입력 페이지 ------------------>

	<div id="movie_div" class="popup_wrap" style="display:none;">
   	  	<div class="p_mid p_position">

			<div class="block_close clearfix">
                <a href="index.php" class="btn_close"><img src="images/popup/btn_close.png" /></a>
            </div>        
            <div class="block_content movie">
            	<div class="inner">
                	<div class="title img">
                    	<img src="images/popup/top_2.jpg" />
                    </div>
                	<div class="mv">
                    	<div class="title">
                        	
                        	<div class="text cap1_txt">
                            	"폭풍 성장의 비밀"
                            </div>
						    <div class="bg img"><img src="images/popup/title_movie_c_4.png" /></div>
                        </div>
                        <div class="name" id="video_b_name">
                            	김서우<span><img src="images/popup/label_baby.png" width="35" /></span>
                            </div>
                        <div class="youtube">
                        	<video src="../files/out.mp4" controls preload="auto" id="video_player" poster="scene/concept_4_1.jpg"></video>
                        </div>
                    </div>
<?
	if ($iPhoneYN == "N")
	{
?>
                    <div class="btn_block img">
                    	<a href="../files/out.mp4" download id="download_src"><img src="images/popup/btn_down.png" /></a>
                    </div>
<?
	}
?>
                    <div class="btn_block_2 img">
                    	<a href="#" onclick="prev_page();return false;"><img src="images/popup/btn_before.png" /></a>
                    	<a href="#" onclick="next_page();return false;"><img src="images/popup/btn_m_next_coupon.png" id="next_image"/></a>
                        <!--<a href="#"><img src="images/popup/btn_m_next.png" /></a>-->
                    </div>
                </div><!--inner-->
            </div>
        </div>
	</div>

<!------------------------------ 체험팩 쿠폰 받을 사람 엔딩 ------------------------------>
<div id="end_coupon_div" class="popup_wrap" style="display:none;">
  <div class="p_mid p_position">
    <div class="block_close clearfix">
      <a href="index.php" class="btn_close"><img src="images/popup/btn_close.png" /></a>
    </div>        
    <div class="block_content coupon">
      <div class="inner">
        <div class="coupon_img">
          <div class="serial">serial</div>
          <div class="img"><img src="images/popup/bg_coupon.jpg" /></div>
        </div>
        <div class="btn_home_block">
          <div class="img">
            <img src="images/popup/txt_go_home.png" />
          </div>
          <div class="btn_block">
            <a href="http://www.babience.com/m/index.jsp" class="img"><img src="images/popup/btn_home.png" /></a>
          </div>
        </div>
      </div><!--inner-->
    </div>
        
    <div class="block_content ending_sns">
      <div class="inner">
        <div class="share">
          <img src="images/popup/txt_sns.png" class="txt_sns"/>
          <div>
            <!-- <a href="#" onclick="sns_share('kt','share');return false;"><img src="images/popup/btn_kt.png" /></a> -->
            <a href="#" onclick="sns_share('ks','share');return false;"><img src="images/popup/btn_ks.png" /></a>
            <a href="#" onclick="sns_share('fb','share');return false;"><img src="images/popup/btn_fb.png" /></a>
          </div>
        </div>
        <div class="btn_block">
          <a href="index.php" class="img"><img src="images/popup/btn_main.png" /></a>
        </div>
      </div><!--inner-->
    </div>
  </div>
</div>
<!------------------------------ 체험팩 쿠폰 받을 사람 엔딩 ------------------------------>

<!------------------------------ 체험팩 쿠폰 이미 받은 사람 엔딩 ------------------------------>
<div id="end_sns_div" class="popup_wrap" style="display:none">
  <div class="p_mid p_position">
    <div class="block_close clearfix">
      <a href="index.php" class="btn_close"><img src="images/popup/btn_close.png" /></a>
    </div>  
    <div class="block_content movie">
      <div class="inner">
        <div class="title img">
          <img src="images/popup/top_2.jpg" />
        </div>
        <div class="mv">
          <div class="title">
            <div class="text cap1_txt">
            "폭풍 성장의 비밀"
            </div>
            <div class="bg img"><img src="images/popup/title_movie_c_1.png" /></div>
          </div>
          <div class="name">
          <span id="sns_b_name">김서우</span><span><img src="images/popup/label_baby.png" width="35" /></span>
          </div>
        </div>
        <!-- 태그 추가 0302 -->
        <!-- <div class="img">
          <a href="http://grow.babience-event.com/MOBILE/coupon_page.php?serial=<?=$serial?>" target="_blank"><img src="images/popup/btn_go_mybaby.png" /></a>
        </div> -->
        <!-- end 태그 추가 0302 -->
        <!-- 태그 추가 0302 -->
        <div class="share_url">
          <div class="url"><a href="http://grow.babience-event.com/MOBILE/coupon_page.php?serial=<?=$serial?>" onclick="return false;">http://grow.babience-event.com/MOBILE/coupon_page.php?serial=<?=$serial?></a></div>
          <div class="txt">URL을 길게 누르시면 복사하실 수 있습니다.</div>
        </div>
        <!-- end 태그 추가 0302 -->
      </div><!--inner-->
    </div>  
    <div class="block_content ending_sns">
      <div class="inner">
        <div class="share">
          <img src="images/popup/txt_sns.png" class="txt_sns"/>
          <div>
            <!-- <a href="#" onclick="sns_share('kt','share');return false;"><img src="images/popup/btn_kt.png" /></a> -->
            <a href="#" onclick="sns_share('ks','share');return false;"><img src="images/popup/btn_ks.png" /></a>
            <a href="#" onclick="sns_share('fb','share');return false;"><img src="images/popup/btn_fb.png" /></a>
          </div>
        </div>
        <div class="btn_block">
          <a href="index.php" class="img"><img src="images/popup/btn_main.png" /></a>
        </div>
      </div><!--inner-->
    </div>
    <div class="img end_gift">
      <img src="images/popup/end_gift.jpg" />
    </div>
  </div>
</div>
<!------------------------------ 체험팩 쿠폰 이미 받은 사람 엔딩 ------------------------------>
<?
	include_once   "./popup_div.php";
?>
</body>
</html>
<script type="text/javascript">
var video_concept	= null;
var user_gubun				= 0;
var user_ex_img1_w	= 0;
var user_ex_img1_h		= 0;
var user_ex_img2_w	= 0;
var user_ex_img2_h		= 0;
var user_ex_img3_w	= 0;
var user_ex_img3_h		= 0;
var user_ex_img4_w	= 0;
var user_ex_img4_h		= 0;
var user_ex_img5_w	= 0;
var user_ex_img5_h		= 0;
var user_ex_img1	= 0;
var user_ex_img2	= 0;
var user_ex_img3	= 0;
var user_ex_img4	= 0;
var user_ex_img5	= 0;

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
	$("#ytplayer2").width(yt_width - 19);
	$("#ytplayer2").height(youtube_height);
	$("#ytplayer3").width(yt_width - 19);
	$("#ytplayer3").height(youtube_height);
	$("#ytplayer4").width(yt_width - 19);
	$("#ytplayer4").height(youtube_height);

	user_ex_img1_h		= $("#user_ex_img1").height();
	user_ex_img1_w		= $("#user_ex_img1").width();
	user_ex_img2_h		= $("#user_ex_img2").height();
	user_ex_img2_w		= $("#user_ex_img2").width();
	user_ex_img3_h		= $("#user_ex_img3").height();
	user_ex_img3_w		= $("#user_ex_img3").width();
	user_ex_img4_h		= $("#user_ex_img4").height();
	user_ex_img4_w		= $("#user_ex_img4").width();
	user_ex_img5_h		= $("#user_ex_img5").height();
	user_ex_img5_w		= $("#user_ex_img5").width();

});

function create_movie()
{
	$("#loading_div").show();
	$("#input_baby_div").hide();

	var mb_baby_name		= $("#mb_baby_name").val();
	var mb_baby_age			= $("#mb_baby_age").val();
	var up_images1				= $("#up_images1").val();
	var up_images2				= $("#up_images2").val();
	var up_images3				= $("#up_images3").val();
	var up_images4				= $("#up_images4").val();
	var up_images5				= $("#up_images5").val();
	var mb_caption1			= $("#mb_caption1").val();
	var mb_caption2			= $("#mb_caption2").val();
	var mb_caption3			= $("#mb_caption3").val();
	var mb_caption4			= $("#mb_caption4").val();
	//var mb_caption5			= $("#mb_caption5").val();
	if (mb_baby_name == "")
	{
		alert('아기 이름을 입력해 주세요.');
		//chk_ins = 0;
		$("#loading_div").hide();
		$("#input_baby_div").show();
		$("#mb_baby_name").focus();
		return false;
	}

	if (mb_baby_age == "")
	{
		alert('아기 나이를 입력해 주세요.');
		//chk_ins = 0;
		$("#loading_div").hide();
		$("#input_baby_div").show();
		$("#mb_baby_age").focus();
		return false;
	}

	if (up_images1 == "" || up_images2 == "" || up_images5 == "")
	{
		alert('필수 이미지는 모두 업로드해 주세요.');
		//chk_ins = 0;
		$("#loading_div").hide();
		$("#input_baby_div").show();
		return false;
	}

	if (mb_caption1 == "")
	{
		if (up_images1 != "")
		{
			alert('1번 사진의 자막을 입력해 주세요.');
			//chk_ins = 0;
			$("#loading_div").hide();
			$("#input_baby_div").show();
			$("#mb_caption1").focus();
			return false;
		}
	}

	if (mb_caption2 == "")
	{
		if (up_images2 != "")
		{
			alert('2번 사진의 자막을 입력해 주세요.');
			//chk_ins = 0;
			$("#loading_div").hide();
			$("#input_baby_div").show();
			$("#mb_caption2").focus();
			return false;
		}
	}

	if (mb_caption3 == "")
	{
		if (up_images3 != "")
		{
			alert('3번 사진의 자막을 입력해 주세요.');
			//chk_ins = 0;
			$("#loading_div").hide();
			$("#input_baby_div").show();
			$("#mb_caption3").focus();
			return false;
		}
	}

	if (mb_caption4 == "")
	{
		if (up_images4 != "")
		{
			alert('4번 사진의 자막을 입력해 주세요.');
			//chk_ins = 0;
			$("#loading_div").hide();
			$("#input_baby_div").show();
			$("#mb_caption4").focus();
			return false;
		}
	}
/*
	if (mb_caption5 == "")
	{
		if (up_images5 != "")
		{
			alert('5번 사진의 자막을 입력해 주세요.');
			//chk_ins = 0;
			return false;
		}
	}
*/


setTimeout(function() {
	$.ajax({
		type:"POST",
		data:{
			"exec"					: "create_movie",
			"mb_baby_name"		: mb_baby_name,
			"mb_baby_age"			: mb_baby_age,
			"up_image1"			: up_images1,
			"up_image2"			: up_images2,
			"up_image3"			: up_images3,
			"up_image4"			: up_images4,
			"up_image5"			: up_images5,
			"mb_caption1"			: mb_caption1,
			"mb_caption2"			: mb_caption2,
			"mb_caption3"			: mb_caption3,
			"mb_caption4"			: mb_caption4,
			//"mb_caption5"			: mb_caption5,
			"mb_phone"				: "<?=$mb_phone?>",
			"mb_serial"				: "<?=$serial?>",
			"mb_concept"			: "4"
		},
		url: "../main_exec.php",
		beforeSend: function(response){
			$("#loading_div").show();
			$("#input_baby_div").hide();
		},
		success: function(response){
			var flag_res	= response.split("||");
			console.log(response);
			if (flag_res[0] == "Y")
			{
				//$(".serial").html("<?=$serial?>");
				$("#video_b_name").html(mb_baby_name+'<span><img src="images/popup/label_baby.png" width="35" /></span>');
				$(".cap1_txt").html(mb_caption1);
				$("#next_image").attr("src","images/popup/btn_m_next_coupon.png");
				$("#video_player").width("100%");
				$("#video_player").attr("src","../files/<?=$serial?>/growmovie.mp4");
				$("#download_src").attr("href","../files/<?=$serial?>/growmovie.mp4");
				$("#movie_div").show();
				$("#loading_div").hide();
				user_gubun	= 1;
			}else if (flag_res[0] == "D"){
				//$(".c_babyname").html(mb_baby_name);
				$(".cap1_txt").html(mb_caption1);
				$("#video_b_name").html(mb_baby_name+'<span><img src="images/popup/label_baby.png" width="35" /></span>');
				$("#next_image").attr("src","images/popup/btn_m_next.png");
				$("#video_player").width("100%");
				$("#video_player").attr("src","../files/<?=$serial?>/growmovie.mp4");
				$("#download_src").attr("href","../files/<?=$serial?>/growmovie.mp4");
				$("#movie_div").show();
				$("#loading_div").hide();
				user_gubun	= 0;
			}else{
				alert('접속자가 많아 참여가 지연되고 있습니다. 다시 시도해 주세요.');
				location.href="index.php";
			}
			//console.log(response);
		}
	});
	}, 5000); // 3000ms(3초)가 경과하면 이 함수가 실행됩니다.
}

function prev_page()
{
	$("#input_baby_div").show();
	$("#movie_div").hide();
}

function next_page()
{
	$("#movie_div").hide();
	if ( user_gubun == 1 )
	{
		$(".serial").html("<?=$serial?>");
		$("#end_coupon_div").show();
	}else{
		$("#sns_b_name").html($("#mb_baby_name").val());
		$("#end_sns_div").show();
	}
}

$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'file_upload1_4.php?s_id=<?=$serial?>';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 99900000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 800,
        previewMaxHeight: 800,
        previewCrop: false
    }).on('fileuploadadd', function (e, data) {
		// 파일 삭제
		//del_fileview();
		user_ex_img1	= $("#user_ex_img1").height();
		$("#user_img1").html("");
        data.context = $('<div/>').appendTo('#user_img1');
		$("#up_img_div1").attr("class","re_upload");
		$("#up_img1").attr("src","images/popup/btn_reup.png");
        $.each(data.files, function (index, file) {
			console.log(file);
			//img_name1 = file.name;
            var node = $('<p/>');
                   // .append($('<span/>').text(file.name));
			  //$("#image_up_name1").val(file.name);
			  $("#up_images1").val(file.name);
            if (!index) {
                //node
                  //  .append('<br>')
                    //.append(uploadButton.clone(true).data(data));
				//uploadButton.clone(true).data(data);
				data.submit();
            }
            node.appendTo(data.context);
			//$("div#user_img1 > div > p > canvas").attr("style","width:40%;padding-top:20%;padding-left:29%");
			//$('#files').append(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
				//$("div#user_img1 > div > p > canvas").css("width","100%");
				//$("div#user_img1 > div > p > canvas").css("height",$("#preview_img_1").height());
				//$("div#user_img1 > div > p > canvas").css("padding-top","20%");
				//$("div#user_img1 > div > p > canvas").css("padding-left","29%");
				$("div#user_img1 > div > p > canvas").css("width","100%");
				var uimg1_w	= $("div#user_img1 > div > p > canvas").width();
				var uimg1_h	= $("div#user_img1 > div > p > canvas").height();
				if (uimg1_w > uimg1_h)
				{
					if (uimg1_h > user_ex_img1_h)
					{
						$("div#user_img1 > div > p > canvas").css("height",user_ex_img1+"px");
						$("div#user_img1 > div > p > canvas").css("width","80%");
						$("div#user_img1 > div > p > canvas").css("padding-left","10%");
					}else{
						$("div#user_img1 > div > p > canvas").css("width","100%");
					}
					var re_userimg1_h	= (user_ex_img1_w/ uimg1_w)*uimg1_h;
					var re_final1_h		= (user_ex_img1_h - re_userimg1_h) /2;
					$("div#user_img1 > div > p > canvas").css("padding-top",re_final1_h+"px");
				}else{
					$("div#user_img1 > div > p > canvas").css("height",user_ex_img1+"px");
					var re_userimg1_w	= (user_ex_img1_h / uimg1_h)*uimg1_w;
					//alert(re_userimg1_w);
					//var re_final1_w		= (user_ex_img1_w - re_userimg1_w) /2;
					//$("td#user_img1 > div > p > canvas").css("padding-left",re_final1_w+"px");
				}
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
		//$(".loading").show();
		//$("html body").css("overflow","hidden");
		//Timer();
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'file_upload2_4.php?s_id=<?=$serial?>';
    $('#fileupload2').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 99900000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 800,
        previewMaxHeight: 800,
        previewCrop: false
    }).on('fileuploadadd', function (e, data) {
		// 파일 삭제
		//del_fileview();
		user_ex_img2	= $("#user_ex_img2").height();
		$("#user_img2").html("");
        data.context = $('<div/>').appendTo('#user_img2');
		$("#up_img_div2").attr("class","re_upload");
		$("#up_img2").attr("src","images/popup/btn_reup.png");
        $.each(data.files, function (index, file) {
			//img_name2 = file.name;
            var node = $('<p/>');
                   // .append($('<span/>').text(file.name));
			 // $("#image_up_name2").val(file.name);
			  $("#up_images2").val(file.name);
            if (!index) {
                //node
                  //  .append('<br>')
                    //.append(uploadButton.clone(true).data(data));
				//uploadButton.clone(true).data(data);
				data.submit();
            }

            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
				//$("div#user_img2 > div > p > canvas").css("width","100%");
				//$("div#user_img2 > div > p > canvas").css("height",$("#preview_img_1").height());
				$("div#user_img2 > div > p > canvas").css("width","100%");
				var uimg2_w	= $("div#user_img2 > div > p > canvas").width();
				var uimg2_h	= $("div#user_img2 > div > p > canvas").height();
				if (uimg2_w > uimg2_h)
				{
					if (uimg2_h > user_ex_img2_h)
					{
						$("div#user_img2 > div > p > canvas").css("height",user_ex_img2+"px");
						$("div#user_img2 > div > p > canvas").css("width","80%");
						$("div#user_img2 > div > p > canvas").css("padding-left","10%");
					}else{
						$("div#user_img2 > div > p > canvas").css("width","100%");
					}
					var re_userimg2_h	= (user_ex_img2_w/ uimg2_w)*uimg2_h;
					var re_final2_h		= (user_ex_img2_h - re_userimg2_h) /2;
					$("div#user_img2 > div > p > canvas").css("padding-top",re_final2_h+"px");
				}else{
					$("div#user_img2 > div > p > canvas").css("height",user_ex_img2+"px");
					var re_userimg2_w	= (user_ex_img2_h / uimg2_h)*uimg2_w;
					//alert(re_userimg1_w);
					//var re_final1_w		= (user_ex_img1_w - re_userimg1_w) /2;
					//$("td#user_img1 > div > p > canvas").css("padding-left",re_final1_w+"px");
				}
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
		//$(".loading").show();
		//$("html body").css("overflow","hidden");
		//Timer();
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'file_upload3_4.php?s_id=<?=$serial?>';
    $('#fileupload3').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 99900000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 500,
        previewMaxHeight: 500,
        previewCrop: false
    }).on('fileuploadadd', function (e, data) {
		// 파일 삭제
		//del_fileview();
		user_ex_img3	= $("#user_ex_img3").height();
		$("#user_img3").html("");
        data.context = $('<div/>').appendTo('#user_img3');
		$("#up_img_div3").attr("class","re_upload");
		$("#up_img3").attr("src","images/popup/btn_reup.png");
        $.each(data.files, function (index, file) {
			//img_name3 = file.name;
            var node = $('<p/>');
                   // .append($('<span/>').text(file.name));
			  //$("#image_up_name3").val(file.name);
			  $("#up_images3").val(file.name);
            if (!index) {
                //node
                  //  .append('<br>')
                    //.append(uploadButton.clone(true).data(data));
				//uploadButton.clone(true).data(data);
				data.submit();
            }

            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
				$("div#user_img3 > div > p > canvas").css("width","100%");
				var uimg3_w	= $("div#user_img3 > div > p > canvas").width();
				var uimg3_h	= $("div#user_img3 > div > p > canvas").height();
				if (uimg3_w > uimg3_h)
				{
					if (uimg3_h > user_ex_img3_h)
					{
						$("div#user_img3 > div > p > canvas").css("height",user_ex_img3+"px");
						$("div#user_img3 > div > p > canvas").css("width","80%");
						$("div#user_img3 > div > p > canvas").css("padding-left","10%");
					}else{
						$("div#user_img3 > div > p > canvas").css("width","100%");
					}
					var re_userimg3_h	= (user_ex_img3_w/ uimg3_w)*uimg3_h;
					var re_final3_h		= (user_ex_img3_h - re_userimg3_h) /2;
					$("div#user_img3 > div > p > canvas").css("padding-top",re_final3_h+"px");
				}else{
					$("div#user_img3 > div > p > canvas").css("height",user_ex_img3+"px");
					var re_userimg3_w	= (user_ex_img3_h / uimg3_h)*uimg3_w;
					//alert(re_userimg1_w);
					//var re_final1_w		= (user_ex_img1_w - re_userimg1_w) /2;
					//$("td#user_img1 > div > p > canvas").css("padding-left",re_final1_w+"px");
				}
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
		//$(".loading").show();
		//$("html body").css("overflow","hidden");
		//Timer();
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'file_upload4_4.php?s_id=<?=$serial?>';
    $('#fileupload4').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 99900000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 500,
        previewMaxHeight: 500,
        previewCrop: false
    }).on('fileuploadadd', function (e, data) {
		// 파일 삭제
		//del_fileview();
		user_ex_img4	= $("#user_ex_img4").height();
		$("#user_img4").html("");
        data.context = $('<div/>').appendTo('#user_img4');
		$("#up_img_div4").attr("class","re_upload");
		$("#up_img4").attr("src","images/popup/btn_reup.png");
        $.each(data.files, function (index, file) {
			//img_name4 = file.name;
            var node = $('<p/>');
                   // .append($('<span/>').text(file.name));
			  //$("#image_up_name4").val(file.name);
			  $("#up_images4").val(file.name);
            if (!index) {
                //node
                  //  .append('<br>')
                    //.append(uploadButton.clone(true).data(data));
				//uploadButton.clone(true).data(data);
				data.submit();
            }

            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
				//$("div#user_img4 > div > p > canvas").css("width","100%");
				//$("div#user_img4 > div > p > canvas").css("height",$("#preview_img_1").height());
				$("div#user_img4 > div > p > canvas").css("width","100%");
				var uimg4_w	= $("div#user_img4 > div > p > canvas").width();
				var uimg4_h	= $("div#user_img4 > div > p > canvas").height();
				if (uimg4_w > uimg4_h)
				{
					if (uimg4_h > user_ex_img4_h)
					{
						$("div#user_img4 > div > p > canvas").css("height",user_ex_img4+"px");
						$("div#user_img4 > div > p > canvas").css("width","80%");
						$("div#user_img4 > div > p > canvas").css("padding-left","10%");
					}else{
						$("div#user_img4 > div > p > canvas").css("width","100%");
					}
					var re_userimg4_h	= (user_ex_img4_w/ uimg4_w)*uimg4_h;
					var re_final4_h		= (user_ex_img4_h - re_userimg4_h) /2;
					$("div#user_img4 > div > p > canvas").css("padding-top",re_final4_h+"px");
				}else{
					$("div#user_img4 > div > p > canvas").css("height",user_ex_img4+"px");
					var re_userimg4_w	= (user_ex_img4_h / uimg4_h)*uimg4_w;
					//alert(re_userimg1_w);
					//var re_final1_w		= (user_ex_img1_w - re_userimg1_w) /2;
					//$("td#user_img1 > div > p > canvas").css("padding-left",re_final1_w+"px");
				}
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
		//$(".loading").show();
		//$("html body").css("overflow","hidden");
		//Timer();
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'file_upload5_4.php?s_id=<?=$serial?>';
    $('#fileupload5').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 99900000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 500,
        previewMaxHeight: 500,
        previewCrop: false
    }).on('fileuploadadd', function (e, data) {
		// 파일 삭제
		//del_fileview();
		user_ex_img5	= $("#user_ex_img5").height();
		$("#user_img5").html("");
        data.context = $('<div/>').appendTo('#user_img5');
		$("#up_img_div5").attr("class","re_upload");
		$("#up_img5").attr("src","images/popup/btn_reup.png");
        $.each(data.files, function (index, file) {
			//img_name5 = file.name;
            var node = $('<p/>');
                   // .append($('<span/>').text(file.name));
			  //$("#image_up_name5").val(file.name);
			  $("#up_images5").val(file.name);
            if (!index) {
                //node
                  //  .append('<br>')
                    //.append(uploadButton.clone(true).data(data));
				//uploadButton.clone(true).data(data);
				data.submit();
            }

            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
				//$("div#user_img5 > div > p > canvas").css("width","100%");
				//$("div#user_img5 > div > p > canvas").css("height",$("#preview_img_1").height());
				$("div#user_img5 > div > p > canvas").css("width","100%");
				var uimg5_w	= $("div#user_img5 > div > p > canvas").width();
				var uimg5_h	= $("div#user_img5 > div > p > canvas").height();
				if (uimg5_w > uimg5_h)
				{
					if (uimg5_h > user_ex_img5_h)
					{
						$("div#user_img5 > div > p > canvas").css("height",user_ex_img5+"px");
						$("div#user_img5 > div > p > canvas").css("width","80%");
						$("div#user_img5 > div > p > canvas").css("padding-left","10%");
					}else{
						$("div#user_img5 > div > p > canvas").css("width","100%");
					}
					var re_userimg5_h	= (user_ex_img5_w/ uimg5_w)*uimg5_h;
					var re_final5_h		= (user_ex_img5_h - re_userimg5_h) /2;
					$("div#user_img5 > div > p > canvas").css("padding-top",re_final5_h+"px");
				}else{
					$("div#user_img5 > div > p > canvas").css("height",user_ex_img5+"px");
					var re_userimg5_w	= (user_ex_img5_h / uimg5_h)*uimg5_w;
					//alert(re_userimg1_w);
					//var re_final1_w		= (user_ex_img1_w - re_userimg1_w) /2;
					//$("td#user_img1 > div > p > canvas").css("padding-left",re_final1_w+"px");
				}
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
		//$(".loading").show();
		//$("html body").css("overflow","hidden");
		//Timer();
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

function sns_share(media, flag)
{
	if (media == "fb")
	{

		var newWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('http://grow.babience-event.com/MOBILE/coupon_page.php?serial=<?=$serial?>'),'sharer','toolbar=0,status=0,width=600,height=325');
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "../main_exec.belif",
			data:{
				"exec" : "insert_share_info",
				"sns_media" : media,
				"sns_flag"		: flag
			}
		});
		//var newWindow = window.open('https://www.facebook.com/dialog/feed?app_id=1604312303162602&display=popup&caption=testurl&link=http://vacance.babience-event.com&redirect_uri=http://www.hanatour.com','sharer','toolbar=0,status=0,width=600,height=325');
	}else if (media == "tw"){
		var newWindow = window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent("빌리의 수분 폭탄 공장에 숨어 있는 빌리를 찾아주신 분에게는 즉석 당첨을 통해 수분 폭탄 쿠션 체험 키트를 드립니다. ") + '&url='+ encodeURIComponent('http://bit.ly/1QuvGJU'),'sharer','toolbar=0,status=0,width=600,height=325');
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "../main_exec.belif",
			data:{
				"exec" : "insert_share_info",
				"sns_media" : media,
				"sns_flag"		: flag
			}
		});
	}else if (media == "kt"){
		// 카카오톡 링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
		//Kakao.Link.createTalkLinkButton({
		Kakao.Link.sendTalkLink({
		  //container: '#kakao-link-btn',
		  label: "혼자보기 아까운 우리아기 성장 영상 공개!",
		  image: {
			src: 'http://grow.babience-event.com/MOBILE/images/sns.jpg',
			width: '1200',
			height: '630'
		  },
		  webButton: {
			text: '[베비언스] 베비언스 먹고 폭풍 성장!',
			url: 'http://grow.babience-event.com/MOBILE/index.php?serial=<?=$serial?>' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
		  }
		});
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "../main_exec.belif",
			data:{
				"exec" : "insert_share_info",
				"sns_media" : media,
				"sns_flag"		: flag
			}
		});
	}else{
		Kakao.Story.share({
			url: 'http://grow.babience-event.com/MOBILE/coupon_page.php?serial=<?=$serial?>',
			text: '혼자보기 아까운 우리아기 성장 영상 공개!\r\nhttp://grow.babience-event.com/MOBILE/coupon_page.php?serial=<?=$serial?>'
		});
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "../main_exec.belif",
			data:{
				"exec" : "insert_share_info",
				"sns_media" : media,
				"sns_flag"		: flag
			}
		});
	}
}

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74531465-1', 'auto');
  ga('send', 'pageview');

</script>