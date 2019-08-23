<?php
function get_wowItem($contents)
{
    // $aTag = str_replace('[[', '<a href="https://ko.classic.wowhead.com/item=', $contents);
    // $aTag = str_replace(']]', '"></a>', $aTag);
    // return  $aTag;
    return  '<a href="https://ko.classic.wowhead.com/item=14555/%EC%95%8C%EC%BD%94%EB%A5%B4%EC%9D%98-%ED%83%9C%EC%96%91%EB%B9%84%EC%88%98"></a>';
}
$itemSearchColumn = array(
    ["column" => "class", "type" => "string"]
,   ["column" => "subclass", "type" => "string"]
,   ["column" => "RequiredLevel", "type" => "between"]
,   ["column" => "InventoryType", "type" => "string"]
,   ["column" => "Quality", "type" => "string"]
,   ["column" => "AllowableClass", "type" => "string"]
,   ["column" => "bonding", "type" => "string"]
,   ["column" => "Material", "type" => "string"]
,   ["column" => "stat_type", "type" => "multi"]
);

function get_item_queryStr($GET,$qstr){   
    $qstr .= '&amp;item=true';
    global $itemSearchColumn;
    foreach($itemSearchColumn as $item) {
        if (isset($GET[$item["column"]]))  {

            $itemValue = $GET[$item["column"]];
            if(is_array($itemValue)){
                foreach( $GET[$item["column"]] as $value) {
                    $qstr .= '&amp;'. $item["column"]. '[]=' . urlencode($value);
                }
            }else{
                $itemValue = clean_xss_tags(trim($GET[$item["column"]]));
                $itemValue = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\/\^\*]/", "", $itemValue);
                $qstr .= '&amp;' .$item["column"]. '=' . urlencode($itemValue);
            }
        }
    }  
    return $qstr;
}
function get_item_searchStr($GET, $sql_search){
  
    global $itemSearchColumn;
    foreach($itemSearchColumn as $item) {

        if (isset($GET[ $item["column"]]) && $GET[$item["column"]] != '') {
            $itemValueStr='';
            $itemValue = $GET[$item["column"]];
            if(is_array($itemValue)){
                $itemValueStr = implode ( ",", $itemValue );      
            }else{
                $itemValue = clean_xss_tags(trim($GET[$item["column"]]));
                $itemValueStr= clean_xss_tags(trim($GET[$item["column"]]));
            }

            if( $item["type"] === 'between') {    
                
                $itemValueStr = str_replace('-' , ' and ', $itemValueStr);
                $sql_search .= " and item_template." .$item["column"]. " between $itemValueStr";
            }else  if( $item["type"] === 'multi') {     
                $sql_search .= " and ( item_template." .$item["column"]. "1 in ($itemValueStr)";
                for($i = 2 ; $i <=10; $i++){
                    $sql_search .= " or item_template." .$item["column"]. "$i in ($itemValueStr)";
                }  
                $sql_search .= ")";              
                $sql_search .= " and ( item_template." .$item["column"]. "1 <> 0";
                for($i = 2 ; $i <=10; $i++){
                    $sql_search .= " or item_template." .$item["column"]. "$i <> 0";
                }                 
                $sql_search .= ")";             
            }else{
                $sql_search .= " and item_template.".$item["column"]." in ($itemValueStr)";
            }     
        }
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