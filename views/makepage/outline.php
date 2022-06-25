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
            });
        };
        $(document).ready(function() {
            //하단 버튼 영역 고정
            var bt_con = $("#bt_area").html();
            $("#bottom_area").append("<div id='bt_area_on'>"+bt_con+"</div>");
            $("#bt_area").css("visibility","hidden");


            //도메인 정보 가져오기
            $('#input_check_domain').keyup(function(e){
                var input_domain = $('#input_check_domain').val();
                var before_domain = $('#input_domain').val();
                var input_w_num = $('#w_num').val();

                var regEngNum = /^[A-Za-z0-9_]+$/; // 영문+숫자 only 정규식 표현
                if(!regEngNum.test(input_domain)){
                    //alert("숫자와 영문만 입력하세요."); // vEngNum class 보유중 숫자 + 영문 외 문자가 포함되어 있다면 alert
                    $('#domain_state').text("숫자와 영문만 입력하세요.");
                    $('#input_check_domain').val(before_domain);
                    forms.eq(i).focus();
                    return false;
                }

                $.post('/makepage/check_domain',{
                        input_domain: input_domain,
                        input_w_num: input_w_num
                    },
                    function(data){
                        //alert(data);
                        //입력값 초기화하기
                        //open_modal(data);
                        if(data==1){
                            $('#domain_state').text('이용 가능한 URL입니다.');
                        }else{
                            $('#domain_state').text(data);
                        }
                        if(data==1){
                            $('#input_domain').val(input_domain);
                        }
                        $('#url2').text(input_domain);
                        $('#url3').text(input_domain);
                    });
            });


            //datapicker 설정
            $.datepicker.setDefaults( $.datepicker.regional[ "ko" ] );
            $("#input_start_date").datepicker({
                showMonthAfterYear: true , // 월, 년순의 셀렉트 박스를 년,월 순으로 바꿔준다. 
                dayNamesMin: ['일','월', '화', '수', '목', '금', '토'], // 요일의 한글 형식.
                 nextText: '다음 달',
                 prevText: '이전 달', 
                monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'], 
                monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'], // 월의 한글 형식
                yearSuffix: '년',
                dateFormat: "yy-mm-dd",  // 데이터 포멧 , 20120905 형식 
                beforeShow: function(input) {
                    var i_offset = jQuery(input).offset();      // 클릭된 input의 위치값 체크
                    setTimeout(function(){
                        $('#ui-datepicker-div').css({'top':i_offset.top, 'bottom':''});  
                        // datepicker의 div의 포지션을 강제로 클릭한 input 위취로 이동시킨다.

                    })
                }
            });
            $("#input_end_date").datepicker({
                showMonthAfterYear: true , // 월, 년순의 셀렉트 박스를 년,월 순으로 바꿔준다. 
                dayNamesMin: ['일','월', '화', '수', '목', '금', '토'], // 요일의 한글 형식.
                 nextText: '다음 달',
                 prevText: '이전 달', 
                monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'], 
                monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'], // 월의 한글 형식
                yearSuffix: '년',
                dateFormat: "yy-mm-dd",  // 데이터 포멧 , 20120905 형식 
                beforeShow: function(input) {
                    var i_offset = jQuery(input).offset();      // 클릭된 input의 위치값 체크
                    setTimeout(function(){
                        $('#ui-datepicker-div').css({'top':i_offset.top, 'bottom':''});  
                        // datepicker의 div의 포지션을 강제로 클릭한 input 위취로 이동시킨다.

                    })
                }
            });


        });

       //logo 업로드 창 열기
        function get_logo(){
            window.open('/upload/up1/1','upload_img','width=500,height=430,left=0,top=0,scrollbars=no');
        }
        //로고 삭제
        function del_logo(){
            var post_logo_addr = $('#input_logo').val();
            var post_w_num = $('#w_num').val();
            //alert(post_logo_addr);
            //alert(post_logo_addr);

            $.post('/makepage/delete_logo',{
                    post_logo_addr: post_logo_addr,
                    post_w_num: post_w_num
                },
                function(data){
                    //alert(data);
                    //입력값 초기화하기
                    if(data==1){
                        $('#logo_img').attr('src','/img/upload_logo.jpg');
                        $('#logo_img').css('width','230px');
                        $('#bt_delete_logo').hide();
                    }else{
                        alert(data);
                    }
                    //추가 해야할 사항 로고 업로드시 변동 부분, 그리고 실제 하단 코드 부분에 버튼 추가하고 보이도록 설정
                });
        }
        //첨부 서류 업로드
        function upload_file_attachment(){
            window.open('/upload/up1/11?w_num=<?echo $w_num;?>','upload_img','width=500,height=430,left=0,top=0,scrollbars=no');
        }

        function del_file_attachment(){
            var file_attachment_url = $('#input_file_attachment').val();
            var post_w_num = $('#w_num').val();
            //alert(post_logo_addr);
            //alert(post_logo_addr);

            $.post('/makepage/del_file_attachment',{
                    file_attachment_url: file_attachment_url,
                    post_w_num: post_w_num
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
        function check_wnum(){
            var input_title = $('#input_title').val();
            var input_domain = $('#input_domain').val();
            $.post('/makepage/check_wnum',{
                    input_title: input_title,
                    input_domain: input_domain
                },
                function(data){
                    if(data==0){
                        //빈항목일때는 아무것도 실행하지말기
                    }else{
                        //w_num을 삽입하기
                        $('#w_num').val(data);
                    }
                });
        }

        function goto_con_detail(){
            var input_title = $('#input_title').val();
            var input_domain = $('#input_domain').val();
            $.post('/makepage/check_secure',{
                    input_title: input_title,
                    input_domain: input_domain
                },
                function(data){
                    if(data==0){
                        //빈항목일때는 아무것도 실행하지말기
                    }else{
                        //공백제거
                        data = data.trim();
                        location.href='/makepage/con_detail/'+data;
                    }
                });
        }
        //저장하기
        function save_outline(){

            var input_w_num = $('#w_num').val();
            var input_title = $('#input_title').val();
            var input_summary = $('#input_summary').val();
            var input_logo = $('#input_logo').val();
            var input_domain = $('#input_domain').val();
            var input_start_date = $('#input_start_date').val();
            var input_end_date = $('#input_end_date').val();
            var input_start_time = $('#start_time').val();
            var input_end_time = $('#end_time').val();
            var input_contact = $('#input_contact').val();
            var input_file_attachment = $('#input_file_attachment').val();


            if(input_title==''){
                alert('제목을 입력해주세요.');
            }else  if(input_domain==''){
             alert('사용을 원하시는 페이지 URL을 입력해주세요.');
            }else  if(input_summary==''){
                alert('프로젝트에 대한 간략한 소개글을 입력해주세요.');
            }else{

                $.post('/makepage/input_project_info',{
                        input_w_num: input_w_num,
                        input_title: input_title,
                        input_summary: input_summary,
                        input_logo: input_logo,
                        input_domain: input_domain,
                        input_start_date: input_start_date,
                        input_end_date: input_end_date,
                        input_start_time: input_start_time,
                        input_end_time: input_end_time,
                        input_contact: input_contact,
                        input_file_attachment: input_file_attachment
                    },
                    function(data){
                        //alert(data);
                        //입력값 초기화하기
                        //fade_body_text(data);
                        if(data ==1 || data==2){
                            var modal_txt = '등록이 완료되었습니다.<br/><button onclick="goto_con_detail();" class="btn btn-info">다음단계로 이동하기</button>';
                        }else{
                            modal_txt = data;
                        }


                        open_modal();
                        $('#modal_txt').html(modal_txt);
                        //fadeout_modal();
                        $('#val_url').val('');
                        $('#val_url_txt').val('');
                        check_wnum();
                        
                        
                        //alert('페이지의 콘텐츠 입력단계로 이동합니다.');
                        //location.replace('/page/');
                    });
            }
        }


    </script>

    <style type="text/css">
        .controls {
            margin-top: 16px;
            border: 1px solid transparent;
            us: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            /*height: 32px;*/
            outline: none;
            /*box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);*/
        }
        #type-selector {
            color: #fff;
            background-color: transparent;
            padding: 0px 0px 0px 0px;
        }
        #type-selector label button {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }
        #type-selector button {
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
        <div id='workspace_center' class='wkarea1'>
            <div id='wp_center_con'>
                    <h1>
                      기본 정보 입력
                    </h1>
                    <div class='t_title'>작성하는 양식의 기본정보를 입력해 주세요.</div>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>

                    <!--form 값 입력 -->
                    <input id='w_num' name='w_num' type='hidden' value='<?if(isset($w_num)) echo $w_num;?>'/>

                    <h3 title='프로젝트를 대표하는 이미지를 업로드해주세요.'>대표 이미지 / 로고 이미지</h3>
                    <?if(isset($logo) && $logo != ''){
                        echo '<img id="logo_img" src="'.$logo.'" align=top style="width:100px;">';

                    }else{
                        echo '<a href="javascript:get_logo();" ><img src="/img/upload_logo.jpg" id="logo_img" align="top" style="max-width: 150px;" alt="upload image" /></a>';
                    }?>
                    <input id='input_logo' name='input_logo' type='hidden' value='<?if(isset($logo)) echo $logo;?>'/>
                    &nbsp;&nbsp;&nbsp;
                    <button id='get_logo' onclick='get_logo();' class='btn btn-inverse'>
                        <img src='/img/icon/icon_img_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt="upload image button" />업로드
                    </button>
                    <button id="bt_delete_logo" onclick='del_logo();' class="btn btn-inverse">삭제</button>
                    <div id='logo_state' class='t_basic'></div><br/>
                    <?if(isset($logo) && $logo != ''){
                        echo "<script>$('#get_logo').hide();</script>";

                    }?>

                    <h3>제목</h3>
                    <input id='input_title' name='input_title' type='text' placeholder='생성할 양식의 제목을 입력해주세요.' value='<?if(isset($title)) echo $title;?>'/>

                    <br/>
                    <hr/>
                    <h3>소개</h3>
                     <textarea id='input_summary' name='input_summary' placeholder='한문단 이내로 생성하는 양식의 요약글을 작성해주세요.'><?if(isset($summary)) echo $summary; ?></textarea>

                    <br/>
                    <hr/>
                    <h3 title='원하시는 공고 사이트 세부주소를 입력해주세요.'>URL <span style="font-size: 12px;">Gwon 공고에서 사용할 link</span></h3>
                    <table width='100%'>
                        <tr>
                            <td style='text-align: left; width: 50px;'>http://gwon.net/</td>
                            <td valign='top' style='text-align: left;'>
                                <!--check domain을 통해 체크하고, 값이 등록가능하다면, input도메인으로 변수 전달-->
                                <input id='input_check_domain' name='input_check_domain' type='text' placeholder='3자 이상으로 입력해주세요.' value='<?if(isset($domain)) echo $domain;?>'/>
                                <input id='input_domain' name='input_domain' type='hidden' value='<?if(isset($domain)) echo $domain;?>'/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='3'><div id='domain_state' class='t_basic'></div></td>
                        </tr>
                    </table>
                    <hr/>
                    <h3>모집 시작일</h3>
                    <input id='input_start_date' name='input_start_date' type='text' placeholder='시작일을 선택해주세요.' style="float: left; width:100px;" value="<?if(isset($start_date)) echo $start_date;?>" autocomplete="off"/>
                    <select name="start_time" id="start_time" style="float: left; width:100px; height: 27px; margin-left: 10px;">
                        <option>시작 시간</option>
                        <?
                            for($time=0;$time<24;$time++){
                                $ws_now_check = 0;
                                if($time<10){
                                    $time_num ='0'.$time;
                                }else{
                                    $time_num = $time;
                                }
                                if($start_time==$time_num.':00:00'){
                                    $ws_now_check = 1;
                                }else if($start_time==$time_num.':30:00'){
                                    $ws_now_check = 2;
                                }else if($start_time==$time_num.':59:00'){
                                    $ws_now_check = 3;
                                }else{
                                    $ws_now_check = 0;
                                }
                        ?>
                            <option <?if($ws_now_check==1){?>selected="selected"<?}?>><?echo $time;?>:00</option>
                            <option <?if($ws_now_check==2){?>selected="selected"<?}?>><?echo $time;?>:30</option>
                            <?
                            if($time=='23'){
                                ?>
                                <option <?if($ws_now_check==3){?>selected="selected"<?}?>><?echo $time;?>:59</option>
                                <?
                            }
                            ?>
                                    <?
                                        }
                                    ?>
                    </select>
                    <br/>

                    <h3>모집 종료일</h3>
                    <input id='input_end_date' name='input_end_date' type='text' placeholder='종료일을 선택해주세요.' style="float: left; width:100px;" value="<?if(isset($end_date)) echo $end_date;?>" autocomplete="off"/>
                    <select name="end_time" id="end_time" style="float: left; width:100px; height: 27px; margin-left: 10px;">
                        <option>마감 시간</option>
                        <?
                            for($time=0;$time<24;$time++){
                                $ws_now_check = 0;
                                if($time<10){
                                    $time_num ='0'.$time;
                                }else{
                                    $time_num = $time;
                                }
                                if($end_time==$time_num.':00:00'){
                                    $ws_now_check = 1;
                                }else if($end_time==$time_num.':30:00'){
                                    $ws_now_check = 2;
                                }else if($end_time==$time_num.':59:00'){
                                    $ws_now_check = 3;
                                }else{
                                    $ws_now_check = 0;
                                }
                        ?>
                            <option <?if($ws_now_check==1){?>selected="selected"<?}?>><?echo $time;?>:00</option>
                            <option <?if($ws_now_check==2){?>selected="selected"<?}?>><?echo $time;?>:30</option>
                            <?
                            if($time=='23'){
                                ?>
                                <option <?if($ws_now_check==3){?>selected="selected"<?}?>><?echo $time;?>:59</option>
                                <?
                            }
                            ?>
                                    <?
                                        }
                                    ?>
                    </select>
                    <br/>
                    <hr/>
                    <h3>연락처</h3>
                    <input id='input_contact' name='input_contact' type='text' placeholder='연락처 혹은 이메일 주소를 입력해주세요.' value='<?if(isset($contact)) echo $contact;?>'/>
                    <span class='t_say'>
                        복수의 연락처를 입력할 경우 쉼표(,)를 이용해주세요.
                    </span>
                    <br/>
                    <hr/>
                     <h3>첨부 파일</h3>
                    <input id='input_file_attachment' name='input_file_attachment' type='hidden' placeholder='' value='<?if(isset($file_attachment)) echo $file_attachment;?>'/>
                    <button id='bt_file_attachment' onclick='upload_file_attachment();' class='btn btn-inverse'>
                        업로드
                    </button>
                    <button id="bt_delete_file_attachment" onclick='del_file_attachment();' class="btn btn-inverse">삭제</button>
                    <?
                    if(isset($file_attachment)){
                        if($file_attachment==''){
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
                    <br/>
                    <span class='t_say'>
                        모집공고, 신청 양식이 별도로 존재한다면 압축하여 업로드해주세요.
                        <div id='file_attachment_url'>
                            <?
                            if(isset($file_attachment)){
                                if($file_attachment!=''){
                                    $download_url= "/makepage/attach_download/". my_simple_crypt($file_attachment);
                                   echo "<a href='".$download_url."' target='_blank'>첨부 파일 보기</a>";
                                }
                            }
                            ?>
                        </div>
                    </span>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                    <div id='bt_area'>
                        <button id='post_project_info' onclick='save_outline();' class='btn btn-success'><img src='/img/icon/icon_save_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt="icon" />저장하기</button>
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