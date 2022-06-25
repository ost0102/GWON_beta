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

		//category 변경값 체크
		 $('#page_Category').change(function(){
			var select_cate = $('#page_Category option:selected').val();
			$.get('/page/cate_info/'+select_cate,function(data,status){
				$('#page_list').html(data);
				//$('#search_result_team_mate').html(data);
				//$('#search_result_team_mate').show();
				//사용자 정보를 받은 후, 프로젝트 팀원으로 등록하는 기능 개발하기
		   });
		 });

	});

	function goto_signup(){
		var u_type = $("#u_type_select option:selected").val();
		//location.href='/user/regist?u_type='+u_type;
		location.href='/new/user/regist?u_type='+u_type;

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
				<?
				include_once $this->config->item('basic_url')."/include/inc_top_menu_login.php";?>
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
				<div id='sub_top_welcome_con'>
					<h3>
						쉬워지는 지원사업 Gwon
					</h3>
					<hr style='margin-top:10px; margin-bottom: 10px;'/>
					복지 사각지대의 이웃들의 어려움을 개인 기부자들의 참여로 해소하려는<br/>
					사각사각프로젝트와 함께 하게 된 것을 환영합니다.
					<br/>
					우리 한명, 한명이 모여 사각사각프로젝트는<br/>
					더욱 많은 복지 사각지대를 밝혀줄 수 잇을 것이라 믿습니다.
					<br/>
					<style>
					#welcome_u_type{
						float: left;
						width: 100%;
						margin-top: 10px;
						background: #efefef;
						text-align: center;
						padding: 15px;
					}
					#sgsg_join{
						margin-top: 10px;

					}
					#u_type_select{
						width: 80px;'
						font-weight: bold;
					}
					</style>

					<div id='welcome_u_type'>
						저는 사각사각프로젝트에 
						<select id='u_type_select'>
							<option value='donor'>기부자</option>
							<option value='recipient'>수혜자</option>
							<option value='socialworker'>사회복지사</option>
						</select>
						로 <br/>
						<button id='sgsg_join' class='btn btn-primary' onclick='goto_signup()'>
							무료 계정 만들기
						</button>

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