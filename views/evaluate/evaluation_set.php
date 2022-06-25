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

        //항목 추가하기
        function add_item(){

            //개수
            var item_count = $('#item_count').val();
            var new_item_num = (item_count*1)+1;
            var item_name = 'eval_'+new_item_num;
            var form_count = $( "#sortable .form-group " ).length+1;
            var item_num = form_count+'차 평가';
            //var con_count = $(".list-group-item").length;
            var sample_code = $('#sample_item').html();
            var sample_top = '<div id="'+item_name+'" class="form-group list-group-item">';
            var item_input ='<input type="hidden" id="item_id" name="item_id[]" readonly style="height:30px;" value="'+item_name+'" placeholder="입력항목제목" />';
            var sample_bottom = '</div>';
            $('#sortable').append(sample_top+sample_code+item_input+sample_bottom);
            $('#item_count').val(new_item_num);

            $('#'+item_name+' .item_num').html(item_num);
            $('#'+item_name+' .display_name').val(item_num);
            
        }

        //폼 값 저장하기
        //폼 값 저장하기
	function save_eva_step(){
		//alert('test');
		
		var w_num = $('input[name=w_num]').val();
		var page_secur = $('input[name=page_secur]').val();
		var step = $('input[name=step]').val();
		var display_name = $('input[name=display_name]').val();
		var field_type = $('input[name=field_type]').val();

		
		if(w_num==""){
			alert("페이지 인식코드를 확인할 수 없습니다.");
		}else{
			$("#form_eva_step").submit();
		   /*
		   //$("#form_eva_step").submit();
		   $.post('/mypage/save_evaluation_set/',{
                            w_num: w_num,
                            page_secur: page_secur,
                            step: step,
                            display_name: display_name,
                            field_type: field_type

                        },
                        function(data){
                        	alert(data);
                              //$("#form_set").submit();
                        });
                        */
		}
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
			<h1 class="dash_h1">Dashboard</h1>
			<div id="back_bt_area">
				<a href="/mypage" target='_self'>Back</a>
			</div>
			<!--Dashboard Menu-->
        			<?include_once $this->config->item('basic_url')."/include/inc_dashboard_menu.php";?>
			
			<!--응답 세부정보가 있으면 출력.. -->
			<?
			if(isset($form_eva_step)){
			?>
			<div class='dash_con_area'>
				<div class='dash_con'>
					<a href='<?echo $this->config->item('base_url');?>/<? echo $domain;?>' target='_blank'>
						<img src='/img/icon/icon_link.png' class='icon_st'/>
						<?echo $this->config->item('base_url');?>/<? echo $domain;?>
					</a>
				</div>
				<div class='dash_con'>
					<div id="resp_list_area">
						<h3>선정 단계 설정</h3>
						총 접수: <?echo $response_total;?>
						<hr/>
						<?
						//include_once $this->config->item('basic_url')."/include/inc_responses_table.php";?>
						<div  id='form_area' class="box-table">
				                        <input type="hidden" name="s" value="1" />
				                        <div class="form-horizontal">
				                            <div class="list-group1" style='margin-bottom: 20px;'>
				                                <div class="form-group list-group-item">
				                                    <div class="col-sm-3">순서</div>
				                                    <div class="col-sm-6" >형식</div>
				                                    <div class="col-sm-3">
				                                        <button type="button" class="btn btn-outline btn-primary btn-xs btn-add-rows">추가</button>
				                                    </div>
				                                </div>
				                                <!--sample code 시작-->
				                                    <div id="sample_item" style="display:none;" class="form-group list-group-item">
				                                         <div class="col-sm-2" style="padding-left: 0px; padding-right: 0px;" >
				                                             <span class="item_num"></span>
				                                             	<input type="hidden" name="step[]" />
				                                             	<input type="hidden" class="form-control display_name" name="display_name[]" value="" style="height:30px;"/>
				                                        </div>
				                                         <div class="col-sm-7" style="padding-left: 5px; padding-right: 5px;" >
				                                             <select name="field_type[]" class="form-control field_type" id="field1">
				                                             <option value="type1">자체 선정</option>
				                                             <option value="type2">심사위원 구성</option>
				                                             </select>
				                                         </div>
				                                        <div class="col-sm-3" style="" >
				                                        	<!--
				                                            <button type="button" class="btn btn-outline btn-default btn-xs btn-delete-row" >설정</button>
				                                       		 -->
				                                            <button type="button" class="btn btn-outline btn-danger btn-xs btn-delete-row" >삭제</button>
				                                        </div>
				                                    </div>
				                                <!--sample code 끝-->

				                                <form id="form_eva_step"  method="post" action="/evaluate/save_evaluation_set">
				                                     <input id='item_count' type="hidden" readonly />
				                                     <input id='w_num' name='w_num' type='hidden' value='<?if(isset($w_num)) echo $w_num;?>'/>
				                                     <input id='page_secur' name='page_secur' type='hidden' value='<?if(isset($page_secur)) echo $page_secur;?>'/>
				                                    <div id="sortable">
				                                        <?
				                                        /* */
				                                        //기존 설정값이 있을 경우 로드하기
				                                        //print_r($form_eva_step);
				                                        if($form_eva_step==''){
				                                        ?>
				                                        <script>
				                                        //add_item();
				                                        </script>
				                                        <?
				                                        }else{
				                                             foreach ($form_eva_step as $form_eva_info) {
				                                                $step = $form_eva_info['step'];
				                                                $step_title = $form_eva_info['step_title'];
				                                                $field_type = $form_eva_info['field_type'];
				                                                if($step!=0){



				                                        ?>
								<div id="eval_<?echo $step;?>" class="form-group list-group-item">
									 <div class="col-sm-2" style="padding-left: 0px; padding-right: 0px;" >
										<span class="item_num"><?echo $step;?>차 평가</span>
										<input type="hidden" class='step_info' value="<?echo $step;?>"/>
										<input type="hidden" name="step[]" />
										<input type="hidden" class="form-control display_name" name="display_name[]" value="<?echo $step_title;?>" style="height:30px;"/>
									</div>
									 <div class="col-sm-7" style="padding-left: 5px; padding-right: 5px;" >
									     <select name="field_type[]" class="form-control field_type" id="field1">
									     <option value="type1" <?if($field_type=== 'type1'){echo ' selected="selected"';}?>>자체 선정</option>
									     <option value="type2" <?if($field_type=== 'type2'){echo ' selected="selected"';}?>>심사위원 구성</option>
									     </select>
									 </div>
									<div class="col-sm-3" style="" >
										<!--
									    <button type="button" class="btn btn-outline btn-default btn-xs btn-delete-row" >설정</button>
											 -->
									    <button type="button" class="btn btn-outline btn-danger btn-xs btn-delete-row" >삭제</button>
									</div>
								</div>
				                                        <?
				                                        		}
				                                            }
				                                            if(isset($step)){
				                                                $step_count = $step++;
				                                            }else{
				                                            	$step_count = '';
				                                            	?>
				                                            	<script>
				                                            	add_item();
				                                            	</script>
				                                            	<?
				                                            }

				                                            	
				                                        ?>
				                                        <script>
				                                            //total_count 추가시키기
				                                            $('#item_count').val(<?echo $step_count;?>);
				                                        </script>
				                                        <?
				                                        }
				                                       
				                                        ?>
				                                    </div>
				                                </form>
				                            </div>
				                            <script type="text/javascript">
				                            //<![CDATA[
				                            //새로운 항목 추가하기
				                            $(document).on('click', '.btn-add-rows', function() {
				                               add_item();
				                                
				                            });
				                            //생성 항목 삭제하기
				                            $(document).on('click', '.btn-delete-row', function() {
				                                var now_id_check = $(this).parents('div.list-group-item').attr('id');
				                                var now_step = $('#'+now_id_check+' .step_info').val();
				                                var next_step = (now_step*1)+1;
				                                var next_item = $("#eval_"+next_step).length;
				                                if(now_id_check=='sample_item'){
				                                    alert('최초 열은 삭제할 수 없습니다.');
				                                }else if(next_item==1){
				                                    alert('삭제하려는 단계 다음 평가 단계를 먼저 삭제 해주세요.');
				                                }else{
				                                    $(this).parents('div.list-group-item').remove();
				                                }
				                            });
				                            //항목 형식 설정 시 상황에 따른 옵션 값 출력
				                            $(document).on('change', '.field_type', function() {
				                                if ($(this).val() === 'radio' || $(this).val() === 'select' || $(this).val() === 'checkbox') {
				                                    $(this).siblings('.options').show();
				                                } else {
				                                    $(this).siblings('.options').hide();
				                                }
				                            });
				                            //항목 이동과 관련된 설정
				                            $(function () {
				                                $('#sortable').sortable({
				                                    handle:'.fa-arrows'
				                                });
				                            })
				                          
				                            //]]>
				                            </script>

				                        </div>
				                    </div>
				                    <div id='bt_area'>
				                        <button id='post_project_info' onclick='save_eva_step(); return false;' class='btn btn-info'>
				                            <img src='/img/icon/icon_save_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt="icon" />저장하기
				                        </button>
				                    </div>	
					</div>

					<div id='resp_result_area'>
						<div style='padding: 10px;'>
							<h1>선정 단계 설정 방법</h1>
							1. 선정 단계 설정 메뉴를 통해 선정 절차 및 형식을 선택한 후 저장해주세요.<br/>
							2. 각 단계별 세부 설정을 진행한 후, 각 단계별 평가일 전까지 심사위원을 추가 해 주세요.
						</div>
		                                
					</div>
				</div>
				
		                    


			</div>
			<?
			}else{
				echo '단계 설정 정보가 없습니다.<br/>';
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