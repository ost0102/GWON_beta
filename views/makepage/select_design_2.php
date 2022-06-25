<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta content="width=device-width,minimum-scale=1,maximum-scale=1" name="viewport" />
<title>easymenu.kr</title>
<script type="text/javascript" src="/js/html5.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/selectivizr.js"></script>
<script type="text/javascript" src="/js/view_common.js"></script>
<!--favicon-->
<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
<link rel="icon" href="/img/favicon.ico" type="image/x-icon" />
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<!--활성화페이지 공통 스타일-->
<link href="/css/style_activated.css" rel="stylesheet" type="text/css" />
<!--[if (gte IE 6)&(lte IE 8)]>
<script type="text/javascript" src="/js/selectivizr.js"></script>
<![endif]-->
<link href="/css/ez_html_layout2.css" rel="stylesheet" type="text/css"></script>
<!--user code file-->
<link href="/<?echo $css;?>" type="text/css" rel="stylesheet" media="screen and (min-width:800px)"/>
<link href="/<?echo $css_m;?>" type="text/css" rel="stylesheet" media="screen and (max-width:799px)"/>
<script type="text/javascript">
	//jQuery 있는 상태
	window.onload=function(){
		check_con_div();
		check_w_mode();
	};

	//Scroll Check
	$(window).scroll(function(){ 
		var scr_now = $(window).scrollLeft();
		$win_h = $(window).height();
		$doc_h = $(document).height();
		$win_w = $(window).width();
		$check_width = $win_h - $win_w;
		$now_menu = $('.menu_left').css('display');
		//alert($check_width);
		//가로모드인지 체크
		if($check_width<=0){
			window.ez_scr_left_sate  = 'on';
		}else{
			//세로모드
			if($now_menu == 'block'){
				//세로모드인데, 왼쪽이 보이고 있다면.. on으로 변경
				window.ez_scr_left_sate  = 'on';
			}else{
				window.ez_scr_left_sate  = 'off';
			}
		}	
		if(window.ez_scr_left_sate  == 'on'){
			if(scr_now > '0'){
				$(window).scrollLeft('0');
			}
		}
		
		//좌측영역이 보이는 중이면, 높이값 지정하기(배경이미지 채우기)
		if($now_menu == 'block'){
			//alert('test');
			$(".menu_left").animate({'height':$doc_h},100);
		}

		//스크롤 변화에 따라 상단위치 고정하기
		var scr_now = $(document).scrollTop();
		//menu_left 존재유무에 따라 html type1, 2 인식 > type2일경우 실행동작과 type1일경우 실행동작을 구분하자.
		var check_menu_left = $("div").hasClass("menu_left");
		//현재 스크롤
		scr_move_type2();
		scr_mobile_sns();
		//alert(scr_now);
		//alert(check_menu_left);
	});

	$(document).ready(function() {
		check_teammate();
		check_team();

		var check_html_type = '<?echo $html_type;?>';
		if(check_html_type ==0){
			alert('아직 화면 구성 형식이 설정되어 있지 않습니다.');
			$modal_state ='on';
			/*window.open("/makepage/select_html/","select_design",'width=500,height=350,left=0,top=0,scrollbars=no');
			*/
			$.get("/makepage/select_html/",function(data,status){
				//alert("Data: " + data + "\nStatus: " + status);
				//open_modal(data);
				open_modal();
				$modal_state ='on';
				$('#modal_txt').html(data);
				$('#login_close').hide();
		   });

		//목표달성 그래프를 직접 삽입한 경우, 변환해주기
	    $('img').each(function() {
			if($(this).attr("src") == '/img/ggraph.jpg'){
				//본문 이미지 보이지 않도록 하기
				$(this).css('display','none');
				//g_id (그래프 아이디) 가져오기
			    var g_id = $(this).attr("name");
			    $(this).attr("id",'now_graph');
			    //그래프 정보 가져오기
			    $.post('/openpage/ggraph_info/'+g_id,{
				},
				function(data){
					//현재 선택된 img 요소에 id요소 추가하기
					$('#now_graph').before(data);
					//그래프가 복수 출력될 수 있으므로.. 현재 바꾼 이미지 값은 삭제함.
					$('#now_graph').remove();
					//id값 제거하기
					//alert(data);
					 //window.open(linked_url,'','');
				});
				//$(this).attr("onclick","check_linked('"+addr+"')");
			}
	    });
		   
		}

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
		  $modal_state ='off';
		 });
		 $modal_state ='off';
		/* 

		modal창의 콘텐츠에서 클릭해도 창이 없어지지 않도록 하려면...
		 $("body").click(function(){
			check_modal();
		 });
		*/

		//html2 관련
		$doc_h = $(window).height();
		$doc_w = $(window).width();
		//alert($doc_w);
		$contents_h = $('.contents').height();
		//브라우저 너비에 따라 콘텐츠창 사이즈 조정하기
		window.ez_scr_left_sate  = 'off';

		//$('.contents').css('height',$doc_h);//감춤
		//modal 관련
		 $("#m_close").click(function(){
		  $.modal.close();
		  $modal_state ='off';
		 });
		
		 $modal_state ='off';
	});
	
	//브라우저 사이즈가 변경될 경우 적용될 코드
	$(window).resize(function(){ 
		scr_mobile_sns();
	});
	
	//스크롤2
	function scr_move_type2(){
		var scr_now = $(document).scrollTop();
		var check_menu_left = $("div").hasClass("menu_left");
		if(check_menu_left == true){
			//html type 2의 경우 (좌측 메뉴영역이 있을 경우)
			if(scr_now >150){
				$('#container').css('position','fixed');
				$('#container').css('top','0px');
				$('#container').css('z-index','100');	
				//$('#login_area').hide();
				//$('#top_logo').css('display','hidden');
				//s_div.style.visibility = "hidden";
			}else{
				$('#menu_left').css('position','static');
				$('#login_area').show();
			}
		}else{
			//html type1의 경우(좌측 메뉴영역이 없을 경우)
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
	function menu_click(menu){
		alert(menu);
	}
	function popup_code(){
		var check_view_mode =$('#container_iframe').css('display');
		if(check_view_mode=='none'){
			//현재 부모창이 desktop 버전일경우 리로드해라
			var code_num = 1;
		}else{
			//현재 부모창이 mobile 버전 보기일경우 모바일보기에서 새로고침해라
			var code_num = 2;
		}
		window.open("/makepage/edit_code/"+code_num,"Edit code",'width=800,height=600,left=0,top=0,scrollbars=no');
	}
	function popup_template(){
		//window.open("/makepage/popup_template/","Select template",'width=500,height=430,left=0,top=0,scrollbars=no');
		/*window.open("/makepage/select_html/","select_design",'width=500,height=350,left=0,top=0,scrollbars=no');
		*/
		open_modal();
		$modal_state ='on';
		$.get("/makepage/select_html/",function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			//open_modal(data);
			$('#modal_txt').html(data);
			$('#login_close').show();
	   });
	}
	//팀원정보 리로드
	function check_teammate(){
		//alert(at_val);
		var w_num = '<?echo $this->session->userdata("w_num");?>';
		$.get("/team/check_teammate/"+w_num+"_3",function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#team_mate_state').html(data);
			$('#team_mate_state').css('size','12px');
			$('#team_mate_state').css('line-height','15px');
	   });
	}
	//팀정보 리로드
	function check_team(){
		var w_num = '<?echo $this->session->userdata("w_num");?>';
		$.get("/team/check_team/"+w_num+"_3",function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#team_state').html(data);
	   });
	}
	//연결된 링크정보 출력
	function check_link(){
		var w_num = '<?echo $w_num;?>';
		$.get("/makepage/check_link/"+w_num,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#linked_url').html(data);
			//$('#linked_url').show();
	   });
	}
		/**Select Template 관련**/
	//Category 선택 시 관련해서 액션일어나도록..
	function select_template(tem_id){
		var tem_id = tem_id;
		var p_num = '<?echo $this->session->userdata("w_num");?>';
		alert(p_num);
		
		$.post("/makepage/selected_template",{
			tem_id: tem_id,
			p_num: p_num
		},
		function(data){
		//alert(data);
		//입력값 초기화하기
		open_modal(data);
		if(data =="Updated!"){
			//alert("템플릿 설정이 완료되었습니다.");
			//location.replace('/makepage/edit_code/1');
			opener.location.reload();
			//check_modal();
			l
		 }else{
			alert("변경 권한이 없거나 해당 파일을 읽을 수 없습니다.");
		 }
		});
	}

	//메뉴 구성
	function scr_bt(val){
		//상단부터 div까지의 높이값 구하기
		var num_w = 0;
		var div1 = $('#con_con1').offset().top-160;
		var div2 = $('#other_info').offset().top+num_w;
		//alert(div1);
		if(val == 'menu1'){
			$('html, body').animate( {scrollTop:div1} );
		}else if(val == 'menu2'){
			$('html, body').animate( {scrollTop:div2} );
		}else{
			$('html, body').animate( {scrollTop:'0'} );
		}
	}

	/**********html2 관련*******************************/
	//browser resize
	$(window).resize(function(){ 
		//alert($doc_w);
		$now_w = $(window).width();
		if($win_w != $now_w){
			check_w_mode();
		}
	});

	//Scroll Check
	$(window).scroll(function(){ 
		var scr_now = $(window).scrollLeft();
		//alert(window.ez_scr_left_sate );
		if(window.ez_scr_left_sate  == 'on'){
			if(scr_now > '0'){
				$(window).scrollLeft('0');
			}
		}
		$doc_h = $(document).height();
		$now_menu = $('.menu_left').css('display');
		if($now_menu == 'block'){
			$(".menu_left").animate({'height':$doc_h},100);
		}
	});

	function show_leftzone(){
		//alert('test');
		$now_menu = $('.menu_left').css('display');
		//alert($('.menu_left').css('display'));
		if($now_menu == 'none'){
			$('.menu_left').show();
			$('.contents').css('margin-left','240px');
			window.ez_scr_left_sate  = 'on';
		}else{
			$('.menu_left').hide();
			$('.contents').css('margin-left','0px');
		}
		$doc_w = $(window).width();
		$doc_h = $(document).height();
		$('.contents').css('width',$doc_w);
		$('.menu_left').css('height',$doc_h);
	}

	//코드 수정창의 상태에 따른 view mode 변경
	function view_mode(now_view){
		var page_secur = '<?echo $page_secur; ?>';
		//alert(page_secur);
		if(now_view=='mobile'){
			//현재 view_mode가 mible이면 모바일 화면이 떠지도록, 이건 코드 수정창에서 호출
			//본문은 안보이고, iframe에 콘텐츠가 호출되도록..
			if($('#con_iframe').length>0){
				//iframe이 존재하면 추가하지 말고, 해당 프레임의 내용을 리로드하기
				$('#con_iframe').attr('src','/makepage/mobile_view/'+page_secur);
			}else{
				$('#device_form').append('<iframe id="con_iframe" width="360" height="640" src="/makepage/mobile_view/'+page_secur+'"></iframe>');
			}
			$('#container').hide();
			$('.contents').hide();
			$('#bg_area').hide();
			var now_b_h = $(window).height();
			//모바일 창 크기에 따른 배경 이미지 잘리던 부분 해결
			$('#container_iframe').css('height',now_b_h);
			$('#container_iframe').show();
			
		}else{
			$('#container').show();
			$('#container_iframe').hide();
			$('.contents').show();
			$('#bg_area').show();
		}
	}

	$(window).resize(function(){ 
		var page_secur = '<?echo $page_secur; ?>';
		//alert(page_secur);
		if(now_view=='mobile'){
			//현재 view_mode가 mible이면 모바일 화면이 떠지도록, 이건 코드 수정창에서 호출
			//본문은 안보이고, iframe에 콘텐츠가 호출되도록..
			if($('#con_iframe').length>0){
				//iframe이 존재하면 추가하지 말고, 해당 프레임의 내용을 리로드하기
				$('#con_iframe').attr('src','/makepage/mobile_view/'+page_secur);
			}else{
				$('#device_form').append('<iframe id="con_iframe" width="360" height="640" src="/makepage/mobile_view/'+page_secur+'"></iframe>');
			}
			$('#container').hide();
			$('.contents').hide();
			$('#bg_area').hide();
			var now_b_h = $(window).height();
			//모바일 창 크기에 따른 배경 이미지 잘리던 부분 해결
			$('#container_iframe').css('height',now_b_h);
			$('#container_iframe').show();
			
		}
	});	

