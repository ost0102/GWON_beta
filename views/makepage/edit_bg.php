<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<?$this->load->view('/include/head_info');?>
<!-- //easy css. -->
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type='text/javascript'>
    //jQuery 있는 상태
    window.onload=function(){
        //scroll 변화시 작동하기       
        
    };
    $(document).ready(function() {
        //콘텐츠 영역별 기본 정보 가져오기

        //modal 관련
        $('#m_close').click(function(){
            $.modal.close();
            $modal_state ='off';
        });
        $modal_state ='off';
        $('body').click(function(){
            check_modal();
        });
        //최초 실행은 딜레이 없이 바로 실행
        check_background_update();
        //배경화면 변경여부 실시간확인
        setInterval(check_background_update, 1000);

    });
    //부모창 내 배경이미지 정보 검색
    function check_background_update(){
        //부모창 내 아이프레임의 요소 검색
        //상단영역 사용여부를 확인하여, 상단 콘텐츠 영역을 보여줄지 말지 결정하기
        check_intro = $("#con_iframe", opener.document).contents().find("#top_area").css("display");

        if(check_intro=='none'){
            $('#bgc_top_area').css('display','none');
             $('#bgc_top_area').hide();
        }else{
            var check_text =$("#con_iframe", opener.document).contents().find("#top_area").css("background");
            var check_text_container =$("#con_iframe", opener.document).contents().find("#container").css("background");

            //전체 배경영역
            if(check_text_container.indexOf('url')!==-1 && check_text_container.indexOf('url')!=="undefined" && check_text_container.indexOf('url')!=="" && check_text_container.indexOf('url')!==null){
                //alert(check_text_container);
                var split1 = check_text_container.split('url(');
                var split2 = split1[1].split(')');
                var now_bg_url = split2[0];
                //alert(now_bg_url);
                $('#bgc_contain_area').css('background',check_text_container);
                //$('#bgc_contain_area').css('background','url('+now_bg_url+')');
                //$('#bgc_contain_area').attr('bg_link',now_bg_url);
                $('#bgc_contain_state').html('사용 중');
                $('#bt_bgc_del_a').show();

                var now_bg_url1 = $('#bgi_url_100').val(now_bg_url);
                //alert(now_bg_url1);
            }else{
                $('#bgc_contain_area').css('background','');
                $('#bgc_contain_state').html('미 사용');
                $('#bt_bgc_del_a').hide();
            }

            //상단영역
            if(check_text.indexOf('url')!==-1 && check_text.indexOf('url')!=="undefined" && check_text.indexOf('url')!=="" && check_text.indexOf('url')!==null){
                var split1 = check_text.split('url(');
                var split2 = split1[1].split(')');
                var now_bg_url = split2[0];
                $('#bgc_top_area').css('background',check_text);
                //$('#bgc_top_area').css('background','url('+now_bg_url+')');
                $('#bgc_top_area').attr('bg_link',now_bg_url);
                $('#bgc_top_state').html('사용 중');
                $('#bt_bgc_del_0').show();

                var input_txt_area ='#bgi_url_0';
                $(input_txt_area).val(now_bg_url);
            }else{
                //check_text.replace('banana', 'tomato');
                $('#bgc_top_area').css('background','');
                $('#bgc_top_state').html('미 사용');
                $('#bt_bgc_del_0').hide();
            }

        }
    }

    function upload_bg_img(img_state){
        //alert(img_state);
        var now_con_area = '#bgi_url_'+img_state;
        var old_bgimg_url = $(now_con_area).val();
        //alert(old_bgimg_url);

        $.post('/upload/bgi_up',{
            img_state: img_state,
            old_bgimg_url: old_bgimg_url
        },
        function(data){
            //입력값 초기화하기
            window.open('/upload/up1/5','upload_img','width=500,height=430,left=0,top=0,scrollbars=no');
        });
    }

    function del_bg_img(img_state){
        //alert(img_state);
        var now_con_area = '#bgi_url_'+img_state;
        var now_bgimg_url = $(now_con_area).val();
        //alert(now_bgimg_url);

        $.post('/upload/bgi_del',{
            img_state: img_state,
            now_bgimg_url: now_bgimg_url
        },
        function(data){
            //입력값 초기화하기
            //부모창부터 로딩 시작. 그래야 팝업의 새로고침이 제대로 먹음
            opener.location.reload(true);
            alert(data);
            //$("#result_del").html(data);
            //location.reload(true);
        });
    }
    function bgc_m_close(){
        self.close();
    }
</script>
<style>
    body{
        background: #fff;
    }
    #container{
        margin-top: 0px;
    }
    #con{
        padding: 0px;
        background: #fff;
    }
    #con_area{
        width: 100%;
        text-align: center;
    }
    #bgc_con_area{
        padding-top: 10px;
    }
    .bg_controller_area{
        width: 100%;
        padding-top: 100px;
        padding-bottom: 100px;
        border-top: 1px solid #cdcdcd;
        font-family: 'Nanum Gothic';
        text-align: center;
    }
    #bgc_bottom, #bgc_bottom2{
        display: none;
    }
    .bgc_state{
        width: 100%;
        padding-top:10px;
        padding-bottom:10px;
        font-family: 'Nanum Gothic';
        text-align: center;
    }
    .con_area_div{
        width: 100%;
        padding-top: 20px;
        padding-bottom: 10px;
    }

    .cate_div{
        float: left; 
        margin-right: 5px; 
        margin-bottom: 5px; 
        padding: 10px; 
        border: 1px solid #cdcdcd;
        cursor: pointer;
        text-align: center;
    }
    .img_div{
        float: left; 
        margin-right: 5px; 
        margin-bottom: 5px; 
        padding: 5px; 
        border: 1px solid #cdcdcd;
        cursor: pointer;
        text-align: center;
    }
