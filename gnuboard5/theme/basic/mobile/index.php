<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>

<!-- 메인화면 최신글 시작 -->
<?php
//  최신글
    
    $sql = " select bo_table, bo_mobile_skin
            from `{$g5['board_table']}` a left join `{$g5['group_table']}` b on (a.gr_id=b.gr_id)
            where a.bo_device in ('mobile','both')";
    if(!$is_admin){
        $sql .= " and a.bo_use_cert = '' ";
    }
    $sql .= " order by b.gr_order, a.bo_order ";
    $result = sql_query($sql);
    
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 스킨은 입력하지 않을 경우 관리자 > 환경설정의 최신글 스킨경로를 기본 스킨으로 합니다.
       // echo 'theme/'.$row['bo_mobile_skin'];
        
        // 사용방법
        // latest(스킨, 게시판아이디, 출력라인, 글자수);
        if($row['bo_table'] == 'notice'){
            echo latest('theme/'.$row['bo_mobile_skin'], $row['bo_table'], 3, 25);
        }else if($row['bo_table'] == 'free'){
            echo latest('theme/'.$row['bo_mobile_skin'], $row['bo_table'], 10, 25);
        }else if($row['gr_id'] == 'community'){
            echo latest('theme/'.$row['bo_mobile_skin'], $row['bo_table'], 5, 25);
        }else if($row['gr_id'] == 'game'){
            echo latest('theme/'.$row['bo_mobile_skin'],$row['bo_table'], 10, 25);
        }else{
            echo latest('theme/'.$row['bo_mobile_skin'], $row['bo_table'], 5, 25);
        }
}
?>
<!-- 메인화면 최신글 끝 -->

<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>