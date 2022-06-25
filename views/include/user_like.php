<!--사용자가 '좋아요'한 정보, 또는 facebook, twt 에 공유한 정보-->
<? if(isset($like_project)){
		//print_r($linked_info);
		echo '
		<h3>공유한 프로젝트</h3>
		<hr style="margin-top:5px; margin-bottom: 10px;"/>';
		foreach ($like_project as $like_project)
		{
			//print_r($row);
			//class_no가 없을 경우 최근 값을 가져와라
			$cate_id = $like_project['cate_id'];
			$title = $like_project['title'];
			$summary = $like_project['summary'];
			$logo = $like_project['logo'];
			$date = $like_project['date'];
			$domain = $like_project['domain'];
			$p_num = $like_project['p_num'];
			$state = $like_project['state'];
			$project_img = $like_project['project_img'];
			if($state=='0'){
				$state_txt = '&nbsp;<img src="/img/icon/icon_sandglass.png" style="width: 10px; margin-bottom: 0px;" valign="middle">';
			}else{
				$state_txt = '';
			}

			if($project_img!=''){
				$project_img = $project_img;
			}else if($logo!=''){
				$project_img = $logo;
			}else{
				$project_img = '/img/intropage_twt.jpg';
				
			}
			
			echo "
			<div style='width: 100%; float:left; margin-top: 10px; margin-bottom: 10px;'>
				<table width='100%'>
					<tr>
						<td valign='top' style='width: 110px;'><div class='circular' style='background:url(".$project_img.") #cdcdcd no-repeat center center; width: 90px; height:90px; background-size:100px 100px;'>
						</td>
						<td valign='top'>
							<h3>".$title.$state_txt."</h3><span style='font-size: 12px;'>".$summary."<br/>
							공유일 :".$date."&nbsp;|&nbsp;".$cate_id."</span><div style='width: 100%; margin-top: 10px;'>";
							//페이지정보

			echo"		</div></td>
					</tr>
				</table>";
			
			
			//활성화된 정보의 경우 URL 및 기타 보기 메뉴 출력
			if($state!='0'){
				echo "<div style='float: left; width:100%; padding-top: 10px; padding-bottom: 10px; border: 1px solid #cdcdcd; margin-top:10px; margin-bottom: 10px; border-radius: 10px; color: #cdcdcd; size: 12px;'>";
				echo "<div style='float: left;'><a href='".$this->config->item('base_url')."/".$domain."' target='_blank'><img src='/img/icon/icon_link.png' style='margin-left: 15px; margin-right: 5px; width: 15px;'/>".$this->config->item('base_url')."/".$domain."</a></div>";
				//echo "<div style='width: 230px; float: left;'><a href='http://intropage.net/".$domain."/1#!/0' target='_blank'><img src='/img/icon/icon_pt.png' style='margin-left: 15px; margin-right: 5px; width: 15px;'/>Presentation</a>";
				//echo "<a href='http://intropage.net/".$domain."/2#!/0' target='_blank'><img src='/img/icon/icon_print.png' style='margin-left: 15px; margin-right: 5px; width: 15px;'/>Print</a></div>";
				echo "</div>";
			}
			
			echo "<hr style='margin-top:10px;'/>";
			echo "</div>";
		}
}else{
	echo '좋아요를 누른 프로젝트 정보가 없습니다.<br/>';
}?>