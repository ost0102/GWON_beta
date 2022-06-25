<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta content="width=device-width,minimum-scale=1,maximum-scale=1" name="viewport">
<meta name="title" content="<? echo $title; ?>" />
<meta name="description" content="<?echo $summary;?> ::: A menu website created with easymenu." />
<?php
    $l_special_characters_preg = "/[#\&\+\-%@=\/\\\:;,'\"\^`~\!\?\*$#<>()\[\]\{\}]/i";
    $l_meta_keywords = "easymenu";
    if ($title != '') $l_meta_keywords = $l_meta_keywords.",".str_replace(" ", ",", preg_replace($l_special_characters_preg, '', preg_replace('/\s+/', ' ', trim($title))));
    if ($con_title != '') $l_meta_keywords = $l_meta_keywords.",".str_replace(" ", ",", preg_replace($l_special_characters_preg, '', preg_replace('/\s+/', ' ', trim($con_title))));
?>
<meta name="keywords" content="<? echo $l_meta_keywords; ?>" />
<meta property="og:url" content="<? echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>" />
<meta property="og:title" content="<?echo $title;?> :: easymenu.kr" />
<meta property="og:description" content="<?echo $summary;?>" />
<meta property="og:image" content="<? echo 'http://'.$_SERVER['SERVER_NAME'].$project_img; ?>" />
<title><?echo $title;?> :: easymenu.kr</title>
<script type="text/javascript" src="/js/html5.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/selectivizr.js"></script>
<!--favicon-->
<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
<link rel="icon" href="/img/favicon.ico" type="image/x-icon" />
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<!--활성화페이지 공통 스타일-->
<link href="/css/style_activated.css" rel="stylesheet" type="text/css" />
<!--[if (gte IE 6)&(lte IE 8)]>
<script type="text/javascript" src="/js/selectivizr.js"></script>
<![endif]-->
<!--user code file-->
<!--[if lte IE 8]>
<link href="/<?echo $css;?>" type="text/css" rel="stylesheet"/>
<![endif]-->
<link href="/<?echo $css;?>" type="text/css" rel="stylesheet" media="screen and (min-width:800px)"/>
<link href="/<?echo $css_m;?>" type="text/css" rel="stylesheet" media="(max-width:799px)"/>

