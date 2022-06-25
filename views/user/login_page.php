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
</style>
</head>
<body>
<?
$now_campaign_domain = $this->session->userdata('now_campaign_domain');
$kakaoLoginUrl = $this->config->item('kakaoLoginUrl');
$kakaoLoginUrl2 = $this->config->item('kakaoLoginUrl2');
$kakaoLoginUrl3 = $this->config->item('kakaoLoginUrl3');
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
							<h3>로그인</h3>
							<form id='form1' method='post' action='/user/login'>
								e-mail<br/>
								<input type='text' name='email' placeholder="이메일 주소를 입력해주세요." class="form-control" style='margin-bottom: 10px;'/>
								Password<br/>
								<input type='password' name='password' placeholder="6~20자 이내로 비밀번호가 구성되어 있습니다." class="form-control" style='margin-bottom: 5px;'/>
								<p style='font-size: 11px; font-weight: normal; font-family: "돋음"; margin-bottom: 10px;'>
									<a href='/user/find_password' target='_self'>비밀번호 찾기</a>
									&nbsp;|&nbsp;
									<a href='/user' target='_self'>회원가입</a>
									&nbsp;|&nbsp;
									<a href='<?=$kakaoLoginUrl2;?>' target='_self'>카카오톡 회원가입</a>
								</p>
								<?
									//$now_url = $_SERVER['REQUEST_URI'];
									$now_url_ss=$this->session->userdata('now_url_ss');
									$now_campaign_domain=$this->session->userdata('now_campaign_domain');
									if($now_campaign_domain!=''){
										$now_url = '/'.$now_campaign_domain;
									}else{
										$now_url = $now_url_ss;
									}
								?>
								<input type='hidden' name='now_url' style='width: 100%' value='<?echo $now_url;?>' />
								<button type='submit'  class='inno_bt' style='width: 100%; text-align: center;'>
									로그인
								</button>
								<button type='button' onclick="kakao_login();"  class='inno_bt' style='width: 100%; text-align: center;margin-top: 5px;'>
									카카오톡 로그인
								</button>
							</form>
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
<script type="application/javascript">
     function kakao_login() {
        location.href='<?=$kakaoLoginUrl;?>';
     }

</script>
</body>
</html>