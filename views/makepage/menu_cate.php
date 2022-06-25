<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta content="width=device-width,minimum-scale=1,maximum-scale=1" name="viewport" />

<?$this->load->view('/include/head_info');?>

<!--user code file-->
<link href="/select_design_sample/sp_layout.css" type="text/css" rel="stylesheet" media="screen and (min-width:800px)"/>
<link href="/select_design_sample/sp_layout_m.css" type="text/css" rel="stylesheet" media="screen and (max-width:799px)"/>
<!--user code file-->
<script type="text/javascript" src="/select_design_sample/sp_js.js"></script>
<script type="text/javascript">
	//jQuery 있는 상태
	window.onload=function(){
		var w_num = $('#w_num').val();
		check_menu_cate(w_num);
		check_set_menu(w_num);

	};

	//jQuery 있는 상태
	$(document).ready(function() {

		//새 카테고리 저장
		$("#add_cate").click(function(){
			var w_num = $('#w_num').val();
			var input_cate = $('#input_cate').val();
			//alert(w_num);
			//alert(search_food_name);

			/**/
			if(input_cate==''){
				alert('추가할 항목을 선택해주세요.');
			}else{
				$.post("/menu/match_cate",{
					w_num: w_num,
					input_cate: input_cate,
				},
				function(data){
					if(data==1){
						alert('기존에 등록된 항목입니다.');
					}else{
						//check_menu_cate(w_num);
						location.reload();
					}
				}); 
			}
				
		});

		
		
		
		$("#goto_rinfo").click(function(){
			var edit_code = '<? echo $edit_code; ?>';
			var page_secur = '<?echo $page_secur;?>';
			//alert(page_secur);
			if(edit_code==2){
				//코드 수정권한이 있을 때는 menu_cate페이지로..
				location.href='/makepage/con_detail/'+page_secur;
			}else{
				//아닐때는.. 활성화 페이지로
				location.href='/makepage/add_other/'+page_secur;
			}
		});

		/* modal창의 콘텐츠에서 클릭해도 창이 없어지지 않도록 하려면...*/
		 $("body").click(function(){
			check_modal();
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

 	//현재 매칭된 메뉴 리스트 출력하기
 	function check_menu_cate(w_num){
 		$.post("/menu/check_menu_cate",{
				w_num: w_num
			},
			function(data){
				//alert(data);
				if(data==1){
					$("#now_cate").html('현재 등록된 항목 정보가 없습니다.');
				}else{
					$("#now_cate").html(data);
				}
				
				//open_modal(data);
				//fadeout_modal(); 
				//$('#val_url').val('');
				//$('#val_url_txt').val('');
			});
 	}

 	function check_set_menu(w_num){
 		$.post("/menu/check_set_menu",{
				w_num: w_num
			},
			function(data){
				//alert(data);
				if(data==1){
					$("#now_set").html('현재 등록된 항목 정보가 없습니다.');
				}else{
					$("#now_set").html(data);
				}
				
				//open_modal(data);
				//fadeout_modal(); 
				//$('#val_url').val('');
				//$('#val_url_txt').val('');
			});
 	}
 	

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
	//메뉴 구성
	function scr_bt(val){
		//상단부터 div까지의 높이값 구하기
		var num_w = -90;
		var div1 = $('#con_title').offset().top+num_w;
		//alert(div1);
		if(val == 'menu1'){
			$('html, body').animate( {scrollTop:div1} );
		}else{
			$('html, body').animate( {scrollTop:'0'} );
		}
	}
	
</script>
<style>
	#top_area{
		width: 800px;
		padding-bottom: 20px;
	}
	#top_con{
		padding-bottom: 20px;
		margin-bottom: 20px;
	}
	
	#con_area_con{
		width: 800px;
		background: #fff;
		margin-left: auto;
		margin-right: auto;
	}
	#con_main{
		margin-top: 10px;
		margin-bottom: 20px;
		padding-left: 10px;
		padding-right: 10px;
		background: #fff;
	}
	#input_form img{
		width: 30px;
		margin-right: 10px;
	}
	input.focus_area {
		background: #efefef;
		border: 0;
		width: 540px;
		height: 30px;
		margin-bottom: 5px;
	}
	input.title{
		background: #efefef url(/img/input/bg_title.jpg) no-repeat;
		border: 0;
		width: 540px;
		height: 30px;
		margin-bottom: 5px;
	}
	#input_area_plus{
		clear: left;
		width: 100%;
		text-align: left;
		padding-top: 10px;
		padding-bottom: 10px;
	}
	.input_area_st{
		display: inline-block;
		text-align: center;
		background: url(/img/input_area_bg.jpg) repeat-y;
	}
	.input_area_start{
		background: url(/img/input_area_bg_start.jpg) repeat-y;
	}
	.input_area_plus{
		background: url(/img/input_area_bg_finish.jpg) repeat-y;
	}
	#con_main{
		text-align: center;
		margin-top: 0px;
	}
	@media (max-width:799px) {
		input.focus_area {
			background: #efefef;
			border: 0;
			width: 200px;
			height: 30px;
			margin-bottom: 5px;
		}
		input.title{
			background: #efefef url(/img/input/bg_title.jpg) no-repeat;
			border: 0;
			width: 200px;
			height: 30px;
			margin-bottom: 5px;
		}
	}
