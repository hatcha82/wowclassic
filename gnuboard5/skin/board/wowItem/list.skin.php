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
var  classList = [
  {classId: 0   , name: "소모품"}
, {classId: 1   , name: "컨테이너"}
, {classId: 2   , name: "무기"}
// , {classId: 3   , name: "Gem"} 보적
, {classId: 4   , name: "방어구"}
, {classId: 5   , name: "재료"}
, {classId: 6   , name: "발사체"}
, {classId: 7   , name: "상품(거래가능)"}
// , {classId: 8   , name: "Generic(OBSOLETE)"}
, {classId: 9   , name: "조리법/도안/고서"}
// , {classId: 10	, name: "Money(OBSOLETE)"}
, {classId: 11	, name: "통, 화살집"}
, {classId: 12	, name: "퀘스트"}
, {classId: 13	, name: "키"}
// , {classId: 14	, name: "Permanent(OBSOLETE)"}
// , {classId: 15	, name: "잡화"}
// , {classId: 16	, name: "직업"}
]
var subClassList = [
  // { classId :0	 ,  subClassId : 0	, name :  "Consumable	Usability in combat is decided by the spell assigned."} 
// , { classId :0	 ,  subClassId : 1	, name :  "Potion"}
// , { classId :0	 ,  subClassId : 2	, name :  "Elixir"}
  { classId :0	 ,  subClassId : 3	, name :  "물약/비약/영약"}	
, { classId :0	 ,  subClassId : 4	, name :  "두루마리"}	
, { classId :0	 ,  subClassId : 5	, name :  "음식/음료/붕대"}	
// , { classId :0	 ,  subClassId : 6	, name :  "생명석"}	
// , { classId :0	 ,  subClassId : 7	, name :  "Bandage"}	
, { classId :0	 ,  subClassId : 8	, name :  "기타"}	
, { classId :1	 ,  subClassId : 0	, name :  "가방"}	
, { classId :1	 ,  subClassId : 1	, name :  "영혼 가방"}	
, { classId :1	 ,  subClassId : 2	, name :  "약초 가방"}	
, { classId :1	 ,  subClassId : 3	, name :  "마법 부여 가방"}	
// , { classId :1	 ,  subClassId : 4	, name :  "기계공학 가방"}	
// , { classId :1	 ,  subClassId : 5	, name :  "Gem Bag"}	
// , { classId :1	 ,  subClassId : 6	, name :  "Mining Bag"}	
// , { classId :1	 ,  subClassId : 7	, name :  "Leatherworking Bag"}	
, { classId :2	 ,  subClassId : 0	, name :  "도끼"}
, { classId :2	 ,  subClassId : 1	, name :  "양손 도끼"}
, { classId :2	 ,  subClassId : 2	, name :  "활"}	
, { classId :2	 ,  subClassId : 3	, name :  "총"}	
, { classId :2	 ,  subClassId : 18 , name :  "석궁"}	
, { classId :2	 ,  subClassId : 4	, name :  "둔기"}
, { classId :2	 ,  subClassId : 5	, name :  "양손 둔기"}
, { classId :2	 ,  subClassId : 6	, name :  "장창"}	
, { classId :2	 ,  subClassId : 7	, name :  "검"}
, { classId :2	 ,  subClassId : 8	, name :  "양손 검"}
, { classId :2	 ,  subClassId : 15 , name :  "단검"}	
// , { classId :2	 ,  subClassId : 9	, name :  "Obsolete"}	
, { classId :2	 ,  subClassId : 10 , name :  "지팡이"}	
, { classId :2	 ,  subClassId : 19 , name :  "마법봉"}	

, { classId :2	 ,  subClassId : 16 , name :  "투척 무기"}
//, { classId :2	 ,  subClassId : 11 , name :  "Exotic"}	
// , { classId :2	 ,  subClassId : 12 , name :  "Exotic"}	
, { classId :2	 ,  subClassId : 13 , name :  "장착 무기"}	
, { classId :2	 ,  subClassId : 14 , name :  "그외 무기(전문기술)"}


// , { classId :2	 ,  subClassId : 17 , name :  "Spear"}	


, { classId :2	 ,  subClassId : 20 , name :  "낚싯대"}
, { classId :3	 ,  subClassId : 0	, name :  "Red"}	
, { classId :3	 ,  subClassId : 1	, name :  "Blue"}	
, { classId :3	 ,  subClassId : 2	, name :  "Yellow"}	
, { classId :3	 ,  subClassId : 3	, name :  "Purple"}
, { classId :3	 ,  subClassId : 4	, name :  "Green"}	
, { classId :3	 ,  subClassId : 5	, name :  "Orange"}	
, { classId :3	 ,  subClassId : 6	, name :  "Meta"}	
, { classId :3	 ,  subClassId : 7	, name :  "Simple"}	
, { classId :3	 ,  subClassId : 8	, name :  "Prismatic"}	

, { classId :4	 ,  subClassId : 1	, name :  "천"}	
, { classId :4	 ,  subClassId : 2	, name :  "가죽"}	
, { classId :4	 ,  subClassId : 3	, name :  "사슬"}	
, { classId :4	 ,  subClassId : 4	, name :  "판금"}	
// , { classId :4	 ,  subClassId : 5	, name :  "Buckler(OBSOLETE)"}
, { classId :4	 ,  subClassId : 6	, name :  "방패"}	
, { classId :4	 ,  subClassId : 7	, name :  "성서"}
, { classId :4	 ,  subClassId : 8	, name :  "우상"}
, { classId :4	 ,  subClassId : 9	, name :  "토템"}	
, { classId :4	 ,  subClassId : 0	, name :  "잡화"}	
// , { classId :5	 ,  subClassId : 0	, name :  "Reagent"}	
// , { classId :6	 ,  subClassId : 0	, name :  "Wand(OBSOLETE)"}	
// , { classId :6	 ,  subClassId : 1	, name :  "Bolt(OBSOLETE)"}	
, { classId :6	 ,  subClassId : 2	, name :  "화살"}	
, { classId :6	 ,  subClassId : 3	, name :  "탄환"}	
//, { classId :6	 ,  subClassId : 4	, name :  "Thrown(OBSOLETE)"}	
, { classId :7	 ,  subClassId : 0	, name :  "거래가능"}	
, { classId :7	 ,  subClassId : 1	, name :  "부품"}	
, { classId :7	 ,  subClassId : 2	, name :  "폭약/폭탄"}	
, { classId :7	 ,  subClassId : 3	, name :  "장치"}	
//, { classId :7	 ,  subClassId : 4	, name :  "Jewelcrafting"}	
// , { classId :7	 ,  subClassId : 5	, name :  "천"}	
// , { classId :7	 ,  subClassId : 6	, name :  "가죽"}	
// , { classId :7	 ,  subClassId : 7	, name :  "Metal & Stone"}	
// , { classId :7	 ,  subClassId : 8	, name :  "Meat"}	
, { classId :7	 ,  subClassId : 9	, name :  "약초"}	
// , { classId :7	 ,  subClassId : 10 , name :  "Elemental"}
//, { classId :7	 ,  subClassId : 11 , name :  "Other"}	
// , { classId :7	 ,  subClassId : 12 , name :  "Enchanting"	}
// , { classId :8	 ,  subClassId : 0	, name :  "Generic(OBSOLETE)"}	
//, { classId :9	 ,  subClassId : 0	, name :  "책"	}
, { classId :9	 ,  subClassId : 1	, name :  "가죽세공"	}
, { classId :9	 ,  subClassId : 2	, name :  "재봉"}	
, { classId :9	 ,  subClassId : 3	, name :  "기계공학"}	
, { classId :9	 ,  subClassId : 4	, name :  "대장기술"}	
, { classId :9	 ,  subClassId : 5	, name :  "요리"}	
, { classId :9	 ,  subClassId : 6	, name :  "연금술"}	
, { classId :9	 ,  subClassId : 7	, name :  "응급치료"}	
, { classId :9	 ,  subClassId : 8	, name :  "마법부여"}
, { classId :9	 ,  subClassId : 9	, name :  "낚시"}	
// , { classId :9	 ,  subClassId : 10 , name :  "Jewelcrafting"}	
// , { classId :10	 ,  subClassId :0	, name :  "Money(OBSOLETE)"}	
// , { classId :11	 ,  subClassId :0	, name :  "Quiver(OBSOLETE)"}	
// , { classId :11	 ,  subClassId :1	, name :  "Quiver(OBSOLETE)"}
, { classId :11	 ,  subClassId :2	, name :  "화살통"}
, { classId :11	 ,  subClassId :3	, name :  "탄약통"}
, { classId :12	 ,  subClassId :0	, name :  "퀘스트"}	
, { classId :13	 ,  subClassId :0	, name :  "키"}	
//, { classId :13	 ,  subClassId :1	, name :  "Lockpick"}	
// , { classId :14	 ,  subClassId :0	, name :  "Permanent"}	
// , { classId :15	 ,  subClassId :0	, name :  "쓰래기"}	
// , { classId :15	 ,  subClassId :1	, name :  "재료"}	
//, { classId :15	 ,  subClassId :2	, name :  "Pet"}	
// , { classId :15	 ,  subClassId :3	, name :  "Holiday"}	
// , { classId :15	 ,  subClassId :4	, name :  "Other"}	
// , { classId :15	 ,  subClassId :5	, name :  "Mount"}
, { classId :16	 ,  subClassId :1	, name :  "Warrior"}	
, { classId :16	 ,  subClassId :2	, name :  "Paladin"}	
, { classId :16	 ,  subClassId :3	, name :  "Hunter"}	
, { classId :16	 ,  subClassId :4	, name :  "Rogue"}	
, { classId :16	 ,  subClassId :5	, name :  "Priest"}	
, { classId :16	 ,  subClassId :6	, name :  "Death Knight"}
, { classId :16	 ,  subClassId :7	, name :  "Shaman"}	
, { classId :16	 ,  subClassId :8	, name :  "Mage"}	
, { classId :16	 ,  subClassId :9	, name :  "Warlock"}	
, { classId :16	 ,  subClassId :11	, name :  "Druid"}	
]
var InventoryTypeList = 
[
  {InventoryType: 1	, name: "머리"}
, {InventoryType: 2	, name: "목"}
, {InventoryType: 3	, name: "어깨"}
, {InventoryType: 4	, name: "셔츠"}
, {InventoryType: 5	, name: "가슴"}
, {InventoryType: 6	, name: "허리"}
, {InventoryType: 7	, name: "다리"}
, {InventoryType: 8	, name: "발"}
, {InventoryType: 9	, name: "손목"}
, {InventoryType: 10	, name: "손"}
, {InventoryType: 11	, name: "반지"}
, {InventoryType: 12	, name: "장신구"}
, {InventoryType: 13	, name: "무기"}
, {InventoryType: 14	, name: "방패"}
, {InventoryType: 15	, name: "활"}
, {InventoryType: 16	, name: "등"}
, {InventoryType: 17	, name: "양손"}
, {InventoryType: 18	, name: "가방"}
, {InventoryType: 19	, name: "휘장"}
, {InventoryType: 20	, name: "로브"}
, {InventoryType: 21	, name: "주장비"}
, {InventoryType: 22	, name: "보조 장비 무기"}
, {InventoryType: 23	, name: "보조장비"}
, {InventoryType: 24	, name: "탄"}
, {InventoryType: 25	, name: "투척 무기"}
, {InventoryType: 26	, name: "원거리 장비" }
, {InventoryType: 27	, name: "통, 화살집"}
,   {InventoryType: 0	, name: "기타"}
// , {InventoryType: 28	, name: "Relic"} 유물
]
var RequiredLevelList =
[
, {RequiredLevel: "1-10" ,  name:  "0 - 10"}    
, {RequiredLevel: "10-20" , name: "10 - 20"}    
, {RequiredLevel: "20-30" , name: "20 - 30"}    
, {RequiredLevel: "30-40" , name: "30 - 40"}    
, {RequiredLevel: "40-50" , name: "40 - 50"} 
, {RequiredLevel: "50-60" , name: "50 - 60"} 
, {RequiredLevel: "60-100" , name: "60 - 100"}    

]
var AllowableClassList = 
[
        {AllowableClass :"1024" , name : "드루이드", color: '#ff7c0a'}
    ,   {AllowableClass :"4"  , name : "사냥꾼", color: '#7c9953 '}
    ,   {AllowableClass :"128"  , name : "마법사", color: '#4f98b3'}
    ,   {AllowableClass :"2"  , name : "성기사", color: '#cc749c '}
    ,   {AllowableClass :"16"  , name : "사제", color: 'gray'}
    ,   {AllowableClass :"8"  , name : "도적", color: '#99933f'}
    ,   {AllowableClass :"64"  , name : "주술사", color: '#2359ff'}
    ,   {AllowableClass :"256"  , name : "흑마법사", color: '#9382c9'}
    ,   {AllowableClass :"1"  , name : "전사", color: '#997854'}
]
var QualityList = 
[
        { Quality : 0 	, name : "하급" ,color:'#9d9d9d'}
    ,   { Quality : 1 	, name : "일반" ,color:'#fff'}
    ,   { Quality : 2 	, name : "고급" ,color:'#1eff00'}
    ,   { Quality : 3 	, name : "희귀" ,color:'#0070dd'}
    ,   { Quality : 4 	, name : "영웅" ,color:'#9345ff'}
    ,   { Quality : 5 	, name : "전설" ,color:'#ff8000'}
    //,   { Quality : 6 	, name : "유물"}
]
var bondingList =[
        {bonding : 1 , name:'획득시'}
    ,   {bonding : 2 , name:'착용시'}
    ,   {bonding : 3 , name:'사용시'}
    ,   {bonding : 4 , name:'퀘스트'}    
]
// ,   { Material :  4	 , ""} Jewelry
var MeterialList = [
    { Material :  1	 , name : "철"} 
,   { Material :  2	 , name : "목재"} 
,   { Material :  3	 , name : "액체"} 
,   { Material :  5	 , name : "사슬"} 
,   { Material :  6	 , name : "판금"} 
,   { Material :  7	 , name : "천"} 
,   { Material :  8	 , name : "가죽"} 
];

