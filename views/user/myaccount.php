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
		$(document).ready(function(){
			
		});
	};
		



</script>
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
				<!-- sub_top area include -->
				<?include_once $this->config->item('basic_url')."/include/inc_top_menu_login.php";?>
			</div>
		</div>
	</div>
	<div id='top_con'>
       		<?include_once $this->config->item('basic_url')."/include/inc_top_menu.php";?>
	</div>
</div>
<!-- 상단 영역 공통 끝 -->
<div id='container'>
	<div id='con'>
		<div id='con_main'>

			<!-- 왼쪽 콘텐츠 영역 시작 -->
			<div id='main_con_left' style='margin-top: 0px;'>
				<!--마이페이지메뉴-->
				<div class='main_con_left_w con_outline menu_mypage'>
					<?include_once $this->config->item('basic_url')."/include/inc_mypage_sub_menu.php";?>
				</div>
			</div>
			<!-- 오른쪽 콘텐츠 영역 시작 -->
			<div id='main_con_right' style='margin-top: 0px;'>
				<!--새로 등록된 사연-->
				<div class='main_con_right_w con_outline'>
					
					<table border="0px" width="100%">
						<tr>
							<td>
								<h3 class='main_con_title'>
									기본 정보
								</h3>
							</td>
							<td style="text-align:right;">
								<a href="/user/edit_profile" target="_self"><img src='/img/icon/icon_set.png' style='width:16px; margin-right: 5px;' valign='middle'>edit</a>&nbsp;&nbsp;&nbsp;
								<a href="/user/logout"  ><img src='/img/icon/icon_close.png' style='width:16px; margin-right: 5px;' valign='middle'>logout</a>
							</td>
						</tr>
					</table>
					<div class='donate_con_list'>
						<table border="0px" width="100%" class='inno_table'>
							<tr>
								<td valign='top' style="text-align: left; width: 130px;">
									이름
								</td>
								<td>
									<?php echo $name;?>
								</td>					
							</tr>
							<tr>
								<td width="100px">이메일</td>
								<td width="600px">

									<?php echo $email;?>
										<!-- <input style="width: 90%; " type="email" name="email_address" value="<?php echo $email;?>" />  -->
								</td>		
							</tr>
							<tr>
								<td width="100px">카카오톡 연동</td>
								<td width="600px">
									<?php 
										if($kakao_email!=''){
											echo '연동중입니다. (<a href="/user/kakao_disconnection">해제하기</a>)';
										}else{
											echo '<a href="'.$kakaoLoginUrl3.'">연동 하기</a>';
										}
											
									?>
										<!-- <input style="width: 90%; " type="email" name="email_address" value="<?php echo $email;?>" />  -->
								</td>		
							</tr>
							<tr>
								<td valign=top>비밀번호</td>
								<td>
									<a href='/user/edit_passwd'>비밀번호 변경하기</a>
								</td>				
							</tr>
							<tr>
								<td valign=top>연락처</td>
								<td>
									<?php echo $phone;?>
								</td>				
							</tr>
							<tr>
								<td>자기 소개</td>
								<td>
									<?php echo $description;?>
								</td>
							</tr>
							<tr>
								<td valign='top'>소식 받기</td>
								<td valign='top'>
									<? if($check_mail == 'stop'){?>
										주요 이메일만 받고 있습니다.&nbsp;&nbsp;
										<a href="/mail/start_mail/<?php echo $email;?>" target="_blank">다시 받기</a>
									<?}else{?>
										모든 이메일을 받고 있습니다.&nbsp;&nbsp;
										<a href="/mail/stop_mail/<?php echo $email;?>" target="_blank">그만 받기</a>
									<?}?>
								</td>
							</tr>
						</table>
					</div>

				</div>
			</div>

		</div>

		
	</div>
	<?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
	
</div>
</body>
</html>