</style>
<style>
/*그래프 스타일- 여기선 출력되야하니.. */
	.ggraph_st{
		display: block;
	}
	#top_area, #con_area{
		width: 800px;
	}
	#con_area_con{
		width: 800px;
		margin-left: auto;
		margin-right: auto;
	}
	#con_main{
		margin-top: 0px;
		margin-bottom: 20px;
		padding-left: 10px;
		padding-right: 10px;
		background: #fff;
	}
	@media (max-width:799px) {
		#top_area, #con_area{
			width: 100%;
		}
		#con_main{
		max-width: 280px;
		}
		#con_area_con{
			width: 95%;
			margin-left: auto;
			margin-right: auto;
		}
	}
</style>
</head>
<body>
<!-- make step bar area include -->
<?$this->load->view('/include/make_step');?>
<div id='container'>
	<!-- top Area Start -->
	<div id='top_area'>
		<div id='top_con' style='padding-top:10px; padding-bottom: 10px;'>
			<?if($logo!=''){
				echo '<div class="circular" style="float: left; background:url('.$logo.') no-repeat center center; width: 70px; height:70px; background-size:80px 80px; margin-right: 10px;"></div>';
				echo '<div class="top_with_logo">';
			}else{
				echo '<div class="top_withOut_logo">';
			}?>
				<h3><?echo $title;?></h3>
				항목 설정<br/>
				<span style='font-size: 10px; color: #555555;'>식당의 판매 메뉴를 추가해주세요.</span>
				
			</div>
		</div>
	</div>
	<!-- top Area finish -->
	<!-- Contents Area Start -->
	<div id='con_area'>
		<div id='con_area_con'>
			<!-- Contents Area Start -->
			<div id='con_main'>
				<h3>항목 설정</h3>
				<div id='now_cate_area' style='text-align: left; padding: 15px; border: 1px solid #efefef;'>
					<b>세트</b> <button class='bt_add_g' onclick='show_add_set();'>추가</button>: 
					<span id='now_set' style='width: 100%; '>
					</span><br/>
					<hr style="width: 100%; margin-top:10px;"/>
					<b>항목</b> <button class='bt_add_r' onclick='show_add_cate();'>추가</button>: 
					<span id='now_cate' style='width: 100%; '>
					</span>
				</div>
				<script type="text/javascript">
					function show_add_cate(){
						if($('#add_cate_area').css('display')=='none'){
							$('#add_cate_area').slideDown();
							$('#add_set_area').slideUp();
							$('#show_food_list').html('');
						}else{
							$('#add_cate_area').slideUp();
						}
						
					}
                    //카테고리 추가 항목-셀렉트 박스 설정
                    function cate_add(value){
                        var ct_num = $('#cate_list > option:selected').val();
                        var input_w_num = $('#w_num').val();
                        $('#input_cate').val(value);
                    }

                    function set_cate_food(ct_num){
                        var input_w_num = $('#w_num').val();
                        //alert(input_w_num);

				 		$.post("/menu/check_cate_food",{
							w_num: input_w_num,
							ct_num: ct_num,
						},
						function(data){
							//alert(data);
							$("#show_food_list").html(data);

							$('#add_set_area').slideUp();
							$('#add_cate_area').slideUp();
							
							//open_modal(data);
							//fadeout_modal(); 
							//$('#val_url').val('');
							//$('#val_url_txt').val('');
						});
                    }

                    //항목 삭제
                    function del_cate_food(ct_num){
                        var input_w_num = $('#w_num').val();
                        //alert(input_w_num);

				 		$.post("/menu/dell_cate_menu",{
							w_num: input_w_num,
							ct_num: ct_num
						},
						function(data){
							alert('삭제되었습니다.');
							//$("#show_food_list").html(data);
							
							location.reload();
							
							//open_modal(data);
							//fadeout_modal(); 
							//$('#val_url').val('');
							//$('#val_url_txt').val('');
						});
                    }

                    function show_add_set(){
						if($('#add_set_area').css('display')=='none'){
							$('#add_set_area').slideDown();
							$('#add_cate_area').slideUp();
							$('#show_food_list').html('');
						}else{
							$('#add_set_area').slideUp();
						}
						
					}

                </script>
                <!--cate 추가 영역-->
				<div id='add_cate_area' style='display: none; margin-top: 15px;'>

					<select name="cate_list" id="cate_list" onchange="cate_add(value);" style='width: 150px;'>
	                    <option >항목을 선택해주세요.</option>
	                    <?
	                        //언어 DB로 가져오기
	                        $this->db->from('ez_cate_info');
	                        $this->db->order_by('ct_num','asc');
	                        //$this->db->select('description');
	                        $query1=$this->db->get();
	                        if ($query1->num_rows()){
	                          foreach ($query1->result_array() as $row)
	                          {
	                            //print_r($row);
	                            $ct_num = $row['ct_num'];
	                            $ct_name = $row['ct_name'];

	                            $this->db->from('ez_restaurant_category');
		                        $this->db->where('ct_num',$ct_num);
		                        $query2=$this->db->get();
		                        if ($query2->num_rows()){
		                     	}else{

	                    ?>
	                            <option value='<?echo $ct_num;?>'><?echo $ct_name;?></option>
	                    <?
	                    		}
	                          }
	                        }
	                        
	                     ?>
	                </select>
					<input id="input_cate" name="input_cate" type="hidden"/>
					<button id="add_cate" class="btn btn-primary">
						추가
					</button>
				</div>
				<!--set 추가 영역-->
				<div id='add_set_area' style='display: none; margin-top: 15px; text-align: left; background: #efefef; padding: 15px;'>

					<!--언어설정-->
                    <script type="text/javascript">
                    //tag 언어 선택 관련
                    function check_lng(value){
                        var input_lng = value;
                        var input_w_num = $('#w_num').val();
                        $('#input_lng').val(value);

                        $.post('/makepage/get_lng_info/',{
                            input_lng: input_lng,
                            input_w_num: input_w_num
                        },
                        function(data){
                            //문자열 분기
                            if(data!=0){
                                var txt_s = data.split('&&ttss&&');
                                var title_lng = txt_s[0];
                                var title_summary = txt_s[1];
                                $('#input_title').val(title_lng);
                                $('#input_summary').val(title_summary);
                                check_now_lng();
                                //alert(title_lng);
                            }
                          
                        });
                    }


                    </script>
                    <h3 title='입력하는 언어를 선택해주세요.'>입력 언어</h3>
                    <?if($re_lng!=''){
                        $now_lng = $re_lng;
                    }else{ 
                        $now_lng = '한국어';
                    }?>
                    <style>
                    	#add_set_area input, #add_set_area select{
                    		margin-top: 10px;
                    		margin-bottom: 10px;

                    	}
                    </style>
                    <table width='100%'>
                    	<tr>
                    		<td width='50px;'>
                    			언어
                    		</td>
                    		<td>
                    			<input id="input_lng" name="input_lng" type="hidden" value="<?echo $now_lng;?>" />
			                    <select name="title_lng" id="title_lng" onchange="check_lng(value);">
			                    <?
			                        //언어 DB로 가져오기
			                        $this->db->from('ez_lng');
			                        $this->db->order_by('lng_num','asc');
			                        //$this->db->select('description');
			                        $query1=$this->db->get();
			                        if ($query1->num_rows()){
			                          foreach ($query1->result_array() as $row)
			                          {
			                            //print_r($row);
			                            $lng_num = $row['lng_num']-1;
			                            $lng_txt = $row['lng_txt'];

			                            if($re_lng == $lng_txt){
			                                $now_selected_lng = 'yes';
			                            }else{
			                                $now_selected_lng = 'no';
			                            }
			                    ?>
			                            <option ><?echo $lng_txt;?></option>
			                    <?
			                          }
			                        }
			                        
			                     ?>
			                    </select>
                    		</td>
                    	</tr>
                    	<tr>
                    		<td>
                    			세트명
                    		</td>
                    		<td>
                    		<script type="text/javascript">	
								$(document).ready(function() {  
									//세트값 저장
									$("#add_set_info").click(function(){
										var w_num = $('#w_num').val();
										var set_title = $('#set_title').val();
										var title_lng = $('#title_lng > option:selected').val();
							            var set_unit_select = $('#price_unit_select > option:selected').val();
										var set_price = $('#set_price').val();
										//alert(w_num);

										/*
										*/
										if(set_title==''){
											alert('세트명을 입력한 후, 선택해주세요.');
										}else{
											$.post("/menu/add_set_info",{
												w_num: w_num,
												set_title: set_title,
												title_lng: title_lng,
												set_unit_select: set_unit_select,
												set_price: set_price
											},
											function(data){
												if(data==1){
													alert('등록했습니다.');
													location.reload();
												}else if(data==2){
													alert('업데이트를 완료했습니다.');
													location.reload();
												}else{
													alert('다시 시도해주십시요.');
													//check_menu_cate(w_num);
													location.reload();
												}
											}); 
										}
											
									});
								 	
								 	//세트명 검색
								    $('#search_title').keyup(function(e){
								      //alert('test');
								      var keyword = $('#search_title').val();
										
								      $.post('/menu/search_set_title/',{
								         keyword: keyword
								          },
								          function(data){
								              //alert(data);
								              //입력값 초기화하기
								              //open_modal(data);
								              if(data!==''){
								                $('#search_title_result').show();
								                $('#search_title_result').html(data);
								              }else{
								                $('#search_title_result').hide();
								                $('#search_title_result').html('');
								              }
								              
								          });
								    });
								});
								
								//세트메뉴 타이틀 저장
								function add_set_title(keyword){
									var w_num = $('#w_num').val();
									var title_lng = $('#title_lng > option:selected').val();
							      	//alert(title_lng);
									$.post('/menu/add_set_title/',{
									 	w_num: w_num,
									 	keyword: keyword,
									 	title_lng: title_lng
									},
									function(data){
									      //alert(data);
									      //입력값 초기화하기
									      //open_modal(data);
									      if(data!=1){
									      	alert('타이틀 저장이 안되었습니다. 새로고침 후 다시 실행해 주세요.');
									      }else{
									      	var now_set_txt = keyword+' (<a href="javascript: unselect_title();">삭제</a>)';
									        $('#search_title').hide();
									        $('#set_title').val(keyword);
									        $('#search_title_result').html(now_set_txt);
									        $('#search_title').html('');
									      }
									      
									});
								}
								//세트메뉴 선택 해제하기
								function unselect_title(){
									//삭제를 하면..search_title_result 값 없애고, 타이틀 검색 input 창 활성화, set_title값 삭제
									$('#search_title').show();
									$('#search_title_result').html('');
									$('#set_title').val('');
								}

								//세트메뉴 추가
								function set_setmenu(set_num){
			                        var input_w_num = $('#w_num').val();
			                        //alert(input_w_num);

							 		$.post("/menu/check_set_food",{
										w_num: input_w_num,
										set_num: set_num
									},
									function(data){
										//alert(data);
										$("#show_food_list").html(data);

										$('#add_set_area').slideUp();
										$('#add_cate_area').slideUp();
										
										//open_modal(data);
										//fadeout_modal(); 
										//$('#val_url').val('');
										//$('#val_url_txt').val('');
									});
			                    }

								//세트메뉴 삭제
			                    function del_setmenu(set_num){
			                        var input_w_num = $('#w_num').val();
			                        //alert(input_w_num);

							 		$.post("/menu/dell_set_menu",{
										w_num: input_w_num,
										set_num: set_num
									},
									function(data){
										alert('삭제되었습니다.');
										//$("#show_food_list").html(data);
										
										location.reload();
										
										//open_modal(data);
										//fadeout_modal(); 
										//$('#val_url').val('');
										//$('#val_url_txt').val('');
									});
			                    }
							</script>
                    			<input id="search_title" name="search_title" type="text"/>
                    			<div id="search_title_result" style="display: none; background: #efefef; padding: 10px;">
                    			</div>
                    			<input id="set_title" name="set_title" type="hidden" />
                    			
                    		</td>
                    	</tr>
                    	<tr>
                    		<td>
                    			가격
                    		</td>
                    		<td>
                    			<select name="price_unit_select" id="price_unit_select" style='width: 100px;'>
								  <?
								  		$money_symbol = $unit_txt;
										
										for($money=0;$money<sizeof($money_symbol);$money++){
											$ws_now_check = 0;
											if($single_price==$money_symbol[$money]){
												$ws_now_check = 1;
											}
									?>
										<option <?if($ws_now_check==1){?>selected="selected"<?}?>><?echo $money_symbol[$money];?></option>
				                    <?
				                		}
				                    ?>
								</select>
                    			<input id="set_price" name="set_price" type="text" />
                    		</td>
                    	</tr>

                    </table>
					<button id="add_set_info" class="btn btn-primary">
						추가
					</button>
				</div>
				<div id='show_food_list' style='text-align: left;'>
					 
				</div>
				<div id='input_form' style='margin-top: 15px;'>
					<input id="w_num" name="w_num" class="focus_area" type="hidden" value="<?echo $w_num;?>"/>
					<hr style="width: 100%; margin-top:10px;"/>
					<div id='bt_area'>
						<button id="goto_rinfo" class="btn btn-success"><img src='/img/icon/icon_next_w.png' style='width:16px; margin-right: 5px;' valign='middle'><?if($edit_code==2){echo '식당 소개';}else{echo '사이트 활성화하기';}?></button>
					</div>
				</div>					
			</div>
			<!-- Contents Area finish -->
		</div>
	<!-- Other Contents Area finish -->
	</div>
	<!-- Contents Area finish -->
</div>
<!--모달창 출력부분 시작-->
<div id="modal_content">
	 <div id="modal_txt">
		<!--내용 출력부분 시작-->
		loading..
	</div>
	<div id='login_close'>
		<a onclick='modal_off()'><img src="/img/land/bt_close.png" alt='close button' /></a>
	</div>
</div>
<!--모달창 출력부분 끝 -->
</body>
</html>