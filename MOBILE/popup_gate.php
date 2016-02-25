<?
	include_once   "./header.php";

	$mb_phone		= $_REQUEST['mb_phone'];
	$serial			= $_REQUEST['serial'];
?>
<body>
<div id="loading_div" class="popup_wrap" style="display:none;">
  <div class="p_mid p_position">
    <div class="block_close clearfix">
      <a href="#" class="btn_close"><img src="images/popup/btn_close.png" /></a>
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

<div id="concept_div" class="popup_wrap">
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

<div id="input_baby_div" class="popup_wrap" style="display:none;">
  <div class="p_mid p_position">
    <div class="block_close clearfix">
      <a href="#" class="btn_close"><img src="images/popup/btn_close.png" /></a>
    </div>       
    <div class="block_content input">
      <div class="title_pop_main">
        <img src="images/popup/title_pop_main.png" />
      </div>            	
      <div class="inner">
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
                <div class="input"><input type="text" name="mb_baby_age" id="mb_baby_age" placeholder="아기 나이 (숫자만 넣어주세요)"></div>
              </div>
            </div>
          </div>
        </div>


  <h3>사진1</h3>
  <a href="#" onclick="change_tab('1');return false;">사진1</a>
  <a href="#" onclick="change_tab('2');return false;">사진2</a>
  <a href="#" onclick="change_tab('3');return false;">사진3</a>
  <a href="#" onclick="change_tab('4');return false;">사진4</a>
  <a href="#" onclick="change_tab('5');return false;">사진5</a><br />
  <div class="inner_file clearfix">
    <input type="hidden" id="up_images1" value="">
    <div class="btn">
      <span class="btn btn-success fileinput-button">
      <i class="glyphicon glyphicon-plus"></i>
  <span>
    <div id="files">
      <a href="#"><img src="./images/imsi_preview.PNG" id="preview1" onclick="sel_image('1');return false;"></a>
    </div>
  </span>
  <!-- The file input field used as target for the file upload widget -->
  <input id="fileupload" type="file" name="files[]" >
  </span>
    <!-- The global progress bar -->
    <div id="progress" class="progress">
      <div class="progress-bar progress-bar-success"></div>
    </div>
    <!-- <a href="#"><img src="images/popup/btn_select_file.png" alt=""/></a> -->
  </div>
</div>
<div class="pre_img" style="width:175px;height:109px">
  <!-- The container for the uploaded files -->
  <!-- <div id="files" class="files">
    <img src="images/popup/pre_img.jpg" alt=""/>
  </div> -->
</div>
  <br />
  <input type="text" name="mb_caption1" id="mb_caption1"><br />
  <a href="#" onclick="create_movie();return false;">합성하기</a>
</div>
<br />
  <h3>사진2</h3>
  <a href="#" onclick="change_tab('1');return false;">사진1</a>
  <a href="#" onclick="change_tab('2');return false;">사진2</a>
  <a href="#" onclick="change_tab('3');return false;">사진3</a>
  <a href="#" onclick="change_tab('4');return false;">사진4</a>
  <a href="#" onclick="change_tab('5');return false;">사진5</a><br />
  <div class="inner_file clearfix">
<input type="hidden" id="up_images2" value="">
                <div class="btn">
                  <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>
					  <div id="files2">
					    <a href="#"><img src="./images/imsi_preview.PNG" id="preview2" onclick="sel_image('2');return false;"></a>
					  </div>
					</span>
                    <!-- The file input field used as target for the file upload widget -->
                    <input id="fileupload2" type="file" name="files[]" >
                  </span>
                  <!-- The global progress bar -->
                  <div id="progress" class="progress">
                    <div class="progress-bar progress-bar-success"></div>
                  </div>
                  <!-- <a href="#"><img src="images/popup/btn_select_file.png" alt=""/></a> -->
                </div>
              </div>
              <div class="pre_img" style="width:175px;height:109px">
                <!-- The container for the uploaded files -->
                <!-- <div id="files" class="files">
                  <img src="images/popup/pre_img.jpg" alt=""/>
                </div> -->
              </div>
  <br />
  <input type="text" name="mb_caption2" id="mb_caption2"><br />
  <a href="#" onclick="create_movie();return false;">합성하기</a>
<br />
  <h3>사진3</h3>
  <a href="#" onclick="change_tab('1');return false;">사진1</a>
  <a href="#" onclick="change_tab('2');return false;">사진2</a>
  <a href="#" onclick="change_tab('3');return false;">사진3</a>
  <a href="#" onclick="change_tab('4');return false;">사진4</a>
  <a href="#" onclick="change_tab('5');return false;">사진5</a><br />
