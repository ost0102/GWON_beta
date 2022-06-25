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
	<!--
	<link href='/css/style.css' media='all' rel='stylesheet' type='text/css' />
	-->
	<script src='/js/jquery.js' type='text/javascript'></script>

	<!--modal창 관련 -->
	<script type='text/javascript' src='/js/html5.js'></script>
	<script type='text/javascript' src='/js/jquery.js'></script>
	<script type='text/javascript' src='/js/selectivizr.js'></script>
	<script type='text/javascript' src='/js/jquery.simplemodal.js'></script>
	<!--touch 관련 -->
	<script src='/js/ppt/hammer.min.js'></script>
	<script src='/js/ppt/hammer.fakemultitouch.js'></script>
	<!--기본스타일-->
	<link href='/css/presentation.css' media='all' rel='stylesheet' type='text/css' />
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
</head>
<body class='bg_color1'>
	<div id='ppt_area'>
		<div id='ppt_slides' class='slides'>
			<section id='slide_0'>	
				<table width='100%' height='100%' class='slide_table'>
					<tr>
						<td>
							<?if($logo!='')echo '<img src="'.$logo.'" id="logo_img" style="width:200px; margin-bottom: 10px;">';?>
							<h1><?echo $title;?></h1><br/>
							<?echo $summary;?>
						</td>
					</tr>
				</table>
			</section>
			<? if($div1_name!=''){?>
			<section id='slide_1' onclick='select_section("1")'>
				<table width='100%' height='100%' class='slide_table'>
					<tr>
						<td>
							<h2><?echo $div1_name;?></h2>
							<?echo $div1_con;?>
						</td>
					</tr>
				</table>
			</section>
			<?}?>
			<? if($div2_name!=''){?>
			<section id='slide_2' onclick='select_section("2")'>
				<table width='100%' height='100%' class='slide_table'>
					<tr>
						<td>
							<h2><?echo $div2_name;?></h2>
							<?echo $div2_con;?>
						</td>
					</tr>
				</table>
			</section>
			<?}?>
			<? if($div3_name!=''){?>
			<section id='slide_3' onclick='select_section("3")'>
				<table width='100%' height='100%'  class='slide_table'>
					<tr>
						<td>
							<h2><?echo $div3_name;?></h2>
							<?echo $div3_con;?>
						</td>
					</tr>
				</table>
			</section>
			<?}?>
			<? if($div4_name!=''){?>
			<section id='slide_4' onclick='select_section("4")'>
				<table width='100%' height='100%' class='slide_table'>
					<tr>
						<td>
							<h2><?echo $div4_name;?></h2>
							<?echo $div4_con;?>
						</td>
					</tr>
				</table>
			</section>
			<?}?>
			<? if($div5_name!=''){?>
			<section id='slide_5' onclick='select_section("5")'>
				<table width='100%' height='100%' class='slide_table'>
					<tr>
						<td>
							<h2><?echo $div5_name;?></h2>
							<?echo $div5_con;?>
						</td>
					</tr>
				</table>
			</section>
			<?}?>
			<? if($div6_name!=''){?>
			<section id='slide_6' onclick='select_section("6")'>
				<table width='100%' height='100%' class='slide_table'>
					<tr>
						<td>
							<h2><?echo $div6_name;?></h2>
							<?echo $div6_con;?>
						</td>
					</tr>
				</table>
			</section>
			<?}?>
			<? if($div7_name!=''){?>
			<section id='slide_7' onclick='select_section("7")'>
				<table width='100%' height='100%' class='slide_table'>
					<tr>
						<td>
							<h2><?echo $div7_name;?></h2>
							<?echo $div7_con;?>
						</td>
					</tr>
				</table>
			</section>
			<?}?>
			<? if($div8_name!=''){?>
			<section id='slide_8' onclick='select_section("8")'>
				<table width='100%' height='100%' class='slide_table'>
					<tr>
						<td>
							<h2><?echo $div8_name;?></h2>
							<?echo $div8_con;?>
						</td>
					</tr>
				</table>
			</section>
			<?}?>
			<? if($div9_name!=''){?>
			<section id='slide_9' onclick='select_section("9")'>
				<table width='100%' height='100%' class='slide_table'>
					<tr>
						<td>
							<h2><?echo $div9_name;?></h2>
							<?echo $div9_con;?>
						</td>
					</tr>
				</table>
			</section>
			<?}?>
			<? if($div10_name!=''){?>
			<section id='slide_10' onclick='select_section("10")'>
				<table width='100%' height='100%' class='slide_table'>
					<tr>
						<td>
							<h2><?echo $div10_name;?></h2>
							<?echo $div10_con;?>
						</td>
					</tr>
				</table>
			</section>
			<?}?>
		</div>
	</div>
	<div class='bottom_gradation'>
	</div>
	<div class='bt_area'>
		<a id='bt_top'><img src='/img/bt_top.png' style='width: 35px;'></a>
		<a id='bt_down'><img src='/img/bt_bottom.png' style='width: 35px;'></a>
		<a id='bt_dark'><img src='/img/bt_txt_dark.png' style='width: 35px;'></a>
		<a id='bt_bright'><img src='/img/bt_txt_bright.png' style='width: 35px;'></a>
		<a id='bt_font_big'><img src='/img/bt_font_big.png' style='width: 35px;'></a>
		<a id='bt_font_small'><img src='/img/bt_font_small.png' style='width: 35px;'></a>
		<a id='bt_img_big'><img src='/img/bt_img_big.png' style='width: 35px;'></a>
		<a id='bt_img_small'><img src='/img/bt_img_small.png' style='width: 35px;'></a>
		<a onclick='requestFullScreen();'><img src='/img/bt_img_fullscreen.png' style='width: 35px;' title='전체화면' alt='전체화면'> </a>
		<!--button id='modal_test'>modal</button-->
	</div>
	<div class='sns_area'>
		<?
		   $hostname=$_SERVER['HTTP_HOST']; //도메인명(호스트)명을 구합니다.
		   $basename=basename($_SERVER['PHP_SELF']); //현재 실행되고 있는 페이지명만 구합니다.
		   $now_url = 'http://'.$hostname.'/'.$basename.'/#!/0';
		?>
		<!---->
		<div id='fb-root'></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = '//connect.facebook.net/ko_KR/all.js#xfbml=1&appId=651547174865569';
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		
		<div class='fb-like' data-href='<?echo $now_url?>' data-layout='button_count' data-action='like' data-show-faces='true' data-share='true'></div>	
	</div>
	<div class='bt_area2'>
		<a onclick='bt_show()' id='bt_check_txt'>Show Button</a>
	</div>
