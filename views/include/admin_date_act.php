<?
 //날짜별 이용정보
 if(isset($data_per_date)){
	echo '<b><a href="/admin/date_act" target="_self">날짜별 사용내역</a></b>
	<br/>오늘은 '.date('Y년 '.'m월 '.'d일 ').'입니다.<br/><br/>';

	echo '<table class="admin_table" border="1"><tr> <th> 날짜  </th><th title="로그인 사용자 수(중복제외)">로그인 사용자</th><th> 총 사용자 로그인 횟수 </th><th>프로젝트 생성</th><th>프로젝트 활성화</th><th>방문자 카운트</th><th>live update</th><th>popup 공지</th></tr>';
		foreach ($data_per_date as $date => $data) 
		{
			if($date !=='00000000'){
				echo '<tr><td>'.$date;
				
				echo '</td><td>';
				if(isset($data['loggin_per_date_user']))
				{
					echo $data['loggin_per_date_user'];
				} else {
					echo 0;
				}
				
				
				echo '</td><td>';
				if(isset($data['loggin_per_date_total']))
				{
					echo $data['loggin_per_date_total'];
				} else {
					echo 0;
				}										
				echo '</td><td>';
				if(isset($data['make_start']))
				{
					echo $data['make_start'];
				} else {
					echo 0;
				}

				echo '</td><td>';
				if(isset($data['publish']))
				{
					echo $data['publish'];
				} else {
					echo 0;
				}
				echo '</td><td>';
				if(isset($data['visitor']))
				{
					echo $data['visitor'];
				} else {
					echo 0;
				}
				echo '</td><td>';
				if(isset($data['count_live_used']))
				{
					echo $data['count_live_used'];
				} else {
					echo 0;
				}
				echo '</td><td>';
				if(isset($data['count_popup_used']))
				{
					echo $data['count_popup_used'];
				} else {
					echo 0;
				}

				echo '</td></tr>';
			}

		}
		echo '</table>';
	 }
?>
<?
 //접근 국가별 정보
 if(isset($country_info)){
 	//print_r($user_act);
	echo '
	<br/><b>국가별 방문 정보</b><br/>
	<table class="admin_table" border="1"><tr> <th>국가명</th><th>방문 횟수</th></tr>';
		foreach ($country_info as $country_info) 
		{
			//print_r($user_act);
			echo '<tr><td><a href="/admin/detail_country/'.$country_info['country_code'].'_'.$date.'" target="_self">'.$country_info['country_name'].'</a>';
			
			echo '</td><td>';
			if(isset($country_info['count']))
			{
				echo $country_info['count'];
			} else {}
			
			echo '</td></tr>';
		}
		echo '</table>';
	 }
?>

<?
//접근 국가별 도시 정보
 if(isset($city_info)){
?>
<script type="text/javascript"> 
	//data picker
	$(function() {
		$.datepicker.setDefaults( $.datepicker.regional[ "ko" ] );
        $( "#datepicker4" ).datepicker({dateFormat:"yy-mm-dd"});
    });   
</script>
<b><a href="/admin/main" target="_self">접근 국가-도시 정보</a></b><br/>
<input  type="text" id="datepicker4" style="width: 150px; margin-top:10px;" value="<?echo $date;?>"/>
<input  type="hidden" id="country_code" style="width: 150px; margin-top:10px;" value="<?echo $country_code;?>"/>
<a href='/admin/detail_country/<?echo $country_code;?>_all' target='_self'>전체 보기</a><br/>

<?
 	//print_r($user_act);
	echo '오늘은 '.date('Y년 '.'m월 '.'d일 ').'입니다.<br/><br/>';
		if($city_info !=''){
			echo '<table class="admin_table" border="1"><tr><th>국가명</th><th>도시</th><th>방문 횟수</th><th>대표 페이지</th></tr>';
			foreach ($city_info as $city_info) 
			{
				//print_r($city_info);
				echo '<tr><td>'.$city_info['country_name'];
				
				echo '</td><td>';
				if(isset($city_info['city']))
				{
					echo '<a href="/admin/detail_city/'.$city_info['city'].'_'.$date.'" target="_self">'.$city_info['city'].'</a>';
				} else {}
				echo '</td><td>';
				if(isset($city_info['city_count']))
				{
					echo $city_info['city_count'];
				} else {}
				echo '</td><td>';
				if(isset($city_info['title']))
				{
					echo $city_info['title'];
				} else {}
				echo '</td></tr>';
			}
			echo '</table><br/>';
		}else{
			echo '내용이 없습니다.';
		}
	}
