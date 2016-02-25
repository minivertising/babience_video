<?
	include_once   "./header.php";

	$serial	= BC_getSerial();
?>
<body>
<div class="popup_wrap">
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
                <div class="input"><input type="text" name="mb_phone" id="mb_phone" placeholder="휴대폰번호 ('-' 없이 입력해주세요)" onkeyup="only_num(this);chk_len(this.value);"></div>
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
<?
	include_once   "./popup_div.php";
?>
</body>
</html>
<script type="text/javascript">
var chk_privacy_flag	= 0;
var chk_adver_flag		= 0;
var serial_num		= null;

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

function privacy_check()
{
	if (chk_privacy_flag == 0)
	{
		$("#privacy_agree").attr("src","images/popup/check_on.jpg");
		chk_privacy_flag = 1;
	}else{
		$("#privacy_agree").attr("src","images/popup/check_off.jpg");
		chk_privacy_flag = 0;
	}
}

function adver_check()
{
	if (chk_adver_flag == 0)
	{
		$("#adver_agree").attr("src","images/popup/check_on.jpg");
		chk_adver_flag = 1;
	}else{
		$("#adver_agree").attr("src","images/popup/check_off.jpg");
		chk_adver_flag = 0;
	}
}

function open_pop(param)
{
	$.colorbox({innerWidth:"100%", initialWidth:"95%", inline:true, opacity:"0.9", scrolling:false, reposition: false,closeButton:false, overlayClose: false, open:true, speed:0, fadeOut: 300, href:"#"+param, onComplete: function(){
		$("#cboxContent").css("background","none");
		$("#colorbox").width($("body").width());
		$("#cboxWrapper").width($("body").width());
	},
	onClosed: function(){
		$("#cboxContent").css("background","#fff");
	}});
}

function chk_len(val)
{
	if (val.length == 11)
	{
		$("#mb_phone").blur();
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

	if (chk_adver_flag == 0)
	{
		alert("광고성 정보전송 동의를 안 하셨습니다");
		//chk_ins = 0;
		return false;
	}

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
			if (flag_res[0] == "Y")
			{
				//$("#input_div").hide();
				//$("#concept_div").show();
				location.href="./popup_gate.php?mb_phone=" + mb_phone + "&serial=<?=$serial?>";
			}else{
				alert("참여자가 많아 지연되고 있습니다. 다시 응모해 주세요.");
				location.href="index.php";
			}
		}
	});
}
</script>