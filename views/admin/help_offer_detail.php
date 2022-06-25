<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?$this->load->view('/include/head_info');?>
<!--document 영역 style -->
<link href='/css/doc_style.css' rel='stylesheet' />
<script type="text/javascript">
	//jQuery 있는 상태
	window.onload=function(){
		check_con_div();
		check_w_mode();
	};

	$(document).ready(function() {

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

		$('#start_price').click(function(){
		    $('#start_price').hide();
		    $('#price_write_area').slideDown();
		    
	    });

	    $('#help_finish').click(function(){
		var offer_id = '<? if(isset($offer_id)){echo $offer_id;}?>';
		var res_id = '<? if(isset($res_id)){echo $res_id;}?>';
		alert(offer_id);
		alert(res_id);
		$.post('/admin/help_done',{
		offer_id: offer_id,
		res_id: res_id
		},
		function(data){
		alert('기술 지원이 완료되었습니다.');
		//입력값 초기화하기
		location.reload(); 
		//location.href = '/mypage#!5';
		});
		    
	    });

	    $('#help_cancle').click(function(){
			var offer_id = '<? if(isset($offer_id)){echo $offer_id;}?>';
			var res_id = '<? if(isset($res_id)){echo $res_id;}?>';
			if(res_id==''){
				//alert('기존에 작성된 견적의견이 있어야 지원 삭제가 가능합니다.');
				$.post('/mypage/help_cancle',{
				    offer_id: offer_id
				},
				function(data){
				    alert('기술 지원요청이 삭제되었습니다.');
				    //입력값 초기화하기
				    location.reload(); 
				    //location.href = '/mypage#!5';
				}); 
			}else{
				$.post('/mypage/help_cancle',{
				    offer_id: offer_id,
				    res_id: res_id
				},
				function(data){
				    alert('기술 지원요청이 취소되었습니다.');
				    //입력값 초기화하기
				    location.reload(); 
				    //location.href = '/mypage#!5';
				}); 
			}
				
	    });

	    $('#admin_charge').click(function(){
			var offer_id = '<? if(isset($offer_id)){echo $offer_id;}?>';
			var res_id = '<? if(isset($res_id)){echo $res_id;}?>';
			//alert('결제 관리 페이지로 넘기기');
			location.href = '/admin/show_charge_detail/'+res_id;
	    });

	    
		//문의하기로 선택한 데이터값 넘기기
	    $('#save_offer1').click(function(){
	        //alert('문의하기 - 되는줄 알았지 :)');
	        //변수 설정
	        var design_check1 = $('#design_check1').is(':checked');
	        var design_check2 = $('#design_check2').is(':checked');
	        var design_check3 = $('#design_check3').is(':checked');
        	var design_check4 = $('#design_check4').is(':checked');
	        var code_check1 = $('#code_check1').is(':checked');
	        var code_check2 = $('#code_check2').is(':checked');
	        var code_check3 = $('#code_check3').is(':checked');
	        var con_check1 = $('#con_check1').is(':checked');
	        var con_check2 = $('#con_check2').is(':checked');
	        var con_check3 = $('#con_check3').is(':checked');
	        var social_check1 = $('#social_check1').is(':checked');
	        var other_check1 = $('#other_check1').is(':checked');
	        var total_sum = $('#input_sum').val();
	        var page_info = $('#page_type').val();
	        var u_name = $('#u_name').val();
	        var u_email = $('#u_email').val();
	        var u_phone = $('#u_phone').val();
	        var u_comment = $('#u_comment').val();
	        var price_add = $('#price_add').val(); 
	        var offer_id = $('#offer_id').val(); 

	        price_add = price_add*1;

	        if(u_name=='' || u_email=='' || u_phone==''){
	            alert('사용자 이름, 이메일, 연락처 정보를 모두 기입해주세요.')
	        }else{
	            $.post('/admin/input_res_skill',{
	                design_check1: design_check1,
	                design_check2: design_check2,
	                design_check3: design_check3,
                	design_check4: design_check4,
	                code_check1: code_check1,
	                code_check2: code_check2,
	                code_check3: code_check3,
	                con_check1: con_check1,
	                con_check2: con_check2,
	                con_check3: con_check3,
	                social_check1: social_check1,
	                other_check1: other_check1,
	                total_sum: total_sum,
	                page_info: page_info,
	                u_name: u_name,
	                u_email: u_email,
	                u_phone: u_phone,
	                u_comment: u_comment,
	                price_add: price_add,
	                offer_id: offer_id
	            },
	            function(data){
	                alert('접수되었습니다.');
	                //입력값 초기화하기
	                //open_modal(data);
	                //fadeout_modal();
	                //alert('페이지의 콘텐츠 입력단계로 이동합니다.');
	                location.href = '/admin/show_help_detail/'+offer_id;
	            });
	        }
	      //location.replace('/makepage/outline/');
	    });

		//답변 입력하기2 추가 기능 요청
		$('#save_offer2').click(function(){
	        //alert('문의하기 - 되는줄 알았지 :)');
	        //변수 설정
	        var live_check1 = $('#live_check1').is(':checked');
	        var live_check2 = $('#live_check2').is(':checked');
	        var live_check3 = $('#live_check3').is(':checked');
	        var option_check1 = $('#option_check1').is(':checked');
	        var option_check2 = $('#option_check2').is(':checked');
	        var social_check1 = $('#social_check1').is(':checked');

	        var total_sum = $('#input_sum').val();
	        var page_info = $('#page_type').val();
	        var u_name = $('#u_name').val();
	        var u_email = $('#u_email').val();
	        var u_phone = $('#u_phone').val();
	        var u_comment = $('#u_comment').val();
	        var price_add = $('#price_add').val();
	        var offer_id = $('#offer_id').val(); 

	        price_add = price_add*1;
	        //alert(page_info);
	        if(u_name=='' || u_email=='' || u_phone==''){
	            alert('사용자 이름, 이메일, 연락처 정보를 모두 기입해주세요.')
	        }else{
	            $.post('/admin/input_res_other',{
	                live_check1: live_check1,
	                live_check2: live_check2,
	                live_check3: live_check3,
	                option_check1: option_check1,
	                option_check2: option_check2,
	                social_check1: social_check1,
	                total_sum: total_sum,
	                page_info: page_info,
	                u_name: u_name,
	                u_email: u_email,
	                u_phone: u_phone,
	                u_comment: u_comment,
	                price_add: price_add,
	                offer_id: offer_id
	            },
	            function(data){
	                alert('접수되었습니다.');
	                location.href = '/admin/show_help_detail/'+offer_id;
	            });
	        }
	      //location.replace('/makepage/outline/');
	    });
		
	   $('#save_offer3').click(function(){
	        var u_name = $('#u_name').val();
	        var u_email = $('#u_email').val();
	        var u_phone = $('#u_phone').val();
	        var u_comment = $('#u_comment').val();
	        var offer_id = $('#offer_id').val(); 

	        //alert(page_info);
	        if(u_name=='' || u_email=='' || u_phone==''){
	            alert('사용자 이름, 이메일, 연락처 정보를 모두 기입해주세요.')
	        }else{
	            $.post('/admin/input_res_mail',{
	                u_name: u_name,
	                u_email: u_email,
	                u_phone: u_phone,
	                u_comment: u_comment,
	                offer_id: offer_id
	            },
	            function(data){
	                alert('접수되었습니다.');
	                location.href = '/admin/show_help_detail/'+offer_id;
	            });
	        }
	      //location.replace('/makepage/outline/');
	    });

	    //답변 입력하기4 시리즈 맵 관련
		$('#save_offer4').click(function(){
	        //alert('문의하기 - 되는줄 알았지 :)');
	        //변수 설정
	        var map_check1 = $('#map_check1').is(':checked');
            var map_check2 = $('#map_check2').is(':checked');
            var map_check3 = $('#map_check3').is(':checked');
            var option_check1 = $('#option_check1').is(':checked');
            var option_check2 = $('#option_check2').val();
            var social_check1 = $('#social_check1').is(':checked');
            var price_add = $('#price_add').val();

	        var total_sum = $('#input_sum').val();
	        var page_info = $('#page_type').val();
	        var u_name = $('#u_name').val();
	        var u_email = $('#u_email').val();
	        var u_phone = $('#u_phone').val();
	        var u_comment = $('#u_comment').val();
	        var price_add = $('#price_add').val();
	        var offer_id = $('#offer_id').val(); 

	        price_add = price_add*1;
	        //alert(page_info);
	        if(u_name=='' || u_email=='' || u_phone==''){
	            alert('사용자 이름, 이메일, 연락처 정보를 모두 기입해주세요.')
	        }else{
	            $.post('/admin/input_res_map',{
	                map_check1: map_check1,
	                map_check2: map_check2,
	                map_check3: map_check3,
	                option_check1: option_check1,
	                option_check2: option_check2,
	                social_check1: social_check1,
	                total_sum: total_sum,
	                page_info: page_info,
	                u_name: u_name,
	                u_email: u_email,
	                u_phone: u_phone,
	                u_comment: u_comment,
	                price_add: price_add,
	                offer_id: offer_id
	            },
	            function(data){
	                alert('접수되었습니다.');
	                location.href = '/admin/show_help_detail/'+offer_id;
	            });
	        }
	      //location.replace('/makepage/outline/');
	    });

	    //기술 요청시작
		$("#start_work").click(function(){
		   var offer_id = '<? if(isset($offer_id)){echo $offer_id;}?>';
		   var res_id = '<? if(isset($res_id)){echo $res_id;}?>';
		   //alert(offer_id+"-"+res_id);
		   /**/
		   $.post('/mypage/help_start',{
                offer_id: offer_id,
                res_id: res_id
            },
            function(data){
            	alert(data);
                //입력값 초기화하기
                location.reload(); 
                //location.href = '/mypage#!5';
            });

		 });

	});

	//방문자 유입 많은 날 중 기록안된 날 있는지 체크하기
	function check_new_event(){
		//alert(at_val);
		var p_num = '<?echo $p_num;?>';
		$.get("/mypage/check_new_event/"+p_num,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			//alert(data);
			if(data=='update'){
				check_event_list();
			}
	   });
	}