<!--modal창 관련 -->
<script type="text/javascript" src="/js/jquery.simplemodal.js"></script>
<script type="text/javascript">
	//jQuery 있는 상태
	window.onload=function(){
	};
	//스크롤 변화에 따라 상단위치 고정하기
	$(window).scroll(function(){ 
		var scr_now = $(document).scrollTop();
		//menu_left 존재유무에 따라 html type1, 2 인식 > type2일경우 실행동작과 type1일경우 실행동작을 구분하자.
		var check_menu_left = $("div").hasClass("menu_left");
		//현재 스크롤
		//alert(scr_now);
		scr_move_type1();
		scr_mobile_sns();
		//Scroll위치에 따른 DB에 콘텐츠 확인여부 기록
		var scr_h = $(document).scrollTop();
		var doc_h = $(document).height()/2;
		if(doc_h<scr_h){
			//콘텐츠 읽음 처리
			var p_num = '<?echo $p_num;?>';
			if(typeof(check_read) == 'undefined'){
				//변수가 없으면 설정하기
				check_read = '';
			}
			if(check_read !== 'read'){
				$.post("/openpage/check_read",{
					p_num: p_num
					},
				   function(data){
					 //alert(data);
					 check_read = data;
				});
			}
		}
		
	});
	$(document).ready(function() {
		check_teammate();
		check_team();
		get_rec();
		save_where_act();
		check_new_event();
		//본문 읽었는지 변수갑 초기값
		check_read = '';
		//project_information
		$("#post_txt_info").click(function(){
		  var w_num = $('#w_num').val();
		  var input_txt1 = $('#input_txt1').val();
		  var input_txt2 = $('#input_txt2').val();
		  var input_txt3 = $('#input_txt3').val();
		 
		   
		   $.post("/makepage/input_con_txt",{
			w_num: w_num,
			input_txt1: input_txt1,
			input_txt2: input_txt2,
			input_txt3: input_txt3
			},
		   function(data){
			 //alert(data);
			 //입력값 초기화하기
			 open_modal(data);
			 $('#val_url').val('');
			 $('#val_url_txt').val('');
			 if(data =="등록이 완료되었습니다."){
				//alert('페이지의 콘텐츠 입력단계로 이동합니다.');
				//location.replace('/makepage/add_con_txt/<?echo $w_num;?>');
			 }
		   }); 
		});
		$("#goto_other").click(function(){
			alert('추가 정보 입력페이지로 이동합니다.');
			location.replace('/makepage/add_other/<?echo $w_num;?>');
		});
		//modal 관련
		 $("#m_close").click(function(){
		  $.modal.close();
		  $modal_state ='off';
		 });
		 $modal_state ='off';
		 /*$("body").click(function(){
			check_modal();
		 });*/
		//주소가 있으면 onclick 함수가 있는지 확인하고, 없을 경우 추가하기
		$('.con_area_div a').each(function() {
			if(!$(this).attr("onclick")){
			    var addr = $(this).attr("href");
				$(this).attr("onclick","check_linked('"+addr+"')");
			}
	    });
	    //이미지 맵을 썼을 경우에도..
	    $('.con_area_div area ').each(function() {
			if(!$(this).attr("onclick")){
			    var addr = $(this).attr("href");
				$(this).attr("onclick","check_linked('"+addr+"')");
			}
	    });
	});
	//브라우저 사이즈가 변경될 경우 적용될 코드
	$(window).resize(function(){ 
		scr_mobile_sns();
	});
	//어디서 접근한건지, 10초 후 기록하기?
	setTimeout('save_where_act()',10000);
	//스크롤에 반응하도록..
	function scr_move_type1(){
		var scr_now = $(document).scrollTop();
		if(scr_now >150){
			$('#top_con').show();
			$('#menu_area').css('position','fixed');
			$('#menu_area').css('top','0px');
			$('#menu_area').css('width','100%');
			$('#menu_area').css('z-index','100');	
			//$('#top_logo').css('display','hidden');
			//s_div.style.visibility = "hidden";
		}else{
			$('#top_con').show();
			$('#menu_area').css('position','static');
		}
	}
	//스크롤에 따라 -모바일의 경우 하단에 고정영역으로 sns 공유 영역 출력되도록 설정
	function scr_mobile_sns(){
		var width_now = $('#container').width();
	    var scr_now = $(document).scrollTop();
	    var win_h = $(window).height();
	    //alert(width_now);
	    if(width_now<500){
	         //모바일일 경우
	        if(scr_now >win_h){
	            //현재 스크롤의 위치가 브라우저 크기보다 아래에 있을경우..(콘텐츠 노출영역으로 내려갔을경우)
	    		//$('#top_con').show();
	    		$('#sns_area').css('z-index','100');
	    		$('#sns_area').css('position','fixed');
	    		$('#sns_area').css('bottom','0px');
	    		$('#sns_area').css('left','0px');
	    		
	    		//$('#top_logo').css('display','hidden');
	    		//s_div.style.visibility = "hidden";
	    	}else{
	    		/*초기값 셋팅*/
		    	$('#sns_area').css('z-index','');
				$('#sns_area').css('position','');
				$('#sns_area').css('bottom','');
				$('#sns_area').css('left','');
	    	}
	    }else{
	    	/*데스크탑 환경 초기값 셋팅*/
	    	$('#sns_area').css('z-index','');
			$('#sns_area').css('position','');
			$('#sns_area').css('bottom','');
			$('#sns_area').css('left','');
	    }
	}
	
	//추천 정보 받기
	function get_rec(){
		//하단추천 정보 출력
		var p_num = '<?echo $p_num;?>';
		if ($("#page_rec").length == 0) {
			$.post('/openpage/page_recommend/'+p_num,{
				p_num: p_num
				},
			   function(data){
			   	 if(data !== ''){
			   	 	 $( "#bottom" ).after( data);
			   	 }
			});
		}
	}
	
	//컨텐츠 업데이트 여부 확인
	function check_popup(){
		var p_num = '<?echo $p_num;?>';
		//if(u_group==1){}
		//원본 정보 : /openpage/page_update_check/
		$.get("/openpage/popup_check/"+p_num,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$("#right_top_shape").after(data);
			$('#openpage_popup').slideDown();
			//alert(data);
	   });	
	}
	//위치 정보 저장하기
	function save_where_act(){
		var get_where_ip = '<? echo $get_where_ip; ?>';
		var get_where_p_num = '<? echo $get_where_p_num; ?>';
		//alert(get_where_ip);
		//alert(get_where_p_num);
		$.post("/openpage/get_where_visit",{
		get_where_ip: get_where_ip,
		get_where_p_num: get_where_p_num
		},
		function(data){
		 //alert(data);
		 //입력값 초기화하기
		 //open_modal(data);
		});
	}
	//오늘자 총방문자 중 지금 방문자가 몇번째 방문자인지 체크하기
	function check_new_event(){
		//alert(at_val);
		var p_num = '<?echo $p_num;?>';
		$.get("/mypage/check_new_event/"+p_num,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			//alert(data);
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
		var menu_h = $('#menu_area').height();
		var menu_show_state = $('#menu_area').css('display');
		//alert(menu_h);
		if(menu_show_state == 'none'){
			//메뉴가 숨겨진 상태라면..메뉴 높이를 빼지 않기
			var num_w = -30;
		}else{
			var num_w = menu_h;
		}
		if('<?echo $con_title;?>' != ''){
			var div1 = $('#con_con1').offset().top+num_w;
		}
		
		var div11 = $('#other_info').offset().top+num_w;
		if(val == 'menu1'){
			$('html, body').animate( {scrollTop:div1} );
		}else if(val == 'menu11'){
			$('html, body').animate( {scrollTop:div11} );
		}else{
			$('html, body').animate( {scrollTop:'0'} );
		}
	}
	function popup_code(){
		window.open("/makepage/edit_code/","Edit code",'width=500,height=430,left=0,top=0,scrollbars=no');
	}
	//팀원정보 리로드
	function check_teammate(){
		//alert(at_val);
		var w_num = '<?echo $p_num;?>';
		$.get("/team/check_teammate_act/"+w_num+"_open",function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#team_mate_state').html(data);
			$('#team_mate_state').css('size','12px');
			$('#team_mate_state').css('line-height','15px');
	   });
	}
	//팀정보 리로드
	function check_team(){
		var w_num = '<?echo $p_num;?>';
		$.get("/team/check_team/"+w_num,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#team_state').html(data);
	   });
	}
	//browser resize
	/*
	$(window).resize(function(){ 
		//접속환경에 따른 페이지 이동
		var mobileKeyWords = new Array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson');
		for (var word in mobileKeyWords){
			if (navigator.userAgent.match(mobileKeyWords[word]) != null){
				//document.location.href = '/upload/up1';
				//$('<meta name="viewport" content="width=320;"/>').appendTo('head');
				$('<meta name="viewport" content="width=divece-width, intial-scale=1.0,maximum-scale=1.0, user-scalable=0"/>').appendTo('head');
				break;
				//<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
			}
		}
	});
*/
</script>
<!--user code file-->
<script type="text/javascript" src="/<?echo $javascript;?>"></script>
<script type="text/javascript" src="/<?echo $javascript_m;?>"></script>
<!--웹 폰트 로드할 동안 텍스트 표시 안되는 현상 방지 시작-->
<script type="text/javascript" src="/js/webfont.js"></script>
<script>
 WebFont.load({
  custom: {
   families: ['Nanum Gothic'],
   urls: ['/css/font.css']
  }
 });
  WebFont.load({
  custom: {
   families: ['Nanum Myeongjo'],
   urls: ['/css/font.css']
  }
 });
