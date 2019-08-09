<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<div class="lt list_01">
    <div class="bo_name">
        <div class="lt_title">   
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>" ><i class="fa fa-list-ul" aria-hidden="true"></i> <strong><?php echo $bo_subject ?></strong></a>
        </div>
    </div>
    <ul>
    <?php for ($i=0; $i<count($list); $i++) { ?>
        <li>
            
            <?php            
            if ($list[$i]['ca_name'])  {
                $cateName = $list[$i]['ca_name'];
                echo "[<a style='pointer-events: none;cursor: default;'  class='bo_cate_link' href='https://ko.classic.wowhead.com/zone=" . $cateName . "'>$cateName</a>]";
            }
            if ($list[$i]['icon_secret']) echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i> ";
            //echo $list[$i]['icon_reply']." ";
            echo "<a href=\"".$list[$i]['href']."\" class=\"lt_tit\">";
            if ($list[$i]['is_notice'])
                echo "<strong>".$list[$i]['wr_subject']."</strong>";
            else
                // echo $list[$i]['entry'];
                echo "<a style='pointer-events: none;cursor: default;'  class='' href='https://ko.classic.wowhead.com/quest=" . $list[$i]['wr_id'] . "'></a>";
                // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
                // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }
                echo '&nbsp';
                if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];
                if (isset($list[$i]['icon_hot'])) echo $list[$i]['icon_hot'];
                if (isset($list[$i]['icon_file'])) echo $list[$i]['icon_file'];
                if (isset($list[$i]['icon_link'])) echo $list[$i]['icon_link'];
                if (isset($list[$i]['icon_secret'])) echo $list[$i]['icon_secret'];
            echo "</a>";
            ?>
            <div class="lt_info">
                <span class="sound_only">작성자</span><?php echo $list[$i]['name'] ?> |
                <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><i class="fa fa-commenting-o" aria-hidden="true"></i><?php echo $list[$i]['comment_cnt'] . ' |'; ?> <span class="sound_only">개 </span><?php } ?> 
                <span class="">조회 </span><?php echo $list[$i]['wr_hit'] ?> |
                <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $list[$i]['datetime2'] ?>
            </div>
        </li>
    <?php } ?>
    <?php if (count($list) == 0) { //게시물이 없을 때 ?>
    <li class="empty_li">게시물이 없습니다.</li>
    <?php }?>
    </ul>
    <?php if ($is_category) { ?>
            <ul class="category">
                
                <?php echo $category_option ?>
            </ul>
        <?php } ?>

</div>
