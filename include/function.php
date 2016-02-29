<?
	// 유입매체 정보 입력
	function BR_InsertTrackingInfo($media, $gubun)
	{
		global $_gl;
		global $my_db;

		$query		= "INSERT INTO ".$_gl['tracking_info_table']."(tracking_media, tracking_refferer, tracking_ipaddr, tracking_date, tracking_gubun) values('".$media."','".$_SERVER['HTTP_REFERER']."','".$_SERVER['REMOTE_ADDR']."',now(),'".$gubun."')";
		$result		= mysqli_query($my_db, $query);
	}

	function BA_winner_draw($mb_phone)
	{
		global $_gl;
		global $my_db;

		$water_winner		= 30;	// 베이비 워터 1박스
		$skin_winner			= 30;	// 스킨케어 2종 세트(로션+워시)
		$clean_winner		= 30;	// 클린 4종세트(세제섬유유연제용기+리필
		$delivery_winner	= 50000;	// 무료 배송 쿠폰
		$discount_winner	= 50000;	// 3천원 할인 쿠폰

		$water_array = array(200000);
		$skin_array = array(200000);
		$clean_array = array(200000);
		$delivery_array = array(200000);
		$discount_array = array(200000);
		$delivery_array = array("Y","N");
		$discount_array = array("Y","N");

		// 오늘의 이벤트 참여자 수 구하기
		$total_query		= "SELECT * FROM ".$_gl['voter_info_table']." WHERE vote_regdate like '%".date("Y-m-d")."%'";
		$total_result		= mysqli_query($my_db, $total_query);
		$total_num		= mysqli_num_rows($total_result);

		// 중복 당첨 체크
		$dupli_query		= "SELECT * FROM ".$_gl['voter_info_table']." WHERE vote_phone='".$mb_phone."' AND vote_winner like '%Y%'";
		$dupli_result		= mysqli_query($my_db, $dupli_query);
		$dupli_num		= mysqli_num_rows($dupli_result);

		// 중복 참여자 체크
		$dupli0_query		= "SELECT * FROM ".$_gl['voter_info_table']." WHERE vote_phone='".$mb_phone."'";
		$dupli0_result		= mysqli_query($my_db, $dupli0_query);
		$dupli0_num		= mysqli_num_rows($dupli0_result);
		
		// 후보자 중복 참여자 체크
		$dupli1_query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_phone='".$mb_phone."'";
		$dupli1_result		= mysqli_query($my_db, $dupli1_query);
		$dupli1_num		= mysqli_num_rows($dupli1_result);

		// 배송비 중복 당첨여부 체크
		$dupli_bann_query		= "SELECT * FROM ".$_gl['bann_info_table']." WHERE bann_phone='".$mb_phone."'";
		$dupli_bann_result		= mysqli_query($my_db, $dupli_bann_query);
		$dupli_bann_num		= mysqli_num_rows($dupli_bann_result);

		if ($dupli_num > 0)
		{
			$winner = "N||DISCOUNT";
		}else{
			$winner = "N||DISCOUNT";
			if ($dupli0_num == 0)
			{
				if ($dupli_bann_num == 0 || $dupli1_num == 0)
					$winner = "N||DELIVERY";
				else
					$winner = "N||DISCOUNT";
			}

			if ($winner != "N||DELIVERY")
			{
				if ($dupli0_num < 3)
				{
					$winner = "N||DISCOUNT";
				}else{
					foreach ($water_array as $key => $val)
					{
						if ($total_num == $val)
						{
							$winner = "Y||WATER";
							break;
						}
						$winner = "N||DISCOUNT";
							//$winner = "Y||WATER";
					}

					foreach ($skin_array as $key => $val)
					{
						if ($total_num == $val)
						{
							$winner = "Y||SKIN";
							break;
						}
						$winner = "N||DISCOUNT";
							//$winner = "Y||WATER";
					}

					foreach ($clean_array as $key => $val)
					{
						if ($total_num == $val)
						{
							$winner = "Y||CLEAN";
							break;
						}
						$winner = "N||DISCOUNT";
							//$winner = "Y||WATER";
					}
				}
			}
		}
		return $winner;
	}



	function BC_getSerial()
	{
		global $_gl;
		global $my_db;

		$query		= "SELECT serial_code FROM ".$_gl['serial_info_table']." WHERE useYN='N' limit 1";
		$result		= mysqli_query($my_db, $query);
		$data			= mysqli_fetch_array($result);

		$query2		= "UPDATE ".$_gl['serial_info_table']." SET useYN='Y' WHERE serial_code='".$data['serial_code']."'";
		$result2		= mysqli_query($my_db, $query2);

		return $data['serial_code'];
	}

	// LMS 발송 
	function send_lms($phone, $serial)
	{
		global $_gl;
		global $my_db;

		$s_url		= "http://grow.babience-event.com/MOBILE/coupon_page.php?serial=".$serial;
		$httpmethod = "POST";
		$url = "http://api.openapi.io/ppurio/1/message/lms/minivertising";
		$clientKey = "MTAyMC0xMzg3MzUwNzE3NTQ3LWNlMTU4OTRiLTc4MGItNDQ4MS05NTg5LTRiNzgwYjM0ODEyYw==";
		$contentType = "Content-Type: application/x-www-form-urlencoded";

		$response = sendRequest($httpmethod, $url, $clientKey, $contentType, $phone, $s_url, $serial);

		$json_data = json_decode($response, true);

		/*
		받아온 결과값을 DB에 저장 및 Variation
		*/
		$query3 = "INSERT INTO sms_info(send_phone, send_status, cmid, send_regdate) values('".$phone."','".$json_data['result_code']."','".$json_data['cmid']."','".date("Y-m-d H:i:s")."')";
		$result3 		= mysqli_query($my_db, $query3);

		$query2 = "UPDATE member_info SET mb_lms='Y' WHERE mb_phone='".$phone."'";
		$result2 		= mysqli_query($my_db, $query2);

		if ($json_data['result_code'] == "200")
			$flag = "Y";
		else
			$flag = "N";

		return $flag;
	}

	// LMS 발송 
	function send_lms2($phone, $serial)
	{
		global $_gl;
		global $my_db;

		$s_url		= "http://www.belif-factory.com/MOBILE/coupon_page.belif?mid=".$phone;
		$httpmethod = "POST";
		$url = "http://api.openapi.io/ppurio/1/message/lms/minivertising";
		$clientKey = "MTAyMC0xMzg3MzUwNzE3NTQ3LWNlMTU4OTRiLTc4MGItNDQ4MS05NTg5LTRiNzgwYjM0ODEyYw==";
		$contentType = "Content-Type: application/x-www-form-urlencoded";

		$response = sendRequest2($httpmethod, $url, $clientKey, $contentType, $phone, $s_url, $serial);

		$json_data = json_decode($response, true);

		/*
		받아온 결과값을 DB에 저장 및 Variation
		*/
		$query3 = "INSERT INTO sms_info(send_phone, send_status, cmid, send_regdate) values('".$phone."','".$json_data['result_code']."','".$json_data['cmid']."','".date("Y-m-d H:i:s")."')";
		$result3 		= mysqli_query($my_db, $query3);

		$query2 = "UPDATE member_info SET mb_lms='Y' WHERE mb_phone='".$phone."'";
		$result2 		= mysqli_query($my_db, $query2);

		if ($json_data['result_code'] == "200")
			$flag = "Y";
		else
			$flag = "N";

		return $flag;
	}

	function sendRequest($httpMethod, $url, $clientKey, $contentType, $phone, $s_url, $serial) {

		//create basic authentication header
		$headerValue = $clientKey;
		$headers = array("x-waple-authorization:" . $headerValue);

		$params = array(
			'send_time' => '', 
			'send_phone' => '07048883580', 
			'dest_phone' => $phone, 
			//'dest_phone' => '01099017644',
			'send_name' => '', 
			'dest_name' => '', 
			'subject' => '(광고)베비언스 폭풍 성장 이벤트',
			'msg_body' => "
(광고)
'베비언스 먹고' 폭풍성장 이벤트에 참여해주셔서 감사합니다.

아래 쿠폰번호를 베비언스 홈페이지에 입력하고 배송비까지 완전무료 체험팩을 받으세요!
 
▶ 베비언스 홈페이지
http://www.babience-event.com/m/index.jsp

▶ 체험팩 완전무료 쿠폰번호
".$serial."

- 할인쿠폰 > 나의 쿠폰 등록하기 메뉴에서 쿠폰을 등록해주세요
- 액상분유 체험팩은 한 ID당 1개만 제공됩니다

↓↓
우리아기 영상 페이지
".$s_url."

* 이벤트 관련 문의 : 070-4888-3580 / jh.woo@minivertising.kr (평일 10시~18시)
"
		);

		//curl initialization
		$curl = curl_init();

		//create request url
		//$url = $url."?".$parameters;

		curl_setopt ($curl, CURLOPT_URL , $url);
		curl_setopt ($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt ($curl, CURLINFO_HEADER_OUT, true);
		curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);

		$response = curl_exec($curl);

		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$responseHeaders = curl_getinfo($curl, CURLINFO_HEADER_OUT);


		curl_close($curl);

		return $response;
	}

	function sendRequest2($httpMethod, $url, $clientKey, $contentType, $phone, $s_url, $serial) {

		//create basic authentication header
		$headerValue = $clientKey;
		$headers = array("x-waple-authorization:" . $headerValue);

		$params = array(
			'send_time' => '', 
			'send_phone' => '07048883580', 
			'dest_phone' => $phone, 
			//'dest_phone' => '01099017644',
			'send_name' => '', 
			'dest_name' => '', 
			'subject' => '(광고)베비언스 폭풍 성장 이벤트',
			'msg_body' => "
(광고)
'베비언스 먹고' 폭풍성장 이벤트에 참여해주셔서 감사합니다.

아래 링크를 클릭하여, 만드신 아기 영상을 확인해주세요!

↓↓
우리아기 영상 페이지
".$s_url."

참여하신 분들 중 추첨을 통해 베비언스 제품을 선물로 드립니다.

또 참여하시려면?
이벤트 페이지 바로가기
↓↓
http://grow.babience-event.com

* 이벤트 관련 문의 : 070-4888-3580 / jh.woo@minivertising.kr (평일 10시~18시)
"
		);

		//curl initialization
		$curl = curl_init();

		//create request url
		//$url = $url."?".$parameters;

		curl_setopt ($curl, CURLOPT_URL , $url);
		curl_setopt ($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt ($curl, CURLINFO_HEADER_OUT, true);
		curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);

		$response = curl_exec($curl);

		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$responseHeaders = curl_getinfo($curl, CURLINFO_HEADER_OUT);


		curl_close($curl);

		return $response;
	}

	//$GLOBALS['errormsg']	= "";
	function merge_image($img_name, $img_folder, $p_num, $concept)
	{
		$path_mark_file = './files/'.$img_folder.'/medium/'.$img_name;	//원본파일
		$path_src_file ='./files/frame_images/frm_b_bg.jpg';	// 720 x 480 베이스 이미지
		$path_save_file = './files/'.$img_folder.'/medium/merge_'.$img_name; // 합성된 이미지 파일

		  $size_ori = @getimagesize($path_mark_file);
		  if (empty($size_ori[2])) {//이미지 타입이 없다면
			//$GLOBALS['errormsg'] = $path_file . '은 이미지 파일이 아닙니다.';
			return Array();
		  }

		  if ($size_ori[2] != 1 && $size_ori[2] != 2 && $size_ori[2] != 3) {//지원하는 이미지 타입이 아니라면
			//$GLOBALS['errormsg'] = $path_file . '은 gif 나 jpg, png 파일이 아닙니다.';
			return Array();
		  }

		  switch($size_ori[2]){//image type에 따라 이미지 리소스를 생성한다.

			case 1 : //gif

			  $im_ori = @imagecreatefromgif($path_mark_file);
			  imagejpeg($im_ori,'./files/'.$img_folder.'/medium/'.$img_folder.'_'.$p_num.'.jpg'); 
			$path_mark_file = './files/'.$img_folder.'/medium/'.$img_folder.'_'.$p_num.'.jpg';	//원본파일
			$path_save_file = './files/'.$img_folder.'/medium/merge_'.$img_folder.'_'.$p_num.'.jpg'; // 합성된 이미지 파일
			break;

			case 2 : //jpg

			  $im_ori = @imagecreatefromjpeg($path_mark_file);
			  break;

			case 3 : //png

			  $im_ori = @imagecreatefrompng($path_mark_file);
			  imagejpeg($im_ori,'./files/'.$img_folder.'/medium/'.$img_folder.'_'.$p_num.'.jpg'); 
			$path_mark_file = './files/'.$img_folder.'/medium/'.$img_folder.'_'.$p_num.'.jpg';	//원본파일
			$path_save_file = './files/'.$img_folder.'/medium/merge_'.$img_folder.'_'.$p_num.'.jpg'; // 합성된 이미지 파일
			  break;
		  }


$save_w = 720;
$save_h = 480;

$options = Array();//기본옵션

$options['watermark_path_file'] = $path_mark_file;//워터마크 이미지
$options['watermark_pos'] = 1;

if ($concept == "1")
{
	if ($p_num == "1")
		$result = thumnail_test1_1_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
	else if ($p_num == "2" || $p_num == "3" || $p_num == "4")
		$result = thumnail_test1_2_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
	else if ($p_num == "5")
		$result = thumnail_test1_5_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
}else if ($concept == "2"){
	if ($p_num == "1")
		$result = thumnail_test2_1_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
	else if ($p_num == "2" || $p_num == "3" || $p_num == "5")
		$result = thumnail_test2_2_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
	else if ($p_num == "4")
		$result = thumnail_test2_4_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
}else if ($concept == "3"){
	if ($p_num == "3")
		$result = thumnail_test3_3_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
	else if ($p_num == "1" || $p_num == "2" || $p_num == "4")
		$result = thumnail_test3_1_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
	else if ($p_num == "5")
		$result = thumnail_test3_5_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
}else if ($concept == "4"){
	$result = thumnail_test4_1_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
}

flush();
	}

	//$GLOBALS['errormsg']	= "";
	function merge_image2($img_name, $img_folder, $p_num, $concept)
	{
		if ($concept == "1")
		{
			if ($p_num == "1")
			{
				$path_mark_file = './files/frame_images/img_frm_1_1.png';
				$path_save_file = './files/'.$img_folder.'/medium/merge2_'.$img_name; // 합성된 이미지 파일
			}else if ($p_num == "2" || $p_num == "3" || $p_num == "4"){
				$path_mark_file = './files/frame_images/img_frm_1_2.png';
				$path_save_file = './files/'.$img_folder.'/medium/merge2_'.$img_name; // 합성된 이미지 파일
			}else{
				$path_mark_file = './files/frame_images/img_frm_1_5.png';
				$path_save_file = './files/'.$img_folder.'/medium/final_'.$img_name; // 합성된 이미지 파일
			}
		}else if ($concept == "2"){
			if ($p_num == "1")
			{
				$path_mark_file = './files/frame_images/img_frm_2_1.png';
				$path_save_file = './files/'.$img_folder.'/medium/merge2_'.$img_name; // 합성된 이미지 파일
			}else if ($p_num == "2"){
				$path_mark_file = './files/frame_images/img_frm_2_2.png';
				$path_save_file = './files/'.$img_folder.'/medium/merge2_'.$img_name; // 합성된 이미지 파일
			}else if ($p_num == "3"){
				$path_mark_file = './files/frame_images/img_frm_2_3.png';
				$path_save_file = './files/'.$img_folder.'/medium/merge2_'.$img_name; // 합성된 이미지 파일
			}else if ($p_num == "4"){
				$path_mark_file = './files/frame_images/img_frm_2_4.png';
				$path_save_file = './files/'.$img_folder.'/medium/merge2_'.$img_name; // 합성된 이미지 파일
			}else{
				$path_mark_file = './files/frame_images/img_frm_2_5.png';
				$path_save_file = './files/'.$img_folder.'/medium/final_'.$img_name; // 합성된 이미지 파일
			}
		}else if ($concept == "3"){
			if ($p_num == "1")
			{
				$path_mark_file = './files/frame_images/img_frm_3_1.png';
				$path_save_file = './files/'.$img_folder.'/medium/merge2_'.$img_name; // 합성된 이미지 파일
			}else if ($p_num == "2" || $p_num == "4"){
				$path_mark_file = './files/frame_images/img_frm_3_2.png';
				$path_save_file = './files/'.$img_folder.'/medium/merge2_'.$img_name; // 합성된 이미지 파일
			}else if ($p_num == "3"){
				$path_mark_file = './files/frame_images/img_frm_3_3.png';
				$path_save_file = './files/'.$img_folder.'/medium/merge2_'.$img_name; // 합성된 이미지 파일
			}else{
				$path_mark_file = './files/frame_images/img_frm_3_5.png';
				$path_save_file = './files/'.$img_folder.'/medium/final_'.$img_name; // 합성된 이미지 파일
			}
		}else{
			if ($p_num == "1")
			{
				$path_mark_file = './files/frame_images/img_frm_4_1.png';
				$path_save_file = './files/'.$img_folder.'/medium/merge2_'.$img_name; // 합성된 이미지 파일
			}else if ($p_num == "2"){
				$path_mark_file = './files/frame_images/img_frm_4_2.png';
				$path_save_file = './files/'.$img_folder.'/medium/merge2_'.$img_name; // 합성된 이미지 파일
			}else if ($p_num == "3"){
				$path_mark_file = './files/frame_images/img_frm_4_3.png';
				$path_save_file = './files/'.$img_folder.'/medium/merge2_'.$img_name; // 합성된 이미지 파일
			}else if ($p_num == "4"){
				$path_mark_file = './files/frame_images/img_frm_4_4.png';
				$path_save_file = './files/'.$img_folder.'/medium/merge2_'.$img_name; // 합성된 이미지 파일
			}else{
				$path_mark_file = './files/frame_images/img_frm_4_5.png';
				$path_save_file = './files/'.$img_folder.'/medium/final_'.$img_name; // 합성된 이미지 파일
			}
		}
		$path_src_file = './files/'.$img_folder.'/medium/merge_'.$img_name;	//원본파일
		//$path_save_file = './files/'.$img_folder.'/medium/merge2_'.$img_name; // 합성된 이미지 파일

		  $size_ori = @getimagesize($path_mark_file);
		  if (empty($size_ori[2])) {//이미지 타입이 없다면
			//$GLOBALS['errormsg'] = $path_file . '은 이미지 파일이 아닙니다.';
			return Array();
		  }

		  if ($size_ori[2] != 1 && $size_ori[2] != 2 && $size_ori[2] != 3) {//지원하는 이미지 타입이 아니라면
			//$GLOBALS['errormsg'] = $path_file . '은 gif 나 jpg, png 파일이 아닙니다.';
			return Array();
		  }

		  switch($size_ori[2]){//image type에 따라 이미지 리소스를 생성한다.

			case 1 : //gif

			  $im_ori = @imagecreatefromgif($path_mark_file);
			  imagejpeg($im_ori,'./files/'.$img_folder.'/medium/'.$img_folder.'_'.$p_num.'.jpg'); 
			$path_mark_file = './files/'.$img_folder.'/medium/'.$img_folder.'_'.$p_num.'.jpg';	//원본파일
			$path_save_file = './files/'.$img_folder.'/medium/merge_'.$img_folder.'_'.$p_num.'.jpg'; // 합성된 이미지 파일
			break;

			case 2 : //jpg

			  $im_ori = @imagecreatefromjpeg($path_mark_file);
			  break;

			case 3 : //png

			  $im_ori = @imagecreatefrompng($path_mark_file);
			//  imagejpeg($im_ori,'./files/'.$img_folder.'/medium/'.$img_folder.'_'.$p_num.'.jpg'); 
			//$path_mark_file = './files/'.$img_folder.'/medium/'.$img_folder.'_'.$p_num.'.jpg';	//원본파일
			//$path_save_file = './files/'.$img_folder.'/medium/merge_'.$img_folder.'_'.$p_num.'.jpg'; // 합성된 이미지 파일
			  break;
		  }


$save_w = 720;
$save_h = 480;

$options = Array();//기본옵션

$options['watermark_path_file'] = $path_mark_file;//워터마크 이미지
$options['watermark_pos'] = 1;

//$path_save_file = 'sample_image/test_mark_top_left_' . $save_w . 'X' . $save_h . '.jpg';

if ($concept == "1")
{
	if ($p_num == "1")
		$result = thumnail_test1_1_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
	else if ($p_num == "2" || $p_num == "3" || $p_num == "4")
		$result = thumnail_test1_2_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
	else if ($p_num == "5")
		$result = thumnail_test1_5_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
}else if ($concept == "2"){
	if ($p_num == "1")
		$result = thumnail_test2_1_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
	else if ($p_num == "2" || $p_num == "3" || $p_num == "5")
		$result = thumnail_test2_2_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
	else if ($p_num == "4")
		$result = thumnail_test2_4_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
}else if ($concept == "3"){
	if ($p_num == "3")
		$result = thumnail_test3_3_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
	else if ($p_num == "1" || $p_num == "2" || $p_num == "4")
		$result = thumnail_test3_1_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
	else if ($p_num == "5")
		$result = thumnail_test3_5_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
}else if ($concept == "4"){
	$result = thumnail_test4_1_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h, $options);
}


