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

	function submit_check(){
		//form 기본 실행 방지 코드
		event.preventDefault();  
		//alert($("#password_signup").val() );
		var email = $("#email_signup").val();  
		var regex=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;   
		  
		if(regex.test(email) === false) {  
			alert('잘못된 이메일 형식입니다.');
			 $("#email_signup").focus();
			return false;  
		}else if($("#name").val() == "" || nameCheck($("#name").val()) == true ){	
			 alert("이름은 한글, 영문만 입력하실 수 있습니다.");
			 $("#name").focus();
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
						<form action="/user/update_profile" method='post' name='regist' id='regist' >
						<table border="0px" width="100%" class='inno_table'>
							<tr>
								<td>
									이름<br/>
									<input type="text" tabindex="1" id="name" name="name" class="form-control" 
									value="<?php echo $name;?>" placeholder="이름을 입력해주세요." style="ime-mode:disabled" />
								</td>					
							</tr>
							<tr>
								<td>
									자기 소개<br/>
									<textarea tabindex="2" name="description"  placeholder="간단한 자기소개글을 입력해 주세요."
									class="form-control" ><?php echo $description;?></textarea>
								</td>
							</tr>
							<tr>
								<td>
									이메일<br/>
									<?php 
										if(!isset($email)){
											$email = '';
										}
									?>
									<input type="text" tabindex="3" id="email_signup" name="email" class="form-control" 
									value="<?php echo $email;?>" placeholder="email@gwon.com"/> 
									<span id="about_mail" class='t_basic'>
										진행상황을 공유하기 때문에 실제 사용하고 계시는 이메일 주소를 입력해주세요.
									</span>
								</td>		
							</tr>
							<tr>
								<td>
									연락처<br/>
									<input type="text" tabindex="4" id="phone_signup" name="phone" class="form-control" 
									placeholder="직접 통화/문자가 가능한 핸드폰 번호를 입력해주세요." value="<?php echo $phone;?>" style="ime-mode:disabled" />
									<span id="about_phone" class='t_basic'>
										
									</span>
								</td>				
							</tr>
							<tr>
								<td valign='top'>
									소식 받기<br/>
									<label class="label_s" for="join_mail_list">
										<input type="checkbox" tabindex="5" id="join_mail_list" name="join_mail_list" <?php if($mail_list=='on')echo 'checked';?> class="checkbox_st"/>
										지원의 새로운 소식을 받고 싶습니다.
									</label>
									
								</td>
							</tr>
						</table>
						</form>
						<br/>
						<a href='/user/edit_passwd'>비밀번호를 변경하시겠습니까?</a>

						
						<div id='bt_area' style='text-align: right; margin-top: 10px;'>
							<button tabindex="10" onclick="submit_check();" class="btn btn-success">
								저장
							</button>
						</div>

					</div>

				</div>
			</div>

		</div>

		
	</div>
	<?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
<?
$user_info = $_GET['user_info'];
if($user_info=='not_set'&&$name==''){
?>
<script>
$(document).ready(function() {
open_modal();
$('#modal_txt').html('서비스를 원활히 이용하시기 위해<br/>기본 정보를 완성해 주세요.');
});
</script>
<?
}
?>
</div>
</body>
</html>