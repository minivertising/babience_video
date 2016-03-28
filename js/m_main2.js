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
