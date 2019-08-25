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

<script>
var questTypeList = [
    {type: 1	 ,  name :   "Group"}
// ,   {type: 21    ,  name : 	"Life"}
,   {type: 41    ,  name : 	"PvP"}
,   {type: 62    ,  name : 	"Raid"}
,   {type: 81    ,  name : 	"Dungeon"}
// ,   {type: 82    ,  name : 	"World Event"} 
// ,   {type: 83    ,  name : 	"Legendary"}
// ,   {type: 84    ,  name : 	"Escort"}
// ,   {type: 85    ,  name : 	"Heroic"}
]
var zoneType2 = [
    ,   {zonId : 440  , name :""}         
    ,   {zonId : 2677 , name :""}     
    ,   {zonId : 1377 , name :""}     
    ,   {zonId : 3428 , name :""}     
    ,   {zonId : 2717 , name :""}     
    ,   {zonId : 493  , name :""}     
    ,   {zonId : 3429 , name :""}     
    ,   {zonId : 1583 , name :""}     
    ,   {zonId : 25   , name :""} 
    ,   {zonId : 139  , name :""}     
    ,   {zonId : 3456 , name :""}     
    ,   {zonId : 1519 , name :""}     
    ,   {zonId : 15   , name :""} 
    ,   {zonId : 16   , name :""} 
    ,   {zonId : 2597 , name :""}     
    ,   {zonId : 2159 , name :""}     
    ,   {zonId : 1977 , name :""}     
    ,   {zonId : 19   , name :""} 
]
var DungeonList = [
  {zoneId :2437	, name : "" ,minLevel : "9" }
,  {zoneId :719	    , name : "" ,minLevel : "10" }
,  {zoneId :718	    , name : "" ,minLevel : "11" }
,  {zoneId :1581	, name : "" ,minLevel : "14" }
,  {zoneId :209	    , name : "" ,minLevel : "16" }
,  {zoneId :331	    , name : "" ,minLevel : "21" }
,  {zoneId :717	    , name : "" ,minLevel : "16" }
// ,  {zoneId :133	    , name : "" ,minLevel : "20" }
// ,  {zoneId :1717	, name : "" ,minLevel : "20" }
,  {zoneId :796	    , name : "" ,minLevel : "25" }
,  {zoneId :1517	, name : "" ,minLevel : "35" }
,  {zoneId :722	    , name : "" ,minLevel : "28" }
,  {zoneId :1417	, name : "" ,minLevel : "38" }
// ,  {zoneId :978	    , name : "" ,minLevel : "40" }
,  {zoneId :400	    , name : "" ,minLevel : "40" }
,  {zoneId :2100	, name : "" ,minLevel : "38" }
,  {zoneId :51	    , name : "" ,minLevel : "45" }
,  {zoneId :490	    , name : "" ,minLevel : "47" }
,  {zoneId :1584	, name : "" ,minLevel : "1" }
,  {zoneId :25	    , name : "" ,minLevel : "48" }
,  {zoneId :1583	, name : "" ,minLevel : "40" }
,  {zoneId :2017	, name : "" ,minLevel : "52" }
,  {zoneId :139	    , name : "" ,minLevel : "55" }
,  {zoneId :493	    , name : "" ,minLevel : "56" }
,  {zoneId :2557	, name : "" ,minLevel : "54" }
,  {zoneId :46	    , name : "" ,minLevel : "57" }
,  {zoneId :2057	, name : "" ,minLevel : "52" }
,  {zoneId :1537	, name : "" ,minLevel : "58" }
,  {zoneId :1637	, name : "" ,minLevel : "58" }
,  {zoneId :2717	, name : "" ,minLevel : "55" }
]


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
    createRadioButton('MinLevelRadio' , MinLevelList, 'MinLevel','')
    createOptions('bondingSelect' , bondingList, 'bonding','')
    createOptions('MeterialSelect' , MeterialList, 'Material','')
    createCheckButton('bondingCheck' , bondingList, 'bonding',``)
    createCheckButton('QualityCheck' , QualityList, 'Quality','')
    createCheckButton('RequiredClassesRadio' , RequiredClassesList, 'RequiredClasses','')
    createCheckButton('stat_typeCheck' , stat_typeList, 'stat_type','')
    createCheckButton('InventoryTypeCheck' , InventoryTypeList, 'InventoryType',``)
}
var AreaLevelList = [
    {AreaLevel : 0, name : "동부왕국"}
,   {AreaLevel : 1, name : "칼림도어"}
]
$(document).load(function(){
    $("#AreaLevelRadio1 a").each(function(idx, tag){
        var $tag = $(tag);
        if($tag.text() === 'undefined'){
            $tag.parent().remove()
        }
    })
    $("#AreaLevelRadio2 a").each(function(idx, tag){
        var $tag = $(tag);
        if($tag.text() === 'undefined'){
            $tag.parent().remove()
        }
    })

})
$( document ).ready(function() {
    
    
    createRadioButton('typeRadio' , questTypeList, 'type','<?php echo $_GET['type']?>')
    createRadioButton('AreaLevelRadio' ,DungeonList, 'zoneId','<?php echo $_GET['ZoneOrSort']?>','ZoneOrSort','https://ko.classic.wowhead.com/zone')
    createRadioButton('AreaLevelRadio1' , _.where(areaList, {mapId : "0",areaId: "0"}), 'zoneId','<?php echo $_GET['ZoneOrSort']?>','ZoneOrSort','https://ko.classic.wowhead.com/zone')

    createRadioButton('AreaLevelRadio2' , _.where(areaList, {mapId : "1",areaId: "0"}), 'zoneId','<?php echo $_GET['ZoneOrSort']?>','ZoneOrSort','https://ko.classic.wowhead.com/zone')
  

    createOptions('classSelect' , classList, 'class' ,'<?php echo $_GET['class']?>')    
    createSubClassCheckButton('<?php echo $_GET['class']?>',`<?php echo is_array($_GET['subclass']) ? implode ( ",", $_GET['subclass'] ) : $_GET['subclass'];?>`); 
    
    createRadioButton('MinLevelRadio' , MinLevelList, 'MinLevel','<?php echo $_GET['MinLevel']?>')
  
    createOptions('QualitySelect' , QualityList, 'Quality','<?php echo $_GET['Quality']?>')
    createOptions('MeterialSelect' , MeterialList, 'Material','<?php echo $_GET['Material']?>')

    createCheckButton('bondingCheck' , bondingList, 'bonding',`<?php echo is_array($_GET['bonding']) ? implode ( ",", $_GET['bonding'] ) : $_GET['bonding'];?>`)
    createCheckButton('QualityCheck' , QualityList, 'Quality',`<?php echo is_array($_GET['Quality']) ? implode ( ",", $_GET['Quality'] ) : $_GET['Quality'];?>`)
    createRadioButton('RequiredClassesRadio' , RequiredClassesList, 'RequiredClasses',`<?php echo is_array($_GET['RequiredClasses']) ? implode ( ",", $_GET['RequiredClasses'] ) : $_GET['RequiredClasses'];?>`)
    createCheckButton('stat_typeCheck' , stat_typeList, 'stat_type',`<?php echo is_array($_GET['stat_type']) ? implode ( ",", $_GET['stat_type'] ) : $_GET['stat_type'];?>`)
    createCheckButton('InventoryTypeCheck' , InventoryTypeList, 'InventoryType',`<?php echo is_array($_GET['InventoryType']) ? implode ( ",", $_GET['InventoryType'] ) : $_GET['InventoryType'];?>`)
    $("#classSelect").change(function(e){
        var selectedValue = this.value;
        createSubClassCheckButton(selectedValue,'');
    })
    $('a.noneLink').click(function(e) {
        e.preventDefault();
       
    });
    $( ".tabs" ).tabs();

    $( "#zoneTab" ).tabs( "option", "active", <?php echo $_GET['zoneActiveIndex'] ?> );
    $( "#andTab" ).tabs( "option", "active",  <?php echo $_GET['andActiveIndex'] ?>);
    $( "#zoneTab" ).on( "tabsactivate", function( event, ui ) {
        var activeIndex = $( "#zoneTab" ).tabs( "option", "active" );
        $("#zoneActiveIndex").val(activeIndex)
    } );
    $( "#andTab").on( "tabsactivate", function( event, ui ) {
        var activeIndex = $( "#andTab" ).tabs( "option", "active" );
        $("#andActiveIndex").val(activeIndex)
    } );
    
    
    $("span.RequiredClasses").each(function(idx ,tag){
        $tag = $(tag)
        var RequiredClasses = parseInt($tag.text());
        var classObj= $.map(RequiredClassesList,function(obj){		
            if(obj.RequiredClasses == RequiredClasses) return obj;
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
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>

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
    <!-- <?php if ($is_category) { ?>
        <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul" style="display:none">    

        <?php for ($i=0; $i<count($categories); $i++) {?>
        <?php $category = trim($categories[$i]); ?>     
            <li style="cursor:pointer" onclick='window.location="<?php echo G5_BBS_URL.'/board.php?bo_table='. $bo_table ."&amp;sca=". urlencode($category); ?>"' >              
                 <a style="pointer-events: none;cursor: default;" target="_blank" href="https://ko.classic.wowhead.com/zone=<?php echo $category; ?>">
                </a>  
            </li>
        <?php }?>
        </ul>
        
    } -->
        
        <!-- <ul id="bo_cate_ul">
            <?php // echo $category_option ?>
        </ul> -->
    </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->
 <!-- 게시판 검색 시작 { -->
    <fieldset id="bo_sch">
        <legend>게시물 검색</legend>

        <form name="fsearch" method="get">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sop" value="and">
        <input type="hidden" name="quest" value="true">
        <input type="hidden" id="zoneActiveIndex" name="zoneActiveIndex" value="">
        <input type="hidden"  id="andActiveIndex" name="andActiveIndex" value="">

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
        
        <div id="zoneTab" class="tabs" style="margin-bottom:10px">
            <ul>
                <li><a href="#tabs-4">동부왕국</a></li>
                <li><a href="#tabs-5">칼림도어</a></li>
                <li><a href="#tabs-6">던전</a></li>
            </ul>
            <div id="tabs-4">
                <div class="search_group">
                    <span for="AreaLevelRadio1"></span>
                    <div  id="AreaLevelRadio1"></div>
                </div>
            </div>
            <div id="tabs-5">
                <div class="search_group">
                    <span for="AreaLevelRadio2"></span>
                    <div  id="AreaLevelRadio2"></div>
                </div>
            </div>
            <div id="tabs-6">
                <div class="search_group">
                    <span for="AreaLevelRadio"></span>
                    <div  id="AreaLevelRadio"></div>
                </div>
            </div>
        </div>
        <div id="andTab" class="tabs" style="margin-bottom:10px">
            <ul>
                <li><a href="#tabs-1">레벨</a></li>
                <li><a href="#tabs-2">직업</a></li>
                <li><a href="#tabs-3">유형</a></li>
            </ul>
            <div id="tabs-1">
                <div class="search_group">
                    <span for="MinLevelRadio"></span>
                    <div  id="MinLevelRadio"></div>
                </div>
            </div>
            <div id="tabs-2">
                <div class="search_group">
                    <span for="RequiredClassesRadio"></span><Br/>
                    <div id="RequiredClassesRadio"></div>
                </div>
            </div>
            <div id="tabs-3">
                <div class="search_group">
                    <span for="typeRadio"></span>
                    <div  id="typeRadio"></div>
                </div>
            </div>
        </div>

        
       
        
        
        
        <!-- <div class="search_group">
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
        </div> -->
       
        <div style="display:none">

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
             <span for="stat_typeCheck">스탯</span><Br/>
            <div id="stat_typeCheck"></div>
            <div style="clear:both"></div>
        </div>
        <div class="search_group">
            <span for="InventoryTypeCheck">슬롯</span><Br/>
            <div id="InventoryTypeCheck"></div>
            <div style="clear:both"></div>
        </div>
        </div>
        <button type="submit"  value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="" style="font-size:0.9em;"> 검색</span></button>       
            <button type="button" onclick="reset_item_search()" value="초기화" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="" style="font-size:0.9em;"> 초기화</span></button>       
        </form>
    </fieldset>
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
    <input type="hidden" name="quest" value="true">
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
            <th scope="col">진영</th>
            <th scope="col">제목</th>
            <th scope="col" >필요</th>
            <th scope="col" >보상</th>
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
            <td>
            <?php echo get_available_camp($list[$i]['RequiredRaces'])?>
            
            </td>
            <td class="td_subject" style="padding-left:<?php echo $list[$i]['reply'] ? (strlen($list[$i]['wr_reply'])*10) : '0'; ?>px">
                <ul>
                <?php
                if ($is_category && $list[$i]['ca_name']) {
                 ?>
                <?php if($list[$i]['ZoneOrSort'] > 0) {?>

                <li style="font-size:1.2em">[<a href='<?php echo $list[$i]['ca_name_href'] ?>' class="">
                <a style="pointer-events: none;cursor: default;" target="_blank" href="https://ko.classic.wowhead.com/zone=<?php echo $list[$i]['ZoneOrSort'] ?>"></a> 
                </a>]
                
                <?php }?>
                
                <!-- 지역 <span><?php echo $list[$i]['ZoneOrSort'] ?></span> -->
                
                <span class="RequiredRaces"><?php echo get_available_race($list[$i]['RequiredRaces'])?></span>
                 <span class="RequiredClasses"><?php echo $list[$i]['RequiredClasses']?></span>
                </li>
                <?php } ?>
                <?php if ($list[$i]['PrevQuestId'] > 0 ) {?>
                    <li style="font-size:0.8em">
                    </li>
                <?php } ?>
                <?php $href=$list[$i]['href'];?>
                <!-- <div class="bo_tit" > -->
                        <?php
                            if (isset($list[$i]['icon_secret'])) echo rtrim($list[$i]['icon_secret']);
                         ?>
                         <li>
                        <a style="color:#47aef3;font-size:1.1em" target="_blank"  href="https://ko.classic.wowhead.com/quest=<?php echo $list[$i]['wr_id'] ?>"></a>                       
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
                    <li style="font-size:0.8em">
                    퀘스트 레벨: <?php echo $list[$i]['QuestLevel'] ?>, 최소 레벨:  <?php echo $list[$i]['MinLevel'] ?> 
                    </li>
                    <?php if ($list[$i]['NextQuestId'] > 0 ) {?>                   
                    <li style="font-size:0.8em">
                    다음 퀘스트: <a style="" target="_blank"  href="https://ko.classic.wowhead.com/quest=<?php echo $list[$i]['NextQuestId'] ?>"></a>   
                    </li>
                    <?php } ?>
                <ul>
            </td>
            
            <td>
                <ul>
                <?php if ($list[$i]['ReqItemId1'] + $list[$i]['ReqItemId2'] + $list[$i]['ReqItemId3']+ $list[$i]['ReqItemId4']> 0 ){?>수집<?php }?>
                <?php if ($list[$i]['ReqItemId1'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/item=". $list[$i]['ReqItemId1'] . "'/></a>(".$list[$i]['ReqItemCount1'].")</li>"; ?>
                <?php if ($list[$i]['ReqItemId2'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/item=". $list[$i]['ReqItemId2'] . "'/></a>(".$list[$i]['ReqItemCount2'].")</li>"; ?>
                <?php if ($list[$i]['ReqItemId3'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/item=". $list[$i]['ReqItemId3'] . "'/></a>(".$list[$i]['ReqItemCount3'].")</li>"; ?>
                <?php if ($list[$i]['ReqItemId4'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/item=". $list[$i]['ReqItemId4'] . "'/></a>(".$list[$i]['ReqItemCount4'].")</li>"; ?>
                </ul>
                <ul>
                <?php if ($list[$i]['ReqCreatureOrGOId1'] + $list[$i]['ReqCreatureOrGOId2'] + $list[$i]['ReqCreatureOrGOId3']+ $list[$i]['ReqCreatureOrGOId4']> 0 ){?>처치<?php }?>
                <?php if ($list[$i]['ReqCreatureOrGOId1'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/npc=". $list[$i]['ReqCreatureOrGOId1'] . "'/></a>(".$list[$i]['ReqCreatureOrGOCount1'].")</li>"; ?>
                <?php if ($list[$i]['ReqCreatureOrGOId2'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/npc=". $list[$i]['ReqCreatureOrGOId2'] . "'/></a>(".$list[$i]['ReqCreatureOrGOCount1'].")</li>"; ?>
                <?php if ($list[$i]['ReqCreatureOrGOId3'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/npc=". $list[$i]['ReqCreatureOrGOId3'] . "'/></a>(".$list[$i]['ReqCreatureOrGOCount1'].")</li>"; ?>
                <?php if ($list[$i]['ReqCreatureOrGOId4'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/npc=". $list[$i]['ReqCreatureOrGOId4'] . "'/></a>(".$list[$i]['ReqCreatureOrGOCount1'].")</li>"; ?>
                </ul>
            </td>
            <td>
                <ul>
                    <?php if ($list[$i]['RewItemId1'] + $list[$i]['RewItemId2'] + $list[$i]['RewItemId3']+ $list[$i]['RewItemId4']> 0 ){?>기본 보상<?php }?>
                    <?php if ($list[$i]['RewItemId1'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/item=". $list[$i]['RewItemId1'] . "'/></a>(".$list[$i]['RewItemCount1'].")</li>"; ?>
                    <?php if ($list[$i]['RewItemId2'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/item=". $list[$i]['RewItemId2'] . "'/></a>(".$list[$i]['RewItemCount2'].")</li>"; ?>
                    <?php if ($list[$i]['RewItemId3'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/item=". $list[$i]['RewItemId3'] . "'/></a>(".$list[$i]['RewItemCount3'].")</li>"; ?>
                    <?php if ($list[$i]['RewItemId4'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/item=". $list[$i]['RewItemId4'] . "'/></a>(".$list[$i]['RewItemCount4'].")</li>"; ?>
                </ul>
                <ul>
                    <?php if ($list[$i]['RewChoiceItemId1'] + 
                              $list[$i]['RewChoiceItemId2'] + 
                              $list[$i]['RewChoiceItemId3'] +
                              $list[$i]['RewChoiceItemId4'] +
                              $list[$i]['RewChoiceItemId5'] + 
                              $list[$i]['RewChoiceItemId6']> 0 ){?>선택 보상<?php }?>
                    <?php if ($list[$i]['RewChoiceItemId1'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/item=". $list[$i]['RewChoiceItemId1'] . "'/></a>(".$list[$i]['RewChoiceItemCount1'].")</li>"; ?>
                    <?php if ($list[$i]['RewChoiceItemId2'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/item=". $list[$i]['RewChoiceItemId2'] . "'/></a>(".$list[$i]['RewChoiceItemCount2'].")</li>"; ?>
                    <?php if ($list[$i]['RewChoiceItemId3'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/item=". $list[$i]['RewChoiceItemId3'] . "'/></a>(".$list[$i]['RewChoiceItemCount3'].")</li>"; ?>
                    <?php if ($list[$i]['RewChoiceItemId4'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/item=". $list[$i]['RewChoiceItemId4'] . "'/></a>(".$list[$i]['RewChoiceItemCount4'].")</li>"; ?>
                    <?php if ($list[$i]['RewChoiceItemId5'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/item=". $list[$i]['RewChoiceItemId5'] . "'/></a>(".$list[$i]['RewChoiceItemCount5'].")</li>"; ?>
                    <?php if ($list[$i]['RewChoiceItemId6'] > 0 ) echo "<li><a href='https://ko.classic.wowhead.com/item=". $list[$i]['RewChoiceItemId6'] . "'/></a>(".$list[$i]['RewChoiceItemCount6'].")</li>"; ?>
                </ul>
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
