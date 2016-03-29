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
        <img src="images/popup/title_make_sub_1.png" />
      </div>
      <!-- <div class="btn_sample img">
        <a href="#" onclick="open_pop('exam1_popup');return false;"><img src="images/popup/btn_sample.png" /></a>
      </div> -->
      <div class="btn_sample">
        <a href="popup_gate.php?mb_phone=<?=$mb_phone?>&serial=<?=$serial?>"><img src="images/popup/btn_reselect.png" /></a>
        <a href="#" onclick="open_pop('exam1_popup');return false;"><img src="images/popup/btn_sample2.png" /></a>
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
              <div class="input"><input type="text" name="mb_baby_name" id="mb_baby_name" placeholder="아기 이름"></div>
            </div>
          </div>
          <div class="input_one">
            <div class="inner_input_one clearfix">
              <!-- <div class="input"><input type="tel" name="mb_baby_age" id="mb_baby_age" placeholder="아기 나이 (숫자만 넣어주세요)"></div> -->
              <div class="input">
                <select name="mb_baby_age" id="mb_baby_age">
                  <option value="">나이를 선택해주세요.</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>
              </div>
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
              <!-- <a href="#"><img src="images/popup/btn_up.png" /></a> -->
              <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>
                  <div id="files">
                    <a href="#"><img src="images/popup/btn_up.png" id="up_img1" /></a>
                  </div>
                </span>
                <input id="fileupload" type="file" name="files[]" accept="image/*" >
              </span>
            </div>
            <!--<div class="re_upload"><a href="#"><img src="images/popup/btn_reup.png" /></a></div>-->
            <div class="text f_1_2" id="imsi_caption1">어느덧 쑥쑥 자라서 너무 고마워</div>
            <div class="p_img f_1_2">
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                  <tr>
                    <td align="center" valign="middle" id="user_img1"><img src="images/popup/ex2.jpg" id="user_ex_img1" /></td>
                  </tr>
                </tbody>
              </table>
			</div><!--소비자 합성 이미지-->
            <div class="front_img img"><img src="images/popup/img_frm_1_2.png" /></div>
            <div class="bg img"><img src="images/popup/frm_b_bg.jpg" /></div>
          </div>
        </div>
      </div>
      <!--END:프레임1-->


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
						    <div class="bg img"><img src="images/popup/title_movie_c_1.png" /></div>
                        </div>
                        <div class="name" id="video_b_name">
                            	김서우<span><img src="images/popup/label_baby.png" width="35" /></span>
                            </div>
                        <div class="youtube">
                        	<video src="../files/out.mp4" controls preload="auto" id="video_player" poster="scene/concept_1_1.jpg"></video>
                        </div>
                    </div>
<?
	if ($iPhoneYN == "N")
	{
?>
                    <div class="btn_block img">
                    	<a href="../files/out.mp4" download="download_video" id="download_src"><img src="images/popup/btn_down.png" /></a>
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
            <a href="http://www.babience.com/m/bbgrowth_coupon/event.jsp" class="img" target="_blank"><img src="images/popup/btn_home.png" /></a>
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
            <a href="#" onclick="sns_share('kt','share');return false;"><img src="images/popup/btn_kt.png" /></a>
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
var user_ex_img1	= 0;

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

	user_ex_img1_h		= $("#user_ex_img1").height();
	user_ex_img1_w		= $("#user_ex_img1").width();

});