</script>
<!--웹 폰트 로드할 동안 텍스트 표시 안되는 현상 방지 끝-->
<!--google분석기 시작-->
	<script type="text/javascript" >
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-45987664-1', 'intropage.net');
	  ga('send', 'pageview');
	</script>
<!-- google분석기 끝-->
</head>
<body>
<div id='bg_area' title='<? echo $project_img; ?>'>
</div>
<div id='container'>
	<div id='now_lng'>
		<a href='javascript:show_lng(1)'><img src='/img/icon/icon_lng.png'> 언어(한국어)</a>
		<div id='change_lng' style='display: none; padding: 10px;'>
			<a href='javascript:change_lng(1)'>한국어</a> | <a href='javascript:change_lng(2)'>English</a> | Монгол
			
			<script type="text/javascript">
				function show_lng(){
					$('#change_lng').toggle();
				}
				function change_lng(val){
					alert('언어값이 바껴라 얍! 브라우저를 통해 언어값을 가져올 수 있으면 그것으로 초기값을!');
				}
			</script>
		</div>
	</div>
	<!-- top Area Start -->
	<div id='top_area'>
		<div id='top_con'>
			<div id='top_left'>
				<div id='top_logo_area'>
				<?$now_url = $_SERVER['REQUEST_URI'];?>
				<?
				if($logo!='')echo '<a href="http://'.$this->config->item('intro_url').$now_url.'"><img src="'.$logo.'" id="logo_img"></a>';?>
				</div>
				<div id='top_recommend'>
					<?
					if(!isset($check_recommend)){
						$check_recommend=2;
					}
					if($check_recommend==1){
						$rec_img_url = '/img/icon/icon_recommend.png';
					}else{
						$rec_img_url = '/img/icon/icon_recommend_not.png';
					}
					?>
					<a onclick='recommend_page();' ><img id='rec_img' valign='middle' class='rec_img' src ='<?echo $rec_img_url;?>' class='img1'> 즐겨찾기</a>
				</div>
			</div>
			<div id='top_right'>
				<h1 id='re_title'><?echo $title;?></h1>
				<div id='top_re_property'>채식주의, 글루텐프리</div>
				<?echo $summary;?>
				<div id='top_more_info'>
					<a href='#' target='_self'>더보기</a>
				</div>
				<div id='top_working_time'>
					<h3>영업 시간</h3>
					(주중) 8:00 ~ 20:00<br/>
					(주말) 8:00 ~ 20:00<br/>
					(휴일) 월, 수, 금
				</div>
			</div>
		</div>
	</div>
	<div id='menu_area'>
		<div id='menu_txt'>
			<?if($con_title!='')echo '<a onclick="scr_bt(\'menu1\')">'.$con_title.'</a>&nbsp;';?>
			<a onclick="scr_bt('menu11')">추가정보</a>
		</div>
	</div>
	<!-- top Area finish -->
	<!-- Contents Area Start -->
	<?
		if(isset($now_page) && $now_page =='openpage'){
			//활성화된 오픈페이지에서 호출한 경우.
			$this->load->view('/include/con_area');
		}else if(isset($now_page) && $now_page =='re_info'){
			//식당 정보 확인 페이지에서 호출한 경우
			echo 're_info';
			$this->load->view('/menu/pb2/con_area_re_info');
		}else if(isset($now_page) && $now_page =='select_menu'){
			//메뉴 선택화면에서 호출한 경우
			$this->load->view('/menu/pb2/con_area_remenu_list');
		}else if(isset($now_page) && $now_page =='menu_order'){
			//메뉴 주문화면
			$this->load->view('/menu/pb2/con_area_remenu_order');
		}else if(isset($now_page) && $now_page =='enjoy_food'){
			//식문화 정보보기 페이지에서 호출한 경우
			$this->load->view('/menu/pb2/con_area_remenu_enjoy');
		}else if(isset($now_page) && $now_page =='help_board'){
			//고객 편의 페이지에서 호출한 경우 
			$this->load->view('/menu/pb2/con_area_hb_list');
			
		}
	?>
	<!-- Bottom-->
	<div id='bottom'>
		<div id='bt_txt'>
			<a href="http://<?=$this->config->item('intro_url');?>/">easymenu.kr</a> © &nbsp;2017<br/>
			<span style="font-size: 10px;">Updated : <? echo $edit_time; ?></span>
		</div>
	</div>
	<!-- Bottom 끝 -->
	<!-- Other Contents Area finish -->
