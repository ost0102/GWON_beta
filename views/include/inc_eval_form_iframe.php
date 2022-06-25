<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?$this->load->view('/include/head_info');?>
	<link href='/css/screen_gwon.css' type='text/css' rel='stylesheet' media='screen'/>
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
	        function add_item_eval(){

	            //개수
	            var item_count = $('#item_count').val();
	            if(item_count==''||item_count==0){
	            	item_count = 0;
	            }
	            item_count *=1;
	            var new_item_num = item_count+1;
	            var item_name = 'item_'+new_item_num;
	            //var con_count = $(".list-group-item").length;
	            var sample_code = $('#sample_eval_item').html();
	            var sample_top = '<div id="'+item_name+'" class="form-group list-group-item">';
	            var item_input ='<input type="hidden" id="item_id" name="item_id[]" readonly style="height:30px;" value="'+item_name+'" placeholder="입력항목제목" />';
	            var sample_bottom = '</div>';
	            $('#sortable').append(sample_top+sample_code+item_input+sample_bottom);
	            $('#item_count').val(new_item_num);
	        }

	        //폼 값 저장하기
	        function save_form_eval(){
	            //alert('test');
	            var w_num = $('#w_num').val();

	            var use_array = Array();
	            var send_cnt = 0;
	            var chkbox = $("#sortable .use_check");

	            //alert(w_num);
	            if(w_num==""){
	               alert("페이지 인식코드를 확인할 수 없습니다.");
	            }else{
	               $("#eval_form_set").submit();
	            }
	        }

	</script>
	<style>
	body{
		margin: 0px;
		padding: 0px;
		background: #fff;
	}
	.eval_form_set_area{
		padding: 5px;
		width: 100%;
	}
	.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
	    padding-right: 5px;
	    padding-left: 5px;
	}
	</style>
