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
		check_team_member();

		//project_information - 미 팀원이 이 페이지에 방문했을 경우 출력
		$("#post_join_member").click(function(){
			var t_id = <?echo $t_id;?>;
		   //alert(t_id);
		   $.get("/team/add_team_member/"+t_id,function(data,status){
				//alert("Data: " + data + "\nStatus: " + status);
				open_modal(data);
				check_team_member();
				$("#post_join_member").hide();
				//사용자 정보를 받은 후, 프로젝트 팀원으로 등록하는 기능 개발하기
		   });
		});

		//Search team mate
		$("#search_team_mate").click(function(){
		  var input_team_mate = $('#input_team_mate').val();
		   $.get("/team/search_team_mate/"+input_team_mate,function(data,status){
				//alert("Data: " + data + "\nStatus: " + status);
				$('#search_result_team_mate').html(data);
				$('#search_result_team_mate').show();
				//사용자 정보를 받은 후, 프로젝트 팀원으로 등록하는 기능 개발하기
		   });
		});

	});

	//팀원정보 설정하기
	function set_team_member(val){	
		$.get("/team/set_team_member/"+val,function(data,status){
			open_modal();
			//alert(val);
			$('#modal_txt').html(data);
			//check_team_info();
	   });
	}
	//팀원정보 리로드
	function del_team_member(val){
		alert('팀멤버에서 삭제를 진행합니다.');		
		$.get("/team/del_team_member/"+val,function(data,status){
			//open_modal();
			//$('#modal_txt').html(data);
			location.reload();
			//check_team_member();
	   });
	}

	//팀멤버 추가하기 div 출력   
	function show_teammate_add(){
		var now_div = document.getElementById('team_mate_add');
		$('#co_authors_scription').hide();

		if(!now_div) return;
		//alert(now_div);
		if($(now_div).css('display')=="none"){
			$(now_div).slideDown();
		}else{
			$(now_div).slideUp("slow");
		}
	}
	//팀메이트 추가하기 - 관리권한이 있는 팀원이 이 페이지에 접근했을 경우 출력
	function add_team_mate(at_val){
	   var t_id = <?echo $t_id;?>;
	   
	   $.post("/team/add_team_member",{
		t_id: t_id,
		add_user: at_val
		},
	   function(data){
		 //alert(data);
		 //입력값 초기화하기
		 open_modal(data);
		 check_team_member();
		 $('#co_authors_query_result').html('');
		 $('#co_authors').val('');
		 //if(data =="등록이 완료되었습니다."){}
	   }); 
	}
	//팀원정보 리로드
	function check_team_member(){
		//alert(val);		
		var t_id = <?echo $t_id;?>;
		$.get("/team/check_team_member/"+t_id,function(data,status){
			//open_modal();
			$('#team_member').html(data);
	   });
	}

	//팀정보 리로드
	function check_team_info(){		
		location.reload();
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
						<h3 style='margin-top:10px; padding-bottom:10px;'>
							<? if(isset($t_id)){
								//print_r($linked_info);
								echo $t_name;
							}else{
								echo '팀 정보가 없습니다.';
							}
							?>
						</h3>
						<?
							if(isset($t_script)&&$t_script!=""){
									//print_r($linked_info);
								echo '<pre style="text-align: center; padding: 10px; width: 80%; margin-left: auto; margin-right: auto;">'.$t_script.'</pre>';
							}else{
								echo '팀 설명이 없습니다.<br/>';
							}
						?>
						<br/>
						<?
						if(isset($edit_user)){?>
							<button class="btn btn-inverse" onclick="make_team('<?echo $t_name?>')">
								<img src='/img/icon/icon_write_w.png' style='width:16px; margin-right: 5px;' valign='middle'>
								수정하기
							</button>
							<br/>
						<?}?>
					</div>
					<!--member -->
					<div id='team_member' style='margin-top: 20px;'>
					<!--team member loading area -->
					</div>
					<?if(isset($member_user)){?>
					<div class='button_div'  onclick='show_teammate_add();'>
							<img src='/img/icon/icon_plus.png' style='width:16px; margin-right: 5px;' valign='middle'>팀멤버 추가하기
					</div>
					<?}?>
					<div id='team_mate_add' style='width:100%;'>
						<span class=t_basic><b>추가하고자 하는 팀원의 email주소를 입력해주세요.</b></span>
						<!--이메일 검색 기능 인클루드-->
						<script type="text/javascript">
							//공동 저자 추가하기
							function add_authors(u_id,name){
								add_team_mate(u_id);
								//DB에 멤버 정보 입력하고, 쿼리때려서 공동 저자 리스트 가져오기
								//시리즈 생성 버튼 눌러야 공동 저자 정보 출력되도록 변경.멤버 테이블에 번호 저장하는 쿼리 날리기기
							}
						</script>
						<?$this->load->view('/include/search_mail');?>
					</div>
					<div id="con_info_area" style='padding: 10px;'>
						<? if(isset($project)){
								echo '
								<hr style="margin-top:5px; margin-bottom: 20px;"/>
								<h3>연결된 페이지</h3>
								<hr style="margin-top:5px; margin-bottom: 10px;"/>';
								foreach ($project as $project)
								{
									$title = $project['title'];
									$page_secur = $project['page_secur'];
									$logo = $project['logo'];
									$summary = $project['summary'];
									$domain = $project['domain'];
									$state = $project['state'];
									$w_num = $project['w_num'];
									$project_img = $project['project_img'];
									$start_date = $project['start_date'];
									$end_date = $project['end_date'];
									$start_time = $project['start_time'];
									$end_time = $project['end_time'];

									if($project_img!=''){
										$project_img = $project_img;
									}else if($logo!=''){
										$project_img = $logo;
									}else{
										$project_img = '/img/intropage_twt.jpg';
										
									}

										echo "
										<table style='width:100%; margin-bottom: 20px;'>
											<tr><td style='width: 100px;'>
													<div class='circular' style='background:url(".$project_img.") no-repeat center center; width: 90px; height:90px; background-size:100px 100px;'></div>
												</td>
												<td>";
									if(isset($edit_user)){
										echo "
												<b><a href='/makepage/outline/".$page_secur."' target='_self'>
													".$title."</a></b><br/>".$summary;
									}else{
										echo "
												<b>
													".$title."</b><br/>".$summary;
									}
									
									 if($domain !='' && $state ==1){
										echo "<br/><b>모집 기간 : </b>".$start_date." ".$start_time."~".$end_date." ".$end_time;
										echo  "<br/><a href='".$this->config->item('base_url')."/".$domain."' target='_blank'>".$this->config->item('base_url')."/".$domain."</a><br/>";
									 	
									 }
									 echo "</td></tr></table>";
								}
						}else{
							echo '등록된 프로젝트 정보가 없습니다.';
						}	
						?>
						<?
						if(!isset($member_user)&&$user!=''){
							echo '<br/><button id="post_join_member" class="btn btn-inverse"><img src="/img/icon/icon_plus_w.png" style="width:16px; margin-right: 5px;" valign="middle">팀원 신청</button>';
							
						}
						?>
					</div>

				</div>
			</div>

		</div>

		
	</div>
	<?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
	
</div>
</body>
</html>