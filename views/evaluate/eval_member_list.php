<?
if($eval_member!=''){
	foreach ($eval_member as $member)
	{
		$w_num = $member['w_num'];
		$step = $member['step'];
		$user_id = $member['user_id'];
		$email = $member['email'];
		$date = $member['date'];
		$id_secur = $member['id_secur'];
		$username = $member['username'];

		echo "
		<table style='width:100%'>
		<tr>
			<td>";
		if($username==''){
			echo "".$email."&nbsp;&nbsp;";
		}else{
			echo "<b><a href='/@".$id_secur."' target='_blank'>".$username."</a></b>(".$email.")&nbsp;&nbsp;";
		}

		echo "<a href='javascript:del_eval_member(\"".$w_num."\",\"".$step."\",\"".$user_id."\",\"".$email."\");' >삭제하기</a>";
		
		echo "</td></tr></table>";
		
	}
}else{
	echo '등록된 평가위원이 없습니다.';
}
?>