function createOptions(id , list, keyName,selectedItem){
    $("#"+ id).html('')
    var option = `<option value="">선택</option>`
    $("#" + id).append(option)
    list.forEach(function(obj){
        var style = '';
        if(obj['color']){
            style +=`color:${obj['color']};`;
        }
        var option = `<option value="${obj[keyName]}" style="${style}">${obj.name}</option>`
        
        if(selectedItem != '' && selectedItem == obj[keyName]){
            option = `<option value="${obj[keyName]}" style="${style}" selected>${obj.name}</option>`
        }
        $("#" + id).append(option)
    })
}
function createSubClassOption(selectedClass,selectedValue){    
        var classFiltered = subClassList.filter(function(data){
	        return data.classId == selectedClass
        })
        $("#subClassSelect")
        $("#subClassSelect").html('')
        createOptions('subClassSelect' , classFiltered, 'subClassId', `${selectedValue}`)
}
function reset_item_search(){
    createOptions('classSelect' , classList, 'classId' ,'')
    createSubClassOption('','');    
    createOptions('InventoryTypeSelect' , InventoryTypeList, 'InventoryType', '')
    createOptions('RequiredLevelSelect' , RequiredLevelList, 'RequiredLevel','')
    createOptions('AllowableClassSelect' , AllowableClassList, 'AllowableClass','')
    createOptions('QualitySelect' , QualityList, 'Quality','')
    createOptions('bondingSelect' , bondingList, 'bonding','')
    createOptions('MeterialSelect' , MeterialList, 'Material','')
    

}
$( window ).load(function() {
  var list = [];
  $('a').each(function(idx, tag){
      var $tag = $(tag);
      if($tag.attr('href').indexOf('https://ko.classic.wowhead.com/item') != -1 ){
        var name = $tag.find('span').text()
        var id = $tag.attr('href').replace('https://ko.classic.wowhead.com/item=','');
          var obj = { entry : id, name : name}
          list.push(obj);
      }
  })
  //console.log(list);
});
$( document ).ready(function() {

    
    createOptions('classSelect' , classList, 'classId' ,'<?php echo $_GET['class']?>')
    createSubClassOption('<?php echo $_GET['class']?>','<?php echo $_GET['subclass']?>');    
    createOptions('InventoryTypeSelect' , InventoryTypeList, 'InventoryType', '<?php echo $_GET['InventoryType']?>')
    createOptions('RequiredLevelSelect' , RequiredLevelList, 'RequiredLevel','<?php echo $_GET['RequiredLevel']?>')
    createOptions('AllowableClassSelect' , AllowableClassList, 'AllowableClass','<?php echo $_GET['AllowableClass']?>')
    createOptions('QualitySelect' , QualityList, 'Quality','<?php echo $_GET['Quality']?>')
    createOptions('bondingSelect' , bondingList, 'bonding','<?php echo $_GET['bonding']?>')
    createOptions('MeterialSelect' , MeterialList, 'Material','<?php echo $_GET['Material']?>')
    
    
    $("#classSelect").change(function(e){
        var selectedValue = this.value;
        createSubClassOption(selectedValue,'');
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
        <style>
        #bo_sch {color:#eee;width:100%}
        #bo_sch label{float:left;display:block;line-height:36px;width:60px;padding:0 5px;}
        #bo_sch select{width:100px;border: 1px solid #444;}
        #bo_sch button.sch_btn{float:right;margin-right:10px;border:1px solid #444;padding:0 20px;width:120px;height:30px;}
        </style>
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
        <div style="width:100%">
            <label for="RequiredLevelSelect">레벨</label>
            <select name="RequiredLevel" id="RequiredLevelSelect"></select>
            <label for="QualitySelect">등급</label>
            <select name="Quality" id="QualitySelect"></select>
            <label for="bondingSelect">귀속</label>
            <select name="bonding" id="bondingSelect"></select>
             <label for="InventoryTypeSelect">슬롯</label>
            <select  name="InventoryType" id="InventoryTypeSelect"></select>        
            <label for="MeterialSelect">재질</label>
            <select  name="Material" id="MeterialSelect"></select>        
            <div style="clear:both"/>
        </div>
        <div style="width:100%">
            <label for="classSelect">분류1</label>
            <select  name="class" id="classSelect"></select>
            <label for="subClassSelect">분류2</label>
            <select name="subclass"id="subClassSelect"></select>
            
            <button type="submit"  value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="" style="font-size:0.9em;"> 검색</span></button>       
            <button type="button" onclick="reset_item_search()" value="초기화" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="" style="font-size:0.9em;"> 초기화</span></button>       
            <div style="clear:both"/>
        </div>
        <div>
        
        </div>
        <div style="width:100%;">
            <label for="AllowableClassSelect">직업</label>
            <select name="AllowableClass" id="AllowableClassSelect"></select>
            <div style="clear:both"/>
        </div>
        
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
