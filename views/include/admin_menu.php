<script type="text/javascript">
	function admin_menu(admin_url){
		location.href = admin_url;
	}
</script>
<h3 class='main_con_title'>
	관리자 페이지
</h3>
<div class='submenu_list'>
	<div class='submenu_list_con'>
		<a href='/admin/main'>관리자페이지 메인</a>
	</div>
	<div class='submenu_list_con'>
		<a href='/admin/domain_exception_list'>사용금지 도메인 관리</a>
	</div>
	<div class='submenu_list_con'>
		<a href='/makepage/add_template/1_1'>디자인 템플릿</a>
	</div>
	<div class='submenu_list_con'>
		<a href='/admin/show_series_list/' target='_self'>시리즈 결제 관리</a>
	</div>

	<div class='submenu_list_con'>
		<select name='category' id='board_category' onchange='admin_menu(value);'>
			<option value='#'>기본 메뉴/랜딩 관련</option>
			<option value='/admin/mail_list/1'>메일링 리스트</option>
			<option value='/admin/main'>메일 초대장 상태(향후)</option>
			<option value='/admin/admin_user'>관리자 계정</option>
			<option value='/admin/user_list'>사용자 계정</option>
			<option value='/admin/team_set'>캠페인별 팀원관리</option>
		</select>
	</div>
	<div class='submenu_list_con'>
		<select name='category' id='board_category' onchange='admin_menu(value);'>
			<option value='#'>사용자 이용 관련</option>
			<option value='/admin/date_act'>날짜별 사용내역</option>
			<option value='/admin/user_act'>사용자 이용내역</option>
			<option value='/admin/page_step'>프로젝트 단계 진행 내역</option>
			<option value='/admin/page_count'>페이지별 방문자 수</option>
			<option value='/admin/page_list_with_member/1'>페이지별 팀원 정보</option>
			<option value='/admin/page_log/'>페이지 접근환경 분석(user agent)</option>
			<option value='/admin/page_ref/'>페이지 접근환경 분석(reffer)</option>
		</select>
	</div>
</div>