</div>
<!--모달창 출력부분 시작-->
<div id="modal_content">
	 <div id="modal_txt">
		가상 팝업 내용 출력부분!
	</div>
	<div id='login_close'>
		<a onclick="modal_off();"><img src="/img/land/bt_close.png"></a>
	</div>
</div>
<!--모달창 출력부분 끝 -->
<script type="text/javascript">
	//10초후 팝업 체크하기
	setTimeout('check_popup()',1500);
</script>
<script type='text/javascript'>
	var agt = navigator.userAgent.toLowerCase();
	if (agt.indexOf("msie") != -1){
		//alert('익플');
		//'Internet Explorer'; 
		var trident = navigator.userAgent.match(/Trident\/(\d.\d)/i);
		//alert(trident);
		if(trident != null && trident[1] == "6.0"){
		//alert('IE10 입니다.');
		} else{
			alert('IE9 이하에서는 정확한 화면을 볼 수 없습니다. 구글 크롬을 설치한 후 이용해주세요.');
			popupOpen();
		}
	}else if (navigator.appName == 'Netscape' && navigator.userAgent.search('Trident') != -1) {
	  //alert('익플11');
	  //alert(agt);
	}
	function popupOpen(){
		var popUrl = "/page/goto_google_chrome/";	//팝업창에 출력될 페이지 URL
		var popOption = "width=500, height=400, resizable=no, scrollbars=no, status=no";    //팝업창 옵션(optoin)
		window.open(popUrl,"",popOption);
	} 
</script>
</body>
</html>