</div>
	
</div>
<script src='/js/presentation_tool.js' type='text/javascript'></script>
<!--모달창 출력부분 시작-->
<div id='modal_content'>
	 <div id='modal_txt'>
		<!--내용 출력부분 시작-->
		loading..
	</div>
	<div id='modal_bt'>
		<a id='bt_top' onclick='goto_top("modal");'><img src='/img/bt_top.png' style='width: 30px;'></a>&nbsp;&nbsp;
		<a id='bt_down' onclick='goto_down("modal");'><img src='/img/bt_bottom.png' style='width: 30px;'></a>&nbsp;&nbsp;
		<a id='bt_dark' onclick='change_color(1);'><img src='/img/bt_txt_dark.png' style='width: 30px;'></a>&nbsp;&nbsp;
		<a id='bt_bright' onclick='change_color(2);'><img src='/img/bt_txt_bright.png' style='width: 30px;'></a>&nbsp;&nbsp;
		<a id='bt_font_big' onclick='change_font(1);'><img src='/img/bt_font_big.png' style='width: 30px;'></a>&nbsp;&nbsp;
		<a id='bt_font_small' onclick='change_font(2);'><img src='/img/bt_font_small.png' style='width: 30px;'></a>&nbsp;&nbsp;
		<a id='bt_img_big' onclick='change_img(1);'><img src='/img/bt_img_big.png' style='width: 30px;'></a>&nbsp;&nbsp;
		<a id='bt_img_small' onclick='change_img(2);'><img src='/img/bt_img_small.png' style='width: 30px;'></a>
	</div>
	<div id='login_close'>
		<a onClick='modal_off()'><img src='/img/land/bt_close.png' style='width: 60px;'></a>
	</div>
</div>
<!--모달창 출력부분 끝 -->
</body>
</html>
<!--modal창 관련 -->
<script type='text/javascript' src='/js/jquery.simplemodal.js'></script>