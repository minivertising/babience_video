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
  <div class="inner_sec_movie">
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
    <div class="img"><a href="#"><img src="images/footer.jpg" /></a></div>
    <div class="img txt" style="display:none;"><img src="images/footer_txt.jpg" /></div>
  </div>
</div>
<?
	include_once   "./popup_div.php";
?>
 </body>
</html>
<script type="text/javascript">
var video_concept	= null;
var mb_phone		= null;
var serial_num		= null;
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

function show_input_div()
{
	$("#main_div").hide();
	$("#input_div").show();
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
		$("#mb_phone1").focus();
		//chk_ins = 0;
		return false;
	}

/*
	if (chk_privacy_flag == 0)
	{
		alert("개인정보 수집 및 위탁에 관한 동의를 안 하셨습니다");
		//chk_ins = 0;
		return false;
	}

	if (chk_adver_flag == 0)
	{
		alert("광고성 정보전송 동의를 안 하셨습니다");
		//chk_ins = 0;
		return false;
	}
*/

	$.ajax({
		type:"POST",
		data:{
			"exec"					: "insert_info",
			"mb_name"				: mb_name,
			"mb_phone"				: mb_phone,
			"mb_serial"				: "<?=$serial?>"
		},
		url: "../main_exec.php",
		success: function(response){
			var flag_res	= response.split("||");
			flag_res[1]	= serial_num;
			alert(response);
			if (flag_res[0] == "Y")
			{
				$("#input_div").hide();
				$("#concept_div").show();
			}else{
				alert("참여자가 많아 지연되고 있습니다. 다시 응모해 주세요.");
				location.href="index.php";
			}
		}
	});
}

function insert_baby_input()
{
	var mb_baby_name		= $("#mb_baby_name").val();
	var mb_baby_age			= $("#mb_baby_age").val();

	if (mb_baby_name == "")
	{
		alert('아기 이름을 입력해 주세요.');
		$("#mb_baby_name").focus();
		//chk_ins = 0;
		return false;
	}

	if (mb_baby_age == "")
	{
		alert('아기 나이를 입력해주세요.');
		$("#mb_baby_age").focus();
		//chk_ins = 0;
		return false;
	}

	$.ajax({
		type:"POST",
		data:{
			"exec"					: "update_baby_info",
			"mb_baby_name"		: mb_baby_name,
			"mb_baby_age"			: mb_baby_age,
			"mb_phone"				: mb_phone,
			"mb_serial"				: "<?=$serial?>"
		},
		url: "../main_exec.php",
		success: function(response){
			alert(response);
			if (response == "Y")
			{
				$("#input_baby_div").hide();
				$("#input_picture1_div").show();
			}else{
				alert("참여자가 많아 지연되고 있습니다. 다시 응모해 주세요.");
				location.href="index.php";
			}
		}
	});
}

function create_movie()
{
	var mb_baby_name		= $("#mb_baby_name").val();
	var mb_baby_age			= $("#mb_baby_age").val();
	var up_images1		= $("#up_images1").val();
	var up_images2		= $("#up_images2").val();
	var up_images3		= $("#up_images3").val();
	var up_images4		= $("#up_images4").val();
	var up_images5		= $("#up_images5").val();
	var mb_caption1	= $("#mb_caption1").val();
	var mb_caption2	= $("#mb_caption2").val();
	var mb_caption3	= $("#mb_caption3").val();
	var mb_caption4	= $("#mb_caption4").val();
	var mb_caption5	= $("#mb_caption5").val();

	if (up_images1 == "" && up_images2 == "" && up_images3 == "" && up_images4 == "" && up_images5 == "")
	{
		alert('이미지를 1장 이상 업로드해 주세요.');
		//chk_ins = 0;
		return false;
	}

	if (mb_caption1 == "")
	{
		if (up_images1 != "")
		{
			alert('1번 사진의 자막을 입력해 주세요.');
			//chk_ins = 0;
			return false;
		}
	}

	if (mb_caption2 == "")
	{
		if (up_images2 != "")
		{
			alert('2번 사진의 자막을 입력해 주세요.');
			//chk_ins = 0;
			return false;
		}
	}

	if (mb_caption3 == "")
	{
		if (up_images3 != "")
		{
			alert('3번 사진의 자막을 입력해 주세요.');
			//chk_ins = 0;
			return false;
		}
	}

	if (mb_caption4 == "")
	{
		if (up_images4 != "")
		{
			alert('4번 사진의 자막을 입력해 주세요.');
			//chk_ins = 0;
			return false;
		}
	}

	if (mb_caption5 == "")
	{
		if (up_images5 != "")
		{
			alert('5번 사진의 자막을 입력해 주세요.');
			//chk_ins = 0;
			return false;
		}
	}

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
			"mb_caption5"			: mb_caption5,
			"mb_phone"				: mb_phone,
			"mb_serial"				: "<?=$serial?>"
		},
		url: "../main_exec.php",
		success: function(response){
			console.log(response);
		}
	});
}

