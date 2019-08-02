<?php
	# 총 4군데 변경입니다.
	# common.php 파일 위치 절대 경로 세팅
	include_once ("/var/www/common.php"); # 꼭 변경하세요.

	# 기본 설정
	$wwwPath = "/var/www/"; # 꼭 변경하세요.
	$wwwURL = "http://www.domain.com"; # 꼭 변경하세요.
	
	# 게시판 리스트
	$sql = " SELECT * FROM {$g5['board_table']} WHERE bo_read_level = 1";
	$query = sql_query($sql);
	
	while ($row = sql_fetch_array($query)) {
		$board[] = $row;
	}
	
	# 파일 작성 시작
	$sitemap = fopen($wwwPath.'/sitemap/sitemap.xml', 'w') or die('file not found'); # 사이트맵 생성 경로 변경
		fwrite($sitemap, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
		fwrite($sitemap, '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');
	
		$boardLink = "";
		$contentLink = "";
		foreach ($board as $key => $val) :
			# 마지막 게시물 시간
			$sql = " SELECT * FROM {$g5['write_prefix']}{$val['bo_table']} WHERE wr_id = wr_parent AND wr_is_comment = 0 ORDER BY wr_datetime DESC LIMIT 0, 1";
			$query = sql_fetch($sql);
			
			# 마지막 게시물 생성 시간이 없으면 현재 시간으로 설정
			$query['wr_datetime'] = (empty($query['wr_datetime'])) ? date('Y-m-d\TH:i:s')."+00:00" : preg_replace("/\s/im", "T", $query['wr_datetime'])."+00:00";
			
			# 게시판 링크 작성
			$boardLink = "";
			$boardLink = "<url>";
				$boardLink .= "<loc>";
					$boardLink .= G5_BBS_URL."/board.php?bo_table={$val['bo_table']}";
				$boardLink .= "</loc>";
				$boardLink .= "<lastmod>{$query['wr_datetime']}</lastmod>";
				$boardLink .= "<changefreq>daily</changefreq>";
				$boardLink .= "<priority>0.9</priority>";
			$boardLink .= "</url>";
			
			# 게시판 링크 작성
			fwrite($sitemap, $boardLink);
			
			# 게시판 게시물 작성
			$sql = " SELECT * FROM {$g5['write_prefix']}{$val['bo_table']} WHERE wr_id = wr_parent AND wr_is_comment = 0 ORDER BY wr_datetime DESC";
			$query = sql_query($sql);
			
			unset($row);
			while ($row = sql_fetch_array($query)) {
				$row['wr_datetime'] = (empty($row['wr_datetime'])) ? date('Y-m-d\TH:i:sp')."+00:00" : preg_replace("/\s/im", "T", $row['wr_datetime'])."+00:00";
				$contentLink = "";
				$contentLink = "<url>";
					$contentLink .= "<loc>";
						$contentLink .= G5_BBS_URL."/board.php?bo_table={$val['bo_table']}&amp;wr_id={$row['wr_id']}";
					$contentLink .= "</loc>";
					$contentLink .= "<lastmod>".preg_replace("/\s/im", "T", $row['wr_datetime'])."</lastmod>";
					$contentLink .= "<changefreq>weekly</changefreq>";
					$contentLink .= "<priority>0.5</priority>";
				$contentLink .= "</url>";
				
				# 게시판 게시물 링크 작성
				fwrite($sitemap, $contentLink);
			}
		endforeach;
		
		fwrite($sitemap, '</urlset>');
	fclose($sitemap);
?>

