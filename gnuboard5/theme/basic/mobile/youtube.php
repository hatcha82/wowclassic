<?php
    $sql = "select 	wr_content
            from 	g5_write_free
            where wr_is_comment = 0 
            and 	ca_name = 'Youtube'
            order
            by 		wr_num
            limit 30";
    
    $youtubeIdList = array();
    $youtubeResult = sql_query($sql);
    for ($i=0; $row3=sql_fetch_array($youtubeResult); $i++) {
        preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#',  $row3['wr_content'], $matches);

        if(isset($matches[2]) && $matches[2] != ''){
            $YoutubeCode = $matches[2];
            array_push($youtubeIdList,$YoutubeCode);
        }
        
    }
    $YoutubeCode = $youtubeIdList[array_rand($youtubeIdList)];
    echo "<div class='lt list_01' >
            <div class='bo_name'>
                <div class='lt_title'>   
                <img src='/img/youtube.png' style='width:25px;float:left;margin-top:13px'/> 
                <span style='color:#eee;line-height:25px;padding:0 5px;'>팬사이트 추천 WoW Youtube</span>
                </div>
                <div style='width:100%;padding:0px;margin:0 auto;'>
                <div id='youtube_area' style='width:100%;border:1px solid #444'>
                    <div style='position: relative; padding-bottom: 56.25%;'>
                    <iframe style='position: absolute; top: 0; left: 0; width: 100%; height: 100%;' 
                        src='https://www.youtube.com/embed/$YoutubeCode?autoplay=0&playsinline=1'
                        frameborder='0' gesture='media' allow='autoplay;encrypted-media' allowfullscreen='allowfullscreen'></iframe
                    </div>
                </div>
            </div> 
        </div>"
?>
