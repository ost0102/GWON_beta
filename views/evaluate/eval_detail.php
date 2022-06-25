<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?$this->load->view('/include/head_info');?>
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
	
        //평가 대상 정보 가져오기
        function show_target_info(w_num, step, user_id){
           $("#eval_table").fadeOut();
        	$.post('/evaluate/get_target_user_info/',{
                w_num: w_num,
                step: step,
                user_id: user_id
            },
            function(data){
            	//alert(data);
            	$("#eval_table").html(data);
            	$("#eval_table").fadeIn();
            	get_eval_form(w_num, step, user_id);

            });
        }       
        
   

        //평가표 정보 가져오기
        function get_eval_form(w_num, step, user_id){
           $("#resp_result_area2").fadeOut();
        	$.post('/evaluate/eval_table/',{
                w_num: w_num,
                step: step,
                user_id: user_id
            },
            function(data){
            	//alert(data);
            	$("#resp_result_area2").html(data);
            	$("#resp_result_area2").fadeIn();

            });
        }


        //평가 대상 정보 저장하기
        function target_evaluate(w_num, step){
           $("#resp_result_area2").fadeOut();
        	$.post('/evaluate/set_eval_detail_form/',{
                w_num: w_num,
                step: step
            },
            function(data){
            	//alert(data);
            	$("#resp_result_area2").html(data);
            	$("#resp_result_area2").fadeIn();
            });
        }

          

    </script>
<!--data picker 관련 시작 -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script type="text/javascript"> 
	//data picker
	$(function() {
		$.datepicker.setDefaults( $.datepicker.regional[ "ko" ] );
		$( "#datepicker1" ).datepicker({dateFormat:"yy-mm-dd"});
	}); 

</script>
<!--data picker 관련 끝-->
</head>
<body>
<!-- 상단 영역 공통 시작-->
<div id='top_area'>
    <div id='workspace_top_noti'>
            <div id='top_noti_con_txt'>
                <!-- noti_txt -->
                <?include_once $this->config->item('basic_url')."/include/inc_top_noti_txt.php";?>
            </div>
            <div id='top_menu_area'>
                <!-- sub_top area include -->
                <?include_once $this->config->item('basic_url')."/include/inc_top_menu_login.php";?>
            </div>
    </div>
    <div id='workspace_top_con'>
        <?include_once $this->config->item('basic_url')."/include/inc_top_menu_workspace.php";?>
    </div>
</div>
<!-- 상단 영역 공통 끝 -->
<div id='dashboard_container'>
    <div id='workspace'>
        <!-- 왼쪽 콘텐츠 영역 시작 -->
        <div id='workspace_all' class='wkarea1'>
            <div id='wp_center_con'>
		<div id="con_main">
			<h1 class="dash_h1">평가 하기</h1>
			<div id="back_bt_area">
				<a href='/evaluate/eval_list/<?echo $page_secur;?>' target='_self'>
				    < 평가/선정 개요
				</a>
			</div>
			<!--응답 세부정보가 있으면 출력.. -->
			<?
			if(isset($eva_step_info)){

			?>
			<div class='dash_con_area'>
				<div class='dash_con'>
					<div id="resp_list_area2">
						<?
						//include_once $this->config->item('basic_url')."/include/inc_responses_table.php";?>
						<div  id='eval_user_list' class="box-table">
				                        <div class="form-horizontal">
				                            <div class="list-group1" style='margin-bottom: 20px;'>
				                                <div class="form-group list-group-item">
				                                    <div class="col col-sm-5">이름</div>
				                                    <div class="col col-sm-3" >점수</div>
				                                    <div class="col col-sm-3" >평가</div>
				                                </div>
							<input id='w_num' name='w_num' type='hidden' value='<?if(isset($w_num)) echo $w_num;?>'/>
							<input id='page_secur' name='page_secur' type='hidden' value='<?if(isset($page_secur)) echo $page_secur;?>'/>
							<div style="width: 100%;">
							<?
							/* */
							//기존 설정값이 있을 경우 로드하기
							if($evar_target_info==0){
							//print_r($evar_target_info);
							?>
							<script>
							//add_item();
							</script>
							<?
							}else{
								 foreach ($evar_target_info as $target_user_info) {
								    $user_id = $target_user_info['user_id'];
								    $id_secur = $target_user_info['id_secur'];
								    $username = $target_user_info['username'];
								    $score_sum = $target_user_info['score_sum'];

							?>
							<div id="eval_<?echo $step;?>" class="form-group list-group-item">
								<div class="col col-sm-5" style="padding-left: 0px; padding-right: 0px;" >
									<?echo $username;?>
								</div>
				                                    	<div class="col col-sm-3" >
				                                    		<?echo $score_sum;?>
				                                    	</div>
				                                    	<div class="col col-sm-3" >
				                                    		<button type="button" onclick="show_target_info('<?echo $w_num;?>','<?echo $step;?>','<?echo $user_id;?>')" class="btn btn-outline btn-default btn-xs" >
				                                    			보기
				                                    		</button>
				                                    	</div>
							</div>
							<?
								}	
							}
							?>
							</div>
				                            </div>

				                        </div>
				                    </div>
				                    <div  id='eval_table' class="box-table" style='display: none;'>
				                    </div>
					</div>

					<div id='resp_result_area2'>
						<div style='padding: 10px;'>
							<h1>평가 안내</h1>
							<?
								$step = $eva_step_info['step'];
								$step_title = $eva_step_info['step_title'];
								$field_type = $eva_step_info['field_type'];
								$field_type_txt = $eva_step_info['field_type_txt'];

							          $w_num = $eva_step_info['w_num'];
							          $step = $eva_step_info['step'];
							          $step_title = $eva_step_info['step_title'];
							          $field_type = $eva_step_info['field_type_txt'];
							          $step_txt = $eva_step_info['step_txt'];
							          $step_attach = $eva_step_info['step_attach'];
							          $start_date = $eva_step_info['start_date'];
							          $end_date = $eva_step_info['end_date'];
							          $start_time = $eva_step_info['start_time'];
							          $end_time = $eva_step_info['end_time'];
							          $date = $eva_step_info['date'];

							          	echo '<b>'.$cam_title.'</b>의 '.$step_title.' 페이지입니다.<br/>';
							          	echo '<b>평가 형식 :</b> '.$field_type_txt.'<br/>';

							          	if($step_txt!=''){
							          		echo '<b>추가 설명 : </b>'.$step_txt.'<br/>';
							          	}
							          	if($step_attach!=''){
							          		echo '<b>첨부자료 : </b> <a href="'.$step_attach.'" target="_blank"><b>다운로드</b></a><br/>';
							          	}
							          	echo '<b>평가 시작일 : </b>'.$start_date.' '.$start_time.'<br/>';
							          	echo '<b>평가 종료일 : </b>'.$end_date.' '.$end_time.'<br/>';
							          	echo '<hr/>';
							?>

							1. 왼쪽의 평가 대상을 선택하면 평가표와 신청정보가 출력됩니다.<br/>
							2. 내용을 확인하여 평가정보를 입력하여 평가를 진행합니다.<br/>
							3. 평가 위원들의 총 점수 합계를 확인한 후 평가 이후 최종 선정은 사업담당자가 선정합니다.
						</div>
		                                
					</div>
				</div>
				

			</div>
			<?
			}else{
				echo '평가 설정 정보가 없습니다.<br/>';
			}?>
			
		</div>
		
	</div>

        </div>
    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
<SCRIPT TYPE="text/javascript">
	function history_back(){
		history.back(-1);
	}
</SCRIPT>
</body>
</html>