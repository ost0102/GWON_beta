<script type="text/javascript">
	//jQuery 있는 상태
	window.onload=function(){
        check_con_div();
		check_w_mode();

		
	};

	$(document).ready(function() {
		//현재 페이지 인지 변수 강제로 붙이기(php용)
		$('#make_step_app').show();
		//input변수가 있을 경우, 해당 input box의 style 변경하기
		for(i=1; i<11; i++){
			//div_name = "div_name_"+i;
			//alert(div_name);
			if($('#input_txt'+i).html()){
				$('#input_txt'+i).addClass('focus_area');
				$('#input_txt'+i).removeClass('title');
				$('#input_txt'+i).removeClass('alpha50');
			}
		}
		

		//project_information
		$("#post_txt_info").click(function(){
		  var w_num = $('#w_num').val();
		  for(i=1;i<11;i++){
		  	var now_input = $('#input_txt'+i).html();
		  	if(!now_input){
		  		window["input_txt"+i] = 'test';
		  		var last_div = i-1;
		  		//alert("input_txt"+i);
		  		//div가 없다면, 임시로 생성해서 변수가 undefind 상태로 오류나지 않도록..
		  		$("#input_txt"+last_div).after('<div id="input_txt'+i+'" style="display:none;"></div>');
		  	}
		  }
		  var input_txt1 = $('#input_txt1').html();
		  var input_txt2 = $('#input_txt2').html();
		  var input_txt3 = $('#input_txt3').html();
		  var input_txt4 = $('#input_txt4').html();
		  var input_txt5 = $('#input_txt5').html();
		  var input_txt6 = $('#input_txt6').html();
		  var input_txt7 = $('#input_txt7').html();
		  var input_txt8 = $('#input_txt8').html();
		  var input_txt9 = $('#input_txt9').html();
		  var input_txt10 = $('#input_txt10').html();
		 
		   $.post("/makepage/input_con_txt",{
			w_num: w_num,
			input_txt1: input_txt1,
			input_txt2: input_txt2,
			input_txt3: input_txt3,
			input_txt4: input_txt4,
			input_txt5: input_txt5,
			input_txt6: input_txt6,
			input_txt7: input_txt7,
			input_txt8: input_txt8,
			input_txt9: input_txt9,
			input_txt10: input_txt10
			},
		   function(data){
			// alert(data);
			 //입력값 초기화하기
			 open_modal(data);
			 fadeout_modal();
			 $('#val_url').val('');
			 $('#val_url_txt').val('');
			 if(data =="등록이 완료되었습니다."){
				//alert('페이지의 콘텐츠 입력단계로 이동합니다.');
				//location.replace('/makepage/add_con_txt/<?echo $w_num;?>');
			 }
		   }); 
		});

		$("#goto_other").click(function(){
			var w_num = $('#w_num').val();
			for(i=1;i<11;i++){
			  	var now_input = $('#input_txt'+i).html();
			  	if(!now_input){
			  		window["input_txt"+i] = 'test';
			  		var last_div = i-1;
			  		//alert("input_txt"+i);
			  		//div가 없다면, 임시로 생성해서 변수가 undefind 상태로 오류나지 않도록..
			  		$("#input_txt"+last_div).after('<div id="input_txt'+i+'" style="display:none;"></div>');
			  	}
			}
			var input_txt1 = $('#input_txt1').html();
			var input_txt2 = $('#input_txt2').html();
			var input_txt3 = $('#input_txt3').html();
			var input_txt4 = $('#input_txt4').html();
			var input_txt5 = $('#input_txt5').html();
			var input_txt6 = $('#input_txt6').html();
			var input_txt7 = $('#input_txt7').html();
			var input_txt8 = $('#input_txt8').html();
			var input_txt9 = $('#input_txt9').html();
			var input_txt10 = $('#input_txt10').html();
			var edit_code = '<? echo $edit_code; ?>';

			 //기존 버튼 안보이도록 처리
			$('#goto_other').hide();
			//신규(클릭시 비동작 버튼) 버튼 출력 - 중복 클릭 방지
			$('#goto_other').after('<button class="btn btn-success"><img src="/img/icon/icon_next_w.png" style="width:16px; margin-right: 5px;" valign="middle">저장중입니다</button>');
			//입력데이터 저장하기
			$.post("/makepage/input_con_txt",{
			w_num: w_num,
			input_txt1: input_txt1,
			input_txt2: input_txt2,
			input_txt3: input_txt3,
			input_txt4: input_txt4,
			input_txt5: input_txt5,
			input_txt6: input_txt6,
			input_txt7: input_txt7,
			input_txt8: input_txt8,
			input_txt9: input_txt9,
			input_txt10: input_txt10
			},
			function(data){
				//open_modal('저장되었으며, 디자인 선택 페이지로 이동합니다.');
				//fadeout_modal();
				var page_secur = '<?echo $page_secur;?>';
				//alert(page_secur);
				if(edit_code==2){
					//코드 수정권한이 있을 때는 select_design페이지로..
					location.href='/makepage/select_design/'+page_secur;
				}else{
					//아닐때는.. 활성화 페이지로
					location.href='/makepage/add_other/'+page_secur;
				}
				
			 }
			); 
		});

		$("#edit_con_title").click(function(){
			var p_num='<? echo $w_num;?>';
			$.get("/makepage/write_summary/"+p_num,function(data,status){
				//alert("Data: " + data + "\nStatus: " + status);
				//open_modal(data);
				$('html, body').animate( {scrollTop:0} );
				$('#con_area').hide();
				$('#con_area').html(data);
				$('#con_area').fadeIn('slow');
				
				//주소줄 바꾸기
				u_filter_origing = url.split('#!');
				basic_url = u_filter_origing[0];
				location.href = basic_url+'#!2';

				//$('#login_close').show();
			});
		});


		//modal 관련
		 $("#m_close").click(function(){
		  $.modal.close();
		  $modal_state ='off';
		 });
		 $modal_state ='off';
		 $("body").click(function(){
			check_modal();
		 });

		  //초기 공지 팝업
		 var check_state = '<?echo $write_con;?>';
		 if(check_state =='0000-00-00'){
			open_modal();
			//$('#modal_content').css('height','250px');
			//$('#modal_txt').css('height','130px');
			//$('#login_close').show();
			$('#modal_txt').html('이 단계에서는 <br/>개요 항목별 본문을<br/>입력합니다.');
			//$("#login_close").html('<a onClick="modal_off()">지금 입력하기</a>');
		 }
	});
	
	function add_con_txt_mouse_on(now_div){
		$('#saved_txt'+now_div).addClass('add_con_txt_alpha');
	}
	function add_con_txt_mouse_out(now_div){
		$('#saved_txt'+now_div).removeClass('add_con_txt_alpha');
	}

	function popup_appmarket(){
		window.open('/market','market','width=800,height=600,left=0,top=0,scrollbars=no');
	}
    
    
	function popup_appconfig(app_controll,id){
		window.open(app_controll+'/config?id='+id,'market','width=800,height=600,left=0,top=0,scrollbars=yes');
	}
