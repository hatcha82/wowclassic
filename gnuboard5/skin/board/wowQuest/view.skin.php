<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<pre style="color:#fff">
<?php
$sql = " select * from wow_db.quest_template where entry = '$wr_id' ";

$wowQuest = sql_fetch($sql);
echo var_dump($wowQuest);
?>
</pre>


<!-- 게시물 읽기 시작 { -->

<article id="bo_v" style="width:<?php echo $width; ?>">
    <header>
        <h2 id="bo_v_title">
            <?php if ($category_name) { ?>
            <a class="boardHead" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $board['bo_table'];?>&sca=<?php echo $view['ca_name'];?>">
            <div class="bo_v_cate">
            <a style="pointer-events: none;cursor: default;" target="_blank" href="https://ko.classic.wowhead.com/zone=<?php echo $view['ca_name'] ?>"></a>     
            </div> 
            </a>
            <?php } ?>
            <span class="bo_v_tit">
            <a style="pointer-events: none;cursor: default;" target="_blank"  href="https://ko.classic.wowhead.com/quest=<?php echo $view['wr_id'] ?>"></a>                       
        </h2>
    </header>

    <section id="bo_v_info">
        <h2>페이지 정보</h2>

        <?php
            $name = get_sideview($view['mb_id'], get_text(cut_str($view['wr_name'], $config['cf_cut_name'])), $view['wr_email'], $view['wr_homepage']);
        ?>
        <span class="sound_only">작성자</span> <strong><?php echo $name ?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?></strong>
        <span class="sound_only">댓글</span><strong><a href="#bo_vc"> <i class="fa fa-commenting-o" aria-hidden="true"></i> <?php echo number_format($view['wr_comment']) ?>건</a></strong>
        <span class="sound_only">조회</span><strong><i class="fa fa-eye" aria-hidden="true"></i> <?php echo number_format($view['wr_hit']) ?>회</strong>
        ><span class="sound_only">작성일</span><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?>
        <div id="bo_v_top" style="float:right;margin-top: -27px;margin-bottom: -20px;padding-top: 0;">
        <?php
        ob_start();
        ?>

        <ul class="bo_v_left">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01 btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01 btn" onclick="del(this.href); return false;"><i class="fa fa-trash-o" aria-hidden="true"></i> 삭제</a></li><?php } ?>
            <?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btn_admin btn" onclick="board_move(this.href); return false;"><i class="fa fa-files-o" aria-hidden="true"></i> 복사</a></li><?php } ?>
            <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btn_admin btn" onclick="board_move(this.href); return false;"><i class="fa fa-arrows" aria-hidden="true"></i> 이동</a></li><?php } ?>
            <?php if ($search_href) { ?><li><a href="<?php echo $search_href ?>" class="btn_b01 btn"><i class="fa fa-search" aria-hidden="true"></i> 검색</a></li><?php } ?>
        </ul>

        <ul class="bo_v_com">
           <li><a href="<?php echo $list_href ?>" class="btn_b01 btn"><i class="fa fa-list" aria-hidden="true"></i> 목록</a></li>
            <?php if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>" class="btn_b01 btn"><i class="fa fa-reply" aria-hidden="true"></i> 답변</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02 btn"><i class="fa fa-pencil" aria-hidden="true"></i> 글쓰기</a></li><?php } ?>
        </ul>

        <?php if ($prev_href || $next_href) { ?>
        <ul class="bo_v_nb">
            <?php if ($prev_href) { ?><li class="btn_prv"><span class="nb_tit"><i class="fa fa-caret-up" aria-hidden="true"></i> 이전글</span><a href="<?php echo $prev_href ?>"><?php echo $prev_wr_subject;?></a> <span class="nb_date"><?php echo str_replace('-', '.', substr($prev_wr_date, '2', '8')); ?></span></li><?php } ?>
            <?php if ($next_href) { ?><li class="btn_next"><span class="nb_tit"><i class="fa fa-caret-down" aria-hidden="true"></i> 다음글</span><a href="<?php echo $next_href ?>"><?php echo $next_wr_subject;?></a>  <span class="nb_date"><?php echo str_replace('-', '.', substr($next_wr_date, '2', '8')); ?></span></li><?php } ?>
        </ul>
        <?php } ?>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div>
    </section>

    <section id="bo_v_atc">
        <h2 id="bo_v_atc_title">본문</h2>

        <?php
        // 파일 출력
        $v_img_count = count($view['file']);
        if($v_img_count) {
            echo "<div id=\"bo_v_img\">\n";

            for ($i=0; $i<=count($view['file']); $i++) {
                if ($view['file'][$i]['view']) {
                    //echo $view['file'][$i]['view'];
                    echo get_view_thumbnail($view['file'][$i]['view']);
                }
            }

            echo "</div>\n";
        }
         ?>
      
        <!-- 본문 내용 시작 { -->
        <div id="bo_v_con">
        <a href="https://ko.classic.wowhead.com/quest=<?php echo $wowQuest['entry'] ?>"></a>
        <!-- <iframe src="https://ko.classic.wowhead.com/quest=<?php echo $wowQuest['entry'] ?>/" width="100%"> -->
        <?php for($i = 1; $i <=4 ;$i++){ ?>  
            
            <?php if ($wowQuest['ReqCreatureOrGOId'.$i]) { ?>
                 <a href="https://ko.classic.wowhead.com/npc=<?php echo $wowQuest['ReqCreatureOrGOId'.$i]; ?>"></a>
                 (<?php echo $wowQuest['ReqCreatureOrGOCount'. $i]?>)
            <?php }?>
        <?php }?>

        
        <?php echo get_view_thumbnail($view['content']); ?>
    
        </div>
        <script>       
        $('img').on('error',function(){
            var src = $(this).attr('src');
            $(this).addClass('noImage')
            $(this).attr('src', '/img/no_img.png');            
            // $(this).after("<br><a target='_blank' class='noImage' href='" + src+"'>원본 이미지 링크</a>");
        });
       </script>
        <?php //echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
        <!-- } 본문 내용 끝 -->

        <?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>


        <!--  추천 비추천 시작 { -->
        <?php if ( $good_href || $nogood_href) { ?>
        <div id="bo_v_act">
            <?php if ($good_href) { ?>
            <span class="bo_v_act_gng">
                <a href="<?php echo $good_href.'&amp;'.$qstr ?>" id="good_button" class="bo_v_good"><span class="sound_only"></span><strong>
                    <?php echo number_format($view['wr_good']) ?></strong>
                </a>
                <b id="bo_v_act_good"></b>
            </span>
            <?php } ?>
            <?php if ($nogood_href) { ?>
            <span class="bo_v_act_gng">
                <a href="<?php echo $nogood_href.'&amp;'.$qstr ?>" id="nogood_button" class="bo_v_nogood"><span class="sound_only">비추천</span><strong><?php echo number_format($view['wr_nogood']) ?></strong></a>
                <b id="bo_v_act_nogood"></b>
            </span>
            <?php } ?>
        </div>
        <?php } else {
            if($board['bo_use_good'] || $board['bo_use_nogood']) {
        ?>
        <div id="bo_v_act">
            <?php if($board['bo_use_good']) { ?><span class="bo_v_good"><span class="sound_only">추천</span><strong><?php echo number_format($view['wr_good']) ?></strong></span><?php } ?>
            <?php if($board['bo_use_nogood']) { ?><span class="bo_v_nogood"><span class="sound_only">비추천</span><strong><?php echo number_format($view['wr_nogood']) ?></strong></span><?php } ?>
        </div>
        <?php
            }
        }
        ?>
        <!-- }  추천 비추천 끝 -->
    </section>

    <div id="bo_v_share">
        <?php if ($scrap_href) { ?><a href="<?php echo $scrap_href;  ?>" target="_blank" class="btn btn_b03" onclick="win_scrap(this.href); return false;"><i class="fa fa-thumb-tack" aria-hidden="true"></i> 스크랩</a><?php } ?>

        <?php
        include_once(G5_SNS_PATH."/view.sns.skin.php");
        ?>
    </div>

    <?php
    $cnt = 0;
    if ($view['file']['count']) {
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                $cnt++;
        }
    }
     ?>

    <?php if($cnt) { ?>
    <!-- 첨부파일 시작 { -->
    <section id="bo_v_file">
        <h2>첨부파일</h2>
        <ul>
        <?php
        // 가변 파일
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
         ?>
            <li>
                <i class="fa fa-download" aria-hidden="true"></i>
                <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                    <strong><?php echo $view['file'][$i]['source'] ?></strong>
                </a>
                <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
                <span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?>회 다운로드 | DATE : <?php echo $view['file'][$i]['datetime'] ?></span>
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section>
    <!-- } 첨부파일 끝 -->
    <?php } ?>

    <?php if(array_filter($view['link'])) { ?>
    <!-- 관련링크 시작 { -->
    <section id="bo_v_link">
        <h2>관련링크</h2>
        <ul>
        <?php
        // 링크
        $cnt = 0;
        for ($i=1; $i<=count($view['link']); $i++) {
            if ($view['link'][$i]) {
                $cnt++;
                $link = cut_str($view['link'][$i], 70);
            ?>
            <li>
                <i class="fa fa-link" aria-hidden="true"></i> <a href="<?php echo $view['link_href'][$i] ?>" target="_blank">
                    
                    <strong><?php echo $link ?></strong>
                </a>
                <span class="bo_v_link_cnt"><?php echo $view['link_hit'][$i] ?>회 연결</span>
            </li>
            <?php
            }
        }
        ?>
        </ul>
    </section>
    <!-- } 관련링크 끝 -->
    <?php } ?>

    <!-- 게시물 상단 버튼 시작 { -->
    <div id="bo_v_top">
        <?php
        ob_start();
        ?>

        <ul class="bo_v_left">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01 btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01 btn" onclick="del(this.href); return false;"><i class="fa fa-trash-o" aria-hidden="true"></i> 삭제</a></li><?php } ?>
            <?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btn_admin btn" onclick="board_move(this.href); return false;"><i class="fa fa-files-o" aria-hidden="true"></i> 복사</a></li><?php } ?>
            <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btn_admin btn" onclick="board_move(this.href); return false;"><i class="fa fa-arrows" aria-hidden="true"></i> 이동</a></li><?php } ?>
            <?php if ($search_href) { ?><li><a href="<?php echo $search_href ?>" class="btn_b01 btn"><i class="fa fa-search" aria-hidden="true"></i> 검색</a></li><?php } ?>
        </ul>

        <ul class="bo_v_com">
           <li><a href="<?php echo $list_href ?>" class="btn_b01 btn"><i class="fa fa-list" aria-hidden="true"></i> 목록</a></li>
            <?php if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>" class="btn_b01 btn"><i class="fa fa-reply" aria-hidden="true"></i> 답변</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02 btn"><i class="fa fa-pencil" aria-hidden="true"></i> 글쓰기</a></li><?php } ?>
        </ul>

        <?php if ($prev_href || $next_href) { ?>
        <ul class="bo_v_nb">
            <?php if ($prev_href) { ?><li class="btn_prv"><span class="nb_tit"><i class="fa fa-caret-up" aria-hidden="true"></i> 이전글</span><a href="<?php echo $prev_href ?>"><?php echo $prev_wr_subject;?></a> <span class="nb_date"><?php echo str_replace('-', '.', substr($prev_wr_date, '2', '8')); ?></span></li><?php } ?>
            <?php if ($next_href) { ?><li class="btn_next"><span class="nb_tit"><i class="fa fa-caret-down" aria-hidden="true"></i> 다음글</span><a href="<?php echo $next_href ?>"><?php echo $next_wr_subject;?></a>  <span class="nb_date"><?php echo str_replace('-', '.', substr($next_wr_date, '2', '8')); ?></span></li><?php } ?>
        </ul>
        <?php } ?>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->

    <?php
    // 코멘트 입출력
    include_once(G5_BBS_PATH.'/view_comment.php');
     ?>


</article>
<!-- } 게시판 읽기 끝 -->

<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();

    //sns공유
    $(".btn_share").click(function(){
        $("#bo_v_sns").fadeIn();
   
    });

    $(document).mouseup(function (e) {
        var container = $("#bo_v_sns");
        if (!container.is(e.target) && container.has(e.target).length === 0){
        container.css("display","none");
        }	
    });
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
<!-- } 게시글 읽기 끝 -->