?>
<?
 if(isset($country_project)){
?>
<script type="text/javascript"> 
	//data picker
	$(function() {
		$.datepicker.setDefaults( $.datepicker.regional[ "ko" ] );
        $( "#datepicker5" ).datepicker({dateFormat:"yy-mm-dd"});
    });   
</script>
<b><a href="/admin/main" target="_self">접근 국가-페이지 정보</a></b><br/>
<input  type="text" id="datepicker5" style="width: 150px; margin-top:10px;" value="<?echo $date;?>"/>
<input  type="hidden" id="country_code1" style="width: 150px; margin-top:10px;" value="<?echo $country_code;?>"/>
<a href='/admin/detail_country/<?echo $country_code;?>_all' target='_self'>전체 보기</a><br/>
<?
 	//print_r($user_act);
	echo '오늘은 '.date('Y년 '.'m월 '.'d일 ').'입니다.<br/><br/>';

	echo '<table class="admin_table" border="1"><tr><th>국가명</th><th>페이지</th><th>방문 횟수</th><th>대표 도시</th></tr>';
		foreach ($country_project as $country_project) 
		{
			//print_r($user_act);
			echo '<tr><td>'.$country_project['country_name'];
			
			echo '</td><td>';
			if(isset($country_project['title']))
			{
				echo '<a href="/admin/detail_geo_page/'.$country_project['country_code'].'_'.$country_project['p_num'].'_'.$date.'" target="_self">'.$country_project['title'].'</a>';
			} else {}
			echo '</td><td>';
			if(isset($country_project['page_count']))
			{
				echo $country_project['page_count'];
			} else {}
			echo '</td><td>';
			if(isset($country_project['city']))
			{
				echo $country_project['city'];
			} else {}
			
			echo '</td></tr>';
		}
		echo '</table><br/>';
	 }
?>
<?
//접근 국가별 도시 정보
 if(isset($city_detail)){
?>
<script type="text/javascript"> 
	//data picker
	$(function() {
		$.datepicker.setDefaults( $.datepicker.regional[ "ko" ] );
        $( "#datepicker6" ).datepicker({dateFormat:"yy-mm-dd"});
    });   
</script>
<b><a href="/admin/detail_country/<? echo $country_code; ?>_<? echo $date; ?>" target="_self">접근 국가-도시 정보</a></b><br/>
<input  type="text" id="datepicker6" style="width: 150px; margin-top:10px;" value="<?echo $date;?>"/>
<input  type="hidden" id="city_code" style="width: 150px; margin-top:10px;" value="<?echo $city;?>"/>
<!--도시명 중에 '이게 들어가 있는게 있음, herf는 꼭 쌍따옴표로 시작하기 ex)SEOUL-T'UKPYOLSI-->
<a href="/admin/detail_city/<?echo $city;?>_all" target='_self'>전체 보기</a><br/>

<?
 	//print_r($user_act);
	echo '오늘은 '.date('Y년 '.'m월 '.'d일 ').'입니다.<br/><br/>';
		if($city_detail !=''){
			echo '<table class="admin_table" border="1"><tr><th>국가명</th><th>도시</th><th>페이지</th><th>방문 횟수</th></tr>';
			foreach ($city_detail as $city_detail) 
			{
				//print_r($user_act);
				echo '<tr><td>'.$city_detail['country_name'];
				
				echo '</td><td>';
				if(isset($city_detail['city']))
				{
					echo $city_detail['city'];
				} else {}
				echo '</td><td>';
				if(isset($city_detail['title']))
				{
					echo $city_detail['title'];
				} else {}
				echo '</td><td>';
				if(isset($city_detail['p_count']))
				{
					echo $city_detail['p_count'];
				} else {}
				echo '</td></tr>';
			}
			echo '</table><br/>';
		}else{
			echo '내용이 없습니다.';
		}
	}
