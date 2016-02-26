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
	$("#imsi_caption"+param).html($("#mb_caption"+param).val());
}

function sel_concept(param, param2, param3)
{
	video_concept = param;

	//$("#concept_div").hide();
	//$("#input_baby_div").show();
	location.href	= "popup_make"+param+".php?mb_phone="+param2+"&serial="+param3;
}
