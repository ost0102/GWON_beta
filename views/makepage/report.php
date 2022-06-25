<!DOCTYPE html>
<html class='decks show ' data-account='free'>
<meta content='width=device-width,minimum-scale=1,maximum-scale=1' name='viewport'>
<head>
	<meta charset='utf-8' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<title><?echo $title;?> - easymenu</title>
	<meta name='description' content='<?echo $summary;?> ::: A menu website created with easymenu.' />
	<meta name='viewport' content='initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<!--favicon-->
	<link rel='shortcut icon' href='/img/favicon.ico' type='image/x-icon'>
	<link rel='icon' href='/img/favicon.ico' type='image/x-icon'>

	<!--meta property='og:title' content='design notes by ngaut' />
	<meta property='og:site_name' content='Slides' />
	<meta property='og:image' content='https://s3.amazonaws.com/media-p.slid.es/thumbnails/ngaut/c16871/design-notes.jpg' />
	<meta property='og:type' content='presentation' />
	<meta property='og:url' content='http://slid.es/ngaut/design-notes' /-->

	<meta name='apple-mobile-web-app-capable' content='yes' />
	<meta name='apple-mobile-web-app-status-bar-style' content='black' />
	<script src='/js/jquery.js' type='text/javascript'></script>

	<!--modal창 관련 -->
	<script type='text/javascript' src='/js/html5.js'></script>
	<script type='text/javascript' src='/js/jquery.js'></script>
	<script type='text/javascript' src='/js/jquery.simplemodal.js'></script>
	<!--기본스타일-->
	<link href='/css/report_view.css' media='all' rel='stylesheet' type='text/css' />
	<!--기본스타일-->
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
	<!--웹 폰트 로드할 동안 텍스트 표시 안되는 현상 방지 시작-->
	<script src='/js/webfont.js'></script>
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
	<script type="text/javascript">
	$(document).ready(function() {
		check_teammate();
		check_team();
		check_graph_week(1);
		check_graph(2);
	});
	$(window).scroll(function(){ 
		window.anal_scr = $('#page_analytics').offset().top;
		window.now_scr = $(document).scrollTop();
		//alert(window.now_scr);
		if(now_scr >= anal_scr){
			var text_state = '페이지 분석 자료는 본 페이지의 관리자/팀원에게만 출력됩니다.'
			//fade_body_text(text_state);
			fade_text($('#page_analytics'), text_state, 'yellow', 1500);
		}
	});
	//팀원정보 리로드
	function check_teammate(){
		//alert(at_val);
		var w_num = '<?echo $p_num;?>';
		$.get("/team/check_teammate/"+w_num+"_open",function(data,status){
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
	//graph 정보 가져오기
	function check_graph(at_val){
	   var graph_type = at_val;
	   var p_num = '<?echo $p_num;?>';
	    //$('#graph_area').html('<div style="width:100%; text-align: center;"><img src="/img/loading.gif" style="width:50px;"></div>');
	    $('#graph_area').html("<iframe id='grp_iframe' class='grp_iframe' src='/mypage/show_graph/"+p_num+"_"+graph_type+"' width='100%' height: 400px; scrolling='no' frameborder='0'></iframe>");
	}
	function check_graph_week(at_val){
	   var graph_type = at_val;
	   var p_num = '<?echo $p_num;?>';
	    //$('#graph_area').html('<div style="width:100%; text-align: center;"><img src="/img/loading.gif" style="width:50px;"></div>');
	    $('#graph_area_week').html("<iframe id='grp_iframe_week' class='grp_iframe' src='/mypage/show_graph/"+p_num+"_"+graph_type+"' width='100%' scrolling='no' frameborder='0'></iframe>");
	}
	function fade_text(a_target, a_text, a_color, a_fadeTime) {
	    a_fadeTime = typeof a_fadeTime !== 'undefined' ?  a_fadeTime : 1500;
	    a_target.prepend("<div class='fade_text' style='width:100%; text-align: center; position:absoulte !important; position:fixed; top:0; left:0; z-index: 200; '></div>");
	    var o_fade_text = $('.fade_text');
	    o_fade_text.html(a_text);
	    o_fade_text.css('background', a_color);
	    o_fade_text.fadeOut(a_fadeTime);
	}

	//프린트 하기
	function print_now(){
		$('#do_print').hide();
		window.print();
	}

	</script>
  </head>
  <body>
<div id='right_top_shape'>
	<a href='http://<?=$this->config->item('intro_url');?>/<?echo $p_name;?>'><img src='/img/right_top_shape.png' class='logo_shape'></a>
</div>
	<div id='report_area'>
		<style>
			#print_bt_area{
				width: 100%;
				text-align: center;
			}
			#do_print{
				width: 100px;
				margin-top: 20px;
				padding: 10px;
				text-align: center;
				font-weight: bold;
				background: #fe5e3c;
				margin-left: auto;
				margin-right: auto;
				margin-bottom: 30px;
				color: #000000;
				/*border: 1px solid;*/
				border-radius: 25px;
				cursor: pointer;
				margin-bottom: 20px;
			}
		</style>
		<div id='print_bt_area'>
			<button id='do_print' class="bt_style" onclick="print_now();">프린트 하기</button><br/>
		</div>
		<div class='con_area'>
			<div id='top_area'>
				<?if($logo!='')echo '<img src="'.$logo.'" id="logo_img" style="width:200px; margin-bottom: 10px;">';?>
				<h1><?echo $title;?></h1><br/>
				<?echo $summary;?>
			</div>
			<? if($div1_name!=''){?>
				<h2>1. <?echo $div1_name;?></h2>
				<?echo $div1_con;?>
			<?}?>
			<? if($div2_name!=''){?>
				<h2>2. <?echo $div2_name;?></h2>
				<?echo $div2_con;?>
			<?}?>
			<? if($div3_name!=''){?>
				<h2>3. <?echo $div3_name;?></h2>
				<?echo $div3_con;?>
			<?}?>
			<? if($div4_name!=''){?>
				<h2>4. <?echo $div4_name;?></h2>
				<?echo $div4_con;?>
			<?}?>
			<? if($div5_name!=''){?>
				<h2>5. <?echo $div5_name;?></h2>
				<?echo $div5_con;?>
			<?}?>
			<? if($div6_name!=''){?>
				<h2>6. <?echo $div6_name;?></h2>
				<?echo $div6_con;?>
			<?}?>
			<? if($div7_name!=''){?>
				<h2>7. <?echo $div7_name;?></h2>
				<?echo $div7_con;?>
			<?}?>
			<? if($div8_name!=''){?>
				<h2>8. <?echo $div8_name;?></h2>
				<?echo $div8_con;?>
			<?}?>
			<? if($div9_name!=''){?>
				<h2>9. <?echo $div9_name;?></h2>
				<?echo $div9_con;?>
			<?}?>
			<? if($div10_name!=''){?>
				<h2>10. <?echo $div10_name;?></h2>
				<?echo $div10_con;?>
			<?}?>
			<!--추가정보 출력 -->
			<?
				if(isset($origin_project)){
				echo "<div style='float: left; border-top: 1px solid #cdcdcd; width: 100%; padding-top: 10px; margin-top: 10px; '>";
				echo '<h3>대표 사이트 : <a href="'.$origin_project.'" target="_blank">'.$origin_project.'</a></h3></div>';
			}
			?>
			<?
				if(isset($origin_project)){
				echo "<div style='float: left; border-top: 1px solid #cdcdcd; width: 100%; padding-top: 10px; margin-top: 10px; '>";
				echo '<h3>연락처 : '.$contact.'</h3></div>';
			}
			?>
			<?
				if(isset($where_act)){
			?>
				<!-- sub_top area include -->
				<div style='float: left; border-top: 1px solid #cdcdcd; width: 100%; padding-top: 10px; margin-top: 10px; padding-bottom: 10px; margin-bottom: 10px; border-bottom: 1px solid #cdcdcd; '>
					<h3>위치 : <?echo $geo_txt;?></h3><br/>
					<?$this->load->view('/makepage/map_info');?>
				</div>
			<?
			}
			?>
			<?
			if(isset($team_member)){
				echo '<h2>Member</h2>';
				echo '<div id="team_mate_state" style="float: left; width: 100%; border-bottom: 1px solid #cdcdcd; padding-bottom: 20px; margin-bottom: 20px;" >
							<!--팀원정보 출력 부분, ajax로 호출-->
						</div>';
			}
			?>
			<?
			if(isset($team_info)){
				echo '<h2>Team info</h2>';
				echo '<div id="team_state" style="border-bottom: 1px solid #cdcdcd; float: left; width: 100%; padding-bottom: 20px; margin-bottom: 20px;" >
							<!--팀원정보 출력 부분, ajax로 호출-->
						</div>';
			}
			?>
			<!--분석정보 출력 -->
			<? if(isset($visited_total)&&$visited_total!=''){
				?>
			<div id='page_analytics' style='float: left; width:100%; padding-top: 10px; padding-bottom: 10px; margin-bottom: 10px; border-bottom: 1px solid #cdcdcd; size: 10px;'>
				<h1 title='페이지 분석 자료는 본 페이지의 관리자/팀원에게만 출력됩니다.'>페이지 분석 자료</h1>
				<div style='float: left; border-top: 1px solid #cdcdcd; width: 100%; padding-top: 10px; padding-bottom: 10px; margin-top: 10px; '>
					<img src='/img/icon/icon_link.png' style='padding-left: 5px; padding-right: 5px; width: 15px;'/>페이지 주소 : <a href='http://easymenu.kr/<? echo $p_name;?>' target='_blank'>http://easymenu.kr/<? echo $p_name;?></a>
				</div>
				<div style='float: left; border-top: 1px solid #cdcdcd; border-bottom: 1px solid #cdcdcd; width: 100%; padding-top: 10px; padding-bottom: 10px; margin-bottom: 10px;'>
					<b>총 방문자수 :</b> <?echo $visited_total;?>&nbsp;&nbsp;&nbsp;오늘 방문자 수 : <?echo $visited_today;?>
				</div>
				<b>주간 방문자 수</b>
				<div id='graph_area_week'>
				</div>
				<b>시간대별 방문자 수</b>
				<div id='graph_area'>
				</div>
				<div style='float: left; width:100%; padding-top: 10px; padding-bottom: 10px;'>
					<b>페이지 공유 횟수</b> Like : <?echo $like_total;?>&nbsp;&nbsp;&nbsp;facebook : <?echo $like_fb;?>&nbsp;&nbsp;&nbsp;twitter : <?echo $like_twt;?>&nbsp;&nbsp;&nbsp;kakao : <?echo $like_kakao;?>
				</div>
				<div style='float: left; border-top: 1px solid #cdcdcd; width:100%; padding-top: 10px; padding-bottom: 10px;'>
					<b>사용자 문의</b> : <?echo $total_mail; ?>
					<?
						if(isset($mail_info)){
							//print_r($linked_info);
							echo '<ul style="margin-top: 10px;"">';
							foreach ($mail_info as $mail_info)
							{
								echo '<li style="font-size: 12px;">'.$mail_info['visitor_mail'].'님이 문의하였습니다. &nbsp;[';
								echo date('Y-m-d',strtotime($mail_info['date'])).']</li>';
							}
							echo '</ul>';
						}
					?>
				</div>
				
			</div>
			<?}?>
			<?

			if(isset($linked_url)){
				echo '<div style="float: left; width: 100%; padding-bottom: 10px;">
				<h3>관련 정보 (링크 클릭 수)</h3>';
				echo '<ul>';
				foreach ($linked_url as $linked_url)
				{
					$link_title = $linked_url['link_title'];
					$link_url = $linked_url['link_url'];
					$link_txt = $linked_url['link_txt'];
					$in_out = $linked_url['in_out'];
					$count = $linked_url['count'];

					if(strpos($link_url, 'facebook.com') !== false) {  
						$sns_type = '<img src="/img/icon/bt_fb.png" style="margin-right: 5px; width: 15px;">';
					}else if(strpos($link_url, 'twitter.com') !== false) {  
						$sns_type = '<img src="/img/icon/bt_twt.png" style="margin-right: 5px; width: 15px;">';
					}else if(strpos($link_url, 'youtu.be') !== false || strpos($link_url, 'youtube.com') !== false) {  
						$sns_type = '<img src="/img/icon/bt_youtube.png" style="margin-right: 5px; width: 15px;">';
					}else{
						$sns_type = '<img src="/img/icon/bt_link.png" style="margin-right: 5px; width: 15px;">';
					}
					//현재 페이지 방문자가 관리자 계정이라면...
					if(isset($visited_total)&&$visited_total!=''){
						echo '<li>'.$sns_type;
						echo '<b><a href="'.$link_url.'" target="_blank" title="'.$link_txt.'">'.$link_title.'</a></b>&nbsp;&nbsp;click : '.$count.'</li>';
					}else{
						//일반 사용자라면..
						echo '<li>'.$sns_type;
						echo '<b><a href="'.$link_url.'" target="_blank" title="'.$link_txt.'">'.$link_title.'</a></b>&nbsp;</li>';
					
					}

					
				}
				echo '</ul></div>';
			}
			?>
		</div>
	</div>
	<div class='bt_area'>
		<a onclick='bt_show()' id='bt_check_txt'>Show Button</a>
	</div>
</div>
	
</div>
<!--모달창 출력부분 시작-->
<div id='modal_content'>
	 <div id='modal_txt'>
		<!--내용 출력부분 시작-->
		loading..
	</div>
	<div id=login_close>
		<a onClick='modal_off()'><img src='/img/land/bt_close.png' style='width: 60px;'></a>
	</div>
</div>
<!--모달창 출력부분 끝 -->
</body>
</html>
<!--modal창 관련 -->
<script type='text/javascript' src='/js/jquery.simplemodal.js'></script>