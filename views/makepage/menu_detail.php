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
		check_menu(w_num);

	};

	//jQuery 있는 상태
	$(document).ready(function() {

		
		$("#search_food").click(function(){
			var w_num = $('#w_num').val();
			var search_food_name = $('#search_food_name').val();
			//alert(w_num);
			//alert(search_food_name);

			/**/
			if(search_food_name==''){
				alert('메뉴명을 입력해주세요.');
			}else{
				$.post("/menu/search_menu",{
					w_num: w_num,
					search_food_name: search_food_name,
				},
				function(data){
					$("#menu_result").html(data);
					//open_modal(data);
					//fadeout_modal(); 
					//$('#val_url').val('');
					//$('#val_url_txt').val('');
				}); 
			}
				
		});



		$("#goto_cate").click(function(){
			var edit_code = '<? echo $edit_code; ?>';
			var page_secur = '<?echo $page_secur;?>';
			//alert(page_secur);
			if(edit_code==2){
				//코드 수정권한이 있을 때는 menu_cate페이지로..
				location.href='/makepage/menu_cate/'+page_secur;
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

	//특수 문자 처리
	 String.prototype.htmlChars = function() { 
        var str = ((this.replace('"', '&amp;')).replace('"', '&quot;')).replace('\'', '&#39;'); 
        return (str.replace('<', '&lt;')).replace('>', '&gt;'); 
 	} 

 	//현재 매칭된 메뉴 리스트 출력하기
 	function check_menu(w_num){
 		$.post("/menu/check_menu",{
				w_num: w_num
			},
			function(data){
				//alert(data);
				if(data==''){
					$("#now_menu").html('현재 등록된 메뉴가 없습니다.');
				}else{
					$("#now_menu").html(data);
				}
				
				//open_modal(data);
				//fadeout_modal(); 
				//$('#val_url').val('');
				//$('#val_url_txt').val('');
			});
 	}
 	
 	function add_con_txt_mouse_on(){
		$('#saved_txt').addClass('add_con_txt_alpha');
	}
	function add_con_txt_mouse_out(){
		$('#saved_txt').removeClass('add_con_txt_alpha');
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
	#con_main{
		margin-top: 10px;
		margin-bottom: 20px;
		padding-left: 10px;
		padding-right: 10px;
		background: #fff;
	}
	#input_form img{
		width: 50px;
		margin-right: 10px;
		margin-bottom: 10px;
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
	#top_area{
		width: 800px;
		padding-bottom: 20px;
	}
	#top_con{
		padding-bottom: 20px;
		margin-bottom: 20px;
	}
	#top_area, #con_area{
		width: 800px;
	}
	#con_area_con{
		width: 800px;
		background: #fff;
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
				메뉴 추가<br/>
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
				<div id='input_form' style='margin-top: 15px;'>
					<!--form 값 입력 -->
					<table width="100%">
						<tr>
							<td width="120px;">
								음식명 검색
							</td>
							<td>
								<input id="search_food_name" name="search_food_name" class="focus_area" type="text" style="width: 100%;"/>
							</td>
							<td width="90px;">
								<button id="search_food" class="btn btn-primary">
									검색
								</button>
							</td>
						</tr>
					</table>
					&nbsp;&nbsp;
					<input id="w_num" name="w_num" class="focus_area" type="hidden" value="<?echo $w_num;?>"/>
					<div id='menu_result' style='width: 100%;'>
					</div>
					<h3>현재 메뉴</h3>
					<div id='now_menu' style='width: 100%;'>
						
					</div>
					<hr style="width: 100%; margin-top:10px;"/>
					<div id='bt_area'>
						<button id="goto_cate" class="btn btn-success"><img src='/img/icon/icon_next_w.png' style='width:16px; margin-right: 5px;' valign='middle'><?if($edit_code==2){echo '항목 설정하기';}else{echo '사이트 활성화하기';}?></button>
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