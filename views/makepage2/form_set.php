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
            var item_name = 'item_'+new_item_num;
            //var con_count = $(".list-group-item").length;
            var sample_code = $('#sample_item').html();
            var sample_top = '<div id="'+item_name+'" class="form-group list-group-item">';
            var item_input ='<input type="hidden" id="item_id" name="item_id[]" readonly style="height:30px;" value="'+item_name+'" placeholder="입력항목제목" />';
            var sample_bottom = '</div>';
            $('#sortable').append(sample_top+sample_code+item_input+sample_bottom);
            $('#item_count').val(new_item_num);
        }

        //폼 값 저장하기
        function save_form(){
            //alert('test');
            var w_num = $('#w_num').val();

            var use_array = Array();
            var send_cnt = 0;
            var chkbox = $("#sortable .use_check");

            //alert(w_num);
            if(w_num==""){
               alert("페이지 인식코드를 확인할 수 없습니다.");
            }else{
               $("#form_set").submit();
            /*
                $.post('/makepage/save_form_set/',{
                        dn_bank_recipt: dn_bank_recipt,
                        dn_id: dn_id

                    },
                    function(data){

                        $("#form_set").submit();
                    });
            */
            }
        }

        //필수 사용값 변수 넘기기
        function check_use(val){
            var now_checked = $(val).is(":checked");
            if(now_checked==true){
                $(val).next().val(1);
            }else{
                $(val).next().val(0);
            }
        }

    </script>

    <style type="text/css">
    </style>