//if (empty($result)) die($GLOBALS['errormsg'] . "<br />\n");

//echo "
//너비 $save_w, 높이$save_h 크롭 리사이즈, 상단 왼쪽 워터마크 <br />
//<img src='$path_save_file'> <br /><br />
//";
flush();
	}


/*
이름 : get_image_resource_from_file

용도 : 이미지파일(gif, jpg, png 만 지원)로부터 이미지 리소스를 생성한다

성공시 리턴값 : 이미지 리소스 id 와 getimagesize 로 받아온 이미지 정보를 배열로 반환
==> Array(0=>image resource, 1=>image width, 2=>image height, 3=>image type, 4=>image attribute);

실패시 리턴값 : 빈 배열 반환
==> Array()

인자 :
==> $path_file : 이미지의 절대경로 또는 상대경로
*/

function get_image_resource_from_file ($path_file){

  if (!is_file($path_file)) {//파일이 아니라면

    //$GLOBALS['errormsg'] = $path_file . '은 파일이 아닙니다.';

    return Array();
  }

  $size = @getimagesize($path_file);
  if (empty($size[2])) {//이미지 타입이 없다면

    //$GLOBALS['errormsg'] = $path_file . '은 이미지 파일이 아닙니다.';

    return Array();
  }

  if ($size[2] != 1 && $size[2] != 2 && $size[2] != 3) {//지원하는 이미지 타입이 아니라면

    //$GLOBALS['errormsg'] = $path_file . '은 gif 나 jpg, png 파일이 아닙니다.';

    return Array();
  }

  switch($size[2]){//image type에 따라 이미지 리소스를 생성한다.

    case 1 : //gif

      $im = @imagecreatefromgif($path_file);
      break;

    case 2 : //jpg

      $im = @imagecreatefromjpeg($path_file);
      break;

    case 3 : //png

      $im = @imagecreatefrompng($path_file);
      break;
  }

  if ($im === false) {//이미지 리소스를 가져오기에 실패하였다면
   // $GLOBALS['errormsg'] = $path_file . ' 에서 이미지 리소스를 가져오는 것에 실패하였습니다.';
    return Array();
  }
  else {//이미지 리소스를 가져오기에 성공하였다면

    $return = $size;
    $return[0] = $im;
    $return[1] = $size[0];//너비
    $return[2] = $size[1];//높이
    $return[3] = $size[2];//이미지타입
    $return[4] = $size[3];//이미지 attribute

    return $return;
  }
}



