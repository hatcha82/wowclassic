<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<div class="lat">
    <h2 class="lat_title"><a href="<?php echo G5_BBS_URL ?>/item.php?bo_table=<?php echo $bo_table ?>"><?php echo $bo_subject ?></a></h2>
    <ul>
    <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li>
            <div>            
            <?php
            if ($list[$i]['ca_name'])  {
                $cateName = $list[$i]['ca_name'];
                echo "<span style='color:#eee'>[</span>";
                echo '<a style="pointer-events: none;cursor: default;" target="_blank" href="https://ko.classic.wowhead.com/zone=' . $list[$i]['ca_name'] . '"></a>';
                echo "<span style='color:#eee'>]</span>";
                //echo "<a  class='bo_cate_link' href='" . $list[$i]['ca_name_href'] . "'>[$cateName]</a>";
            }           
            echo "<a href=\"".$list[$i]['href']."\"> ";
            if ($list[$i]['is_notice'])
                echo "<strong>".$list[$i]['subject']."</strong>";
            else
                //echo $list[$i]['subject'];

                echo '<a style="" target="_blank"  href="https://ko.classic.wowhead.com/item=' . $list[$i]['wr_id'] . '"></a>';
            echo "</a>&nbsp;&nbsp;";
            
            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }
             //echo $list[$i]['icon_reply']." ";
           // if ($list[$i]['icon_file']) echo " <i class=\"fa fa-download\" aria-hidden=\"true\"></i>" ;
            //if ($list[$i]['icon_link']) echo " <i class=\"fa fa-link\" aria-hidden=\"true\"></i>" ;
            // if ($list[$i]['icon_secret']) echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";
            // if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";
            // if ($list[$i]['icon_hot']) echo "<span class=\"hot_icon\">H<span class=\"sound_only\">인기글</span></span>";
            // if ($list[$i]['comment_cnt'])  echo "
            // <span class=\"lt_cmt\">+ ".$list[$i]['comment_cnt']."</span>";
            ?>
            </div>
            <div class="lt_info">
            <!-- <span class="lt_date"> -->
                <!-- <span class="sound_only">작성자</span><?php echo $list[$i]['name'] ?> | -->
                <!-- <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><i class="fa fa-commenting-o" aria-hidden="true"></i><?php echo $list[$i]['comment_cnt'] . ' |'; ?> <span class="sound_only">개 </span><?php } ?>  -->
                <!-- <span class="">조회 </span><?php echo $list[$i]['wr_hit'] ?> |
                <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $list[$i]['datetime2'] ?> -->
            <!-- </span> -->
            </div>
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li class="empty_li">게시물이 없습니다.</li>
    <?php }  ?>
    </ul>
    <a href="<?php echo G5_BBS_URL ?>/item.php?bo_table=<?php echo $bo_table ?>" class="lt_more"><span class="sound_only"><?php echo $bo_subject ?></span><i class="fa fa-plus" aria-hidden="true"></i><span class=""> 더보기</span></a>

</div>
