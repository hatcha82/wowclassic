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
  {class: 0   , name: "소모품"}
, {class: 1   , name: "컨테이너"}
, {class: 2   , name: "무기"}
// , {class: 3   , name: "Gem"} 보적
, {class: 4   , name: "방어구"}
, {class: 5   , name: "재료"}
, {class: 6   , name: "발사체"}
, {class: 7   , name: "상품(거래가능)"}
// , {class: 8   , name: "Generic(OBSOLETE)"}
, {class: 9   , name: "조리법/도안/고서"}
// , {class: 10	, name: "Money(OBSOLETE)"}
, {class: 11	, name: "통, 화살집"}
, {class: 12	, name: "퀘스트"}
, {class: 13	, name: "키"}
// , {class: 14	, name: "Permanent(OBSOLETE)"}
// , {class: 15	, name: "잡화"}
// , {class: 16	, name: "직업"}
]
var subClassList = [
  // { class :0	 ,  subclass : 0	, name :  "Consumable	Usability in combat is decided by the spell assigned."} 
// , { class :0	 ,  subclass : 1	, name :  "Potion"}
// , { class :0	 ,  subclass : 2	, name :  "Elixir"}
  { class :0	 ,  subclass : 3	, name :  "물약/비약/영약"}	
, { class :0	 ,  subclass : 4	, name :  "두루마리"}	
, { class :0	 ,  subclass : 5	, name :  "음식/음료/붕대"}	
// , { class :0	 ,  subclass : 6	, name :  "생명석"}	
// , { class :0	 ,  subclass : 7	, name :  "Bandage"}	
, { class :0	 ,  subclass : 8	, name :  "기타"}	
, { class :1	 ,  subclass : 0	, name :  "가방"}	
, { class :1	 ,  subclass : 1	, name :  "영혼 가방"}	
, { class :1	 ,  subclass : 2	, name :  "약초 가방"}	
, { class :1	 ,  subclass : 3	, name :  "마법 부여 가방"}	
// , { class :1	 ,  subclass : 4	, name :  "기계공학 가방"}	
// , { class :1	 ,  subclass : 5	, name :  "Gem Bag"}	
// , { class :1	 ,  subclass : 6	, name :  "Mining Bag"}	
// , { class :1	 ,  subclass : 7	, name :  "Leatherworking Bag"}	
, { class :2	 ,  subclass : 0	, name :  "도끼"}
, { class :2	 ,  subclass : 1	, name :  "양손 도끼"}
, { class :2	 ,  subclass : 2	, name :  "활"}	
, { class :2	 ,  subclass : 3	, name :  "총"}	
, { class :2	 ,  subclass : 18 , name :  "석궁"}	
, { class :2	 ,  subclass : 4	, name :  "둔기"}
, { class :2	 ,  subclass : 5	, name :  "양손 둔기"}
, { class :2	 ,  subclass : 6	, name :  "장창"}	
, { class :2	 ,  subclass : 7	, name :  "검"}
, { class :2	 ,  subclass : 8	, name :  "양손 검"}
, { class :2	 ,  subclass : 15 , name :  "단검"}	
// , { class :2	 ,  subclass : 9	, name :  "Obsolete"}	
, { class :2	 ,  subclass : 10 , name :  "지팡이"}	
, { class :2	 ,  subclass : 19 , name :  "마법봉"}	

, { class :2	 ,  subclass : 16 , name :  "투척 무기"}
//, { class :2	 ,  subclass : 11 , name :  "Exotic"}	
// , { class :2	 ,  subclass : 12 , name :  "Exotic"}	
, { class :2	 ,  subclass : 13 , name :  "장착 무기"}	
, { class :2	 ,  subclass : 14 , name :  "그외 무기(전문기술)"}


// , { class :2	 ,  subclass : 17 , name :  "Spear"}	


, { class :2	 ,  subclass : 20 , name :  "낚싯대"}
, { class :3	 ,  subclass : 0	, name :  "Red"}	
, { class :3	 ,  subclass : 1	, name :  "Blue"}	
, { class :3	 ,  subclass : 2	, name :  "Yellow"}	
, { class :3	 ,  subclass : 3	, name :  "Purple"}
, { class :3	 ,  subclass : 4	, name :  "Green"}	
, { class :3	 ,  subclass : 5	, name :  "Orange"}	
, { class :3	 ,  subclass : 6	, name :  "Meta"}	
, { class :3	 ,  subclass : 7	, name :  "Simple"}	
, { class :3	 ,  subclass : 8	, name :  "Prismatic"}	

, { class :4	 ,  subclass : 1	, name :  "천"}	
, { class :4	 ,  subclass : 2	, name :  "가죽"}	
, { class :4	 ,  subclass : 3	, name :  "사슬"}	
, { class :4	 ,  subclass : 4	, name :  "판금"}	
// , { class :4	 ,  subclass : 5	, name :  "Buckler(OBSOLETE)"}
, { class :4	 ,  subclass : 6	, name :  "방패"}	
, { class :4	 ,  subclass : 7	, name :  "성서"}
, { class :4	 ,  subclass : 8	, name :  "우상"}
, { class :4	 ,  subclass : 9	, name :  "토템"}	
, { class :4	 ,  subclass : 0	, name :  "잡화"}	
// , { class :5	 ,  subclass : 0	, name :  "Reagent"}	
// , { class :6	 ,  subclass : 0	, name :  "Wand(OBSOLETE)"}	
// , { class :6	 ,  subclass : 1	, name :  "Bolt(OBSOLETE)"}	
, { class :6	 ,  subclass : 2	, name :  "화살"}	
, { class :6	 ,  subclass : 3	, name :  "탄환"}	
//, { class :6	 ,  subclass : 4	, name :  "Thrown(OBSOLETE)"}	
, { class :7	 ,  subclass : 0	, name :  "거래가능"}	
, { class :7	 ,  subclass : 1	, name :  "부품"}	
, { class :7	 ,  subclass : 2	, name :  "폭약/폭탄"}	
, { class :7	 ,  subclass : 3	, name :  "장치"}	
//, { class :7	 ,  subclass : 4	, name :  "Jewelcrafting"}	
// , { class :7	 ,  subclass : 5	, name :  "천"}	
// , { class :7	 ,  subclass : 6	, name :  "가죽"}	
// , { class :7	 ,  subclass : 7	, name :  "Metal & Stone"}	
// , { class :7	 ,  subclass : 8	, name :  "Meat"}	
, { class :7	 ,  subclass : 9	, name :  "약초"}	
// , { class :7	 ,  subclass : 10 , name :  "Elemental"}
//, { class :7	 ,  subclass : 11 , name :  "Other"}	
// , { class :7	 ,  subclass : 12 , name :  "Enchanting"	}
// , { class :8	 ,  subclass : 0	, name :  "Generic(OBSOLETE)"}	
//, { class :9	 ,  subclass : 0	, name :  "책"	}
, { class :9	 ,  subclass : 1	, name :  "가죽세공"	}
, { class :9	 ,  subclass : 2	, name :  "재봉"}	
, { class :9	 ,  subclass : 3	, name :  "기계공학"}	
, { class :9	 ,  subclass : 4	, name :  "대장기술"}	
, { class :9	 ,  subclass : 5	, name :  "요리"}	
, { class :9	 ,  subclass : 6	, name :  "연금술"}	
, { class :9	 ,  subclass : 7	, name :  "응급치료"}	
, { class :9	 ,  subclass : 8	, name :  "마법부여"}
, { class :9	 ,  subclass : 9	, name :  "낚시"}	
// , { class :9	 ,  subclass : 10 , name :  "Jewelcrafting"}	
// , { class :10	 ,  subclass :0	, name :  "Money(OBSOLETE)"}	
// , { class :11	 ,  subclass :0	, name :  "Quiver(OBSOLETE)"}	
// , { class :11	 ,  subclass :1	, name :  "Quiver(OBSOLETE)"}
, { class :11	 ,  subclass :2	, name :  "화살통"}
, { class :11	 ,  subclass :3	, name :  "탄약통"}
, { class :12	 ,  subclass :0	, name :  "퀘스트"}	
, { class :13	 ,  subclass :0	, name :  "키"}	
//, { class :13	 ,  subclass :1	, name :  "Lockpick"}	
// , { class :14	 ,  subclass :0	, name :  "Permanent"}	
// , { class :15	 ,  subclass :0	, name :  "쓰래기"}	
// , { class :15	 ,  subclass :1	, name :  "재료"}	
//, { class :15	 ,  subclass :2	, name :  "Pet"}	
// , { class :15	 ,  subclass :3	, name :  "Holiday"}	
// , { class :15	 ,  subclass :4	, name :  "Other"}	
// , { class :15	 ,  subclass :5	, name :  "Mount"}
, { class :16	 ,  subclass :1	, name :  "Warrior"}	
, { class :16	 ,  subclass :2	, name :  "Paladin"}	
, { class :16	 ,  subclass :3	, name :  "Hunter"}	
, { class :16	 ,  subclass :4	, name :  "Rogue"}	
, { class :16	 ,  subclass :5	, name :  "Priest"}	
, { class :16	 ,  subclass :6	, name :  "Death Knight"}
, { class :16	 ,  subclass :7	, name :  "Shaman"}	
, { class :16	 ,  subclass :8	, name :  "Mage"}	
, { class :16	 ,  subclass :9	, name :  "Warlock"}	
, { class :16	 ,  subclass :11	, name :  "Druid"}	
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
    //,   {bonding : 4 , name:'퀘스트'}    
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
var stat_typeList = [
      { stat_type : 0	, name : "마나"}
    , { stat_type : 1	, name : "체력"}
    , { stat_type : 3	, name : "민첩성"}
    , { stat_type : 4	, name : "힘"}
    , { stat_type : 5	, name : "지능"}
    , { stat_type : 6	, name : "정신력"}
    , { stat_type : 7	, name : "체력"}
    // , { stat_type : 12	, name : "ITEM_MOD_DEFENSE_SKILL_RATING"}
    // , { stat_type : 13	, name : "ITEM_MOD_DODGE_RATING"}
    // , { stat_type : 14	, name : "ITEM_MOD_PARRY_RATING"}
    // , { stat_type : 15	, name : "ITEM_MOD_BLOCK_RATING"}
    // , { stat_type : 16	, name : "ITEM_MOD_HIT_MELEE_RATING"}
    // , { stat_type : 17	, name : "ITEM_MOD_HIT_RANGED_RATING"}
    // , { stat_type : 18	, name : "ITEM_MOD_HIT_SPELL_RATING"}
    // , { stat_type : 19	, name : "ITEM_MOD_CRIT_MELEE_RATING"}
    // , { stat_type : 20	, name : "ITEM_MOD_CRIT_RANGED_RATING"}
    // , { stat_type : 21	, name : "ITEM_MOD_CRIT_SPELL_RATING"}
    // , { stat_type : 22	, name : "ITEM_MOD_HIT_TAKEN_MELEE_RATING"}
    // , { stat_type : 23	, name : "ITEM_MOD_HIT_TAKEN_RANGED_RATING"}
    // , { stat_type : 24	, name : "ITEM_MOD_HIT_TAKEN_SPELL_RATING"}
    // , { stat_type : 25	, name : "ITEM_MOD_CRIT_TAKEN_MELEE_RATING"}
    // , { stat_type : 26	, name : "ITEM_MOD_CRIT_TAKEN_RANGED_RATING"}
    // , { stat_type : 27	, name : "ITEM_MOD_CRIT_TAKEN_SPELL_RATING"}
    // , { stat_type : 28	, name : "ITEM_MOD_HASTE_MELEE_RATING"}
    // , { stat_type : 29	, name : "ITEM_MOD_HASTE_RANGED_RATING"}
    // , { stat_type : 30	, name : "ITEM_MOD_HASTE_SPELL_RATING"}
    // , { stat_type : 31	, name : "ITEM_MOD_HIT_RATING"}
    // , { stat_type : 32	, name : "ITEM_MOD_CRIT_RATING"}
    // , { stat_type : 33	, name : "ITEM_MOD_HIT_TAKEN_RATING"}
    // , { stat_type : 34	, name : "ITEM_MOD_CRIT_TAKEN_RATING"}
    // , { stat_type : 35	, name : "ITEM_MOD_RESILIENCE_RATING"}
    // , { stat_type : 36	, name : "ITEM_MOD_HASTE_RATING"}
    // , { stat_type : 37	, name : "ITEM_MOD_EXPERTISE_RATING"}

]

function createCheckButton(id , list, keyName,selectedItem){

    
    $("#"+ id).html('')    
    var html = '<ul class="checkButton">';

    list.forEach(function(obj){
        var style = '';
        if(obj['color']){
            style +=`color:${obj['color']};`;
        }
        var checkButton = `<input type="checkbox" name="${keyName}[]" value="${obj[keyName]}"/><span style="${style}">${obj.name}</span>`;
        if(selectedItem != '' ){
            var selectedItemArray = selectedItem.split(',');
            var key =  obj[keyName];
            var test = selectedItemArray.filter(function(item){
                return item == key;
            })
            
            if(test.length == 1){
                checkButton = `<input type="checkbox" name="${keyName}[]" value="${obj[keyName]}" checked/><span style="${style}">${obj.name}</span>`;
            }
             
        }
        html+=`<li>${checkButton}</li>`;
    })
    html += '</ul>';
    $("#" + id).append(html)
}
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
    createOptions('RequiredLevelSelect' , RequiredLevelList, 'RequiredLevel','')
    createOptions('bondingSelect' , bondingList, 'bonding','')
    createOptions('MeterialSelect' , MeterialList, 'Material','')
    createCheckButton('bondingCheck' , bondingList, 'bonding',``)
    createCheckButton('QualityCheck' , QualityList, 'Quality','')
    createCheckButton('AllowableClassCheck' , AllowableClassList, 'AllowableClass','')
    createCheckButton('stat_typeCheck' , stat_typeList, 'stat_type','')
    createCheckButton('InventoryTypeCheck' , InventoryTypeList, 'InventoryType',``)

    
    

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
    
    createOptions('classSelect' , classList, 'class' ,'<?php echo $_GET['class']?>')    
    createSubClassCheckButton('<?php echo $_GET['class']?>',`<?php echo is_array($_GET['subclass']) ? implode ( ",", $_GET['subclass'] ) : $_GET['subclass'];?>`); 
    
    createOptions('RequiredLevelSelect' , RequiredLevelList, 'RequiredLevel','<?php echo $_GET['RequiredLevel']?>')
  
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
        <style>
        #bo_sch {color:#eee;width:100%;margin-bottom:10px;padding:10px;}
        #bo_sch label{float:left;display:block;line-height:36px;width:60px;padding:0 5px;}
        #bo_sch select{width:100px;border: 1px solid #444;}
        #bo_sch button.sch_btn{float:right;margin-right:10px;border:1px solid #444;padding:0 20px;width:120px;height:30px;}
        #bo_sch div.search_group{border:1px solid #444;margin: 10px auto;}
        #bo_sch div.search_group span {margin-left:3px;}
        
        #bo_sch ul.checkButton span{margin-left:3px;}
        #bo_sch ul.checkButton li{display:inline-block;margin:10px;width:120px;}
        #bo_sch ul.checkButton li input{margin-right:2px;}
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
        <div class="search_group">
            <label for="RequiredLevelSelect">레벨</label>
            <select name="RequiredLevel" id="RequiredLevelSelect"></select>
            
            <label for="MeterialSelect">재질</label>
            <select  name="Material" id="MeterialSelect"></select>        
            <div style="clear:both"></div>
        </div>
        <div class="search_group">
            <label for="classSelect">분류1</label>
            <select  name="class" id="classSelect"></select>
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
