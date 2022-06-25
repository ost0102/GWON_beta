
<div class='main_con_left_w con_outline'>
	<div class='submenu_list'>

		<h3 class='main_con_title'>
			관리자 메뉴
		</h3>
		
		<div class='submenu_list_con'>
			<a href='/admin/main'>
				메인
			</a>
		</div>
		<div class='submenu_list_con'>
			<a href='/admin/sgsg_cate/' target='_self'>
				카테고리 관리
			</a>
		</div>
		
		<div class='submenu_list_con'>
			<select name='category' id='board_category' onchange='admin_menu(value);' class="form-control"  style='width: 100%;'>
				<option value='#'>기본 메뉴/랜딩 관련</option>
				<option value='/admin/mail_list/1'>메일링 리스트</option>
				<option value='/admin/admin_user'>관리자 계정</option>
				<option value='/admin/user_list'>사용자 계정</option>
			</select>
		</div>

		
		<div class='submenu_list_con'>
			<select name='category' id='board_category' onchange='admin_menu(value);' class="form-control"  style='width: 100%;'>
				<option value='#'>사용자 이용 관련</option>
				<option value='/admin/date_act'>날짜별 사용내역</option>
				<option value='/admin/user_act'>사용자 이용내역</option>
				<option value='/admin/page_step'>프로젝트 단계 진행 내역</option>
				<option value='/admin/page_count'>페이지별 방문자 수</option>
				<option value='/admin/page_log/'>페이지 접근환경 분석(user agent)</option>
				<option value='/admin/page_ref/'>페이지 접근환경 분석(reffer)</option>
			</select>
		</div>

	</div>
</div>
<script type="text/javascript">
	function admin_menu(admin_url){
		location.href = admin_url;
	}
</script>


		
		
      		