function create_movie()
{
	$("#loading_div").show();
	$("#input_baby_div").hide();

	var mb_baby_name		= $("#mb_baby_name").val();
	var mb_baby_age			= $("#mb_baby_age").val();
	var up_images1				= $("#up_images1").val();
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

	if (up_images1 == "")
	{
		alert('이미지를 업로드해 주세요.');
		//chk_ins = 0;
		$("#loading_div").hide();
		$("#input_baby_div").show();
		return false;
	}

setTimeout(function() {
	$.ajax({
		type:"POST",
		data:{
			"exec"					: "create_movie",
			"mb_baby_name"		: mb_baby_name,
			"mb_baby_age"			: mb_baby_age,
			"up_image1"			: up_images1,
			"mb_phone"				: "<?=$mb_phone?>",
			"mb_serial"				: "<?=$serial?>",
			"mb_concept"			: "1"
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
				$("#next_image").attr("src","images/popup/btn_m_next_coupon.png");
				$("#video_player").width("100%");
				$("#movie_div").show();
				$("#loading_div").hide();
				user_gubun	= 1;
			}else if (flag_res[0] == "D"){
				//$(".c_babyname").html(mb_baby_name);
				$("#video_b_name").html(mb_baby_name+'<span><img src="images/popup/label_baby.png" width="35" /></span>');
				$("#next_image").attr("src","images/popup/btn_m_next.png");
				$("#video_player").width("100%");
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
	}, 8000); // 3000ms(3초)가 경과하면 이 함수가 실행됩니다.
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
    var url = 'file_upload.php?s_id=<?=$serial?>';
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
        previewMaxWidth: 500,
        previewMaxHeight: 500,
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
			console.log(index);
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
				//$("div#user_img1 > div > p > canvas").css("width","40%");
				//$("div#user_img1 > div > p > canvas").css("height",user_ex_img1+"px");
				//$("div#user_img1 > div > p > canvas").css("padding-top","20%");
				//$("div#user_img1 > div > p > canvas").css("padding-left","29.1%");
				var uimg1_w	= $("td#user_img1 > div > p > canvas").width();
				var uimg1_h	= $("td#user_img1 > div > p > canvas").height();
				if (uimg1_w > uimg1_h)
				{
					if (uimg1_h > re_userimg1_h)
					{
						$("td#user_img1 > div > p > canvas").css("width","70%");
					}else{
						$("td#user_img1 > div > p > canvas").css("width","100%");
					}

					var re_userimg1_h	= (user_ex_img1_w/ uimg1_w)*uimg1_h;
					var re_final1_h		= (user_ex_img1_h - re_userimg1_h) /2;
					$("td#user_img1 > div > p > canvas").css("padding-top",re_final1_h+"px");
				}else{
					
					$("td#user_img1 > div > p > canvas").css("height",user_ex_img1+"px");
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


function sns_share(media, flag)
{
	if (media == "fb")
	{

		var newWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('http://grow.babience-event.com/MOBILE/coupon_page.php?serial=<?=$serial?>'),'sharer','toolbar=0,status=0,width=600,height=325');
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "../main_exec.php",
			data:{
				"exec" : "insert_share_info",
				"sns_media" : media,
				"sns_flag"		: flag
			}
		});
		//var newWindow = window.open('https://www.facebook.com/dialog/feed?app_id=1604312303162602&display=popup&caption=testurl&link=http://vacance.babience-event.com&redirect_uri=http://www.hanatour.com','sharer','toolbar=0,status=0,width=600,height=325');
	}else if (media == "kt"){
		// 카카오톡 링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
		//Kakao.Link.createTalkLinkButton({
		Kakao.Link.sendTalkLink({
		  //container: '#kakao-link-btn',
		  label: "혼자보기 아까운 우리아기 성장 영상 공개!\r\nhttp://grow.babience-event.com/MOBILE/coupon_page.php?serial=<?=$serial?>",
		  //image: {
			//src: 'http://grow.babience-event.com/MOBILE/images/sns.jpg',
			//width: '1200',
			//height: '630'
		  //},
		  webButton: {
			text: '[베비언스] 베비언스 먹고 폭풍 성장!',
			url: 'http://grow.babience-event.com/MOBILE/coupon_page.php?serial=<?=$serial?>' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
		  }
		});
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "../main_exec.php",
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
			url    : "../main_exec.php",
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