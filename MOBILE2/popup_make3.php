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
        <img src="images/popup/title_make_sub_3.png" />
      </div>
      <div class="btn_sample">
        <a href="popup_gate.php"><img src="images/popup/btn_reselect.png" /></a>
        <a href="#" onclick="open_pop('exam1_popup');return false;"><img src="images/popup/btn_sample2.png" /></a>
      </div>
      <div class="img_process img">
        <a href="#"><img src="images/popup/img_process.png" /></a>
      </div>
      <!--프레임1-->
      <div class="pics frame_1">
        <input type="hidden" id="up_images1" value="">
        <div class="inner_pics">
          <div class="pc_frame">
            <div class="upload" id="up_img_div1">
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
            <div class="text f_3_1" id="imsi_caption1">자막</div>
            <div class="p_img f_3_1" id="user_img1">소비자 합성 이미지</div><!--소비자 합성 이미지-->
            <div class="front_img img"><img src="images/popup/img_frm_3_1.png" id="user_ex_img1" /></div>
            <div class="bg img"><img src="images/popup/frm_b_bg.jpg" /></div>
          </div>
          <div class="pic_input">
            <div class="input"><input type="text" name="mb_caption1" id="mb_caption1" placeholder="타이틀을 넣어주세요(20자 이내)" onkeyup="ins_caption('1');return false;"></div>
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

<!------------------ 개인정보 입력 페이지 ------------------>
<div id="input_div" class="popup_wrap" style="display:none">
  <div class="p_mid p_position">
    <div class="block_close clearfix">
      <a href="index.php" class="btn_close"><img src="images/popup/btn_close.png" /></a>
    </div>
    <div class="block_content input">
      <div class="title_pop_main">
        <img src="images/popup/title_pop_main.png" />
      </div>
      <div class="inner">
        <div class="input_block">
          <div class="title img">
            <img src="images/popup/title_input_1.png" />
          </div>
          <div class="inner_input_block">
            <div class="input_one">
              <div class="inner_input_one clearfix">
                <div class="input"><input type="text" name="mb_name" id="mb_name" placeholder="이름"></div>
              </div>
            </div>
            <div class="input_one">
              <div class="inner_input_one clearfix">
                <div class="input"><input type="tel" name="mb_phone" id="mb_phone" placeholder="휴대폰번호 ('-' 없이 입력해주세요)" onkeyup="only_num(this);chk_len(this.value);"></div>
              </div>
            </div>
          </div>
          <div class="check_block">
            <div class="inner_check_block clearfix">
              <div class="check"><a href="#" onclick="privacy_check();return false;"><img src="images/popup/check_off.jpg" width="20" name="privacy_agree" id="privacy_agree" /></a></div>
              <div class="txt">개인정보 수집 및 위탁에 관한 동의</div>
              <div class="btn_detail"><a href="#" onclick="open_pop('privacy_agree_popup');return false;"><img src="images/popup/btn_detail.jpg" width="55" /></a></div>
            </div>
            <div class="inner_check_block clearfix">
              <div class="check"><a href="#" onclick="adver_check();return false;"><img src="images/popup/check_off.jpg" width="20" name="adver_agree" id="adver_agree" /></a></div>
              <div class="txt">광고성 정보 전송 동의 약관 동의</div>
              <div class="btn_detail"><a href="#" onclick="open_pop('adver_agree_popup');return false;"><img src="images/popup/btn_detail.jpg" width="55" /></a></div>
            </div>
          </div>
        </div>
        <div class="btn_block input">
          <div class="img"><a href="#" onclick="insert_input();return false;"><img src="images/popup/btn_input_1.png" /></a></div>
        </div>
      </div><!--inner-->
    </div>
  </div>
</div>
<!------------------ 개인정보 입력 페이지 ------------------>

<?
	include_once   "./page_div.php";
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
var chk_privacy_flag	= 0;
var chk_adver_flag		= 0;

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

	var yt_width = $(document).width()*0.95;
	var youtube_height = ((yt_width / 16) * 9)*1.15;
	$("#gate_exam1").width(yt_width);
	$("#gate_exam2").width(yt_width);
	$("#gate_exam3").width(yt_width);
	$("#gate_exam4").width(yt_width);
	$(".youtube").height(youtube_height);
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
	var mb_caption1			= $("#mb_caption1").val();
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

