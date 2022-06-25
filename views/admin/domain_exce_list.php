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
                //도메인 추가하기
                $("#add_domain_ex").click(function(){
                    var domain_name = $('#input_domain_name').val();

                    $.post("/admin/add_domain_ex",{
                        domain_name: domain_name
                    },
                    function(data){
                        //alert(domain_name);
                        //입력값 초기화하기
                        open_modal(data);
                        fadeout_modal();
                        load_domain_ex_list();
                    });
                });


                //도메인 검색하기
                $("#search_domain_ex").click(function(){
                    var domain_name = $('#input_domain_name').val();
                    search_domain_ex_list(domain_name);
                });
    });

        //도메인 정보 가져오기
        function load_domain_ex_list(page_num){
            if(page_num==''||page_num=='undefind'){
                page_num = '';
            }
            $.get("/admin/get_domain_exception_list/?per_page="+page_num,function(data,status){
                //alert("Data: " + data + "\nStatus: " + status);
                $('#de_list_area').html(data);
                //사용자 정보를 받은 후, 프로젝트 팀원으로 등록하는 기능 개발하기
           });
        }

        function search_domain_ex_list(keyword){
            $.get("/admin/search_domain_exception_list/"+keyword,function(data,status){
                //alert("Data: " + data + "\nStatus: " + status);
                $('#de_list_area').html(data);
                //사용자 정보를 받은 후, 프로젝트 팀원으로 등록하는 기능 개발하기
           });
        }

         //도메인 삭제하기
        function del_domain_ex(de_id){
            $.post("/admin/del_domain_ex",{
                de_id: de_id
            },
            function(data){
                //입력값 초기화하기
                open_modal(data);
                fadeout_modal();
                load_domain_ex_list();
            });
        }
        //페이지 정보 로드
        load_domain_ex_list('<?echo $page;?>');
    </script>

    <style>
    </style>
</head>
<body>
<!-- 상단 영역 공통 시작-->
<div id='top_area'>
    <div id='top_noti'>
        <div id='top_noti_con'>
            <div id='top_noti_con_txt'>
                <!-- noti_txt -->
                <?include_once $this->config->item('basic_url')."/include/inc_top_noti_txt.php";?>
            </div>
            <div id='top_menu_area'>
                <!-- sub_top area include -->
                <?include_once $this->config->item('basic_url')."/include/inc_top_menu_login.php";?>
            </div>
        </div>
    </div>
    <div id='top_con'>
        <?include_once $this->config->item('basic_url')."/include/inc_top_menu.php";?>
    </div>
</div>
<!-- 상단 영역 공통 끝 -->
<div id='container'>
    <div id='con'>
        <div id='con_main'>
            <!-- 왼쪽 콘텐츠 영역 시작 -->
            <!-- 오른쪽 콘텐츠 영역 시작 -->
            <div id='main_con_left'>
                <!--게시판 메뉴-->
                <div class='main_con_left_w con_outline'>
                    <?include_once $this->config->item('basic_url')."/include/admin_menu.php";?>
                </div>
            </div>
            <div id='main_con_right'>
                <div class='main_con_right_w con_outline'>
                    <h1>사용금지 도메인 관리</h1>
                    <div style="font-weight: bold; margin-top: 10px; padding-left: 10px;">
                             <table>
                                <tr>
                                    <td class='td_title'>도메인명&nbsp;</td>
                                    <td class='td_input'>
                                        <input id="input_domain_name" name="input_domain_name" class="title" type="text" />
                                    </td>
                                    <td class='td_button'>
                                        &nbsp;
                                        <button id="add_domain_ex">추가하기</button>
                                        &nbsp;
                                        <button id="search_domain_ex">검색하기</button>

                                    </td>
                                </tr>
                               
                            </table>
                        </div>
                        <hr/>
                    <h3>현재 사용금지 도메인 리스트 </h3>
                    <div id='de_list_area' style='width: 100%;'>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
</body>
</html>