<div class="inner_file clearfix">
<input type="hidden" id="up_images3" value="">
                <div class="btn">
                  <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>
					  <div id="files3">
					    <a href="#"><img src="./images/imsi_preview.PNG" id="preview3" onclick="sel_image('3');return false;"></a>
					  </div>
					</span>
                    <!-- The file input field used as target for the file upload widget -->
                    <input id="fileupload3" type="file" name="files[]" >
                  </span>
                  <!-- The global progress bar -->
                  <div id="progress" class="progress">
                    <div class="progress-bar progress-bar-success"></div>
                  </div>
                  <!-- <a href="#"><img src="images/popup/btn_select_file.png" alt=""/></a> -->
                </div>
              </div>
              <div class="pre_img" style="width:175px;height:109px">
                <!-- The container for the uploaded files -->
                <!-- <div id="files" class="files">
                  <img src="images/popup/pre_img.jpg" alt=""/>
                </div> -->
              </div>
  <br />
  <input type="text" name="mb_caption3" id="mb_caption3"><br />
  <a href="#" onclick="create_movie();return false;">합성하기</a>
<br />
  <h3>사진4</h3>
  <a href="#" onclick="change_tab('1');return false;">사진1</a>
  <a href="#" onclick="change_tab('2');return false;">사진2</a>
  <a href="#" onclick="change_tab('3');return false;">사진3</a>
  <a href="#" onclick="change_tab('4');return false;">사진4</a>
  <a href="#" onclick="change_tab('5');return false;">사진5</a><br />
<div class="inner_file clearfix">
<input type="hidden" id="up_images4" value="">
                <div class="btn">
                  <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>
					  <div id="files4">
					    <a href="#"><img src="./images/imsi_preview.PNG" id="preview4" onclick="sel_image('4');return false;"></a>
					  </div>
					</span>
                    <!-- The file input field used as target for the file upload widget -->
                    <input id="fileupload4" type="file" name="files[]" >
                  </span>
                  <!-- The global progress bar -->
                  <div id="progress" class="progress">
                    <div class="progress-bar progress-bar-success"></div>
                  </div>
                  <!-- <a href="#"><img src="images/popup/btn_select_file.png" alt=""/></a> -->
                </div>
              </div>
              <div class="pre_img" style="width:175px;height:109px">
                <!-- The container for the uploaded files -->
                <!-- <div id="files" class="files">
                  <img src="images/popup/pre_img.jpg" alt=""/>
                </div> -->
              </div>
  <br />
  <input type="text" name="mb_caption4" id="mb_caption4"><br />
  <a href="#" onclick="create_movie();return false;">합성하기</a>
<br />
  <h3>사진5</h3>
  <a href="#" onclick="change_tab('1');return false;">사진1</a>
  <a href="#" onclick="change_tab('2');return false;">사진2</a>
  <a href="#" onclick="change_tab('3');return false;">사진3</a>
  <a href="#" onclick="change_tab('4');return false;">사진4</a>
  <a href="#" onclick="change_tab('5');return false;">사진5</a><br />
<div class="inner_file clearfix">
<input type="hidden" id="up_images5" value="">
                <div class="btn">
                  <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>
					  <div id="files5">
					    <a href="#"><img src="./images/imsi_preview.PNG" id="preview5" onclick="sel_image('5');return false;"></a>
					  </div>
					</span>
                    <!-- The file input field used as target for the file upload widget -->
                    <input id="fileupload5" type="file" name="files[]" >
                  </span>
                  <!-- The global progress bar -->
                  <div id="progress" class="progress">
                    <div class="progress-bar progress-bar-success"></div>
                  </div>
                  <!-- <a href="#"><img src="images/popup/btn_select_file.png" alt=""/></a> -->
                </div>
              </div>
              <div class="pre_img" style="width:175px;height:109px">
                <!-- The container for the uploaded files -->
                <!-- <div id="files" class="files">
                  <img src="images/popup/pre_img.jpg" alt=""/>
                </div> -->
              </div>
  <br />
  <input type="text" name="mb_caption5" id="mb_caption5"><br />
</div>




        <div class="btn_block input">
          <div class="img"><a href="#" onclick="create_movie();return false;"><img src="images/popup/btn_input_1.png" /></a></div>
        </div>
      </div><!--inner-->
    </div>
  </div>
</div>

<div id="movie_div" class="popup_wrap" style="display:none;">
  <div class="p_mid p_position">
    <div class="block_close clearfix">
      <a href="#" class="btn_close"><img src="images/popup/btn_close.png" /></a>
    </div>        
    <div class="block_content movie">
      <div class="inner">
        <div class="title img">
          <img src="images/popup/title_movie_1.jpg" />
        </div>
        <div class="mv">
          <div class="title">
            <div class="img"><img src="images/popup/movie_sub_t_1.png" /></div>
            <div class="name">
              김서우<span><img src="images/popup/label_baby.png" width="35" /></span>
            </div>
          </div>
          <div class="youtube">
            <video src="../files/out.mp4" controls autoplay loop muted preload="auto" poster="demo.jpg" id="video_player"></video>
          </div>
        </div>
        <div class="btn_block img">
          <a href="../files/out.mp4" download><img src="images/popup/btn_down.png" /></a>
          <a href="#" onclick="prev_page();return false;">이전</a>
          <a href="#" onclick="next_page();return false;">다음</a>
        </div>
      </div><!--inner-->
    </div>
  </div>
