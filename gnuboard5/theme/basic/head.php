<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>

<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>
    <div id="tnb">
        <img src="/img/logo-wow.png" style="float:left;height:30px;"/>
      
        <a class="blizzard" href="https://worldofwarcraft.com/ko-kr/game/status/classic-kr" style="position:absolute;left:30px;diaplay:inline">
        
        <div id="classicOpenDDay" style="display:none">
        </div>
        <?php echo get_wowServerStatus()?>
        </a>
        <div>
        </div>
        <ul>
            
            <?php if ($is_member) {  ?>
                
            <li><a href="https://toon.at/donate/637043684917070169" target="_blank"><i class="fa fa-donate"></i> 후원하기</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php"><i class="fa fa-cog" aria-hidden="true"></i> 정보수정</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> 로그아웃</a></li>
            <?php if ($is_admin) {  ?>
            <li class="tnb_admin"><a href="<?php echo G5_ADMIN_URL ?>"><b><i class="fa fa-user-circle" aria-hidden="true"></i> 관리자 <?php echo $_SERVER['HTTP_HOST'];?></b></a></li>
            <?php }  ?>
            
            <?php } else {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/register.php"><i class="fa fa-user-plus" aria-hidden="true"></i> 회원가입</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/login.php"><b><i class="fa fa-sign-in" aria-hidden="true"></i> 로그인</b></a></li>
            <?php }  ?>
            <li><a href="http://www.classicwow.co.kr">www.classicwow.co.kr</a></li>
        </ul>
      
    </div>
    <div id="hd_wrapper">
        
        <div class="hd_sch_wr">
        
        <div id="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>" ></a>
            <br>
            <span style="">클래식 월드 오브 워크래프트 팬사이트</span>
           
        </div>
            
            <fieldset id="hd_sch" >
                <legend>사이트 내 전체검색</legend>
                <form name="fsearchbox" method="get" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);">
                <input type="hidden" name="sfl" value="wr_subject||wr_content">
                <input type="hidden" name="sop" value="and">
                <label for="sch_stx" class="sound_only">검색어 필수</label>
                <input type="text" name="stx" id="sch_stx" maxlength="20" placeholder="검색어를 입력해주세요">
                <button type="submit" id="sch_submit" value="검색"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
                </form>

                <script>
                function fsearchbox_submit(f)
                {
                    if (f.stx.value.length < 2) {
                        alert("검색어는 두글자 이상 입력하십시오.");
                        f.stx.select();
                        f.stx.focus();
                        return false;
                    }

                    // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
                    var cnt = 0;
                    for (var i=0; i<f.stx.value.length; i++) {
                        if (f.stx.value.charAt(i) == ' ')
                            cnt++;
                    }

                    if (cnt > 1) {
                        alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
                        f.stx.select();
                        f.stx.focus();
                        return false;
                    }

                    return true;
                }
                </script>

            </fieldset>
            
            <?php echo popular('theme/basic'); // 인기검색어, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?>
        </div>
        <ul id="hd_qnb">
            <li><a href="<?php echo G5_BBS_URL ?>/faq.php"><i class="fa fa-question" aria-hidden="true"></i><span>FAQ</span></a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/qalist.php"><i class="fa fa-comments" aria-hidden="true"></i><span>1:1문의</span></a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/current_connect.php" class="visit"><i class="fa fa-users" aria-hidden="true"></i><span>접속자</span><strong class="visit-num"><?php echo connect('theme/basic'); // 현재 접속자수, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?></strong></a></li>            
            <li><a href="<?php echo G5_BBS_URL ?>/new.php"><i class="fa fa-history" aria-hidden="true"></i><span>새글</span></a></li>
        </ul>
       
    </div>
    
    <nav id="gnb">
        <h2>메인메뉴</h2>
        <div class="gnb_wrap">
            <ul id="gnb_1dul">
                <li class="gnb_1dli gnb_mnal"><button type="button" class="gnb_menu_btn"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">전체메뉴열기</span></button></li>
                <?php
                $sql = " select *
                            from {$g5['menu_table']}
                            where me_use = '1'
                              and length(me_code) = '2'
                            order by me_order, me_id ";
                $result = sql_query($sql, false);
                $gnb_zindex = 999; // gnb_1dli z-index 값 설정용
                $menu_datas = array();

                for ($i=0; $row=sql_fetch_array($result); $i++) {
                    $menu_datas[$i] = $row;

                    $sql2 = " select *
                                from {$g5['menu_table']}
                                where me_use = '1'
                                  and length(me_code) = '4'
                                  and substring(me_code, 1, 2) = '{$row['me_code']}'
                                order by me_order, me_id ";
                    $result2 = sql_query($sql2);
                    for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                        $menu_datas[$i]['sub'][$k] = $row2;
                    }

                }

                $i = 0;
                foreach( $menu_datas as $row ){
                    if( empty($row) ) continue; 
                ?>
                <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                    <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da">
                    <?php if (get_icon_by_categoryName($row['me_name'])) { ?>
                        <img src="<?php echo get_icon_by_categoryName($row2['me_name'])?>" class="menu_icon"/>
                    <?php }?>
                    <?php echo $row['me_name'] ?>
                    </a>
                    <?php
                    $k = 0;
                    foreach( (array) $row['sub'] as $row2 ){

                        if( empty($row2) ) continue; 

                        if($k == 0)
                            echo '<span class="bg">하위분류</span><ul class="gnb_2dul">'.PHP_EOL;
                    ?>
                        <li class="gnb_2dli">
                            <a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da">
                            <?php if (get_icon_by_categoryName($row2['me_name'])) { ?>
                                <img src="<?php echo get_icon_by_categoryName($row2['me_name'])?>" class="menu_icon"/>
                            <?php }?>
                            <?php echo $row2['me_name'] ?>
                            </a>
                        </li>
                    <?php
                    $k++;
                    }   //end foreach $row2

                    if($k > 0)
                        echo '</ul>'.PHP_EOL;
                    ?>
                </li>
                <?php
                $i++;
                }   //end foreach $row

                if ($i == 0) {  ?>
                    <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                <?php } ?>
            </ul>
            <div id="gnb_all">
                <h2>전체메뉴</h2>
                <ul class="gnb_al_ul">
                    <?php
                    
                    $i = 0;
                    foreach( $menu_datas as $row ){
                    ?>
                    <li class="gnb_al_li">
                        <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_al_a">
                        <?php if (get_icon_by_categoryName($row['me_name'])) { ?>
                            <img src="<?php echo get_icon_by_categoryName($row['me_name'])?>" class="menu_icon"/>
                        <?php }?>
                        <?php echo $row['me_name'] ?>
                        </a>
                        <?php
                        $k = 0;
                        foreach( (array) $row['sub'] as $row2 ){
                            if($k == 0)
                                echo '<ul>'.PHP_EOL;
                        ?>
                            <li>
                                <a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>">
                                    <i class="fa fa-caret-right" aria-hidden="true"></i>    
                                    <?php if (get_icon_by_categoryName($row2['me_name'])) { ?>
                                        <img src="<?php echo get_icon_by_categoryName($row2['me_name'])?>" class="menu_icon"/>
                                    <?php }?>
                                    <?php echo $row2['me_name'] ?>
                                </a>
                            </li>
                        <?php
                        $k++;
                        }   //end foreach $row2

                        if($k > 0)
                            echo '</ul>'.PHP_EOL;
                        ?>
                    </li>
                    <?php
                    $i++;
                    }   //end foreach $row

                    if ($i == 0) {  ?>
                        <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                    <?php } ?>
                </ul>
                <button type="button" class="gnb_close_btn"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
        </div>
    </nav>    
    <script>
    
    $(function(){

        /* 와우 오픈 관련 */
      
    
     
       
        function openClassicRelese(){
            var release = moment('2019-08-27 07:00:00')
            var now = moment()
            var diff = release.diff(now)
            var diffDuration = moment.duration(diff)
            var msg = "";
            if (diff > 0) {
                msg = `클래식 오픈까지 ${diffDuration.days()}일 ${diffDuration.hours()}시간 ${diffDuration.minutes()}분 ${diffDuration.seconds()}초 남았습니다.`
            } else {
                msg = `클래식 오픈이후 ${Math.abs(diffDuration.days())}일 ${Math.abs(diffDuration.hours())}시간 ${Math.abs(diffDuration.minutes())}분 ${Math.abs(diffDuration.seconds())}초 지났습니다.`
            }
            $("#classicOpenDDay").text(msg)
        }
        openClassicRelese()
        setInterval(openClassicRelese,1000)
        youtubeLinktoPlayer();
        
        
        $(".gnb_menu_btn").click(function(){
            $("#gnb_all").show();
        });
        $(".gnb_close_btn").click(function(){
            $("#gnb_all").hide();
        });
    });

    </script>
