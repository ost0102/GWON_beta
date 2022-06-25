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
            //변수값 확인
        if($('#input_title').val()){
            $('#input_title').removeClass();
            $('#input_title').addClass('focus_area');
        }
        if($('#input_img').val()){
            $('#input_img').removeClass();
            $('#input_img').addClass('focus_area');
        }
        if($('#easy_css_img').val()){
            $('#easy_css_img').removeClass();
            $('#easy_css_img').addClass('focus_area');
        }

        if($('#input_type').val() !== ''){
            //html 타입 값이 있다면 외각선 주기변경하기
            var type_val = $('#input_type').val();
            var type = '#html_type'+type_val;
            $(type).css('border','3px solid #cdcdcd');
        }
        //Title 값 변경
        $("#edit_title").click(function(){
            var input_title = $('#input_title').val();

            $.post("/makepage/edit_tem_title",{
                input_title: input_title
            },
            function(data){
                //alert(data);
                //입력값 초기화하기
                open_modal(data);
                //location.replace('/makepage/edit_css');
                //opener.location.reload();
                //if(data =="등록이 완료되었습니다."){}
            }); 
        });
        //script 값 변경
        $("#edit_script").click(function(){
            var input_script = $('#input_script').val();

            $.post("/makepage/edit_tem_script",{
            input_script: input_script
            },
            function(data){
                //alert(data);
                //입력값 초기화하기
                open_modal(data);
                //location.replace('/makepage/edit_css');
                //opener.location.reload();
                //if(data =="등록이 완료되었습니다."){}
            });
        }); 

        //Html type 값 변경
        $("#edit_type").click(function(){
            var input_type = $('#input_type').val();

            $.post("/makepage/edit_tem_type",{
                input_type: input_type
            },
            function(data){
                 //alert(data);
                 //입력값 초기화하기
                 open_modal(data);
                 //location.replace('/makepage/edit_css');
                 //opener.location.reload();
                 //if(data =="등록이 완료되었습니다."){}
            }); 
        });

        //code입력
        $("#bt_edit_code").click(function(){
            //code editor 코드 정보 가져오기
            var code_area = document.getElementById("code_area");
            var code_area_doc = code_area .contentWindow || code_area .contentDocument;
            code_area_doc.get_con();
        });

        //CSS간편편집 사용여부 변경
            $("#edit_check_easy_css").click(function(){
            var check_easy_css = $('input[name=check_easy_css]:checked').val();

            $.post("/makepage/edit_check_easy_css",{
                check_easy_css: check_easy_css
            },
            function(data){
                //alert(data);
                //입력값 초기화하기
                open_modal(data);
                //location.replace('/makepage/edit_css');
                //opener.location.reload();
                //if(data =="등록이 완료되었습니다."){}
            });
            });


         //logo 정보 가져오기
        $("#get_img").click(function(){
            window.open("/upload/up1/2","Edit code",'width=500,height=430,left=0,top=0,scrollbars=no');
        });

        //modal 관련
        $("#m_close").click(function(){
            $.modal.close();
            $modal_state ='off';
        });
        $modal_state ='off';
        $("body").click(function(){
            check_modal();
        });

        });

        //코드 반영하기 실제 동작!
        function update_code(){
            //코드 저장하기
            var file_name = $('#file_name').val();
            var css_con = $('#css_con').val();

           $.post("/makepage/insert_tamplet",{
                file_name: file_name,
                css_con: css_con
            },
           function(data){
             //alert(data);
             //입력값 초기화하기
             open_modal(data);
             //location.replace('/makepage/edit_css');
             //opener.location.reload();
             //if(data =="등록이 완료되었습니다."){}
           }); 

        }
        function select_html_type(type_value){
            var input_type = $('#input_type').val();
            //초기화하기
            $('#html_type1').css('border','1px solid #cdcdcd');
            $('#html_type2').css('border','1px solid #cdcdcd');
            var type = '#html_type'+type_value;
            $(type).css('border','3px solid #cdcdcd');
               
            $.post("/makepage/edit_tem_type",{
                input_type: type_value
            },
            function(data){
                open_modal(data);
            }); 
        }
        function select_code_type(code_type){
            location.href='/makepage/add_template/<?echo $tem_id;?>_'+code_type;
        }
        function goto_template(tem_id){
            location.href='/makepage/add_template/'+tem_id+'_1';
        }
    </script>
    <style type="text/css">
    #logo_area{
        padding-top: 10px;
        padding-bottom: 10px;
    }
    #con_area{
        padding-bottom: 20px;
    }
    #con_area table{
        width: 100%;
        max-width: 850px;
        text-align: left;
    }
    #con_area table td{
        padding-top: 5px;
        padding-bottom: 5px;
    }
    .td_title{
        max-width: 150px;
    }
    .td_input{
        max-width: 550px;
    }
    .td_button{
        max-width: 100px;
        padding-left: 20px;
        vertical-align: top;
    }
    #con_area img{
        border:1px solid #cdcdcd;
    }
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
                    <h3>템플릿 관리</h3>
                    <?
                    //iframe으로 변수 전달 시 세션 유지(ie6이상, 보안 문제로 세션 손실)
                    header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
                    if(isset($template_selecter)){
                        echo '<select name="category" id="board_category" onchange="goto_template(value);">';
                        foreach ($template_selecter as $template_selecter)
                        {
                            if(isset($tem_id)){
                                if($tem_id == $template_selecter['tem_id']){
                                    echo '<option value="'.$template_selecter['tem_id'].'" selected="selected">'.$template_selecter['tem_id'].'&nbsp;'.$template_selecter['tem_title'].'</option>';
                                }else{
                                    echo '<option value="'.$template_selecter['tem_id'].'">'.$template_selecter['tem_id'].'&nbsp;'.$template_selecter['tem_title'].'</option>';
                                }
                            }else{
                                echo '<option value="'.$template_selecter['tem_id'].'">'.$template_selecter['tem_id'].'&nbsp;'.$template_selecter['tem_title'].' </option>';
                            }
                        }
                                $new_tempalte = $template_selecter['tem_id']+1;
                                echo '<option value="'.$new_tempalte.'">+템플릿 추가하기</option>';
                        echo '</select>';
                     }
                    ?>
                    <div id='con_area'>
                        <div style="font-weight: bold; margin-top: 10px; padding-left: 10px;">
                             <table>
                                <tr>
                                    <td class='td_title'>템플릿 타이틀</td>
                                    <td class='td_input'>
                                        <input id="input_title" name="input_title" class="title" type="text" onfocus="this.className='focus_area'" onblur="if (this.value.length==0) {this.className='title';}else {this.className='focus_area';}" value="<?if(isset($tem_title)) echo $tem_title;?>"/>
                                    </td>
                                    <td class='td_button'>
                                        <button id="edit_title">변경하기</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class='td_title'>템플릿 개요</td>
                                    <td class='td_input'>
                                        <textarea id="input_script" name="input_script" style='width:100%;'><?if(isset($tem_script)) echo $tem_script;?></textarea>
                                    </td>
                                    <td class='td_button'>
                                        <button id="edit_script">변경하기</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class='td_title'>템플릿 html type</td>
                                     <td class='td_input'>
                                        <a onclick='select_html_type(1);'><img src='/img/html_type_1.jpg' id='html_type1'></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a onclick='select_html_type(2);'><img src='/img/html_type_2.jpg' id='html_type2'></a>
                                        <!-- 구 자료 형식-->
                                        <input id="input_type" name="input_type" type='hidden' value="<?if(isset($tem_type)) echo $tem_type;?>"/>
                                        
                                    </td>
                                    <td class='td_button'>
                                        <!-- 구 자료 형식
                                        <button id="edit_type">변경하기</button>-->
                                    </td>
                                </tr>
                                 <tr>
                                    <td class='td_title'>대표 이미지</td>
                                    <td class='td_input'>
                                        <input id="input_img" name="input_img" class="logo" type="text" disabled onfocus="this.className='focus_area'" onblur="if (this.value.length==0) {this.className='logo';}else {this.className='focus_area';}" value="<?if(isset($img_url)) echo $img_url;?>"/>
                                        <?if(isset($img_url)){
                                            echo '<img src="'.$img_url.'" style="width:100px;"><br/>';
                                        }?>
                                        <div id='logo_state class=t_basic'></div>
                                    </td>
                                    <td class='td_button'>
                                        <button id="get_img">이미지 업로드</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class='td_title'>샘플페이지</td>
                                    <td class='td_input'>
                                       <a href='<?=$this->config->item('base_url');?>/demo/page/<?echo $tem_id;?>' target='_blank'><?=$this->config->item('base_url');?>/demo/page/<?echo $tem_id;?></a>
                                    </td>
                                    <td class='td_button'>
                                    </td>
                                </tr>
                            </table>
                            <hr/>
                            <table>
                                <tr>
                                    <td class='td_title'>코드 타입</td>
                                    <td class='td_input'>
                                        <select name="category" onchange="select_code_type(value);">
                                            <option value="1" <? if(isset($tem_code)){ if($tem_code==1){ echo 'selected="selected"'; } } ?>>데스크탑 버전 CSS</option>
                                            <option value="2" <? if(isset($tem_code)){ if($tem_code==2){ echo 'selected="selected"'; } } ?>>모바일 버전 CSS</option>
                                            <option value="3" <? if(isset($tem_code)){ if($tem_code==3){ echo 'selected="selected"'; } } ?>>데스크탑 버전 js</option>
                                            <option value="4" <? if(isset($tem_code)){ if($tem_code==4){ echo 'selected="selected"'; } } ?>>모바일 버전 js</option>
                                        </select>
                                    </td>
                                    <td class='td_button'>
                                    </td>
                                </tr>
                            </table>
                            현재 파일 주소 : <?echo $filename_code;?>
                        </div>
                        <input id ="file_name" name ="file_name" type="hidden" value="<?echo $filename_code;?>"/>
                        <!--code editor 삽입-->
                        <?
                            $phpself=$_SERVER["PHP_SELF"];
                            $code_type = explode("/add_template/", $phpself);
                            $code_type = explode("_", $code_type[1]);
                            $code_type = $code_type[1];
                        ?>
                        <input id ='code_type' name ='code_type' type='hidden' value='<?echo $code_type;?>'/>
                        <iframe src='/makepage/code_area' width='98%' height='400px' id='code_area' marginwidth='0' marginheight='0'></iframe>
                        <textarea id="css_con" name="css_con" style="margin-top: 10px; width:95%;"><?echo $read_css;?></textarea><br/>
                        <button id="bt_edit_code">코드 적용하기</button><br/>
                </div>
                </div>
            </div>
        </div>

    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
</body>
</html>