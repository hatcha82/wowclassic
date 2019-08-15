<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

    </div>
    <div id="aside">
        <?php
        //공지사항
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
        echo latest('theme/notice', 'notice', 4, 13);
        ?>
        <?php echo outlogin('theme/basic'); // 외부 로그인, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
        <?php
            $sql = " select 	wr_content
            from 	g5_write_free
            where 	ca_name = 'Youtube'
            and  INSTR(wr_content,'https://www.youtube.com/watch?') limit 30";
           
            $youtubeIdList = array();
            $result = sql_query($sql);
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#',  $row['wr_content'], $matches);

                if(isset($matches[2]) && $matches[2] != ''){
                    $YoutubeCode = $matches[2];
                    array_push($youtubeIdList,$YoutubeCode);
                }
                
            }
            $YoutubeCode = $youtubeIdList[array_rand($youtubeIdList)];
        ?>
        <div style="padding: 0 25px">
        <!-- <a  href="https://www.youtube.com/embed/<?php echo $YoutubeCode?>?autoplay=0&playsinline=1" > -->
        <img src="/img/youtube.png" style="width:25px;float:left;"/> 
        <span style="color:#eee;line-height:25px;padding:0 5px;">팬사이트 추천 WoW Youtube</span>
        </a>
        <!-- </div>   -->
        <?php if(isset($YoutubeCode) && $YoutubeCode != ''){?>

        
        <div style="width:230px;margin:0 auto;">
            <div id="youtube_area" style="width:230px;margin-top:10px;margin-bottom:20px;border:1px solid #444">
                <div style="position: relative; padding-bottom: 56.25%;">
                <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="https://www.youtube.com/embed/<?php echo $YoutubeCode?>?autoplay=0&playsinline=1" frameborder="0" gesture="media" allow="autoplay;encrypted-media" allowfullscreen="allowfullscreen"></iframe>
                </div>
                <!-- <a target="_blank" href="https://www.youtube.com/watch?v=<coYw-eVU0Ks" ></a>        -->
            </div>
        </div> 
        <?php } ?>
        <?php echo poll('theme/basic'); // 설문조사, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
        <div style="margin:0px 20px;">
        <tenping class="adsbytenping" style="width: 100%; margin: 0px auto; display: block; max-width: 768px;" tenping-ad-client="OG1GZvcF9%2ftKBJFmMMMQpiZ41M0GlEawTCO4hzThpVdH%2bxRVRthTfGyB2E94CJtF" tenping-ad-display-type="67%2be3LHzHbblsB9oLrOpWQ%3d%3d"></tenping><script async src='//ads.tenping.kr/scripts/adsbytenping.min.js' ></script>
        </div>
        <?php echo visit('theme/basic'); // 접속자집계, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
    </div>
</div>

</div>
<!-- } 콘텐츠 끝 -->

<hr>

<!-- 하단 시작 { -->
<div id="ft">

    <div id="ft_wr">
        <div id="ft_link">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보처리방침</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
            <a href="<?php echo get_device_change_url(); ?>">모바일버전</a>
        </div>
        <div id="ft_catch"><img src="<?php echo G5_IMG_URL; ?>/ft_logo.png" alt="<?php echo G5_VERSION ?>"></div>
        <div id="ft_copy">Copyright &copy; <b>wowclassic.furiganahub.com </b> All rights reserved.</div>
    </div>
    
    <button type="button" id="top_btn"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></button>
        <script>
        
        $(function() {
            $("#top_btn").on("click", function() {
                $("html, body").animate({scrollTop:0}, '500');
                return false;
            });
        });
        </script>
</div>

<?php
if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>