setTimeout(function() {
	$.ajax({
		type:"POST",
		data:{
			"exec"					: "create_movie",
			"mb_baby_name"	: mb_baby_name,
			"mb_baby_age"		: mb_baby_age,
			"up_image1"			: up_images1,
			"mb_caption1"		: mb_caption1,
			"mb_serial"			: "<?=$serial?>",
			"mb_concept"		: "3"
		},
		url: "../main_exec2.php",
		beforeSend: function(response){
			$("#loading_div").show();
			$("#input_baby_div").hide();
		},
		success: function(response){
			alert(response);
			if (response == "Y")
			{
				$("#input_div").show();
				$("#loading_div").hide();
			}else{
				alert('접속자가 많아 참여가 지연되고 있습니다. 다시 시도해 주세요.');
				location.href="index.php";
			}
		}
	});
	}, 5000); // 5000ms(5초)가 경과하면 이 함수가 실행됩니다.
}

function insert_input()
{
	var mb_name				= $("#mb_name").val();
	mb_phone				= $("#mb_phone").val();

	if (mb_name == "")
	{
		alert('이름을 입력해 주세요.');
		$("#mb_name").focus();
		//chk_ins = 0;
		return false;
	}

	if (mb_phone == "")
	{
		alert('휴대폰 번호를 입력해주세요.');
		$("#mb_phone").focus();
		//chk_ins = 0;
		return false;
	}

	if (chk_privacy_flag == 0)
	{
		alert("개인정보 수집 및 위탁에 관한 동의를 안 하셨습니다");
		//chk_ins = 0;
		return false;
	}

	$.ajax({
		type:"POST",
		data:{
			"exec"					: "update_info",
			"mb_name"				: mb_name,
			"mb_phone"				: mb_phone,
			"chk_adver"				: chk_adver_flag,
			"mb_serial"				: "<?=$serial?>"
		},
		url: "../main_exec2.php",
		success: function(response){
			alert(response);
			if (response == "Y")
			{
				$(".image_view").width("100%");
				$(".image_view").attr("src","../files2/<?=$serial?>/medium/final_<?=$serial?>_1.jpg");
				$("#use_serial").html("<?=$serial?>");
				$("#input_div").hide();
				$("#end_coupon_div").show();
			}else if (response == "D"){
				$(".image_view").width("100%");
				$(".image_view").attr("src","../files2/<?=$serial?>/medium/final_<?=$serial?>_1.jpg");
				$("#input_div").hide();
				$("#end_sns_div").show();
			}else{
				alert("참여자가 많아 지연되고 있습니다. 다시 응모해 주세요.");
				location.href="index.php";
			}
		}
	});
}

$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'file_upload1_3.php?s_id=<?=$serial?>';
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


function sns_share(media, flag)
{
	if (media == "fb")
	{

		var newWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('http://grow.babience-event.com/MOBILE2/coupon_page.php?serial=<?=$serial?>'),'sharer','toolbar=0,status=0,width=600,height=325');
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
		  label: "혼자보기 아까운 우리아기 성장 영상 공개!\r\nhttp://grow.babience-event.com/MOBILE2/coupon_page.php?serial=<?=$serial?>",
		  //image: {
			//src: 'http://grow.babience-event.com/MOBILE/images/sns.jpg',
			//width: '1200',
			//height: '630'
		  //},
		  webButton: {
			text: '[베비언스] 베비언스 먹고 폭풍 성장!',
			url: 'http://grow.babience-event.com/MOBILE2/coupon_page.php?serial=<?=$serial?>' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
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
			url: 'http://grow.babience-event.com/MOBILE2/coupon_page.php?serial=<?=$serial?>',
			text: '혼자보기 아까운 우리아기 성장 영상 공개!\r\nhttp://grow.babience-event.com/MOBILE2/coupon_page.php?serial=<?=$serial?>'
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