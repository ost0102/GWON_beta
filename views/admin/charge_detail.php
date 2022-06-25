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

	    $('#bt_charge1').click(function(){
		    var offer_id = '<? if(isset($offer_id)){echo $offer_id;}?>';
			var res_id = '<? if(isset($res_id)){echo $res_id;}?>';
			$.post('/admin/charge_update1',{
			    offer_id: offer_id,
			    res_id: res_id
			},
			function(data){
			    alert('계산서 발행이 완료되었습니다.');
			    //입력값 초기화하기
			    location.reload(); 
			    //location.href = '/mypage#!5';
			});
		    
	    });
	    $('#bt_charge2').click(function(){
		    var offer_id = '<? if(isset($offer_id)){echo $offer_id;}?>';
			var res_id = '<? if(isset($res_id)){echo $res_id;}?>';
			$.post('/admin/charge_update2',{
			    offer_id: offer_id,
			    res_id: res_id
			},
			function(data){
			    alert('입금 확인이 완료되었습니다.');
			    //입력값 초기화하기
			    location.reload(); 
			    //location.href = '/mypage#!5';
			});
		    
	    });
	    $('#bt_charge3').click(function(){
		    var offer_id = '<? if(isset($offer_id)){echo $offer_id;}?>';
			var res_id = '<? if(isset($res_id)){echo $res_id;}?>';
			$.post('/admin/charge_update3',{
			    offer_id: offer_id,
			    res_id: res_id
			},
			function(data){
			    alert('모든 결제 과정이 완료되었습니다.');
			    //입력값 초기화하기
			    location.reload(); 
			    //location.href = '/mypage#!5';
			});
		    
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
<div id='right_top_shape'>
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
					<h1 style="margin-top:10px; margin-bottom:10px;">결제 정보 관리 상세페이지</h1>
					<div style="text-align:center; color:#cdcdcd; padding-bottom:10px; margin-bottom:10px; border-bottom: 1px solid #cdcdcd;">
						<a onclick="history_back();" >back</a>
					</div>
					<div id="con_main">
						<!--기술지원 요청 세부 내용 출력 -->
						<? if(isset($offer_id)){
								if(!isset($p_title)){
									$p_title = '신규 페이지';
								}

								if($check_state == 4){
									$check_txt = '결제 시작';
									$now_state_txt = '<b>기술 지원 완료 </b> > 계산서 발행 > 입금 확인 > 결제 완료';
									$offer_area_txt = '클라이언트에게 계산서 발행 및 입금 은행 안내 업무를 수행합니다.';
								}else if($check_state == 5){
									$check_txt = '계산서 발행';
									$now_state_txt = '기술 지원 완료 > <b>계산서 발행</b> > 입금 확인 > 결제 완료';
									$offer_area_txt = '안내한 계좌로 입금이 완료되면 다음 단계로 이동합니다.';
								}else if($check_state == 6){
									$check_txt = '입금 확인';
									$now_state_txt = '기술 지원 완료 > 계산서 발행 > <b>입금 확인</b> > 결제 완료';
									$offer_area_txt = '클라이언트에게 입금확인 연락을 해주세요. 잘 마무리되었다고.';
								}else if($check_state == 7){
									$check_txt = '지원 완료';
									$now_state_txt = '기술 지원 완료 > 계산서 발행 > 입금 확인 > <b>결제 완료</b>';
									$offer_area_txt = '모든 단계가 완료되었습니다.';
								}

								if(!isset($offer_area_txt)){
									$offer_area_txt = '';
								}
								if(!isset($now_state_txt)){
									$now_state_txt = '';
								}
								if(!isset($offer_area_txt)){
									$offer_area_txt = '';
								}
								
							?>
							<div id='help_info_top'>
								<?if($offer_area !=3){?>
									<b><?echo $p_title; ?></b> 페이지에 대한<br/> <b><?echo $offer_area_txt;?></b>
								<?}else{?>
									<b>메일 문의</b>에 대한<br/> <b><?echo $offer_area_txt;?></b>
								<?}?>
								<div id='help_state'>
									진행 단계 : <? echo $now_state_txt; ?>
									<?
									echo '<br/>'.$offer_area_txt;
									?>
								</div>
							</div>
							<!--신청자 정보 -->
							<h3>신청자 정보</h3>
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
	                        </table>
	                        <!--검토 정보 -->
							<h3><?if($check_state==1){ echo '검토 의견';
								}else{ echo '확정 견적';}?></h3>
							<hr style='margin-top:10px;'/>
							<div class='help_con_div'>
								<table id='price_table'>
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
		                                    <? echo number_format($price); ?>
		                                </td>
		                            </tr>
		                        </table>
							</div>
							<div class='bt_start'>
								<?if($check_state==4){?>
									<?if($offer_area !=3){?>
					                  	    		<button id="bt_charge1" class="btn btn-primary" alt="계산서 발행 완료">계산서 발행 완료</button>
						                  	    	<?}else{?>
						                  	    		<button id="bt_charge3" class="btn btn-primary" alt="최종 완료">최종 완료</button>	
						                  	    	<?}?>
					                 	  	<?}else if($check_state==5){?>
						                   <!--진행 중일때-->
						                    	<button id="bt_charge2" class="btn btn-primary" alt="입금 확인">입금 확인</button>
						                    <?}else if($check_state==6){?>
						                    <!--지원이 완료된 후-->
						                  	  	<button id="bt_charge3" class="btn btn-primary" alt="최종 완료">최종 완료</button>			                    
						                    <?}?>
						                    <!--offer_area 값에 따른 작성창 구분 출력-->
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
		location.href='/admin/show_charge_list/';
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