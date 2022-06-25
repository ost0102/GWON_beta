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
            });
        };
        $(document).ready(function() {
            //하단 버튼영역 고정
            var bt_con = $("#bt_area").html();
            $("#bottom_area").append("<div id='bt_area_on'>"+bt_con+"</div>");
            $("#bt_area").css("visibility","hidden");

        });

        //본문 저장하기
        function save_con_txt(bt_state){

            var editor = document.getElementById("wsw_iframe");
            editor.contentWindow.save_txt();   //  에디터 내용 반영

            var input_w_num = $('#w_num').val();
            var apply_txt = $('#con_txt').val();
            //alert(apply_txt);

            $.post('/makepage/save_apply_intro',{
                input_w_num: input_w_num,
                apply_txt: apply_txt
            },
            function(data){
                //alert(data);
                //입력값 초기화하기
                //fade_body_text(data);
                if(data ==1){
                   data = '등록이 완료되었습니다.';
                    open_modal(data);
                }
                //alert('페이지의 콘텐츠 입력단계로 이동합니다.');
                //location.replace('/page/');
            });
        }


    </script>

    <style type="text/css">
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
        <div id='workspace_center' class='wkarea1'>
            <div id='wp_center_con'>
                    <!--콘텐츠 설정 메뉴-->
                    <?$this->load->view('/include/inc_con_set_menu');?>
                    <h1>
                      접수 안내
                    </h1>
                    <div class='t_title'>작성하는 양식의 실제 콘텐츠를 구성합니다.</div>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                    <input id='w_num' name='w_num' type='hidden' value='<?if(isset($w_num)) echo $w_num;?>'/>
        <div id='wsw_area' style='width:100%;'>
            <iframe id='wsw_iframe' name='wsw_iframe' src='/makepage/load_wysiwyg' width='99%' height='600' scrolling='no' frameborder='0' style='margin-bottom: 15px; border: 1px solid #cdcdcd;'></iframe>
            
            <textarea name="content" id="con_txt" style="display: none;"><?echo $apply_txt;?></textarea>
        </div>
                    <div id='bt_area'>
                        <button id='post_project_info' onclick='save_con_txt();' class='btn btn-info'><img src='/img/icon/icon_save_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt="icon" />저장하기</button>
                     </div>
            </div>
        </div>

        <div id='workspace_preview' class='preview_area'>
            <div>
                미리보기 영역
            </div>
        </div>
    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
</body>
</html>