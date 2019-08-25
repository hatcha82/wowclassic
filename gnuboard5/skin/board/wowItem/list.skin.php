<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<link rel="stylesheet" href="/jquery.multiselect/jquery.multiselect.css" />
<script type="text/javascript" src="/jquery.multiselect/jquery.multiselect.js"></script>

<script>

function createSubClassCheckButton(selectedClass,selectedValue){   
        var classFiltered = subClassList.filter(function(data){
	        return data.class == selectedClass
        })
        $("#subClassCheck")
        $("#subClassCheck").html('')
        createCheckButton('subClassCheck' , classFiltered, 'subclass', `${selectedValue}`)
}
function reset_item_search(){
    createOptions('classSelect' , classList, 'class' ,'')
    createSubClassCheckButton('','');    
    createRadioButton('RequiredLevelRadio' , RequiredLevelList, 'RequiredLevel','')
    createOptions('bondingSelect' , bondingList, 'bonding','')
    createOptions('MeterialSelect' , MeterialList, 'Material','')
    createCheckButton('bondingCheck' , bondingList, 'bonding',``)
    createCheckButton('QualityCheck' , QualityList, 'Quality','')
    createCheckButton('AllowableClassCheck' , AllowableClassList, 'AllowableClass','')
    createCheckButton('stat_typeCheck' , stat_typeList, 'stat_type','')
    createCheckButton('InventoryTypeCheck' , InventoryTypeList, 'InventoryType',``)
}

$( document ).ready(function() {
    
    createOptions('classSelect' , classList, 'class' ,'<?php echo $_GET['class']?>')    
    createSubClassCheckButton('<?php echo $_GET['class']?>',`<?php echo is_array($_GET['subclass']) ? implode ( ",", $_GET['subclass'] ) : $_GET['subclass'];?>`); 
    
    createRadioButton('RequiredLevelRadio' , RequiredLevelList, 'RequiredLevel','<?php echo $_GET['RequiredLevel']?>')
  
    createOptions('QualitySelect' , QualityList, 'Quality','<?php echo $_GET['Quality']?>')
    createOptions('MeterialSelect' , MeterialList, 'Material','<?php echo $_GET['Material']?>')

    createCheckButton('bondingCheck' , bondingList, 'bonding',`<?php echo is_array($_GET['bonding']) ? implode ( ",", $_GET['bonding'] ) : $_GET['bonding'];?>`)
    createCheckButton('QualityCheck' , QualityList, 'Quality',`<?php echo is_array($_GET['Quality']) ? implode ( ",", $_GET['Quality'] ) : $_GET['Quality'];?>`)
    createCheckButton('AllowableClassCheck' , AllowableClassList, 'AllowableClass',`<?php echo is_array($_GET['AllowableClass']) ? implode ( ",", $_GET['AllowableClass'] ) : $_GET['AllowableClass'];?>`)
    createCheckButton('stat_typeCheck' , stat_typeList, 'stat_type',`<?php echo is_array($_GET['stat_type']) ? implode ( ",", $_GET['stat_type'] ) : $_GET['stat_type'];?>`)
    createCheckButton('InventoryTypeCheck' , InventoryTypeList, 'InventoryType',`<?php echo is_array($_GET['InventoryType']) ? implode ( ",", $_GET['InventoryType'] ) : $_GET['InventoryType'];?>`)
    $("#classSelect").change(function(e){
        var selectedValue = this.value;
        createSubClassCheckButton(selectedValue,'');
    })

    $("td.AllowableClass").each(function(idx ,tag){
        $tag = $(tag)
        var AllowableClass = parseInt($tag.text());
        var classObj= $.map(AllowableClassList,function(obj){		
            if(obj.AllowableClass == AllowableClass) return obj;
        })[0];
        if(classObj){
            var html = `<span style="color:${classObj.color}">${classObj.name}</span>`
        }else{
            var html ='';
        }

        $tag.html(html)
    })
    
});
</script>