/*
이름 : save_image_from_resource

용도 : image resouce 를 가지고 파일로 저장

성공시 리턴값 : true

실패시 리턴값 : false

인자 :
==> $im : 이미지 리소스 id
==> $path_save_file : 저장될 파일의 절대 경로 또는 상대경로
==> $quality : 저장되는 파일의 질을 결정
              ==> 100 이하의 정수로 지정, 높을수록 질이 높음
              ==> 생략하면 자동으로 기본값은 70
==> $save_force : 동일 경로에 이미 파일이 존재할때
                     ==> 0 이면 저장하지 않고 false 반환
                     ==> 1 이면 저장하지 않고 true 반환
                     ==> 2 이면 기존 것은 지우고 새로 저장
                     ==> 생략하면 자동으로 기본값은 0

참고 :
==> gif 이미지는 $quality 의 영향을 받지 않음
*/

function save_image_from_resource ($im, $path_save_file, $quality=70, $save_force=0){

  $path_save_dir = dirname($path_save_file);//저장 파일 경로에서 상위 디렉토리 경로를 가져옴
  if (!is_dir($path_save_dir)) {//상위디렉토리가 디렉토리가 아니라면
    //$GLOBALS['errormsg'] = $path_save_dir . '은 디렉토리가 아닙니다.';
    return false;
  }

  if (!is_writable($path_save_dir)){//해당 디렉토리에 파일을 저장할 권한이 없다면
    //$GLOBALS['errormsg'] = $path_save_dir . '에 이미지를 저장할 권한이 없습니다.';
    return false;
  }

  if (is_dir($path_save_file)) {//같은 이름의 디렉토리가 존재하면
    //$GLOBALS['errormsg'] = $path_save_file . '은 이미 같은 이름의 디렉토리가 존재합니다.';
    return false;
  }

  if (is_file($path_save_file)){//같은 이름의 파일이 존재하면

    if ($save_force == 1) {//새로 저장하지 않고 true 반환

      return true;
    }
    else if ($save_force == 2){//기존 파일은 삭제

      $result_unlink = @unlink($path_save_file);
      if ($result_unlink === false) {//기존 이미지 삭제에 실패
        //$GLOBALS['errormsg'] = '기존에 존재하던 ' . $path_save_file . '의 삭제에 실패하였습니다.';
        return false;
      }
    }
    else {//0 이거나 정해지지 않은 값일때 false를 반환
      //$GLOBALS['errormsg'] = $path_save_file . '은 이미 같은 이름의 파일이 존재합니다.';
      return false;
    }
  }

  //파일명에서 마지막 . 을 기준으로 확장자를 가져와서 소문자로 변환
  $extension = strtolower(substr($path_save_file, strrpos($path_save_file, '.') + 1));

  switch($extension){//확장자에 따라 이미지 저장 처리

    case 'gif' :

      $result_save = @imagegif($im, $path_save_file);
      break;

    case 'jpg' :

    case 'jpeg' :

      $result_save = @imagejpeg($im, $path_save_file, $quality);
      break;

    default : //확장자 png 또는 확장자가 없는 경우, 정의되지 않는 확장자인 경우는 모두 png로 저장

      $result_save = @imagepng($im, $path_save_file, $quality);
  }

  if ($result_save === false) {//이미지 저장에 실패
    //$GLOBALS['errormsg'] = $path_save_file . '의 저장에 실패하였습니다.';
    return false;
  }
  else {//이미지 저장에 성공

    return true;
  }
}