</head>
<body>
  <?
  if($total_user_apply_info>0){
  ?>
  <script>
    alert('기존에 입력된 사용자의 접수 정보가 있습니다. 양식 구성을 변경하면 영향이 있을 수 있습니다.');
  </script>
  <?
  }
  ?>
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
<div id='workspace_container'>
    <div id='workspace'>
        <!-- 왼쪽 콘텐츠 영역 시작 -->
        <!-- 오른쪽 콘텐츠 영역 시작 -->
        <div id='workspace_left' class='make_step'>
                <!--제작 단계 버튼-->
                <?$this->load->view('/include/inc_make_step');?>
        </div>
        <div id='workspace_center' class='wkarea1'>
            <div id='wp_center_con'>
                    <!--콘텐츠 설정 메뉴-->
                    <?$this->load->view('/include/inc_con_set_menu');?>
                    <h1>
                      양식 구성
                    </h1>
                    <div class='t_title'>입력받으실 양식을 구성합니다.</div>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                    <div  id='form_area' class="box-table">
                        <input type="hidden" name="s" value="1" />
                        <div class="form-horizontal">
                            <div class="list-group1" style='margin-bottom: 20px;'>
                                <!--sample code 시작-->
                                    <div id="sample_item" style="display:none;" class="form-group list-group-item">
                                         <div class="form_move_icon_area">
                                             <div class="form_move_area">
                                               <div class="fa fa-arrows" style="margin-right: 10px;"></div>이동
                                               <input type="hidden" name="key[]" />
                                            </div>
                                             <div class="form_dell_area">
                                                <button type="button" class="btn btn-outline btn-default btn-xs btn-delete-row" >삭제</button>
                                            </div>
                                         </div>
                                         <div class="form_title_area">
                                            <!--항목명-->
                                            <input type="text" class="form-control display_name" name="display_name[]" value="" style="height:30px;" placeholder="입력항목제목" />
                                        </div>
                                         <div class="form_memo_area">
                                            <!--설명-->
                                            <input type="text" class="form-control display_memo" name="memo[]" value="" style="height:30px;" placeholder="입력 항목에 대한 설명이 필요한 경우 입력해주세요." />
                                        </div>
                                         <div class="form_required_area">
                                            <input type="checkbox" class='use_check' onClick='check_use(this);' /> 필수 입력
                                            <input type="hidden" class='use_check_value' name="use[]"  value="0"/>
                                        </div>
                                         <div class="form_type_area">
                                             항목 유형
                                             <select name="field_type[]" class="form-control field_type" id="field1">
                                             <option value="text">한줄 입력 형식(text)</option>
                                             <option value="textarea">여러 줄 입력칸(textarea)</option>
                                             <option value="radio">단일 선택(radio)</option>
                                             <option value="select">단일 선택(select)</option>
                                             <option value="checkbox">다중 선택(checkbox)</option>
                                             <option value="upload">파일업로드(Upload)</option>
                                             <option value="date">일자(연월일)</option>
                                             <option value="page_branch">--페이지 나누기--</option>
                                             </select>
                                            
                                             <div class="form_option_area">
                                               <textarea name="options[]" class="form-control options"   style="margin-top:5px;display:none;"  placeholder="선택 옵션 (엔터로 구분하여 입력)"></textarea>
                                                <div class="form_option_con"></div>
                                             </div>
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

                                <form id="form_set"  method="post" action="/makepage/save_form_set">
                                     <input id='item_count' type="hidden" readonly />
                                     <input id='w_num' name='w_num' type='hidden' value='<?if(isset($w_num)) echo $w_num;?>'/>
                                     <input id='page_secur' name='page_secur' type='hidden' value='<?if(isset($page_secur)) echo $page_secur;?>'/>
                                    <div id="sortable">
                                        <?
                                        //기존 설정값이 있을 경우 로드하기
                                        //print_r($formset_info);
                                        if($formset_info==''){
                                        ?>
                                        <script>
                                        add_item();
                                        </script>
                                        <?
                                        }else{
                                             foreach ($formset_info as $form_info) {
                                                $key = $form_info['key'];
                                                $item_id = $form_info['item_id'];
                                                $display_name = $form_info['display_name'];
                                                $field_type = $form_info['field_type'];
                                                $options = $form_info['options'];
                                                $use = $form_info['use'];
                                                $memo = $form_info['memo'];
                                        ?>
                                        <div id="<?echo $item_id;?>" class="form-group list-group-item" style="<?if($field_type == 'page_branch'){echo 'background: #cdcdcd;';}?>">
                                             <div class="col-sm-1">
                                                 <div class="fa fa-arrows" style="cursor:pointer;">
                                                 </div><input type="hidden" name="key[]"/>
                                             </div>
                                             <div class="col-sm-3">
                                                <input type="text" class="form-control display_name" name="display_name[]" style="height:30px;" placeholder="입력항목제목" value="<?echo $display_name;?>" />
                                            </div>
                                             <div class="col-sm-4">
                                                 <select name="field_type[]" class="form-control field_type" id="field1" >
                                                   <option value="text" >한줄 입력 형식(text)</option>
                                                   <option value="textarea"<?if($field_type=== 'textarea'){echo ' selected="selected"';}?>>여러 줄 입력칸(textarea)</option>
                                                   <option value="radio"<?if($field_type === 'radio'){echo ' selected="selected"';}?>>단일 선택(radio)</option>
                                                   <option value="select"<?if($field_type === 'select'){echo ' selected="selected"';}?>>단일 선택(select)</option>
                                                   <option value="checkbox"<?if($field_type === 'checkbox'){echo ' selected="selected"';}?>>다중 선택(checkbox)</option>
                                                   <option value="upload"<?if($field_type === 'upload'){echo ' selected="selected"';}?>>파일업로드(Upload)</option>
                                                   <option value="date"<?if($field_type === 'date'){echo ' selected="selected"';}?>>일자(연월일)</option>
                                                   <option value="page_branch"<?if($field_type === 'page_branch'){echo ' selected="selected"';}?>>--페이지 나누기--</option>
                                                 </select>
                                                 <textarea name="options[]" class="form-control options" style="margin-top:5px;  <?if($options==''){?>display:none;<?}?>"  placeholder="선택 옵션 (엔터로 구분하여 입력)"><?echo $options;?></textarea>
                                             </div>
                                             <div class="col-sm-2">
                                                <?
                                                if(isset($use)){
                                                    if($use==0){
                                                        $now_use = 0;
                                                        $now_use_txt = '';
                                                    }else{
                                                        $now_use = 1;
                                                        $now_use_txt = 'checked="checked"';
                                                    }
                                                }else{
                                                    $now_use = 0;
                                                    $now_use_txt = '';
                                                }?>
                                                <input type="checkbox" class='use_check' onClick='check_use(this);' <?echo $now_use_txt;?>/>
                                                <input type="hidden" class='use_check_value' name="use[]"  value="<?echo $now_use;?>" />

                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" class="btn btn-outline btn-default btn-xs btn-delete-row" >삭제</button>
                                            </div>

                                             <div style='float: left; width: 100%; margin-top:10px; '>
                                                <input type="text" class="form-control display_memo" name="memo[]" style="height:30px;" value="<?echo $memo;?>" placeholder="입력 항목에 대한 설명이 필요한 경우 입력해주세요." />
                                            </div>
                                              <input type="hidden" id="item_id" name="item_id[]" readonly style="height:30px;" value="<?echo $item_id;?>" placeholder="입력항목제목" />
                                        </div>
                                        <?
                                            }
                                            if(isset($key)){
                                                $key_count = $key++;
                                            }else{
                                              $key_count = '';
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
                            //새로운 항목 추가하기
                            add_item();
                            $(document).on('click', '.btn-add-rows', function() {
                               add_item();
                               show_preview();
                            });
                            //생성 항목 삭제하기
                            $(document).on('click', '.btn-delete-row', function() {
                                var now_id_check = $(this).parents('div.list-group-item').attr('id');
                                if(now_id_check=='sample_item'){
                                    alert('최초 열은 삭제할 수 없습니다.');
                                }else{
                                    $(this).parents('div.list-group-item').remove();
                                }
                                show_preview();
                            });
                            //항목 형식 설정 시 상황에 따른 옵션 값 출력
                            $(document).on('change', '.field_type', function() {
                                if ($(this).val() === 'radio' || $(this).val() === 'select' || $(this).val() === 'checkbox') {
                                    //형재요소 form_option_area 하부의 옵션 노출
                                    //$(this).siblings(' .form_option_area').children('.options').show();
                                    //항목별 호출하는 값이 다르게
                                    var now_id_check = $(this).parents('.list-group-item').attr('id');
                                    $(this).parents(".form-group").css('background',"");
                                    $(this).parents().siblings(' .form_title_area').show();
                                    $(this).parents().siblings(' .form_memo_area').show();
                                    $(this).parents().siblings(' .form_required_area').show();
                                    $(this).siblings(' .form_option_area').show();

                                    set_option(now_id_check);

                                }else if ($(this).val() === 'page_branch') {
                                    //$(this).parents(".form-group").css('border',"solid 1px #cdcdcd");
                                    $(this).parents(".form-group").css('background',"#cdcdcd");
                                    $(this).parents().siblings(' .form_title_area').hide();
                                    $(this).parents().siblings(' .form_memo_area').hide();
                                    $(this).parents().siblings(' .form_required_area').hide();
                                    $(this).parents().siblings(' .form_option_con').hide();
                                    $(this).siblings(' .form_option_area').hide();
                                    $(this).siblings(' .form_option_area').children('.options').hide();

                                    alert('페이지 나누기를 선택하셨습니다. 입력항목과 설명을 입력해주시면, 분기화된 페이지 상단에 출력됩니다.');
                                }else{
                                    $(this).parents(".form-group").css('background',"");
                                    $(this).parents().siblings(' .form_title_area').show();
                                    $(this).parents().siblings(' .form_memo_area').show();
                                    $(this).parents().siblings(' .form_required_area').show();
                                    $(this).siblings(' .form_option_area').hide();
                                    $(this).siblings(' .form_option_area').children('.options').hide();
                                }
                            });
                            //항목 이동과 관련된 설정
                            $(function () {
                                $('#sortable').sortable({
                                    handle:'.form_move_area'
                                });
                            })
                            $("#sortable").mousemove(function() {
                              show_preview();
                            });
                            //라디오 버튼 옵션
                            function set_option(now_id){
                                //옵션 위치 - id 지정
                                var now_option_con = "#"+now_id+" .options";
                                $(now_option_con).attr('id',now_id+"_options_info");
                                //옵션 위치 - id 지정
                                var now_option_con = "#"+now_id+" .form_option_con";
                                $(now_option_con).attr('id',now_id+"_option");
                                //alert(now_option_con);
                                add_more_option(now_id);

                                
                            }
                            //새로운 라디오 항목 추가
                            function add_more_option(now_id){
                              var type_now_id =typeof(now_id);
                              if(type_now_id=='string'){
                                var now_options = "#"+now_id+"_option";

                                //
                                var num = 0;
                                $(now_options+' .form_option_con_detail' ).each( function() {
                                  num++;
                                });
                              }
                              /*
                              옵션
                              1. 기존에 옵션이 없을 경우 삭제버튼 출력안되게

                              */
                              if(num==0){
                                 var now_pa = "#"+now_id+" .form_option_con";
                                 add_option_radio = '<div class="form_option_con_detail"><div class="form_option_con_input"><input type="text" class="form-control display_name s_opt" name="form_option_con[]" value="" style="height:30px;" placeholder="옵션명을 입력해주세요." /></div><div class="form_option_con_bt"> <i class="margin-top-5 fa fa-plus-circle fa-2x default_blue" onClick="add_more_option(this);"></i></div></div>';

                              }else{
                                //항목 추가
                                var now_pa = '#'+$(now_id).parents('.form_option_con').attr('id');
                                //신규 옵션의 경우 삭제버튼 있게
                                add_option_radio = '<div class="form_option_con_detail"><div class="form_option_con_input"><input type="text" class="form-control display_name s_opt" name="form_option_con[]" value="" style="height:30px;" placeholder="옵션명을 입력해주세요." /></div><div class="form_option_con_bt"> <i class="margin-top-5 fa fa-plus-circle fa-2x default_blue" onClick="add_more_option(this);"></i><i class="margin-top-5 margin-left-5 fa fa-times-circle default_red fa-2x remove_more_radio" onClick="del_this_option(this);"></i></div></div>';

                              }
                              
                                $(now_pa).fadeIn();
                                //신규 항목 추가
                                $(now_pa).append(add_option_radio);

                                //옵션값 저장을 위해 현재 위치 저장하기
                                now_id_check = $(now_pa).parents('div.list-group-item').attr('id');
                                now_options_info_name = "#"+now_id_check+" .options";
                                update_option(now_options_info_name);
                              
                             
                            }


                            //현재 생성한 버튼 삭제
                            function del_this_option(now_select){
                              //옵션값 저장을 위해 현재 위치 저장하기
                              now_id_check = $(now_select).parents('div.list-group-item').attr('id');

                              now_pa = '#'+$(now_select).parents('.form_option_con_detail').remove();
                              
                              now_options_info_name = "#"+now_id_check+" .options";
                              update_option(now_options_info_name);
                              
                            }
                            function update_option(now_select){
                                var now_id_check = $(now_select).parents('div.list-group-item').attr('id');
                                //현재 항목의 옵션 값 저장 위치
                                var now_options_info_name = "#"+now_id_check+" .options";
                                var now_options_info_id = $(now_options_info_name).attr('id');

                                //현재 옵션 항목 변경 값들
                                var now_option_con_name = "#"+now_id_check+" .form_option_con";
                                var now_option_con_id = $(now_option_con_name).attr('id');

                                //현재 옵션의 id 값
                                var option_value = '';
                                var op_count = 0;
                                $(now_option_con_name+' input' ).each( function() {
                                  var now_option_value = $(this).val();
                                  if(op_count==0){
                                    option_value = now_option_value;
                                  }else{
                                    option_value = option_value+"\n"+now_option_value;
                                  }
                                  op_count++;
                                });
                                $(now_options_info_name).val(option_value);
                              
                            }

                             //라디오 버튼 옵션
                            function select_option(now_id){
                                //옵션 위치 - id 지정
                                var now_option_con = "#"+now_id+" .options";
                                $(now_option_con).attr('id',now_id+"_options_info");
                                //옵션 위치 - id 지정
                                var now_option_con = "#"+now_id+" .form_option_con";
                                $(now_option_con).attr('id',now_id+"_option");
                                //alert(now_option_con);
                                add_more_option(now_option_con);
                            }
                          
                            //옵션 항목입력하면 반영되도록 수정
                            $(document).on('keyup', '.s_opt', function () {
                              update_option(this);
                            });

                            //접수 항목 변경될때마다 실행되도록 적용
                            $(document).on('change', '.list-group1', function() {
                                //변화될때마다 실행할 코드
                                show_preview();
                            });

                            //미리보기창 수정
                            function show_preview(){
                                $("#workspace_preview_con").html("");
                                var con_txt = "";
                                var num = 0;
                                $('#sortable .list-group-item' ).each( function() {
                                  var now_item_name = $(this).find('.display_name').val();
                                  var now_item_memo = $(this).find('.display_memo').val();
                                  var now_item_required = $(this).find('.use_check_value').val();
                                  var now_item_type = $(this).find('.field_type').val();
                                  var now_item_options = $(this).find('.options').val();
                                  if(now_item_required==0){
                                    now_item_required_txt = '<br/>';
                                  }else{
                                    now_item_required_txt = '*<br/>';
                                  }
                                  if(now_item_memo==""){
                                    now_item_memo_txt = "";
                                  }else{
                                    now_item_memo_txt = now_item_memo+"<br/>";
                                  }
                                  if(now_item_type=="text"){
                                    now_item_type_txt = "<input type='txt'>";
                                  }else if(now_item_type=="textarea"){
                                    now_item_type_txt = "<textarea></textarea>";
                                  }else if(now_item_type=="radio"){
                                    var now_item_options_arr = now_item_options.split("\n");
                                    var now_item_type_txt = "";

                                    $.each(now_item_options_arr, function(index, value) {
                                          //console.log(index + " : " + value);
                                          var now_item_type_radio= " <input type='radio' name='"+num+"' id='"+value+"'>";
                                          var now_item_type_txt_label = "<label for='"+value+"'>"+value+"</label>";
                                          now_item_type_txt = now_item_type_txt+now_item_type_radio+now_item_type_txt_label;
                                    });

                                    
                                  }else if(now_item_type=="select"){
                                    var now_item_options_arr = now_item_options.split("\n");
                                    var now_item_type_txt = "";
                                    var item_type_txt_label = "";

                                    $.each(now_item_options_arr, function(index, value) {
                                          //console.log(index + " : " + value);
                                          var now_item_type_txt_label = "<option>"+value+"</option>";
                                          item_type_txt_label = item_type_txt_label+now_item_type_txt_label;
                                    });
                                    now_item_type_txt = "<select>"+item_type_txt_label+"</select>";

                                  }else if(now_item_type=="checkbox"){
                                    var now_item_options_arr = now_item_options.split("\n");
                                    var now_item_type_txt = "";

                                    $.each(now_item_options_arr, function(index, value) {
                                          //console.log(index + " : " + value);
                                          var now_item_type_radio= " <input type='checkbox' name='"+num+"' id='"+value+"'>";
                                          var now_item_type_txt_label = "<label for='"+value+"'>"+value+"</label>";
                                          
                                          now_item_type_txt = now_item_type_txt+now_item_type_radio+now_item_type_txt_label;
                                    });

                                  }else if(now_item_type=="upload"){
                                    now_item_type_txt= " <input type='file' />";

                                  }else if(now_item_type=="date"){
                                    now_item_type_txt= " <input type='date' />";

                                  }else if(now_item_type=="page_branch"){
                                    now_item_type_txt= "page_branch";

                                  }else{
                                    now_item_type_txt = "";
                                  }
                                  
                                  
                                  if(typeof now_item_name == "undefined"){
                                    //드래그 및 소트에이블 할때 undefined 나오는것 방지
                                  }else if(now_item_type_txt == "page_branch"){
                                    //페이지 나누기
                                    var add_con_txt ="-------페이지 나눔--------";
                                    con_txt = con_txt+add_con_txt;
                                  }else{
                                    var add_con_txt ="<h1>"+now_item_name+now_item_required_txt+"</h1>"+now_item_memo_txt+now_item_type_txt;
                                    con_txt = con_txt+add_con_txt;
                                  }

                                  num++;
                                  
                                });
                                $("#workspace_preview_con").html(con_txt);
                            }

                            
                            </script>

                        </div>
                       </div>

                    <div id='bt_area'>
                        <button type="button" class="btn btn-outline btn-primary btn-add-rows" style="float: left;">항목 추가</button>
                        <button id='post_project_info' onClick='save_form();' class='btn btn-info' style="float: right;">
                            <img src='/img/icon/icon_save_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt="icon" />저장하기
                        </button>
                     </div>
            </div>
        </div>

        <div id='workspace_preview' class='preview_area'>
            <div id='workspace_preview_con'>
                미리보기 영역
            </div>
        </div>
    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
</body>
</html>