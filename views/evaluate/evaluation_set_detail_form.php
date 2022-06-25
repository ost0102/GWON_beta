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



	//logo 업로드 창 열기
	function upload_file(){
	    window.open('/upload/up1/10?w_num=<?echo $w_num;?>&step=<?echo $step;?>','upload_img','width=500,height=430,left=0,top=0,scrollbars=no');
	}
	//로고 삭제
	function del_upload_file(){
	    var post_upload_file= $('#upload_file').val();
	    var post_w_num = $('#w_num').val();
	    //alert(post_logo_addr);
	    //alert(post_logo_addr);

	    $.post('/evaluate/delete_upload_file',{
	            post_upload_file: post_upload_file,
	            post_w_num: post_w_num
	        },
	        function(data){
	            //alert(data);
	            //입력값 초기화하기
	            if(data==1){
	            	var modal_txt = '삭제가 완료되었습니다.';
			open_modal();
			$('#modal_txt').html(modal_txt);
			$('#upload_file_url').html('심사위원들에게 전달할 첨부문서가 있을 경우 업로드해주세요.<br/>대용량 파일은 직접 업로드가 불가능합니다.');
			$('#bt_upload').show();
			$('#bt_delete_upload').hide();
			$('#upload_file').val('');

	            }else{
	                alert(data);
	            }
	            //추가 해야할 사항 로고 업로드시 변동 부분, 그리고 실제 하단 코드 부분에 버튼 추가하고 보이도록 설정
	        });
	}


	//저장하기
	function save_eva_set_detail(){

	    var w_num = $('#w_num').val();
	    var step = $('#step').val();
	    var step_txt = $('#step_txt').val();
	    var start_date = $('#input_start_date').val();
	    var start_time = $('#start_time').val();
	    var end_date = $('#input_end_date').val();
	    var end_time = $('#end_time').val();
	    var upload_file = $('#upload_file').val();

	    $.post('/evaluate/update_eva_set_detail',{
	        w_num: w_num,
	        step: step,
	        step_txt: step_txt,
	        start_date: start_date,
	        start_time: start_time,
	        end_date: end_date,
	        end_time: end_time,
	        upload_file: upload_file
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
	<h3><?if(isset($step_title)) echo $step_title;?> : <?if(isset($field_type_txt)) echo $field_type_txt;?></h3>
	<?include_once $this->config->item('basic_url')."/include/inc_eval_menu.php";?>
	<?
	//include_once $this->config->item('basic_url')."/include/inc_responses_table.php";?>
	<div class='dash_con'>
		<input type="hidden" name="s" value="1" />
		<input id='w_num' name='w_num' type='hidden' value='<?if(isset($w_num)) echo $w_num;?>'/>
		<input id='step' name='step' type='hidden' value='<?if(isset($step)) echo $step;?>'/>
		<h3>평가 안내</h3>
		<textarea id='step_txt' name='step_txt' placeholder='심사위원에게 전달할 안내 사항이 있을 경우 입력해주세요.'><?if(isset($step_txt)) echo $step_txt;?></textarea>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
		<h3>첨부 자료</h3>
		<div id='upload_file_url' class='t_basic' style='width: 100%;'>
			<?
			if(isset($step_attach)&&$step_attach!=''){
				echo '<a href=\''.$step_attach.'\' target=\'_blank\'>첨부 파일 보기</a>';
			}else{
				echo '심사위원들에게 전달할 첨부문서가 있을 경우 업로드해주세요.<br/>대용량 파일은 직접 업로드가 불가능합니다.';
			}
			?>
			
		</div>
		<button id='bt_upload' onclick='upload_file();' class='btn btn-inverse'>
		    파일 업로드
		</button>
                    <button id="bt_delete_upload" onclick='del_upload_file();' class="btn btn-inverse">삭제</button>
		<input id='upload_file' name='upload_file' type='hidden' value='<?if(isset($step_attach)) echo $step_attach;?>'/>
		<?
		if(isset($step_attach)&&$step_attach!=''){
		?>
		<script>$('#bt_upload').hide();</script>
		<?
		}else{
		?>
		<script>$('#bt_delete_upload').hide();</script>
		<?
		}
		?>
                    <br/>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
		<h3>심사 시작일</h3>
                    <input id='input_start_date' name='input_start_date' type='text' placeholder='종료일을 선택해주세요.' value='<?if(isset($start_date)) echo $start_date;?>' style="width:100px; height: 29px;"/>
                    <select name="start_time" id="start_time" style="width:100px; height: 29px;">
                        <option>시작 시간</option>
                        <?
                            for($time=0;$time<24;$time++){
                                $ws_now_check = 0;
                                if($time<10){
                                	$time_num ='0'.$time;
                                }else{
                                	$time_num = $time;
                                }
                                if($start_time==$time_num.':00:00'){
                                    $ws_now_check = 1;
                                }else if($start_time==$time_num.':30:00'){
                                    $ws_now_check = 2;
                                }else{
                                    $ws_now_check = 0;
                                }
                        ?>
                            <option <?if($ws_now_check==1){?>selected="selected"<?}?>><?echo $time;?>:00</option>
                            <option <?if($ws_now_check==2){?>selected="selected"<?}?>><?echo $time;?>:30</option>
                                    <?
                                        }
                                    ?>
                    </select>
                    <br/>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                    <h3>심사 종료일</h3>
                    <input id='input_end_date' name='input_end_date' type='text' placeholder='종료일을 선택해주세요.' value='<?if(isset($end_date)) echo $end_date;?>' style="width:100px; height: 29px;"/>
                    <select name="end_time" id="end_time" style="width:100px;  height: 29px;">
                        <option>마감 시간</option>
                        <?
                            for($time=0;$time<24;$time++){
                                $ws_now_check = 0;
                                if($time<10){
                                	$time_num ='0'.$time;
                                }else{
                                	$time_num = $time;
                                }
                                if($end_time==$time_num.':00:00'){
                                    $ws_now_check = 1;
                                }else if($end_time==$time_num.':30:00'){
                                    $ws_now_check = 2;
                                }else{
                                    $ws_now_check = 0;
                                }
                        ?>
                            <option <?if($ws_now_check==1){?>selected="selected"<?}?>><?echo $time;?>:00</option>
                            <option <?if($ws_now_check==2){?>selected="selected"<?}?>><?echo $time;?>:30</option>
                                    <?
                                        }
                                    ?>
                    </select>

                    <br/>

                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                    <div id='bt_area'>
                        <button id='post_project_info' onclick='save_eva_set_detail();' class='btn btn-success'>
                        	<img src='/img/icon/icon_save_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt="icon" />저장하기
                        </button>
                    </div>

            </div>	
</div>
<?
}else{
	echo '단계 설정 정보가 없습니다.<br/>';
}?>