</head>
<body>
<?
if(isset($step)){
?>
<div class='eval_form_set_area'>
	<input type="hidden" name="s" value="1" />
	<div class="form-horizontal">
                    <div class="list-group1" style='margin-bottom: 20px;'>
                        <div class="form-group list-group-item">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-7">항목명</div>
                            <!--
                            <div class="col-sm-4">형식</div>-->
                            <div class="col-sm-2">점수</div>
                            <div class="col-sm-2">
                                <button id="bt_eval_add" onclick="add_item_eval();" type="button" class="btn btn-outline btn-primary btn-xs btn-add-rows">추가</button>
                            </div>
                        </div>

                        <!--sample code 시작-->
                            <div id="sample_eval_item" style="display:none;" class="form-group list-group-item">
                                 <div class="col-sm-1">
                                     <div class="fa fa-arrows" style="margin-top: 10px; cursor:pointer;">
                                     </div><input type="hidden" name="key[]" />
                                 </div>
                                 <div class="col-sm-7">
                                    <input type="text" class="form-control display_name" name="display_name[]" value="" style="height:35px;" placeholder="항목명" />
                                    <input type="hidden" class="form-control display_name" name="field_type[]" style="height:35px;" placeholder="항목명" value="text" />
                                    <input type="hidden" class="form-control display_name" name="options[]" style="height:35px;" placeholder="항목명" value="" />
                                </div>
                                <!--
                                 <div class="col-sm-4">
                                     <select name="field_type[]" class="form-control field_type" id="field1">
                                     <option value="text">한줄 입력 형식(text)</option>
                                     <option value="textarea">여러 줄 입력칸(textarea)</option>
                                     <option value="radio">단일 선택(radio)</option>
                                     <option value="select">단일 선택(select)</option>
                                     <option value="checkbox">다중 선택(checkbox)</option>
                                     <option value="date">일자(연월일)</option>
                                     </select>
                                    
                                     <br />
                                     <textarea name="options[]" class="form-control options"  id="options1" style="margin-top:5px;display:none;"  placeholder="선택 옵션 (엔터로 구분하여 입력)"></textarea>
                                 </div>
                                -->
                                 <div class="col-sm-2">
                                    <input type="text" class="form-control display_name" name="score_info[]" value="" style="height:35px;" placeholder="점수" />
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-outline btn-default btn-xs btn_delete_eval" >삭제</button>
                                </div>

                                 <div style='width: 100%; clear: both; padding-top: 10px;'>
                                    <h5 style="margin-top: 10px;">안내 사항</h5>
                                    <input type="text" class="form-control display_name" name="memo[]" value="" style="height:30px;" placeholder="평가자가 참고할 수 있는 추가 설명이 필요한 경우 입력해주세요." />
                                    <h5 style="margin-top: 10px;">세부 설정</h5>
                                    <textarea name="options[]" class="form-control options"   style="margin-top:5px; "  placeholder="선택 옵션을 쉼표(,)로 구분하여 입력해주세요."><?echo $options;?></textarea>
                                    <span class="t_say">
                                        항목별로 임의의 점수가 아닌, 몇가지 값 중 하나를 선택하게 하고 싶을 경우, 세부 설정에 항목값을 쉽표로 구분하여 입력해주세요.
                                        <br/>
                                        예) 5,10,15,20 
                                    </span>
                                </div>
                                  <script>
                                  /*$("#field1").val('<?=$input[1];?>').attr('selected"','selected"');
                                  <? if($input[1]=="radio" || $input[1]=="select"  || $input[1]=="checkbox" ){?>
                                     $("#options1").show();
                                  
                                  <?}?>
                                  */
                                 </script>
                            </div>
                        <!--sample code 끝-->

                        <form id="eval_form_set"  method="post" action="/evaluate/save_eval_form_set">
                             <input id='item_count' type="hidden" readonly />
                             <input id='w_num' name='w_num' type='hidden' value='<?if(isset($w_num)) echo $w_num;?>'/>
                             <input id='step' name='step' type='hidden' value='<?if(isset($step)) echo $step;?>'/>
                            <div id="sortable">
                                <?
                                //기존 설정값이 있을 경우 로드하기
                                //print_r($formset_info);
                                if($eval_formset_info==''){
                                ?>
                                <script>
                                add_item_eval();
                                </script>
                                <?
                                }else{
                                     $key = 0;
                                     foreach ($eval_formset_info as $eval_form_info) {
                                        $step = $eval_form_info['step'];
                                        $key = $eval_form_info['key'];
                                        $item_id = $eval_form_info['item_id'];
                                        $display_name = $eval_form_info['display_name'];
                                        $field_type = $eval_form_info['field_type'];
                                        $options = $eval_form_info['options'];
                                        $score = $eval_form_info['score'];
                                        $memo = $eval_form_info['memo'];

                                ?>
                                <div id="<?echo $item_id;?>" class="form-group list-group-item">
                                     <div class="col-sm-1">
                                         <div class="fa fa-arrows" style="margin-top: 10px; cursor:pointer;">
                                         </div><input type="hidden" name="key[]"/>
                                     </div>
                                     <div class="col-sm-7">
                                        <input type="text" class="form-control display_name" name="display_name[]" style="height:35px;" placeholder="항목명" value="<?echo $display_name;?>" />
                                        <input type="hidden" class="form-control display_name" name="field_type[]" style="height:35px;" placeholder="항목명" value="<?echo $field_type;?>" />
                                    </div>
                                    <!--평가단계에서는 다른건 안씀
                                     <div class="col-sm-4">
                                         <select name="field_type[]" class="form-control field_type" id="field1" >
	                                         <option value="text" >한줄 입력 형식(text)</option>
                                             
	                                         <option value="textarea"<?if($field_type=== 'textarea'){echo ' selected="selected"';}?>>여러 줄 입력칸(textarea)</option>
	                                         <option value="radio"<?if($field_type === 'radio'){echo ' selected="selected"';}?>>단일 선택(radio)</option>
	                                         <option value="select"<?if($field_type === 'select'){echo ' selected="selected"';}?>>단일 선택(select)</option>
	                                         <option value="checkbox"<?if($field_type === 'checkbox'){echo ' selected="selected"';}?>>다중 선택(checkbox)</option>
	                                         <option value="date"<?if($field_type === 'date'){echo ' selected="selected"';}?>>일자(연월일)</option>
                                        
                                         </select>
                                        
                                         <br />
                                         <textarea name="options[]" class="form-control options"  id="options1" style="margin-top:5px;display:none;"  placeholder="선택 옵션 (엔터로 구분하여 입력)"><?echo $options;?></textarea>
                                     </div>
                                      -->

                                     <div class="col-sm-2">
                                        <input type="text" class='form-control display_name' name="score_info[]"  style="height:35px;" value="<?echo $score;?>" />

                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-outline btn-default btn-xs btn_delete_eval" >삭제</button>
                                    </div>

                                     <div style='width: 100%; clear: both; padding-top: 10px;'>
                                        <h5 style="margin-top: 10px;">안내 사항</h5>
                                        <input type="text" class="form-control display_name" name="memo[]" style="height:30px;" value="<?echo $memo;?>" placeholder="평가자가 참고할 수 있는 추가 설명이 필요한 경우 입력해주세요." />
                                        <h5 style="margin-top: 10px;">세부 설정</h5>
                                        <textarea name="options[]" class="form-control options"   style="margin-top:5px; "  placeholder="선택 옵션을 쉼표(,)로 구분하여 입력해주세요."><?echo $options;?></textarea>
                                        <span class="t_say">
                                            항목별로 임의의 점수가 아닌, 몇가지 값 중 하나를 선택하게 하고 싶을 경우, 세부 설정에 항목값을 쉽표로 구분하여 입력해주세요.
                                            <br/>
                                            예) 5,10,15,20 
                                        </span>
                                    </div>
                                      <input type="hidden" id="item_id" name="item_id[]" readonly style="height:30px;" value="<?echo $item_id;?>" placeholder="입력항목제목" />
                                </div>
                                <?
                                    }
                                    if(isset($key)){
                                    	$key_count = $key++;
                                    }else{
                                    	$key_count = 0;
                                    }
                                ?>
                                <script>
                                    //total_count 추가시키기
                                    $('#item_count').val(<?echo $key_count;?>);
                                </script>
                                <?
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                    <script type="text/javascript">
                    //<![CDATA[
                    //생성 항목 삭제하기
                    $(document).on('click', '.btn_delete_eval', function() {
                        var now_id_check = $(this).parents('div.list-group-item').attr('id');
                        if(now_id_check=='sample_eval_item'){
                            alert('최초 열은 삭제할 수 없습니다.');
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
                            handle:'.fa-arrows',
                            isTree: false,
                        });
                    })
                  
                  
                    //]]>
                    </script>


                <div id='bt_area'>
                    <button id='post_project_info' onClick='save_form_eval();' class='btn btn-info'>
                        <img src='/img/icon/icon_save_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt="icon" />저장하기
                    </button>
                 </div>

                </div>

  </div>
<?
}else{
	echo '단계 설정 정보가 없습니다.<br/>';
}?>
</body>
</html>