/*
이름 : get_size_by_rule

용도 : 큰이미지의 너비와 높이를 가지고 정비율의 작은 이미지 너비 나 높이를 구함

성공시 리턴값 : 0보다 큰 정수값

실패시 리턴값 : false

인자 :
==> $src_w : 큰이미지의 너비, 0보다 큰 정수만 가능
==> $src_h : 큰이미지의 높이, 0보다 큰 정수만 가능
==> $dst_size : 작은 이미지의 정해진 너비 나 높이, 너비 일 경우 높이 반환, 높이 일 경우 너비 반환
==> $rule : $dst_size 의 값이 너비 인지 높이인지 지정
          ==> 값으로는 width, height 가 올수 있다.
          ==> 생략하거나 height 가 아니면 모두 width로 인식
*/

function get_size_by_rule($src_w, $src_h, $dst_size, $rule='width'){

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($dst_size)) settype($dst_size, 'int');

  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우

    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";

    return false;
  }

  if ($dst_size < 1){//리사이즈 될 사이즈가 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "리사이즈될 사이즈가 0보다 큰 정수가 아닙니다. ($dst_size)";
    return false;
  }

  if ($rule != 'height') {//기준값이 너비일 경우, 값이 height 가 아니면 전부 width 로 판단
    return ceil($dst_size / $src_w * $src_h);
  }
  else {//기준값이 높이일 경우
    return ceil($dst_size / $src_h * $src_w);
  }
}



