<?php
function get_wowItem($contents)
{
    // $aTag = str_replace('[[', '<a href="https://ko.classic.wowhead.com/item=', $contents);
    // $aTag = str_replace(']]', '"></a>', $aTag);
    // return  $aTag;
    return  '<a href="https://ko.classic.wowhead.com/item=14555/%EC%95%8C%EC%BD%94%EB%A5%B4%EC%9D%98-%ED%83%9C%EC%96%91%EB%B9%84%EC%88%98"></a>';
}
function get_item_queryStr($GET,$qstr){
    
// 방식 1
    $itemSearchColumn = array(
            'class'
        ,   'subclass'
        ,   'RequiredLevel'
        ,   'InventoryType'
        ,   'Quality'
        ,   'AllowableClass'
        ,   'bonding'
        ,   'Material'
    );
    foreach($itemSearchColumn as $item) {
        if (isset($GET[ $item]))  {
            $itemValue = clean_xss_tags(trim($GET[$item]));
            if ($itemValue) {
                $itemValue = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\/\^\*]/", "", $itemValue);
                $qstr .= '&amp;' .$item. '=' . urlencode($itemValue);
            }
        }
    }  
    return $qstr;
}
function get_item_searchStr($GET, $sql_search){
  
    if(isset($GET['class']) && $GET['class'] !== ''){
        $class = $GET['class'];
        $sql_search .= " and item_template.class = $class";
    }
    if(isset($GET['subclass']) && $GET['subclass'] !== ''){
        $subclass = $GET['subclass'];
        $sql_search .= " and item_template.subclass = $subclass";
    }
    if(isset($GET['RequiredLevel']) && $GET['RequiredLevel'] !== ''){
        $RequiredLevel = $GET['RequiredLevel'];
        $RequiredLevel = str_replace('-' , ' and ', $RequiredLevel);
        $sql_search .= " and item_template.RequiredLevel between $RequiredLevel";
    }
    if(isset($GET['InventoryType']) && $GET['InventoryType'] !== ''){
        $InventoryType = $GET['InventoryType'];           
        $sql_search .= " and item_template.InventoryType = $InventoryType";
    }
    if(isset($GET['Quality']) && $GET['Quality'] !== ''){
        $Quality = $GET['Quality'];           
        $sql_search .= " and item_template.Quality = $Quality";
    }
    if(isset($GET['AllowableClass']) && $GET['AllowableClass'] !== ''){
        $AllowableClass = $GET['AllowableClass'];           
        $sql_search .= " and item_template.AllowableClass = $AllowableClass";

        // <!-- AllowableClass& (1<<getClass()))) -->
    }
    if(isset($GET['bonding']) && $GET['bonding'] !== ''){
        $bonding = $GET['bonding'];           
        $sql_search .= " and item_template.bonding = $bonding";
    }
    if(isset($GET['Material']) && $GET['Material'] !== ''){
        $Material = $GET['Material'];           
        $sql_search .= " and item_template.Material = $Material";
    }
    
 
    return  $sql_search;
    
    
}
function get_icon_by_categoryName($name){   
    $url = "";
    switch ($name) {
    case "전사"	    :   $url= "/img/WOW/class/classicon_warrior.jpg";break;
    case "도적"	    :   $url=  "/img/WOW/class/classicon_rogue.jpg";break;
    case "마법사"   :	$url=  "/img/WOW/class/classicon_mage.jpg";break;
    case "흑마법사" :   $url=  "/img/WOW/class/classicon_warlock.jpg";break;
    case "사제"     :	$url=  "/img/WOW/class/classicon_priest.jpg";break;
    case "성기사"   :	$url=  "/img/WOW/class/classicon_paladin.jpg";break;
    case "주술사"   :	$url=  "/img/WOW/class/classicon_shaman.jpg";break;
    case "드루이드" :	$url=  "/img/WOW/class/classicon_druid.jpg";break;
    case "사냥꾼"   :	$url=  "/img/WOW/class/classicon_hunter.jpg";break;

    case "가죽세공"	:   $url= "/img/WOW/profession/skinning.png";break;
    case "기계공학"	:   $url=  "/img/WOW/profession/engineering.png";break;
    case "대장기술" :	$url=  "/img/WOW/profession/blacksmithing.png";break;
    case "마법부여" :   $url=  "/img/WOW/profession/enchanting.png";break;
    case "재봉"     :	$url=  "/img/WOW/profession/tailoring.png";break;
    case "연금술"   :	$url=  "/img/WOW/profession/alchemy.png";break;
    case "무두질"   :	$url=  "/img/WOW/profession/leatherworking.png";break;
    case "약초"     :	$url=  "/img/WOW/profession/herbalism.png";break;
    case "채광"   :	$url=  "/img/WOW/profession/mining.png";break;
    case "낚시"   :	$url=  "/img/WOW/profession/fishing.png";break;
    case "요리"   :	$url=  "/img/WOW/profession/cooking.png";break;


    

    default:
       $url = "";
    } 
    return $url;
}
?>