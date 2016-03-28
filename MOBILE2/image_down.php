<?
//header('Set-Cookie: fileDownload=true; path=/babience_video/MOBILE/images/sns.jpg');
//header('Cache-Control: max-age=60, must-revalidate');
//header("Content-type: image/jpeg");
//header('Content-Disposition: attachment; filename="test.jpg"');
//header("Content-type: image/jpeg");
//header("Content-Disposition: attachment; filename=test.jpg");
//header("Set-Cookie: fileDownload=true; path=/");
?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
<script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
function my_download() {
  if (document.all.myimage.src.indexOf("gif")>=0) {  //src에 gif가 있으면(임시)
    window.frames["myimage"].document.execCommand("SaveAs");
  }
}
function image_setting() {
  document.all.myimage.src="./images/sns.jpg";
}

</script>  <title>Document</title>
 </head>
 <body>
<input type=button value=download onclick="image_setting()">
<iframe id=myimage name=myimage src="about:blank" width=0 height=0 onload="my_download()"></iframe>
 </body>
</html>