</script>
<style type="text/css">
#help_info_top{
    width: 100%;
    font-family: 'Nanum Gothic','helvetica neue', helvetica, Dotum, sans-serif;
	font-style: normal;
	text-align: center;
}
#help_state{
	background: #efefef;
	padding: 10px;
	margin-top: 15px;
	font-family: 'Nanum Gothic','helvetica neue', helvetica, Dotum, sans-serif;
	border-top: 1px solid #cdcdcd;
	border-bottom: 1px solid #cdcdcd;
}
.price_td_t{
	text-align: left;
}
.price_txt{
	text-align: left;
}
#price_table td{
	font-size: 13px;
}
#price_write_area{
	display: none;
}
</style>
</head>
<body>
<div id=right_top_shape>
	<a href="http://<?=$config['intro_url'];?>/page"><img src="/img/land/right_top_shape.png" class='logo_shape'></a>
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
				<!-- Contents Area Start -->
				<div id="con_area">
					<h1 style="margin-top:10px; margin-bottom:10px;">요청 내용</h1>
					<div style="text-align:center; color:#cdcdcd; padding-bottom:10px; margin-bottom:10px; border-bottom: 1px solid #cdcdcd;">
						<a onclick="history_back();" >back</a>
					</div>
					<div id="con_main">
						<!--기술지원 요청 세부 내용 출력 -->
						<? if(isset($offer_id)){
							if(!isset($p_title)){
								$p_title = '신규 페이지';
							}
							if($del==1){
									$check_txt = '요청 취소';
									$now_state_txt = '<b>요청 취소</b>';
							}else{
								if($check_response == 'n'){
									$check_txt = '접수';
									$now_state_txt = '<b>접수</b> > 진행 > 완료';
								}else if($check_response == 'y' && $check_state <= 2){
									$check_txt = '진행';
									$now_state_txt = '접수 > <b>진행</b> > 완료';
								}else{
									$check_txt = '완료';
									$now_state_txt = '접수 > 진행 > <b>완료</b>';
								}
							}
							

							if($offer_area == 1){
								$offer_area_txt = '기술지원 요청';
							}else if($offer_area == 2){
								$offer_area_txt = '추가 지원';
							}else if($offer_area == 3){
								$offer_area_txt = '기타';
							}else if($offer_area == 4){
								$offer_area_txt = '시리즈 맵';
							}
						?>
						<div id='help_info_top'>
							<?if($offer_area !=3){?>
								<b><?echo $p_title; ?></b> 페이지에 대한<br/> <b><?echo $offer_area_txt;?></b> 요청을 신청하셨습니다.
							<?}else{?>
								<b>메일 문의</b>를 신청하셨습니다.
							<?}?>
							<div id='help_state'>
								진행 단계 : <? echo $now_state_txt; ?>
								<?
								if($del==1){
									echo '<br/>삭제된 요청입니다.';
								}else{

									if($check_state==2){
										echo '<br/>기술 지원이 진행 중입니다.';
									}else if($check_state==3){
										echo '<br/>기술 요청을 취소하셨습니다.';
									}else if($check_state==4){
										echo '<br/>기술 지원이 완료되었습니다. 결제 단계를 진행합니다.';
									}else if($check_state == 5){
										echo '<br/>안내한 계좌로 입금이 완료되면 다음 단계로 이동합니다.';
									}else if($check_state == 6){
										echo '<br/>클라이언트에게 입금확인 연락을 해주세요. 잘 마무리되었다고.';
									}else if($check_state == 7){
										echo '<br/>모든 단계가 완료되었습니다.';
									}
								}
								?>
							</div>
						</div>
						<!--신청자 정보 -->
						<h3>신청 내용</h3>
						<hr style='margin-top:10px;'/>
						<table id='price_table'>
                            <tr>
                                <td class='price_td_t' style='width: 90px;'>Name</td>
                                <td class='price_txt'>
                                    <? echo $name; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class='price_td_t'>E-mail</td>
                                <td class='price_txt'>
                                    <? echo $mail; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class='price_td_t'>Phone</td>
                                <td class='price_txt'>
                                    <? echo $phone; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class='price_td_t'>선택 항목</td>
                                <td class='price_txt'>
                                    <?
									if(isset($help_con_detail)){
										foreach ($help_con_detail as $help_con_detail)
										{
											//print_r($row);
											//class_no가 없을 경우 최근 값을 가져와라
											$om_id = $help_con_detail['om_id'];
											$offer_txt = $help_con_detail['offer_txt'];

											echo '- '.$offer_txt.'<br/>';
										}
									}
									?>
                                </td>
                            </tr>
                            <tr>
                                <td class='price_td_t'>사회 경제영역</td>
                                <td class='price_txt'>
                                    <? if($social==1){
                                    		echo '해당 됨 (전체 견적의 30% 할인)';
	                                    }else{
	                                    	echo '해당 안됨';
	                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class='price_td_t'>추가 의뢰 내용</td>
                                <td class='price_txt'>
                                    <? echo $offer_con; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class='price_td_t'>예상 견적</td>
                                <td class='price_txt price_st'>
                                    <? echo number_format($price); ?>
                                </td>
                            </tr>
                        </table>
                        <!--검토 정보 -->
                        <? if(isset($res_id)){ ?>
						<h3><?if($check_state==1){ echo '검토 의견';
								}else{ echo '확정 견적';}?>
								</h3>
						<hr style='margin-top:10px;'/>
						<div class='help_con_div'>
							<table id='price_table'>
								<tr>
	                                <td class='price_td_t' style='width: 90px;'>Name</td>
	                                <td class='price_txt'>
	                                    <? echo $res_name; ?>
	                                </td>
	                            </tr>
	                            <tr>
	                                <td class='price_td_t'>E-mail</td>
	                                <td class='price_txt'>
	                                    <? echo $res_mail; ?>
	                                </td>
	                            </tr>
	                            <tr>
	                                <td class='price_td_t'>Phone</td>
	                                <td class='price_txt'>
	                                    <? echo $res_phone; ?>
	                                </td>
	                            </tr>
	                            <tr>
	                                <td class='price_td_t'>선택 항목</td>
	                                <td class='price_txt'>
	                                    <?
										if(isset($help_resp_detail)){
											foreach ($help_resp_detail as $help_resp_detail)
											{
												//print_r($row);
												//class_no가 없을 경우 최근 값을 가져와라
												$res_om_id = $help_resp_detail['om_id'];
												$res_offer_txt = $help_resp_detail['offer_txt'];

												echo '- '.$res_offer_txt.'<br/>';
											}
										}
										?>
	                                </td>
	                            </tr>
	                            <tr>
	                                <td class='price_td_t'>사회 경제영역</td>
	                                <td class='price_txt'>
	                                    <? if($res_social==1){
	                                    		echo '해당 됨 (전체 견적의 30% 할인)';
		                                    }else{
		                                    	echo '해당 안됨';
		                                    }
	                                    ?>
	                                </td>
	                           		</tr>
	                            <tr>
	                                <td class='price_td_t'>추가 의뢰 내용</td>
	                                <td class='price_txt'>
	                                    <? echo $res_offer_con; ?>
	                                </td>
	                            </tr>
	                            <tr>
	                                <td class='price_td_t'>
	                                	<?if($check_state==1){ echo '예상 견적';
										}else{ echo '청구 비용';}?>
									</td>
	                                <td class='price_txt price_st'>
	                                    <? echo number_format($res_price); ?>
	                                </td>
	                            </tr>
	                        </table>
						</div>
						<?}?>
						<?if($check_state<=1){?>
							<?if($offer_area !=3){?>
								<div class='bt_start'>
				                      			 <button id="start_price" class="btn btn-primary" alt="견적 의견 작성">견적 의견 작성</button>
									<!--작성된 값이 하나라도 있다면.. 일단 관리자가 진행상태로 변경할 수 있도록 -->
									<?
									if($check_state>=1){?>
									<button id="start_work" class="btn btn-success" alt="기술지원 시작"><img src='/img/icon/icon_save_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt="icon" />기술 지원 시작</button>
									<?}?>
			                       
			                   			 </div>
							<?}else{
							if($del==1){
								//삭제된 경우
							?>
								<div class='bt_start'>
									<button id="start_price" class="btn btn-primary" alt="견적 의견 작성">견적 의견 작성</button>
								</div>
							<?
							}else{
								//기술 지원이 요청된 경우
							?>
								<div class='bt_start'>
									<button id="start_price" class="btn btn-primary" alt="견적 의견 작성">견적 의견 작성</button>
									<button id="help_cancle" class="btn btn-danger" alt="지원 삭제">지원 삭제</button>
								</div>
							<?
							}
							?>
							<?}?>
	                   <?}else if($check_state==2){?>
	                   <!--진행 중일때-->
	                    <div class='bt_start'>
	                       <button id="help_finish" class="btn btn-primary" alt="지원 완료!">지원 완료!</button>
	                       <button id="help_cancle" class="btn btn-danger" alt="지원 삭제">지원 삭제</button>
	                    </div>
	                    <?}else if($check_state>=4){?>
	                    <!--지원이 완료된 후-->
	                    <div class='bt_start'>
	                       <button id="admin_charge" class="btn btn-primary" alt="결제 정보 관리 페이지로 이동">결제 정보 관리 페이지로 이동</button>
	                    </div>
	                    <?}?>
	                    <!--offer_area 값에 따른 작성창 구분 출력-->
	                    <div id='price_write_area'>
	                    	<input type='hidden' id='page_type' value='<?echo $p_num;?>' />
	                    	<input type='hidden' id='offer_id' value='<?echo $offer_id;?>' />
							<? if($offer_area==1){ ?>
								<!--기술 지원 요청-->
		                        <h3><img src='/img/icon/icon_calculation.png' class='icon_st'/>가격 계산기</h3>
		                        <hr style='margin-top:10px; margin-bottom: 10px;'/>
		                        <table id='price_table'>
		                            <tr>
		                                <th class='price_td_t'>항목</td>
		                                <th class='price_td_con'>지원 범위</td>
		                                <th class='price_td_val'>가격</td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>디자인 개선</td>
		                                <td>
		                                    <input type="checkbox" id="design_check1" name="" value="" onclick='cal_check();' /> 콘텐츠 디자인 개선<br/>
		                                    <input type="checkbox" id="design_check2" name="" value="" onclick='cal_check();' /> 기본 템플릿 최적화<br/>
		                                    <input type="checkbox" id="design_check3" name="" value="" onclick='cal_check();' /> 신규템플릿 제작 (디자인&개발 포함) - 고급 디자인<br/>
		                                    <input type="checkbox" id="design_check4" name="" value="" onclick='cal_check();' /> 신규템플릿 제작 (디자인&개발 포함) - 일반 디자인
		                                </td>
		                                <td id='design_sum'>0</td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>기능 개선</td>
		                                <td>
		                                    <input type="checkbox" id="code_check1" name="" value="" onclick='cal_check();' /> 인터렉션 기능 개발<br/>
		                                    <input type="checkbox" id="code_check2" name="" value="" onclick='cal_check();' /> 외부 모듈 연동<br/>
		                                    <input type="checkbox" id="code_check3" name="" value="" onclick='cal_check();' /> 고급 기능 요청
		                                </td>
		                                <td id='code_sum'>0</td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>콘텐츠 개선</td>
		                                <td>
		                                    <input type="checkbox" id="con_check1" name="" value="" onclick='cal_check();' /> 콘텐츠 구성 Tool Kit<br/>
		                                    <input type="checkbox" id="con_check2" name="" value="" onclick='cal_check();' /> 기획 대행<br/>
		                                    <input type="checkbox" id="con_check3" name="" value="" onclick='cal_check();' /> 사진 촬영
		                                </td>
		                                <td id='con_sum'>0</td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>견적 추가</td>
		                                <td>
		                                    <input type="text" id="price_add" name="" value="" onkeyup='cal_check();' /> 
		                                </td>
		                                <td></td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>할인</td>
		                                <td>
		                                    <input type="checkbox" id="social_check1" name="" value="" onclick='cal_check();' /> 사회적 경제 영역 (30%할인)
		                                </td>
		                                <td id='con_sum'>0</td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>기타</td>
		                                <td>
		                                    <input type="checkbox" id="other_check1" name="" value="" onclick='cal_check();' /> 직접 디자인한 시안을 코딩해주세요.
		                                </td>
		                                <td id='con_sum'></td>
		                            </tr>
		                            <tr class='price_table_effect_tr'>
		                                <th>예상 견적</th>
		                                <th colspan='2' id='total_sum'>
		                                    0
		                                </th>
		                            </tr>
		                        </table>
		                        <input type="hidden" id="input_sum" name="" value="" /> 
		                        <div id='cal_option' class='script mg_top_15'>
		                        </div>
		                        <script type='text/javascript'>
		                        function cal_check(){
		                            var design_check1 = $('#design_check1').is(':checked');
		                            var design_check2 = $('#design_check2').is(':checked');
		                            var design_check3 = $('#design_check3').is(':checked');
                            		var design_check4 = $('#design_check4').is(':checked');
		                            var code_check1 = $('#code_check1').is(':checked');
		                            var code_check2 = $('#code_check2').is(':checked');
		                            var code_check3 = $('#code_check3').is(':checked');
		                            var con_check1 = $('#con_check1').is(':checked');
		                            var con_check2 = $('#con_check2').is(':checked');
		                            var con_check3 = $('#con_check3').is(':checked');
		                            var social_check1 = $('#social_check1').is(':checked');
		                            var other_check1 = $('#other_check1').is(':checked');
		                            var price_add = $('#price_add').val();
		                            price_add = price_add*1;

		                            var now_price = 0;
		                            var design_sum = 0;
		                            var code_sum = 0;
		                            var option1 = 0;
		                            var option2 = 0;
		                            var option3 = 0;
		                            if(design_check1==true){ now_price = now_price+300000; }
		                            if(design_check2==true){ now_price = now_price+500000; }
		                            if(design_check3==true){ now_price = now_price+3000000; }
                            		if(design_check4==true){ now_price = now_price+1000000; }
		                            //design 결과값 넣기
		                            design_sum = comma(now_price);
		                            design_total = now_price;
		                            $('#design_sum').html(design_sum);

		                            //code 영역 계산 시작
		                            if(code_check1==true){ now_price = now_price+300000; }
		                            if(code_check2==true){ now_price = now_price+50000; }
		                            if(code_check3==true){ option1++;}
		                            //design 결과값 넣기
		                            code_sum = comma(now_price-design_total);
		                            code_total = now_price-design_total;
		                            $('#code_sum').html(code_sum);

		                            //콘텐츠 영역 계산 시작
		                            if(con_check1==true){ now_price = now_price+150000; }
		                            if(con_check2==true){ now_price = now_price+1000000; }
		                            if(con_check3==true){ now_price = now_price+300000; }
		                            //design 결과값 넣기
		                            con_sum = comma(now_price-code_total-design_total);
		                            $('#con_sum').html(con_sum);
		                            
		                            //사회적 경제 영역 체크 
		                            if(social_check1==true){ now_price = now_price*.7; option2++; }
		                            //사회적 경제 영역 체크 
		                            if(other_check1==true){ option3++; }

		                            //추가 가격 입력하기
		                            now_price = now_price+price_add;

		                            //total sum
		                            //소수점 버리기
		                            now_price = Math.round(now_price);
		                            var total_sum = comma(now_price);
		                            $('#total_sum').html(total_sum);
		                            $('#input_sum').val(now_price);

		                            //option 글 관리
		                            var option_val = '* 부가세 별도입니다.<br/>';
		                            var option1_cmt = '* 고급 기능요청을 선택하셨습니다.(예상견적에서는 제외됩니다.)<br/>';
		                            var option2_cmt = '* 사회적 경제영역 할인을 선택하셨습니다.<br/>';
		                            var option3_cmt = '* 디자인 시안의 코딩을 요청하셨습니다.<br/>';
		                            option_val = option_val;
		                            if(option1==1){
		                                option_val = option_val+option1_cmt;
		                            }
		                            if(option2==1){
		                                option_val = option_val+option2_cmt;
		                            }
		                            if(option3==1){
		                                option_val = option_val+option3_cmt;
		                            }
		                            $('#cal_option').html(option_val);
		                        }

		                        //숫자변수 3자리마다 콤마 붙이기
		                        function comma(num) {     // 숫자에 콤마 삽입  
		                            var len, point, str;  
		                      
		                            num = num + "";  
		                            point = num.length % 3  
		                            len = num.length;  
		                      
		                            str = num.substring(0, point);  
		                            while (point < len) {  
		                                if (str != "") str += ",";  
		                                str += num.substring(point, point + 3);  
		                                point += 3;  
		                            }  
		                            return str; 
		                            
		                        }
		                        function check_page(val){
		                            //alert('test');
		                            if(val==1){
		                                //page_val = '신규 페이지';
		                                page_val = 0;
		                                //체크박스 - 다른쪽꺼 비활성화하기
		                                $('#check_page').prop('checked', true);
		                                $('#check_page2').prop('checked', false);
		                                $('#check_page_detail').hide();
		                            }else{
		                                page_val = '기존 페이지';
		                                $('#check_page').prop('checked', false);
		                                $('#check_page2').prop('checked', true);
		                                $('#check_page_detail').show();
		                            }
		                            $('#page_type').val(page_val);
		                        }


		                        </script>
		                        <!--견적 문의 form-->
		                        <table id='price_table'>
		                            <tr>
		                                <td class='price_td_t'>담당자 정보</td>
		                                <td>
		                                    <table id='user_info_table'>
		                                        <tr>
		                                            <td class='user_info_table_title'>Name</td>
		                                            <td><input type="text" id="u_name" name="" value="intropage" style="width: 90%;"/></td>
		                                        </tr>
		                                        <tr>
		                                            <td class='user_info_table_title'>E-mail</td>
		                                            <td><input type="email" id="u_email" name="" value="help@intropage.net" style="width: 90%; ime-mode:disabled"/></td>
		                                        </tr>
		                                        <tr>
		                                            <td class='user_info_table_title'>Phone</td>
		                                            <td><input type="text" id="u_phone" name="" value="070-8692-0392" style="width: 90%;"/></td>
		                                        </tr>
		                                    </table>
		                                </td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>추가 의뢰 내용</td>
		                                <td>
		                                    <textarea id='u_comment' style="width: 90%;"></textarea>
		                                    <!--하단 설명영역-->
		                                    <div class='script'>
		                                        추가 견적 내용 등을 입력합니다.
		                                    </div>
		                                </td>
		                            </tr>
		                        </table>
		                        <div class='bt_start'>
		                           <button id="save_offer1" class="btn btn-success" alt="견적 의견 작성">견적 의견 작성</button>
		                        </div>
							<?}else if($offer_area==2){?>
								<!--추가 지원 요청-->
								<h3><img src='/img/icon/icon_calculation.png' class='icon_st'/>가격 계산기</h3>
		                        <hr style='margin-top:10px; margin-bottom: 10px;'/>
		                        <table id='price_table'>
		                            <tr>
		                                <th class='price_td_t'>항목</td>
		                                <th class='price_td_con'>지원 범위</td>
		                                <th class='price_td_val'>가격</td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>온라인 생중계</td>
		                                <td>
		                                    <input type="checkbox" id="live_check1" name="" value="" onclick='cal_check();' /> 기본 구성<br/>
		                                    <input type="checkbox" id="live_check2" name="" value="" onclick='cal_check();' /> 일반 구성<br/>
		                                    <input type="checkbox" id="live_check3" name="" value="" onclick='cal_check();' /> 고급 구성
		                                </td>
		                                <td id='live_sum'>0</td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>견적 추가</td>
		                                <td>
		                                    <input type="text" id="price_add" name="" value="" onkeyup='cal_check();' /> 
		                                </td>
		                                <td></td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>추가 선택</td>
		                                <td>
		                                    <input type="checkbox" id="option_check1" name="" value="" onclick='cal_check();' /> 영상 후 편집<br/>
		                                    <input type="checkbox" id="option_check2" name="" value="" onclick='cal_check();' /> 촬영 사진 후 편집
		                                </td>
		                                <td id='option_sum'>0</td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>할인</td>
		                                <td>
		                                    <input type="checkbox" id="social_check1" name="" value="" onclick='cal_check();' /> 사회적 경제 영역 (30%할인)
		                                </td>
		                                <td id='con_sum'>0</td>
		                            </tr>
		                            <tr class='price_table_effect_tr'>
		                                <th>예상 견적</th>
		                                <th colspan='2' id='total_sum'>
		                                    0
		                                </th>
		                            </tr>
		                        </table>
		                         <input type="hidden" id="input_sum" name="" value="" /> 
		                        <div id='cal_option' class='script mg_top_15'>
		                        </div>
		                        <script type='text/javascript'>
		                        function cal_check(){
		                            var live_check1 = $('#live_check1').is(':checked');
		                            var live_check2 = $('#live_check2').is(':checked');
		                            var live_check3 = $('#live_check3').is(':checked');
		                            var option_check1 = $('#option_check1').is(':checked');
		                            var option_check2 = $('#option_check2').is(':checked');
		                            var social_check1 = $('#social_check1').is(':checked');
		                            var price_add = $('#price_add').val();
		                            price_add = price_add*1;
		                            var now_price = 0;
		                            var live_sum = 0;
		                            var option_sum = 0;
		                            var option1 = 0;
		                            var option2 = 0;
		                            var option3 = 0;
		                            //live 영역 계산 시작
		                            if(live_check1==true){ now_price = now_price+600000; }
		                            if(live_check2==true){ now_price = now_price+1000000; }
		                            if(live_check3==true){ now_price = now_price+3000000; }
		                            //design 결과값 넣기
		                            live_sum = comma(now_price);
		                            live_total = now_price;
		                            $('#live_sum').html(live_sum);

		                            //option 영역 계산 시작
		                            if(option_check1==true){ now_price = now_price+300000; option1++;}
		                            if(option_check2==true){ now_price = now_price+100000; option2++; }
		                            //design 결과값 넣기
		                            opt_sum = comma(now_price-live_total);
		                            opt_total = now_price-live_total;
		                            $('#option_sum').html(opt_sum);
		                            
		                            //사회적 경제 영역 체크 
		                            if(social_check1==true){ now_price = now_price*.7; option3++; }

		                            //추가 가격 입력하기
		                            now_price = now_price+price_add;
		                            //total sum
		                            //소수점 버리기
		                            now_price = Math.round(now_price);
		                            var total_sum = comma(now_price);
		                            $('#total_sum').html(total_sum);
		                            $('#input_sum').val(now_price);

		                            //option 글 관리
		                            var option_val = '* 부가세 별도입니다.<br/>';
		                            var option1_cmt = '* 영상 시간에 따라 비용은 달라집니다.<br/>';
		                            var option2_cmt = '* 촬영 사진의 장수에 따라 가격은 달라집니다.<br/>';
		                            var option3_cmt = '* 사회적 경제영역 할인을 선택하셨습니다.<br/>';
		                            option_val = option_val;
		                            if(option1==1){
		                                option_val = option_val+option1_cmt;
		                            }
		                            if(option2==1){
		                                option_val = option_val+option2_cmt;
		                            }
		                            if(option3==1){
		                                option_val = option_val+option3_cmt;
		                            }
		                            $('#cal_option').html(option_val);
		                        }

		                        //숫자변수 3자리마다 콤마 붙이기
		                        function comma(num) {     // 숫자에 콤마 삽입  
		                            var len, point, str;  
		                      
		                            num = num + "";  
		                            point = num.length % 3  
		                            len = num.length;  
		                      
		                            str = num.substring(0, point);  
		                            while (point < len) {  
		                                if (str != "") str += ",";  
		                                str += num.substring(point, point + 3);  
		                                point += 3;  
		                            }  
		                            return str; 
		                            
		                        }
		                        function check_page(val){
		                            //alert('test');
		                            if(val==1){
		                                //page_val = '신규 페이지';
		                                page_val = 0;
		                                //체크박스 - 다른쪽꺼 비활성화하기
		                                $('#check_page').prop('checked', true);
		                                $('#check_page2').prop('checked', false);
		                                $('#check_page_detail').hide();
		                            }else{
		                                page_val = '';
		                                $('#check_page').prop('checked', false);
		                                $('#check_page2').prop('checked', true);
		                                $('#check_page_detail').show();
		                            }
		                            $('#page_type').val(page_val);
		                        }
		                        </script>
		                        <!--견적 문의 form-->
		                        <table id='price_table'>
		                            <tr>
		                                <td class='price_td_t'>담당자 정보</td>
		                                <td>
		                                    <table id='user_info_table'>
		                                        <tr>
		                                            <td class='user_info_table_title'>Name</td>
		                                            <td><input type="text" id="u_name" name="" value="intropage" style="width: 90%;"/></td>
		                                        </tr>
		                                        <tr>
		                                            <td class='user_info_table_title'>E-mail</td>
		                                            <td><input type="email" id="u_email" name="" value="help@intropage.net" style="width: 90%; ime-mode:disabled"/></td>
		                                        </tr>
		                                        <tr>
		                                            <td class='user_info_table_title'>Phone</td>
		                                            <td><input type="text" id="u_phone" name="" value="070-8692-0392" style="width: 90%;"/></td>
		                                        </tr>
		                                    </table>
		                                </td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>추가 의뢰 내용</td>
		                                <td>
		                                    <textarea id='u_comment' style="width: 90%;"></textarea>
		                                    <!--하단 설명영역-->
		                                    <div class='script'>
		                                        추가 견적 내용 등을 입력합니다.
		                                    </div>
		                                </td>
		                            </tr>
		                        </table>
		                        <div class='bt_start'>
		                           <button id="save_offer2" class="btn btn-success" alt="견적 의견 작성">견적 의견 작성</button>
		                        </div>
		                    <?}else if($offer_area==3){?>
		                   		 <table id='price_table'>
		                            <tr>
		                                <td class='price_td_t'>담당자 정보</td>
		                                <td>
		                                    <table id='user_info_table'>
		                                        <tr>
		                                            <td class='user_info_table_title'>Name</td>
		                                            <td><input type="text" id="u_name" name="" value="intropage" style="width: 90%;"/></td>
		                                        </tr>
		                                        <tr>
		                                            <td class='user_info_table_title'>E-mail</td>
		                                            <td><input type="email" id="u_email" name="" value="help@intropage.net" style="width: 90%; ime-mode:disabled"/></td>
		                                        </tr>
		                                        <tr>
		                                            <td class='user_info_table_title'>Phone</td>
		                                            <td><input type="text" id="u_phone" name="" value="070-8692-0392" style="width: 90%;"/></td>
		                                        </tr>
		                                    </table>
		                                </td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>답변</td>
		                                <td>
		                                    <textarea id='u_comment' style="width: 90%;"></textarea>
		                                    <!--하단 설명영역-->
		                                    <div class='script'>
		                                        문의 내용에 대한 답변 등록하기
		                                    </div>
		                                </td>
		                            </tr>
		                        </table>
		                        <div class='bt_start'>
		                           <button id="save_offer3" class="btn btn-success" alt="견적 의견 작성">답변 작성</button>
		                        </div>
	                        <?}else if($offer_area==4){?>
								<!--추가 지원 요청-->
								<h3><img src='/img/icon/icon_calculation.png' class='icon_st'/>가격 계산기</h3>
		                        <hr style='margin-top:10px; margin-bottom: 10px;'/>
		                        <table id='price_table'>
		                            <tr>
		                                <th class='price_td_t'>항목</td>
		                                <th class='price_td_con'>지원 범위</td>
		                                <th class='price_td_val'>가격</td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>시리즈 맵</td>
		                                <td>
		                                    <input type="checkbox" id="map_check1" name="" value="" onclick='cal_check();' /> 기본 구성<br/>
		                                    <input type="checkbox" id="map_check2" name="" value="" onclick='cal_check();' /> 일반 구성<br/>
		                                    <input type="checkbox" id="map_check3" name="" value="" onclick='cal_check();' /> 고급 구성
		                                </td>
		                                <td id='map_sum'>0</td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>견적 추가</td>
		                                <td>
		                                    <input type="text" id="price_add" name="" value="" onkeyup='cal_check();' /> 
		                                </td>
		                                <td></td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>추가 선택</td>
		                                <td>
		                                    <input type="checkbox" id="option_check1" name="" value="" onclick='cal_check();' /> 자료 입력 대행 (개당 10,000원)<br/>
		                                    <input type="text" id="option_check2" name="" value="" onKeyup='cal_check();' /> 개
		                                </td>
		                                <td id='option_sum'>0</td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>할인</td>
		                                <td>
		                                    <input type="checkbox" id="social_check1" name="" value="" onclick='cal_check();' /> 사회적 경제 영역 (30%할인)
		                                </td>
		                                <td id='con_sum'>0</td>
		                            </tr>
		                            <tr class='price_table_effect_tr'>
		                                <th>예상 견적</th>
		                                <th colspan='2' id='total_sum'>
		                                    0
		                                </th>
		                            </tr>
		                        </table>
		                         <input type="hidden" id="input_sum" name="" value="" /> 
		                        <div id='cal_option' class='script mg_top_15'>
		                        </div>
		                        <script type='text/javascript'>
		                        function cal_check(){
		                            var map_check1 = $('#map_check1').is(':checked');
		                            var map_check2 = $('#map_check2').is(':checked');
		                            var map_check3 = $('#map_check3').is(':checked');
		                            var option_check1 = $('#option_check1').is(':checked');
		                            var option_check2 = $('#option_check2').val();
		                            var social_check1 = $('#social_check1').is(':checked');
		                            var price_add = $('#price_add').val();

		                            var now_price = 0;
		                            var map_sum = 0;
		                            var option_sum = 0;
		                            var option1 = 0;
		                            var option2 = 0;
		                            var option3 = 0;
		                            //map 영역 계산 시작
		                            if(map_check1==true){ now_price = now_price+0; }
		                            if(map_check2==true){ now_price = now_price+300000; }
		                            if(map_check3==true){ now_price = now_price+500000; }
		                            //design 결과값 넣기
		                            map_sum = comma(now_price);
		                            map_total = now_price;
		                            $('#map_sum').html(map_sum);

		                            if(price_add!=''){
		                            	price_add = price_add*1;
		                            	now_price = now_price+price_add;
		                            }

		                            //option 영역 계산 시작
		                            if(option_check1==true && option_check2!=''){
		                                now_price = now_price+(10000*option_check2);
		                                option1++;
		                                option2++;
		                            }else if(option_check1==true && option_check2==''){
		                                now_price = now_price+10000;
		                                option1++;
		                            }

		                            //design 결과값 넣기
		                            opt_sum = comma(now_price-map_total-price_add);
		                            opt_total = now_price-map_total;
		                            $('#option_sum').html(opt_sum);
		                            
		                            //사회적 경제 영역 체크 
		                            if(social_check1==true){ now_price = now_price*.7; option3++; }

		                            //total sum
		                            //소수점 버리기
		                            now_price = Math.round(now_price);
		                            var total_sum = comma(now_price);
		                            $('#total_sum').html(total_sum);
		                            $('#input_sum').val(now_price);

		                            //option 글 관리
		                            var option_val = '* 부가세 별도입니다.<br/>';
		                            var option1_cmt = '* 자료 입력 대행을 선택하셨습니다.<br/>';
		                            var option2_cmt = '* 제공받은 자료의 양에 따라 비용이 올라갈 수 있습니다.<br/>';
		                            var option3_cmt = '* 사회적 경제영역 할인을 선택하셨습니다.<br/>';
		                            option_val = option_val;
		                            if(option1==1){
		                                option_val = option_val+option1_cmt;
		                            }
		                            if(option2==1){
		                                option_val = option_val+option2_cmt;
		                            }
		                            if(option3==1){
		                                option_val = option_val+option3_cmt;
		                            }
		                            $('#cal_option').html(option_val);
		                        }

		                        //숫자변수 3자리마다 콤마 붙이기
		                        function comma(num) {     // 숫자에 콤마 삽입  
		                            var len, point, str;  
		                      
		                            num = num + "";  
		                            point = num.length % 3  
		                            len = num.length;  
		                      
		                            str = num.substring(0, point);  
		                            while (point < len) {  
		                                if (str != "") str += ",";  
		                                str += num.substring(point, point + 3);  
		                                point += 3;  
		                            }  
		                            return str; 
		                            
		                        }
		                        function check_page(val){
		                            //alert('test');
		                            if(val==1){
		                                //page_val = '신규 페이지';
		                                page_val = 0;
		                                //체크박스 - 다른쪽꺼 비활성화하기
		                                $('#check_page').prop('checked', true);
		                                $('#check_page2').prop('checked', false);
		                                $('#check_page_detail').hide();
		                            }else{
		                                page_val = '';
		                                $('#check_page').prop('checked', false);
		                                $('#check_page2').prop('checked', true);
		                                $('#check_page_detail').show();
		                            }
		                            $('#page_type').val(page_val);
		                        }
		                        </script>
		                        <!--견적 문의 form-->
		                        <table id='price_table'>
		                            <tr>
		                                <td class='price_td_t'>담당자 정보</td>
		                                <td>
		                                    <table id='user_info_table'>
		                                        <tr>
		                                            <td class='user_info_table_title'>Name</td>
		                                            <td><input type="text" id="u_name" name="" value="intropage" style="width: 90%;"/></td>
		                                        </tr>
		                                        <tr>
		                                            <td class='user_info_table_title'>E-mail</td>
		                                            <td><input type="email" id="u_email" name="" value="help@intropage.net" style="width: 90%; ime-mode:disabled"/></td>
		                                        </tr>
		                                        <tr>
		                                            <td class='user_info_table_title'>Phone</td>
		                                            <td><input type="text" id="u_phone" name="" value="070-8692-0392" style="width: 90%;"/></td>
		                                        </tr>
		                                    </table>
		                                </td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>추가 의뢰 내용</td>
		                                <td>
		                                    <textarea id='u_comment' style="width: 90%;"></textarea>
		                                    <!--하단 설명영역-->
		                                    <div class='script'>
		                                        추가 견적 내용 등을 입력합니다.
		                                    </div>
		                                </td>
		                            </tr>
		                        </table>
		                        <div class='bt_start'>
		                           <button id="save_offer4" class="btn btn-success" alt="견적 의견 작성">견적 의견 작성</button>
		                        </div>
		                    <?}?>
						</div>
						<?	
						}else{
							echo '프로젝트 참여정보가 없습니다.<br/>';
						}?>
						
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
<SCRIPT TYPE="text/javascript">
	function history_back(){
		location.href='/admin/show_offer_list/';
	}
	//문의 내용 보기
	function mail_detail(m_id){
		//alert(m_id);
		$.post('/mypage/mail_con',{
			m_id: m_id
		},
		function(data){
			open_modal(data);
			$('#modal_txt').html(data);
			$('#login_close').show();
			//alert(data);
			 //window.open(linked_url,'','');
		}); 

	}
</SCRIPT>
<!-- graph 출력 관련 -->
</body>
</html>