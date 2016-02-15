function go_next()
{
	mb_name				= $("#mb_name").val();
	mb_phone1				= $("#mb_phone1").val();
	mb_phone2				= $("#mb_phone2").val();
	mb_phone3				= $("#mb_phone3").val();
	mb_phone				= mb_phone1 + mb_phone2 + mb_phone3;
	mb_sns					= $("#mb_sns").val();
	//mb_magazineYN		= $(':radio[name="mb_magazine"]:checked').val();
	//var mb_university			= $("#mb_university").val();
	//var mb_major				= $("#mb_major").val();

	if (mb_name == "")
	{
		alert('이름을 입력해 주세요.');
		$("#mb_name").focus();
		//chk_ins = 0;
		return false;
	}

	if (mb_phone1 == "")
	{
		alert('전화번호를 입력해주세요.');
		$("#mb_phone1").focus();
		//chk_ins = 0;
		return false;
	}

	if (mb_phone2 == "")
	{
		alert('전화번호를 입력해주세요.');
		$("#mb_phone2").focus();
		//chk_ins = 0;
		return false;
	}

	if (mb_phone3 == "")
	{
		alert('전화번호를 입력해주세요.');
		$("#mb_phone3").focus();
		//chk_ins = 0;
		return false;
	}

	if (mb_sns == "")
	{
		alert('SNS 주소를 입력해 주세요.');
		$("#mb_sns").focus();
		//chk_ins = 0;
		return false;
	}

	if (mb_sns == "")
	{
		alert('SNS 주소를 입력해 주세요.');
		$("#mb_sns").focus();
		//chk_ins = 0;
		return false;
	}

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

	$("#input_area1").hide();
	$("#input_area2").show();
}

function go_dhni_comp()
{
	mb_university			= $("#mb_university").val();
	mb_major				= $("#mb_major").val();

	$.ajax({
		type:"POST",
		data:{
			"exec"					: "update_info",
			"mb_phone"				: mb_phone,
			"mb_university"			: mb_university,
			"mb_major"				: mb_major
		},
		url: "../main_exec.php",
		success: function(response){
			alert(response);
			if (response == "Y")
			{
				$("#input_area4").hide();
				$("#comp_area2").show();
			}else{
				alert("참여자가 많아 지연되고 있습니다. 다시 응모해 주세요.");
				location.href="index.php";
			}
		}
	});

}

function comp_proc(param)
{
	if (param == "1")
	{
		$("#input_area3").hide();
		$("#input_area4").show();
		mb_magazineYN = "Y";
	}else{
		$("#input_area3").hide();
		$("#comp_area1").show();
		mb_magazineYN = "N";
	}
}

$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'file_upload.php';
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
			img_name1 = file.name;
            var node = $('<p/>');
                   // .append($('<span/>').text(file.name));
			  $("#image_up_name1").val(file.name);
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
    var url = 'file_upload2.php';
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
			img_name2 = file.name;
            var node = $('<p/>');
                   // .append($('<span/>').text(file.name));
			  $("#image_up_name2").val(file.name);
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
    var url = 'file_upload3.php';
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
			img_name3 = file.name;
            var node = $('<p/>');
                   // .append($('<span/>').text(file.name));
			  $("#image_up_name3").val(file.name);
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
    var url = 'file_upload4.php';
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
			img_name4 = file.name;
            var node = $('<p/>');
                   // .append($('<span/>').text(file.name));
			  $("#image_up_name4").val(file.name);
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
    var url = 'file_upload5.php';
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
			img_name5 = file.name;
            var node = $('<p/>');
                   // .append($('<span/>').text(file.name));
			  $("#image_up_name5").val(file.name);
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

function apply_member()
{
	//sel_radio 		= $(':radio[name="ink_rip"]:checked').val();

	if (sel_radio == null)
	{
		alert('당신에게 가장 잘 어울릴 것 같은 잉크 젤스틱 컬러를 선택해 주세요.');
		return false;
	}

	$("#rip_area").hide();
	$("#input_area1").show();
}

function go_prev(param)
{
	if (param == '1')
	{
	$("#input_area2").hide();
	$("#input_area1").show();
	}
}

function open_pop(param)
{
	if (param == "privacy_agree_popup")
	{
		var pop_w	= "589px";
		var pop_h	= "666px";
		var pop_oh	= "624px";
	}else if (param == "adver_agree_popup")
	{
		var pop_w	= "500px";
		var pop_h	= "477px";
		var pop_oh	= "435px";
	}
	$.colorbox({width:pop_w, height:pop_h, inline:true, opacity:"0.9", scrolling:false, closeButton:false, overlayClose: false, fadeOut: 300, href:"#"+param, onComplete: function(){
		$("#cboxLoadedContent").height(pop_oh);
		$("#cboxContent").css("background","none");
	},
	onClosed: function(){
	}});
}

function chk_len(val)
{
	if (val.length == 3)
	{
		$("#mb_phone2").focus();
	}
}

function chk_len2(val)
{
	if (val.length == 4)
	{
		$("#mb_phone3").focus();
	}
}

function chk_len3(val)
{
	if (val.length == 4)
	{
		$("#mb_phone3").blur();
	}
}

function only_num(obj)
{
	var inText = obj.value;
	var outText = "";
	var flag = true;
	var ret;
	for(var i = 0; i < inText.length; i++)
	{
		ret = inText.charCodeAt(i);
		if((ret < 48) || (ret > 57))
		{
			flag = false;
		}
		else
		{
			outText += inText.charAt(i);
		}
	}
 
	if(flag == false)
	{
		alert("전화번호는 숫자입력만 가능합니다.");
		obj.value = outText;
		obj.focus();
		return false;
	} 
	return true;
}