</script>
<!--user code file-->
<script type="text/javascript" src="/<?echo $javascript;?>"></script>
<script type="text/javascript" src="/<?echo $javascript_m;?>"></script>
<!--웹 폰트 로드할 동안 텍스트 표시 안되는 현상 방지 시작-->
<script src="/js/webfont.js"></script>
<script type="text/javascript">
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
	<script type="text/javascript">
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
<!-- make step bar area include -->
<?$this->load->view('/include/make_step');?>
<div id='right_top_shape'>
	<a href="http://<?=$this->config->item('intro_url');?>/page"><img src="/img/right_top_shape_<?echo $cate_id;?>.png" class='logo_shape' alt='logo shape' /></a>
</div>
<div id='bg_area' title='<? echo $project_img; ?>'>
</div>
<div id='container_iframe' style='display: none;'>
	<div id='device_form'>
		<div style='width:100%; text-align:center;'>size : 360X640</div>
	</div>
</div>
<div id="container">
	<div class="menu_left">
		<div id='menu_area'>
			<!-- menu area 시작 -->
			<ul class="menu_ul">
				<!--// menu 시작 -->
				<?if($con_title!='')echo '<li><a onclick="scr_bt(\'menu1\')">'.$con_title.'</a></li>';?>
				<li><a onclick="scr_bt('menu11')">추가정보</a></li>
				<li onclick="show_leftzone();">Close Menu</li>
				<!--// menu 끝 -->
			</ul>
			<!-- menu area 끝 -->
		</div>
		<div class="bt_sub">
			
		</div>
	</div>