/*
이름 : get_bigsize_by_rule

용도 : 작은 이미지의 너비와 높이를 가지고 정비율의 큰 이미지 너비 나 높이를 구함

성공시 리턴값 : 0보다 큰 정수값

실패시 리턴값 : false

인자 :
==> $dst_w : 작은이미지의 너비, 0보다 큰 정수만 가능
==> $dst_h : 작은이미지의 높이, 0보다 큰 정수만 가능
==> $src_size : 큰 이미지의 정해진 너비 나 높이, 너비 일 경우 높이 반환, 높이 일 경우 너비 반환
==> $rule : $src_size 의 값이 너비 인지 높이인지 지정
          ==> 값으로는 width, height 가 올수 있다.
          ==> 생략하거나 height 가 아니면 모두 width로 인식
*/

function get_bigsize_by_rule($dst_w, $dst_h, $src_size, $rule='width'){

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($dst_w)) settype($dst_w, 'int');
  if (!is_int($dst_h)) settype($dst_h, 'int');
  if (!is_int($src_size)) settype($src_size, 'int');

  if ($dst_w < 1 || $dst_h < 1){//썸네일의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "썸네일의 너비와 높이가 0보다 큰 정수가 아닙니다. ($dst_w, $dst_h)";
    return false;
  }

  if ($src_size < 1){//원본의 사이즈가 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 사이즈가 0보다 큰 정수가 아닙니다. ($src_size)";
    return false;
  }

  if ($rule != 'height') {//기준값이 너비일 경우, 값이 height 가 아니면 전부 width 로 판단
    return ceil($src_size / $dst_w * $dst_h);
  }
  else {//기준값이 높이일 경우

    return ceil($src_size / $dst_h * $dst_w);
  }
}



/*
이름 : get_image_resize

용도 : 원본의 리소스를 가지고 주어진 조건으로 리사이즈 처리한 이미지 리소스를 생성

성공시 리턴값 : 썸네일 리소스 id

실패시 리턴값 : false

인자 :
==> $src : 원본의 리소스 id
==> $src_w : 원본의 너비
==> $src_h : 원본의 높이
==> $dst_w : 생성할 썸네일의 너비, 0 이상의 정수
==> $dst_h : 생성할 썸네일의 높이, 0 이상의 정수
             ==> 생략 가능하며 생략시에는 자동으로 0으로 값이 들어감

참고 :
==> $dst_w 와 $dst_h 모두 값이 0이 될수 없음
==> 둘다 0보다 클 경우, 강제 리사이즈하여 썸네일 리소스 생성
==> 둘중 하나가 0 이면, 0이 아닌 쪽을 기준으로 정비율로 리사이즈 하여 썸네일 생성
*/

function get_image_resize($src, $src_w, $src_h, $dst_w, $dst_h=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($dst_w)) settype($dst_w, 'int');
  if (!is_int($dst_h)) settype($dst_h, 'int');

  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }

  if (empty($dst_w) && empty($dst_h)) {//썸네일의 너비와 높이 둘다 없을 경우
    //$GLOBALS['errormsg'] = '썸네일의 너비와 높이는 둘중에 하나는 반듯이 있어야 합니다.';
    return false;
  }

  if (!empty($dst_w) && $dst_w < 1){//썸네일의 너비가 존재하는데 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "썸네일의 너비가 0보다 큰 정수가 아닙니다. ($dst_w)";
    return false;
  }

  if (!empty($dst_h) && $dst_h < 1){//썸네일의 높이가 존재하는데 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "썸네일의 높이가 0보다 큰 정수가 아닙니다. ($dst_h)";
    return false;
  }


  //썸네일의 너비와 높이가 둘중에 하나가 없는 경우에는 정비율을 의미하며, 비율데로 너비와 높이를 결정한다.
  if (empty($dst_w) || empty($dst_h)) {

    if (empty($dst_h)) $dst_h = get_size_by_rule($src_w, $src_h, $dst_w, 'width');
    else $dst_w = get_size_by_rule($src_w, $src_h, $dst_h, 'height');
  }


  //$dst_w , $dst_h 크기의 썸네일 리소스를 생성한다.
  $dst = @imagecreatetruecolor ($dst_w , $dst_h);
  if ($dst === false) {
    //$GLOBALS['errormsg'] = "$dst_w , $dst_h 크기의 썸네일 리소스를 생성하지 못했습니다.";
    return false;
  }


  //리사이즈 처리
  $result_resize = imagecopyresampled ($dst , $src , 0 , 0 , 0 , 0 , $dst_w , $dst_h , $src_w , $src_h );
  if ($result_resize === false) {
    //$GLOBALS['errormsg'] = "$dst_w , $dst_h 크기로 리사이즈에 실패하였습니다.";
    return false;
  }

  return $dst;
}



/*
이름 : get_image_cropresize

용도 : 원본의 리소스를 가지고 주어진 조건으로 크롭 후 리사이즈 처리한 이미지 리소스를 생성

성공시 리턴값 : 썸네일 리소스 id

실패시 리턴값 : false

인자 :
==> $src : 원본의 리소스 id
==> $src_w : 원본의 너비
==> $src_h : 원본의 높이
==> $dst_w : 생성할 썸네일의 너비, 0 이상의 정수
==> $dst_h : 생성할 썸네일의 높이, 0 이상의 정수
             ==> 생략 가능하며 생략시에는 자동으로 0으로 값이 들어감
==> $pos_width : 너비를 기준으로 크롭할때 어느부분을 크롭할지 지정
                   ==> 1 일경우에는 왼쪽을 기준으로 크롭
                   ==> 2 일경우에는 중앙을 기준으로 크롭
                   ==> 3 일경우에는 오른쪽을 기준으로 크롭
                   ==> 생략가능하며 생략시에는 자동으로 2 로 값이 들어감
==> $pos_height : 높이를 기준으로 크롭할때 어느부분을 크롭할지 지정
                   ==> 1 일경우에는 상단을 기준으로 크롭
                   ==> 2 일경우에는 가운데를 기준으로 크롭
                   ==> 3 일경우에는 하단을 기준으로 크롭
                   ==> 생략가능하며 생략시에는 자동으로 2 로 값이 들어감

참고 :
==> $dst_w 와 $dst_h 모두 값이 0이 될수 없음
==> 둘다 0보다 클 경우, 강제 리사이즈하여 썸네일 리소스 생성
==> 둘중 하나가 0 이면, 0이 아닌 쪽을 기준으로 정비율로 리사이즈 하여 썸네일 생성
*/

