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

	//비밀번호 리셋
	function submit_check(check_resend){
		open_modal();
		$('#modal_txt').html('비밀번호를 재설정 중입니다.');
		//form 기본 실행 방지 코드
		var user_email = $('#user_email').val();
		if(user_email != ''){
			$.post('/user/password_reset',{
			user_email: user_email,
			check_resend: check_resend
			},
		   function(data){
		   	//alert(data);
			$('#modal_txt').html(data);
		   }); 
		}else{
			alert('이메일 주소를 입력해주세요.');
		}
		
	}

</script>
<style>
	#container{
		margin-top: 30px;
	}
	#top_area {
		height: 30px;
	}
	body{
		background:#f7f7f8;
	}
	#modal_content {
		height: 225px;
	}
	#modal_txt{
		margin-top: 25px;
		height: 160px;
		width: 96%;
		padding-left: 2%;
		padding-right: 2%;
	}
</style>
</head>
<body>
<?
$now_campaign_domain = $this->session->userdata('now_campaign_domain');
if($now_campaign_domain==''){
?>
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
<?	
}
?>
<div id='container' >
	<div id='con'>
		<div id='con_main_680'>
			<!-- 오른쪽 콘텐츠 영역 시작 -->
			<div id='main_con_right' style='margin-top: 0px;'>
				<!--새로 등록된 사연-->
				<div class='main_con_right_w con_outline'>
					<div style='float: left; width: 100%; text-align: center;'>
						<?
						$now_campaign_domain = $this->session->userdata('now_campaign_domain');
						if($now_campaign_domain==''){
						?>
						<!-- 상단 로고 영역 시작-->
						<a href='/main' target='_self'>
							<img src='/img/logo.png'/>
						</a>
						<!-- 상단 로고 영역 끝 -->
						<?	
						}else{
						?>

						<div style='float: left; width: 100%; text-align: center;'>
							<a href='/<?echo $domain;?>' target='_self'>
								<img src='<?echo $logo;?>' style='max-width: 100%;'/>
							</a>
						</div>
						<?	
						}
						?>
					</div>
					<br/>
					<div class='con_area'>
						<div id='login_area'>
							<h3>비밀번호 찾기</h3>
							E-mail<br/>
							<input type='text' id="user_email" name="user_email" class="form-control" style='display: inline-block; height: 45px; width: 240px; margin-right: 10px; margin-bottom: 10px;'/>

							<button onclick="submit_check();" class='inno_bt'>
								비밀번호 찾기
							</button>
							<p style='font-size: 11px; font-weight: normal; font-family: "돋음"; margin-bottom: 10px;'>
								회원가입시 입력하셨던 이메일 주소를 입력하시면, 변경된 암호를 전송합니다.
							</p>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<?
	$now_campaign_domain=$this->session->userdata('now_campaign_domain');
	if($now_campaign_domain==''){
	?>
	<!-- 하단 영역 공통 시작-->
	<?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
	<!-- 하단 영역 공통 끝 -->
	<?	
	}else{
	?>
	<div style='width: 100%; text-align: center;'>
		©  2020 <a href='/' target='_blank'>Gwon.net</a>
	</div>
	<!--모달창 출력부분 시작-->
	<div id='modal_content'>
		 <div id='modal_txt'>
			가상 팝업 내용 출력부분!
		</div>
		<div id='login_close'>
			<a href='javascript:modal_off();'><img src='/img/basic/bt_close.png' alt='close button' /></a>
		</div>
	</div>
	<!--모달창 출력부분 끝 -->
	<!--modal창 관련 -->
	<script type='text/javascript' src='/js/jquery.simplemodal.js'></script>
	<!--modal창 관련 ****꼭 하단에. 상단에 넣으면 작동 안될 가능성 존재함-->
	<?
	}
	?>
	
	
</div>
</body>
</html>