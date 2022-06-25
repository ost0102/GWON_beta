<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta content="width=device-width,minimum-scale=1,maximum-scale=1" name="viewport">
<meta name="title" content="<? echo $title; ?>" />
<meta name="description" content="<?echo $summary;?> ::: A form created with gwon.net" />
<?php
	$now_url = $_SERVER['REQUEST_URI'];
	$l_special_characters_preg = "/[#\&\+\-%@=\/\\\:;,'\"\^`~\!\?\*$#<>()\[\]\{\}]/i";
	$l_meta_keywords = "gwon";
	if ($title != '') $l_meta_keywords = $l_meta_keywords.",".str_replace(" ", ",", preg_replace($l_special_characters_preg, '', preg_replace('/\s+/', ' ', trim($title))));
?>
<meta name="keywords" content="<? echo $l_meta_keywords; ?>" />
<link rel="canonical" href="<? echo '//'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>" />
<meta property="og:url" content="<? echo '//'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>" />
<meta property="og:title" content="<?echo $title;?>" />
<meta property="og:description" content="<?echo $summary;?> ::: A form created with gwon.net" />
<meta property="og:image" content="<? echo 'https://'.$_SERVER['SERVER_NAME'].$project_img; ?>" />
<title><?echo $title;?></title>
<script type="text/javascript" src="/js/html5.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/selectivizr.js<?echo '?ver='.date("Ymd_H_i_s");?>"></script>
<script type='text/javascript' src='/js/view_common.js<?echo '?ver='.date("Ymd_H_i_s");?>'></script>
<!--favicon-->
<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
<link rel="icon" href="/img/favicon.ico" type="image/x-icon" />
<link href='/css/bootstrap.min.css' rel='stylesheet' />
<link href="/css/style.css<?echo '?ver='.date("Ymd_H_i_s");?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/css/font.css" type="text/css"/>
<!--활성화페이지 공통 스타일-->
<link href="/css/style_activated.css<?echo '?ver='.date("Ymd_H_i_s");?>" rel="stylesheet" type="text/css" />
<!--[if (gte IE 6)&(lte IE 8)]>
<script type="text/javascript" src="/js/selectivizr.js"></script>
<![endif]-->
<!--user code file-->
<!--[if lte IE 8]>
<link href="/<?echo $css;?>" type="text/css" rel="stylesheet"/>
<![endif]-->
<link href="/<?echo $css.'?ver='.date("Ymd_H_i_s");?>" type="text/css" rel="stylesheet" media="screen and (min-width:800px)"/>
<link href="/<?echo $css_m.'?ver='.date("Ymd_H_i_s");?>" type="text/css" rel="stylesheet" media="(max-width:799px)"/>

