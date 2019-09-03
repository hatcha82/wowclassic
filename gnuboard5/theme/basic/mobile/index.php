<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>
<div style="margin-top: -1px;">


<!-- 메인화면 최신글 시작 -->
<?php
//  최신글
    
    $sql = "select 	*
            from 	g5_write_free
            where wr_is_comment = 0 
            and 	ca_name = 'Youtube'
            order
            by 		wr_num
            limit 10";

    $youtubeIdList = array();
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#',  $row['wr_content'], $matches);
        if(isset($matches[2]) && $matches[2] != ''){
        $row['YoutubeCode'] = $matches[2];
        array_push($youtubeIdList,$row);
        }
    }
    $YoutubeCodeWr = $youtubeIdList[array_rand($youtubeIdList)];
    $YoutubeCode = $YoutubeCodeWr['YoutubeCode'];
    $tmp_name = get_text(cut_str($YoutubeCodeWr['wr_name'], $config['cf_cut_name'])); // 설정된 자리수 만큼만 이름 출력
    $tmp_name2 = cut_str($YoutubeCodeWr['wr_name'], $config['cf_cut_name']); // 설정된 자리수 만큼만 이름 출력
    $YoutubeCodeWr['name'] = get_sideview($YoutubeCodeWr['mb_id'], $tmp_name2, $YoutubeCodeWr['wr_email'], $YoutubeCodeWr['wr_homepage']);
    $YoutubeWrHref = G5_BBS_URL . "/board.php?bo_table=free&wr_id=" . $YoutubeCodeWr['wr_id'] ."&sca=Youtube";
    $YoutubeWrSubject = $YoutubeCodeWr['wr_subject'];

    $sql = " select bo_table, bo_subject, bo_mobile_skin
            from `{$g5['board_table']}` a left join `{$g5['group_table']}` b on (a.gr_id=b.gr_id)
            where a.bo_device in ('mobile','both')";
    if(!$is_admin){
        $sql .= " and a.bo_use_cert = '' ";
    }
    $sql .= " order by b.gr_order, a.bo_order ";
    $lateList = array();
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $lateList[$i] = $row;
    }
    
    
    for ($i=0; $i <= count($lateList); $i++) {
        $row = $lateList[$i];
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 스킨은 입력하지 않을 경우 관리자 > 환경설정의 최신글 스킨경로를 기본 스킨으로 합니다.
       // echo 'theme/'.$row['bo_mobile_skin'];
        
        // 사용방법
        // latest(스킨, 게시판아이디, 출력라인, 글자수);


        if( isset( $row['bo_table']) ) {
            if($row['bo_table'] == 'notice'){
                echo latest('theme/'.$row['bo_mobile_skin'], $row['bo_table'], 3, 25);
                echo '<div class="lt list_01"><ul class="category">';
                for ($j=0; $j<=count($lateList); $j++) {
                    $rowj = $lateList[$j];
                    if( isset($rowj['bo_subject'])){
                        $href_url =  G5_BBS_URL . '/board.php?bo_table=' .$rowj['bo_table'];
                        echo "<a href='$href_url' ><li>". $rowj['bo_subject'] . "</li></a>";
                    }
       
                }
                echo '</ul></div>';
            }else if($row['bo_table'] == 'free'){
                echo "<div class='lt list_01' >
                    <div class='bo_name'>
                        <div class='lt_title'>   
                        <a style='display:block' href='$YoutubeWrHref'>
                        <img src='/img/youtube.png' style='width:25px;float:left;margin-top:13px'/> 
                        <span style='color:#eee;line-height:25px;padding:0 5px;'>팬사이트 추천 WoW Youtube</span>
                        <br>
                        <div style='font-size:12px;line-height:12px'>
                        $YoutubeWrSubject
                        </div>
                        </a>
                        </div>
                        <div style='width:100%;padding:0px;margin:0 auto;'>
                        <div id='youtube_area' style='width:100%;border:1px solid #444'>
                            <div style='position: relative; padding-bottom: 56.25%;'>
                            <iframe style='position: absolute; top: 0; left: 0; width: 100%; height: 100%;' 
                                src='https://www.youtube.com/embed/$YoutubeCode?autoplay=0&playsinline=1'
                                frameborder='0' gesture='media' allow='autoplay;encrypted-media' allowfullscreen='allowfullscreen'></iframe
                            </div>
                        </div>
                        
                    </div> 
                </div>";
                echo latest('theme/'.$row['bo_mobile_skin'], $row['bo_table'], 10, 25);
                //include(G5_THEME_MOBILE_PATH.'/youtube.php');
            }else if($row['gr_id'] == 'community'){
                echo latest('theme/'.$row['bo_mobile_skin'], $row['bo_table'], 5, 25);
            }else if($row['gr_id'] == 'game'){
                echo latest('theme/'.$row['bo_mobile_skin'],$row['bo_table'], 10, 25);
            }else{
                echo latest('theme/'.$row['bo_mobile_skin'], $row['bo_table'], 5, 25);
            }
        }
}

?>
<!-- 메인화면 최신글 끝 -->
</div>
<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>