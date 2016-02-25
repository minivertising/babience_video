<?php
include_once "config.php";

switch ($_REQUEST['exec'])
{
	case "insert_share_info" :
		$sns_media	= $_REQUEST['sns_media'];
		$sns_flag		= $_REQUEST['sns_flag'];

		$query 		= "INSERT INTO ".$_gl['share_info_table']."(sns_media, sns_ipaddr, sns_gubun, inner_media, sns_regdate) values('".$sns_media."','".$_SERVER['REMOTE_ADDR']."','".$gubun."','".$_SESSION['ss_media']."','".date("Y-m-d H:i:s")."')";
		$result 	= mysqli_query($my_db, $query);

		if ($result)
			$flag = "Y";
		else
			$flag = "N";

		echo $flag;

	break;

	case "insert_info" :
		$mb_name			= $_REQUEST['mb_name'];
		$mb_phone			= $_REQUEST['mb_phone'];
		$media				= $_SESSION['ss_media'];
		$serial			= $_REQUEST['mb_serial'];
		//$serial	= BC_getSerial();

		$query 	= "INSERT INTO ".$_gl['member_info_table']."(mb_ipaddr,mb_name,mb_phone,mb_regdate,mb_serial,mb_gubun,mb_media) values('".$_SERVER['REMOTE_ADDR']."','".$mb_name."','".$mb_phone."','".date("Y-m-d H:i:s")."','".$serial."','".$gubun."','".$media."')";
		$result 	= mysqli_query($my_db, $query);
		if ($result)
			$flag	= "Y||".$serial;
		else
			$flag	= "N||".$serial;

		// $flag=D ( 중복 ), Y ( 참여완료 ), N ( 오류 )
		echo $flag;
	break;

	case "update_baby_info" :
		$mb_baby_name		= $_REQUEST['mb_baby_name'];
		$mb_baby_age			= $_REQUEST['mb_baby_age'];
		$mb_phone				= $_REQUEST['mb_phone'];
		$mb_serial				= $_REQUEST['mb_serial'];

		$query 	= "UPDATE ".$_gl['member_info_table']." SET mb_baby_name='".$mb_baby_name."', mb_baby_age='".$mb_baby_age."' WHERE mb_serial='".$mb_serial."'";
		$result 	= mysqli_query($my_db, $query);

		if ($result)
			$flag	= "Y";
		else
			$flag	= "N";

		echo $flag;

	break;

	case "create_movie" :
		$mb_baby_name		= $_REQUEST['mb_baby_name'];
		$mb_baby_age			= $_REQUEST['mb_baby_age'];
		$img_name1	= $_REQUEST['up_image1'];
		$img_name2	= $_REQUEST['up_image2'];
		$img_name3	= $_REQUEST['up_image3'];
		$img_name4	= $_REQUEST['up_image4'];
		$img_name5	= $_REQUEST['up_image5'];
		$mb_caption1	= $_REQUEST['mb_caption1'];
		$mb_caption2	= $_REQUEST['mb_caption2'];
		$mb_caption3	= $_REQUEST['mb_caption3'];
		$mb_caption4	= $_REQUEST['mb_caption4'];
		$mb_caption5	= $_REQUEST['mb_caption5'];
		$mb_phone		= $_REQUEST['mb_phone'];
		$mb_serial		= $_REQUEST['mb_serial'];

		$cap_image1	= "";
		$cap_image2	= "";
		$cap_image3	= "";
		$cap_image4	= "";
		$cap_image5	= "";

		if ($img_name1)
		{
			$img_name1arr			= explode(".",stripslashes($img_name1));
			$img_name1arr_num	= count($img_name1arr) -1;
			$img_name1			= $mb_serial."_1.".strtolower($img_name1arr[$img_name1arr_num]); 
			$new_image1			= merge_image($img_name1, $mb_serial,"1");
			$cap_image1			= caption_image($mb_caption1, $mb_serial,"1");
		}

		if ($img_name2)
		{
			$img_name2arr			= explode(".",stripslashes($img_name2));
			$img_name2arr_num	= count($img_name2arr) -1;
			$img_name2			= $mb_serial."_2.".strtolower($img_name2arr[$img_name2arr_num]); 
			$new_image2			= merge_image($img_name2, $mb_serial,"2");
			$cap_image2			= caption_image($mb_caption2, $mb_serial,"2");
		}

		if ($img_name3)
		{
			$img_name3arr			= explode(".",stripslashes($img_name3));
			$img_name3arr_num	= count($img_name3arr) -1;
			$img_name3			= $mb_serial."_3.".strtolower($img_name3arr[$img_name3arr_num]); 
			$new_image3			= merge_image($img_name3, $mb_serial,"3");
			$cap_image3			= caption_image($mb_caption3, $mb_serial,"3");
		}

		if ($img_name4)
		{
			$img_name4arr			= explode(".",stripslashes($img_name4));
			$img_name4arr_num	= count($img_name4arr) -1;
			$img_name4			= $mb_serial."_4.".strtolower($img_name4arr[$img_name4arr_num]); 
			$new_image4			= merge_image($img_name4, $mb_serial,"4");
			$cap_image4			= caption_image($mb_caption4, $mb_serial,"4");
		}

		if ($img_name5)
		{
			$img_name5arr			= explode(".",stripslashes($img_name5));
			$img_name5arr_num	= count($img_name5arr) -1;
			$img_name5			= $mb_serial."_5.".strtolower($img_name5arr[$img_name5arr_num]); 
			$new_image5			= merge_image($img_name5, $mb_serial,"5");
			$cap_image5			= caption_image($mb_caption5, $mb_serial,"5");
		}

		$out_exec	= 'ffmpeg \ -loop 1 -i ./files/'.$mb_serial.'/'.$img_name1.' \ -loop 1 -i ./files/'.$mb_serial.'/'.$img_name2.' \ -loop 1 -i ./files/'.$mb_serial.'/'.$img_name3.' \ -loop 1 -i ./files/'.$mb_serial.'/'.$img_name4.' \ -loop 1 -i ./files/'.$mb_serial.'/'.$img_name5.' \ -filter_complex \ "[0:v]trim=duration=15,fade=t=out:st=14.5:d=0.5[v0]; \ [1:v]trim=duration=15,fade=t=in:st=0:d=0.5,fade=t=out:st=14.5:d=0.5[v1]; \ [2:v]trim=duration=15,fade=t=in:st=0:d=0.5,fade=t=out:st=14.5:d=0.5[v2]; \ [3:v]trim=duration=15,fade=t=in:st=0:d=0.5,fade=t=out:st=14.5:d=0.5[v3]; \ [4:v]trim=duration=15,fade=t=in:st=0:d=0.5,fade=t=out:st=14.5:d=0.5[v4]; \ [v0][v1][v2][v3][v4]concat=n=5:v=1:a=0,format=yuv420p[v]" -map "[v]" ./files/'.$mb_serial.'/out.mp4';

		exec($out_exec,$output);

		$query 	= "UPDATE ".$_gl['member_info_table']." SET mb_baby_name='".$mb_baby_name."',mb_baby_age='".$mb_baby_age."',mb_photo1='".$img_name1."', mb_photo2='".$img_name2."', mb_photo3='".$img_name3."', mb_photo4='".$img_name4."', mb_photo5='".$img_name5."', mb_caption1='".$mb_caption1."', mb_caption2='".$mb_caption2."', mb_caption3='".$mb_caption3."', mb_caption4='".$mb_caption4."', mb_caption5='".$mb_caption5."' WHERE mb_serial='".$mb_serial."'";
		$result 	= mysqli_query($my_db, $query);

		echo $out_exec;
	break;
}
?>