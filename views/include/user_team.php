<!--사용자가 소속된 팀 정보-->
<? if(isset($user_team)){
		//print_r($linked_info);
		echo '
		<h3>소속팀</h3>
		<hr style="margin-top:5px; margin-bottom: 10px;"/>';
		foreach ($user_team as $team)
		{
			$t_id = $team['t_id'];
			$t_secur = $team['t_secur'];
			$t_name = $team['t_name'];
			$t_script = $team['t_script'];
			$category = $team['category'];
			$date_time = $team['date_time'];
			$conected_project = $team['conected_project'];
			echo "
			<div style='width: 100%; float:left; padding-bottom: 10px; margin-bottom: 5px; border-bottom: 1px solid #cdcdcd;'><b>
				<a href='/team/team_info/".$t_secur."' target='_self'>".$t_name."</a></b><br/>".$t_script."<br/>
				참여일 :".$date_time;

			if($conected_project=='Y'){
				echo'<br/>[연결된 프로젝트 정보가 있습니다.]';
			}else{
				echo '<br/>[연결된 정보가 아직 없습니다.]';
			}
			
			echo "</div>";
		}
}else{
	echo '프로젝트 참여정보가 없습니다.<br/>';
}?>