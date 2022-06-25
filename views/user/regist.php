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
		//비밀번호 글자 수 체크
		$("#password_signup").keyup(function(){
		  var pword = $('#password_signup').val();
		  var p_len = pword.length;
		  //alert(p_len);
		  if(p_len<6 || p_len>21){
			$('#about_password').css('color','red');
		  }else{
			$('#about_password').css('color','#738e3d');
		  }
		});

		//확인 이메일 체크
		$("#re_email").keyup(function(){
		  var email_re = $('#re_email').val();
		  var email_org = $('#email_signup').val();
		  //alert(p_len);
		  if(email_re==""){
		  	$('#about_re_email').css('color','#738e3d');
		  	$('#about_re_email').html('이메일을 잘 못 입력하는 사례가 많습니다.<br/>위에 입력한 이메일을 다시 한번 입력해주세요.');
		  }else  if(email_re!=email_org){
			$('#about_re_email').css('color','red');
		  	$('#about_re_email').html('이메일과 이메일 확인에 입력한 정보가 맞지 않습니다.');
		  }else{
		  	$('#about_re_email').css('color','#738e3d');
		  	$('#about_re_email').html('이메일과 이메일 확인에 입력한 정보가 맞습니다.');
		  }
		});

		
											


		captcha();
	});

	//캡챠
	function captcha(){

		$.get( "/user/captcha", function( data ) {
			$('#cap_area').html(data);
			//alert( test );
		});
		
	}
	//약관
	function show_terms(){
		window.open('/docs/provisionPopup','','width=400, height=350');
	}
	//개인정보 수집정책
	function show_terms2(){
		window.open('/docs/user_rull_Popup','','width=400, height=350');
	}


	/*가입 폼검증 시작 */
	//가입하기 클릭시 사전 체크값
	function submit_check(){
		//form 기본 실행 방지 코드
		event.preventDefault();  
		//비밀번호 길이체크
		var pword = $('#password_signup').val();
		var p_len = pword.length;
		var p_txt = $('#about_password').text();
		//alert($("#password_signup").val() );
		var email = $("#email_signup").val();  
		var email_re = $('#re_email').val();
		var email_kakao = $("#email_kakao").val();  
		var regex=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;   
		var cap_num = $('#cap_num').html();
		var cap_area_val = $('#cap_area_input').val();
		var agreement = $("#agreement").is(":checked") ;
		var agreement2 = $("#agreement2").is(":checked") ;


		//alert(agreement+'-'+agreement2);
		

		  
		if(agreement === false) {  
			alert('회원가입을 하시려면, 약관에 동의해주세요..');
			 $("#agreement").focus();
			return false;  
		}else if(agreement2 === false) {  
			alert('회원가입을 하시려면, 개인정보 수집 정책에 동의해주세요..');
			 $("#agreement2").focus();
			return false;  
		}else if(regex.test(email) === false) {  
			alert('잘못된 이메일 형식입니다.');
			 $("#email_signup").focus();
			return false;  
		}else if(email_re!=email){
			alert('이메일과 이메일 확인에 입력한 정보가 맞지 않습니다. \n이메일 주소를 정확히 확인해주세요.');
			 $("#re_email").focus();
			return false;  
		}else  if(p_len<6 || p_len>21){
			//비밀번호 길이 확인
			alert(p_txt);
			$("#password_signup").focus();
			return false;  
		}else  if(cap_num!==cap_area_val){
			//캡차
			alert('자동입력 방지문자가 정확히 입력되지 않았습니다.');
			$("#cap_area_val").focus();
			return false;  
		}else {
			//document.member.submit();
			//실제 가입단계 진행하기
			$("#regist").submit();
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
<div id='container'>
	<div id='con'>
		<div id='con_main_680'>
			<!-- 오른쪽 콘텐츠 영역 시작 -->
			<div id='main_con_right' style='margin-top: 0px;'>
				<!--새로 등록된 사연-->
				<div class='main_con_right_w con_outline'>
					<?
					$now_campaign_domain = $this->session->userdata('now_campaign_domain');
					if($now_campaign_domain==''){
					?>
					<!-- 상단 로고 영역 시작-->
					<div style='float: left; width: 100%; text-align: center;'>
						<a href='/main' target='_self'>
							<img src='/img/logo.png'/>
						</a>
					</div>
					<br/>
					<h3 class='main_con_title' style='float: left; width: 100%; text-align: center; margin-top: 20px; margin-bottom: 20px;'>
						지원사업의 접수부터 심사까지,
						편리함을 경험하세요.
					</h3>
					<!-- 상단 로고 영역 끝 -->
					<?	
					}else{
					?>
					<div style='float: left; width: 100%; text-align: center;'>
						<a href='/<?echo $domain;?>' target='_self'>
							<img src='<?echo $logo;?>' style='max-width: 100%;'/>
						</a>
						<h3 class='main_con_title' style='float: left; width: 100%; text-align: center; margin-top: 20px; margin-bottom: 20px;'>
						Gwon 회원가입
						</h3>
					</div>
					<?	
					}
					?>
					
					<div class='con_area'>
						<form action='/user/sign_up_insert' method='post' name='regist' id='regist' >
							<?
							$now_campaign_domain = $this->session->userdata('now_campaign_domain');
							if($now_campaign_domain!=''){
							?>
							<div style='width: 100%; font-size: 12px; line-height: 15px; padding: 10px; padding-top: 0px;'>
							* 이 사이트는 비대면 지원사업 통합솔루션 <a href="/" target="_blank" style="font-size: 11px; font-weight: bold;">지원(Gwon)</a>을 통해 운영되고 있습니다.<br/>
							이번 회원가입은 지원(Gwon) 서비스에 대한 회원가입이며, <br/>
							지원(Gwon)을 통한 모든 공모/지원사업에서 본 회원가입 정보로 로그인하여 이용하실 수 있습니다.
							</div>
							<?	
							}
							?>
							<table border="0px" width="100%" class='inno_table'>
								<tr>
									<td>
										이름<br/>
						                                        <? if(isset($userName)){?>
						                                            <input type="text" tabindex="1" id="name" name="name" value="<?=$userName;?>"  class="form-control" placeholder="이름을 입력해주세요." style="ime-mode:inactive;" />
						                                            <span class='t_basic'>
						                                            	카카오톡 계정의 이름이 기본적으로 입력됩니다. 본명과 다를 경우 본명을 입력해주세요.
						                                            </span>
						                                        <?}else{?>
						                                            <input type="text" tabindex="1" id="name" name="name" class="form-control" placeholder="이름을 입력해주세요." style="ime-mode:inactive;" />
						                                        <?}?>

									</td>					
								</tr>
								<tr>
									<td>
										이메일<br/>
										<?php 
											if(!isset($email)){
												$email = '';
											}
											if(!isset($fb_id)){
												$fb_id = '';
											}
										?>

						                                        <? if(isset($userEmail)){?>
						                                            <input type="text" tabindex="2" id="email_signup" name="email" class="form-control" readonly value="<?=$userEmail;?>" placeholder="email@gwon.com"/>
						                                             <input type="hidden" id="email_kakao" name="email_kakao" value="<?=$userEmail;?>"/>
						                                        <?}else{?>
						                                            <input type="text" tabindex="2" id="email_signup" name="email" class="form-control" value="" placeholder="email@gwon.com"/>
						                                            <input type="hidden" id="email_kakao" name="email_kakao" value=""/>
						                                        <?}?>

										<span id="about_mail" class='t_basic'>
											전형과정에 대한 정보를 전달하기 때문에 실제 사용하고 계시는 이메일 주소를 입력해주세요.<br/>
											로그인 시 이메일+비밀번호가 사용됩니다.
										</span>
											<!-- <input style="width: 90%; " type="email" name="email_address" value="<?php echo $email;?>" />  -->
									</td>		
								</tr>
								<tr>
									<td>
										이메일 확인<br/>
										<input type="text" tabindex="3" id="re_email" name="re_email" class="form-control" value="" placeholder="이메일을 다시한번 입력해주세요."/>

										<span id="about_re_email" class='t_basic'>
											이메일을 잘 못 입력하는 사례가 많습니다.<br/>
											위에 입력한 이메일을 다시 한번 입력해주세요.
										</span>
											<!-- <input style="width: 90%; " type="email" name="email_address" value="<?php echo $email;?>" />  -->
									</td>		
								</tr>
								<tr>
									<td>
										연락처<br/>
										<input type="text" tabindex="3" id="phone_signup" name="phone" class="form-control" 
										placeholder="직접 통화/문자가 가능한 핸드폰 번호를 입력해주세요." style="ime-mode:auto;" />
										<span id="about_phone" class='t_basic'>
											
										</span>
									</td>				
								</tr>
								<tr>
									<td>
										비밀번호<br/>
										<input type="password" tabindex="4" class="form-control" id="password_signup" 
										name="password" style="ime-mode:disabled;"  placeholder="6~20자 이내로 입력해주세요."/>
										<span id="about_password" class='t_basic'>비밀번호는 6자리이상 20자리 이내로 입력해주세요.</span>
									</td>				
								</tr>
								<!--
								<tr>
									<td>
										자기 소개<br/>
										<textarea tabindex="5" name="description"  placeholder="간단한 자기소개글을 입력해 주세요."
										class="form-control" ></textarea>
									</td>
								</tr>
								-->
								<tr>
									<td valign='top'>
										자동입력 방지문자<br/>
										<div style='width:100%; padding-top: 0px;' class='t_basic'>
											아래 이미지 속 숫자를 보이는 대로 입력해주세요.
										</div><br/>
										<div id='cap_area' style='float:left; width:100%;'>
										</div>
										<div id='cap_area_val' style='float:left; width:100%; margin-top: 10px;'>
											<input id='cap_area_input' type="text" tabindex="6" id="cap_val" class="form-control" name="cap_val" style="ime-mode:auto;" />
										</div>
										
									</td>
								</tr>
							</table>
							<!-- ajax 활용시
							<div id=check_zipcode style="margin-left: 80px;">
								<!==?$this->load->view('pen/zipcode');?>
								test
							</div>
							-->
							<table border="0px" width="100%" class='inno_table'>
								<tr>
									<td>
										<label class="label_s" for="agreement">
											<input type="checkbox" tabindex="7" id ="agreement" name="agreement" class="checkbox_st"/>&nbsp; 
											<a href="javascript:show_terms();">서비스 이용약관</a>에 동의합니다.
										</label>
									</td>
								</tr>
								<tr>
									<td>
										<label class="label_s" for="agreement2">
											<input type="checkbox" tabindex="8"  id ="agreement2" name="agreement2" class="checkbox_st"/>&nbsp; 
											<a href="javascript:show_terms2();">개인정보 수집 및 이용</a>에 동의합니다.
										</label>
									</td>
								</tr>
								<tr>
									<td>
										소식 받기<br/>
										<label class="label_s" for="join_mail_list">
											<input type="checkbox" tabindex="9" id="join_mail_list" name="join_mail_list" checked class="checkbox_st"/>
											지원의 새로운 소식을 받고 싶습니다.
										</label>
									</td>
								</tr>
									
							</table>
						</form>
						<div id='bt_area' style='text-align: right; margin-top: 10px;'>
							<button tabindex="10" onclick="submit_check();" class="btn btn-success">
								가입하기
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