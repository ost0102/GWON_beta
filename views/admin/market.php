<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<?$this->load->view('/include/head_info');?>
<!--document 영역 style -->
<link href='/css/doc_style.css' rel='stylesheet' />
<script type='text/javascript'>
	//jQuery 있는 상태
	window.onload=function(){
        check_con_div();
		check_w_mode();
	};

	$(document).ready(function() {
		time_graph();
		check_update_page();
		setInterval(function() {
			time_graph();
			check_update_page();
		}, 600000); 
		/* 

		modal창의 콘텐츠에서 클릭해도 창이 없어지지 않도록 하려면...
		 $('body').click(function(){
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
		 $('#m_close').click(function(){
		  $.modal.close();
		  $modal_state ='off';
		 });
		
		 $modal_state ='off';

		//Event 정보 가져오기
        $('#datepicker_main').change(function(){
        	var s_date = $('#datepicker_main').val();
        	var s_date_sp = s_date.split( '-' );
        	var s_date_f = s_date_sp[0] + s_date_sp[1] + s_date_sp[2];
        	//alert(s_date_f);
          	location.href = "/admin/main/"+s_date_f;
        });
	});
	function time_graph(){
	   window.now_date = '_'+$('#datepicker_main').val();
	   if(now_date=='all'){
	   		now_date = '';
	   }
		if ($("#grp_iframe").length > 0){
			//$('#graph_area').html("<iframe id='grp_iframe' class='grp_iframe' src='/mypage/show_graph/All_2_"+now_date+"' width='100%' scrolling='no' frameborder='0'></iframe>");
			$('#grp_iframe').attr('src','/mypage/show_graph/All_2'+now_date);
		//do something
		}else{
			$('#graph_area').html("<iframe id='grp_iframe' class='grp_iframe' src='/mypage/show_graph/All_2"+now_date+"' width='100%' scrolling='no' frameborder='0'></iframe>");
		}
	}
	function check_update_page(){
		var update_page = $('#update_page').html();
		

		$.get("/openpage/admin_update_check",function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#update_page').html(data);
	   });
	}
</script>
</head>
<body>
<div id=right_top_shape>
	<a href='http://intropage.net/page'><img src='/img/land/right_top_shape.png' class='logo_shape'></a>
</div>
<div id='container'>
	<div class='menu_left'>
		<div id=menu_area>
			<!-- sub_top area include -->
			<?$this->load->view('/include/sub_top');?>
			<!-- menu area 시작 -->
			<?$this->load->view('/include/left_menu');?>
			<!-- menu area 끝 -->
		</div>
		<div class='bt_sub'>
			
		</div>
	</div>
	</div>
	<div class='contents'>
		<!--상단영역 -->
		<?$this->load->view('/include/top_area');?>
		<!--상단영역 끝-->
		<!--콘텐츠 영역 -->
		<div id='content_area'>
        				<!-- Contents Area Start -->
				<div id='con_area'>
					<div id='con_main'>
        	<?$this->load->view('/include/admin_menu');?>
        	<!--
	        <table class="admin_table"  border="1">
	        <tbody>
	        <tr> 
	        
	        <th>제목</th>
	        <th >컨트롤러</th>
	        <th>url</th>
	        <th>사용자</th>
	        <th>아이콘</th>
	        <th>수정</th>
	        </tr>
	        
	        <? foreach($data as $item){?>
	        <tr>
	        <td><?=$item->mk_title;?></td>
	        <td><?=$item->mk_cotroll;?></td>
	        <td><?=$item->mk_dir;?></td>
	        <td><?=$item->mk_reg_id;?></td>
	        <td><img src="/uploads/market_icon/<?=$item->mk_icon;?>" width="70"></td>
	        <td>
	        <a href="/admin/market_edt/<?=$item->mk_idx;?>">[수정]</a>
	        <a style="color: red;" onclick="market_delete('<?=$item->mk_title;?>','<?=$item->mk_idx;?>');">[삭제]</a>
	        </td>
	        </tr>
	        <?}?>
	        
	         </table>
	         New table<br/>
	   		  -->
	   		<h1>
                앱 마켓 관리
            </h1>
	        <table class="admin_table"  border="1">
		        <tbody>
			        <tr> 
			        	<th>제목</th>
				        <th >앱 정보</th>
				        <th>아이콘</th>
				        <th>변경</th>
			        </tr>
			        
			        <? foreach($data as $item){?>
			        <tr>
				        <td>
				        	<?echo $item->mk_title;?>
				        </td>
				        <td align='left'>
				        	컨트롤러 : <?echo $item->mk_cotroll;?><br/>
				        	URL : <a href='<?echo $item->mk_dir;?>' target='_blank'><?echo $item->mk_dir;?></a>
				        </td>
				        <td>
				        	<img src="/uploads/market_icon/<?=$item->mk_icon;?>" width="70">
				        </td>
				        <td>
				        	<a href="/admin/market_edt/<?=$item->mk_idx;?>">[수정]</a>
				       		<a style="color: red;" onclick="market_delete('<?=$item->mk_title;?>','<?=$item->mk_idx;?>');">[삭제]</a>
				        </td>
			        </tr>
			        <?}?>
	        </table>
	        <!-- 하단 버튼 영역 -->
	        <div class='admin_page_num'>
	         
	        </div>
        </div>
        <button onclick='location.href="/admin/market_ins";' class='btn btn-info'>앱 추가하기</button>
       
        </div> 
        	<!--콘텐츠 영역 끝 -->
	</div>
</div>
</div>
<div id='modal_content'>
	 <div id='modal_txt'>
		<!--내용 출력부분 시작-->
		이곳에 내용 출력
	</div>
	<div id=login_close>
		<a onClick='modal_off()'><img src='/img/land/bt_close.png'></a>
	</div>
</div>
<!--모달창 출력부분 끝 -->
<!--modal창 관련 -->
<script type='text/javascript' src='/js/jquery.simplemodal.js'></script>
<script>
 function market_delete(title,mk_idx){
    if(confirm(title+' 삭제하시겠습니까?')==true){
        
        location.href='/admin/market_act?mode=delete&mk_idx='+mk_idx;
    }
 }
</script>
</body>
</html>