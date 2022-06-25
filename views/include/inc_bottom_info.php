<script type='text/javascript'>

//창 크기 변화에 따른 창 크기 변화
$( document ).ready( function() {
	con_resize();
	$( window ).resize( function() {
		// do somthing
		con_resize();
	});
});

function con_resize(){
	var now_h = $(window).height()-280;
	//alert(now_h);
	$('#con').css('min-height',now_h);
	$('#workspace').css('min-height',now_h);
}
//약관
function show_terms(){
	window.open('/docs/provisionPopup','','width=400, height=350');
}
//개인정보 수집정책
function show_terms2(){
	window.open('/docs/user_rull_Popup','','width=400, height=350');
}
</script>
<div id='bottom_area'>
	<div id='bottom_con'>
		<h3>Contact US</h3>
		(03371) 서울특별시 은평구 통일로 684 (녹번동, 서울혁신파크) 미래청 402호<br/>
		전화: +82-70-8692-0392<br/>
		Email: help@treeple.net<br/>

		<br/><br/>
		©  2021 Gwon.net&nbsp;
		<a href="javascript:show_terms();" style="color: #fff;">서비스 이용약관</a>&nbsp;
		<a href="javascript:show_terms2();" style="color: #fff;">개인정보 수집 및 이용</a>
	</div>
</div>

<!--모달창 출력부분 시작-->
<div id='modal_content'>
	 <div id='modal_txt'>
		가상 팝업 내용 출력부분!
	</div>
	<div id='login_close'>
		<a href='javascript:modal_off();'><img src='/img/basic/bt_close.png' alt='close button' /></a>
	</div>
</div>
<!--모달창 출력부분 끝 -->
<!--modal창 관련 -->
<script type='text/javascript' src='/js/jquery.simplemodal.js'></script>
<!--modal창 관련 ****꼭 하단에. 상단에 넣으면 작동 안될 가능성 존재함-->