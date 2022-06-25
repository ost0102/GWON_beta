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

	function go_home(go_url) {
		if(go_url==''){
			location.href="/main";
		}else{
			location.href="/user/login_page";
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
							<h3>환영합니다.</h3><br/>
							회원가입이 완료되었습니다.<br/>
							입력하셨던 이메일 주소와 비밀번호로<br/>
							다시 로그인 하신 후 이용이 가능합니다.<br/><br/>

							<?
								//$now_url = $_SERVER['REQUEST_URI'];
								$now_url=$this->session->userdata('now_url_ss');
								//$now_url = $_SERVER['REQUEST_URI'];
								$now_campaign_domain=$this->session->userdata('now_campaign_domain');

								if($now_campaign_domain!=''){
									$go_url = $now_campaign_domain;
								}else{
									$go_url = '';
								}
							?>	
							<button class="inno_bt" onClick="go_home('<?echo $go_url;?>')" target="_self" title="돌아가기">
								회원가입 완료
							</button>
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
	<?
	}
	?>
	
	
</div>
</body>
</html>