<!-- 게시판 목록 시작 { -->


<div id="bo_list" style="width:<?php echo $width; ?>">


    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
       

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01 btn"><i class="fa fa-rss" aria-hidden="true"></i> RSS</a></li><?php } ?>
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn"><i class="fa fa-user-circle" aria-hidden="true"></i> 관리자</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02 btn"><i class="fa fa-pencil" aria-hidden="true"></i> 글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">    
        <?php for ($i=0; $i<count($categories); $i++) {?>
        <?php $category = trim($categories[$i]); ?>     
            <li style="cursor:pointer" onclick='window.location="<?php echo G5_BBS_URL.'/board.php?bo_table='. $bo_table ."&amp;sca=". urlencode($category); ?>"' >              
                 <a style="pointer-events: none;cursor: default;" target="_blank" href="https://ko.classic.wowhead.com/zone=<?php echo $category; ?>">
                </a>  
            </li>
        <?php }?>
        </ul>
        
    }
        
        <!-- <ul id="bo_cate_ul">
            <?php // echo $category_option ?>
        </ul> -->
    </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->
    <!-- 게시판 검색 시작 { -->
        <fieldset id="bo_sch" >
        <legend>게시물 검색</legend>
        <form name="fsearch" method="get">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sop" value="and">
        <input type="hidden" name="item" value="true">
        
        <label for="sfl" class="sound_only">검색대상</label>
        <div style="display:none">
            <select name="sfl" id="sfl">
                <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
                <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
                <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
                <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
                <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
                <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
                <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>
            </select>
            <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" class="sch_input" size="25" maxlength="20" placeholder="검색어를 입력해주세요">
        </div>
        <div class="search_group">
            <span for="RequiredLevelRadio">레벨</span>
            <div  id="RequiredLevelRadio"></div>
        </div>
        <div class="search_group">
            <label for="classSelect">분류1</label>
            <select  name="class" id="classSelect"></select>
            <label for="MeterialSelect">재질</label>
            <select  name="Material" id="MeterialSelect"></select>        
            <div style="clear:both"></div>
            <div style="clear:both"></div>
            <div>
            <span for="subClassCheck">분류2</span>
            <div  id="subClassCheck"></div>
            </div>
           
            <div style="clear:both"></div>
        </div>
        <div class="search_group">
            <span for="bondingCheck">귀속</span><Br/>
            <div  id="bondingCheck"></div>
            <div style="clear:both"></div>
        </div>
        <div class="search_group">
            <span for="QualityCheck">등급</span><Br/>
            <div  id="QualityCheck"></div>
            <div style="clear:both"></div>
        </div>
        <div class="search_group">
            <span for="AllowableClassCheck">직업</span><Br/>
            <div id="AllowableClassCheck"></div>
            <div style="clear:both"></div>
        </div>
        <div class="search_group">
             <span for="stat_typeCheck">스탯</span><Br/>
            <div id="stat_typeCheck"></div>
            <div style="clear:both"></div>
        </div>
        <div class="search_group">
            <span for="InventoryTypeCheck">슬롯</span><Br/>
            <div id="InventoryTypeCheck"></div>
            <div style="clear:both"></div>
        </div>
        <button type="submit"  value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="" style="font-size:0.9em;"> 검색</span></button>       
            <button type="button" onclick="reset_item_search()" value="초기화" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="" style="font-size:0.9em;"> 초기화</span></button>       
        </form>
    </fieldset>
    <div id="bo_list_total" style="margin-bottom:10px;">
        <span>Total <?php echo number_format($total_count) ?>건</span>
        <?php echo $page ?> 페이지
    </div>
    <!-- } 게시판 검색 끝 -->   
    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">
    
    <style>
        table.questList tr td{vertical-align:top; }
    </style>
    <div class="tbl_head01 tbl_wrap">
        <table class="questList">
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr>
            <?php if ($is_checkbox) { ?>
            <th scope="col">
                <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
            </th>
            <?php } ?>
            <th scope="col">번호</th>
            <th scope="col">제목</th>
            <th scope="col">직업</th>
            <th scope="col">아이템 레벨</th>
            <th scope="col">필요 레벨</th>
            
            <!--
            <th scope="col"><?php echo subject_sort_link('wr_hit', $qstr2, 1) ?>조회 <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <?php if ($is_good) { ?><th scope="col"><?php echo subject_sort_link('wr_good', $qstr2, 1) ?>추천 <i class="fa fa-sort" aria-hidden="true"></i></a></th><?php } ?>
            <?php if ($is_nogood) { ?><th scope="col"><?php echo subject_sort_link('wr_nogood', $qstr2, 1) ?>비추천 <i class="fa fa-sort" aria-hidden="true"></i></a></th><?php } ?>
            <th scope="col"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>날짜  <i class="fa fa-sort" aria-hidden="true"></i></a></th> -->
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
         ?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
            <?php if ($is_checkbox) { ?>
            <td class="td_chk">
                <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
            </td>
            <?php } ?>
            <td class="td_num2">
            <?php
            if ($list[$i]['is_notice']) // 공지사항
                echo '<strong class="notice_icon"><i class="fa fa-bullhorn" aria-hidden="true"></i><span class="sound_only">공지</span></strong>';
            else if ($wr_id == $list[$i]['wr_id'])
                echo "<span class=\"bo_current\">열람중</span>";
            else
                echo $list[$i]['num'];
             ?>
            </td>

            <td class="td_subject" style="padding-left:<?php echo $list[$i]['reply'] ? (strlen($list[$i]['wr_reply'])*10) : '0'; ?>px">
                <ul>
                <?php
                if ($is_category && $list[$i]['ca_name']) {
                 ?>
                <li>[<a href='<?php echo $list[$i]['ca_name_href'] ?>' class="">
                <a style="pointer-events: none;cursor: default;" target="_blank" href="https://ko.classic.wowhead.com/zone=<?php echo $list[$i]['ca_name'] ?>"></a> 
                </a>]
                </li>
                <?php } ?>
                <?php $href=$list[$i]['href'];?>
                <!-- <div class="bo_tit" > -->
                        <?php
                            if (isset($list[$i]['icon_secret'])) echo rtrim($list[$i]['icon_secret']);
                         ?>
                         <li>
                        <a style="color:#47aef3;font-size:1.1em" target="_blank"  href="https://ko.classic.wowhead.com/item=<?php echo $list[$i]['wr_id'] ?>"></a>                       
                        <!-- (<?php echo $list[$i][' PointX'];?> , <?php echo $list[$i][' PointY'];?>) -->
                        </li>
                        
                    <?php
                    // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }
                    
                    // if ($list[$i]['ReqItemId2'] > 0 ) echo "<a href='https://ko.classic.wowhead.com/item=". $list[$i]['ReqItemId2'] . "/></a>";
                    // if ($list[$i]['ReqItemId3'] > 0 ) echo "<a href='https://ko.classic.wowhead.com/item=". $list[$i]['ReqItemId3'] . "/></a>";
                    // if ($list[$i]['ReqItemId4'] > 0 ) echo "<a href='https://ko.classic.wowhead.com/item=". $list[$i]['ReqItemId4'] . "/></a>";    
                    
                    if (isset($list[$i]['icon_link'])) echo rtrim($list[$i]['icon_link']);
                    // if (isset($list[$i]['icon_new'])) echo rtrim($list[$i]['icon_new']);
                    if (isset($list[$i]['icon_hot'])) echo rtrim($list[$i]['icon_hot']);
                    ?>
                    <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><span class="cnt_cmt">+ <?php echo $list[$i]['wr_comment']; ?></span><span class="sound_only">개</span><?php } ?>
                <!-- </div> -->
                <ul>
            </td>
            <td align="center" class="AllowableClass">
                <?php echo $list[$i]['AllowableClass'] ?>
                <!-- AllowableClass& (1<<getClass()))) -->
            </td>
            <td align="center">
                <?php echo $list[$i]['ItemLevel'] ?>
                <!-- AllowableClass& (1<<getClass()))) -->
            </td>
            <td align="center">
                <?php echo $list[$i]['RequiredLevel'] ?>
                <!-- AllowableClass& (1<<getClass()))) -->
            </td>
            <!-- <?php
            $name = get_sideview($list[$i]['mb_id'], get_text(cut_str($list[$i]['wr_name'], $config['cf_cut_name'])), $list[$i]['wr_email'],$list[$i]['wr_homepage']);
            ?>
            
            <td class="td_num"><?php echo $list[$i]['wr_hit'] ?></td>
            <?php if ($is_good) { ?><td class="td_num"><?php echo $list[$i]['wr_good'] ?></td><?php } ?>
            <?php if ($is_nogood) { ?><td class="td_num"><?php echo $list[$i]['wr_nogood'] ?></td><?php } ?>
            <td class="td_datetime"><?php echo $list[$i]['datetime2'] ?></td> -->
                        
        </tr>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($is_checkbox) { ?>
            <li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_admin"><i class="fa fa-trash-o" aria-hidden="true"></i> 선택삭제</button></li>
            <li><button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value" class="btn btn_admin"><i class="fa fa-files-o" aria-hidden="true"></i> 선택복사</button></li>
            <li><button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value" class="btn btn_admin"><i class="fa fa-arrows" aria-hidden="true"></i> 선택이동</button></li>
            <?php } ?>
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01 btn"><i class="fa fa-list" aria-hidden="true"></i> 목록</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02 btn"><i class="fa fa-pencil" aria-hidden="true"></i> 글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>

    </form>
     
   
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>



<!-- 페이지 -->
<?php echo $write_pages;  ?>


<?php if ($is_checkbox) { ?>

<script>




function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
