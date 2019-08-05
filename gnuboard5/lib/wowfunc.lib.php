<?php
function get_wowItem($contents)
{
    // $aTag = str_replace('[[', '<a href="https://ko.classic.wowhead.com/item=', $contents);
    // $aTag = str_replace(']]', '"></a>', $aTag);
    // return  $aTag;
    return  '<a href="https://ko.classic.wowhead.com/item=14555/%EC%95%8C%EC%BD%94%EB%A5%B4%EC%9D%98-%ED%83%9C%EC%96%91%EB%B9%84%EC%88%98"></a>';
}
function get_icon_by_categoryName($name){   
    $url = "";
    switch ($name) {
    case "전사"	    :   $url= "https://wow.zamimg.com/images/wow/icons/tiny/class_warrior.gif";break;
    case "도적"	    :   $url=  "https://wow.zamimg.com/images/wow/icons/tiny/class_rogue.gif";break;
    case "마법사"   :	$url=  "https://wow.zamimg.com/images/wow/icons/tiny/class_mage.gif";break;
    case "흑마법사" :   $url=  "https://wow.zamimg.com/images/wow/icons/tiny/class_warlock.gif";break;
    case "사제"     :	$url=  "https://wow.zamimg.com/images/wow/icons/tiny/class_priest.gif";break;
    case "성기사"   :	$url=  "https://wow.zamimg.com/images/wow/icons/tiny/class_paladin.gif";break;
    case "주술사"   :	$url=  "https://wow.zamimg.com/images/wow/icons/tiny/class_shaman.gif";break;
    case "드루이드" :	$url=  "https://wow.zamimg.com/images/wow/icons/tiny/class_druid.gif";break;
    case "사냥꾼"   :	$url=  "https://wow.zamimg.com/images/wow/icons/tiny/class_hunter.gif";break;

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