</div>
	<div class="contents">
		<!--상단영역 -->
		<div class="bg_w">
			<div id='view_menu' style="float:left; width: 20%; text-align: left;">
				<a onClick="show_leftzone()" href="#">
					<img src="/img/bt_menu.gif" valign=middle width="20px;" alt='' />
				</a>
			</div>
			<div style="float:left; text-align: center; width: 60%; ">
				<!-- logo Area -->
				<?if($logo!='')echo '<img src="'.$logo.'" id="logo_img" alt="logo" />';?>
				<h1><?echo $title;?></h1>
				<?echo $summary;?>
			</div>
		</div>
		<!--상단영역 끝-->
		<!--콘텐츠 영역 -->
		<div id="content_area">
			<div id="con_div">
				<!-- Contents Area Start -->
				<?$this->load->view('/include/con_area');?>
				<!-- Contents Area finish -->
			</div>
		</div>
		<!--콘텐츠 영역 끝 -->
		<!-- copyright area 시작 -->
		<div id='bottom'>
			<div id='bt_txt'>
				<a href="http://<?=$this->config->item('intro_url');?>/">easymenu.kr</a> © &nbsp;2014
			</div>
		</div>
		<!-- copyright area 끝 -->
	</div>
</div>

<div id="modal_content">
	 <div id="modal_txt">
		<!--내용 출력부분 시작-->
		loading..
	</div>
	<div id='login_close'>
		<a onclick="modal_off()"><img src="/img/land/bt_close.png" alt='button close' /></a>
	</div>
</div>
<!--모달창 출력부분 끝 -->
<!--modal창 관련 -->
<script type="text/javascript" src="/js/jquery.simplemodal.js"></script>
</body>
</html>