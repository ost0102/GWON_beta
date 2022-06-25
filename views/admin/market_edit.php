<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<?$this->load->view('/include/head_info');?>
<!--document 영역 style -->
<link href='/css/doc_style.css' rel='stylesheet' />
<link href='/css/bootstrap-tokenfield.css' rel='stylesheet' />
<script src="/js/bootstrap-tokenfield.js"></script>
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
 
         $("#mk_tag").tokenfield();
         
	});
</script>
</head>
<body>
<div id=right_top_shape>
	<a href='http://intropage.net/page'><img src='/img/land/right_top_shape.png' class='logo_shape'></a>
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
							 <form action='/admin/market_act' method='post' name='regist' id='regist' enctype="multipart/form-data" >
                              <?
                                if(!$data[0]->mk_date){
                                $today = date("Y-m-d H:i:s");
                                $button ="입력하기"; 
                                $now_title = '앱 정보 입력하기';   
                                }else{
                                $today = $data[0]->mk_date;
                                $mode ="edit";
                                $button ="수정하기";
                                $now_title = '앱 정보 수정하기';
                                }
                                
                              ?>
                               	<input type='hidden' name='mode' value='<?php echo $mode;?>'>
                                <input type='hidden' name='old_mk_view' value='<?php echo $data[0]->mk_view;?>'>
                                <input type='hidden' name='old_mk_icon' value='<?php echo $data[0]->mk_icon;?>'>
                                <input type='hidden' name='mk_idx' value='<?php echo $data[0]->mk_idx;?>'>

			                    <h1>
			                        <? echo $now_title;?>
			                    </h1>
			                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                                <table id='price_table' style='width:95%;'>
		                            <tr>
		                                <td class='price_td_t' style='width: 90px;'>앱 카테고리</td>
		                                <td class='price_txt'>
                                        
                                       
			                                <select name='mk_category' id='board_category'>
												<option value=''>앱 카테고리 설정</option>
                                                <? foreach($category as $item){
                                                   
                                                    if($data[0]->mk_category == $item->id){
                                                        $selcted ="selected";
                                                    }else{
                                                        $selcted ="";
                                                    }    
                                                ?>
                                                <option value='<?=$item->id;?>' <?=$selcted;?>><?=$item->cat_name;?> </option>    
                                                <?}?>
												
											 
											</select>
		                                </td>
		                            </tr>
                                   
		                            <tr>
		                                <td class='price_td_t'>앱 타이틀</td>
		                                <td class='price_txt'>
		                                    <input type='text' name='mk_title' tabindex='1' style='width:100%' value='<?=$data[0]->mk_title;?>'>
		                                </td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>앱 설명</td>
		                                <td class='price_txt'>
		                                    <textarea name='mk_content' tabindex='2' style='width:100%; height: 150px;'><?=$data[0]->mk_content;?> </textarea>
		                                </td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>Tags</td>
		                                <td class='price_txt'>
		                                    <input type='text' name='mk_tag' id="mk_tag" tabindex='3' style='width:100%' value='<?=$data[0]->mk_tag;?>'><br/>
                                         
		                                </td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>컨트롤</td>
		                                <td class='price_txt price_st'>
		                                    <input type='text' name='mk_cotroll' tabindex='4' style='width:100%' value='<?=$data[0]->mk_controll;?>'>
		                                </td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>url</td>
		                                <td class='price_txt price_st'>
		                                    <input type='text' name='mk_dir' tabindex='5' style='width:100%' value='<?=$data[0]->mk_dir;?>'>
		                                </td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>가격</td>
		                                <td class='price_txt price_st'>
		                                    <input type='text' name='mk_price' tabindex='6' style='width:100%' value='<?=$data[0]->mk_price;?>'>
		                                </td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>아이콘</td>
		                                <td class='price_txt price_st'>
		                                    <? if($data[0]->mk_icon){?>
			                                  <img src="/uploads/market_icon/<?=$data[0]->mk_icon;?>">
			                                <?}?>
			                                  <input type='file' name='mk_icon' tabindex='7' style='width:100%' value=' '>
		                                </td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>대체이미지</td>
		                                <td class='price_txt price_st'>
		                                     <? if($data[0]->mk_view){?>
			                                  	<img src="/uploads/market_view/<?=$data[0]->mk_view;?>" width="600">
			                                <?}?>
			                                	<input type='file' name='mk_view' tabindex='8' style='width:100%' value=' '>
		                                </td>
		                            </tr>
		                            <tr>
		                                <td class='price_td_t'>작성일</td>
		                                <td class='price_txt price_st'>
		                                    <?=$today;?><input type='hidden' name='date' class='btn btn-inverse' value='<?=$today;?>'>
		                                </td>
		                            </tr>
		                        </table>

                  				<hr style='margin-top:10px; margin-bottom: 10px;'/>
                                <center>
								<button id=sg_submit tabindex='9' type='submit' class='btn btn-success'><?=$button;?></button>
								&nbsp;&nbsp;&nbsp;
                                <a href='/admin/market'>목록</a>
                                </center>
							 </form>
					
						 <!-- copyright area 시작 -->
						<?$this->load->view('/include/bottom');?>
						<!-- copyright area 끝 -->
					 </div>
				</div>
				<!-- Contents Area finish -->
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
</body>
</html>