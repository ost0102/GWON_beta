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
    </script>
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
            <?/*
            <!-- 상단 메인 배너 -->
            <div id='board_slider'>
                <div id='board_slider_con'>
                    <div id='slider_con_1'>
                        <h3 class='g_point_bold' style="line-height: 25px;">
                            <?echo $link_board_title;?>
                        </h3>
                        <?echo $link_board_txt;?>
                    </div>
                </div>
            </div>
            <!-- 상단 메인 배너 끝 -->
            */?>
            <!-- 왼쪽 콘텐츠 영역 시작 -->
            <!-- 오른쪽 콘텐츠 영역 시작 -->
            <div id='main_con_left'>
                <!--게시판 메뉴-->
                <div class='main_con_left_w con_outline'>
                    <?include_once $this->config->item('basic_url')."/include/inc_board_sub_menu.php";?>

                </div>
            </div>
            <div id='main_con_right'>
                <div class='main_con_right_w con_outline'>
                    <h3><?echo $bo_title;?></h3>
                    <p class='date_st'><?echo date('Y-m-d', strtotime($bo_date));?></p>
                    <table class='inno_table'>
                        <tr>
                            <td>
                                작성자 :
                                <?echo $bo_name;?> 
                                <?if($bo_email!=''){
                                ?>
                                (<?echo $bo_email;?>)
                                <?
                                }
                                ?>
                            </td>
                            <td style='text-align: right;'>
                                조회수 :  <?echo $count;?>
                            </td>
                        </tr> 
                        <?if($bo_link!=''){
                            ?>
                        <tr>
                            <td colspan='2' style='text-align: left; background: #efefef;'>
                                연관 링크 : <a href='<?echo $bo_link;?>' target='_blank'><?echo $bo_link;?></a>
                            </td>
                        </tr>
                        <?}?>

                        <?if($bo_attach_link!=''){
                            ?>
                        <tr>
                            <td colspan='2' style='text-align: left; background: #efefef;'>
                                <a href='<?echo $bo_attach_link;?>' target='_blank' >첨부 파일 보기</a>
                            </td>
                        </tr>
                        <?}?>
                        <tr>
                            <th colspan='2' style='font-weight: normal;'>
                                <?echo $bo_content;?>
                            </th>
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
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
</body>
</html>