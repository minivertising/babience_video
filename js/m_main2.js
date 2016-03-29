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

function ins_caption(param)
{
	if (param == "b_name")
		$(".imsi_caption_baby").html($("#mb_baby_name").val()+" ("+$("#mb_baby_age").val()+")");
	else if (param == "b_age")
		$(".imsi_caption_baby").html($("#mb_baby_name").val()+" ("+$("#mb_baby_age").val()+")");
	else
		$("#imsi_caption"+param).html($("#mb_caption"+param).val());
}

function sel_concept(param, param2, param3)
{
	video_concept = param;

	//$("#concept_div").hide();
	//$("#input_baby_div").show();
	location.href	= "popup_make"+param+"_new.php?mb_phone="+param2+"&serial="+param3;
}

function sel_concept2(param, param3)
{
	video_concept = param;

	//$("#concept_div").hide();
	//$("#input_baby_div").show();
	location.href	= "popup_make"+param+".php?serial="+param3;
}

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