function get_image_cropresize($src, $src_w, $src_h, $dst_w, $dst_h=0, $pos_width=2, $pos_height=2){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($dst_w)) settype($dst_w, 'int');
  if (!is_int($dst_h)) settype($dst_h, 'int');

  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }

  if (empty($dst_w) && empty($dst_h)) {//썸네일의 너비와 높이 둘다 없을 경우
    //$GLOBALS['errormsg'] = '썸네일의 너비와 높이는 둘중에 하나는 반듯이 있어야 합니다.';
    return false;
  }

  if (!empty($dst_w) && $dst_w < 1){//썸네일의 너비가 존재하는데 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "썸네일의 너비가 0보다 큰 정수가 아닙니다. ($dst_w)";
    return false;
  }

  if (!empty($dst_h) && $dst_h < 1){//썸네일의 높이가 존재하는데 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "썸네일의 높이가 0보다 큰 정수가 아닙니다. ($dst_h)";
    return false;
  }


  //썸네일의 너비와 높이가 둘중에 하나가 없는 경우에는 정비율을 의미하며, 비율데로 너비와 높이를 결정한다.
  if (empty($dst_w) || empty($dst_h)) {

    if (empty($dst_h)) $dst_h = get_size_by_rule($src_w, $src_h, $dst_w, 'width');
    else $dst_w = get_size_by_rule($src_w, $src_h, $dst_h, 'height');
  }


  //$dst_w , $dst_h 크기의 썸네일 리소스를 생성한다.
  $dst = @imagecreatetruecolor ($dst_w , $dst_h);
  if ($dst === false) {
    //$GLOBALS['errormsg'] = "$dst_w , $dst_h 크기의 썸네일 리소스를 생성하지 못했습니다.";
    return false;
  }


  //썸네일의 너비를 기준으로 정비율의 썸네일의 높이를 구한다.
  $s_w = $dst_w;
  $s_h = get_size_by_rule($src_w, $src_h, $s_w, 'width');


  //기본값
  $src_x = 0;
  $src_y = 0;
  $src_nw = $src_w;
  $src_nh = $src_h;


  if ($dst_h != $s_h) {//높이가 다름, 즉, 크롭을 해야 한다는 뜻

    if ($dst_h < $s_h) {//지정된 높이가 정비율 높이 보다 작을경우, 높이를 기준으로 $pos_height 로 크롭

      //썸네일의 너비와 높이를 가지고 정비율의 큰이미지의 높이를 구한다.
      $src_nh = get_bigsize_by_rule($dst_w, $dst_h, $src_w, 'width');

      $src_x = 0;

      if ($pos_height == 1) $src_y = 0;//상단 기준점 y좌표 구함
      else if ($pos_height == 2) $src_y = ceil(($src_h - $src_nh) / 2);//가운데 기준점 y좌표 구함
      else $src_y = $src_h - $src_nh;//하단 기준점 y좌표 구함
    }
    else {//지정된 높이가 정비율 높이 보다 큰경우, 너비를 기준으로 $pos_width 크롭

      ////썸네일의 너비와 높이를 가지고 정비율의 원본 너비를 구한다.
      $src_nw = get_bigsize_by_rule($dst_w, $dst_h, $src_h, 'height');

      if ($pos_width == 1) $src_x = 0;//왼쪽 기준점 y좌표 구함
      else if ($pos_width == 2) $src_x = ceil(($src_w - $src_nw) / 2);//중앙 기준점 y좌표 구함
      else $src_x = $src_w - $src_nw;//오른쪽 기준점 y좌표 구함

      $src_y = 0;
    }
  }

  $result_resize = imagecopyresampled ($dst , $src , 0 , 0 , $src_x , $src_y , $dst_w , $dst_h , $src_nw , $src_nh );
  if ($result_resize === false) {
    //$GLOBALS['errormsg'] = "$dst_w , $dst_h 크기로 크롭 및 리사이즈에 실패하였습니다.";
    return false;
  }

  return $dst;
}



/*
이름 : proc_watermark

용도 : 원본의 리소스를 가지고 워터마크 이미지를 주어진 조건에 따라 찍는다.

성공시 리턴값 : true

실패시 리턴값 : false

인자 :
==> $src : 원본의 리소스 id
==> $src_w : 원본의 너비
==> $src_h : 원본의 높이
==> $path_mark_file : 워터마크로 사용될 이미지파일의 전체경로 또는 상대경로
==> $pos : 워터마크를 찍을 포지션을 숫자로 지정
          ==> 1 일경우에는 상단 왼쪽에 한번만
          ==> 2 일경우에는 상단 오른쪽에 한번만
          ==> 3 일경우에는 하단 왼쪽에 한번만
          ==> 4 일경우에는 하단 오른쪽에 한번만
          ==> 5 일 경우에는 중앙에 한번만
          ==> 10 일 경우에는 전체를 반복해서
          ==> 그 외의 값은 4로 처리
==> $sharpness : 워터마크의 선명도, 0부터 100 까지의 정수만 가능
                    ==> 100 일 경우에는 투명이미지를 사용하는것으로 간주, 투명이미지로 워터마크 처리
==> $padding : 워터마크 사이의 간격, 생략가능하며 생략시 자동으로 0 로 값이 들어감
*/

function proc_watermark($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}

function proc_watermark1_1_1($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 + 7);

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 + 7);

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 + 7);

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 + 7);

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 + 7);

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 + 7);

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}

function proc_watermark1_1_2($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}

function proc_watermark1_2_1($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 + 7);

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 + 7);

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 + 7);

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 + 7);

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 + 7);

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 + 7);

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}

function proc_watermark1_2_2($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}

function proc_watermark1_5_1($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 - 8);

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 - 8);

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 - 8);

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 - 8);

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 - 8);

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2 - 8);

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}

function proc_watermark1_5_2($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}

function proc_watermark2_1_1($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2 -156);
        $src_y = ceil(($src_h - $mark_h) / 2 - 44);

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2 -156);
        $src_y = ceil(($src_h - $mark_h) / 2 - 44);

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2 -156);
        $src_y = ceil(($src_h - $mark_h) / 2 - 44);

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2 -156);
        $src_y = ceil(($src_h - $mark_h) / 2 - 44);

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2 -156);
        $src_y = ceil(($src_h - $mark_h) / 2 - 44);

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2 -156);
        $src_y = ceil(($src_h - $mark_h) / 2 - 44);

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}

function proc_watermark2_4_1($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2 -169);
        $src_y = ceil(($src_h - $mark_h) / 2) - 8;

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2 -169);
        $src_y = ceil(($src_h - $mark_h) / 2) - 8;

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2 -169);
        $src_y = ceil(($src_h - $mark_h) / 2) - 8;

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2 -169);
        $src_y = ceil(($src_h - $mark_h) / 2) - 8;

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2 -169);
        $src_y = ceil(($src_h - $mark_h) / 2) - 8;

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2 -169);
        $src_y = ceil(($src_h - $mark_h) / 2) - 8;

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}

function proc_watermark2_4_2($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}

function proc_watermark2_2_1($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}

function proc_watermark3_3_1($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2+148);
        $src_y = ceil(($src_h - $mark_h) / 2-38);

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2+148);
        $src_y = ceil(($src_h - $mark_h) / 2-38);

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2+148);
        $src_y = ceil(($src_h - $mark_h) / 2-38);

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2+148);
        $src_y = ceil(($src_h - $mark_h) / 2-38);

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2+148);
        $src_y = ceil(($src_h - $mark_h) / 2-38);

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2+148);
        $src_y = ceil(($src_h - $mark_h) / 2-38);

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}