</div>

<!------------------------------ 체험팩 쿠폰 받을 사람 엔딩 ------------------------------>
<div id="end_coupon_div" class="popup_wrap" style="display:none;">
  <div class="p_mid p_position">
    <div class="block_close clearfix">
      <a href="#" class="btn_close"><img src="images/popup/btn_close.png" /></a>
    </div>
    <div class="block_content coupon">
      <div class="inner">
        <div class="coupon_img">
          <div class="serial">serial</div>
          <div class="img"><img src="images/popup/bg_coupon.jpg" /></div>
        </div>
        <div class="img">
          <img src="images/popup/txt_go_home.png" />
        </div>
        <div class="btn_block">
          <a href="#" class="img"><img src="images/popup/btn_home.png" /></a>
        </div>
      </div><!--inner-->
    </div>
  </div>
</div>
<!------------------------------ 체험팩 쿠폰 받을 사람 엔딩 ------------------------------>

<!------------------------------ 체험팩 쿠폰 이미 받은 사람 엔딩 ------------------------------>
<div id="end_sns_div" class="popup_wrap" style="display:none;">
  <div class="p_mid p_position">
    <div class="block_close clearfix">
      <a href="index.php" class="btn_close"><img src="images/popup/btn_close.png" /></a>
    </div>
    <div class="block_content ending_sns">
      <div class="inner">
        <div class="ending_t">
          <div class="name c_babyname">김서우</div>
          <div class="img"><img src="images/popup/ending_t_1.png" /></div>
        </div>
        <div class="share">
          <img src="images/popup/txt_sns.png" class="txt_sns"/>
          <div>
            <a href="#" onclick="sns_share('kt','share');return false;"><img src="images/popup/btn_kt.png" /></a>
            <a href="#" onclick="sns_share('ks','share');return false;"><img src="images/popup/btn_ks.png" /></a>
            <a href="#" onclick="sns_share('fb','share');return false;"><img src="images/popup/btn_fb.png" /></a>
          </div>
        </div>
        <div class="btn_block">
          <a href="index.php" class="img"><img src="images/popup/btn_onemore.png" /></a>
        </div>
      </div><!--inner-->
    </div>
  </div>
</div>
<!------------------------------ 체험팩 쿠폰 이미 받은 사람 엔딩 ------------------------------>



</body>
</html>
<script type="text/javascript">
var video_concept	= null;

$(document).ready(function() {
	Kakao.init('d58dc6bc022da9c054b20aff9c23e0f9');
});

function sel_concept(param)
{
	video_concept = param;

	$("#concept_div").hide();
	$("#input_baby_div").show();
}

function create_movie()
{
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
	var mb_caption5			= $("#mb_caption5").val();

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
			"mb_phone"				: "<?=$mb_phone?>",
			"mb_serial"				: "<?=$serial?>"
		},
		url: "../main_exec.php",
		beforeSend: function(response){
			$("#loading_div").show();
			$("#input_baby_div").hide();
		},
		success: function(response){
			console.log(response);
			if (response == "Y")
			{
				$(".serial").html("<?=$serial?>");
				$("#end_coupon_div").show();
				$("#loading_div").hide();
			}else if (response == "D"){
				$(".c_babyname").html(mb_baby_name);
				$("#end_sns_div").show();
				$("#loading_div").hide();
			}else{
				alert('접속자가 많아 참여가 지연되고 있습니다. 다시 시도해 주세요.');
				location.href="index.php";
			}
			//console.log(response);
		}
	});
}

function prev_page()
{
	$("#input_baby_div").show();
	$("#movie_div").hide();
}

function next_page()
{
	$("#movie_div").hide();
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
    var url = 'file_upload2.php?s_id=<?=$serial?>';
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
    var url = 'file_upload3.php?s_id=<?=$serial?>';
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
    var url = 'file_upload4.php?s_id=<?=$serial?>';
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
    var url = 'file_upload5.php?s_id=<?=$serial?>';
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

function sns_share(media, flag)
{
	if (media == "fb")
	{

		var newWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('http://grow.babience-event.com/MOBILE/share_page.php?serial=<?=$serial?>'),'sharer','toolbar=0,status=0,width=600,height=325');
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
		  label: "우리아기 특별한 성장 영상 공개!",
		  image: {
			src: 'http://grow.babience-event.com/<?=$serial?>/medium/final_<?=$serial?>_1.jpg',
			width: '800',
			height: '600'
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
			url: 'http://grow.babience-event.com/MOBILE/share_page.php?serial=<?=$serial?>',
			text: '우리아기 특별한 성장 영상 공개!\r\nhttp://grow.babience-event.com/mypage.php?serial=<?=$serial?>'
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
</script>