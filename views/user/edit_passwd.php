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

	function passwd_edit_check(){
		//form 기본 실행 방지 코드
		event.preventDefault();  
		//비밀번호 길이체크
		var pword = $('#password_signup').val();
		var new_pw2 = $('#new_pw2').val();
		var p_len = pword.length;
		var p_txt = $('#about_password').text();
		//alert($("#password_signup").val() );
		var email = $("#email_signup").val();  
		var regex=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;   
		  
		if(p_len<6 || p_len>21){
			//비밀번호 길이 확인
			alert(p_txt);
			$("#password_signup").focus();
			return false;  
		}else if(pword != new_pw2){
			//비밀번호 길이 확인
			alert('새로운 비밀번호와 재입력 비밀번호가 다릅니다.');
			$("#password_signup").focus();
			return false;  
		}else {
			//document.member.submit();
			//실제 가입단계 진행하기
			$("#regist").submit();
		}   
	}



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

			<!-- 상단 메인 배너 -->
			<div id='sub_top_banner' style='background: #fff;'>
				<div id='sub_top_banner_con' style='width: 90%;'>
					<div id='login_area'>
						<h3>비밀번호 변경하기</h3>


						<form action='/user/update_passwd' method='post' name='regist' id='regist' >
						<table border="0px" width="100%" class="inno_table">
							<tr>
								<td style="width:120px">
									현재 비밀번호
								</td>
								<td align='left'>
									<input type="password" tabindex="1" name="origin_pw" value="" class="form-control" /> 
								</td>		
							</tr>
							<tr>
								<td valign="top">
									새 비밀번호
								</td>
								<td align='left'>
									<input type="password" tabindex="2" id="password_signup" name="new_pw1" value="" class="form-control"  style="ime-mode:disabled" />
									<span id="about_password" class=t_basic>비밀번호는 6자리이상 20자리 이내로 입력해주세요.</span>
								</td>						
							</tr>
							<tr>
								<td>
									새 비밀번호 확인
								</td>
								<td align='left'>
									<input type="password" tabindex="2" id="new_pw2" name="new_pw2" value="" class="form-control"  style="ime-mode:disabled" />
									</form>
								</td>						
							</tr>
							<tr>
								<td></td>
								<td>
									<button tabindex="7" onclick="passwd_edit_check();" class="btn btn-success">
									<img src='/img/icon/icon_save_w.png' style='width:16px; margin-right: 5px;' valign='middle'>변경
									</button>
								</td>
							</tr>
							</table>
					</div>

				</div>
				
			</div>
			<!-- 상단 메인 배너 끝 -->

			

		</div>

		
	</div>
	<?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
	
</div>
</body>
</html>