function proc_watermark3_5_1($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2+135);
        $src_y = ceil(($src_h - $mark_h) / 2-61);

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2+135);
        $src_y = ceil(($src_h - $mark_h) / 2-61);

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2+135);
        $src_y = ceil(($src_h - $mark_h) / 2-61);

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2+135);
        $src_y = ceil(($src_h - $mark_h) / 2-61);

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2+135);
        $src_y = ceil(($src_h - $mark_h) / 2-61);

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2+135);
        $src_y = ceil(($src_h - $mark_h) / 2-61);

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}

function proc_watermark2_2_2($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}

function proc_watermark3_3_2($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}

function proc_watermark3_5_2($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}

function proc_watermark2_1_2($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우
    //$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우
    //$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }



  if (empty($path_mark_file)) {//워터마크 이미지 경로값이 없다면
    //$GLOBALS['errormsg'] = '워터마크 이미지경로값이 없습니다.';
    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//에러 메시지 작성은 get_image_resource_from_file 내부에서 함



  if ($src_w < $mark_w + (2 * $padding)) {//원본너비가 워터마크 이미지 너비보다 작으면 워터마크 처리 안함, return true;
   return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//원본높이가 워터마크 이미지 높이보다 작으면 워터마크 처리 안함, return true;
    return true;
  }



  if ($sharpness < 0 || $sharpness > 100) $sharpness = 100;//$sharpness 가 지정된 범위 이상의 숫자라면 100으로 강제 재설정

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding이 0보다 작거나 워터마크의 너비나 높이보다 크면 0으로 강제 재설정



  if ($pos == 10) {//워터마크 전체로 찍을 경우의 처리

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x 축으로 워터마크를 몇번 찍을 것인지 계산, 패딩을 더해서 나눔
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y 축으로 워터마크를 몇번 찍을 것인지 계산
    $y_max = ceil($h_max / ($mark_h + $padding));

    //루프를 돌리면서 워터마크를 찍음
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //기준점을 구한다.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {
          @imagedestroy($mark);
          //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
          return false;
        }
      }
    }
  }
  else {//워터마크를 하나만 찍을 경우에의 처리

    //워터마크의 복사할 너비, 높이 기본값 지정
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //상단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 2 : //상단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 3 : //하단 왼쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 4 : //하단 오른쪽

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      case 5 : //중앙

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      default : // 그 밖의 값은 전부 상단 왼쪽 치부

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

    }

    if ($sharpness != 100) {//선명도가 100 이 아닐경우에는 선명도를 사용할수 있는 imagecopymerge 사용

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//선명도가 100 일 경우에는 투명이미지를 사용할수 있는 imagecopyresampled 사용
      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {
      //$GLOBALS['errormsg'] = "워터마크 처리에 실패하였습니다.";
      return false;
    }
  }
  return true;
}




/*
이름 : thumnail_test1

용도 : 원본을 조건에 따라 리사이즈, 크롭, 워터마크를 처리하여 파일로 저장함

성공시 리턴값 : true

실패시 리턴값 : false

인자 :
==> $path_src_file : 원본파일의 절대경로 또는 상대경로
==> $path_save_file : 썸네일을 저장할 절대경로 또는 상대경로
==> $save_w : 만들 썸네일의 너비
==> $save_h : 만들 썸네일의 높이, 생략 가능하며 생략시 기본값은 0
==> $options : 함수 내부에 정의된 변수들의 값을 변경할때 사용, 배열형태, 생략가능하며 생략시 기본값은 빈배열(Array())
                ==> $options['save_quality'] : 파일로 저장시 저장될 파일의 품질, 100 이하의 양의 정수만 사용, gif는 의미 없음
                ==> $options['save_force'] : 이미 동일한 경로에 동일이름의 파일이 존재할때의 처리 결정
                                                            0 이면 false 반환, 1 이면 더이상 실행안하고 true 반환, 2 이면 기존거는 지우고 새로 저장
                ==> $options['crop_use'] : 크롭 사용 여부, 0 은 사용안함, 1은 사용함
                ==> $options['crop_pos_width'] : 너비 기준으로 크롭할때 기준부위 결정, 1은 왼쪽, 2는 가운데, 3은 오른쪽
                ==> $options['crop_pos_height'] : 높이 기준으로 크롭할때 기준부위 결정, 1은 상단, 2는 중단, 3은 하단
                ==> $options['watermark_path_file'] : 워터마크 이미지 파일의 절대경로 또는 상대경로
                ==> $options['watermark_pos'] : 워터마크 찍는 위치 결정, 1 은 상단 왼쪽, 2는 상단 오른쪽, 3은 하단 왼쪽, 4는 하단 오른쪽, 5는 중앙, 10 은 전체에 반복
                ==> $options['watermark_sharpness'] : 워터마크의 선명도, 100 이하의 양의 정수만 사용
                                                                     ==> 100 일경우에는 투명이미지 사용가능
                ==> $options['watermark_padding'] : 워터마크의 여백, 0이상의 양의 정수, 패딩의 크기는 워터마크이미지의 너비나 높이보다 클수 없음
*/

