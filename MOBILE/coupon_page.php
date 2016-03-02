<?
	include_once   "./header.php";

	$serialnumber		= $_REQUEST['serial'];

	$query 	= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_serial='".$serialnumber."'";
	$result 	= mysqli_query($my_db, $query);
	$member_info	= mysqli_fetch_array($result);
?>
<!doctype html>
  <html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=yes,initial-scale=1.0, maximum-scale=1.0"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta property="og:title" content="[베비언스] 베비언스 먹고 폭풍 성장">
      <meta property="og:type" content="website" />
      <meta property="og:url" content="http://grow.babience-event.com/MOBILE/coupon_page.php?serial=<?=$serialnumber?>" />
      <meta property="og:image" content="http://grow.babience-event.com/files/<?=$serialnumber?>/medium/final_<?=$serialnumber?>_1.jpg" />
      <meta property="og:description" content="우리 아기의 성장 과정을 특별하게 담는 방법! 지금 베비언스에서 만들어 드립니다.">
      <link rel="shortcut icon" type="image/x-icon" href="./images/fabicon.ico" />
      <title>베비언스 먹고 폭풍 성장!</title>
      <link href="css/style.css" rel="stylesheet" type="text/css">
      <!-- Generic page styles -->
      <link rel="stylesheet" href="../lib/jQuery-File-Upload/css/style.css">
      <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
      <link rel="stylesheet" href="../lib/jQuery-File-Upload/css/jquery.fileupload.css">
      <link rel="stylesheet" href="../lib/colorbox/colorbox.css">
      <script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
      <script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
      <script type="text/javascript" src="../js/m_main.js"></script>
      <script type="text/javascript" src="../lib/colorbox/jquery.colorbox-min.js"></script>
      <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
      <script src="../lib/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
      <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
      <script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
      <!-- The Canvas to Blob plugin is included for image resizing functionality -->
      <script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
      <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
      <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
      <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
      <script src="../lib/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
      <!-- The basic File Upload plugin -->
      <script src="../lib/jQuery-File-Upload/js/jquery.fileupload.js"></script>
      <!-- The File Upload processing plugin -->
      <script src="../lib/jQuery-File-Upload/js/jquery.fileupload-process.js"></script>
      <!-- The File Upload image preview & resize plugin -->
      <script src="../lib/jQuery-File-Upload/js/jquery.fileupload-image.js"></script>
      <!-- The File Upload audio preview plugin -->
      <script src="../lib/jQuery-File-Upload/js/jquery.fileupload-audio.js"></script>
      <!-- The File Upload video preview plugin -->
      <script src="../lib/jQuery-File-Upload/js/jquery.fileupload-video.js"></script>
      <!-- The File Upload validation plugin -->
      <script src="../lib/jQuery-File-Upload/js/jquery.fileupload-validate.js"></script>
      <script type="text/javascript" src="../lib/colorbox/jquery.colorbox-min.js"></script>
      <script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
      <!-- <script type="text/javascript" src="http://www.youtube.com/player_api"></script> -->
    </head><body>
<div class="sec_top">
  <div class="inner_sec_top">
    <a href="#"><img src="images/logo.png" width="80" /></a>
  </div>
</div>
<div class="popup_wrap">
  <div class="p_mid p_position">
    <div class="block_content movie">
      <div class="inner">
        <div class="title img">
          <img src="images/popup/top_2.jpg" />
        </div>
        <div class="mv">
          <div class="title">
            <div class="text">
            "<?=$member_info['mb_caption1']?>"
            </div>
            <div class="bg img"><img src="images/popup/title_movie_c_1.png" /></div>
          </div>
          <div class="name">
          <?=$member_info['mb_baby_name']?><span><img src="images/popup/label_baby.png" width="35" /></span>
          </div>
          <div class="youtube" style="background:#a3e2eb">
            <video src="../files/<?=$serialnumber?>/growmovie.mp4" controls preload="auto" id="video_player" poster="scene/concept_<?=$member_info['mb_concept']?>_1.jpg"></video>
          </div>
        </div>
      </div><!--inner-->
    </div>  
    <div class="block_content ending_sns">
      <div class="inner">
        <div class="share">
          <img src="images/popup/txt_sns.png" class="txt_sns"/>
        <div>
        <a href="#" onclick="sns_share('kt','share');return false;"><img src="images/popup/btn_kt.png" /></a>
        <a href="#" onclick="sns_share('ks','share');return false;"><img src="images/popup/btn_ks.png" /></a>
        <a href="#" onclick="sns_share('fb','share');return false;"><img src="images/popup/btn_fb.png" /></a>
      </div>
    </div>
    <div class="btn_block">
      <a href="http://grow.babience-event.com" target="_blank" class="img"><img src="images/popup/btn_onemore.png" /></a>
    </div>
  </div><!--inner-->
</div>
        </div>
	</div> 
 
    
</body>
</html>
<script type="text/javascript">

$(document).ready(function(){
	$("#video_player").width($(".youtube").width());
});

function sns_share(media, flag)
{
	if (media == "fb")
	{

		var newWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('http://grow.babience-event.com/MOBILE/coupon_page.php?serial=<?=$serialnumber?>'),'sharer','toolbar=0,status=0,width=600,height=325');
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
	}else if (media == "kt"){
		// 카카오톡 링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
		//Kakao.Link.createTalkLinkButton({
		Kakao.Link.sendTalkLink({
		  //container: '#kakao-link-btn',
		  label: "혼자보기 아까운 우리아기 성장 영상 공개!",
		  image: {
			src: 'http://grow.babience-event.com/<?=$serialnumber?>/medium/final_<?=$serialnumber?>_1.jpg',
			width: '800',
			height: '600'
		  },
		  webButton: {
			text: '[베비언스] 베비언스 먹고 폭풍 성장!',
			url: 'http://grow.babience-event.com/MOBILE/index.php?serial=<?=$serialnumber?>' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
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
			url: 'http://grow.babience-event.com/MOBILE/coupon_page.php?serial=<?=$serialnumber?>',
			text: '혼자보기 아까운 우리아기 성장 영상 공개!!\r\nhttp://grow.babience-event.com/coupon_page.php?serial=<?=$serialnumber?>'
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