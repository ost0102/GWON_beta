<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta content="width=device-width,minimum-scale=1,maximum-scale=1" name="viewport">
<title>intropage.net :: Quick and easy to make your project site.</title>
<script type="text/javascript" src="/js/html5.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/selectivizr.js"></script>
<script type="text/javascript" src="/js/view_common.js"></script>
<!--favicon-->
<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
<link rel="icon" href="/img/favicon.ico" type="image/x-icon">
<link href='/css/bootstrap.min.css' rel='stylesheet' />
<link href="/css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/css/font.css" type="text/css"/>
<!--[if (gte IE 6)&(lte IE 8)]>
<script type="text/javascript" src="/js/selectivizr.js"></script>
<![endif]-->
<link href="/css/gwon_html_layout2.css" rel="stylesheet" type="text/css">
<!--user code file-->
<link href="/<?echo $css;?><?echo '?ver='.date("Ymd_H_i_s");?>" type="text/css" rel="stylesheet" media="screen and (min-width:800px)"/>
<link href="/<?echo $css_m;?><?echo '?ver='.date("Ymd_H_i_s");?>" type="text/css" rel="stylesheet" media="screen and (max-width:799px)"/>
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
			window.ipg_scr_left_sate = 'on';
		}else{
			//세로모드
			if($now_menu == 'block'){
				//세로모드인데, 왼쪽이 보이고 있다면.. on으로 변경
				window.ipg_scr_left_sate = 'on';
			}else{
				window.ipg_scr_left_sate = 'off';
			}
		}	
		if(window.ipg_scr_left_sate == 'on'){
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
		//alert(scr_now);
		//alert(check_menu_left);
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
	});

	$(document).ready(function() {
		check_teammate();
		check_team();

		var check_html_type = '<?echo $html_type;?>';
		if(check_html_type ==0){
			alert('아직 화면 구성 형식이 설정되어 있지 않습니다. 템플릿을 선택해주세요.');
		   
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
		  modal_state ='off';
		 });
		 modal_state ='off';
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
		window.ipg_scr_left_sate = 'off';

		//$('.contents').css('height',$doc_h);//감춤
		//modal 관련
		 $("#m_close").click(function(){
		  $.modal.close();
		  modal_state ='off';
		 });
		
		 modal_state ='off';
	});
	
	
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
	function menu_click(menu){
		alert(menu);
	}
	function popup_code(){
		window.open("/makepage/edit_code/","Edit code",'width=800,height=600,left=0,top=0,scrollbars=no');
	}
	function popup_template(){
		//window.open("/makepage/popup_template/","Select template",'width=500,height=430,left=0,top=0,scrollbars=no');
		/*window.open("/makepage/select_html/","select_design",'width=500,height=350,left=0,top=0,scrollbars=no');
		*/
		open_modal();
		modal_state ='on';
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
		var div2 = $('#con_con2').offset().top+num_w;
		var div3 = $('#con_con3').offset().top+num_w;
		var div4 = $('#con_con4').offset().top+num_w;
		var div5 = $('#con_con5').offset().top+num_w;
		var div6 = $('#con_con6').offset().top+num_w;
		var div7 = $('#con_con7').offset().top+num_w;
		var div8 = $('#con_con8').offset().top+num_w;
		var div9 = $('#con_con9').offset().top+num_w;
		var div10 = $('#con_con10').offset().top+num_w;
		var div11 = $('#other_info').offset().top+num_w;
		//alert(div1);
		if(val == 'menu1'){
			$('html, body').animate( {scrollTop:div1} );
		}else if(val == 'menu2'){
			$('html, body').animate( {scrollTop:div2} );
		}else if(val == 'menu3'){
			$('html, body').animate( {scrollTop:div3} );
		}else if(val == 'menu4'){
			$('html, body').animate( {scrollTop:div4} );
		}else if(val == 'menu5'){
			$('html, body').animate( {scrollTop:div5} );
		}else if(val == 'menu6'){
			$('html, body').animate( {scrollTop:div6} );
		}else if(val == 'menu7'){
			$('html, body').animate( {scrollTop:div7} );
		}else if(val == 'menu8'){
			$('html, body').animate( {scrollTop:div8} );
		}else if(val == 'menu9'){
			$('html, body').animate( {scrollTop:div9} );
		}else if(val == 'menu10'){
			$('html, body').animate( {scrollTop:div10} );
		}else if(val == 'menu11'){
			$('html, body').animate( {scrollTop:div11} );
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
		//alert(window.ipg_scr_left_sate);
		if(window.ipg_scr_left_sate == 'on'){
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
			window.ipg_scr_left_sate = 'on';
		}else{
			$('.menu_left').hide();
			$('.contents').css('margin-left','0px');
		}
		$doc_w = $(window).width();
		$doc_h = $(document).height();
		$('.contents').css('width',$doc_w);
		$('.menu_left').css('height',$doc_h);
	}
	$(window).resize(function(){ 

	});
</script>
<!--user code file-->
<script type="text/javascript" src="/<?echo $javascript;?><?echo '?ver='.date("Ymd_H_i_s");?>"></script>
<script type="text/javascript" src="/<?echo $javascript_m;?><?echo '?ver='.date("Ymd_H_i_s");?>"></script>
<!--웹 폰트 로드할 동안 텍스트 표시 안되는 현상 방지 시작-->
<script src="/js/webfont.js"></script>
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
	<script>
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
		<div id="menu_area">
			<!-- menu area 시작 -->
			<ul class="menu_ul">
				<!--// menu 시작 -->
				<?if($div1_name!='')echo '<li><a onclick="scr_bt(\'menu1\')">'.$div1_name.'</a></li>';?>
				<?if($div2_name!='')echo '<li><a onclick="scr_bt(\'menu2\')">'.$div2_name.'</a></li>';?>
				<?if($div3_name!='')echo '<li><a onclick="scr_bt(\'menu3\')">'.$div3_name.'</a></li>';?>
				<?if($div4_name!='')echo '<li><a onclick="scr_bt(\'menu4\')">'.$div4_name.'</a></li>';?>
				<?if($div5_name!='')echo '<li><a onclick="scr_bt(\'menu5\')">'.$div5_name.'</a></li>';?>
				<?if($div6_name!='')echo '<li><a onclick="scr_bt(\'menu6\')">'.$div6_name.'</a></li>';?>
				<?if($div7_name!='')echo '<li><a onclick="scr_bt(\'menu7\')">'.$div7_name.'</a></li>';?>
				<?if($div8_name!='')echo '<li><a onclick="scr_bt(\'menu8\')">'.$div8_name.'</a></li>';?>
				<?if($div9_name!='')echo '<li><a onclick="scr_bt(\'menu9\')">'.$div9_name.'</a></li>';?>
				<?if($div10_name!='')echo '<li><a onclick="scr_bt(\'menu10\')">'.$div10_name.'</a></li>';?>
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
			<div id="view_menu" style="float:left; width: 20%; text-align: left;">
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
				<?$this->load->view('/include/inc_con_area');?>
				<!-- Contents Area finish -->
				<!-- copyright area 시작 -->
				<div id='bottom'>
					<div id='bt_txt'>
						<table style=''>
							<tr>
								<td style='width: 100px;'>
									<?if($logo!='')echo '<img src="'.$logo.'" id="bottom_logo_img" style="max-width: 100%;" />';?>
								</td>
								<td style='text-align: left; padding-left: 25px;'>
									<a href='http://intropage.net<?echo $now_url;?>' target='_blank'><?echo $title;?></a>
									with <a href="<?=$this->config->item('base_url');?>/" target='_blank'>
									<?=$this->config->item('service_url');?></a> © &nbsp;2020<br/>
									
									<b>Contact : </b><?echo $contact;?> | 

									<span style="font-size: 10px;">Updated : <? echo $edit_time; ?>
									
									<?

									if(isset($edit_con)&&$edit_con==2){
										$can_edit = 'y';
									}else{
										$can_edit = 'n';
									}
									if($can_edit=='y'){
										$admin = $this->input->get_post("admin");
									if($admin){
										echo '&nbsp;|&nbsp; <a href="http://'.$intro_url.'/'.$domain.'" target="_self">일반 사용자 상태로 보기</a>';
									}else{	
										echo '&nbsp;|&nbsp; <a href="http://'.$intro_url.'/'.$domain.'?admin=1" target="_self">관리자 상태로 보기</a>';
									}
									}?>
									</span>

								</td>
							</tr>
						</table>
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
		loading..
	</div>
	<div id="login_close">
		<a onClick="modal_off()"><img src="/img/basic/bt_close.png"></a>
	</div>
</div>
<!--모달창 출력부분 끝 -->
<!--modal창 관련 -->
<script type="text/javascript" src="/js/jquery.simplemodal.js"></script>
</body>
</html>