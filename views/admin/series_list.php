<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<?$this->load->view('/include/head_info');?>
<script type='text/javascript'>
	//jQuery 있는 상태
	window.onload=function(){
        check_con_div();
		check_w_mode();
	};

	$(document).ready(function() {
		/* 

		modal창의 콘텐츠에서 클릭해도 창이 없어지지 않도록 하려면...
		 $('body').click(function(){
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
		 $('#m_close').click(function(){
		  $.modal.close();
		  $modal_state ='off';
		 });
		
		 $modal_state ='off';

	});
	function check_update_page(){
		var update_page = $('#update_page').html();
		

		$.get("/openpage/admin_update_check",function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#update_page').html(data);
	   });
	}
</script>
</head>
<body>
<div id=right_top_shape>
	<a href='http://<?=$config['intro_url'];?>/page'><img src='/img/land/right_top_shape.png' class='logo_shape'></a>
</div>
<div id='container'>
	<div class='menu_left'>
		<div id=menu_area>
			<!-- sub_top area include -->
			<?$this->load->view('/include/sub_top');?>
			<!-- menu area 시작 -->
			<?$this->load->view('/include/left_menu');?>
			<!-- menu area 끝 -->
		</div>
		<div class='bt_sub'>
			
		</div>
	</div>
	</div>
	<div class='contents'>
		<!--상단영역 -->
		<?$this->load->view('/include/top_area');?>
		<!--상단영역 끝-->
		<!--콘텐츠 영역 -->
		<div id='content_area'>
			<div id='con_div'>
				<!-- Contents Area Start -->
				<div id='con_area'>
					<div id='con_main'>
						<?$this->load->view('/include/admin_menu');?>
						<div style="width: 100%; text-align: center; padding-bottom: 10px; border-bottom: 1px solid #cdcdcd; margin-bottom: 20px;">
							<a onclick="series_list(1);" >접수</a>&nbsp;|&nbsp;
							<a onclick="series_list(2);" >견적 발송</a>&nbsp;|&nbsp;
							<a onclick="series_list(3);" >진행</a>&nbsp;|&nbsp;
							<a onclick="series_list(4);" >취소</a>&nbsp;|&nbsp;
							<a onclick="series_list(5);" >기술 지원 완료</a>&nbsp;|&nbsp;
							<a onclick="series_list(6);" >견적서 발송</a>&nbsp;|&nbsp;
							<a onclick="series_list(7);" >입금 확인</a>
						</div>
						<!--Help list 출력 시작 -->
						<div id="series_list_area">
							<? if(isset($series_list)){
									//print_r($linked_info);
									$first_check = 0;
									foreach ($series_list as $series_list)
									{
										//print_r($row);
										//class_no가 없을 경우 최근 값을 가져와라


										$s_id = $series_list['s_id'];
										$s_secur = $series_list['s_secur'];
										$s_title = $series_list['s_title'];
										$s_script = $series_list['s_script'];
										$price_check = $series_list['price_check'];
										$price_date_start = $series_list['price_date_start'];
										$price_date_end = $series_list['price_date_end'];
										$date_time = $series_list['date_time'];

										//현재 결제 여부 체크
										if($price_check ==0){
											$now_price = '기본';
										}else if($price_check ==1){
											$now_price = '유료';
										}else{
											$now_price = '고급';
										}

										

										echo "<div class='project_con'>";

										if($first_check!==0){
											echo "<hr style='margin-bottom:10px;'/>";
										}
										
										echo "
											<table width='100%'>
												<tr>
													<td valign='top'>
														<h3>".$s_title."</h3><span>".$s_script."<br/>
														<div style='float:left; margin-right: 10px;' white-space:nowrap;>상태 : <b>".$now_price."</b></div>
														<div style='float:left; margin-right: 10px;' white-space:nowrap;>결제 시작 : ".$price_date_start." /</div>
														<div style='float:left; margin-right: 10px;' white-space:nowrap;>결제 종료 : ".$price_date_end." /</div>";
														//페이지정보
														echo "<div style='float:left; width: 100%; margin-top: 10px; white-space:nowrap;'>
														<img src='/img/icon/icon_search.png' style='margin-right: 5px; width: 15px;'/>
														<a href='/ipg_series/series_info/".$s_secur."' target='_blank'>상세보기</a> |
														<a href='/admin/series_charge/".$s_secur."' target='_self'>결제상태 변경</a>
														";
														"</div>";

										echo"		</td>
												</tr>
											</table>";
										echo "</div>";
										$first_check++;
									}
							}else{
								echo '요청한 내역이 없습니다.<br/> <a href="/makepage/" target="_self">intropage 생성하기</a>';
							}?>
						</div>
						<!--Help list 출력 끝 -->
						<!-- copyright area 시작 -->
						<?$this->load->view('/include/bottom');?>
						<!-- copyright area 끝 -->
					</div>
					<!-- Contents Area finish -->
				</div>
			</div>
		</div>
		<!--콘텐츠 영역 끝 -->
	</div>
</div>
<div id='modal_content'>
	 <div id='modal_txt'>
		<!--내용 출력부분 시작-->
		이곳에 내용 출력
	</div>
	<div id=login_close>
		<a onClick='modal_off()'><img src='/img/land/bt_close.png'></a>
	</div>
</div>
<!--모달창 출력부분 끝 -->
<!--modal창 관련 -->
<script type='text/javascript' src='/js/jquery.simplemodal.js'></script>
<SCRIPT TYPE="text/javascript">
	function series_list(list_type){
		var list_type = list_type;
		$('#series_list_area').html('<div style="text-align:center; padding-top: 20px;"><img src="/img/loading.gif" style="width:50px;"><br/>loading</div>');
		$.post("/admin/show_offer_list_section",{
			list_type: list_type
		},
	   function(data){
		 //alert(data);
		 $('#series_list_area').html(data);
	   }); 
		
	}
</SCRIPT>
</body>
</html>