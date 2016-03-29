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
                	<img src="images/popup/title_make_sub_2.png" />
                </div>
                <div class="btn_sample">
                	<a href="popup_gate.php"><img src="images/popup/btn_reselect.png" /></a>
                    <a href="#" onclick="open_pop('exam1_popup');return false;"><img src="images/popup/btn_sample2.png" /></a>
                </div>
                <div class="img_process img">
                	<a href="#"><img src="images/popup/img_process.png" /></a>
                </div>
                

                <div class="input_block news">
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
                                <div class="input">
                                	<select name="mb_baby_age" id="mb_baby_age" onchange="ins_caption('b_age');return false;">
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
                
               
                <!--프레임2-->
                <div class="pics frame_1">
        <input type="hidden" id="up_images1" value="">
                	<div class="inner_pics">
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

                        	<div class="name f_2_3 imsi_caption_baby">이서준(2)</div>
                            <div class="text f_2_2" id="imsi_caption1">자막</div>
                        	<div class="p_img f_2_2" id="user_img1">이미지</div><!--소비자 합성 이미지-->
                            <div class="front_img img"><img src="images/popup/img_frm_2_2.png" id="user_ex_img1" /></div>
                        	
                        	<div class="bg img"><img src="images/popup/frm_b_bg.jpg" /></div>
                        </div>
                        <div class="pic_input">
                        	<div class="input"><input type="text" name="mb_caption1" id="mb_caption1" placeholder="자막을 넣어주세요(20자 이내)" onkeyup="ins_caption('1');return false;"></div>
                        </div>
                    </div>
                </div>
                <!--END:프레임2-->
                
                
                
                <div class="btn_make img">
                	<a href="#" onclick="create_movie();return false;"><img src="images/popup/btn_make.png" /></a>
                </div>
                
            </div>
        </div>
	</div>
<!------------------ 아기 정보 (이름, 나이, 사진) 입력 페이지 ------------------>

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

	var yt_width = $(window).width()*0.95;
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
			"mb_concept"		: "2"
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
    var url = 'file_upload2_2.php?s_id=<?=$serial?>';
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
			//img_name2 = file.name;
            var node = $('<p/>');
                   // .append($('<span/>').text(file.name));
			 // $("#image_up_name2").val(file.name);
			  $("#up_images1").val(file.name);
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
				//$("div#user_img2 > div > p > canvas").css("width","100%");
				//$("div#user_img2 > div > p > canvas").css("height",$("#preview_img_2").height());
				//$("div#user_img2 > div > p > canvas").css("padding-top","12%");
				//$("div#user_img2 > div > p > canvas").css("padding-left","20%");
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

		var newWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('http://grow.babience-event.com/MOBILE2/coupon_page.php?serial=<?=$serialnumber?>'),'sharer','toolbar=0,status=0,width=600,height=325');
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
		  label: "우리아기 특별한 패러디 컷 공개!",
		  //image: {
			//src: 'http://grow.babience-event.com/MOBILE/images/sns.jpg',
			//width: '1200',
			//height: '630'
		  //},
		  webButton: {
			text: '[베비언스] 베비언스 먹고 폭풍 성장 2탄!',
			url: 'http://grow.babience-event.com/MOBILE2/index.php?serial=<?=$serialnumber?>' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
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
			url: 'http://grow.babience-event.com/MOBILE2/coupon_page.php?serial=<?=$serialnumber?>',
			text: '우리아기 특별한 패러디 컷 공개!\r\nhttp://grow.babience-event.com/MOBILE2/coupon_page.php?serial=<?=$serialnumber?>'
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