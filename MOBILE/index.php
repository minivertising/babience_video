<?
	include_once   "./header.php";
	$serial	= BC_getSerial();
?>
 <body>
<div id="main_div">
  <iframe allowfullscreen="1" src="<?=$_gl['youtube_url']?>" frameborder="0" id="ytplayer" class="ytplayer"></iframe><br />
  <a href="#" onclick="show_input_div('input_popup');return false;">성장 영상 만들기</a><br />
  <a href="#" onclick="show_notice();return false;">이벤트 유의사항</a>
  <div id="notice_div" style="display:none;">
    이벤트 유의사항 내용
  </div>
</div>
<div id="input_div" style="background:white;display:none;">
  <input type="text" name="mb_name" id="mb_name" placeholder="이름"><br />
  <input type="tel" name="mb_phone" id="mb_phone" placeholder="휴대폰번호"><br />
  <input type="checkbox" name="privacy_check" id="privacy_check">개인정보 수집 및 위탁에 관한 동의<a href="#">자세히보기</a><br />
  <input type="checkbox" name="adver_check" id="adver_check">광고성 정보 전송 동의<a href="#">자세히보기</a><br />
  <a href="#" onclick="insert_input();return false;">입력하기</a>
</div>
<div id="concept_div" style="background:white;display:none;">
  영상컨셉1<br />
  <a href="#" onclick="sel_concept('1');return false;">그것이 알고싶어</a><br />
  영상컨셉2<br />
  <a href="#" onclick="sel_concept('2');return false;">아기인간극장</a><br />
  영상컨셉3<br />
  <a href="#" onclick="sel_concept('3');return false;">베비뉴스</a><br />
  영상컨셉4<br />
  <a href="#" onclick="sel_concept('4');return false;">성장다이어리</a><br />
</div>
<div id="input_baby_div" style="background:white;display:none;">
  <input type="text" name="mb_baby_name" id="mb_baby_name" placeholder="아기이름"><br />
  <input type="tel" name="mb_baby_age" id="mb_baby_age" placeholder="나이"><br />

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
  <a href="#" onclick="create_movie();return false;">합성하기</a>

  <!-- <a href="#" onclick="insert_baby_input();return false;">입력하기</a> -->
</div>
<div id="input_picture1_div" style="background:white;display:none;">
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
<div id="input_picture2_div" style="background:white;display:none;">
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
</div>
<div id="input_picture3_div" style="background:white;display:none;">
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
</div>
<div id="input_picture4_div" style="background:white;display:none;">
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
</div>
<div id="input_picture5_div" style="background:white;display:none;">
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
  <a href="#" onclick="create_movie();return false;">합성하기</a>
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