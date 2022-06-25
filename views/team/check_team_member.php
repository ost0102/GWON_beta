<? if(isset($member)){
		$user=$this->session->userdata('ipg_users');
		echo '<h3>Team member</h3>
		<hr style="margin-top:5px; margin-bottom: 10px;"/>';
		foreach ($member as $member)
		{
			$u_id = $member['id'];
			$u_secur = do_hash($u_id);
			$username = $member['username'];
			$email = $member['email'];
			$photo = $member['photo'];
			$state = $member['state'];
			$u_position = $member['u_position'];
			$user=$this->session->userdata('ipg_users');

			if($state ==1){
				$state_txt = '팀원신청';
			}else if($state ==2){
				$state_txt = '팀원';
			}else if($state ==3){
				$state_txt = '팀원 거부';
			}

			if($u_position ==1){
				$state_txt = '응원단';
			}else if($u_position ==2){
				$state_txt = '팀원';
			}else if($u_position ==3){
				$state_txt = '관리자';
			}


			echo "
			<table style='width:100%'>
			<tr><td style='width: 70px;'>
			<img src='".$photo."' style='border: 1px solid #cdcdcd; max-width: 100%;'></td>
			<td style='width:10px;'></td><td><b>
				<a href='/@".$u_secur."' target='_self'>".$username."</a></b>(".$email.")<br/>
				".$state_txt;
			if(isset($edit_user)){
				echo "<br/><a href='javascript:set_team_member(\"".$t_id."_".$u_id."\");' >수정하기</a>";
			}

			if($u_position == 3){
				if($u_id==$user && $total_admin_member > 1 ||isset($edit_user) && $total_admin_member > 1){
					echo "&nbsp;&nbsp;&nbsp;<a href='javascript:del_team_member(\"".$t_id."_".$u_id."\");' >삭제하기</a>";
				}
			}else{
				if($u_id==$user  || isset($edit_user)){
					echo "&nbsp;&nbsp;&nbsp;<a href='javascript:del_team_member(\"".$t_id."_".$u_id."\");' >삭제하기</a>";
				}
			}
			
			echo "</td></tr></table>";
			
		}
}else{
	echo '등록된 팀원이 없습니다.';
}
?>