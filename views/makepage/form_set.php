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
                var win_h = $(window).height();
                var doc_h = $(document).height();
                var bottom_area = $("#bt_area").offset().top;

                //$("#bt_area_on").html("<span style='color: #000;'>scr_now : "+scr_now+" win_h : "+win_h+" doc_h : "+doc_h+" bottom_area : "+bottom_area+"</span>");

                /**/
                if(scr_now+win_h>=bottom_area){
                     $("#bt_area_on").fadeOut();
                     $("#bt_area").css("visibility","visible");
                }else{
                     $("#bt_area_on").fadeIn();
                     $("#bt_area").css("visibility","hidden");
                }
                //현재 스크롤
                //alert(scr_now);
                
                //현재 스크롤
                //alert(scr_now);
            });
        };
        $(document).ready(function() {
            show_preview();

            //soartalbe 영역에서 마우스 움직이면 실시간 반응하도록
            $("#sortable").mousemove(function() {
              show_preview();
            });

            //하단 버튼영역 고정
            /*
            콘텐츠 복사 -> bottom영역 하단에 붙여넣고, 클래스 주기
            */
            var bt_con = $("#bt_area").html();
            $("#bottom_area").append("<div id='bt_area_on'>"+bt_con+"</div>");
            $("#bt_area").css("visibility","hidden");
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

            //필수 입력 라벨 추가
            $("#"+item_name+" .use_check").attr("id","form_req"+new_item_num);
            $("#"+item_name+" .use_check_label").attr("for","form_req"+new_item_num);
            $("#"+item_name+" .form_icon_area").show();
            $("#"+item_name+" .form_memo_area").show();
            $('html, body').stop().animate( { scrollTop : $(document).height()  } );
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
            var now_id_check = $(val).parents('.list-group-item').attr("id");
            //var now_id_check = $(val).siblings('.form_option_area').attr("class");
            //alert(now_id_check)
            if(now_checked==true){
                $("#"+now_id_check+" .use_check_value").val(1);
            }else{
                $("#"+now_id_check+" .use_check_value").val(0);
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
    alert('기존에 입력된 사용자의 접수 정보가 있습니다. 접수 항목 구성을 변경하면 영향이 있을 수 있습니다.');
  </script>
  <?
  }
  ?>
  <script type="text/javascript">
    //<![CDATA[
    //새로운 항목 추가하기
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
        change_field_type(this);
    });
    $(document).on('change', '.use_check', function() {
        check_use(this);
    });
    //항목 이동과 관련된 설정
    $(function () {
        $('#sortable').sortable({
            handle:'.form_move_area'
        });
    });
    //항목 변경값에 따른 옵션값 노출 여부 설정 등
    function change_field_type(target_selcetor){
        if ($(target_selcetor).val() === 'radio' || $(target_selcetor).val() === 'select' || $(target_selcetor).val() === 'checkbox') {
            //형재요소 form_option_area 하부의 옵션 노출
            //$(target_selcetor).siblings(' .form_option_area').children('.options').show();
            //항목별 호출하는 값이 다르게
            var now_id_check = $(target_selcetor).parents('.list-group-item').attr('id');
            $(target_selcetor).parents(".form-group").css('background',"");
            $(target_selcetor).parents().siblings(' .form_title_area').show();
            $(target_selcetor).parents().siblings(' .form_memo_area').show();
            $(target_selcetor).parents().siblings(' .form_required_area').show();
            $(target_selcetor).siblings(' .form_option_area').show();

            set_option(now_id_check);

        }else if ($(target_selcetor).val() === 'page_branch') {
            //$(target_selcetor).parents(".form-group").css('border',"solid 1px #cdcdcd");
            $(target_selcetor).parents(".form-group").css('background',"#cdcdcd");
            $(target_selcetor).parents().siblings(' .form_title_area').show();
            $(target_selcetor).parents().siblings(' .form_memo_area').show();
            $(target_selcetor).parents().siblings(' .form_required_area').hide();
            $(target_selcetor).parents().siblings(' .form_option_con').hide();
            $(target_selcetor).siblings(' .form_option_area').hide();
            $(target_selcetor).siblings(' .form_option_area').children('.options').hide();

            alert('페이지 나누기를 선택하셨습니다. 입력항목과 설명을 입력해주시면, 분기화된 페이지 상단에 출력됩니다.');
        }else{
            $(target_selcetor).parents(".form-group").css('background',"");
            $(target_selcetor).parents().siblings(' .form_title_area').show();
            $(target_selcetor).parents().siblings(' .form_memo_area').show();
            $(target_selcetor).parents().siblings(' .form_required_area').show();
            $(target_selcetor).siblings(' .form_option_area').hide();
            $(target_selcetor).siblings(' .form_option_area').children('.options').hide();
        }
    }
    //옵션 설정
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
    //새로운 항목 옵션 추가
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
    //옵션정보를 options에 저장
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

    //기존옵션 정보에 대한 반영
    function check_before_option(now_id){
        //옵션 위치 - id 지정
        var now_option_con_position = "#"+now_id+" .options";
        var now_option_con_items_position = "#"+now_id+" .form_option_con";
        var now_option_con = $(now_option_con_position).html();
        var now_option_con_sp = now_option_con.split("\n");

        var num = 0;
        now_option_con_sp.forEach(function(now_option_item){
            //alert("item"+now_option_item);
            if(num==0){
             add_option_radio = '<div class="form_option_con_detail"><div class="form_option_con_input"><input type="text" class="form-control display_name s_opt" name="form_option_con[]" value="'+now_option_item+'" style="height:30px;" placeholder="옵션명을 입력해주세요." /></div><div class="form_option_con_bt"> <i class="margin-top-5 fa fa-plus-circle fa-2x default_blue" onClick="add_more_option(this);"></i></div></div>';

            }else{
            //항목 추가
            //신규 옵션의 경우 삭제버튼 있게
            add_option_radio = '<div class="form_option_con_detail"><div class="form_option_con_input"><input type="text" class="form-control display_name s_opt" name="form_option_con[]" value="'+now_option_item+'" style="height:30px;" placeholder="옵션명을 입력해주세요." /></div><div class="form_option_con_bt"> <i class="margin-top-5 fa fa-plus-circle fa-2x default_blue" onClick="add_more_option(this);"></i><i class="margin-top-5 margin-left-5 fa fa-times-circle default_red fa-2x remove_more_radio" onClick="del_this_option(this);"></i></div></div>';
            }

            //신규 항목 추가

            $(now_option_con_items_position).append(add_option_radio);
            num++;
        });
        //$(now_option_con_items_position).fadeIn();
        /**/
    }

     //옵션 선택
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

    //항목 변경 아이콘
    function bt_form_icon(now_selector,input_type){
        /*
        현재 선택한 것만 hover 효과, 다른건 흰색
        선택한 것으로 select 값 변경
        항목 유형 : 옆에 현재 선택한 값 출력

        */
        //현재 폼 id 구하기
        var now_form_id = $(now_selector).parents('.list-group-item').attr('id');

        //선택한 버튼 색상 변경하기
        $("#"+now_form_id+" .form_icon_area button").css("background","#fff");
        $(now_selector).css("background","#efefef");

        //현재 선택한 값을 셀렉트 박스에 반영하기
        $("#"+now_form_id+" .field_type").val(input_type);
        var now_type = $("#"+now_form_id+" .field_type");

        //현재 선택한 값 정보 출력하기
        var now_selector_txt = $("#"+now_form_id+" .field_type option:selected").text();
        $("#"+now_form_id+" .form_type_txt").html(now_selector_txt);

        change_field_type(now_type);
        show_preview();

    }

    //항목 변경창 출력하기
    function show_form_type_area(now_selector){
        var now_form_id = $(now_selector).parents('.list-group-item').attr('id');
         var now_form_type_area = $("#"+now_form_id+" .form_icon_area").css("display");
        //var now_form_id = $(this).parents('.list-group-item').attr('id');
        if(now_form_type_area=="block"){
            $(now_selector).text("설정창 열기");
            $("#"+now_form_id+" .form_icon_area").fadeOut();
            $("#"+now_form_id+" .form_memo_area").fadeOut();
            $("#"+now_form_id+" .form_option_con").fadeOut();
        }else{
            $(now_selector).text("설정창 닫기");
            $("#"+now_form_id+" .form_icon_area").fadeIn();
            $("#"+now_form_id+" .form_memo_area").fadeIn();
            $("#"+now_form_id+" .form_option_con").fadeIn();
        }
    }

    //미리보기 - 모달창
    function show_preview_modal(){
        var preview_data = $("#workspace_preview_con").html();
        var now_w = $(window).width()-10;
        $("#modal_txt").css('overflow',"auto");
        $("#modal_txt").css('margin-top',"10px");
        $("#modal_txt").css('height',"250px");
        $("#modal_txt").css('padding',"10px");
        $("#modal_txt").css('font-weight',"normal");
        $("#modal_content").css('width',now_w);
        $("#modal_content").css('height',"300px");
        $("#simplemodal-container").css('top',"10px");


        
        open_modal(preview_data);
    }

    //미리보기창 수정
    function show_preview(){
        $("#workspace_preview_con").html("");

        var num = 0;
        var page_num = 1;
        var con_txt = "<div class='form_preview'><h1>"+page_num+"페이지</h1>";
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
                  var now_item_type_txt_label = "<label for='"+value+"'>"+value+"</label><br/>";
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
                  var now_item_type_txt_label = "<label for='"+value+"'>"+value+"</label><br/>";
                  
                  now_item_type_txt = now_item_type_txt+now_item_type_radio+now_item_type_txt_label;
            });

          }else if(now_item_type=="upload"){
            now_item_type_txt= " <input type='file' />";

          }else if(now_item_type=="date"){
            now_item_type_txt= " <input type='date' />";

          }else if(now_item_type=="page_branch"){
            now_item_type_txt= "page_branch";

          }else if(now_item_type=="agree"){
           now_item_type_txt = "<input type='checkbox' name='"+num+"' id='"+num+"' ><label for='"+num+"'>동의합니다.</label>";

            
          }else{
            now_item_type_txt = "";
          }
          
          var page_branch = 'n';
          if(typeof now_item_name == "undefined"){
            //드래그 및 소트에이블 할때 undefined 나오는것 방지
          }else if(now_item_type == "page_branch"){
            page_num++;
            //페이지 나누기
            var add_con_txt ="</div><div class='form_preview'><h1>"+page_num+"페이지</h1>"+"<h1>"+now_item_name+"</h1>"+now_item_memo_txt;
            con_txt = con_txt+add_con_txt;
            page_branch = 'y';
          }else if(now_item_type == "agree"){
            if(now_item_name ==''){
                now_item_name = '제목을 입력하세요.';
            }
            var add_con_txt ="<h3>"+now_item_name+now_item_required_txt+"</h3><textarea>"+now_item_memo+"</textarea>"+now_item_type_txt;
            con_txt = con_txt+add_con_txt;
          }else{
            if(now_item_name ==''){
                now_item_name = '제목을 입력하세요.';
            }
            var add_con_txt ="<h3>"+now_item_name+now_item_required_txt+"</h3>"+now_item_memo_txt+now_item_type_txt;
            con_txt = con_txt+add_con_txt;
          }

          num++;
          
        });
        //분기화되어 있으면, 마지막에 div 한번 막아주기
        con_txt = con_txt+"</div>";
        $("#workspace_preview_con").html(con_txt);
    }
    </script>
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
                      접수 항목 구성
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
                                               <img src="/img/icon/icon_move_topdown.png" style="width: 12px; margin-right: 3px;" valign='middle' ><span style="font-size: 11px">이동</span>
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
                                        <div class="form_required_area">
                                            <input type="checkbox" id='form_req' class='use_check' onClick='check_use(this);' /> <label for='form_req_label' class='use_check_label' >필수 입력</label>
                                            <input type="hidden" class='use_check_value' name="use[]"  value="0"/>
                                            <a onClick="show_form_type_area(this);">설정창 닫기</a>
                                        </div>
                                         <div class="form_memo_area">
                                            <!--설명-->
                                            <textarea type="text" class="form-control display_memo" name="memo[]" value="" style="height:30px;" placeholder="입력 항목에 대한 설명이 필요한 경우 입력해주세요."><?echo $memo;?></textarea>
                                        </div>
                                         
                                         <div class="form_type_area">
                                            <div class="form_type_txt_area">
                                                  항목 유형 : <span class="form_type_txt">한줄 입력(text)</span> 
                                            </div>
                                             
                                             <select name="field_type[]" class="form-control field_type" id="field1" style="display: none;">
                                             <option value="text" title="/img/icon/icon_form_text.png" >한줄 입력(text)</option>
                                             <option value="textarea" title="/img/icon/icon_form_textarea.png" >여러줄 입력(textarea)</option>
                                             <option value="radio" title="/img/icon/icon_form_radio.png" >단일 선택(radio)</option>
                                             <option value="select" title="/img/icon/icon_form_select.png" >단일 선택(select)</option>
                                             <option value="checkbox" title="/img/icon/icon_form_checkbox.png" >다중 선택(checkbox)</option>
                                             <option value="upload" title="/img/icon/icon_form_upload.png" >파일업로드(Upload)</option>
                                             <option value="date" title="/img/icon/icon_form_date.png">일자(date)</option>
                                             <option value="page_branch" title="/img/icon/icon_form_pagebranch.png">페이지 나누기</option>
                                             <option value="agree" title="/img/icon/icon_agree.png">사용자 동의(약관 등)</option>
                                             </select>
                                             <div class="form_icon_area">
                                                 <button type="button" onClick='bt_form_icon(this,"text");' style="background: #efefef;"><img src="/img/icon/icon_form_text.png" class='form_icon'>한줄 입력(text)</button>
                                                 <button type="button" onClick='bt_form_icon(this,"textarea");' ><img src="/img/icon/icon_form_textarea.png" class='form_icon'>여러줄 입력(textarea)</button>
                                                 <button type="button" onClick='bt_form_icon(this,"radio");' ><img src="/img/icon/icon_form_radio.png" class='form_icon'>단일선택(radio)</button>
                                                 <button type="button" onClick='bt_form_icon(this,"select");' ><img src="/img/icon/icon_form_select.png" class='form_icon'>단일선택(select)</button>
                                                 <button type="button" onClick='bt_form_icon(this,"checkbox");' ><img src="/img/icon/icon_form_checkbox.png" class='form_icon'>다중선택(checkbox)</button>
                                                 <button type="button" onClick='bt_form_icon(this,"upload");' ><img src="/img/icon/icon_form_upload.png" class='form_icon'>파일업로드(Upload)</button>
                                                 <button type="button" onClick='bt_form_icon(this,"date");' ><img src="/img/icon/icon_form_date.png" class='form_icon'>일자(date)</button>
                                                 <button type="button" onClick='bt_form_icon(this,"page_branch");'><img src="/img/icon/icon_form_pagebranch.png" class='form_icon'>페이지 나누기</button>
                                                 <button type="button" onClick='bt_form_icon(this,"agree");'><img src="/img/icon/icon_agree.png" class='form_icon'>사용자 동의(약관 등)</button>
                                             </div>
                                            
                                             <div class="form_option_area">
                                               <textarea name="options[]" class="form-control options"   style="margin-top:5px; display:none;"  placeholder="선택 옵션 (엔터로 구분하여 입력)"></textarea>
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
                                                //$item_num = 1;
                                             foreach ($formset_info as $form_info) {
                                                $key = $form_info['key'];
                                                $item_id = $form_info['item_id'];
                                                //$item_id = 'item_'.$item_num;
                                                $display_name = $form_info['display_name'];
                                                $field_type = $form_info['field_type'];
                                                $options = $form_info['options'];
                                                $use = $form_info['use'];
                                                $memo = $form_info['memo'];
                                        ?>
                                        <div id="<?echo $item_id;?>" class="form-group list-group-item">
                                             <div class="form_move_icon_area">
                                                 <div class="form_move_area">
                                               <img src="/img/icon/icon_move_topdown.png" style="width: 12px; margin-right: 3px;" valign='middle' ><span style="font-size: 11px">이동</span>
                                                   <input type="hidden" name="key[]"/>
                                                </div>
                                                 <div class="form_dell_area">
                                                    <button type="button" class="btn btn-outline btn-default btn-xs btn-delete-row" >삭제</button>
                                                </div>
                                             </div>
                                              <div class="form_title_area">
                                                <!--항목명-->
                                                <input type="text" class="form-control display_name" name="display_name[]" style="height:30px;" placeholder="입력항목제목" value="<?echo $display_name;?>" />
                                            </div>
                                             <div class="form_required_area">
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
                                                <input type="checkbox" id='form_req_<?echo $item_id;?>' class='use_check' onClick='check_use(this);' <?echo $now_use_txt;?>/> <label for='form_req_<?echo $item_id;?>'>필수 입력</label>
                                                <input type="hidden" class='use_check_value' name="use[]"  value="<?echo $now_use;?>" />
                                                <a href="#" onClick="show_form_type_area(this); return false">설정창 열기</a>
                                            </div>
                                             <div class="form_memo_area">
                                                <!--설명-->
                                            <textarea type="text" class="form-control display_memo" name="memo[]" value="" style="height:30px;" placeholder="입력 항목에 대한 설명이 필요한 경우 입력해주세요."><?echo $memo;?></textarea>
                                            </div>
                                             <div class="form_type_area">
                                                <div class="form_type_txt_area">
                                                    <?
                                                    if($field_type=== 'text'){
                                                        $form_now_type_txt = '한줄 입력(text)';
                                                    }else if($field_type=== 'textarea'){
                                                        $form_now_type_txt = '여러 줄 입력(textarea)';
                                                    }else if($field_type=== 'radio'){
                                                        $form_now_type_txt = '단일 선택(radio)';
                                                    }else if($field_type=== 'select'){
                                                        $form_now_type_txt = '단일 선택(select)';
                                                    }else if($field_type=== 'checkbox'){
                                                        $form_now_type_txt = '다중 선택(checkbox)';
                                                    }else if($field_type=== 'upload'){
                                                        $form_now_type_txt = '파일업로드(Upload)';
                                                    }else if($field_type=== 'date'){
                                                        $form_now_type_txt = '일자(date)';
                                                    }else if($field_type=== 'page_branch'){
                                                        $form_now_type_txt = '페이지 나누기';
                                                    }else if($field_type=== 'agree'){
                                                        $form_now_type_txt = '사용자 동의';
                                                    }
                                                    ?>
                                                    항목 유형 : <span class="form_type_txt"><?echo $form_now_type_txt;?></span>  
                                                </div>
                                                 <select name="field_type[]" class="form-control field_type" id="field1" style="display: none;">
                                                 <option value="text" <?if($field_type=== 'text'){echo ' selected="selected"';}?> title="/img/icon/icon_form_text.png">한줄 입력(text)</option>
                                                   <option value="textarea" <?if($field_type=== 'textarea'){echo ' selected="selected"';}?> title="/img/icon/icon_form_textarea.png">여러줄 입력(textarea)</option>
                                                   <option value="radio" <?if($field_type === 'radio'){echo ' selected="selected"';}?> title="/img/icon/icon_form_radio.png">단일 선택(radio)</option>
                                                   <option value="select" <?if($field_type === 'select'){echo ' selected="selected"';}?> title="/img/icon/icon_form_select.png">단일 선택(select)</option>
                                                   <option value="checkbox" <?if($field_type === 'checkbox'){echo ' selected="selected"';}?> title="/img/icon/icon_form_checkbox.png">다중 선택(checkbox)</option>
                                                   <option value="upload" <?if($field_type === 'upload'){echo ' selected="selected"';}?> title="/img/icon/icon_form_upload.png" >파일업로드(Upload)</option>
                                                   <option value="date" <?if($field_type === 'date'){echo ' selected="selected"';}?> title="/img/icon/icon_form_date.png" >일자(date)</option>
                                                   <option value="page_branch" <?if($field_type === 'page_branch'){echo ' selected="selected"';}?> title="/img/icon/icon_form_pagebranch.png">페이지 나누기</option>
                                                   <option value="agree" <?if($field_type === 'agree'){echo ' selected="selected"';}?> title="/img/icon/icon_agree.png">사용자 동의(약관 등)</option>
                                                 </select>
                                                 <div class="form_icon_area">
                                                     <button type="button" onClick='bt_form_icon(this,"text");' <?if($field_type=== 'text'){echo 'style="background: #efefef;"';}?>><img src="/img/icon/icon_form_text.png" class='form_icon'>한줄 입력(text)</button>
                                                     <button type="button" onClick='bt_form_icon(this,"textarea");' <?if($field_type=== 'textarea'){echo 'style="background: #efefef;"';}?>><img src="/img/icon/icon_form_textarea.png" class='form_icon'>여러줄 입력(textarea)</button>
                                                     <button type="button" onClick='bt_form_icon(this,"radio");' <?if($field_type=== 'radio'){echo 'style="background: #efefef;"';}?>><img src="/img/icon/icon_form_radio.png" class='form_icon'>단일선택(radio)</button>
                                                     <button type="button" onClick='bt_form_icon(this,"select");' <?if($field_type=== 'select'){echo 'style="background: #efefef;"';}?>><img src="/img/icon/icon_form_select.png" class='form_icon'>단일선택(select)</button>
                                                     <button type="button" onClick='bt_form_icon(this,"checkbox");' <?if($field_type=== 'checkbox'){echo 'style="background: #efefef;"';}?>><img src="/img/icon/icon_form_checkbox.png" class='form_icon'>다중선택(checkbox)</button>
                                                     <button type="button" onClick='bt_form_icon(this,"upload");' <?if($field_type=== 'upload'){echo 'style="background: #efefef;"';}?>><img src="/img/icon/icon_form_upload.png" class='form_icon'>파일업로드(Upload)</button>
                                                     <button type="button" onClick='bt_form_icon(this,"date");' <?if($field_type=== 'date'){echo 'style="background: #efefef;"';}?>><img src="/img/icon/icon_form_date.png" class='form_icon'>일자(date)</button>
                                                     <button type="button" onClick='bt_form_icon(this,"page_branch");' <?if($field_type=== 'page_branch'){echo 'style="background: #efefef;"';}?>><img src="/img/icon/icon_form_pagebranch.png" class='form_icon'>페이지 나누기</button>
                                                     <button type="button" onClick='bt_form_icon(this,"agree");' <?if($field_type=== 'agree'){echo 'style="background: #efefef;"';}?>><img src="/img/icon/icon_agree.png" class='form_icon'>사용자 동의(약관 등)</button>
                                                 </div>
                                                 <div class="form_option_area">
                                                   <textarea name="options[]" class="form-control options"   style="margin-top:5px; display:none;"  placeholder="선택 옵션 (엔터로 구분하여 입력)"><?echo $options;?></textarea>
                                                    <div class="form_option_con"></div>
                                                    <?
                                                    if($options!=''){
                                                    ?>
                                                     <script>
                                                        check_before_option("<?echo $item_id;?>");
                                                    </script>
                                                    <?
                                                    }
                                                    
                                                    ?>
                                                 </div>
                                             </div>

                                              <input type="hidden" id="item_id" name="item_id[]" readonly style="height:30px;" value="<?echo $item_id;?>" placeholder="입력항목제목" />
                                        </div>
                                        <?
                                            if($field_type == 'page_branch'){
                                        ?>
                                            <script>
                                            $("#<?echo $item_id;?>").css('background',"#cdcdcd");
                                            $("#<?echo $item_id;?> .form_title_area").show();
                                            $("#<?echo $item_id;?> .form_memo_area").show();
                                            $("#<?echo $item_id;?> .form_required_area").hide();
                                            $("#<?echo $item_id;?> .form_option_con").hide();
                                            $("#<?echo $item_id;?> .form_option_area").hide();
                                            $("#<?echo $item_id;?> .form_option_area").children('.options').hide();

                                            </script>
                                        <?

                                            }
                                            //$item_num++;
                                            ?>
                                        <?
                                            }
                                        ?>
                                        <script>

                                            $( document ).ready( function() {
                                                var item_count = 0;
                                                var now_item_id = 0;
                                                var last_item_id = 0;
                                                $( '#sortable .list-group-item' ).each( function() {
                                                    now_item_id = $(this).attr('id');
                                                    now_num_spr = now_item_id.split('item_');
                                                    now_num = now_num_spr[1]*1;

                                                    if(last_item_id<=now_num){
                                                        last_item_id = now_num;
                                                    }else{
                                                        last_item_id = last_item_id;
                                                    }

                                                    item_count++;
                                                } );

                                                if(last_item_id>item_count){
                                                    total_item_id = last_item_id;
                                                }else{
                                                    total_item_id = item_count;
                                                }
                                                //total_count 추가시키기
                                                $('#item_count').val(total_item_id);
                                            } );

                                        </script>
                                        <?
                                        }
                                        ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                       </div>

                    <div id='bt_area'>
                        <button type="button" class="btn btn-outline btn-primary btn-add-rows">
                            <img src='/img/icon/icon_plus_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt="icon" />항목 추가
                        </button>
                        <button id='bt_show_preview_modal' onClick='show_preview_modal();' class='btn btn-default' >
                            미리보기
                        </button>
                        <button id='post_project_info' onClick='save_form();' class='btn btn-info'>
                            <img src='/img/icon/icon_save_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt="icon" />저장하기
                        </button>
                     </div>
            </div>
        </div>

        <div id='workspace_preview' class='preview_area'>
            <h3 style="padding-left: 10px; padding-top: 10px;">미리보기</h3>
            <div id='workspace_preview_con'>
                미리보기 영역
            </div>
        </div>
    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
</body>
</html>