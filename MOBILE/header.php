<?
	include_once "../config.php";

	if (isset($_REQUEST['serial']))
		$serial2	= $_REQUEST['serial'];
?>
<!doctype html>
  <html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=yes,initial-scale=1.0, maximum-scale=1.0"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta property="og:title" content="[베비언스] 베비언스 먹고 폭풍 성장">
      <meta property="og:type" content="website" />
      <meta property="og:url" content="http://grow.babience-event.com/MOBILE/index.php?serial=<?=$serial2?>" />
      <meta property="og:image" content="http://grow.babience-event.com/files/<?=$serial2?>/medium/final_<?=$serial2?>_1.jpg" />
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
    </head>