?>
<?
//페이지에 대한 도시별 접근 빈도
 if(isset($geo_page)){
?>
<script type="text/javascript"> 
	//data picker
	$(function() {
		$.datepicker.setDefaults( $.datepicker.regional[ "ko" ] );
        $( "#datepicker7" ).datepicker({dateFormat:"yy-mm-dd"});
    });   
</script>
<b><a href="/admin/detail_country/<? echo $country_code; ?>_<? echo $date; ?>" target="_self">접근 국가-도시 정보</a></b><br/>
<input  type="text" id="datepicker7" style="width: 150px; margin-top:10px;" value="<?echo $date;?>"/>
<input  type="hidden" id="country_code" style="width: 150px; margin-top:10px;" value="<?echo $country_code;?>"/>
<input  type="hidden" id="page_num" style="width: 150px; margin-top:10px;" value="<?echo $p_num;?>"/>
<!--도시명 중에 '이게 들어가 있는게 있음, herf는 꼭 쌍따옴표로 시작하기 ex)SEOUL-T'UKPYOLSI-->
<a href="/admin/detail_geo_page/<?echo $country_code;?>_<?echo $p_num;?>_all" target='_self'>전체 보기</a><br/>

<?	
 	//print_r($user_act);
	echo '오늘은 '.date('Y년 '.'m월 '.'d일 ').'입니다.<br/><br/>';
		if($geo_page !=''){
			echo '<table class="admin_table" border="1"><tr><th>페이지</th><th>국가명</th><th>도시</th><th>방문 횟수</th></tr>';
			foreach ($geo_page as $geo_page) 
			{
				//print_r($user_act);
				echo '<tr><td>'.$geo_page['title'];
				
				echo '</td><td>';
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
			echo '</table><br/>';
		}else{
			echo '내용이 없습니다.';
		}
	}
?>
<?
 //프로젝트 단계 진행 내역
 if(isset($project_step)){
	echo '<b>프로젝트 단계별 진행 내역</b><br/>오늘은 '.date('Y년 '.'m월 '.'d일 ').'입니다.<br/><br/>';

	echo '<table class="admin_table" border="1"><tr> 
	<th>프로젝트_인식번호</th><th>개요 저장</th>
	<th>내용입력</th><th>양식입력</th><th>팀원추가</th><th>디자인설정</th><th>퍼블리싱</th></tr>';
		foreach ($project_step as $project_step) 
		{
			echo '<tr><td>'.$project_step['w_num'];
			echo '<br/>'.$project_step['title'];
			echo '</td><td>';
			if(isset($project_step['make_start']))
			{
				if($project_step['make_start'] !== '0000-00-00'){
					echo $project_step['make_start'];
				}else{
					echo '미생성';
				}
			} else {}
			
			
			echo '</td><td>';
			if(isset($project_step['write_con']))
			{
				if($project_step['write_con'] !== '0000-00-00'){
					echo $project_step['write_con'];
				}else{
					echo '미생성';
				}
			} else {}
			
			echo '</td><td>';
			if(isset($project_step['write_form']))
			{
				if($project_step['write_form'] !== '0000-00-00'){
					echo $project_step['write_form'];
				}else{
					echo '미생성';
				}
			} else {}

			echo '</td><td>';
			if(isset($project_step['add_member']))
			{
				if($project_step['add_member'] !== '0000-00-00'){
					echo $project_step['add_member'];
				}else{
					echo '미생성';
				}
			} else {}

			echo '</td><td>';
			if(isset($project_step['add_code']))
			{
				if($project_step['add_code'] !== '0000-00-00'){
					echo $project_step['add_code'];
				}else{
					echo '미생성';
				}
			} else {}

			echo '</td><td>';
			if(isset($project_step['publish']))
			{
				if($project_step['publish'] !== '0000-00-00'){
					echo $project_step['publish'];
				}else{
					echo '미생성';
				}
			} else {}
			echo '</td></tr>';

		}
		echo '</table>';
	 }
?>
<?
 //사용자별 이용정보
 if(isset($user_act)){
 	//print_r($user_act);
	echo '<b>사용자별 이용 내역</b><br/>오늘은 '.date('Y년 '.'m월 '.'d일 ').'입니다.<br/><br/>';

	echo '<table class="admin_table" border="1"><tr> <th>사용자_인식번호</th><th>페이지 생성</th><th>페이지 참여(팀원)</th><th>공고 참여</th><th>등록된 팀</th><th>서포트</th></tr>';
		foreach ($user_act as $user_act) 
		{
			if($user_act['user_id']!=0){
			//print_r($user_act);
			echo '<tr><td>'.$user_act['user_id'].'&nbsp;'.$user_act['username'];
			
			echo '</td><td>';
			if(isset($user_act['made_count']))
			{
				echo $user_act['made_count'];
			} else {}

			echo '</td><td>';
			if(isset($user_act['project_count']))
			{
				echo $user_act['project_count'];
			} else {}

			echo '</td><td>';
			if(isset($user_act['apply_count']))
			{
				echo $user_act['apply_count'];
			} else {}
			
			echo '</td><td>';
			if(isset($user_act['team_count']))
			{
				echo $user_act['team_count'];
			} else {}

			echo '</td><td>';
			if(isset($user_act['support_count']))
			{
				echo $user_act['support_count'];
			} else {}
			
			echo '</td></tr>';
			}

		}
		echo '</table>';
	 }
?>
<?
 //페이지별 방문자 수
 
 if(isset($project_log)){
 	?>
<!--data picker 관련 시작 -->
<script type="text/javascript"> 
	//data picker
	$(function() {
		$.datepicker.setDefaults( $.datepicker.regional[ "ko" ] );
        $( "#datepicker1" ).datepicker({dateFormat:"yy-mm-dd"});
    });

   
</script>
<!--data picker 관련 끝-->
<? if(isset($where_now) && $where_now =='admin_main'){
 echo '<br/><hr/><br/><b><a href="/admin/page_count" target="_self">페이지별 방문자 수</a></b><br/>';
}else{?>
<b><a href="/admin/page_count" target="_self">페이지별 방문자 수</a></b><br/>
<input  type="text" id="datepicker1" style="width: 150px; margin-top:10px;" value="<?echo $date;?>"/>
<?}?>
<?
	//echo '<br/>오늘은 '.date('Y년 '.'m월 '.'d일 ').'입니다.<br/><br/>';

	echo '<table class="admin_table" border="1"><tr><th>페이지 명</th><th>total count</th><th>'.$date.'</th><th>메인 노출 상태</th></tr>';
		foreach ($project_log as $project_log) 
		{
			echo '<tr>
					<td style="text-align: left;"><a href="/'.$project_log['domain'].'" target="_blank">'.$project_log['title']."</a>";
			echo '&nbsp;&nbsp;(<a href="/admin/page_dailly/'.$project_log['p_num'].'" target="_self">daily</a>)';
			echo '&nbsp;&nbsp;(<a href="/admin/page_detail/'.$project_log['page_secur'].'" target="_self">dashboard</a>)';
			echo '</td><td>';
			if(isset($project_log['p_count']))
			{
				echo $project_log['p_count'];
			} else { echo 0;}
			echo '</td><td>';
			if(isset($project_log['today']))
			{
				echo $project_log['today'];
			} else { echo 0;}
			echo '</td><td>';
			if(isset($project_log['admin_check']) && $project_log['admin_check'] == 1)
			{
				echo '<a href="/admin/show_mainpage/'.$project_log['p_num'].'" target="blank">노출 중지</a>';
			} else { echo '<a href="/admin/hidden_mainpage/'.$project_log['p_num'].'" target="blank">노출 중</a>';}
			echo '</td><tr>';
		}
		echo '</table>';
	 }
?>
<?
 //임시활성화된 페이지 정보
 
 if(isset($project_testPublishing)){
 	?>
</br><b>임시활성화된 페이지</b><br/>
<?
	//echo '<br/>오늘은 '.date('Y년 '.'m월 '.'d일 ').'입니다.<br/><br/>';

	echo '<table class="admin_table" border="1"><tr><th>title</th></tr>';
		foreach ($project_testPublishing as $project_testPublishing) 
		{
			//print_r($user_act);
			echo '<tr>
					<td><a href="/tpub/page/'.$project_testPublishing['page_secur'].'" target="_blank">'.$project_testPublishing['title']."</a>";
			//echo '&nbsp;&nbsp;(<a href="/admin/page_dailly/'.$project_testPublishing['p_num'].'" target="_self">daily</a>)';
			echo '</td><tr>';
		}
		echo '</table>';
	 }
?>
<?
 //사용자별 이용정보
 
 if(isset($page_dailly)){
	echo '오늘은 '.date('Y년 '.'m월 '.'d일 ').'입니다.<br/>';

	echo '<table class="admin_table" border="1"><tr> <th>p_num</th><th>day</th><th>daily</th></tr>';
		foreach ($page_dailly as $page_dailly) 
		{
			//print_r($user_act);
			echo '<tr><td>'.$page_dailly['p_num'];
			
			echo '</td><td>';
			if(isset($page_dailly['day']))
			{
				echo $page_dailly['day'];
			} else {}


			echo '</td><td>';
			if(isset($page_dailly['daily_count']))
			{
				echo $page_dailly['daily_count'];
			} else {}
			
			echo '</td></tr>';

		}
		echo '</table>';
	 }
?>
<?
 //페이지 로그, 유저 에이전트 등 분석
 
 if(isset($u_agent)){
 	?>
<!--data picker 관련 시작 -->
<script type="text/javascript"> 
	//data picker
	$(function() {
		$.datepicker.setDefaults( $.datepicker.regional[ "ko" ] );
        $( "#datepicker2" ).datepicker({dateFormat:"yy-mm-dd"});
    });

   
</script>
<!--data picker 관련 끝-->
<? if(isset($where_now) && $where_now =='admin_main'){?>
	<br/><hr/><br/><b><a href="/admin/page_log" target="_self">페이지 접근환경 분석 - user agent</a></b>&nbsp;
<?}else{?>
	<b><a href="/admin/page_log" target="_self">페이지 접근환경 분석 - user agent</a></b>&nbsp;
	<input  type="text" id="datepicker2" style="width: 150px; margin-top:10px;" value="<?echo $date;?>"/>
<?}?>
<? if(isset($where_now) && $where_now =='page_log_single'){
?>
	<a href='/admin/page_log_single/<?echo $now_value;?>_all' target='_self'>전체 날짜 보기</a>&nbsp;&nbsp;
	<a href='/admin/page_log/' target='_self'>돌아가기</a>
<?
}else if(isset($where_now) && $where_now =='admin_main'){
}else{
?>
	<a href='/admin/page_log/all' target='_self'>전체 날짜 보기</a>
<?	
}
?>
<br/>
<div id='admin_ua_area'>
<img src ='/img/icon/icon_pt.png' class='img1'><b>Desktop </b> <?echo $u_agent_count_desktop+$u_agent_count_not_set;?>&nbsp;
<img src='/img/icon/icon_win.png' class='img2' title='window'/> <?echo $u_agent_count_win;?>&nbsp;
<img src='/img/icon/icon_mac.png' class='img2' title='macintosh'/> <?echo $u_agent_count_mac;?>&nbsp;
<img src='/img/icon/icon_bot.png' class='img2' title='bot'/> <?echo $u_agent_count_bot;?>&nbsp;
<img src='/img/icon/icon_guide.png' class='img2' title='Not set'/> <?echo $u_agent_count_not_set;?><br/>

<img src='/img/icon/icon_mobile.png' class='img1' title=''/> <b>Mobile </b> <?echo $u_agent_count_mobile;?>&nbsp;
<img src='/img/icon/icon_android.png' class='img2' title='Android'/> <?echo $u_agent_count_android;?>&nbsp;
<img src='/img/icon/icon_iphone.png' style='width:8px;' class='img2' title='iphone'/> <?echo $u_agent_count_iphone;?>&nbsp;
<img src='/img/icon/icon_ipod.png' style='width:8px;' class='img2' title='ipod'/> <?echo $u_agent_count_ipod;?>&nbsp;
<img src='/img/icon/icon_ipad.png' class='img2' title='ipad'/> <?echo $u_agent_count_ipad;?>
</div>
<?
	//echo '<br/>오늘은 '.date('Y년 '.'m월 '.'d일 ').'입니다.<br/><br/>';
	if(isset($where_now) && $where_now =='admin_main'){
	}else{
	echo '<table class="admin_table" border="1"><tr><th>p_num & title</th><th>Count</th><th>Device</th><th>Type</th><th>ip</th><th>'.$date.'</th></tr>';
		foreach ($u_agent as $u_agent) 
		{
			//print_r($user_act);
			echo '<tr>
					<td><a href="/admin/page_log_single/'.$u_agent['p_num'].'_'.date("Ymd",strtotime ($u_agent['date'])).'" target="_self">'.$u_agent['p_num'].'&nbsp;'.$p_num_arr[$u_agent['p_num']]."</a>";
			echo '</td><td>';
			if(isset($u_agent['ua_count']))
			{
				echo $u_agent['ua_count'];
			} else { echo 0;}
			echo '</td><td>';
			if(isset($u_agent['u_device']))
			{
				echo $u_agent['u_device'];
			} else { echo 0;}
			echo '</td><td>';
			if(isset($u_agent['device_type']))
			{
				echo $u_agent['device_type'];
			} else { echo 0;}
			echo '</td><td>';
			if(isset($u_agent['ip_address']))
			{
				echo $u_agent['ip_address'];
			} else { echo 0;}
			echo '</td><td>';
			if(isset($u_agent['date']))
			{
				$date_ori = date("Y-m-d",strtotime ($date));
				$date_uagent = date("Y-m-d",strtotime ($u_agent['date']));
				if($date_ori == $date_uagent){
					echo date("H:i:s",strtotime ($u_agent['date']));
				}else{
					echo $u_agent['date'];
				}
				
			} else { echo 0;}
			echo '</td><tr>';
		}
		echo '</table>';
	}
}
?>
<?
 //페이지 로그, 리퍼러 분석
 if(isset($ref_log)){
 	?>
<!--data picker 관련 시작 -->
<script type="text/javascript"> 
	//data picker
	$(function() {
		$.datepicker.setDefaults( $.datepicker.regional[ "ko" ] );
        $( "#datepicker3" ).datepicker({dateFormat:"yy-mm-dd"});
    });   
</script>

<!--data picker 관련 끝-->
<? if(isset($where_now) && $where_now =='admin_main'){?>
<hr style='width:100%; margin-top: 10px; margin-bottom: 10px;'/><b><a href="/admin/page_ref" target="_self">페이지 접근환경 분석 - 유입 페이지(Refer)</a></b>
<?}else{?>
<b><a href="/admin/page_ref" target="_self">페이지 접근환경 분석 - 유입 페이지(Refer)</a></b>
<input  type="text" id="datepicker3" style="width: 150px; margin-top:10px;" value="<?echo $date;?>"/>
<?}?>
<? if(isset($where_now) && $where_now =='page_ref_single'){?>
	<a href='/admin/page_ref_single/<?echo $now_value;?>_all' target='_self'>전체 날짜 보기</a>&nbsp;&nbsp;
	<a href='/admin/page_ref/' target='_self'>돌아가기</a>
<?
	}else if(isset($where_now) && $where_now =='admin_main'){
	}else{
?>
	<a href='/admin/page_ref/all' target='_self'>전체 날짜 보기</a>
<?	
	}
?>
<br/>
<?
	//echo '<br/>오늘은 '.date('Y년 '.'m월 '.'d일 ').'입니다.<br/><br/>';
	echo '<b>In site : </b>'.$in_site.'&nbsp;&nbsp;';
	echo '<b>Out site : </b>'.$out_site.'&nbsp;&nbsp;<br/><br/>';
	echo '<table class="admin_table" border="1"><tr><th>p_num<br/>(title)</th><th>URL</th><th>Count</th><th>'.$date.'</th></tr>';
		foreach ($ref_log as $ref_log) 
		{
			//print_r($user_act);
			echo '<tr>
					<td>
					<a href="/admin/page_ref_single/'.$ref_log['p_num'].'_'.date("Ymd",strtotime ($ref_log['date'])).'" title="'.$ref_log['title'].'"target="_self">'.$ref_log['p_num'].'</a>';
			echo '</td><td>';
			if(isset($ref_log['referer_url']))
			{
				$txt_size = strlen($ref_log['referer_url']);
				if($txt_size>30){
					//문자열이 길면 짤라서 보여주기
					echo '<a href="'.$ref_log['referer_url'].'" target="_blank" title="'.$ref_log['referer_url'].'">'.substr($ref_log['referer_url'],0,30).'</a>...';
				}else{
					echo '<a href="'.$ref_log['referer_url'].'" target="_blank" title="'.$ref_log['referer_url'].'">'.$ref_log['referer_url'].'</a>';
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
				$date_ori = date("Y-m-d",strtotime ($date));
				$date_uagent = date("Y-m-d",strtotime ($ref_log['date']));
				if($date_ori == $date_uagent){
					echo date("H:i:s",strtotime ($ref_log['date']));
				}else{
					echo $ref_log['date'];
				}
				
			} else { echo 0;}
			echo '</td><tr>';
		}
		echo '</table>';
	 }
?>