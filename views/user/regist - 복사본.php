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
		var phone = $("#phone_signup").val();  
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
		}else if($("#name").val() == "" || nameCheck($("#name").val()) == true ){	
			 alert("이름은 한글, 영문만 입력하실 수 있습니다.");
			 $("#name").focus();
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
		}else  if(phone==""){
			//캡차
			alert('연락처 정보를 입력해주세요..');
			$("#phone_signup").focus();
			return false;  
		}else {
			//document.member.submit();
			//실제 가입단계 진행하기
			$("#regist").submit();
		}   
	}


</script>
<style>
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
				<!-- sub_top area include -->
				쉬워지는 지원사업 Gwon
			</div>
			<div id='top_menu_area'>
				이미 회원이신가요?
				<a href = '/user/login_page'>로그인</a>
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
					<div class='donate_con_list'>
						<form action='/user/sign_up_insert' method='post' name='regist' id='regist' >

							<table border="0px" width="100%" class='inno_table'>
								<tr>
									<td>
										이름<br/>
										<input type="text" tabindex="1" id="name" name="name" class="form-control" value="" style="width: 90%; ime-mode:disabled" />
									</td>					
								</tr>
								<tr>
									<td width="600px">
										이메일<br/>
										<?php 
											if(!isset($email)){
												$email = '';
											}
											if(!isset($fb_id)){
												$fb_id = '';
											}
										?>
										<input type="text" tabindex="3" id="email_signup" name="email" class="form-control" 
										value="" style="width: 90%;" /> 
										<span id="about_mail" class='t_basic'>
											전형과정에 대한 정보를 전달하기 때문에 실제 사용하고 계시는 이메일 주소를 입력해주세요.
										</span>
											<!-- <input style="width: 90%; " type="email" name="email_address" value="<?php echo $email;?>" />  -->
									</td>		
								</tr>
								<tr>
									<td>
										비밀번호<br/>
										<input type="password" tabindex="4" class="form-control" id="password_signup" name="password" style="width: 90%; ime-mode:disabled" />
										<br/><span id="about_password" class='t_basic'>비밀번호는 6자리이상 20자리 이내로 입력해주세요.</span>
									</td>				
								</tr>
								<tr>
									<td>
										연락처<br/>
										<input type="text" tabindex="5" id="phone_signup" name="phone" class="form-control" style="width: 90%; ime-mode:disabled" />
										<br/><span id="about_phone" class='t_basic'>
											연락처는 직접 통화/문자가 가능한 핸드폰 번호를 입력해주세요.
										</span>
									</td>				
								</tr>
								<tr>
									<td>
										자기 소개<br/>
										<textarea tabindex="6" name="description"  style="width: 90%;" class="form-control" ></textarea>
									</td>
								</tr>
								<tr>
									<td valign='top'>
										소식 받기<br/>
										<input type="checkbox" tabindex="7" name="join_mail_list" class="checkbox_st"/>
										새로운 소식을 받고 싶습니다.
									</td>
								</tr>
								<tr>
									<td valign='top'>
										자동입력 방지문자<br/>
										<div style='width:100%; padding-top: 0px;' class='t_basic'>아래 이미지 속 숫자를 보이는 대로 입력해주세요.</div><br/>
										<div id='cap_area' style='float:left; width:100%;'>
										</div>
										<div id='cap_area_val' style='float:left; width:100%; margin-top: 10px;'>
											<input id='cap_area_input' type="text" tabindex="7" id="cap_val" class="form-control" name="cap_val" style="width: 90%; ime-mode:disabled" />
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
									<td width="100px"><b><a onClick="show_terms(); return false;" class="bright_link_text" href="#">약관보기</a></b></td>
									<td width="600px">
										<input type="checkbox" tabindex="8" id ="agreement" name="agreement" class="checkbox_st"/>&nbsp; 약관에 동의합니다.</td>
								</tr>
								<tr>
									<td width="100px"><b><a onClick="show_terms2(); return false;" class="bright_link_text" href="#">개인정보<br/>수집 정책</a></b></td>
									<td width="600px">
										<input type="checkbox" tabindex="9"  id ="agreement2" name="agreement2" class="checkbox_st"/>&nbsp; 개인정보 수집 및 이용에 동의합니다.</td>
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
	<?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
	
</div>
</body>
</html>