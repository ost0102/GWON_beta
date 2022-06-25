<?
//페이지에 대한 도시별 접근 빈도
 if(isset($geo_page)){
 	//print_r($user_act);
	if($geo_page !=''){
		echo '<table class="admin_table" border="1"><tr><th>국가명</th><th>도시명</th><th>방문 횟수</th></tr>';
		foreach ($geo_page as $geo_page) 
		{
			//print_r($user_act);
			echo '<tr><td>';
			if(isset($geo_page['country_name']))
			{
				echo $geo_page['country_name'];
			} else {}
			echo '</td><td>';
			if(isset($geo_page['city']))
			{
				echo $geo_page['city'];
			} else {}
			echo '</td><td>';
			if(isset($geo_page['city_count']))
			{
				echo $geo_page['city_count'];
			} else {}
			echo '</td></tr>';
		}
		echo '</table>';
	}else{
		echo '내용이 없습니다.';
	}
	}
?>
<?
//페이지에 대한 도시별 접근 빈도
 if(isset($country_info)){
 	//print_r($user_act);
	if($country_info !=''){
		echo '총 국가수 : '.$country_count.'<br/><br/>';
		echo '<table class="admin_table" border="1"><tr><th>국가명</th><th>방문 횟수</th></tr>';
		foreach ($country_info as $country_info) 
		{
			//print_r($user_act);
			echo '<tr><td>';
			if(isset($country_info['country_name']))
			{
				if(isset($country_info['check_img'])&&$country_info['check_img']==1){
					echo '<img src="/img/flag/'.$country_info['country_code'].'.png" style="width: 15px; margin-right: 5px;">';
				}
				if($country_info['country_name']==''){
					echo 'not_set';
				}else{
					echo $country_info['country_name'].'&nbsp;&nbsp;<a href="javascript: query_city(\''.$country_info['p_num'].'_'.$country_info['country_code'].'_'.$country_info['date'].'\');">[detail]</a>';
				}
			} else {}
			echo '</td><td>';
			if(isset($country_info['count']))
			{
				echo $country_info['count'];
			} else {}
			echo '</td></tr>';
		}
		echo '</table>';
	}else{
		echo '내용이 없습니다.';
	}
	}
?>
<?
	//refere값 출력
	if(isset($ref_log)){
		if($ref_log !=''){
		echo '<b>내부 유입 : </b>'.$in_site.'&nbsp;&nbsp;';
		echo '<b>외부 유입 : </b>'.$out_site.'&nbsp;&nbsp;<br/><br/>';
?>
<div id='ref_table_area'>
<?
	echo '<table class="admin_table" border="1"><th>URL</th><th>Count</th><th>date</th></tr>';
		foreach ($ref_log as $ref_log) 
		{
			//print_r($user_act);
			if($ref_log['referer_domain'] == '0'){
				$referer_domain = '직접 유입';
			}else{
				$referer_domain = $ref_log['referer_domain'];
			}
			echo '<tr>
					<td>';
			if(isset($ref_log['referer_url']))
			{
				$txt_size = strlen($ref_log['referer_url']);
				if($referer_domain=='직접 유입'){
					echo $referer_domain;
				}else{
					if($txt_size>30){
						//문자열이 길면 짤라서 보여주기
						echo '<a href="'.$ref_log['referer_url'].'" target="_blank" title="'.$ref_log['referer_url'].'">'.substr($ref_log['referer_domain'],0,40).'</a>...';
					}else{
						echo '<a href="'.$ref_log['referer_url'].'" target="_blank" title="'.$ref_log['referer_url'].'">'.$ref_log['referer_domain'].'</a>';
					}
				}
					
			} else { echo 0;}
			echo '</td><td>';
			if(isset($ref_log['referer_count']))
			{
				echo $ref_log['referer_count'];
			} else { echo 0;}
			echo '</td><td>';
			if(isset($ref_log['date']))
			{
				$date_ori = date("Y-m-d");
				$date_uagent = date("Y-m-d",strtotime ($ref_log['date']));
				if($date_ori == $date_uagent){
					echo date("H:i:s",strtotime ($ref_log['date']));
				}else{
					echo $ref_log['date'];
				}
				
			} else { echo 0;}
			echo '</td><tr>';
		}
		echo '</table></div>';
	 }else{
	 	echo '유입 페이지 정보가 존재하지 않습니다.';
	 }
	}
?>
<?
//읽음 여부 기록
 if(isset($con_read)){
 	//print_r($user_act);
	if($con_read !=''){
		echo '<table class="admin_table" border="1"><tr><th>전체 방문자</th><th>'.$total_read.'</th></tr>';
		foreach ($con_read as $con_read) 
		{
			//print_r($user_act);
			echo '<tr><td>';
			if(isset($con_read['con_state']))
			{
				if($con_read['con_state']=='not-set'){
					echo '미확인';
				}else if($con_read['con_state']=='yes'){
					echo '읽음';
				}else{
					echo '단순 방문자';
				}
			} else {}
			echo '</td><td>';
			if(isset($con_read['count']))
			{
				echo $con_read['count'];
			} else {}
			echo '</td></tr>';
		}
		echo '</table>';
	}else{
		echo '내용이 없습니다.';
	}
	}
?>