</div>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <div id="container_wr">    
    <div style="margin:10px 0;">
    <?php daum_adfit();?>
    
    <div id="left_navi">
        <ul class="">
            <?php
            
            $i = 0;
            foreach( $menu_datas as $row ){
            ?>
            <li class="depth1">
                <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_al_a">
                <?php if (get_icon_by_categoryName($row['me_name'])) { ?>
                    <img src="<?php echo get_icon_by_categoryName($row['me_name'])?>" class="menu_icon"/>
                <?php }?>
                <?php echo $row['me_name'] ?>
                </a>
                <?php
                $k = 0;
                foreach( (array) $row['sub'] as $row2 ){
                    if($k == 0)
                        echo '<ul>'.PHP_EOL;
                ?>
                    <li class="depth2">
                        <a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>">
                        <i class="fa fa-caret-right" aria-hidden="true"></i> 
                        <?php if (get_icon_by_categoryName($row2['me_name'])) { ?>
                            <img src="<?php echo get_icon_by_categoryName($row2['me_name'])?>" class="menu_icon"/>
                        <?php }?>
                        <?php echo $row2['me_name'] ?>
                        </a>
                    </li>
                <?php
                $k++;
                }   //end foreach $row2

                if($k > 0)
                    echo '</ul><div style="clear:both"/>'.PHP_EOL;
                ?>
            </li>
            <?php
            $i++;
            }   //end foreach $row

            if ($i == 0) {  ?>
                <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
            <?php } ?>
        </ul>
        <div style="width:160px;margin:10px auto;">
        <script type="text/javascript" src="//ad.ilikesponsorad.com/ad/ad.js?adImpMgrCode=60719&width=160&height=600"></script>
        </div>
    </div>
    <div id="container">
        <?php if (!defined("_INDEX_")) { ?>
            <?php if ($board['bo_table'] === 'item') { ?>
                <a href="<?php echo G5_BBS_URL ?>/item.php?bo_table=<?php echo $board['bo_table'];?>"> <h2 id="container_title"><span title="<?php echo get_text($g5['title']); ?>"><?php echo get_head_title($g5['title']); ?></span></h2></a>        
            <?php } else if ($board['bo_table'] === 'quest') { ?>
                <a href="<?php echo G5_BBS_URL ?>/quest.php?bo_table=<?php echo $board['bo_table'];?>"> <h2 id="container_title"><span title="<?php echo get_text($g5['title']); ?>"><?php echo get_head_title($g5['title']); ?></span></h2></a>        
            <?php } else { ?>    
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $board['bo_table'];?>"> <h2 id="container_title"><span title="<?php echo get_text($g5['title']); ?>"><?php echo get_head_title($g5['title']); ?></span></h2></a>        
            <?php } ?>
           
        <?php } ?>

