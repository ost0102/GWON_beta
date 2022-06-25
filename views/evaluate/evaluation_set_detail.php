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


        //세부 설정불러오기
        function set_eval_detail(w_num, step){
           $("#resp_result_area2").fadeOut();
        	$.post('/evaluate/set_eval_detail_form/',{
                w_num: w_num,
                step: step
            },
            function(data){
            	//alert(data);
            	$("#resp_result_area2").html(data);
            	$("#menu_eval_1").attr('class','eval_sub_menu_selected');
            	$("#menu_eval_2").attr('class','eval_sub_menu');
            	$("#menu_eval_3").attr('class','eval_sub_menu');
            	$("#resp_result_area2").fadeIn();
            });
        }
        
        //평가항목 설정불러오기
        function set_eval_form(w_num, step){
           $("#resp_result_area2").fadeOut();
        	$.post('/evaluate/set_eval_form/',{
                w_num: w_num,
                step: step
            },
            function(data){
            	//alert(data);
            	$("#resp_result_area2").html(data);
            	$("#menu_eval_1").attr('class','eval_sub_menu');
            	$("#menu_eval_2").attr('class','eval_sub_menu_selected');
            	$("#menu_eval_3").attr('class','eval_sub_menu');

            	$("#resp_result_area2").fadeIn();

            });
        }

        //평가위원 설정 불러오기
        function set_eval_member(w_num, step){
           $("#resp_result_area2").fadeOut();
        	$.post('/evaluate/set_eval_member/',{
                w_num: w_num,
                step: step
            },
            function(data){
            	//alert(data);
            	$("#resp_result_area2").html(data);
            	$("#menu_eval_1").attr('class','eval_sub_menu');
            	$("#menu_eval_2").attr('class','eval_sub_menu');
            	$("#menu_eval_3").attr('class','eval_sub_menu_selected');

            	$("#resp_result_area2").fadeIn();

            });
        }

        //폼 값 저장하기
	function save_eva_step(){
		//alert('test');
		
		var w_num = $('input[name=w_num]').val();
		var page_secur = $('input[name=page_secur]').val();
		
		if(w_num==""){
			alert("페이지 인식코드를 확인할 수 없습니다.");
		}else{
			$("#form_eva_step").submit();
		   /*
		   //$("#form_eva_step").submit();
		   $.post('/mypage/save_evaluation_set/',{
                            w_num: w_num,
                            page_secur: page_secur,
                            key: key,
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
					<div id="resp_list_area2">
						<h3>세부 설정</h3>
						총 접수: <?echo $response_total;?>
						<hr/>
						<?
						//include_once $this->config->item('basic_url')."/include/inc_responses_table.php";?>
						<div  id='form_area' class="box-table">
				                        <div class="form-horizontal">
				                            <div class="list-group1" style='margin-bottom: 20px;'>
				                                <div class="form-group list-group-item">
				                                    <div class="col-sm-3">순서</div>
				                                    <div class="col-sm-8" >형식</div>
				                                </div>
							<input id='w_num' name='w_num' type='hidden' value='<?if(isset($w_num)) echo $w_num;?>'/>
							<input id='page_secur' name='page_secur' type='hidden' value='<?if(isset($page_secur)) echo $page_secur;?>'/>
							<div style="width: 100%;">
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
								    $field_type_txt = $form_eva_info['field_type_txt'];
								    if($step!=0){

							?>
							<div id="eval_<?echo $step;?>" class="form-group list-group-item">
								<div class="col-sm-3" style="padding-left: 0px; padding-right: 0px;" >
									<span class="item_num"><?echo $step;?>차 평가</span>
								</div>
								<div class="col-sm-6" style="padding-left: 5px; padding-right: 5px;" >
									<?
									echo $field_type_txt;
									?>
								</div>
				                                    	<div class="col-sm-3" >
				                                    		<button type="button" onclick="set_eval_detail('<?echo $w_num;?>','<?echo $step;?>')" class="btn btn-outline btn-default btn-xs" >
				                                    			설정
				                                    		</button>
				                                    	</div>
							</div>
							<?
								}
								}	
							}
							?>
							</div>
				                            </div>

				                        </div>
				                    </div>
				                    <div id='bt_area' style='text-align: left;'>
				                    	<a href='/evaluate/evaluation_set/<?echo $page_secur;?>' target='_self'>
							    < 평가 단계 설정
							</a>
				                    </div>	
					</div>

					<div id='resp_result_area2'>
						<div style='padding: 10px;'>
							<h1>세부 설정</h1>
							1. 왼쪽의 각 단계별 설정 버튼을 클릭하면, 단계별 세부 설정창이 활성화됩니다.<br/>
							2. 단계별 심사 기준 및 안내 사항, 접수자들에게 받을 추가 자료 등을 설정할 수 있습니다.
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