</script>
<style>
	.add_con_txt_alpha{
		filter:alpha(opacity=70); opacity:0.7; -moz-opacity:0.7;
	}
	#con_main{
		max-width: 880px;
	}
	@media (max-width:799px) {
		#con_main{
			max-width: 280px;
		}
		#goto_other{
			margin-top: 10px;
		}
	}
	
</style>
<div id='con_main'>
	<h3 style='text-align:center;'>
		이야기 본문을 입력해주세요.
	</h3>
	<div style='text-align:center; font-size: 10px; color: #cdcdcd;'>입력을 원하는 영역을 클릭하시면, 위지윅 편집기가 열립니다.</div>
	<input id="w_num" name="w_num" class="focus_area" type="hidden" value="<?echo $w_num;?>"/>
     
   
	<!--form 값 입력 -->
	<?

     for($i=1; $i<=10; $i++){
     
		if($i==1){
			$div_name = $div1_name;
			$div_con = $div1_con;
            
          
 
            
		}elseif($i==2){
            
          
			$div_name = $div2_name;
			$div_con = $div2_con;
		}elseif($i==3){
		    
			$div_name = $div3_name;
			$div_con = $div3_con;
		}elseif($i==4){
		  
			$div_name = $div4_name;
			$div_con = $div4_con;
		}elseif($i==5){
			$div_name = $div5_name;
			$div_con = $div5_con;
		}elseif($i==6){
			$div_name = $div6_name;
			$div_con = $div6_con;
		}elseif($i==7){
			$div_name = $div7_name;
			$div_con = $div7_con;
		}elseif($i==8){
			$div_name = $div8_name;
			$div_con = $div8_con;
		}elseif($i==9){
			$div_name = $div9_name;
			$div_con = $div9_con;
		}elseif($i==10){
			$div_name = $div10_name;
			$div_con = $div10_con;
		}
           
            $key = array_search($i-1, array_column($module, 'module_sort'));
             
            if($key>-1){
            $view_module =  $market[$key];
          
             
            ?>
             <img src='/uploads/market_view/<?=$view_module->mk_view;?>'>
             
             <?}
            
		if($div_name!=''){?> 
         
			<h3 class="font_serif"><img src='/img/circle_num<?echo $i;?>.png' style='width:30px; margin-right: 10px; margin-top:10px; margin-bottom: 10px;'><?echo $div_name;?></h3>
			<div id="saved_txt<?echo $i;?>" onMouseover='add_con_txt_mouse_on("<?echo $i;?>");' onmouseout='add_con_txt_mouse_out("<?echo $i;?>");' onclick='write_con("<?echo $i;?>");' title="내용을 입력하시길 원하시면, 클릭하세요" class='saved_txt'>
				<?if($div_con&&$div_con !='null'){?>
				<!--내용이 있다면 출력해라 -->
					<?echo $div_con;?>
				<?}else{?>
				이 영역을 클릭하시면, 작성창이 열립니다.<br/>내용을 입력해주세요.
				<?}?>
			</div>
			<div id="input_txt<?echo $i;?>" style="display: none;"><?echo $div_con;?></div>
		<?}?>
	<?}?>
	<hr style="width: 100%; margin-top:10px;"/>
	<div id='bt_area'>
		<button id="edit_con_title" class="btn btn-success"><img src='/img/icon/icon_prev_w.png' style='width:16px; margin-right: 5px;' valign='middle'>본문 구성하기</button>
		<button id="post_txt_info" class="btn btn-info"><img src='/img/icon/icon_save_w.png' style='width:16px; margin-right: 5px;' valign='middle'>일시 저장</button>
		<button id="goto_other" class="btn btn-success"><img src='/img/icon/icon_next_w.png' style='width:16px; margin-right: 5px;' valign='middle'><?if($edit_code==2){echo '디자인 반영하기';}else{echo '사이트 활성화하기';}?></button>
	</div>
</div>