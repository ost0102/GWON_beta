<!DOCTYPE html>
<html lang='en'>
  <head>
	<meta charset='utf-8'>
	<title>Bootstrap WYSIWYG rich text editor from MindMup</title>

	<link href='/css/ez_layout.css' type='text/css' rel='stylesheet' media='screen and (min-width:600px)'/>
	<link href='/css/ez_layout_m.css' type='text/css' rel='stylesheet' media='screen and (max-width:599px)'/>
	<meta name='viewport' content='width=device-width, initial-scale=1.0' />
	<link href='/css/bootstrap_wysiwyg/prettify.css' rel='stylesheet'>
	<link href='/css/bootstrap_wysiwyg/bootstrap-combined.no-icons.min.css' rel='stylesheet'>
	<link href='/css/bootstrap_wysiwyg/bootstrap-responsive.min.css' rel='stylesheet'>
	<link href='/css/bootstrap_wysiwyg/font-awesome.css' rel='stylesheet'>
	<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js'></script>

	<script src='/css/bootstrap_wysiwyg/jquery.hotkeys.js'></script>
	<script src='/css/bootstrap_wysiwyg/bootstrap.min.js'></script>
	<script src='/css/bootstrap_wysiwyg/prettify.js'></script>
	<link href='/css/bootstrap_wysiwyg/index.css' rel='stylesheet'>
	<script src='/css/bootstrap_wysiwyg/bootstrap-wysiwyg.js'></script>
    	<link rel="stylesheet" href="/css/font.css" type="text/css"/>
	<!--modal창 관련 -->
	<script type='text/javascript' src='/js/jquery.simplemodal.js'></script>
	<script type='text/javascript'>
	//jQuery 있는 상태f
	window.onload=function(){
		include_value = 'no';
		$modal_state ='on';
		//변수를 넘겨받았는지 체크하기, 글을 불러오지 못했을경우, 다시 로드
		check_v = setInterval(check_include_value, 1000);
	};
	$(document).ready(function() {
		//scroll 변화시 작동하기
		//$('#bt_pf').hide();

		$('#show_wsw').hide();
		$('#con_html').hide();
		/*부모창 크기에 맞춰 수정창 높이 변경 시작*/
		//iframe 높이 측정
		var wsw_iframe_h = $('#wsw_iframe', parent.document).height()-220;  // 부모창에있는 아이프레임(클래스가 ifrm인) 높이 조절
            	setInterval(image_randering, 1000);
		//doc 크기 조정하기
		$('#editor').css('height',wsw_iframe_h);
		$('#editor').css('max-height',wsw_iframe_h);
		$('#con_html').height(wsw_iframe_h);
		/*부모창 크기에 맞춰 수정창 높이 변경 끝*/
		//alert(wsw_iframe_h);
		//기본 모달 출력
		$('#modal_content').modal();

		//$('#editor').css('max-height','800px');
		//$('#editor').css('height','1800px');
		//$('#wsw_iframe').contents().find('#con_html').height('800px');
		
	});
	function check_include_value(){
		//변수가 넘어왔는지 체크
		if(include_value == 'no'){
			check_value();
		}else{
			//함수 그만실행시키기
			clearInterval(check_v);
		}
		
	}
	function upload_img(dataUrl,img_type){
		//이미지가 저장되는 동안, 모달창 출력
		$('#modal_content').modal();
		//var url = '/code_test/makeimg/'+dataUrl;
		//window.open(url,'Edit code','width=500,height=430,left=0,top=0,scrollbars=no');
		// Set the content type header - in this case image/jpeg
		// Output the image
	            img_info_sp = dataUrl.split(',');
	            img_info = img_info_sp[1];
	            img_info2 = img_info_sp[0];

		$.post('/makepage/makeimg',{
	                    img_info: img_info,
	                    img_info2: img_info2,
	                    img_type: img_type
			},
		   function(data){
			if(!data){
				alert('이미지 용량을 줄인 후 업로드해주세요.');
				var img_selector = $('img[src="'+dataUrl+'"]');
				img_selector.remove();
				$.modal.close();
				$modal_state = 'off';
			}else{
				//#editor의 이미지 값 변경하기
				 var edit_txt = $('#editor').html();
				 var txt_replace = edit_txt.replace(dataUrl,data);
				 $('#editor').html(txt_replace);
				 //이미지가 저장되면, 모달창 닫기
				 $.modal.close();
				 $modal_state = 'off';
			}
		}); 
	}
	function show_html(val){
		if(val =='1'){
			//html 보기
			var edit_txt = $('#editor').html();
			$('#con_html').val(edit_txt);
			$('#con_html').hide();
			$('#editor').hide();
			$('#show_html').hide();
			$('#show_wsw').show();
			$('.btn-toolbar').hide();


			var now_w = $(parent.document).width();
				//alert(now_w);
			if(now_w<=500){
				//alert('test');
				//모바일 환경임. 모바일에서는 코드에디터가 안먹음.
				$('#con_html').show();
				
			}else{
				var con_html_h = $('#con_html').css('height');

				$('#value_load_check').after("<iframe src='/makepage/code_area2' width='98%' height='100%' id='code_area' marginwidth='0' marginheight='0'></iframe>");
				$('#code_area').css('height',con_html_h);
			}
			
		}else{
			//위지윅보기

			//코드 창 수정 내용 반영하기
			if ( $("#code_area").length > 0 ) {
				//do something
				var code_area = document.getElementById("code_area");
	            var code_area_doc = code_area .contentWindow || code_area .contentDocument;
	            code_area_doc.get_con();
			}
			

            //내용 반영하기
            var edit_txt = $('#con_html').val();
			$('#editor').html(edit_txt);
			$('#con_html').hide();
			$('#editor').show();
			$('#show_html').show();
			$('#show_wsw').hide();
			$('.btn-toolbar').show();

			//코드 창 삭제
			if ( $("#code_area").length > 0 ) {
				//do something
				$('#code_area').remove();
			}


		}
	}
	
	//초기 로딩 후 변수를 넘겨받았는지 체크하기
	function check_value(){
		//var edit_txt = $('#wsw_iframe').contents().find('#editor').html();
		
		//부모창  edit창 위치 파악하기
		if($('#saved_txt',parent.document).css('display')=='none'){
			var now_con_num = 'con_detail';
		}
		if($('#popup_bt_area',parent.document).html()){
			var popup_txt = 'y';
		}else{
			var popup_txt = 'n';
		}
		//페이지 생성/관리 - 콘텐츠 작성 단계에서 호출한것인지, 팝업 등 외부에서 호출 한 것인지 체크
		if(!now_con_num){
			if(popup_txt=='y'){
				//popup 공지 영역에서 위지윅 호출한 경우
				now_con = $('#popup_con_txt',parent.document).html();
				if(now_con ==''){
					now_con = '';
					$('#bt_reset').hide();
				}else{
					$('#bt_reset').show();
				}
				$('#editor').html(now_con);
				$('#value_load_check').val('done');
				//alert(now_con);
				//모래시계 닫기
				modal_off();
				include_value = 'Yes';
				now_load = 'popup_write';
				$('body').css('background-color','#34495e');
				$('#editor').css('background-color','#34495e');
				$('#con_html').css('background-color','#34495e');
				$('body').css('color','#ffffff');
				

				//popup에선 위지윅 사이즈 재 조정 필요
				var wsw_iframe_h = $('#wsw_iframe', parent.document).height()-350;  // 부모창에있는 아이프레임(클래스가 ifrm인) 높이 조절
				//doc 크기 조정하기
				$('#editor').css('height',wsw_iframe_h);
				$('#editor').css('max-height',wsw_iframe_h);
				$('#con_html').height(wsw_iframe_h);
			}else{
				//만약 saved_text 와 관련된 변수를 발견하지 못한다면..Open page에서 호출한 것! - 활성화 페이지에서 콘텐츠 수정을 위해 호출한 경우
				now_con = $('#open_con',parent.document).html();	
				$('#editor').html(now_con);
				$('#value_load_check').val('done');
				//alert(now_con);
				//모래시계 닫기
				modal_off();
				include_value = 'Yes';
				now_load = 'openpage';
				$('#bt_reset').show();

				var mobile_size_check = $('#wsw_iframe', parent.document).width();
				//alert(mobile_size_check);
				//모바일일때는 하단에 버튼이 안보임. 너비 넒게 하기
				if(mobile_size_check <400){
					//모바일 정도의 사이즈이면..
					var wsw_iframe_h = $('#wsw_iframe', parent.document).height()-200;  // 부모창에있는 아이프레임(클래스가 ifrm인) 높이 조절

					//호출된 위지윅에디터의 높이값에 맞춰 부모창의 아이프레임의 크기 조정하기
					var win_height = $(window).height()+150;
					$('#wsw_iframe', parent.document).height(win_height);
				}else{
					//데탑의 환경이라면..
					var wsw_iframe_h = $('#wsw_iframe', parent.document).height()-200;  // 부모창에있는 아이프레임(클래스가 ifrm인) 높이 조절
				}

				
				//doc 크기 조정하기
				$('#editor').css('height',wsw_iframe_h);
				$('#editor').css('max-height',wsw_iframe_h);
				$('#con_html').height(wsw_iframe_h);
			}
		}else{
			//saved_text 변수를 발견했다면.. make page에서 호출한 경우..
			//$('#input_txt1').html(edit_txt);
			var origin_value = $('#input_txt',parent.document).html();
			$('#editor').html(origin_value);

			var editor_value = $('#editor').html();
			if(origin_value == editor_value || origin_value ==''){
				//변수가 넘어왔으면, 모달창 닫기
				modal_off();
				include_value = 'Yes';
				now_load = 'makepage';
				if(origin_value !==''){
					$('#bt_reset').show();
				}

				$('#value_load_check').val('done');
			}
			

			var mobile_size_check = $('#wsw_iframe', parent.document).width();
			//alert(mobile_size_check);
			//모바일일때는 하단에 버튼이 안보임. 너비 넒게 하기
			if(mobile_size_check <400){
				//모바일 정도의 사이즈이면..
				var wsw_iframe_h = $('#wsw_iframe', parent.document).height()-350;  // 부모창에있는 아이프레임(클래스가 ifrm인) 높이 조절
			}else{
				//데탑의 환경이라면..
				var wsw_iframe_h = $('#wsw_iframe', parent.document).height()-160;  // 부모창에있는 아이프레임(클래스가 ifrm인) 높이 조절
			}
			//doc 크기 조정하기
			$('#editor').css('height',wsw_iframe_h);
			$('#editor').css('max-height',wsw_iframe_h);
			$('#con_html').height(wsw_iframe_h);
		}
		//코드와 관련된 값이 있는지 체크하기
		var now_con = $('#editor').html();
		check_dev(now_con);
		//alert('저장이 완료되었습니다.');
	}
	//현재 호출된 위지윅 문서에 코드가 섞여있는지 체크
	function check_dev(now_con){
		//alert(now_con);
		//체크 기준은 javascript, style, class, id 등의 유무
		if(now_con.match("javascript") || now_con.match("<script") || now_con.match("<style") || now_con.match("class") || now_con.match("id")){
			//alert("포함됐네");
			var al_txt = '수정하려는 문서에 개발자 작성 코드가 발견되었습니다.<br/>개발자가 작성한 문서라면, 담당자를 통해 변경하시거나 <a href="/docs/price_skill" target="_blank">기술 지원</a>을 요청하지 않을 경우, 기존 틀이 깨질 수도 있습니다.<br/>';
			$('#alert_txt').html(al_txt);
			$('#alert_area').slideDown();

			//위지윅 에디터 높이 조정
			var mobile_size_check = $('#wsw_iframe', parent.document).width();
			//alert(mobile_size_check);
			//모바일일때는 하단에 버튼이 안보임. 너비 넒게 하기
			if(mobile_size_check <400){
				//모바일 정도의 사이즈이면..
				var wsw_iframe_h = $('#wsw_iframe', parent.document).height()-300;  // 부모창에있는 아이프레임(클래스가 ifrm인) 높이 조절
			}else{
				//데탑의 환경이라면..
				var wsw_iframe_h = $('#wsw_iframe', parent.document).height()-150;  // 부모창에있는 아이프레임(클래스가 ifrm인) 높이 조절
			}
			//doc 크기 조정하기
			$('#editor').css('height',wsw_iframe_h-120);
			$('#editor').css('max-height',wsw_iframe_h-120);
			$('#con_html').css('height',wsw_iframe_h-120);
			$('#con_html').css('max-height',wsw_iframe_h-120);

			var edit_txt = $('#editor').html();

			show_html(1);
			/*$('#con_html').val(edit_txt);
			$('#editor').slideUp();
			$('#con_html').slideDown();
			$('.btn-toolbar').hide();
			$('#show_html').hide();
			$('#show_wsw').show();
			*/
		}
	}
	function close_alert(){
		$('#alert_area').slideUp();
		//위지윅 에디터 높이 조정
		var mobile_size_check = $('#wsw_iframe', parent.document).width();
		//alert(mobile_size_check);
		//모바일일때는 하단에 버튼이 안보임. 너비 넒게 하기
		if(mobile_size_check <400){
			//모바일 정도의 사이즈이면..
			var wsw_iframe_h = $('#wsw_iframe', parent.document).height()-300;  // 부모창에있는 아이프레임(클래스가 ifrm인) 높이 조절
		}else{
			//데탑의 환경이라면..
			var wsw_iframe_h = $('#wsw_iframe', parent.document).height()-150;  // 부모창에있는 아이프레임(클래스가 ifrm인) 높이 조절
		}
		//doc 크기 조정하기
		$('#editor').css('height',wsw_iframe_h);
		$('#editor').css('max-height',wsw_iframe_h);
		$('#con_html').css('height',wsw_iframe_h);
		$('#con_html').css('max-height',wsw_iframe_h);
	}
	//콘텐츠 정보를 DB에 저장된 값을 다시 가져오기
	function reset_con(){
		if(now_load == 'makepage'){
			//부모창  edit창 위치 파악하기
			for(var i=1; i<=10;i++){
				if($('#saved_txt'+i,parent.document).css('display')=='none'){
				var con_num = i;
				}
			}
			var p_num = $('#w_num',parent.document).val();
			var where_call = 'makepage';
			var pop_id = '';

		}else if(now_load == 'openpage'){
			//변수 p_num, 콘텐츠 위치 정보
			var where_call = 'openpage';
			var p_num = $('#p_num',parent.document).val();
			var con_num = $('#con_num',parent.document).val();
			var pop_id = '';
			
		}else if(now_load == 'popup_write'){
			//로드 위치가 오픈 페이지라면..
			var where_call = 'popup_write';
			var pop_id = $('#pop_id',parent.document).val();
			var p_num = '';
			var con_num = '';

		}
		
		$.post("/makepage/reset_wgw_con",{
			where_call: where_call,
			pop_id: pop_id,
			p_num: p_num,
			con_num: con_num
			},
		   function(data){
			 //alert(data);
			 $('#editor').html(data);
			 $('#con_html').val(data);
		});
		
	}

	//부모창으로 변수 보내기
	function save_txt(){
		//var edit_txt = $('#wsw_iframe').contents().find('#editor').html();
		if($('#editor').css('display')=='none'){
			//alert('위지윅 화면');
			//코드 창 수정 내용 반영하기
			if ( $("#code_area").length > 0 ) {
				//do something
				var code_area = document.getElementById("code_area");
	            var code_area_doc = code_area .contentWindow || code_area .contentDocument;
	            code_area_doc.get_con();
			}
			var edit_txt = $('#con_html').val();
		}else{
			var edit_txt = $('#editor').html();
		}
        		//이모지 제거 - 글자깨지면 저장안되는 것 해결
		edit_txt = removeEmojis(edit_txt);
		//로드 위치가 메이크 페이지라면..
		if(now_load == 'makepage'){
			//부모창  edit창 위치 파악하기
			if($('#saved_txt',parent.document).css('display')=='none'){
				var now_con_num = 'makepage';
			}
			
			//$('#input_txt1').html(edit_txt);
			$('#input_txt',parent.document).html(edit_txt);
			$('#saved_txt',parent.document).html(edit_txt);
			$('#saved_txt',parent.document).show();
			top.save_con();
			$('#wsw_iframe',parent.document).remove();
		}else if(now_load == 'openpage'){
			//로드 위치가 오픈 페이지라면..
			$('#open_con',parent.document).html(edit_txt);
			//$('#open_con',parent.document).show();
			//부모창 자바스크립트 실행하기
			top.openpage_edit_con();			
		}else if(now_load == 'popup_write'){
			//로드 위치가 오픈 페이지라면..
			$('#popup_txt',parent.document).html(edit_txt);
			$('#popup_con_txt',parent.document).html(edit_txt);
			
			//$('#open_con',parent.document).show();
			//부모창 자바스크립트 실행하기
			top.save_popup();		
		}
		
		
		//alert('저장이 완료되었습니다.');
	}

        //이모지 제거
        function removeEmojis (str) {
          const regex = /(?:[\u2700-\u27bf]|(?:\ud83c[\udde6-\uddff]){2}|[\ud800-\udbff][\udc00-\udfff]|[\u0023-\u0039]\ufe0f?\u20e3|\u3299|\u3297|\u303d|\u3030|\u24c2|\ud83c[\udd70-\udd71]|\ud83c[\udd7e-\udd7f]|\ud83c\udd8e|\ud83c[\udd91-\udd9a]|\ud83c[\udde6-\uddff]|\ud83c[\ude01-\ude02]|\ud83c\ude1a|\ud83c\ude2f|\ud83c[\ude32-\ude3a]|\ud83c[\ude50-\ude51]|\u203c|\u2049|[\u25aa-\u25ab]|\u25b6|\u25c0|[\u25fb-\u25fe]|\u00a9|\u00ae|\u2122|\u2139|\ud83c\udc04|[\u2600-\u26FF]|\u2b05|\u2b06|\u2b07|\u2b1b|\u2b1c|\u2b50|\u2b55|\u231a|\u231b|\u2328|\u23cf|[\u23e9-\u23f3]|[\u23f8-\u23fa]|\ud83c\udccf|\u2934|\u2935|[\u2190-\u21ff])/g;
          return str.replace(regex, '');
        }
        //본문에서 붙여넣기로 이미지를 넣은 경우, 업로드 되도록 변경
        function image_randering(){
            //현재 저장하려는 콘텐츠를 #editor에 반영하기
            //alert(con);
            //에디터 내 이미지 요소 가져오기
            $('#editor img').each(function() {
                var dataUrl = $(this).attr("src");
                if(typeof dataUrl == "undefined" || dataUrl == null || dataUrl == ""){

                }else{
                    //alert(dataUrl);
                    if(dataUrl.indexOf( 'image/gif' )>0||dataUrl.indexOf( 'image/GIF' )>0){
                        var img_type = 'gif';
                    }else if(dataUrl.indexOf( 'image/PNG' )>0 || dataUrl.indexOf( 'image/png' ) > 0){
                        var img_type = 'png';
                    }else{
                        var img_type = 'other';
                        //alert(dataUrl);
                        //alert(img_type);
                    }

                    if(dataUrl.indexOf("/uploads/") !== -1){
                        //alert(dataUrl);
                        //alert(img_type);
                        //기존에 이미 업로드된 이미지임
                    }else if(dataUrl.indexOf("base64") !== -1){
                        //upload 이미지에 대한 처리
                        upload_img(dataUrl,img_type);
                    }else{
                        //외부 사이트 이미지의 경우 별도 처리안함
                        //upload_img(dataUrl,img_type);
                    }
                }
            });
        }
	
	//모달창 닫기
	function modal_off(){
		if($modal_state == 'on'){
			$.modal.close();
			$modal_state = 'off';
		}
	}
        //업로드 이미지
        function upload_con_image(){
            window.open('/upload/up1/14','upload_img','width=500,height=430,left=0,top=0,scrollbars=no');
        }
	</script>
	<style>
	        .btn-group{
		margin-bottom: 5px;
		margin-left: 0px;
		margin-right: 5px;
	        }
	        .btn-group+.btn-group{
	            margin-left: 0px;
	            
	        }
	        /* modal 창 관련 */
		#simplemodal-overlay {
			background-color:#000;
		}
		#modal_content{
			display:none;
			margin:50 auto;
			width:300px;
			height:200px;
			/*background:#fff;*/
			background:#ffffff;
		}
		#modal_txt{
			font-size: 15px;
			font-weight: bold;
			width: 100%;
			margin-top: 70px;
			height: 90px;
			float:left;
			text-align: center;

		}
		#login_close{
			float:left;
			height: 30px;
			margin-bottom: 10px;
			width: 100%;
			text-align: center;
		}
		#bt_reset{
			display: none;
		}
		#alert_area{
			display: none;
			width: 96%;
			background: yellow;
			padding: 2%;
			text-align: center;
			position : fixed;
			z-index: 500;
		}
		#alert_txt{
			width: 100%;
			text-align: left;
			margin-bottom: 20px;
		}
		#toolbars2{
	             width: 100%;
	             clear: both;
	             float: left;
	             margin-bottom: 5px;
		}
		
		@media (max-width:300px) {
			.mobile_hidden{
				display: none;
			}
			.btn {
			    display: inline-block;
			    padding: 3px 5px;
			    margin-bottom: 0;
			}
			#toolbars2{
		             width: 100%;
		             clear: both;
		             float: left;
		             margin-bottom: 10px;
		             margin-top: 0px;
			}
				
		    }
		/*
		
	    @media screen and (min-width:800px) {
			.btn-group{
				display: block;
			}
	    }
		*/
		#con_html{
			background: #000000;
			color: #ffffff;
		}
		#code_area{
			visibility: visible;
			height: 0px;
		}

	</style>
 </head>
  <body>
  	<div id='alert_area'><div id='alert_txt'></div><a onclick='close_alert();'><b>닫기</b></a></div>
	<div class='btn-toolbar' data-role='editor-toolbar' data-target='#editor' style='margin-top: 30px;'>
	  <div id='toolbars1' class='' style='width: 100%; clear: both; float: left;'>
		 	<!--
			-->
		  <div class='btn-group'>
			<a class='btn dropdown-toggle' data-toggle='dropdown' title='Font'><i class='icon-font'></i><b class='caret'></b></a>
			  <ul class='dropdown-menu'>
			  </ul>
		</div>

		  <div class='btn-group'>
		  	<a class="btn" data-edit="removeFormat" title="Remove font-color"><img src='/img/icon/eraser.png' style='width: 15px;'></a>
			  <a class='btn dropdown-toggle' data-toggle='dropdown' title='Change font-color'><img src='/img/icon/font_color.png' style='width: 15px;'></a>
				<div id='color_pallet_area' class='dropdown-menu input-append' style='padding: 10px;'>
					<style>
					#toolbars1 .btn, #toolbars2 .btn{
						text-shadow: none;
						background: #fff;
						color: #3b3b3b;
					}
					#toolbars1 .btn-info, #toolbars2 .btn-info{
						color: #195cc1;
					}
					#color_pallet_area{
						width: 100px;
						float: left;
					}
					.color_pallet{
						width: 20px;
						height: 20px;
						float: left;
					}
					</style>
					<?
					$color_arr = array('#000000', '#424242', '#636363', '#9C9C94', '#CEC6CE', '#EFEFEF', '#F7F7F7', '#FFFFFF',
							'#FF0000', '#FF9C00', '#FFFF00', '#00FF00', '#00FFFF', '#0000FF', '#9C00FF', '#FF00FF',
							'#F7C6CE', '#FFE7CE', '#FFEFC6', '#D6EFD6', '#CEDEE7', '#CEE7F7', '#D6D6E7', '#E7D6DE',
							'#E79C9C', '#FFC69C', '#FFE79C', '#B5D6A5', '#A5C6CE', '#9CC6EF', '#B5A5D6', '#D6A5BD',
							'#E76363', '#F7AD6B', '#FFD663', '#94BD7B', '#73A5AD', '#6BADDE', '#8C7BC6', '#C67BA5',
							'#CE0000', '#E79439', '#EFC631', '#6BA54A', '#4A7B8C', '#3984C6', '#634AA5', '#A54A7B',
							'#9C0000', '#B56308', '#BD9400', '#397B21', '#104A5A', '#085294', '#311873', '#731842',
							'#630000', '#7B3900', '#846300', '#295218', '#083139', '#003163', '#21104A', '#4A1031');
					
					foreach ($color_arr as $key) {
						echo '<a data-edit="foreColor '.$key.'" title="Use Red Color"><div class="color_pallet" style="background: '.$key.'"></div></a>';
					}
					?>
				</div>
		  </div>
		  <div class='btn-group'>
			<a class='btn dropdown-toggle' data-toggle='dropdown' title='Font Size'><i class='icon-text-height'></i>&nbsp;<b class='caret'></b></a>
			  <ul class='dropdown-menu'>
			  <li><a data-edit='fontSize 5'><font size='5'>Huge</font></a></li>
			  <li><a data-edit='fontSize 3'><font size='3'>Normal</font></a></li>
			  <li><a data-edit='fontSize 1'><font size='1'>Small</font></a></li>
			  </ul>
		  </div>
		  <div class='btn-group'>
			<a class='btn' data-edit='bold' title='Bold (Ctrl/Cmd+B)'><i class='icon-bold'></i></a>
			<a class='btn' data-edit='italic' title='Italic (Ctrl/Cmd+I)'><i class='icon-italic'></i></a>
			<a class='btn' data-edit='strikethrough' title='Strikethrough'><i class='icon-strikethrough'></i></a>
			<a class='btn' data-edit='underline' title='Underline (Ctrl/Cmd+U)'><i class='icon-underline'></i></a>
		  </div>

		  <div class='btn-group'>
			<a class='btn' data-edit='insertunorderedlist' title='Bullet list'><i class='icon-list-ul'></i></a>
			<a class='btn' data-edit='insertorderedlist' title='Number list'><i class='icon-list-ol'></i></a>
			<a class='btn' data-edit='outdent' title='Reduce indent (Shift+Tab)'><i class='icon-indent-left'></i></a>
			<a class='btn' data-edit='indent' title='Indent (Tab)'><i class='icon-indent-right'></i></a>
		  </div>
		  <div class='btn-group'>
			<a class='btn' data-edit='justifyleft' title='Align Left (Ctrl/Cmd+L)'><i class='icon-align-left'></i></a>
			<a class='btn' data-edit='justifycenter' title='Center (Ctrl/Cmd+E)'><i class='icon-align-center'></i></a>
			<a class='btn' data-edit='justifyright' title='Align Right (Ctrl/Cmd+R)'><i class='icon-align-right'></i></a>
			<a class='btn' data-edit='justifyfull' title='Justify (Ctrl/Cmd+J)'><i class='icon-align-justify'></i></a>
		  </div>

	  </div>
	  <!--버튼 두줄만들기-->
	  <div id='toolbars2'>
		  <div class='btn-group'>
			  <a class='btn dropdown-toggle' data-toggle='dropdown' title='Hyperlink'><i class='icon-link'></i></a>
				<div class='dropdown-menu input-append' style='padding: 10px;'>
					<input class='span2' placeholder='URL' type='text' data-edit='createLink'/>
					<button class='btn' type='button'>Add</button>
				</div>
			<a class='btn' data-edit='unlink' title='Remove Hyperlink'><i class='icon-cut'></i></a>
		  </div>
		  
		  <div class='btn-group'>
			<a class='btn' title='Insert picture (or just drag & drop)' id='pictureBtn'><i class='icon-picture'></i></a>
			<input id='img_data'type='file' data-role='magic-overlay' data-target='#pictureBtn' data-edit='insertImage' />
		  </div>
		  
	          <div class='btn-group'>
	            <a class='btn' href="javascript:upload_con_image();"title='Insert picture (or just drag & drop)' id='pictureBtn'><i class='icon-picture'></i></a>
	            <input id='img_data'type='file' data-role='magic-overlay' data-target='#pictureBtn' data-edit='insertImage' />
	          </div>
		  <div class='btn-group'>
			<a class='btn' data-edit='undo' title='Undo (Ctrl/Cmd+Z)'><i class='icon-undo'></i></a>
			<a class='btn' data-edit='redo' title='Redo (Ctrl/Cmd+Y)'><i class='icon-repeat'></i></a>
		  </div>
		  <!--목소리 입력기능
		  <input type='text' data-edit='inserttext' id='voiceBtn' x-webkit-speech=''>-->
	  </div>
    	</div>
	<div id='alerts' ></div>
    <div id='editor'></div>
    <input type='hidden' id='value_load_check'/>
    <textarea id='con_html' style='width: 95%; height: 250px;'></textarea>
	<div id='wgw_bt_left'>
		<a id='show_html' class='btn btn-success' onclick='show_html(1);' >html</a>
		<a id='show_wsw' class='btn btn-success' onclick='show_html(2);'>위지윅</a>
		<a id='bt_reset' class='btn btn-success' onclick='reset_con();'>초기화</a>
	</div>
	<div id='wgw_bt_right'>
		<a id='bt_save' class='btn btn-info' onclick='save_txt();'>저장하기</a>
	</div>
	<!--모달창 출력부분 시작-->