function open_pop(param)
{
	$.colorbox({innerWidth:"100%", initialWidth:"95%", inline:true, opacity:"0.9", scrolling:false, reposition: false,closeButton:false, overlayClose: true, open:true, speed:0, fadeOut: 300, href:"#"+param, onComplete: function(){
		$("#cboxContent").css("background","none");
		$('#cboxWrapper').css('backgroundColor', "");
		$('#cboxLoadedContent').css('backgroundColor', "");
		$("#colorbox").width($("body").width());
		//$("body").height($("#"+param).height());
		$("#cboxWrapper").width($("body").width());
		//$(".sec_main_img").hide();
	},
	onClosed: function(){
		//del_info();
		$("#cboxContent").css("background","#fff");
		//$(".sec_main_img").show();
	}});
}

function show_notice()
{
	if (notice_flag == 0)
	{
		$("#notice_div").show();
		notice_flag	= 1;
	}else{
		$("#notice_div").hide();
		notice_flag	= 0;
	}
}

function sel_concept(param)
{
	video_concept = param;

	$("#concept_div").hide();
	$("#input_baby_div").show();

}

function sel_image(param)
{
	
}

function change_tab(param)
{
	if (param == "1")
	{
		$("#input_picture1_div").show();
		$("#input_picture2_div").hide();
		$("#input_picture3_div").hide();
		$("#input_picture4_div").hide();
		$("#input_picture5_div").hide();
	}else if (param == "2"){
		$("#input_picture1_div").hide();
		$("#input_picture2_div").show();
		$("#input_picture3_div").hide();
		$("#input_picture4_div").hide();
		$("#input_picture5_div").hide();
	}else if (param == "3"){
		$("#input_picture1_div").hide();
		$("#input_picture2_div").hide();
		$("#input_picture3_div").show();
		$("#input_picture4_div").hide();
		$("#input_picture5_div").hide();
	}else if (param == "4"){
		$("#input_picture1_div").hide();
		$("#input_picture2_div").hide();
		$("#input_picture3_div").hide();
		$("#input_picture4_div").show();
		$("#input_picture5_div").hide();
	}else{
		$("#input_picture1_div").hide();
		$("#input_picture2_div").hide();
		$("#input_picture3_div").hide();
		$("#input_picture4_div").hide();
		$("#input_picture5_div").show();
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
        previewMaxWidth: 50,
        previewMaxHeight: 50,
        previewCrop: false
    }).on('fileuploadadd', function (e, data) {
		// 파일 삭제
		//del_fileview();
		$("#files").html("");
        data.context = $('<div/>').appendTo('#files');
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
    var url = 'file_upload2.php?s_id='+ serial_num;
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
        previewMaxWidth: 50,
        previewMaxHeight: 50,
        previewCrop: false
    }).on('fileuploadadd', function (e, data) {
		// 파일 삭제
		//del_fileview();
		$("#files2").html("");
        data.context = $('<div/>').appendTo('#files2');
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
    var url = 'file_upload3.php?s_id='+ serial_num;
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
        previewMaxWidth: 50,
        previewMaxHeight: 50,
        previewCrop: false
    }).on('fileuploadadd', function (e, data) {
		// 파일 삭제
		//del_fileview();
		$("#files3").html("");
        data.context = $('<div/>').appendTo('#files3');
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
    var url = 'file_upload4.php?s_id='+ serial_num;
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
        previewMaxWidth: 50,
        previewMaxHeight: 50,
        previewCrop: false
    }).on('fileuploadadd', function (e, data) {
		// 파일 삭제
		//del_fileview();
		$("#files4").html("");
        data.context = $('<div/>').appendTo('#files4');
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
    var url = 'file_upload5.php?s_id='+ serial_num;
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
        previewMaxWidth: 50,
        previewMaxHeight: 50,
        previewCrop: false
    }).on('fileuploadadd', function (e, data) {
		// 파일 삭제
		//del_fileview();
		$("#files5").html("");
        data.context = $('<div/>').appendTo('#files5');
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
</script>