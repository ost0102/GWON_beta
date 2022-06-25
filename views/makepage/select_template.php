<style>
	@media only screen and (min-width: 321px) {
		#simplemodal-container{
			width: 300px;
			height: 400px;
		}
		#modal_content{
			display:none;
			margin-left: auto;
			margin-right: auto;
			width: 250px;
			height: 210px;
			/*background:#fff;*/
			background:#ffffff;
			
			-webkit-overflow-scrolling: touch;
		}

		#modal_txt{
			float:left;
			font-size: 15px;
			font-weight: bold;
			width: 250px;
			height: 75px;
			margin-top: 70px;
			margin-bottom: 0px;
			text-align: center;

		}

	}
	/*mobile용*/
	@media only screen and (max-width: 320px) {
		#simplemodal-container{
			width: 300px;
			height: 400px;
		}
		#modal_content{
			display:none;
			margin:50 auto;
			width: 250px;
			height: 210px;
			/*background:#fff;*/
			background:#ffffff;
			
			-webkit-overflow-scrolling: touch;
		}

		#modal_txt{
			float:left;
			font-size: 15px;
			font-weight: bold;
			width: 100%;
			margin-top: 30px;
			margin-bottom: 30px;
			text-align: center;

		}
	}
	
	#template_area{
		width: 100%;
		font-weight: bold; 
		padding-left: 10px; 
		padding-right: 10px; 
		overflow-y: scroll;

		-webkit-overflow-scrolling: touch;
	}
	.cate_div{
		float: left; 
		margin-right: 10px; 
		margin-bottom: 5px; 
		padding: 5px; 
		text-align: center;
		/*cursor: pointer;*/
	}
	.img_st{
		border: 1px solid #cdcdcd;
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
		float:left; 
		width: 90%;
		padding-left: 5%;
		padding-right: 5%;
		text-align:center;
	}
</style>
<script type="text/javascript">
	//모달창 상단 여백 조정하기
	var modal_top = $('#simplemodal-container').css('top');
	var check_height = $('#modal_content').height();
	var win_height = $(window).height();
	var check_top = win_height-check_height;
	var resize_margin = parseInt(check_top/2);
	if(check_top < 140){
		$('#simplemodal-container').css('top',resize_margin);
	}
	//모달창 좌우 여백 조정하기
	var win_w = $(window).width();
	var check_width = $('#simplemodal-container').width();
	var modal_left = win_w-check_width;
	var reposition_left = parseInt(modal_left/2)-40;
	//alert(modal_left);
	$('#simplemodal-container').css('left',reposition_left);


	/**Select Template 관련**/
	//Category 선택 시 관련해서 액션일어나도록..
	function select_template(tem_id){
		var tem_id = tem_id;
		var w_num = '<?echo $w_num;?>';
		
		$.post("/makepage/selected_template",{
			tem_id: tem_id,
			w_num: w_num
		},
		function(data){
		//alert(data);
		//입력값 초기화하기
		if(data ==1){
			//alert("템플릿 설정이 완료되었습니다.");
			//location.replace('/makepage/edit_code/1');
			//alert('선택한 템플릿으로 디자인이 변경됩니다.');
			//location.reload();
			var con_txt = "템플릿 설정이 완료되었습니다. ";
			open_modal(con_txt);

			con_iframe.location.reload(true);
			//parent.close(); 
			//check_modal();
		 }else{
			alert("변경 권한이 없거나 해당 파일을 읽을 수 없습니다.");
		 }
		});
	}

</script>
<?
if(isset($tamplate)){
	//print_r($linked_info);
	foreach ($tamplate as $tamplate)
	{
		//print_r($row);
		//class_no가 없을 경우 최근 값을 가져와라
		$tem_id = $tamplate['tem_id'];
		$tem_title = $tamplate['tem_title'];
		$made_user = $tamplate['made_user'];
		$img_url = $tamplate['img_url'];
		echo '<div id="html_type_'.$tem_id.'" class="template_img_area">
				<a href="javascript:select_template('.$tem_id.')"><img src="'.$img_url.'" class="img_st" title="'.$tem_title.'" style="width: 90%;"></a><br/>
				'.$tem_title.'
			</div>';
	}
}else{
	echo '연결된 템플릿 정보가 없습니다.<br/>';
}
?>