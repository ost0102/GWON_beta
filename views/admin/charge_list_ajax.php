<? if(isset($charge_list)){
	//print_r($linked_info);

	$first_check = 0;
	foreach ($charge_list as $charge_list)
	{
		//print_r($row);
		//class_no가 없을 경우 최근 값을 가져와라
		$offer_id = $charge_list['offer_id'];
		$res_id = $charge_list['res_id'];
		$phone = $charge_list['phone'];
		$price = $charge_list['price'];
		$offer_area = $charge_list['offer_area'];
		$offer_con = $charge_list['offer_con'];
		$p_num = $charge_list['p_num'];
		$social = $charge_list['social'];
		$check_state = $charge_list['check_state'];
		$price = number_format($price);

		//p_secur가 있으면 활성화된 페이지 정보가 있는거
		if(isset($charge_list['p_secur'])){
			$p_secur = $charge_list['p_secur'];
			$p_title = $charge_list['p_title'];
			$p_script = $charge_list['p_script'];
			$p_domain = $charge_list['p_domain']; 
			$project_img = $charge_list['project_img']; 
			$logo = $charge_list['logo']; 

			if(isset($charge_list['project_img'])){
				$project_img = $charge_list['project_img']; 
			}else if(isset($logo) && $logo!=''){
				$project_img = $logo;
			}else{
				$project_img = '/img/intropage_twt.jpg';
			}
		}else{
			$p_title = '신규 페이지';
			$p_script = '새로 제작될 페이지에 대한 기술 요청을 신청하셨습니다.';
			$project_img = '/img/intropage_twt.jpg';
		}
		

		if($check_state == 4){
			$check_txt = '결제 시작';
		}else if($check_state == 5){
			$check_txt = '계산서 발행';
		}else if($check_state == 6){
			$check_txt = '입금 확인';
		}else if($check_state == 7){
			$check_txt = '완료';
		}

		if($offer_area == 1){
			$offer_area_txt = '기술지원 요청';
		}else if($offer_area == 2){
			$offer_area_txt = '추가 지원';
		}else if($offer_area == 3){
			$offer_area_txt = '기타';
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
						<div style='float:left; margin-right: 10px;' white-space:nowrap;>요청 범위 : ".$offer_area_txt." /</div>
						<div style='float:left; margin-right: 10px;' white-space:nowrap;>견적 : ".$price." /</div>
						<div style='float:left; margin-right: 10px;' white-space:nowrap;> 상태 :".$check_txt."</div></span><div style='width: 100%; margin-top: 10px;'><br/>";
						//페이지정보
						echo "<img src='/img/icon/icon_search.png' style='margin-right: 5px; width: 15px;'/><a href='/admin/show_charge_detail/".$res_id."' target='_self'>상세보기</a>";
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