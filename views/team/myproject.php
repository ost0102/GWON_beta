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
</script>
</head>
<body>
<div id=right_top_shape>
	<a href="http://<?=$this->config->item('intro_url');?>/page"><img src="/img/land/right_top_shape.png" class='logo_shape'></a>
</div>
<div id="container">
	<div class="menu_left">
		<div id="menu_area">
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
				<!-- Contents Area Start -->
				<div id="con_area">
					<h1 style="margin-top:10px; margin-bottom:10px;">My pages</h1>
					<div style="text-align:center; color:#cdcdcd; padding-bottom:10px; margin-bottom:10px; border-bottom: 1px solid #cdcdcd;">
						<a onclick="mypage_list(1);" >Published</a>
						&nbsp;|&nbsp;
						<a onclick="mypage_list(2);" >Making</a>
						&nbsp;|&nbsp;
						<a onclick="mypage_list(3);" >like</a>
					</div>
					<div id="con_main">
						<!--관련 팀정보가 있으면 출력하도록.. -->
						<? if(isset($my_project)){
								//print_r($linked_info);
								foreach ($my_project as $my_project)
								{
									//print_r($row);
									//class_no가 없을 경우 최근 값을 가져와라
									$cate_id = $my_project['cate_id'];
									$title = $my_project['title'];
									$summary = $my_project['summary'];
									$logo = $my_project['logo'];
									$date = $my_project['date'];
									$domain = $my_project['domain'];
									$p_num = $my_project['p_num'];
									$state = $my_project['state'];
									$project_img = $my_project['project_img'];
									if($state=='0'){
										$state_txt = '&nbsp;<img src="/img/icon/icon_sandglass.png" style="width: 10px; margin-bottom: 0px;" valign="middle">';
									}else{
										$state_txt = '';
									}

									if($project_img!=''){
										$project_img = $project_img;
									}else{
										$project_img = $logo;
									}

									$icon  =array('stop','tint','lemon','medkit','money','female','pencil','comments-alt','lightbulb','sun','file','file');
									$i=0;
									
									echo "
									<div style='width: 100%; float:left; margin-top: 10px; margin-bottom: 10px;'>
										<table width='100%'>
											<tr>
												<td valign='top' style='width: 110px;'><div class='circular' style='background:url(".$project_img.") #cdcdcd no-repeat center center; width: 90px; height:90px; background-size:100px 100px;'>
												</td>
												<td valign='top'>
													<h3>".$title.$state_txt."</h3><span style='font-size: 12px;'>".$summary."<br/>
													참여일 :".$date."&nbsp;|&nbsp;".$cate_id."</span><div style='width: 100%; margin-top: 10px;'>";
													//페이지정보
													echo "<img src='/img/icon/icon_write.png' style='margin-right: 5px; width: 15px;'/><a href='/makepage/outline/".$p_num."' target='_self'>정보 수정하기</a>&nbsp;&nbsp;&nbsp;";
													//활성화된 프로젝트인경우 출력하기, 아직 작성중이었을때는 삭제 가능하게
													if($state != 0){
														echo "<a href='#' target='_self'><img src='/img/icon/icon_dashboard.png' style='margin-left: 15px; margin-right: 5px; width: 15px;'/>Dashboard(예정)</a>";
													}

									echo"		</div></td>
											</tr>
										</table>";
									
									
									//활성화된 정보의 경우 URL 및 기타 보기 메뉴 출력
									if($state!='0'){
										echo "<div style='float: left; width:100%; padding-top: 10px; padding-bottom: 10px; border: 1px solid #cdcdcd; margin-top:10px; margin-bottom: 10px; border-radius: 10px; color: #cdcdcd; size: 12px;'>";
										echo "<div style='float: left;'><a href='http://npg.kr/".$domain."' target='_blank'><img src='/img/icon/icon_link.png' style='margin-left: 15px; margin-right: 5px; width: 15px;'/>http://npg.kr/".$domain."</a></div>";
										echo "<div style='width: 230px; float: left;'><a href='http://".$this->config->item('intro_url')."/".$domain."/1#!/0' target='_blank'><img src='/img/icon/icon_pt.png' style='margin-left: 15px; margin-right: 5px; width: 15px;'/>Presentation</a>";
										echo "<a href='#".$p_num."' target='_self'><img src='/img/icon/icon_print.png' style='margin-left: 15px; margin-right: 5px; width: 15px;'/>Print(예정)</a></div>";
										echo "</div>";
									}
									
									echo "<hr style='margin-top:10px;'/>";
									echo "</div>";
								}
						}else{
							echo '프로젝트 참여정보가 없습니다.<br/>';
						}?>
						<div style='float: left; width:100%; padding-top: 10px; padding-bottom: 10px; border: 1px solid #cdcdcd; margin-top:10px; margin-bottom: 10px; border-radius: 10px; background: #efefef;'>
							<img src='/img/icon/icon_help.png' style='margin-left: 15px; margin-right: 5px; width: 15px;'/>How to make intropage?
						</div>
						<!-- copyright area 시작 -->
						<?$this->load->view('/include/bottom');?>
					</div>
				</div>
				<!-- Contents Area finish -->
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
<SCRIPT TYPE="text/javascript">
	function mypage_list(list_type){
		var list_type = list_type;
		//alert(now_user);
		$('#con_main').html('loading');
		$.post("/mypage/list_detail",{
			list_type: list_type
		},
	   function(data){
		 //alert(data);
		 $('#con_main').html(data);
	   }); 
	}
</SCRIPT>