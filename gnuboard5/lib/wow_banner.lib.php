<?php
if (!defined('_GNUBOARD_')) exit;

// 최신글 추출
// $cache_time 캐시 갱신시간
function wow_banner($skin_dir='', $bo_table, $rows=10, $subject_len=40, $cache_time=1, $options='')
{
    global $g5;
    if (!$skin_dir) $skin_dir = 'basic';

    if(preg_match('#^theme/(.+)$#', $skin_dir, $match)) {
        if (G5_IS_MOBILE) {
            $wow_banner_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/wow_banner/'.$match[1];
            if(!is_dir($wow_banner_skin_path))
                $wow_banner_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/wow_banner/'.$match[1];
            $wow_banner_skin_url = str_replace(G5_PATH, G5_URL, $wow_banner_skin_path);
        } else {
            $wow_banner_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/wow_banner/'.$match[1];
            $wow_banner_skin_url = str_replace(G5_PATH, G5_URL, $wow_banner_skin_path);
        }
        $skin_dir = $match[1];
    } else {
        if(G5_IS_MOBILE) {
            $wow_banner_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/wow_banner/'.$skin_dir;
            $wow_banner_skin_url  = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/wow_banner/'.$skin_dir;
        } else {
            $wow_banner_skin_path = G5_SKIN_PATH.'/wow_banner/'.$skin_dir;
            $wow_banner_skin_url  = G5_SKIN_URL.'/wow_banner/'.$skin_dir;
        }
    }

    $cache_fwrite = false;
    if(G5_USE_CACHE) {
        $cache_file = G5_DATA_PATH."/cache/wow_banner-{$bo_table}-{$skin_dir}-{$rows}-{$subject_len}-serial.php";

        if(!file_exists($cache_file)) {
            $cache_fwrite = true;
        } else {
            if($cache_time > 0) {
                $filetime = filemtime($cache_file);
                if($filetime && $filetime < (G5_SERVER_TIME - 3600 * $cache_time)) {
                    @unlink($cache_file);
                    $cache_fwrite = true;
                }
            }
            
            if(!$cache_fwrite) {
                try{
                    $file_contents = file_get_contents($cache_file);
                    $file_ex = explode("\n\n", $file_contents);
                    $caches = unserialize(base64_decode($file_ex[1]));

                    $list = (is_array($caches) && isset($caches['list'])) ? $caches['list'] : array();
                    $is_category = (is_array($caches) && isset($caches['is_category'])) ? $caches['is_category'] : false;
                    $category_option = (is_array($caches) && isset($caches['category_option'])) ? $caches['category_option'] : '';

                    $bo_subject = (is_array($caches) && isset($caches['bo_subject'])) ? $caches['bo_subject'] : '';
                } catch(Exception $e){
                    $cache_fwrite = true;
                    $list = array();
                }
            }
        }
    }

    if(!G5_USE_CACHE || $cache_fwrite) {
        $list = array();

        
        $sql = " 
                select 	*
                from 	g5_write_finder finder
                join    g5_board_file file
                on 		file.bo_table = 'finder'
                and 	file.wr_id =  finder.wr_id
                where bf_no = 0
                limit 30
        ";
        $result = sql_query($sql);
        for ($i=0; $row = sql_fetch_array($result); $i++) {
            try {
                unset($row['wr_password']);     //패스워드 저장 안함( 아예 삭제 )
            } catch (Exception $e) {
            }
            $row['wr_email'] = '';              //이메일 저장 안함
            if (strstr($row['wr_option'], 'secret')){           // 비밀글일 경우 내용, 링크, 파일 저장 안함
                $row['wr_content'] = $row['wr_link1'] = $row['wr_link2'] = '';
                $row['file'] = array('count'=>0);
            }
            $list[$i] = get_list($row, $board, $wow_banner_skin_url, $subject_len);
        }

        $is_category = false;
        $category_option = '';
        if ($board['bo_use_category']) {
            $is_category = true;
            $category_href = G5_BBS_URL.'/board.php?bo_table='.$bo_table;
            
            $category_option .= '<li><a href="'.$category_href.'"';
            if ($sca=='')
                $category_option .= ' id="bo_cate_on"';
            $category_option .= '>전체</a></li>';
        
            $categories = explode('|', $board['bo_category_list']); // 구분자가 , 로 되어 있음
            for ($i=0; $i<count($categories); $i++) {
                $category = trim($categories[$i]);
        
                $icon_url = get_icon_by_categoryName($category);
                $icon_img_tag = $icon_url == '' ? '' : '<img class="category_icon" src="' .  $icon_url . '" /> ';
                if ($category=='') continue;
                if($board['bo_table']=='quest'){
                    $location_href = "window.location='" . ($category_href."&amp;sca=".urlencode($category))  . "'";
                    $category_option .= '<li onclick='. " $location_href .'" . $location_href . '><a style="pointer-events: none;cursor" href="https://ko.classic.wowhead.com/zone='. $category .'"';
                }else{

                    $category_option .= '<li><a href="'.($category_href."&amp;sca=".urlencode($category)).'"';
                }

                $category_msg = '';
                if ($category==$sca) { // 현재 선택된 카테고리라면
                    $category_option .= ' id="bo_cate_on"';
                    $category_msg = '<span class="sound_only">열린 분류 </span>';
                }
                $category_option .= '>'.$category_msg.$icon_img_tag.$category.'</a></li>';
            }
        }
        
        if($cache_fwrite) {
            $handle = fopen($cache_file, 'w');
            $caches = array(
                'list' => $list,
                'bo_subject' => sql_escape_string($bo_subject),
                'is_category' => $is_category,
                'category_option' =>$category_option
                );
            $cache_content = "<?php if (!defined('_GNUBOARD_')) exit; ?>\n\n";
            $cache_content .= base64_encode(serialize($caches));  //serialize

            fwrite($handle, $cache_content);
            fclose($handle);

            @chmod($cache_file, 0640);
        }
    }

    ob_start();
    include $wow_banner_skin_path.'/wow_banner.skin.php';
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>
