<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta content="width=device-width,minimum-scale=1,maximum-scale=1" name="viewport">
<title>intropage.net :: Quick and easy to make your project site.</title>
<script type="text/javascript" src="/js/html5.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/selectivizr.js"></script>
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
		//scroll 변화시 작동하기
	};
	//스크롤 변화에 따라 상단위치 고정하기
	$(window).scroll(function(){ 
		var scr_now = $(document).scrollTop();
		//현재 스크롤
		//alert(scr_now);

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
			$('#menu_area').css('width','');
			$('#menu_area').css('position','static');
		}
	});
	//모든 링크값 없애기
	<?
	$now_state = $_SERVER['REQUEST_URI'];
	if(strpos($now_state,'select_design') !== false || strpos($now_state,'mobile_view') !== false){
	?>
	$(document).ready(function() {
		$('a').each(function() {
			$(this).attr("href","javascript:alert('디자인 선택단계에서는 링크가 동작하지 않습니다.');");
			$(this).attr("target","_self");
			$(this).attr("onclick","");
	    	});
	});
	<?
	}
	?>
	$(document).ready(function() {
		check_teammate();
		check_team();

		var check_html_type = '<?echo $html_type;?>';


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
	
	function view_mode(now_view){
		//alert(now_view);
		if(now_view=='mobile'){
			//현재 view_mode가 mible이면 모바일 화면이 떠지도록, 이건 코드 수정창에서 호출
			$('#container').hide();
			$('#container_iframe').show();
			//본문은 안보이고, iframe에 콘텐츠가 호출되도록..
			if($('#con_iframe').length>0){
				//iframe이 존재하면 추가하지 말고, 해당 프레임의 내용을 리로드하기
				$('#con_iframe').attr('src','http://daum.net');
			}else{
				$('#container_iframe').append('<iframe id="con_iframe" width="360" height="640" src="/land"></iframe');
			}
			
			
		}else{
			$('#container').show();
			$('#container_iframe').hide();
		}
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
<div id='container_iframe' style='display: none;'>
</div>
<div id='container'>
	<!-- top Area Start
	<div id='gwon_login_area'>
		<div id='gwon_login_area_txt'>
			<?
			$gwon_users=$this->session->userdata('gwon_users');
			$u_group=$this->session->userdata('u_group');
			 if($gwon_users==""){
			?>
			이미 회원이신가요? 
			<a href = '/user/login_page'>로그인</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href = '/user/'>회원가입</a>
			<?}else{?>
				<?if($u_group==1){?>
			     <a href = '/admin/main' target='_blank'>관리자</a>
				<?}?>
			     <a href = '/mypage'>마이 페이지</a>
			     <a href = '/user/logout'>로그아웃</a>
			<?}?>
			<?
				$now_url = $_SERVER['REQUEST_URI'];
				if($now_url !='/user/login_page' && $now_url !='/user'){
					$newdata = array(
						'now_url_ss'  => $now_url
						 );

					$this->session->set_userdata($newdata);
				}
			?>
		</div>
	</div>
	 -->
	<div id='top_area'>
		<div id='top_con'>
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
	<div id="menu_area">
		<div id="menu_txt">
			<?
			/*if($div1_name!='')echo '<a onclick="scr_bt(\'menu1\')">'.$div1_name.'</a>&nbsp;';
			*/
			?>
			<a href="javascript:alert('활성화된 페이지에서만 동작합니다.');">소개</a>&nbsp;|&nbsp;
			<a href="javascript:alert('활성화된 페이지에서만 동작합니다.');">소식</a>
			<a href="javascript:alert('활성화된 페이지에서만 동작합니다.');">
			    <button id='post_project_info' class='btn btn-info'>
			        지원하기
			    </button>
			<a href="javascript:alert('활성화된 페이지에서만 동작합니다.');">결과 조회</a>
		</div>
	</div>
	<!-- top Area finish -->
	<div id='con_area'>
		<!-- Contents Area Start -->
		<?$this->load->view('/include/inc_con_area');?>
		<!-- Contents Area finish -->
		<!-- Bottom-->
		<div id='bottom'>
			<div id='bt_txt'>
				<a href="javascript:alert('활성화된 페이지에서만 동작합니다.');"><?echo $title;?></a>
				with <a href="javascript:alert('활성화된 페이지에서만 동작합니다.');">
				<?=$this->config->item('service_url');?></a> © &nbsp;2021<br/>
				
				<!--<span id="contact_area"><b>Contact : </b><?echo $contact;?></span> | 
				-->
				<?
				if(isset($edit_time)){
				?>
				 | 
				<span style="font-size: 10px;">Updated : <? echo $edit_time; ?>
				
				<?
				}
				?>
				</span>
			</div>
		</div>
		<!-- Bottom 끝 -->
	</div>
	<!-- Other Contents Area finish -->
</div>
<!--모달창 출력부분 시작-->

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
<script type="text/javascript" src="/js/jquery.simplemodal.js"></script>

</body>
</html>