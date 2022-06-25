<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta content="width=device-width,minimum-scale=1,maximum-scale=1" name="viewport" />

<?$this->load->view('/include/head_info');?>

<script type="text/javascript" src="/select_design_sample/sp_js.js"></script>
<script type="text/javascript">
	//jQuery 있는 상태
	window.onload=function(){

	};
	$(document).ready(function() {
		//주소에 따른 화면 구성 변환하기
		url=location.href;
		var first_pop = '<?if(isset($first_pop)){ echo $first_pop;}?>';
		var now_con = '<?if(isset($now_con)){ echo $now_con;}?>';
		
		if(now_con !==''){
			show_popup_con(now_con);
		}else if(first_pop !==''){
			show_popup_con(first_pop);
		}
		

		$modal_state ='on';
		/*window.open("/makepage/select_html/","select_design",'width=500,height=350,left=0,top=0,scrollbars=no');
		*/

		//project_information
		$("#save_popup").click(function(){
		  var popup_con_txt = $('#popup_con_txt').html();
		  var datepicker1 = $('#datepicker1').val();
		  var datepicker2 = $('#datepicker2').val();
		  var page_secur = $('#page_secur').val();
		  
		  if(!page_secur){
		  	alert('페이지 인식코드가 없습니다. 다시 창을 열어주세요.');
		  }else if(!popup_con_txt){
		  	alert('콘텐츠를 입력해주세요.');
		  }else if(!datepicker1){
		  	alert('팝업 시작일을 입력해주세요.');
		  }else if(!datepicker2){
		  	alert('팝업 종료일 입력해주세요.');
		  }else{
		  	//팝업 종료일이 팝업 시작일보다 앞인지 체크
		  	if(datepicker2<datepicker1){
		  		alert('종료날짜가 시작일보다 작습니다.');
		  	}else{
		  		//alert('종료날짜가 커요. 가능해요');
		  		$.post("/openpage/input_popup_txt",{
				page_secur: page_secur,
				popup_con_txt: popup_con_txt,
				datepicker1: datepicker1,
				datepicker2: datepicker2
				},
			   function(data){
				 //alert(data);
				 //입력값 초기화하기
				 open_modal(data);
				 //$('#popup_con_txt').html('');
				 //$('#popup_txt').html('');
				 if(data =="등록이 완료되었습니다."){
					//alert('페이지의 콘텐츠 입력단계로 이동합니다.');
				 }
			   });
		  	}
		  }
		});
		
		$("#make_popup").click(function(){
			location.href= '/openpage/popup_write/'+'<?if(isset($page_secur)){echo $page_secur;}?>';
			
		});



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

	function show_popup_con(pop_id){
		//alert(pop_id);
		$.post("/openpage/popup_con_read",{
		pop_id: pop_id
		},
	   function(data){
	   		if(data==''){
	   			$('#popup_txt').html('펼침 메뉴를 통해 팝업 공지 내용을 확인할 수 있습니다.');
	   		}else{
				$('#popup_txt').html(data);	   			
	   		}
	   });
	}
</script>
</head>
<body>
<!-- make step bar area include -->
<div id='right_top_shape'>
	<a href="http://<?=$this->config->item('intro_url');?>/page"><img src="/img/right_top_shape_w.png" class='logo_shape' alt='logo shape' /></a>
</div>
<div id='container'>
	<!-- popup Area Start -->
	<div id='popup_area'>
		<h3><?echo $title;?> 페이지 - 팝업관리</h3>
		<? if(isset($p_num)){?>
		<? if(isset($popup_list)){
			//print_r($popup_list);
			echo '<select name="category" id="board_category" style="min-width: 250px; width: 40%;" onchange="show_popup_con(value);">';
			echo '<option>현재 등록된 총 팝업 수는 '.$total_popup_count.'개 입니다.</option>';
			foreach ($popup_list as $popup_list)
			{
				//print_r($row);
				//class_no가 없을 경우 최근 값을 가져와라
				$pop_id = $popup_list['pop_id'];
				$p_num = $popup_list['p_num'];
				$pop_con = $popup_list['pop_con'];
				$noti_check = $popup_list['noti_check'];
				$s_date = $popup_list['s_date'];
				$f_date = $popup_list['f_date'];
				$date = $popup_list['date'];

				echo '<option value="'.$pop_id.'">'.$s_date.'~'.$f_date.' ['.$date.']</option>';
			}
			echo '</select>';
		}
		?>
		<div id='popup_read'>
			<?
			if(isset($popup_act)){
				echo "<img src='/img/popup_img.png' style='width: 25px; margin-bottom: 5px;'/>";
				echo '<h5>현재 팝업기능을 사용중입니다.&nbsp;&nbsp; [<a href="/openpage/popup_done/'.$page_secur.'" target="_blank">종료</a>]</h5>';
			}
			?>
			<input  type="hidden" id="page_secur" style="width: 200px; margin-top:10px;" value='<? if(isset($page_secur)){ echo $page_secur; }?>'/>
			<div id='popup_txt'>
				<?
				if(isset($no_popup_list)){
					echo '등록된 팝업 내용이 없습니다.';
				}else{
					echo '펼침 메뉴를 통해 팝업 공지 내용을 확인할 수 있습니다.';
				}
				?>
			</div>
			
			<div id='popup_bt_area'>
				<hr style='margin-bottom: 10px;'/>
				<b title='한달 최대 사용량은 3개입니다.'>이달의 팝업 사용량 <?echo $month_count;?> / 3</b>
				<?if($month_count<3){?>
				<button id="make_popup" class="btn btn-info" style='float: right;'><img src='/img/icon/icon_write_w.png' style='width:16px; margin-right: 5px;' valign='middle'>팝업 만들기</button>
				<?}?>
			</div>
			<?}else{
				echo '잘못된 접근입니다.';
			}?>
		</div>
	</div>
	<!-- popup Area finish -->
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