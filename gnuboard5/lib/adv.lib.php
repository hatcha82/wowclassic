<?php
function daum_adfit(){
    $G5_BASE_DOMAIN = 'classicwow.co.kr';
  
    //echo '<script>alert('' . (strpos('www.classicwow.co.kr', $G5_BASE_DOMAIN) !==  false ) .'')</script>';
  
  
    if(strpos($_SERVER['HTTP_HOST'],$G5_BASE_DOMAIN) !==  false){
      echo "
      <div style='width:320px;height:100px;float:left;'>
          <ins class='kakao_ad_area' style='display:none;' 
              data-ad-unit    = 'DAN-sl6o3ds7ip2b' 
              data-ad-width   = '320' 
              data-ad-height  = '100'></ins> 
      </div>
      <div style='width:728px;height:90px;float:left;margin-left:15px;margin-top:5px'>
          <ins class='kakao_ad_area' style='display:none;' 
              data-ad-unit    = 'DAN-vf6huu96shme' 
              data-ad-width   = '728' 
              data-ad-height  = '90'></ins> 
      </div>
          <div style='width:320px;height:100px;float:left;margin-left:15px'>
              <ins class='kakao_ad_area' style='display:none;' 
              data-ad-unit    = 'DAN-s4mcl4s6pizm' 
              data-ad-width   = '320' 
              data-ad-height  = '100'></ins> 
      </div>";
    }else{
      echo "
      <div style='width:320px;height:100px;float:left;'>
          <ins class='kakao_ad_area' style='display:none;' 
              data-ad-unit    = 'DAN-qhsuk5fv6yxw' 
              data-ad-width   = '320' 
              data-ad-height  = '100'></ins> 
      </div>
      <div style='width:728px;height:90px;float:left;margin-left:15px;margin-top:5px'>
          <ins class='kakao_ad_area' style='display:none;' 
              data-ad-unit    = 'DAN-1h822y33b17qc' 
              data-ad-width   = '728' 
              data-ad-height  = '90'></ins> 
      </div>
          <div style='width:320px;height:100px;float:left;margin-left:15px'>
              <ins class='kakao_ad_area' style='display:none;' 
              data-ad-unit    = 'DAN-rhglnuszc3tw' 
              data-ad-width   = '320' 
              data-ad-height  = '100'></ins> 
      </div>";
    }
}
function daum_adfit_mobile($type){
    $G5_BASE_DOMAIN = 'classicwow.co.kr';
    $unit = '';
    $style = '';
  //echo "<script>alert('" . (strpos('www.classicwow.co.kr', $G5_BASE_DOMAIN) !==  false ) ."')</script>";

    if($type == 'top'){
        $style= "margin:5px auto;width:320px;height:50px";
    }else if($type == 'top'){
        $style = 'width:320px;height:50px;margin:auto';
    }else if($type == 'footer'){
        $style = 'width:320px;height:50px;margin:5px auto;';
    }


  if(strpos($_SERVER['HTTP_HOST'],$G5_BASE_DOMAIN) !==  false){
    if($type == 'top'){
        $unit = '1h7ly8jdb9ruh';
    }else if($type == 'top'){
        $unit = '1iyexohwdu62f';
    }else if($type == 'footer'){
        $unit = '1hv2pzitmbd4n';
    }
  }else{
    if($type == 'top'){
        $unit = 'toamf2ui83zo';
    }else if($type == 'top'){
        $unit = 's4xfda1viss6';
    }else if($type == 'footer'){
        $unit = '1ib0wuv8suxpx';
    }
  }
  if($unit !== ''){
      echo 
        "
            <ins class='kakao_ad_area' style='display:none;' 
                data-ad-unit    = 'DAN-$unit' 
                data-ad-width   = '320'
                data-ad-height  = '50'></ins> 
       ";
  }else{
      echo '';
  }
}
?>