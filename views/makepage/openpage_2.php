<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<?
	$this->load->view('/include/inc_openpage_head');
	?>
	<link href="/css/ez_html_layout2.css" rel="stylesheet" type="text/css" />
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
				window.ez_scr_left_sate = 'on';
			}else{
				//세로모드
				if($now_menu == 'block'){
					//세로모드인데, 왼쪽이 보이고 있다면.. on으로 변경
					window.ez_scr_left_sate = 'on';
				}else{
					window.ez_scr_left_sate = 'off';
				}
			}	
			if(window.ez_scr_left_sate == 'on'){
				if(scr_now > '0'){
					//$(window).scrollLeft('0');
					//scroll이 0이상이면, (좌측으로 스크롤을 하면..) 메뉴영역 창닫기
					show_leftzone();
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
			

			//Scroll위치에 따른 DB에 콘텐츠 확인여부 기록
			var scr_h = $(document).scrollTop();
			var doc_h = $(document).height()/2;
			if(doc_h<scr_h){
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
						 //입력값 초기화하기
						 //open_modal(data);
						 //alert(p_num+'_'+ip);
						 check_read = data;
					});
				}
			}
		});

		$(document).ready(function() {
			//html2 관련
			$doc_h = $(window).height();
			$doc_w = $(window).width();
			//alert($doc_w);
			$contents_h = $('.contents').height()+100;
			//브라우저 너비에 따라 콘텐츠창 사이즈 조정하기
			window.ez_scr_left_sate = 'off';


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


		/**********html2 관련*******************************/
		//browser resize
		$(window).resize(function(){ 
			//alert($doc_w);
			$now_w = $(window).width();
			if($doc_w != $now_w){
				check_w_mode();
			}
		});

		//Scroll Check
		$(window).scroll(function(){ 
			var scr_now = $(window).scrollLeft();
			//alert(window.ez_scr_left_sate );
			if(window.ez_scr_left_sate == 'on'){
				if(scr_now > '0'){
					$(window).scrollLeft('0');
				}
			}
		});

		function show_leftzone(){
			//alert('test');
			$now_menu = $('.menu_left').css('display');
			//alert($('.menu_left').css('display'));
			if($now_menu == 'none'){
				$('.menu_left').show();
				$('.contents').css('margin-left','240px');
				window.ez_scr_left_sate = 'on';
			}else{
				$('.menu_left').hide();
				$('.contents').css('margin-left','0px');
			}
			$doc_w = $(window).width();
			$doc_h = $(document).height();
			$('.contents').css('width',$doc_w);
			$('.menu_left').css('height',$doc_h);
		}

	</script>
	<!--user code file-->
	<script type="text/javascript" src="/<?echo $javascript;?>"></script>
	<script type="text/javascript" src="/<?echo $javascript_m;?>"></script>
	<!--웹 폰트 로드할 동안 텍스트 표시 안되는 현상 방지 시작-->
	<script type="text/javascript" src="/js/webfont.js"></script>
	<script type="text/javascript" >
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
		<!--other button -->
		</div>
	</div>
	</div>
	<div class="contents">
		<!--상단영역 -->
		<div class="bg_w">
			<div id='view_menu' style="float:left; width: 20%; text-align: left;">
				<a onClick="show_leftzone()" href="#">
					<img src="/img/bt_menu.gif" valign=middle width="20px;">
				</a>
			</div>
			<div style="float:left; text-align: center; width: 60%; ">
				<?$now_url = $_SERVER['REQUEST_URI'];
				$base_url = $this->config->item('base_url');

				
				if(isset($domain_url)){
					$now_call=$this->input->get('now_call');
					//이미 외부 도메인에서 iframe으로 호출한 거라면..
					if($now_call=='other_domain'){
						$site_domain = $base_url.'/'.$domain;

					}else{
						if($domain_url==''){
							//연결된 외부 도메인이 없을 경우 Gwon기본 도메인 사용
							$site_domain = $base_url.'/'.$domain;
						}else{
							$site_domain = 'http://'.$domain_url;
						}
					}
					
				}else{
					//domain_url정보가 없음. 그러면 그냥 기본 url로.. 잘못하면 iframe 수백개 생길수 있으니..
					$site_domain = $base_url.'/'.$domain;
				}
				?>

				<?if($logo!=''&&$top_img_url!="noshow"){
					echo '<a href="'.$site_domain.'" target="_self"><img src="'.$logo.'" id="logo_img" '.$top_img_url_txt.'></a>';
				}?>
				<?if($top_title!="noshow"){
				?>
				<h2 id='top_title' ><?echo $title;?></h2>
				<?}?>
				<?if($top_date!="noshow"){
				?>
				<span id='date_info' <?echo $top_date_txt;?>>
					<b>접수 기간</b>
					<?echo date("Y년m월d일", strtotime( $start_date ));?>
					<?echo date("H시i분", strtotime( $start_time ));?>
					~<br/>
					<?echo date("Y년m월d일", strtotime( $end_date ));?>
					<?echo date("H시i분", strtotime( $end_time ));?>
				</span>
				<?}?>
			</div>
		</div>
		<!--상단영역 끝-->
		<!--콘텐츠 영역 -->
		<div id="content_area">
			<div id="con_div">
				<!-- Contents Area Start -->
				<?$this->load->view('/include/con_area');?>
				<!-- Contents Area finish -->	
				<!-- copyright area 시작 -->
				<div id='bottom'>
					<div id='bt_txt'>
						<?
							$base_url = $this->config->item('base_url');
						?>
						<a href='<?echo $base_url;?>/<?echo $domain;?>'><?echo $title;?></a>
						<div style='width: 100%; padding-top: 10px; padding-bottom: 10px; text-align: center;'>
							이 사이트는 쉬워지는 지원사업 <a href="<?=$this->config->item('base_url');?>/" target='_blank'>Gwon</a>을 통해
							개발되었습니다.
						</div>
						
						<a href="<?=$this->config->item('base_url');?>/" target='_blank'>
						<?=$this->config->item('service_url');?></a> © &nbsp;2020<br/>
						<!--<span id="contact_area"><b>Contact : </b><?echo $contact;?></span> | 
						-->
						<span style="font-size: 10px;">
							Updated : <? echo $edit_time; ?>
						
							<?
							if(isset($edit_con)&&$edit_con==2){
								$can_edit = 'y';
							}else{
								$can_edit = 'n';
							}
							if($can_edit=='y'){
								echo '&nbsp;|&nbsp; <a href="/mypage/page_detail/'.$page_secur.'" target="_blank">관리 페이지 바로가기</a>';
							}?>
						</span>
					</div>
				</div>
				<!-- copyright area 끝 -->
			</div>
		</div>
		<!--콘텐츠 영역 끝 -->
	</div>
</div>

<div id="modal_content">
	 <div id="modal_txt">
		<!--내용 출력부분 시작-->
		이곳에 내용 출력
	</div>
	<div id='login_close'>
		<a onclick="modal_off();"><img src="/img/land/bt_close.png"></a>
	</div>
</div>
<!--모달창 출력부분 끝 -->
<!--modal창 관련 -->
<script type="text/javascript" src="/js/jquery.simplemodal.js"></script>

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