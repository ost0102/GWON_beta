<style>
	#modal_content{
		display:none;
		margin:50 auto;
		width:310px;
		height:250px;
		/*background:#fff;*/
		background:#ffffff url(/img/land/bg_modal.jpg) no-repeat right top;
		filter:alpha(opacity=85);
		opacity: 0.85; 
		-moz-opacity:0.85
	}
	#modal_txt{
		float:left;
		font-size: 15px;
		font-weight: bold;
		width: 100%;
		margin-top: 30px;
		margin-bottom: 30px;
		height: 180px;
		text-align: center;

	}
	.select_1{
		display: inline-block; 
		cursor: pointer;
		text-align: center;
		background: #c1dddd;
		width:100%;
		margin-bottom: 20px;
		padding-top:20px;
		padding-bottom: 20px;
	}
	.select_2{
		display: inline-block; 
		text-align: center;
		width:100%;
		margin-bottom: 20px;
		padding-top:10px;
		padding-bottom: 10px;
	}
	#login_close{
		clear: both;
		height: 30px;
		margin-top: 10px;
		margin-bottom: 10px;
		width: 100%;
		text-align: center;
	}
	#con_html{
		display: inline-block; 
		width: 80%;
		text-align:center;
	}
</style>
<script>
	//Category 선택 시 관련해서 액션일어나도록..
	function select_next(type){
		var type = type;
		var p_num = '<?if (isset($p_num)){echo $p_num;}?>';
		var page_secur = '<?if (isset($page_secur)){echo $page_secur;}?>';
		
		if(type==1){
			//location.href='/makepage2/write_summary/'+p_num;
			//modal 창 없애고, 콘텐츠 타이틀 영역 로드하는 것으로 변경하기
			check_modal();
			/*
			$.get('/makepage/con_detail/'+page_secur,function(data,status){
				//alert('Data: ' + data + '\nStatus: ' + status);
				//open_modal(data);
				$('html, body').animate( {scrollTop:0} );
				$('#con_area').html(data);
				$('#con_area').hide();
				$('#con_area').fadeIn('slow');
				//$('#login_close').show();
			});

			
			//URL 변경하기
			url=location.href;
			if(url.indexOf('?_escaped_fragment_=')!=-1){
				//주소줄 인코딩 됐을 경우 #! 이 변경되었을 경우
				url=url.replace('?_escaped_fragment_=', '#!');
				location.href = url;
			}
			//주소줄 인코딩 됐을 경우 #! 이 변경되었을 경우
			u_filter_origing = url.split('#!');
			basic_url = u_filter_origing[0];
			u_filter = u_filter_origing[1];
			location.href = basic_url+'#!2';
			*/
			
		}else{
			location.href='/makepage/add_other/'+page_secur;
		}
	}
</script>
<!-- make step bar area include -->
<div id='con_html'>
	<h3>본문 구성하기</h3>
	<span style='font-weight: nomal; margin-bottom: 15px; font-size: 11px; line-height: 13px;'>
		식당 소개글과 메뉴를 추가해주세요.
	</span>
	<hr style='margin-top:10px; margin-bottom: 10px;'/>
	<div id='html_type_1' class='select_1' onclick='select_next("1")'>
		<?
		if(isset($con_title)&&$con_title!=''){
			echo '본문 수정하기';
		}else{
			echo '본문 구성하기';
		}
		?>
	</div>
	<div class='select_2'>
		<a onclick='select_next("2")'><span style='font-weight: nomal; margin-bottom: 15px; font-size: 11px; line-height: 13px; color: #cdcdcd;'>나중에 입력하기</span></a>
	</div>
</div>