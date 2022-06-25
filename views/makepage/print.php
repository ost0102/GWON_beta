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
	<!--언어설정 변경 -->
	<script type="text/javascript" src="/js/js.cookie.js"></script>
	<!--기본스타일-->
	<link href='/css/print_view.css' media='all' rel='stylesheet' type='text/css' />
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
			var now_front_h =	$('#front_con1').height();
			var f_space = 1000-now_front_h;
			if(f_space>0){
				//콘텐츠 길이가 종이보다 짧으면..
				f_space_num = f_space/10;
				f_top = f_space_num*4;
				f_middle = f_space_num*3.5;
				f_bottom = f_space_num;
				$('#front_con1').css('padding-top',f_top);
				$('#front_con1').css('padding-bottom',f_bottom);
				$('#front_bottom').css('margin-top',f_middle);
				//alert(f_space);
			}else{
				//본문 길이가 종이보다 길다면..

			}
		});

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
			//$('#do_print').hide();
			window.print();
		}

	</script>
</head>
<body>
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
			background: #3b9792;
			margin-left: auto;
			margin-right: auto;
			margin-bottom: 30px;
			color: #ffffff;
			border: 0px;
			border-radius: 15px;
			cursor: pointer;
			margin-bottom: 20px;
		}

		.price_st{
			color: #e1614f;
		    font-size: 18px;
		    padding-bottom: 5px;
		}

		.menu_taste_area {
		    background: #efefef;
		    border-radius: 10px;
		    color: #555555;
		    font-size: 11px;
		    padding: 1%;
		    padding-left: 10px;
		    padding-right: 10px;
		    margin-bottom: 10px;
		    margin-top: 10px;
		}
		.menu_sub_info{
			border-bottom: 1px solid #cdcdcd;
			padding-top: 5px;
			padding-bottom: 5px;
			margin-bottom: 5px;
		}
	</style>
	<div id='print_bt_area'>
		<button id='do_print' class="bt_style" onclick="print_now();">프린트 하기</button><br/>
		*머리글과 바닥글을 없애시려면 크롬에서 출력하세요.

		<div id='now_lng'>
			<a href='javascript:show_lng(1)'><img src='/img/icon/icon_lng.png'> <span id="select_language">한국어</span></a>
			<div id='change_lng' style='display: none; padding: 10px;'>
				<a href='javascript:change_lng(1)'>한국어</a> | <a href='javascript:change_lng(2)'>English</a> |  <a href='javascript:change_lng(3)'>日語</a> | <a href='javascript:change_lng(4)'>中國語</a> | <a href='javascript:change_lng(5)'>français</a> | <a href='javascript:change_lng(6)'>l’italiano</a> |<a href='javascript:change_lng(7)'>español</a> | <a href='javascript:change_lng(8)'>Deutsch</a> | <a href='javascript:change_lng(9)'>زبان عربی</a> | <a href='javascript:change_lng(10)'>Tiếng Việt</a>
				
				<script type="text/javascript">
	                $(document).ready(function(){
	                    var language = window.navigator.userLanguage || window.navigator.language;


	                    language = language.substring( 0, 2 );
	                    var select_contry  = Cookies.get("lang");


	                    if(select_contry ==""  || typeof(select_contry) == "undefined" ){
	                        // Get language
	                        $.get('/menu/get_lang',{
	                            lng_used: language,
	                        },function(data){
	                            var obj = $.parseJSON( data );
	                          $("#select_language").html(obj[0].lng_txt);
	                            Cookies.set("lang",obj[0].lng_num);
	                        });


	                    }else{
	                        $.get('/menu/get_lang',{
	                            lng_num: select_contry,
	                        },function(data){
	                               var obj = $.parseJSON( data );
	                               console.log(obj[0].lng_txt);
	                                $("#select_language").html(obj[0].lng_txt);



	                        });
	                    }
	                });
					function show_lng(){
						$('#change_lng').toggle();
					}
					function change_lng(val){
	                    Cookies.set("lang",val);
	                    location.reload(true);
					}
				</script>
			</div>
		</div>
	</div>
	<div id='front_page' class='con_area'>
		<div id='front_con1'>
			<?if($logo!='')echo '<img src="'.$logo.'" id="logo_img" style="width:200px; margin-bottom: 10px;">';?>
			<h1 id='re_title'><?echo $front_basic[0]->title;?></h1>
			<?echo nl2br($front_basic[0]->summary)?></p>
			<br/><br/>
			<div id='top_working_time'>
				<h3><?=$this->ez_front_model->site_trans("음식점 특징");?></h3>
				<?= $this->ez_front_model->menu_option($front_option);?>
				<br/><br/>

				<h3><?=$this->ez_front_model->site_trans("영업 시간");?></h3>

                <? if($front_time[0]->week_start!="" &&  $front_time[0]->week_done!=""){?>
				(<?=$this->ez_front_model->site_trans("주중");?>) <?=$front_time[0]->week_start;?> ~ <?=$front_time[0]->week_done;?><br/>
                <?}?>
                <? if($front_time[0]->weekend_start!="" &&  $front_time[0]->weekend_done!=""){?>
                    (<?=$this->ez_front_model->site_trans("주말");?>) <?=$front_time[0]->weekend_start;?> ~ <?=$front_time[0]->weekend_done;?><br/>
                <?}?>
                <?php
                    $holiday = $this->ez_front_model->get_week($front_holiday);
                ?>
                <? if($holiday){?>
				(<?=$this->ez_front_model->site_trans("휴일");?>) <?=$holiday;?>
                <?}?>
			</div>
			<br/><br/>
			<span style='width: 150px; height: 150px; background: #cdcdcd; margin-top: 20px; margin-bottom: 20px;'>
			
                <? 
                  $domain = urlencode("http://easymenu.kr/".$p_name);
                ?>
                <img src="/openpage/qrcode?data=<?=$domain;?>" />
			</span>
			<br/>
			<!--추가정보 출력 -->
			<?
				if(isset($origin_project)&& $origin_project!=''){
				echo '<h3>대표 사이트 : <a href="'.$origin_project.'" target="_blank">'.$origin_project.'</a></h3>';
			}
			?>
			<?
				if(isset($origin_project)){
				echo '<h3>연락처 : '.$contact.'</h3>';
			}
			?>
			<div id='front_bottom' class='bottom_con'>
				<img src='/img/top_logo.png' style='width: 150px;'/><br/>
				You can Quickly and easily create multilingual menus.
			</div>
		</div>
	</div>
	<?php
		//식당이 보유한 카테고리 정보 가져오기
		$list_cate =$this->ez_front_model->get_category($w_num);
		foreach ($list_cate as $cate_item){
			//print_r($cate_item);
			//카테고리넘버
			$cate_num = $cate_item['ct_num'];
			$ct_name = $cate_item['ct_name'];

			//카테고리에 해당하는 음식 정보 가져오기
			$list = $this->ez_front_model->get_match_set($w_num,$cate_num,$food_type);

			$list_count = count($list);
			//페이지 개수 올림 처리
			$cate_array = ceil($list_count/4);
			for($i=0;$i<$cate_array;$i++){
				//현재 페이지 최대값, 최소값 설정
				$pn_start=$i*4;
				$pn_end=(($i+1)*4);

	?>
	<div class='con_area'>
		<div id='top_area' style='text-align: left;'>
			<?if($logo!='')
				echo '<img src="'.$logo.'" id="logo_img" style="margin-left: 10px; height:40px; margin-bottom: 10px; vertical-align: middle;">';?>
			&nbsp;&nbsp;
			<b><?echo $title;?></b><br/>
		</div>
		<div style='width: 96%; padding: 2%;'>
			<span style='font-weight: bold; padding-right: 15px; border-bottom: 1px solid #cdcdcd; margin-bottom: 20px; padding-bottom: 10px; font-size: 20px; line-height: 30px;'>
				<?=$this->ez_front_model->site_trans($ct_name);?>
			</span><br/>

			<table id='con_table'style='margin-top: 30px;'>
			<?	
				//콘텐츠 호출 번호, 하단에서 증가
				$cate_con = 0;
				//카테고리에 해당하는 음식 정보 출력하기
				foreach ($list as $item){

					$food =$this->ez_front_model->get_food($item->f_num,"한국어");

					$food_item =$this->ez_front_model->get_food_item($item->f_num);
					$food_desc =$this->ez_front_model->get_food_comment($item->f_num,"한국어");
					$food_price = $this->ez_front_model->get_food_price($item->f_num,$w_num);
					$food_with = $this->ez_front_model->get_food_match($item->f_num);  // 궁합음식


					$set_check=count($food_set);
					$fd_price = 0;

					if($pn_start<=$cate_con && $cate_con<$pn_end){
			?>
				<tr>
					<td valign='top' style='width: 200px;'>
						<img src='<?=$food[0]->f_photo;?>' style='max-width: 180px; max-height: 180px;'><br/>
					</td>
					<td valign='top'>
						<p style='font-weight: bold; font-size: 15px; margin-bottom: 10px;'>
							<?=$food[0]->f_name;?>
						</p>
				        <? if($item->single_price==0){?>
					        <?php foreach ($food_price as $item){?>
					        	<?
					        		if($fd_price!=0){
					        			echo '&nbsp;&nbsp;|&nbsp;&nbsp;';
					        		}
					        		$fd_price++;
					        	?>
					            <b><?=$this->ez_front_model->site_trans($item->price_title);?></b>
						        <span class='price_st'>
						            <?=$item->price_value;?><?=$item->price_unit;?>
						        </span>
					        <?}?>
				        <?}else{?>
				            <?php
				               if($item->price_unit==""){
				                   $item->price_unit ="₩(KRW)";
				               }

				            ?>
				            <b><?=$this->ez_front_model->site_trans($item->price_title);?></b>
				            <p class='price_st'>
				                <?=$item->single_price;?><?=$item->price_unit;?>
				            </p>
				        <?}?>
				        <div class='menu_taste_area'>
					        <p class='menu_sub_info'>
					            <?=$food_item;?>
					            <?php
					                $food_tags = $this->ez_front_model->get_tag_food($food_with[0]->f_num);
					                if($food_tags!=''){
					                	echo ', '.$food_tags;
					                }
					            ?>
					        </p>
				            <?=$this->ez_front_model->site_trans("매운맛");?> <?=$food[0]->f_taste_hot;?> | <?=$this->ez_front_model->site_trans("단맛");?> <?=$food[0]->f_taste_sweet;?> | <?=$this->ez_front_model->site_trans("짠맛");?> <?=$food[0]->f_taste_salty;?> | <?=$this->ez_front_model->site_trans("신맛");?> <?=$food[0]->f_taste_acidic;?> | <?=$this->ez_front_model->site_trans("쓴맛");?> <?=$food[0]->f_taste_bitter;?> | <?=$this->ez_front_model->site_trans("현지인");?> <?=$food[0]->f_taste_local;?> | <?=$this->ez_front_model->site_trans("글로벌");?> <?=$food[0]->f_taste_global;?>
				        </div>
				        <span class='menu_dcs'>
							 <?=nl2br($food_desc[0]->f_txt);?>
						</span>
				        
				        <br/>
					</td>
				</tr>
				<tr>
					<td style='padding-bottom: 20px;'></td>
					<td></td>
				</td>
			
			
		<?
				}

				//콘텐츠 호출 증가
				$cate_con++;
			}
		?>
			</table>
	    </div>
	</div>
	<?
		}
		}
	?>
	
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