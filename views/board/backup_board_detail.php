<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?$this->load->view('/include_pro/head_info');?>

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


         function save_board_con(){
            var editor = document.getElementById("wsw_iframe");
            editor.contentWindow.save_txt();   //  에디터 내용 반영


            var name = $("#name").val();
            var email = $("#email").val();
            var title  =$("#title").val();
            var con_txt = $("#con_txt").val();
            alert(con_txt);

            $.post('/new/board/noti_regist_insert/',{
                bo_name: name,
                bo_email: email,
                bo_title: title,
                bo_content: con_txt
            },
            function(data){
                alert(data);
                location.replace("/new/board/noti_list");

            });
         }



    </script>
</head>
<body>
<!-- 상단 영역 공통 시작-->
<div id='top_area'>
    <div id='top_noti'>
        <div id='top_noti_con'>
            <div id='top_noti_con_txt'>
                <!-- sub_top area include -->
                사각사각프로젝트는 복지사각지대와 개인기부자들을 연결합니다.
            </div>
            <div id='top_menu_area'>
                <!-- sub_top area include -->
                <?include_once $this->config->item('basic_url')."/include_pro/inc_top_menu_login.php";?>
            </div>
        </div>
    </div>
    <div id='top_con'>
        <?include_once $this->config->item('basic_url')."/include_pro/inc_top_menu.php";?>
    </div>
</div>
<!-- 상단 영역 공통 끝 -->
<div id='container'>
    <div id='con'>
        <div id='con_main'>
            <!-- 상단 메인 배너 -->
            <div id='sub_top_banner'>
                <div id='sub_top_banner_con'>
                    <div id='slider_con_1'>
                        <h2><?echo $link_board_title;?></h2>
                        <?echo $link_board_txt;?>
                    </div>

                </div>
            </div>
            <!-- 상단 메인 배너 끝 -->
            <!-- 왼쪽 콘텐츠 영역 시작 -->
            <div id='main_con_left'>
                <!--공지사항-->
                <div class='main_con_left_w con_outline'>
                    <?include_once $this->config->item('basic_url')."/include_pro/inc_board_sub_menu.php";?>

                </div>

            </div>

            <!-- 오른쪽 콘텐츠 영역 시작 -->
            <div id='main_con_right'>
                <!--새로 등록된 사연-->
                <div class='main_con_right_w con_outline'>
                    <h3><?echo $bo_title;?></h3>
                    <p class='date_st'><?echo date('Y-m-d', strtotime($bo_date));?></p>
                    <br/>
                    <table class='inno_table'>
                        <?if($bo_link!=''){
                            ?>
                        <tr>
                            <th colspan='2'>
                                연관 링크 : <a href='<?echo $bo_link;?>' target='_blank'><?echo $bo_link;?></a>
                            </th>
                        </tr>
                        
                        <?}?>
                        <tr>
                            <th colspan='2' style='font-weight: normal;'>
                                <?echo $bo_content;?>
                            </th>
                        </tr>

                        <tr>
                            <td>
                                작성자 :
                                <?echo $bo_name;?> (<?echo $bo_email;?>)
                            </td>
                            <td style='text-align: right;'>
                                조회수 :  <?echo $count;?>
                            </td>
                        </tr>
                    </table>
                    <br/>
                    <div style='width:100%; text-align: right;'>
                        <table style='width:100%;'>
                            <tr>
                                <td style='text-align: left;'>
                                    <a href='<?echo $link_board_list;?>'>
                                        <button class='inno_bt'>
                                            목록
                                        </button>
                                    </a>
                                </td>
                                <td style='text-align: right;'>
                                    <a href='<?echo $link_board_write;?><?echo $bo_id;?>'>
                                        <button class='inno_bt'>
                                            수정
                                        </button>
                                    </a>
                                    <a href='<?echo $link_board_delete;?><?echo $bo_id;?>'>
                                    <button class='inno_bt'>
                                        삭제
                                    </button>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?include_once $this->config->item('basic_url')."/include_pro/inc_bottom_info.php";?>

</div>
</body>
</html>