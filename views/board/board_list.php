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
                    <h3 class='main_con_title'>
                        <?echo $link_board_title;?>
                    </h3>
                    <table class='inno_table'>
                        <tr>
                            <th>
                                제목
                            </th>
                            <th width='100px;'>
                                작성일
                            </th>
                        </tr>
                    
                    <?
                    if($list){
                    foreach($list as $item){?>

                        <tr class='inno_table_last_tr'>
                            <td>
                                <a href='<?echo $link_board_detail;?><?=$item->bo_id;?>'><?=$item->bo_title;?></a>
                            </td>
                            <td>
                                <?
                                echo date('Y-m-d', strtotime($item->bo_date));
                                ?>
                            </td>
                        </tr>
                        
                    
                    <?}
                    }else{

                        echo "
                             <tr class='inno_table_last_tr'>
                            <td>
                                해당하는 내용을 찾을 수 없습니다.
                            </td>
                            <td>
                            </td>
                        </tr>
                        ";
                    }?>

                    </table>
                    <br/>
                    <?if($u_group==1){?>
                    <div style='width:100%; text-align: right;'>
                        <a href='<?echo $link_board_write;?>'>
                        <button class='btn btn-default'>
                            글쓰기
                        </button>
                        </a>
                    </div>
                    <?}?>
                    <div style='width:100%; text-align: left; margin-top: 10px;'>
                        <input type="text" style='display: inline-block; width: 180px;'class="form-control" placeholder="검색어를 입력하세요.">
                        <button class='btn btn-default'>
                            글 찾기
                        </button>
                    </div>
                    <div style='width: 100%; text-align: center;' class="col-md-12">

                        <?=$pagination;?>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
</body>
</html>