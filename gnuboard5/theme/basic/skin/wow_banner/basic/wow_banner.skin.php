<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$wow_banner_skin_url.'/style.css">', 0);
add_javascript('<script src="'.G5_JS_URL.'/jquery.bxslider.js"></script>', 10);
?>
<script>
 $('img').on('error',function(){
    var src = $(this).attr('src');
    $(this).addClass('noImage')
    $(this).attr('src', '/img/no_img.png');            
    // $(this).after("<br><a target='_blank' class='noImage' href='" + src+"'>원본 이미지 링크</a>");
});
</script>
<?php shuffle($list); ?>
<div class="wow_banner">
    <h2><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><i class="fa fa-bullhorn" aria-hidden="true"></i></a>
    <span class="">길드/레이드/파티</span>
    </h2>
    <ul>
    <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li>
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=finder&wr_id=<?php echo $list[$i]['wr_id']?>">
            <img class="clan_logo" src="http://www.classicwow.co.kr/data/file/finder/<?php echo  $list[$i]['bf_file'] ?>"/>
            <h1 class="desc"><?php echo $list[$i]['wr_subject']?></h1>
            </a>
        </li>
        
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li class="empty_li">게시물이 없습니다.</li>
    <?php }  ?>
    </ul>

</div>
<?php if (count($list)) { //게시물이 있다면 ?>
<script>
    $('.wow_banner ul').bxSlider({
        auto: true,
        speed: 1000,
        pause: 5000,
        hideControlOnEnd: false,
        autoControls:false,
        pager:false,
        // adaptiveHeight: true,
        caption:true,
        nextText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        prevText: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
    });
</script>
<?php } ?>