<!-- dataPicker 모음 ! -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script src="//code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script type='text/javascript' src='/assets/js/jquery.ui.sortable.js'></script>

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
		
		var logo_img_h = $("#logo_img").height();
		if(logo_img_h >500){
			$('#top_con').show();
			$('#menu_area').attr('id','menu_area_scr');
			$('#menu_area_scr').css('position','fixed');
			$('#menu_area_scr').css('bottom','0px');
			$('#menu_area_scr').css('border-top','1px solid #cdcdcd');
			$('#menu_area_scr').css('width','100%');
			$('#menu_area_scr').css('z-index','100');
			//$('#top_logo').css('display','hidden');
			//s_div.style.visibility = "hidden";
		}else{
			$('#top_con').show();
			$('#menu_area_scr').attr('id','menu_area');
			$('#menu_area').removeAttr('style');
			//$('#menu_area').css('position','static');
		}

		check_teammate();
		check_team();
		save_where_act();
		//check_new_event();
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




		//modal 관련
		 $("#m_close").click(function(){
		  $.modal.close();
		  modal_state ='off';
		 });
		 modal_state ='off';

		 /*$("body").click(function(){
			check_modal();
		 });*/

		//주소가 있으면 onclick 함수가 있는지 확인하고, 없을 경우 추가하기
		$('.con_area_div a').each(function() {
			if(!$(this).attr("onclick")){
				var addr = $(this).attr("href");
				var check_addr = 'javascript';
				//alert(addr+":::::"+check_addr);
				if (addr.indexOf(check_addr) != -1) {
					//alert("Find!");
				}else {
					//alert("Not Found!!"); 
					//링크에 자바스크립트로 호출한 게 없다면..
					$(this).attr("onclick","check_linked('"+addr+"')");
				}
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
		var logo_img_h = $("#logo_img").height();
		
		if(scr_now <150 && logo_img_h <=500){
			$('#top_con').show();
			$('#menu_area_scr').attr('id','menu_area');
			$('#menu_area').removeAttr('style');
		}else if(scr_now<150 && logo_img_h >500){
			$('#top_con').show();
			$('#menu_area').attr('id','menu_area_scr');
			$('#menu_area_scr').css('position','fixed');
			$('#menu_area_scr').css('bottom','0px');
			$('#menu_area_scr').css('border-top','1px solid #cdcdcd');
			$('#menu_area_scr').css('width','100%');
			$('#menu_area_scr').css('z-index','100');
			$('#menu_area_scr').css('top','');
		}else{
			$('#top_con').show();
			$('#menu_area').attr('id','menu_area_scr');
			$('#menu_area_scr').css('position','fixed');
			$('#menu_area_scr').css('top','0px');
			$('#menu_area_scr').css('width','100%');
			$('#menu_area_scr').css('z-index','100');	
			$('#menu_area_scr').css('bottom','');
			$('#menu_area_scr').css('border-top','');

			//$('#menu_area').css('position','static');
		}

	}
	//스크롤에 따라 -모바일의 경우 하단에 고정영역으로 sns 공유 영역 출력되도록 설정
	function scr_mobile_sns(){
		var width_now = $('#container').width();
		var scr_now = $(document).scrollTop();
		if(scr_now >300){
			//현재 스크롤의 위치가 브라우저 크기보다 아래에 있을경우..(콘텐츠 노출영역으로 내려갔을경우)
			//$('#top_con').show();
			$('#sns_area').css('z-index','100');
			$('#sns_area').css('position','fixed');
			$('#sns_area').css('bottom','0px');
			$('#sns_area').css('left','0px');

		    	 //모바일일 경우
			if(width_now<500){
			}else{
				//데스크탑의 경우
				$('#sns_area').css('width','100%');
				$('#sns_area').css('text-align','center');
				$('#sns_area').addClass('sns_area_on');
			}
		}else{
			/*초기값 셋팅*/
			$('#sns_area').css('z-index','');
			$('#sns_area').css('position','');
			$('#sns_area').css('bottom','');
			$('#sns_area').css('left','');

		    	 //모바일일 경우
			if(width_now<500){
			}else{
				//데스크탑의 경우
				$('#sns_area').css('width','');
				$('#sns_area').css('text-align','');
				$('#sns_area').removeClass('sns_area_on');
			}
		}
	}
	function scr_mobile_sns_orgin(){
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


	//컨텐츠 업데이트 여부 확인
	function check_popup(){
		var p_num = '<?echo $p_num;?>';
		//if(u_group==1){}

		//원본 정보 : /openpage/page_update_check/
		$.get("/openpage/popup_check/"+p_num,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			if(data!=''){
				$("#bg_area").after(data);
				$('#openpage_popup').slideDown();
				//alert(data);
			}
			
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
		if(modal_state == 'off'){
			$('#modal_txt').text(state);
			$("#modal_content").modal();
			modal_state = 'on';
		}
	}
	function modal_off(){
		if(modal_state == 'on'){
			$.modal.close();
			modal_state = 'off';
		}
	}
	function check_modal(){
		var modal_overlay = $('#simplemodal-overlay').css('visibility');
		//overlay가 visible 상태이면..
		 if(modal_overlay == 'visible'){
			 //alert('test');
			 
			//overlay에서 클릭이 일어났다면 모달창을 닫고, 스테이트를 off로 바꿔라.
			 $.modal.close();
			 modal_state ='off';
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
			var num_w = -10;
		}else{
			var num_w = menu_h;
		}
		//var div1 = $('#con_con1').offset().top+num_w;
		
		var div11 = $('#other_info').offset().top+num_w;
		if(val == 'menu1'){
			$('html, body').animate( {scrollTop:div1} );
		}else{
			$('html, body').animate( {scrollTop:'0'} );
		}
	}
    
	function open_iframe(menu){
	   
	     console.log("TESTTEST2");
	   $("#"+menu).find("iframe").each(function(){
	    console.log("TESTTEST");
	    $(this).iframeAutoHeight({heightOffset: 50});
	   });
	    
	    
	} 
    
	//팀원정보 리로드
	function check_teammate(){
		//alert(at_val);
		var p_num = '<?echo $p_num;?>';
		$.get("/team/check_teammate_act/"+p_num+"_open",function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#team_mate_state').html(data);
			$('#team_mate_state').css('size','12px');
			$('#team_mate_state').css('line-height','15px');
	   });
	}
	//팀정보 리로드
	function check_team(){
		var p_num = '<?if(isset($p_num)) echo $p_num;?>';
		$.get("/team/check_team/"+p_num,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#team_state').html(data);
	   });
	}

	//모집 예정
	function apply_soon(){
		alert('모집 기간이 아닙니다.');
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
<script type="text/javascript" src="/<?echo $javascript;?><?echo '?ver='.date("Ymd_H_i_s");?>"></script>
<script type="text/javascript" src="/<?echo $javascript_m;?><?echo '?ver='.date("Ymd_H_i_s");?>"></script>
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
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-45987664-6"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-45987664-6');
</script>

<!-- google분석기 끝-->