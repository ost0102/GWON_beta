<!--link href="css/screen_origin.css" type="text/css" rel="stylesheet" media="screen,projection" /-->
<script type="text/javascript">
	//jQuery 있는 상태
	window.onload=function(){
	    //$('#sc2_2').hide();

	    $(window).scroll(function(){
	        var scr_now = $(document).scrollTop();
	        //현재 스크롤
	        //alert(scr_now);


	    });
	};
	$(document).ready(function() {
	});




	//저장하기
	function save_eva_comment(){

	    var w_num = $('#w_num').val();
	    var step = $('#step').val();
	    var comment_selected = $('#comment_selected').val();
	    var comment_drop = $('#comment_drop').val();

	    $.post('/evaluate/update_eva_set_comment',{
	        w_num: w_num,
	        step: step,
	        comment_selected: comment_selected,
	        comment_drop: comment_drop
	    },
	    function(data){
	        //alert(data);
	        //입력값 초기화하기
	        //fade_body_text(data);

	        open_modal();
	        $('#modal_txt').html(data);
	        
	        //alert('페이지의 콘텐츠 입력단계로 이동합니다.');
	        //location.replace('/page/');
	    });
	}

</script>
<!--data picker 관련 시작 -->
<script type="text/javascript"> 
	//data picker
	$.datepicker.setDefaults( $.datepicker.regional[ "ko" ] );
	$( "#input_start_date" ).datepicker({dateFormat:"yy-mm-dd"});
	$( "#input_end_date" ).datepicker({dateFormat:"yy-mm-dd"});

</script>
<!--data picker 관련 끝-->
<?
if(isset($step)){
?>
<div id="eval_con_area">
	<h3><?if(isset($step_title)) echo $step_title;?>-안내글 설정</h3>
	<b>* 선정자 선택을 마무리 한 후, 꼭 안내글 설정 내용을 등록해주세요.<br/>
	안내글 설정글이 등록된 시점부터 지원자가 선정 여부를 조회할 수 있습니다.</b><br/>
	<?
	//include_once $this->config->item('basic_url')."/include/inc_responses_table.php";?>
	<div class='dash_con'>
		<input type="hidden" name="s" value="1" />
		<input id='w_num' name='w_num' type='hidden' value='<?if(isset($w_num)) echo $w_num;?>'/>
		<input id='step' name='step' type='hidden' value='<?if(isset($step)) echo $step;?>'/>
		<h3>선정된 지원자 대상 안내글</h3>
		<textarea id='comment_selected' name='comment_selected' placeholder='선정된 지원자 대상 안내글을 작성해 주세요..'><?if(isset($comment_selected)) echo $comment_selected;?></textarea>
		<h3>미 선정 지원자 안내글</h3>
		<textarea id='comment_drop' name='comment_drop' placeholder='미선정된 지원자 대상 안내글을 작성해 주세요.'><?if(isset($comment_drop)) echo $comment_drop;?></textarea>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                    <div id='bt_area'>
                        <button id='post_project_info' onclick='save_eva_comment();' class='btn btn-success'>
                        	<img src='/img/icon/icon_save_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt="icon" />저장하기
                        </button>
                    </div>

            </div>	
</div>
<?
}else{
	echo '단계 설정 정보가 없습니다.<br/>';
}?>