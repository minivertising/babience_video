<?
	include_once   "./header.php";
?>
<body>
	<div class="popup_wrap">
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
                        	<video src="../files/BEB54EC761/out.mp4" controls autoplay loop muted preload="auto" poster="demo.jpg" id="video_player">

</video>
                        </div>
                    </div>
                    <div class="btn_block img">
                    	<a href="#"><img src="images/popup/btn_down.png" /></a>
                    </div>
                </div><!--inner-->
            </div>
        </div>
	</div>


</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	$("#video_player").attr("width",$(".youtube").width());
});
</script>