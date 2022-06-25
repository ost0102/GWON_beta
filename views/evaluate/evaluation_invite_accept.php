<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?$this->load->view('/include/head_info');?>

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

	function goto_myproject(){
		location.href = '/mypage';
	}

	


</script>
<style>
	#container{
		margin-top: 30px;
	}
	#top_area {
		height: 30px;
	}
</style>
</head>
<body>
<!-- 상단 영역 공통 시작-->
<div id='top_area'>
	<div id='top_noti'>
		<div id='top_noti_con'>
			<div id='top_noti_con_txt'>
		                <!-- noti_txt -->
		                <?include_once $this->config->item('basic_url')."/include/inc_top_noti_txt.php";?>
			</div>
			<div id='top_menu_area'>
				<?include_once $this->config->item('basic_url')."/include/inc_top_menu_login.php";?>
			</div>
		</div>
	</div>
</div>
<!-- 상단 영역 공통 끝 -->
<div id='container'>
	<div id='con'>
		<div id='con_main_680'>
			<!-- 오른쪽 콘텐츠 영역 시작 -->
			<div id='main_con_right' style='margin-top: 0px;'>
				<!--새로 등록된 사연-->
				<div class='main_con_right_w con_outline'>
					<div style='float: left; width: 100%; text-align: center; margin-bottom: 10px; '>
						<a href='/main' target='_self'>
							<img src='/img/logo.png'/>
						</a>
					</div>
					<br/>
					<div id='user_profile' style='margin-bottom: 10px; padding-bottom: 10px; padding-top: 10px; text-align: center; border-bottom: 1px solid #cdcdcd;'>
						<h3 style='margin-top:10px; padding-bottom:10px;'>
							<?
								$user=$this->session->userdata('gwon_users');
								$user_email=$this->session->userdata('email');
								$username=$this->session->userdata('username');
								if(isset($email)){
								//print_r($linked_info);
									echo $email.'를 평가위원으로 초대한 리스트입니다.';
								}
								if($user_email!=''){
									echo '<br/><br/>현재 '.$username.'('.$user_email.')로 로그인되어 있습니다.<br/> 승인하기 버튼을 클릭 시 현재 로그인 된 계정과 연결됩니다.';
								}else{
									echo '<br/><b>로그인 후 초대를 수락할 수 있습니다.</b>';
								}

							?>
						</h3>
					</div>
					<div id="con_info_area" style='min-height: 300px; padding: 10px;'>
						<h3>초대 리스트</h3>
						<hr style="margin-top:5px; margin-bottom: 10px;"/>
						<script type="text/javascript">
						//평가위원 새로고침
						function accept_eval_member(w_num,step,user_id,email){
							$.post('/evaluate/accept_eval_member/',{
							    w_num: w_num,
							    step: step,
							    user_id: user_id,
							    email: email
							},
							function(data){
								alert(data);
								if(data==0){
									alert("로그인 후 이용가능합니다");
								}else{
									location.reload();
								}
							});

						}
						</script>
						<!--include 정보 출력 부분 -->
						<?
						if($eval_invite_list!=''){
							
							echo "
								<table style='width:100%'>";
							foreach ($eval_invite_list as $eval_list)
							{
								$w_num = $eval_list['w_num'];
								$step = $eval_list['step'];
								$date = $eval_list['date'];
								$title = $eval_list['title'];

								echo "
								<tr>
									<td>";
								echo "<b>".$title."</b>에 초대되었습니다.&nbsp;";
								echo date('Y-m-d', strtotime($date))."&nbsp;";


								if($user_email!=''){
									echo "<a href='javascript:accept_eval_member(\"".$w_num."\",\"".$step."\",\"".$user."\",\"".$email."\");' ><b>수락하기</b></a>";
								}
								
								echo "</td></tr>";
								
							}
							echo "</table>";
						}else{
							echo '등록된 평가위원이 없습니다.';
						}
						?>
					</div>

				</div>
			</div>

		</div>

		
	</div>
	<?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
	
</div>
</body>
</html>