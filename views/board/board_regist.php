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

        function save_board_con(){
            var editor = document.getElementById("wsw_iframe");
            editor.contentWindow.save_txt();   //  에디터 내용 반영

            var bo_id = $("#bo_id").val();
            var name = $("#name").val();
            var email = $("#email").val();
            var bo_link = $("#bo_link").val();
            var file_attachment = $("#input_file_attachment").val();

            var title  =$("#title").val();
            var con_txt = $("#con_txt").val();


            $.post('<?echo $link_data_insert;?>',{
                bo_id: bo_id,
                bo_name: name,
                bo_email: email,
                bo_link: bo_link,
                file_attachment: file_attachment,
                bo_title: title,
                bo_content: con_txt
            },
            function(data){
                if(data==1||data==2){
                    location.replace("<?echo $link_noti_list;?>");
                }else{
                    alert(data);
                }
                

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
                            <td style='width: 100px;'>
                                이름
                            </td>
                            <td>
                                <input id='name' type='text' class='form-control' style='width: 95%; margin-bottom: 10px;' value='<?echo $admin_name;?>'/>
                                <input id='bo_id' type='hidden' class='form-control' style='width: 95%; margin-bottom: 10px;' value='<?echo $bo_id;?>'/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                이메일
                            </td>
                            <td>
                                <input id='email'  type='text' class='form-control' style='width: 95%; margin-bottom: 10px;' value='<?echo $admin_email;?>'/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                제목
                            </td>
                            <td>
                                <input id='title'  type='text' class='form-control' style='width: 95%; margin-bottom: 10px;' value='<?echo $bo_title;?>'/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                링크
                            </td>
                            <td>
                                <input id='bo_link'  type='text' class='form-control' style='width: 95%; margin-bottom: 10px;' value='<?echo $bo_link;?>'/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                파일 첨부
                            </td>
                            <td>
                                <input id='input_file_attachment' name='input_file_attachment' type='hidden' placeholder='' value='<?if(isset($bo_attach_link)) echo $bo_attach_link;?>'/>
                                <button id='bt_file_attachment' onclick="upload_notice_file_attachment();" class="btn btn-inverse">업로드</button>
                                <button id="bt_delete_file_attachment" onclick='del_notice_file_attachment();' class="btn btn-inverse">삭제</button>
                                <?
                                if(isset($bo_attach_link)){
                                    if($bo_attach_link==''){
                                        echo '<script>
                                        $("#bt_delete_file_attachment").hide();
                                        </script>';
                                    }else{
                                        echo '<script>
                                        $("#bt_file_attachment").hide();
                                        </script>';
                                    }
                                }else{
                                    echo '<script>$("#bt_delete_file_attachment").hide();</script>';
                                }
                                 ?>
                                <div id='file_attachment_url'>
                                    <?
                                    if(isset($bo_attach_link)){
                                        if($bo_attach_link!=''){
                                           echo "<a href='".$bo_attach_link."' target='_blank'>첨부 파일 보기</a>";
                                        }
                                    }
                                    ?>
                                </div>
                                <script>
                                //첨부 서류 업로드
                                function upload_notice_file_attachment(){
                                    window.open('/upload/up1/12?bo_id=<?echo $bo_id;?>','upload_img','width=500,height=430,left=0,top=0,scrollbars=no');
                                }

                                function del_notice_file_attachment(){
                                    var file_attachment_url = $('#input_file_attachment').val();
                                    var bo_id = '<?echo $bo_id;?>';
                                    //alert(post_logo_addr);
                                    //alert(post_logo_addr);

                                    $.post('/board/del_file_attachment',{
                                            file_attachment_url: file_attachment_url,
                                            bo_id: bo_id
                                        },
                                        function(data){
                                            //alert(data);
                                            //입력값 초기화하기
                                            if(data==1){
                                                $('#input_file_attachment').val('');
                                                $('#file_attachment_url').html('');
                                                $('#bt_file_attachment').show();
                                                $('#bt_delete_file_attachment').hide();
                                            }else{
                                                alert(data);
                                            }
                                            //추가 해야할 사항 로고 업로드시 변동 부분, 그리고 실제 하단 코드 부분에 버튼 추가하고 보이도록 설정
                                        });
                                }
                                </script>
                            </td>
                        </tr>

                        <tr>
                            <th colspan='2'>
                                    <div id='wsw_area' style='width:100%;'>
                                        <iframe id='wsw_iframe' name='wsw_iframe' src='/board/load_wysiwyg' width='99%' height='500' scrolling='no' frameborder='0' style='margin-bottom: 15px; border: 1px solid #cdcdcd;'></iframe>

                                        <textarea rows="2" cols="10" name="content" id="con_txt" class='form-control' style="display: none;"><?echo $bo_content;?></textarea>
                                    </div>
                            </th>
                        </tr>
                    </table>
                    <br/>
                    <?if($u_group==1){?>
                    <div style='width:100%; text-align: right;'>
                        <button id='board_write' onclick='save_board_con();' class='btn btn-default'>
                            글쓰기
                        </button>
                    </div>
                    <?}?>
                </div>
            </div>
        </div>

    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
</body>
</html>