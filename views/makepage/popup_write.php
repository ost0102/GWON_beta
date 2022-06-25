<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta content="width=device-width,minimum-scale=1,maximum-scale=1" name="viewport" />

<?$this->load->view('/include/head_info');?>

<script type="text/javascript" src="/select_design_sample/sp_js.js"></script>
<!--data picker 관련 시작 -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script type="text/javascript">
	//data picker
	$(function() {
		$.datepicker.setDefaults( $.datepicker.regional[ "ko" ] );
        $( "#datepicker1" ).datepicker({dateFormat:"yy-mm-dd"});
        $( "#datepicker2" ).datepicker({dateFormat:"yy-mm-dd"});
    }); 
	//jQuery 있는 상태
	window.onload=function(){

	};
	$(document).ready(function() {
		//주소에 따른 화면 구성 변환하기
		url=location.href;

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
				 $('#popup_con_txt').html('');
				 $('#popup_txt').html('');
				 location.href='/openpage/popup_noti/'+'<?if(isset($page_secur)){echo $page_secur;}?>';
			   });
		  	}
		  }
		});
		
		//cancle
		 $("#cancle_popup").click(function(){
			$('#cancle_popup').hide();
			$('#save_popup').show();
			$('#popup_txt').show();
			//다른 영역에서 위지윅 열려있는지 확인하기
			//$('#popup_con').show();
			//$('#wsw_iframe').remove();
			$('#popup_wsw').hide();
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
	
	
	function write_popup(){
		//위지윅 호출시는 이걸로..기존 등록된 내용이 보이거나, 새로 등록할때 출력되게..
		//참고하기 http://blog.naver.com/jjjhyeok?Redirect=Log&logNo=20153223723
		//하단 버튼 감춰라 - 연관 된 코드 /include/wysiwyg_bootstrap.php save_txt 함수내 (178줄)
		$('#cancle_popup').show();
		$('#save_popup').hide();
		$('#popup_txt').hide();
		//다른 영역에서 위지윅 열려있는지 확인하기
		//$('#popup_con').show();
		//$('#wsw_iframe').remove();
		$('#popup_wsw').show();

		var win_height = $(window).height();
		var new_div = $('#popup_wsw').html("<iframe id='wsw_iframe' src='/makepage/load_wysiwyg' width='90%' height='"+win_height+"' scrolling='no' frameborder='0' style='margin-bottom: 15px;'  class=saved_txt></iframe>");
	}
	//popup 내용 저장
	function save_popup(con_txt){
		//실제 콘텐츠 수정 후 DB에 저장하기
		var input_txt = $('#input_txt'+con_txt).html();
		var w_num = $('#w_num').val();
		
		$('#popup_txt').show();
		$('#wsw_iframe').remove();

	   /*$.post("/openpage/input_popup_txt",{
		w_num: w_num,
		where_con: where_con,
		input_txt: input_txt
		},
	   function(data){
		 //alert(data);
		 //입력값 초기화하기
		 open_modal(data);
		 fadeout_modal();
		 $('#val_url').val('');
		 $('#val_url_txt').val('');
		 if(data =="등록이 완료되었습니다."){
			//alert('페이지의 콘텐츠 입력단계로 이동합니다.');
		 }
	   }); 
*/
	   //하단 버튼 출력해라 - 연관 된 코드 easymenu.js write_con()내 (365즐)
	   $('#cancle_popup').hide();
	   $('#save_popup').show();
	}

</script>
<style>
#cancle_popup{
	display: none;
}
</style>
</head>
<body>
<!-- make step bar area include -->
<div id='right_top_shape'>
	<a href="http://<?=$this->config->item('intro_url');?>/page"><img src="/img/right_top_shape_w.png" class='logo_shape' alt='logo shape' /></a>
</div>
<div id='container'>
	<!-- popup Area Start -->
	<div id='popup_area'>
		<h1>팝업 등록하기</h1>
		<div id='popup_con'>
			<input  type="hidden" id="page_secur" style="width: 200px; margin-top:10px;" value='<? if(isset($page_secur)){ echo $page_secur; }?>'/>
			<div id='popup_date'>
				시작일 : <input  type="text" id="datepicker1" style="width: 200px; margin-top:10px;"/>&nbsp;&nbsp;
				종료일 : <input  type="text" id="datepicker2" style="width: 200px; margin-top:10px;"/><br/>
			</div>
			<div id='popup_txt' onclick='write_popup();'>
				<?if(isset($con_val)){
					echo $con_val;
				}else{?>
					이 영역을 클릭하시면, 작성창이 열립니다.<br/>내용을 입력해주세요.
				<?}?>
			</div>
			<div id='popup_con_txt' style="display: none;"><?if(isset($con_val))echo $con_val;?></div>
			<div id="popup_wsw" style="display: none;"></div>
			<span style='font-size: 10px;'>* 업로드 이미지는 너비 250px 이하로 올려주셔야 잘보입니다.</span>
			
			<div id='popup_bt_area'>
				<button id="save_popup" class="btn btn-info" style='float: right;'><img src='/img/icon/icon_save_w.png' style='width:16px; margin-right: 5px;' valign='middle'>저장</button>
				<button id="cancle_popup" class="btn btn-info" style='float: right; margin-right: 10px;'>취소</button>
			</div>
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