</style>
</head>
<body>
<div id='container'>
    <div id='con'>
        <div id='con_area'>
                <div style='font-weight: bold; padding: 10px; background: #efefef;margin-bottom: 10px; text-align: center;'>
                    <?//iframe으로 변수 전달 시 세션 유지(ie6이상, 보안 문제로 세션 손실)
                    header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');?>
                    <?$this->load->view('/include/inc_design_popup_menu.php');?>
               </div>
                배경이미지를 업로드한 이미지로 수정하실 수 있습니다.
                <div id='bgc_con_area'>
                    <!-- background 변경 기능 -->
                    <script type='text/javascript'>
                    //각 콘텐츠 영역에 배경 이미지 적용여부 파악하기
                    function check_bg_val(val_id){
                        //alert('test');
                        //부모창의 콘텐츠 영역의 배경 style 값 가져오기
                        var check_text =$("#con_iframe", opener.document).contents().find("#con_con"+val_id).css("background");
                        if(typeof check_text == "undefined" || check_text == null || check_text == ""){
                            //해당 하목의 값이 없다면..열외
                        }else{
                            //
                            if(check_text.indexOf('url')!=-1 || "undefined" || check_text == null || check_text == ""){
                                //alert(check_text);
                                var split1 = check_text.split('url(');
                                var split2 = split1[1].split(')');
                                var now_bg_url = split2[0];
                                //alert(split2[0]);
                                var now_con_area = '#bgc_'+val_id;
                                $(now_con_area).css('background','url('+now_bg_url+')');
                                var now_con_state = '#bgc_'+val_id+'_state';
                                $(now_con_state).html('사용 중');

                                var input_txt_area ='#bgi_url_'+val_id;
                                $(input_txt_area).val(now_bg_url);
                            }else{
                                var now_con_state = '#bgc_'+val_id+'_state';
                                $(now_con_state).html('미 사용');
                                $('#bt_bgc_del_'+val_id).hide();
                            }
                        }
                        
                    }
                    </script>
                    <!--
                    <div style="width: 100%;">
                        <div id="result_del"></div>
                    </div>
                     -->
                    <div id='bgc_contain_area' class='bg_controller_area'>    
                        <h1>전체 영역</h1>
                        <div id='bgc_contain_state' class='bgc_state'> 
                        </div>
                        <input id='bgi_url_100' type='hidden' value='' style='width:100%;'/>
                        <button id='bt_bgc_a' onclick='upload_bg_img(100);' class="btn btn-success"><img src='/img/icon/icon_img_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt="upload image button" />배경 변경</button>
                        <button id='bt_bgc_del_a' onclick='del_bg_img(100);'  class="btn btn-warning">배경 삭제</button>
                    </div>
                    <div id='bgc_top_area' class='bg_controller_area'>    
                        <h1>상단영역</h1>
                        <div id='bgc_top_state' class='bgc_state'> 
                        </div>
                        <input id='bgi_url_0' type='hidden' value='' style='width:100%;'/>
                        <button id='bt_bgc_top' onclick='upload_bg_img(0);' class="btn btn-success"><img src='/img/icon/icon_img_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt="upload image button" />배경 변경</button>
                        <button id='bt_bgc_del_0' onclick='del_bg_img(0);'  class="btn btn-warning">배경 삭제</button>
                    </div>
                    <!--각 콘텐츠 영역의 값 존재 유무 체크해서 출력하기-->
                     <? 
                        $i=1;
                        if(isset($con_title)){
                        if($con_title!=''){
                     ?>
                        <div id='bgc_<?echo $i;?>' class='bg_controller_area'> 
                          <h1><? echo $con_title[$i]; ?></h1>
                          <div id='bgc_<?echo $i;?>_state' class='bgc_state'> 
                          </div>
                          <input id='bgi_url_<?echo $i;?>' type='hidden' value='' style='width:100%;'/>
                          <button id='bt_bgc_con_<?echo $i;?>' onclick='upload_bg_img(<?echo $i;?>);'  class="btn btn-success"><img src='/img/icon/icon_img_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt="upload image button" />배경 변경</button>
                          <button id='bt_bgc_del_<?echo $i;?>' onclick='del_bg_img(<?echo $i;?>);'  class="btn btn-warning">배경 삭제</button>
                        </div>
                        <script type='text/javascript'>
                            //현재 콘텐츠 영역의 배경정보 가져오기
                            check_bg_val(<?echo $i;?>);
                        </script> 
                    <?}}?>
                </div>
                <script type='text/javascript'>
                    
                </script> 
        </div>
        <div id='bgc_bottom'>
            <a onclick="bgc_m_close();">닫기</a>
        </div>
    </div>
</div>
<!--모달창 출력부분 시작-->
<div id='modal_content'>
     <div id='modal_txt'>
        가상 팝업 내용 출력부분!
    </div>
    <div id=login_close>
        <a onClick='modal_off()'><img src='/img/land/bt_close.png'></a>
    </div>
</div>
<!--모달창 출력부분 끝 -->
<!--modal창 관련 -->
<script type='text/javascript' src='/js/jquery.simplemodal.js'></script>
</body>
</html>