function thumnail_test1_1_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark1_1_1($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test1_1_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark1_1_2($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test1_2_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark1_2_1($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test1_2_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark1_2_2($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test1_5_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark1_5_1($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test1_5_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark1_5_2($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test2_1_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark2_1_1($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test2_2_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark2_2_1($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test3_1_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark2_2_1($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test4_1_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark2_2_1($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test3_3_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark3_3_1($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test3_5_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark3_5_1($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test2_2_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark2_2_2($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test3_1_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark2_2_2($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test4_1_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark2_2_2($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test3_3_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark3_3_2($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test3_5_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark3_5_2($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test2_1_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark2_1_2($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test2_4_1($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark2_4_1($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

function thumnail_test2_4_2($path_src_file, $path_save_file, $path_mark_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = $path_mark_file;//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 5;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 100;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 0;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark2_4_2($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}



// --------------------- 텍스트 삽입 --------------------- //
function caption_image($caption, $serial, $num, $txt_X, $txt_Y)
{
	# 사용예제
	$objFont = new Font;

	$objFont->text  = $caption;
	$objFont->size  = 20;
	$objFont->color = 0x000000;
	//$objFont->angle = 45;
	//$objFont->font  = "/home/vdl_gate/nanumBold.ttf";
	$objFont->font  = "./nanumBold.ttf";

	//$szFilePath     = "/home/vdl_gate/m/images/baby_1.jpg";
	//$szFilePath     = "./images/baby1.jpg";
	$szFilePath     = "./files/".$serial."/medium/merge2_".$serial."_".$num.".jpg";

	$cImage = getPrintToImage($txt_X, $txt_Y, $serial, $num, $szFilePath, $objFont, $serial, LEFT | MIDDLE);
}

function caption_image_white($caption, $serial, $num, $txt_X, $txt_Y)
{
	# 사용예제
	$objFont = new Font;

	$objFont->text  = $caption;
	$objFont->size  = 20;
	$objFont->color = 0xFFFFFF;
	//$objFont->angle = 45;
	//$objFont->font  = "/home/vdl_gate/nanumBold.ttf";
	$objFont->font  = "./nanumBold.ttf";

	//$szFilePath     = "/home/vdl_gate/m/images/baby_1.jpg";
	//$szFilePath     = "./images/baby1.jpg";
	$szFilePath     = "./files/".$serial."/medium/merge2_".$serial."_".$num.".jpg";

	$cImage = getPrintToImage($txt_X, $txt_Y, $serial, $num, $szFilePath, $objFont, $serial, LEFT | MIDDLE);
}

function caption_image_yellow($caption, $serial, $num, $txt_X, $txt_Y)
{
	# 사용예제
	$objFont = new Font;

	$objFont->text  = $caption;
	$objFont->size  = 20;
	$objFont->color = 0xFFF200;
	//$objFont->angle = 45;
	//$objFont->font  = "/home/vdl_gate/nanumBold.ttf";
	$objFont->font  = "./nanumBold.ttf";

	//$szFilePath     = "/home/vdl_gate/m/images/baby_1.jpg";
	//$szFilePath     = "./images/baby1.jpg";
	$szFilePath     = "./files/".$serial."/medium/merge2_".$serial."_".$num.".jpg";

	$cImage = getPrintToImage($txt_X, $txt_Y, $serial, $num, $szFilePath, $objFont, $serial, LEFT | MIDDLE);
}

function caption_image2($caption, $serial, $num, $txt_X, $txt_Y)
{
	# 사용예제
	$objFont = new Font;

	$objFont->text  = $caption;
	$objFont->size  = 20;
	$objFont->color = 0x000000;
	//$objFont->angle = 45;
	//$objFont->font  = "/home/vdl_gate/nanumBold.ttf";
	$objFont->font  = "./nanumBold.ttf";

	//$szFilePath     = "/home/vdl_gate/m/images/baby_1.jpg";
	//$szFilePath     = "./images/baby1.jpg";
	$szFilePath     = "./files/".$serial."/medium/final_".$serial."_".$num.".jpg";

	$cImage = getPrintToImage($txt_X, $txt_Y, $serial, $num, $szFilePath, $objFont, $serial, LEFT | MIDDLE);
}

function caption_image2_white($caption, $serial, $num, $txt_X, $txt_Y)
{
	# 사용예제
	$objFont = new Font;

	$objFont->text  = $caption;
	$objFont->size  = 20;
	$objFont->color = 0xFFFFFF;
	//$objFont->angle = 45;
	//$objFont->font  = "/home/vdl_gate/nanumBold.ttf";
	$objFont->font  = "./nanumBold.ttf";

	//$szFilePath     = "/home/vdl_gate/m/images/baby_1.jpg";
	//$szFilePath     = "./images/baby1.jpg";
	$szFilePath     = "./files/".$serial."/medium/final_".$serial."_".$num.".jpg";

	$cImage = getPrintToImage($txt_X, $txt_Y, $serial, $num, $szFilePath, $objFont, $serial, LEFT | MIDDLE);
}


define('LEFT',   0x01);
define('CENTER', 0x02);
define('RIGHT',  0x04);
define('TOP',    0x08);
define('MIDDLE', 0x10);
define('BOTTOM', 0x20);

class Font
{
    var $text   = "http://aaa.com";
    var $color  = 0x000000;
    var $size   = 10;
    var $angle  = 0;
    var $font;
}

function getPrintToImage($txt_X, $txt_Y, $serial, $num, $szFilePath, &$objFont, $serial, $nFontAlign = 0x12)
{
    # 이미지 파일이 존재하는지 체크한다.
    if (!file_exists($szFilePath))
    {
        return FALSE;
    }

    # 이미지 파일 정보를 구한다.(크기및 타입)
    $arrImgInfo = GetImageSize($szFilePath);

    # 해당 이미지 포멧이 지원되는지 체크한다. 
    switch ($arrImgInfo[2])
    {
    case 1:
        # GIF
        if (!(ImageTypes() & IMG_GIF))
        {
            return FALSE;
        }

        $szContentType = "image/gif";

        break;
    case 2:
        # JPG
        if (!(ImageTypes() & IMG_JPG))
        {
            return FALSE;
        }

        $szContentType = "image/jpeg";

        break;
    case 3:
        # PNG
        if (!(ImageTypes() & IMG_PNG))
        {
            return FALSE;
        }

        $szContentType = "image/png";

        break;
    default:
        return FALSE;
    }

    //header ("Content-type: ".$szContentType);
    # 이미지 파일을 읽어 이미지를 생성한다.
    $fp = fopen($szFilePath, "rb");
    $szContent = fread($fp, filesize($szFilePath));
    fclose($fp);

    $nImage = ImageCreateFromString($szContent);

	# 프린트할 글의 색상을 준비한다.
    $nBlue  = $objFont->color & 0xFF;
    $nGreen = $objFont->color >> 0x08 & 0xFF;
    $nRed   = $objFont->color >> 0x10 & 0xFF;

    $nFontColor  = ImageColorAllocate($nImage, $nRed, $nGreen, $nBlue);

    # 프린트할 글의 위치를 결정한다.
    $arrTTFBBox  = ImageTTFBBox($objFont->size, $objFont->angle, $objFont->font, $objFont->text);

    $nMax = max($arrTTFBBox[0], $arrTTFBBox[2], $arrTTFBBox[4], $arrTTFBBox[6]);
    $nMin = min($arrTTFBBox[0], $arrTTFBBox[2], $arrTTFBBox[4], $arrTTFBBox[6]);

    if ($nFontAlign & LEFT)
    {
        $nX = $arrTTFBBox[0] - $nMin;
    }
    else if ($nFontAlign & CENTER)
    {
        $nX = ($arrImgInfo[0] - ($nMax + $nMin)) / 2 + $arrTTFBBox[0];
    }
    else
    {
        $nX = $arrImgInfo[0] - $nMax + $arrTTFBBox[0];
    }

    $nMax = max($arrTTFBBox[1], $arrTTFBBox[3], $arrTTFBBox[5], $arrTTFBBox[7]);
    $nMin = min($arrTTFBBox[1], $arrTTFBBox[3], $arrTTFBBox[5], $arrTTFBBox[7]);

    if ($nFontAlign & TOP)
    {
        $nY = $arrTTFBBox[1] - $nMin;
    }
    else if ($nFontAlign & MIDDLE)
    {
        $nY = ($arrImgInfo[1] - ($nMax + $nMin)) / 2 + $arrTTFBBox[1];
    }
    else
    {
        $nY = $arrImgInfo[1] - $nMax + $arrTTFBBox[1];
    }
	$nX = $txt_X;
	$nY = $txt_Y;
    ImageTTFText($nImage, $objFont->size, $objFont->angle, $nX, $nY, $nFontColor, $objFont->font, $objFont->text);

	$mydir = "certi_images/".date("d"); 
	 if(@mkdir($mydir, 0777)) { 
		if(is_dir($mydir)) { 
			@chmod($mydir, 0777); 
		} 
	 }

    switch ($arrImgInfo[2])
    {
		case 1:
			# GIF
			ImageGIF($nImage,'simpletext.gif');
			break;
		case 2:
			# JPG
			ImageJPEG($nImage,'./files/'.$serial.'/medium/final_'.$serial.'_'.$num.'.jpg',100);
			break;
		case 3:
			# PNG
			ImagePNG($nImage,'baby_merge1.jpg');
			break;
		default:
			return FALSE;
    }
	imagedestroy($nImage);
	//echo "complete";
    return TRUE;
}

?>