<div id='modal_content'>
	 <div id='modal_txt'>
		<img src='/img/loading.gif' style='width: 70px; '>
	</div>
</div>
<!--모달창 출력부분 끝 -->
<script type='text/javascript'>
  $(function(){
    function initToolbarBootstrapBindings() {
            var fonts = ['Noto Sans KR','Do Hyeon','Nanum Pen Script','Noto Serif KR','Black Han Sans','Gugi','Cute Font','Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                    'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                    'Times New Roman', 'Verdana'],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
        $.each(fonts, function (idx, fontName) {
            fontTarget.append($('<li><a data-edit="fontName ' + fontName +'" style="font-family:\''+ fontName +'\'">'+fontName + '</a></li>'));
        });
      $('a[title]').tooltip({container:'body'});
    	$('.dropdown-menu input').click(function() {return false;})
		    .change(function () {$(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');})
        .keydown('esc', function () {this.value='';$(this).change();});

      $('[data-role=magic-overlay]').each(function () { 
        var overlay = $(this), target = $(overlay.data('target')); 
        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
      });
      if ('onwebkitspeechchange'  in document.createElement('input')) {
        var editorOffset = $('#editor').offset();
        $('#voiceBtn').css('position','absolute').offset({top: editorOffset.top, left: editorOffset.left+$('#editor').innerWidth()-35});
      } else {
        $('#voiceBtn').hide();
      }
	};
	function showErrorAlert (reason, detail) {
		var msg='';
		if (reason==='unsupported-file-type') { msg = 'Unsupported format ' +detail; }
		else {
			console.log('error uploading file', reason, detail);
		}
		$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
		 '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
	};
    initToolbarBootstrapBindings();  
	$('#editor').wysiwyg({ fileUploadError: showErrorAlert} );
    window.prettyPrint && prettyPrint();
  });


	function check_creat_link(val){
		$('#editor a').each(function() {
			var now_target = $(this).attr('target');
			var now_con_txt = $(this).attr('href');
			//새로 추가한 링크와 에디터 본문에서 추가한 링크가 같은 경우, 새창 추가하는 코드 넣기
			if(now_con_txt==val){
				if(!now_target){
					$(this).attr('target','_blank');
				}
			}
		});
	}
	
</script>
</body>
</html>