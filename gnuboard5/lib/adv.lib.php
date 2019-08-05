<?php
function daum_adfit(){
  $G5_BASE_DOMAIN = 'classicwow.co.kr';

  //echo "<script>alert('" . (strpos('www.classicwow.co.kr', $G5_BASE_DOMAIN) !==  false ) ."')</script>";


  if(strpos($_SERVER['SERVER_NAME'],'www.classicwow.co.kr') !==  false){
    echo <<<EOT
    <div style="width:320px;height:100px;float:left;">
        <ins class="kakao_ad_area" style="display:none;" 
            data-ad-unit    = "DAN-sl6o3ds7ip2b" 
            data-ad-width   = "320" 
            data-ad-height  = "100"></ins> 
    </div>
    <div style="width:728px;height:90px;float:left;margin-left:15px;margin-top:5px">
        <ins class="kakao_ad_area" style="display:none;" 
            data-ad-unit    = "DAN-vf6huu96shme" 
            data-ad-width   = "728" 
            data-ad-height  = "90"></ins> 
    </div>
        <div style="width:320px;height:100px;float:left;margin-left:15px">
            <ins class="kakao_ad_area" style="display:none;" 
            data-ad-unit    = "DAN-s4mcl4s6pizm" 
            data-ad-width   = "320" 
            data-ad-height  = "100"></ins> 
    </div>
EOT;
  }else{
    echo <<<EOT
    <div style="width:320px;height:100px;float:left;">
        <ins class="kakao_ad_area" style="display:none;" 
            data-ad-unit    = "DAN-qhsuk5fv6yxw" 
            data-ad-width   = "320" 
            data-ad-height  = "100"></ins> 
    </div>
    <div style="width:728px;height:90px;float:left;margin-left:15px;margin-top:5px">
        <ins class="kakao_ad_area" style="display:none;" 
            data-ad-unit    = "DAN-1h822y33b17qc" 
            data-ad-width   = "728" 
            data-ad-height  = "90"></ins> 
    </div>
        <div style="width:320px;height:100px;float:left;margin-left:15px">
            <ins class="kakao_ad_area" style="display:none;" 
            data-ad-unit    = "DAN-rhglnuszc3tw" 
            data-ad-width   = "320" 
            data-ad-height  = "100"></ins> 
    </div>
EOT;
  }
}
?>