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


            });
        };
        $(document).ready(function() {
            //작업 창 높이 자동 조절
            check_workspace_h();
            //템플릿 정보 가져오기
            show_template();

            //템플릿 창 높이 조정
            check_template_area_h();
            ifr_h_resizing();

                //현재 스크롤
               // var win_h = $('#workspace_preview').height();
                //alert(win_h);
                //$("#con_iframe").height(win_h);
            

        });
        $(window).resize(function(){ 
            //작업 창 높이 자동 조절
            check_workspace_h();

            //템플릿 창 높이 조정
            check_template_area_h();
            ifr_h_resizing();
        });

        //템플릿 영역 높이 자동 조절
        function check_template_area_h(){
            
            var workspace_h = $('#workspace').height();
            var wp_center_con_h = $('#wp_center_con').height();
            var select_design_mode = $('#select_design_mode').height();
            var th_result = workspace_h-wp_center_con_h-select_design_mode-100;

            //alert('doc_h'+doc_h+'+top_area_h'+top_area_h+'+bottom_area'+bottom_area+'=workspace'+sum_con);
            if(th_result>100){
                //alert(sum_con);
                $('#design_template_area').height(th_result);
                
            }
        }
        //아이프레임 영역 높이 자동 조절
        function ifr_h_resizing(){
            var workspace_preview_template = $('#workspace_preview_template').height();
            var select_design_mode = $('#select_design_mode').height();
            var th_result = workspace_preview_template-select_design_mode-20;

            //alert('doc_h'+doc_h+'+top_area_h'+top_area_h+'+bottom_area'+bottom_area+'=workspace'+sum_con);
            if(th_result>100){
                //alert(sum_con);
                $('#con_iframe').height(th_result);
                
            }
        }

        //템플릿 정보 가져오기
        function show_template(){
            //window.open("/makepage/popup_template/","Select template",'width=500,height=430,left=0,top=0,scrollbars=no');
            /*window.open("/makepage/select_html/","select_design",'width=500,height=350,left=0,top=0,scrollbars=no');
            */
            $.get("/makepage/show_template/<?echo $w_num?>",function(data,status){
                //alert("Data: " + data + "\nStatus: " + status);
                //open_modal(data);
                //open_modal(data);
                $('#design_template_area').html(data);
           });
        }

        //코드 수정창의 상태에 따른 view mode 변경
        function view_mode(now_view){
            if(now_view=='mobile'){
                $('#con_iframe ').css('width','300px');
                $('#con_iframe ').css('margin-left','auto');
                $('#con_iframe ').css('margin-right','auto');
            }else{
                $('#con_iframe ').css('width','100%');
            }
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

                }
        }

        function popup_code(){
            var check_view_mode =$('#con_iframe').css('width');
            if(check_view_mode=='300px'){
                //현재 부모창이 mobile 버전 보기일경우 모바일보기에서 새로고침해라
                var code_num = 2;
            }else{
                //현재 부모창이 desktop 버전일경우 리로드해라
                var code_num = 1;
            }
            window.open("/makepage/edit_code/"+code_num,"Edit code",'width=800,height=600,left=0,top=0,scrollbars=no');
        }



    </script>

    <style type="text/css">

    #select_design_mode{
        float: left;
        text-align: center;
        width: 100%;
        margin:0px;
        padding-top: 10px;
        padding-bottom: 10px;
        background: #3ec0ce;
    }
    #con_iframe{
        width: 100%;
        border: 0px; 
        display: block;
    }

    @media (max-width:799px) {
        #select_design_mode{
            display: none;
        }
    }
    </style>
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
<div id='workspace_container'>
    <div id='workspace'>
        <!-- 왼쪽 콘텐츠 영역 시작 -->
        <!-- 오른쪽 콘텐츠 영역 시작 -->
        <div id='workspace_left' class='make_step'>
                <!--제작 단계 버튼-->
                <?$this->load->view('/include/inc_make_step');?>
        </div>
        <div id='workspace_design' class='wkarea_design'>
            <div id='wp_center_con'>
                    <div style='width: 100%; text-align: center;  background: #efefef; padding: 10px; margin-top:10px;'>
                            <a href="/makepage/select_design/<?echo $page_secur?>">템플릿</a>  |  
                            <a href="javascript:popup_code();">설정</a>
                    </div>
                    <h3>
                      디자인 템플릿 선택
                    </h3>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>


                    <div id='design_template_area' style='height: 100%;'>
                     </div>
            </div>
        </div>

        <div id='workspace_preview_template' class='preview_area'>
            <!--
            -->
            <iframe id="con_iframe" name="con_iframe" src="/makepage/mobile_view/<?echo $page_secur;?>"></iframe>
            <div id='select_design_mode'>
                <span style='font-weight:bold; padding-right: 10px;'>View mode</span>
                <a href='javascript:view_mode("desktop")'><img src='/img/icon/icon_desktop.png'></a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href='javascript:view_mode("mobile")'><img src='/img/icon/icon_mobile.png'></a>
            </div>
        </div>
    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
</body>
</html>