<?
	$p_num = $this->session->userdata('p_num');
?>
<style>
	#modal_content{
		display:none;
		margin:50 auto;
		width:280px;
		height:310px;
		/*background:#fff;*/
		background:#ffffff url(/img/land/bg_modal.jpg) no-repeat right top;
	}
	#modal_txt{
		float:left;
		font-size: 15px;
		font-weight: bold;
		width: 100%;
		margin-top: 30px;
		margin-bottom: 30px;
		height: 200px;
		text-align: center;

	}
	.cate_div{
		float: left; 
		margin-right: 10px; 
		margin-bottom: 5px; 
		padding: 5px; 
		background-color: #cdcdcd; 
		cursor: pointer;
	}
	#login_close{
		clear: both;
		height: 30px;
		margin-top: 10px;
		margin-bottom: 10px;
		width: 100%;
		text-align: center;
	}
	#con_html{
		float:left; 
		width: 90%;
		padding-left: 5%;
		padding-right: 5%;
		text-align:center;
	}
</style>
<script>
	//Category 선택 시 관련해서 액션일어나도록..
	function select_html_type(type){
		var type = type;
		var p_num = '<?if (isset($p_num)){echo $p_num;}?>';
		//alert(p_num);
		
		$.post("/makepage/selected_html_type",{
			type: type,
			p_num: p_num
		},
		function(data){
		//alert(data);
		//입력값 초기화하기
		open_modal(data);
		if(data ==1){
			//alert("화면구성 선택이 완료되었습니다. 원하시는 디자인 템플릿을 선택하세요.");
			fade_body_text('화면구성 선택이 완료되었습니다. 원하시는 디자인 템플릿을 선택하세요.');
			check_modal();
			//location.reload();
			/*
			$('#modal_txt').html('화면구성 선택이 완료되었습니다.');
			$('#login_close').show();
			*/

			$.get('/makepage/popup_template/'+p_num,function(data,status){
				//alert("Data: " + data + "\nStatus: " + status);
				//open_modal(data);
				open_modal();
				$('#modal_txt').html(data);
				//$('#login_close').hide();
		    });
			/* template 설정 창 띄우기 (팝업으로)
			var open_win = window.open("/makepage/popup_template/"+p_num,"Select template",'width=800,height=600,left=0,top=0,scrollbars=no');
			if (open_win == null || typeof(open_win)=='undefined'){
	    		alert("Turn off your pop-up blocker!");
	    	}*/
		 }else{
			alert("변경 권한이 없습니다.관리자의 경우 다시 로그인해주세요.");
			$.get("/makepage/select_html/",function(data,status){
				//alert("Data: " + data + "\nStatus: " + status);
				//open_modal(data);
				open_modal();
				$('#modal_txt').html(data);
				$('#login_close').hide();
		   });
		 }
		}); 
	}
	function fade_text(a_target, a_text, a_color, a_fadeTime) {
	    a_fadeTime = typeof a_fadeTime !== 'undefined' ?  a_fadeTime : 1500;
	    a_target.prepend("<div class='fade_text' style='width:100%; text-align: center;'></div>");
	    var o_fade_text = $('.fade_text');
	    o_fade_text.html(a_text);
	    o_fade_text.css('background', a_color);
	    o_fade_text.fadeOut(a_fadeTime);
	}

	function fade_body_text(a_text, a_color) {
	    a_color = typeof a_color !== 'undefined' ?  a_color : 'yellow';
	    fade_text($('body'), a_text, a_color);
	}

</script>
<!-- make step bar area include -->
<div id="con_html">
	<?
		if($html_type !=0){
			echo '<span class=t_title style="font-size: 11px;">현재 설정된 html_type이 있습니다.<br/>변경을 원하시면 유형을 선택하세요.</span><hr/>';
		}
	?>

	<h3 style='font-size: 15px;'>원하시는 화면 구성을 선택해주세요.</h3>
	<div id="html_type_1" class="cate_div" onclick="select_html_type('1')">
		<img src="/img/html_type_1.jpg" width='80px;' title='Scroll Design'>
	</div>
	<div id="html_type_2" class="cate_div" onclick="select_html_type('2')">
		<img src="/img/html_type_2.jpg" width='80px;' title='left toggle menu'>
	</div>
</div>