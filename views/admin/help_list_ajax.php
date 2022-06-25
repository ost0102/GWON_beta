<? if(isset($help_list)){
		//print_r($linked_info);
		$first_check = 0;
		foreach ($help_list as $help_list)
		{
			//print_r($row);
			//class_no가 없을 경우 최근 값을 가져와라
			$offer_id = $help_list['offer_id'];
			$name = $help_list['name'];
			$user_id = $help_list['user_id'];
			$phone = $help_list['phone'];
			$price = $help_list['price'];
			$offer_area = $help_list['offer_area'];
			$offer_con = $help_list['offer_con'];
			$p_num = $help_list['p_num'];
			$social = $help_list['social'];
			$check_response = $help_list['check_response'];
			$check_state = $help_list['check_state'];
			$price = number_format($price);

			//p_secur가 있으면 활성화된 페이지 정보가 있는거
			if(isset($help_list['p_secur'])){
				$p_secur = $help_list['p_secur'];
				$p_title = $help_list['p_title'];
				$p_script = $help_list['p_script'];
				$p_domain = $help_list['p_domain']; 
				$project_img = $help_list['project_img']; 
				$logo = $help_list['logo']; 

				if(isset($help_list['project_img'])){
					$project_img = $help_list['project_img']; 
				}else if(isset($logo) && $logo!=''){
					$project_img = $logo;
				}else{
					$project_img = '/img/intropage_twt.jpg';
				}
			}else{
				if($offer_area !=3){
					$p_title = '신규 페이지';
					$p_script = '새로 제작될 페이지에 대한 기술 요청을 신청하셨습니다.';
					$project_img = '/img/intropage_twt.jpg';
				}else{
					$p_title = '메일 문의';
					$p_script = '메일 문의 내용입니다.';
					$project_img = '/img/intropage_twt.jpg';
				}
			}
			if($user_id == 0){
				$user_id_type ='비회원';
			}else{
				$user_id_type ='회원';
			}

			if($check_response == 'n'){
				$check_txt = '접수';
				$now_state_txt = '<b>접수</b> > 진행 > 완료';
			}else if($check_response == 'y' && $check_state <= 2){
				$check_txt = '진행';
				$now_state_txt = '접수 > <b>진행</b> > 완료';
			}else{
				$check_txt = '완료';
				$now_state_txt = '접수 > 진행 > <b>완료</b>';
			}

			if($offer_area == 1){
				$offer_area_txt = '기술지원 요청';
			}else if($offer_area == 2){
				$offer_area_txt = '추가 지원';
			}else if($offer_area == 3){
				$offer_area_txt = '기타';
			}else if($offer_area == 4){
				$offer_area_txt = '시리즈 맵';
			}

			echo "<div class='project_con'>";

			if($first_check!==0){
				echo "<hr style='margin-bottom:10px;'/>";
			}
			
			echo "
				<table width='100%'>
					<tr>
						<td valign='top' style='width: 110px;'>
							<div class='circular' style='background:url(".$project_img.") #cdcdcd no-repeat center center; width: 90px; height:90px; background-size:100px 100px;'></div>
						</td>
						<td valign='top'>
							<h3>".$p_title."</h3><span>".$p_script."<br/>
							<div style='float:left; margin-right: 10px;' white-space:nowrap;>요청자 : ".$name."(".$user_id_type.") /</div>
							<div style='float:left; margin-right: 10px;' white-space:nowrap;>요청 범위 : ".$offer_area_txt." /</div>
							<div style='float:left; margin-right: 10px;' white-space:nowrap;>견적 : ".$price." /</div>
							<div style='float:left; margin-right: 10px;' white-space:nowrap;> 상태 :".$check_txt."</div></span>";
							//페이지정보
							echo "<div style='float:left; width: 100%; margin-top: 10px; white-space:nowrap;'><img src='/img/icon/icon_search.png' style='margin-right: 5px; width: 15px;'/><a href='/admin/show_help_detail/".$offer_id."' target='_self'>상세보기</a>";
							"</div>";

			echo"		</td>
					</tr>
				</table>";
			echo "</div>";
			$first_check++;
		}
}else{
	echo '요청한 내역이 없습니다.<br/> <a href="/makepage/" target="_self">intropage 생성하기</a>';
}?>