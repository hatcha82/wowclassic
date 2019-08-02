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
    default:
       $url = "";
    } 
    return $url;
}
?>