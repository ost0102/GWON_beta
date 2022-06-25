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
		//연결된 정보 불러오기
		linked_project("<?echo $user_seg;?>");
	});

	//팀정보 리로드
	function linked_project(user_seg){	
		$('#con_info_area').html('<div style="text-align:center; padding-top: 20px;"><img src="/img/loading.gif" style="width:50px;"><br/>loading</div>');
		
		$.post("/mypage/linked_project",{
		user_seg: user_seg
		},
	   	function(data){
		 //alert(data);
		 //입력값 초기화하기
		 $('#con_info_area').html(data);
		 //open_modal(data);
		 //if(data =="등록이 완료되었습니다."){}
	   	});
	}

	function linked_team(user_seg){
		$('#con_info_area').html('<div style="text-align:center; padding-top: 20px;"><img src="/img/loading.gif" style="width:50px;"><br/>loading</div>');
		var user_seg = user_seg;
		$.post("/mypage/user_team",{
		user_seg: user_seg
		},
	   function(data){
		 //alert(data);
		 //입력값 초기화하기
		 $('#con_info_area').html(data);
		//open_modal(data);
		 //if(data =="등록이 완료되었습니다."){}
	   });
	}

	function linked_like(user_seg){		
		$('#con_info_area').html('<div style="text-align:center; padding-top: 20px;"><img src="/img/loading.gif" style="width:50px;"><br/>loading</div>');
		var user_seg = user_seg;
		$.post("/mypage/user_like",{
		user_seg: user_seg
		},
	   function(data){
		 //alert(data);
		 //입력값 초기화하기
		 $('#con_info_area').html(data);
		//open_modal(data);
		 //if(data =="등록이 완료되었습니다."){}
	   });
	}

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
						<div class='circular' style='margin-left: auto;	margin-right: auto; background:url("<?echo $photo_fb;?>") no-repeat center center; width: 90px; height:90px; background-size:100px 100px;'></div>
						<h3 style='margin-top:10px; padding-bottom:10px;'>
							<? if(isset($name)){
								//print_r($linked_info);
									echo $name;
								}
							?>
						</h3>
						<?echo $description;?><br/>
						<?
							if($fb_id != '' && $fb_id != 0){
								echo '/ <a href="https://www.facebook.com/app_scoped_user_id/'.$fb_id.'" target="_blank">Facebook</a>';
							}
						?>
						<br/>
						<a href='javascript:linked_project("<?echo $user_seg;?>")'>페이지(<?echo $user_page_count;?>)</a>
						<?
							$login_user=$this->session->userdata('ipg_users');
							if($login_user==$user_seg){
						?>
						[<a href='javascript:goto_myproject()'>관리</a>]
						<?
							}
						?> | 
						<a href='javascript:linked_team("<?echo $user_seg;?>")'>팀(<?echo $user_team_count;?>)</a> | 
						<a href='javascript:linked_like("<?echo $user_seg;?>")'>공유(<?echo $user_support_count;?>)</a>
					</div>
					<div id="con_info_area" style='padding: 10px;'>
						<!--include 정보 출력 부분 -->
					</div>

				</div>
			</div>

		</div>

		
	</div>
	<?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
	
</div>
</body>
</html>