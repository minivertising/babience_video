<?
	include_once   "./header.php";
?>

<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
 </head>
 <body>
  <a href="./images/sns.jpg" onclick="image_down_test();return false;">다운로드</a>
 </body>
</html>
<script type="text/javascript">
function image_down_test()
{
	$.ajax({
		type:"POST",
		data:{
			"file_dir"		: "./images/sns.jpg"
		},
		url: "./ajax_file.php",
		success: function(response){
			alert(response);
		}
	});
}
</script>