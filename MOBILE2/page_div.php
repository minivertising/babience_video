<!------------------ 개인정보 입력 페이지 ------------------>
<div id="input_div" class="popup_wrap" style="display:none">
  <div class="p_mid p_position">
    <div class="block_close clearfix">
      <a href="index.php" class="btn_close"><img src="images/popup/btn_close.png" /></a>
    </div>
    <div class="block_content input">
      <div class="title_pop_main">
        <img src="images/popup/title_pop_main.png" />
      </div>
      <div class="inner">
        <div class="input_block">
          <div class="title img">
            <img src="images/popup/title_input_1.png" />
          </div>
          <div class="inner_input_block">
            <div class="input_one">
              <div class="inner_input_one clearfix">
                <div class="input"><input type="text" name="mb_name" id="mb_name" placeholder="이름"></div>
              </div>
            </div>
            <div class="input_one">
              <div class="inner_input_one clearfix">
                <div class="input"><input type="tel" name="mb_phone" id="mb_phone" placeholder="휴대폰번호 ('-' 없이 입력해주세요)" onkeyup="only_num(this);chk_len(this.value);"></div>
              </div>
            </div>
          </div>
          <div class="check_block">
            <div class="inner_check_block clearfix">
              <div class="check"><a href="#" onclick="privacy_check();return false;"><img src="images/popup/check_off.jpg" width="20" name="privacy_agree" id="privacy_agree" /></a></div>
              <div class="txt">개인정보 수집 및 위탁에 관한 동의(필수)</div>
              <div class="btn_detail"><a href="#" onclick="open_pop('privacy_agree_popup');return false;"><img src="images/popup/btn_detail.jpg" width="55" /></a></div>
            </div>
            <div class="inner_check_block clearfix">
              <div class="check"><a href="#" onclick="adver_check();return false;"><img src="images/popup/check_off.jpg" width="20" name="adver_agree" id="adver_agree" /></a></div>
              <div class="txt">광고성 정보 전송 동의 약관 동의(선택)</div>
              <div class="btn_detail"><a href="#" onclick="open_pop('adver_agree_popup');return false;"><img src="images/popup/btn_detail.jpg" width="55" /></a></div>
            </div>
          </div>
        </div>
        <div class="btn_block input">
          <div class="img"><a href="#" onclick="insert_input();return false;"><img src="images/popup/btn_input_1.png" /></a></div>
        </div>
      </div><!--inner-->
    </div>
  </div>
</div>
<!------------------ 개인정보 입력 페이지 ------------------>

<!------------------------------ 체험팩 쿠폰 받을 사람 엔딩 ------------------------------>
<div id="end_coupon_div" class="popup_wrap" style="display:none;">
  <div class="p_mid p_position">
    <div class="block_close clearfix">
      <a href="index.php" class="btn_close"><img src="images/popup/btn_close.png" /></a>
    </div>        
    <div class="block_content movie">
      <div class="inner">
        <div class="title img">
          <img src="images/popup/top_2.jpg" />
        </div>
        <div class="mv">
          <div class="title">
            <div class="bg img"><img src="images/popup/title_movie_c_3.png" /></div>
          </div>
          <div class="youtube" style="background:#FACBC1">
            <a href="#" onclick="return false;"><img src="" class="image_view"></a>
          </div>
        </div>
        <div class="down_txt">
        * 위에 합성된 사진을 길게 누르시고 다운 받으세요
        </div>
        <div class="img">
          <img src="images/popup/txt_share_1.png" />
        </div>
      </div><!--inner-->
    </div>
    <div class="block_content ending_sns coupon">
      <div class="inner">
        <div class="share">
          <div>
            <a href="#" onclick="sns_share('kt','share');return false;"><img src="images/popup/btn_kt.png" /></a>
            <a href="#" onclick="sns_share('ks','share');return false;"><img src="images/popup/btn_ks.png" /></a>
            <a href="#" onclick="sns_share('fb','share');return false;"><img src="images/popup/btn_fb.png" /></a>
          </div>
        </div>
        <div class="coupon_img">
          <div class="serial" id="use_serial">serial</div>
          <div class="img"><img src="images/popup/bg_coupon.jpg" /></div>
        </div>
        <div class="btn_home_block">
          <div class="btn_block">
            <a href="http://www.babience.com/m/bbgrowth_coupon/event.jsp" class="img" target="_blank"><img src="images/popup/btn_home.png" /></a>
          </div>
        </div>
      </div><!--inner-->
    </div>            
  </div>
</div>
<!------------------------------ 체험팩 쿠폰 받을 사람 엔딩 ------------------------------>

<!------------------------------ 체험팩 쿠폰 이미 받은 사람 엔딩 ------------------------------>
<div id="end_sns_div" class="popup_wrap" style="display:none">
  <div class="p_mid p_position">
    <div class="block_close clearfix">
      <a href="index.php" class="btn_close"><img src="images/popup/btn_close.png" /></a>
    </div>        
    <div class="block_content movie">
      <div class="inner">
        <div class="title img">
          <img src="images/popup/top_2.jpg" />
        </div>
        <div class="mv">
          <div class="title">
            <div class="bg img"><img src="images/popup/title_movie_c_3.png" /></div>
          </div>
          <div class="youtube" style="background:#FACBC1">
            <a href="#" onclick="return false;"><img src="" class="image_view"></a>
          </div>
        </div>
        <div class="down_txt">
        * 위에 합성된 사진을 길게 누르시고 다운 받으세요
        </div>
      </div><!--inner-->
    </div>
    <div class="block_content ending_sns sns_2">
      <div class="inner">
        <div class="img txt_share_2">
          <img src="images/popup/txt_share_2.png" />
        </div>
        <div class="share">
          <div>
            <a href="#" onclick="sns_share('kt','share');return false;"><img src="images/popup/btn_kt.png" /></a>
            <a href="#" onclick="sns_share('ks','share');return false;"><img src="images/popup/btn_ks.png" /></a>
            <a href="#" onclick="sns_share('fb','share');return false;"><img src="images/popup/btn_fb.png" /></a>
          </div>
          <div class="img">
            <img src="images/popup/gift_ame.jpg" />
          </div>
        </div>
      </div><!--inner-->
    </div>            
  </div>
</div>
<!------------------------------ 체험팩 쿠폰 이미 받은 사람 엔딩 ------------------------------>
