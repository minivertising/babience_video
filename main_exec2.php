<?php
include_once "config2.php";

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

	case "update_info" :
		$mb_name		= $_REQUEST['mb_name'];
		$mb_phone		= $_REQUEST['mb_phone'];
		$chk_adver		= $_REQUEST['chk_adver'];
		$serial				= $_REQUEST['mb_serial'];

		$query 	= "UPDATE ".$_gl['member_info2_table']." SET mb_name='".$mb_name."', mb_phone='".$mb_phone."' ,chk_adver='".$chk_adver."' WHERE mb_serial='".$serial."'";
		$result 	= mysqli_query($my_db, $query);
		if ($result)
			$flag	= "Y";
		else
			$flag	= "N";

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
		$img_name1				= $_REQUEST['up_image1'];
		$mb_caption1			= $_REQUEST['mb_caption1'];
		$mb_phone				= $_REQUEST['mb_phone'];
		$mb_serial				= $_REQUEST['mb_serial'];
		$mb_concept			= $_REQUEST['mb_concept'];

		$cap_image1	= "";

		if ($mb_concept == "1")
		{
			$caption_image1_w	= "120;";
			$caption_image1_h	= "440;";
		}else if ($mb_concept == "2"){
			$caption_image1_w	= "38;";
			$caption_image1_h	= "325;";
			$caption_image2_w	= "40;";
			$caption_image2_h	= "440;";
			$caption_image2_name_w	= "40;";
			$caption_image2_name_h	= "383;";
		}else if ($mb_concept == "3"){
			$caption_image1_w	= "370;";
			$caption_image1_h	= "410;";
			$caption_image2_w	= "40;";
			$caption_image2_h	= "440;";
			$caption_image2_name_w	= "40;";
			$caption_image2_name_h	= "393;";
		}else if ($mb_concept == "4"){
			$caption_image1_w	= "110;";
			$caption_image1_h	= "362;";
			$caption_image2_w	= "40;";
			$caption_image2_h	= "440;";
			$caption_image2_name_w	= "40;";
			$caption_image2_name_h	= "393;";
		}

		$img_name1arr			= explode(".",stripslashes($img_name1));
		$img_name1arr_num	= count($img_name1arr) -1;

		if ($img_name1arr[$img_name1arr_num] == "jpeg")
			$img_name1arr[$img_name1arr_num]	= "jpg";

		$img_name1			= $mb_serial."_1.".strtolower($img_name1arr[$img_name1arr_num]); 
		$new_image1			= merge_image($img_name1, $mb_serial,"1", $mb_concept);
		$f_img_name1			= $mb_serial."_1.jpg";
		$new_image1_1			= merge_image2($f_img_name1, $mb_serial,"1", $mb_concept);
		if ($mb_concept == "2" || $mb_concept == "4"){
			$cap_image1			= caption_image_white($mb_caption1, $mb_serial,"1",$caption_image1_w,$caption_image1_h);
		}else if ($mb_concept == "3"){
			$rs_caption_w3	= txt_position($mb_caption1, $mb_concept);
			$cap_image1			= caption_image_yellow($mb_caption1, $mb_serial,"1",$rs_caption_w3,$caption_image1_h);
		}else{
			//$mb_caption1	= "어느덧 쑥쑥 자라서 너무 고마워";
			$rs_caption_w1	= txt_position($mb_caption1, $mb_concept);
			$cap_image1			= caption_image($mb_caption1, $mb_serial,"1",$rs_caption_w1,$caption_image1_h);
		}

		//$query 	= "UPDATE ".$_gl['member_info_table']." SET mb_baby_name='".$mb_baby_name."',mb_baby_age='".$mb_baby_age."',mb_concept='".$mb_concept."', mb_photo1='".$img_name1."' WHERE mb_serial='".$mb_serial."'";
		//$result 	= mysqli_query($my_db, $query);
		$query 	= "INSERT INTO ".$_gl['member_info2_table']."(mb_baby_name,mb_baby_age,mb_concept,mb_photo1,mb_ipaddr,mb_regdate,mb_serial,mb_gubun,mb_media) values('".$mb_baby_name."','".$mb_baby_age."','".$mb_concept."','".$img_name1."','".$_SERVER['REMOTE_ADDR']."','".date("Y-m-d H:i:s")."','".$mb_serial."','".$gubun."','".$media."')";
		$result 	= mysqli_query($my_db, $query);

		if ($result)
		{
			$flag	= "Y";
		}else{
			$flag	= "N";
		}
		echo $flag;
	break;

	case "insert_click_count" :
		$c_position	= $_REQUEST['c_position'];
		$media		= $_SESSION['ss_media'];

		// 클릭 정보 입력
		$click_query		= "INSERT INTO ".$_gl['click_info_table']."(click_media, click_position, click_date) values ('".$_SESSION['ss_media']."','".$c_position."','".date('Y-m-d H:i:s')."')";
		$result		= mysqli_query($my_db, $click_query);

		if ($result)
			$flag	= "Y";
		else
			$flag	= "N";
		echo $flag;
	break;
}
?>