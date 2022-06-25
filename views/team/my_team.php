<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?$this->load->view('/include/head_info');?>
<script type="text/javascript">
	//jQuery 있는 상태
	window.onload=function(){
		check_con_div();
		check_w_mode();
	};

	$(document).ready(function() {


		//modal 관련
		 $("#m_close").click(function(){
		  $.modal.close();
		  $modal_state ='off';
		 });
		 $modal_state ='off';
		/* 

		modal창의 콘텐츠에서 클릭해도 창이 없어지지 않도록 하려면...
		 $("body").click(function(){
			check_modal();
		 });
		*/

		//Search team info
		$("#search_team_name").click(function(){
		  var input_team = $('#input_team_name').val();
		  var where = 'my_team';
		   $.post("/team/search_team/"+input_team,{
				where: where
				},
			   function(data){
				 //alert(data);
				 //open_modal(data);
				 $('#search_result_team_info').html(data);
				$('#search_result_team_info').show();
				 //if(data =="등록이 완료되었습니다."){}
		   }); 
		});

		//html2 관련
		$doc_h = $(window).height();
		$doc_w = $(window).width();
		//alert($doc_w);
		$contents_h = $('.contents').height();
		//브라우저 너비에 따라 콘텐츠창 사이즈 조정하기
		window.ipg_scr_left_sate = 'off';

		//$('.contents').css('height',$doc_h);//감춤
		//modal 관련
		 $("#m_close").click(function(){
		  $.modal.close();
		  $modal_state ='off';
		 });
		
		 $modal_state ='off';
	});
	
	//modal창 관련
	function open_modal(state_value){
		var state = state_value;
		if($modal_state == 'off'){
			$('#modal_txt').text(state);
			$("#modal_content").modal();
			$modal_state = 'on';
		}
	}
	function modal_off(){
		if($modal_state == 'on'){
			$.modal.close();
			$modal_state = 'off';
		}
	}
	function check_modal(){
		var modal_overlay = $('#simplemodal-overlay').css('visibility');
		//overlay가 visible 상태이면..
		 if(modal_overlay == 'visible'){
			 //alert('test');
			 
			//overlay에서 클릭이 일어났다면 모달창을 닫고, 스테이트를 off로 바꿔라.
			 $.modal.close();
			 $modal_state ='off';
		}
	}

	function team_add(){
		var now_div = document.getElementById('team_add');
		if(!now_div) return;
		//alert(now_div);
		if($(now_div).css('display')=="none"){
			$(now_div).slideDown("slow");
		}else{
			$(now_div).slideUp("slow");
		}
	}

</script>
</head>
<body>
<div id=right_top_shape>
	<a href="http://<?=$this->config->item('intro_url');?>/page"><img src="/img/land/right_top_shape.png" class='logo_shape'></a>
</div>
<div id="container">
	<div class="menu_left">
		<div id=menu_area>
			<!-- sub_top area include -->
			<?$this->load->view('/include/sub_top');?>
			<!-- menu area 시작 -->
			<?$this->load->view('/include/left_menu');?>
			<!-- menu area 끝 -->
		</div>
		<div class="bt_sub">
			
		</div>
	</div>
	</div>
	<div class="contents">
		<!--상단영역 -->
		<?$this->load->view('/include/top_area');?>
		<!--상단영역 끝-->
		<!--콘텐츠 영역 -->
		<div id="content_area">
			<div id="con_div">
				<div id='con_area'>
					<h1 style="margin-top:10px; padding-bottom:10px; margin-bottom:10px; border-bottom: 1px solid #cdcdcd;">
						My Team info
					</h1>
					<div id='con_main'>
						<!--관련 팀정보가 있으면 출력하도록.. -->
						<? if(isset($my_team)){
								//print_r($linked_info);
								foreach ($my_team as $my_team)
								{
									$t_id = $my_team['t_id'];
									$t_secur = $my_team['t_secur'];
									$t_name = $my_team['t_name'];
									$t_script = $my_team['t_script'];
									$category = $my_team['category'];
									$date_time = $my_team['date_time'];
									$conected_project = $my_team['conected_project'];
									echo "
									<div style='width: 100%; float:left; padding-top: 10px; padding-bottom: 10px; margin-bottom: 5px; border-bottom: 1px solid #cdcdcd;'><b>
										<a href='/team/team_info/".$t_secur."' target='_self'>".$t_name."</a></b><br/>".$t_script."<br/>
										참여일 :".$date_time;

									if($conected_project=='Y'){
										echo'<br/>[연결된 프로젝트 정보가 있습니다.]';
									}else{
										echo '<br/>[연결된 정보가 아직 없습니다.]';
									}
									/*
									if($make_start!='0000-00-00'){echo "프로젝트 생성일 : ".$make_start,'&nbsp;';}
									if($write_title!='0000-00-00'){echo "콘텐츠 제목 작성 : ".$write_title,'&nbsp;';}
									if($write_con!='0000-00-00'){echo "콘텐츠 본문 작성 : ".$write_con,'&nbsp;';}
									if($add_member!='0000-00-00'){echo "멤버 추가하기 : ".$add_member,'&nbsp;';}
									if($add_code!='0000-00-00'){echo "코드 추가여부 : ".$add_code,'&nbsp;';}
									if($publish!='0000-00-00'){echo "페이지 오픈 : ".$publish,'&nbsp;';}*/
									
									echo "</div>";
								}
						}else{
							echo '프로젝트 참여정보가 없습니다.<br/><br/>';
						}?>
						<div class='button_div'  onclick='team_add();'>
								<img src='/img/icon/icon_plus.png' style='width:16px; margin-right: 5px;' valign='middle'>팀 추가하기
						</div>
						<div id="team_add">
							<span class=t_basic><b>추가하고자 하는 팀명을 입력해주세요.</b></span>
							<table width='100%'>
								<tr>
									<td style="text-align: left;">
										<input id="input_team_name" name="input_team_name" class="teamname" type="text" onfocus="this.className='focus_area'" onblur="if (this.value.length==0) {this.className='teamname';}else {this.className='focus_area';}" />
									</td>
									<td valign=top style="text-align: right; width: 100px;">
										<button id="search_team_name" class="btn btn-inverse">
											<img src='/img/icon/icon_search_w.png' style='width:16px; margin-right: 5px;' valign='middle'>검색
										</button>
									</td>
								</tr>
							</table>
							<div id="search_result_team_info" class="ajax_result"></div>
							<br/><br/>
						</div>
						<!-- copyright area 시작 -->
						<?$this->load->view('/include/bottom');?>
						<!-- copyright area 끝 -->
					</div>
				</div>
			</div>
		</div>
		<!--콘텐츠 영역 끝 -->
	</div>
</div>

<div id="modal_content">
	 <div id="modal_txt">
		<!--내용 출력부분 시작-->
		이곳에 내용 출력
	</div>
	<div id=login_close>
		<a onClick="modal_off()"><img src="/img/land/bt_close.png"></a>
	</div>
</div>
<!--모달창 출력부분 끝 -->
<!--modal창 관련 -->
<script type="text/javascript" src="/js/jquery.simplemodal.js"></script>
</body>
</html>