<!--link href="css/screen_origin.css" type="text/css" rel="stylesheet" media="screen,projection" /-->
<script type="text/javascript">
	//jQuery 있는 상태
	window.onload=function(){
	    //$('#sc2_2').hide();

	    $(window).scroll(function(){
	        var scr_now = $(document).scrollTop();
	        //현재 스크롤
	        //alert(scr_now);


	    });
	};
	$(document).ready(function() {
		
	});

</script>
<style>
#resp_result_area2{
	background: #fff;
}
</style>
<?
if(isset($step)){
?>
<div id="eval_con_area">
	<h3><?if(isset($step_title)) echo $step_title;?> : <?if(isset($field_type_txt)) echo $field_type_txt;?></h3>
	<?include_once $this->config->item('basic_url')."/include/inc_eval_menu.php";?>
	<?
	//include_once $this->config->item('basic_url')."/include/inc_responses_table.php";?>
	<div class='dash_con'>
		<h3>평가위원 추가</h3>
		<script type="text/javascript">
			//멤버 추가하기
			function add_authors(u_id,name){
				alert('등록중입니다. 잠시만 기다려주세요.');
				var w_num = <?echo $w_num;?>;
				var step = <?echo $step;?>;
				$.post('/evaluate/add_eval_member/',{
				    w_num: w_num,
				    step: step,
				    u_id: u_id,
				    name: name
				},
				function(data){
					alert(data);
					if(data == '등록이 완료되었습니다.'){
						$('#search_result_team_mate').html(data);
						$('#co_authors').val('');
						$('#co_authors_query_result').html('');
					}else{
						open_modal(data);
						//fadeout_modal();
						$('#co_authors_query_result').html('');
				 		$('#co_authors').val('');
					}
					check_eval_member();
				});

			}
			//초대장 발송하기
			function send_invite_eval(email){
				var w_num = <?echo $w_num;?>;
				var step = <?echo $step;?>;
				
				$.post('/evaluate/invite_eval_member/',{
				    w_num: w_num,
				    step: step,
				    email: email
				},
				function(data){
					//alert(data);
					if(data == '등록이 완료되었습니다.'){
						$('#search_result_team_mate').html(data);
						$('#co_authors').val('');
						$('#co_authors_query_result').html('');
					}else{
						alert(data);
						$('#co_authors_query_result').html('');
				 		$('#co_authors').val('');
					}
					check_eval_member();
				});
			}

			//평가위원 새로고침
			function del_eval_member(w_num,step,user_id,email){
				$.post('/evaluate/del_eval_member/',{
				    w_num: w_num,
				    step: step,
				    user_id: user_id,
				    email: email
				},
				function(data){
					alert(data);
					check_eval_member();
				});

			}

			//평가위원 새로고침
			function check_eval_member(){
				var w_num = <?echo $w_num;?>;
				var step = <?echo $step;?>;
				$.post('/evaluate/check_eval_member/',{
				    w_num: w_num,
				    step: step
				},
				function(data){
					$('#eval_member_area').html(data);
				});

			}
		</script>
		<input id="now_page" name="now_page" class="form-control" type="hidden" value="eval_member_set" />
		<?$this->load->view('/include/search_mail');?>
		<div id="search_result_team_mate" class="ajax_result"></div>
		<h3>평가위원 리스트</h3>
		<hr style="margin-top:5px; margin-bottom: 10px;"/>
		<div id="eval_member_area" style="width: 100%;">
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
		</div>
          </div>	
</div>
<?
}else{
	echo '단계 설정 정보가 없습니다.<br/>';
}?>