<?php
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

if (!$board['bo_table']) {
    alert('존재하지 않는 게시판입니다.', G5_URL);
}

if (!$bo_table) {
    alert("bo_table 값이 넘어오지 않았습니다.\\nwrite.php?bo_table=code 와 같은 방식으로 넘겨 주세요.", G5_URL);
}


/*
// 게시판에서 두단어 이상 검색 후 검색된 게시물에 코멘트를 남기면 나오던 오류 수정
$sop = strtolower($sop);
if ($sop != 'and' && $sop != 'or')
    $sop = 'and';

@include_once($board_skin_path.'/view.head.skin.php');

$sql_search = "";
// 검색이면
if ($sca || $stx || $stx === '0') {
    // where 문을 얻음
    $sql_search = get_sql_search($sca, $sfl, $stx, $sop);
    $search_href = './board.php?bo_table='.$bo_table.'&amp;page='.$page.$qstr;
    $list_href = './board.php?bo_table='.$bo_table;
} else {
    $search_href = '';
    $list_href = './board.php?bo_table='.$bo_table.'&amp;page='.$page;
}

if (!$board['bo_use_list_view']) {
    if ($sql_search)
        $sql_search = " and " . $sql_search;

    // 윗글을 얻음
    $sql = " select wr_id, wr_subject, wr_datetime from {$write_table} where wr_is_comment = 0 and wr_num = '{$write['wr_num']}' and wr_reply < '{$write['wr_reply']}' {$sql_search} order by wr_num desc, wr_reply desc limit 1 ";
    $prev = sql_fetch($sql);
    // 위의 쿼리문으로 값을 얻지 못했다면
    if (!$prev['wr_id'])     {
        $sql = " select wr_id, wr_subject, wr_datetime from {$write_table} where wr_is_comment = 0 and wr_num < '{$write['wr_num']}' {$sql_search} order by wr_num desc, wr_reply desc limit 1 ";
        $prev = sql_fetch($sql);
    }

    // 아래글을 얻음
    $sql = " select wr_id, wr_subject, wr_datetime from {$write_table} where wr_is_comment = 0 and wr_num = '{$write['wr_num']}' and wr_reply > '{$write['wr_reply']}' {$sql_search} order by wr_num, wr_reply limit 1 ";
    $next = sql_fetch($sql);
    // 위의 쿼리문으로 값을 얻지 못했다면
    if (!$next['wr_id']) {
        $sql = " select wr_id, wr_subject, wr_datetime from {$write_table} where wr_is_comment = 0 and wr_num > '{$write['wr_num']}' {$sql_search} order by wr_num, wr_reply limit 1 ";
        $next = sql_fetch($sql);
    }
}

// 이전글 링크
$prev_href = '';
if (isset($prev['wr_id']) && $prev['wr_id']) {
    $prev_wr_subject = get_text(cut_str($prev['wr_subject'], 255));
    $prev_href = './board.php?bo_table='.$bo_table.'&amp;wr_id='.$prev['wr_id'].$qstr;
    $prev_wr_date = $prev['wr_datetime'];
}

// 다음글 링크
$next_href = '';
if (isset($next['wr_id']) && $next['wr_id']) {
    $next_wr_subject = get_text(cut_str($next['wr_subject'], 255));
    $next_href = './board.php?bo_table='.$bo_table.'&amp;wr_id='.$next['wr_id'].$qstr;
    $next_wr_date = $next['wr_datetime'];
}

// 쓰기 링크
$write_href = '';
if ($member['mb_level'] >= $board['bo_write_level'])
    $write_href = './write.php?bo_table='.$bo_table;

// 답변 링크
$reply_href = '';
if ($member['mb_level'] >= $board['bo_reply_level'])
    $reply_href = './write.php?w=r&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.$qstr;

// 수정, 삭제 링크
$update_href = $delete_href = '';
// 로그인중이고 자신의 글이라면 또는 관리자라면 비밀번호를 묻지 않고 바로 수정, 삭제 가능
if (($member['mb_id'] && ($member['mb_id'] === $write['mb_id'])) || $is_admin) {
    $update_href = './write.php?w=u&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr;
    set_session('ss_delete_token', $token = uniqid(time()));
    $delete_href ='./delete.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;token='.$token.'&amp;page='.$page.urldecode($qstr);
}
else if (!$write['mb_id']) { // 회원이 쓴 글이 아니라면
    $update_href = './password.php?w=u&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr;
    $delete_href = './password.php?w=d&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr;
}

// 최고, 그룹관리자라면 글 복사, 이동 가능
$copy_href = $move_href = '';
if ($write['wr_reply'] == '' && ($is_admin == 'super' || $is_admin == 'group')) {
    $copy_href = './move.php?sw=copy&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr;
    $move_href = './move.php?sw=move&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr;
}

$scrap_href = '';
$good_href = '';
$nogood_href = '';
if ($is_member) {
    // 스크랩 링크
    $scrap_href = './scrap_popin.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id;

    // 추천 링크
    if ($board['bo_use_good'])
        $good_href = './good.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;good=good';

    // 비추천 링크
    if ($board['bo_use_nogood'])
        $nogood_href = './good.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;good=nogood';
}

$view = get_view($write, $board, $board_skin_path);

if (strstr($sfl, 'subject'))
    $view['subject'] = search_font($stx, $view['subject']);

$html = 0;
if (strstr($view['wr_option'], 'html1'))
    $html = 1;
else if (strstr($view['wr_option'], 'html2'))
    $html = 2;

$view['content'] = conv_content($view['wr_content'], $html);
if (strstr($sfl, 'content'))
    $view['content'] = search_font($stx, $view['content']);

//$view['rich_content'] = preg_replace("/{이미지\:([0-9]+)[:]?([^}]*)}/ie", "view_image(\$view, '\\1', '\\2')", $view['content']);
function conv_rich_content($matches)
{
    global $view;
    return view_image($view, $matches[1], $matches[2]);
}
$view['rich_content'] = preg_replace_callback("/{이미지\:([0-9]+)[:]?([^}]*)}/i", "conv_rich_content", $view['content']);

$is_signature = false;
$signature = '';
if ($board['bo_use_signature'] && $view['mb_id']) {
    $is_signature = true;
    $mb = get_member($view['mb_id']);
    $signature = $mb['mb_signature'];

    $signature = conv_content($signature, 1);
}
*/

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

$view = get_view( $_POST, $board, $board_skin_path);
$view['wr_subject'] = $_POST['wr_subject'];
$view['content'] = stripslashes($_POST['wr_content']);

include_once($board_skin_path.'/preview.skin.php');
@include_once($board_skin_path.'/preview.tail.skin.php');
include_once(G5_BBS_PATH.'/board_tail.php');

echo "\n<!-- 사용스킨 : ".(G5_IS_MOBILE ? $board['bo_mobile_skin'] : $board['bo_skin'])." -->\n";

include_once(G5_PATH.'/tail.sub.php');
?>
<script>
$("body").hide();
$("#left_navi, #aside, #gnb, #hd, #ft").hide()
$("#container").css({margin:"0 auto", "margin-left":"15px"});
$("#bo_v").css({margin: "20px"});

$("body").show();
</script>