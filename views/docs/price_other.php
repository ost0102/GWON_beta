<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<?$this->load->view('/include/head_info');?>
<!--document 영역 style -->
<link href='/css/doc_style.css' rel='stylesheet' />
<script type='text/javascript'>
//jQuery 있는 상태
window.onload=function(){
    check_con_div();
    check_w_mode();
};

$(document).ready(function() {
    //유료 전환하기
    $('#show_calculation').click(function(){
        var user="<?echo $user;?>";
        if(user==""){
            alert("로그인 후 이용 가능합니다.");
            if($now_menu == 'none'){
                show_leftzone();
                $('html, body').animate( {scrollTop:0} );
            }
        }else{
            //alert('가격 계산기를 보여주세요.');
            $('#show_calculation').hide();
            $('#cal_area').slideDown();
            var num_w = -100;
            var div1 = $('#cal_area').offset().top+num_w;
            $('html, body').animate( {scrollTop:div1} );
        }
      
      //location.replace('/makepage/outline/');
    });

    $('#save_offer2').click(function(){
        //alert('문의하기 - 되는줄 알았지 :)');
        //변수 설정
        var live_check1 = $('#live_check1').is(':checked');
        var live_check2 = $('#live_check2').is(':checked');
        var live_check3 = $('#live_check3').is(':checked');
        var option_check1 = $('#option_check1').is(':checked');
        var option_check2 = $('#option_check2').is(':checked');
        var social_check1 = $('#social_check1').is(':checked');

        var total_sum = $('#input_sum').val();
        var page_info = $('#page_type').val();
        var u_name = $('#u_name').val();
        var u_email = $('#u_email').val();
        var u_phone = $('#u_phone').val();
        var u_comment = $('#u_comment').val();
        //alert(page_info);
        if(u_name=='' || u_email=='' || u_phone==''){
            alert('사용자 이름, 이메일, 연락처 정보를 모두 기입해주세요.')
        }else{
            $.post('/docs/input_offer_other',{
                live_check1: live_check1,
                live_check2: live_check2,
                live_check3: live_check3,
                option_check1: option_check1,
                option_check2: option_check2,
                social_check1: social_check1,
                total_sum: total_sum,
                page_info: page_info,
                u_name: u_name,
                u_email: u_email,
                u_phone: u_phone,
                u_comment: u_comment
            },
            function(data){
                alert('접수되었습니다.');
                location.href = '/mypage#!5';
            });
        }
      //location.replace('/makepage/outline/');
    });

    //기존 작성한 페이지 선택할 경우 변경값 체크
     $('#page_select').change(function(){
        var select_page = $('#page_select option:selected').val();
         $('#page_type').val(select_page);
     });
});

</script>
</head>
<body>
<div id='right_top_shape'>
    <a href='http://<?=$config['intro_url'];?>/page'><img src='/img/land/right_top_shape.png' class='logo_shape' alt='intropage_logo_shape' /></a>
</div>
<div id='container'>
    <div class='menu_left'>
        <div id='menu_area'>
            <!-- sub_top area include -->
            <?$this->load->view('/include/sub_top');?>
            <!-- menu area 시작 -->
            <?$this->load->view('/include/left_menu');?>
            <!-- menu area 끝 -->
        </div>
        <div class='bt_sub'>
        </div>
    </div>
</div>
<div class='contents'>
    <!--상단영역 -->
    <?$this->load->view('/include/top_area');?>
    <!--상단영역 끝-->
    <!--콘텐츠 영역 -->
    <div id='content_area'>
        <div id='con_div'>
            <!-- Contents Area Start -->
            <div id='con_area'>
                <h1 style="margin-top:10px; padding-bottom:10px; margin-bottom:10px; border-bottom: 1px solid #cdcdcd;">
                    Help - 서비스 요금 / 기술 지원
                </h1>
                <div id='con_main'>
                    <div id='price_menu'>
                        <?$this->load->view('/include/price_menu');?>
                    </div>
                    <div class='script mg_top_15'>
                        온라인 생중계 등 특정 목적에 맞는 싱글페이지가 필요한 경우 지원 요청을 하실 수 있습니다.
                    </div>
                    <h3>1. 표준 가격 정책</h3>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                    <!--온랑니 생중계 -->
                    <table id='price_table'>
                        <tr class='price_table_effect_tr'>
                            <th colspan='3'>
                                <img id="service_descript4" src='/img/icon/icon_camera.png' class='icon_st'/>온라인 생중계
                            </th>
                        </tr>
                        <tr class='price_table_imgarea'>
                            <td colspan='3'>
                                <img src='/img/guide/guide_img3.jpg' style='width: 90%;'/>
                            </td>
                        </tr>
                        <tr>
                            <th class='price_td_t'>항목</td>
                            <th class='price_td_con'>지원 범위</td>
                            <th class='price_td_val'>가격</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>기본 구성</td>
                            <td>
                                1대의 HD 컨퍼런스 캠을 통해 연사/세미나의 모습을 촬영하여 
                                Youtube, 아프리카 등 동영상 채널과의 연계를 통해 온라인 생중계를 할 수 있는 인트로 페이지를 개발합니다.<br/>
                                현장 인원: 2명
                            </td>
                            <td>60만원</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>일반 구성
                            <td>
                                기본 구성에 사진 촬영, 실시간 콘텐츠 업데이트 기능을 통합하여 제공하여
                                온라인 생중계 사이트에 방문한 고객이 영상과 함께 텍스트와 사진을 사이트에서 인트로페이지에서 실시간으로 확인할 수 있습니다.<br/>
                                현장 인원: 3명
                            </td>
                            <td>100만원</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>고급 구성</td>
                            <td>다중 카메라 설치가 필요한 중, 대형 강연 및 컨퍼런스에 적합한 인력 및 장비를 지원합니다.</td>
                            <td>300만원 ~ <br/>(기능 범위에 따라 협의 필요)</td>
                        </tr>
                   
                    </table>
                    <!--하단 설명영역-->
                    <div class='script mg_top_15'>
                        - <a href="/docs/help_sample" target="_blank">기능 샘플 페이지 참고하기</a><br/>
                        - 본 금액은 부가세 별도 금액입니다.<br/>
                        - 사회적 경제 영역의 프로젝트 사이트는 30%의 할인을 제공합니다.<br/>
                        - 위의 가격은 표준 페이지의 양에 따른 가격으로, 최종 견적은 문의 내용의 검토를 통해 확정됩니다.
                    </div>
                    <hr style="margin-top: 10px; margin-bottom: 10px;"/>
                    <div class='bt_start'>
                        <button id="show_calculation" class="btn btn-primary" alt="문의하기">문의하기</button>
                    </div>
                    <div id='cal_area'>
                        <h3><img src='/img/icon/icon_calculation.png' class='icon_st'/>가격 계산기</h3>
                        <hr style='margin-top:10px; margin-bottom: 10px;'/>
                        <table id='price_table'>
                            <tr>
                                <th class='price_td_t'>항목</td>
                                <th class='price_td_con'>지원 범위</td>
                                <th class='price_td_val'>가격</td>
                            </tr>
                            <tr>
                                <td class='price_td_t'>페이지 선택</td>
                                <td colspan='2'>
                                    <input type="checkbox" id="check_page" name="" value="" onclick='check_page(1);' checked="checked" /> 신규 페이지<br/>
                                    <input type="checkbox" id="check_page2" name="" value="" onclick='check_page(2);' /> 기존 작성한 페이지<br/>
                                    <div id='check_page_detail'>
                                        <select id='page_select' name='page_select'>
                                            <option>Select intropage</option>
                                            <? if(isset($my_project)){
                                                    foreach ($my_project as $my_project)
                                                    {
                                                        $w_num = $my_project['w_num'];
                                                        $title = $my_project['title'];

                                                        echo '<option value="'.$w_num.'" onclick="page_select()">'.$title.'</option>';
                                                    }
                                            }else{
                                                echo '<option value="0" onclick="page_select()">작성한 페이지 정보가 없습니다.</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <input type='hidden' id='page_type' />
                                </td>
                            </tr>
                            <tr>
                                <td class='price_td_t'><a onclick="show_guide(4)">온라인 생중계</td>
                                <td>
                                    <input type="checkbox" id="live_check1" name="" value="" onclick='cal_check();' /> 기본 구성<br/>
                                    <input type="checkbox" id="live_check2" name="" value="" onclick='cal_check();' /> 일반 구성<br/>
                                    <input type="checkbox" id="live_check3" name="" value="" onclick='cal_check();' /> 고급 구성
                                </td>
                                <td id='live_sum'>0</td>
                            </tr>
                            <tr>
                                <td class='price_td_t'>추가 선택</td>
                                <td>
                                    <input type="checkbox" id="option_check1" name="" value="" onclick='cal_check();' /> 영상 후 편집<br/>
                                    <input type="checkbox" id="option_check2" name="" value="" onclick='cal_check();' /> 촬영 사진 후 편집
                                </td>
                                <td id='option_sum'>0</td>
                            </tr>
                            <tr>
                                <td class='price_td_t'>할인</td>
                                <td>
                                    <input type="checkbox" id="social_check1" name="" value="" onclick='cal_check();' /> 사회적 경제 영역 (30%할인)
                                </td>
                                <td id='con_sum'>0</td>
                            </tr>
                            <tr class='price_table_effect_tr'>
                                <th>예상 견적</th>
                                <th colspan='2' id='total_sum'>
                                    0
                                </th>
                            </tr>
                        </table>
                         <input type="hidden" id="input_sum" name="" value="" /> 
                        <div id='cal_option' class='script mg_top_15'>
                        </div>
                        <script type='text/javascript'>
                        function cal_check(){
                            var live_check1 = $('#live_check1').is(':checked');
                            var live_check2 = $('#live_check2').is(':checked');
                            var live_check3 = $('#live_check3').is(':checked');
                            var option_check1 = $('#option_check1').is(':checked');
                            var option_check2 = $('#option_check2').is(':checked');
                            var social_check1 = $('#social_check1').is(':checked');
                            var now_price = 0;
                            var live_sum = 0;
                            var option_sum = 0;
                            var option1 = 0;
                            var option2 = 0;
                            var option3 = 0;
                            //live 영역 계산 시작
                            if(live_check1==true){ now_price = now_price+600000; }
                            if(live_check2==true){ now_price = now_price+1000000; }
                            if(live_check3==true){ now_price = now_price+3000000; }
                            //design 결과값 넣기
                            live_sum = comma(now_price);
                            live_total = now_price;
                            $('#live_sum').html(live_sum);

                            //option 영역 계산 시작
                            if(option_check1==true){ now_price = now_price+300000; option1++;}
                            if(option_check2==true){ now_price = now_price+100000; option2++; }
                            //design 결과값 넣기
                            opt_sum = comma(now_price-live_total);
                            opt_total = now_price-live_total;
                            $('#option_sum').html(opt_sum);
                            
                            //사회적 경제 영역 체크 
                            if(social_check1==true){ now_price = now_price*.7; option3++; }

                            //total sum
                            //소수점 버리기
                            now_price = Math.round(now_price);
                            var total_sum = comma(now_price);
                            $('#total_sum').html(total_sum);
                            $('#input_sum').val(now_price);

                            //option 글 관리
                            var option_val = '* 부가세 별도입니다.<br/>';
                            var option1_cmt = '* 영상 시간에 따라 비용은 달라집니다.<br/>';
                            var option2_cmt = '* 촬영 사진의 장수에 따라 가격은 달라집니다.<br/>';
                            var option3_cmt = '* 사회적 경제영역 할인을 선택하셨습니다.<br/>';
                            option_val = option_val;
                            if(option1==1){
                                option_val = option_val+option1_cmt;
                            }
                            if(option2==1){
                                option_val = option_val+option2_cmt;
                            }
                            if(option3==1){
                                option_val = option_val+option3_cmt;
                            }
                            $('#cal_option').html(option_val);
                        }

                        //숫자변수 3자리마다 콤마 붙이기
                        function comma(num) {     // 숫자에 콤마 삽입  
                            var len, point, str;  
                      
                            num = num + "";  
                            point = num.length % 3  
                            len = num.length;  
                      
                            str = num.substring(0, point);  
                            while (point < len) {  
                                if (str != "") str += ",";  
                                str += num.substring(point, point + 3);  
                                point += 3;  
                            }  
                            return str; 
                            
                        }
                        function check_page(val){
                            //alert('test');
                            if(val==1){
                                //page_val = '신규 페이지';
                                page_val = 0;
                                //체크박스 - 다른쪽꺼 비활성화하기
                                $('#check_page').prop('checked', true);
                                $('#check_page2').prop('checked', false);
                                $('#check_page_detail').hide();
                            }else{
                                page_val = '';
                                $('#check_page').prop('checked', false);
                                $('#check_page2').prop('checked', true);
                                $('#check_page_detail').show();
                            }
                            $('#page_type').val(page_val);
                        }

                        function show_guide(val){
                            //함수 호출시 해당하는 가이드쪽으로 이동
                            var num_w = -100;
                            if(val==4){
                                var guide1 = $('#service_descript4').offset().top+num_w;
                            }

                            $('html, body').animate( {scrollTop:guide1} );
                        }
                        </script>
                        <!--견적 문의 form-->
                        <table id='price_table'>
                            <tr>
                                <td class='price_td_t'>사용자 정보</td>
                                <td>
                                    <table id='user_info_table'>
                                        <tr>
                                            <td class='user_info_table_title'>Name</td>
                                            <td><input type="text" id="u_name" name="" value="<? if(isset($u_name)){ echo $u_name; } ?>" style="width: 90%;"/></td>
                                        </tr>
                                        <tr>
                                            <td class='user_info_table_title'>E-mail</td>
                                            <td><input type="email" id="u_email" name="" value="<? if(isset($email)){ echo $email; } ?>" style="width: 90%; ime-mode:disabled"/></td>
                                        </tr>
                                        <tr>
                                            <td class='user_info_table_title'>Phone</td>
                                            <td><input type="text" id="u_phone" name="" value="" style="width: 90%;"/></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class='price_td_t'>추가 의뢰 내용</td>
                                <td>
                                    <textarea id='u_comment' style="width: 90%;"></textarea>
                                    <!--하단 설명영역-->
                                    <div class='script'>
                                        페이지와 관련된 정보의 온라인 링크를 추가하거나, 요청 업무에 대한 자세한 사항을 입력해주세요.
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div class='bt_start'>
                           <button id="save_offer2" class="btn btn-success" alt="문의하기">문의하기</button>
                        </div>
                    </div>
                    <!-- 연락처 정보 시작 -->
                    <?$this->load->view('/include/call_info');?>
                    <!-- copyright area 시작 -->
                    <?$this->load->view('/include/bottom');?>
                    <!-- copyright area 끝 -->
                </div>
            </div>
            <!-- Contents Area finish -->
        </div>
    </div>
    <!--콘텐츠 영역 끝 -->
</div>

<div id='modal_content'>
    <div id='modal_txt'>
        <!--내용 출력부분 시작-->
        이곳에 내용 출력
    </div>
    <div id='login_close'>
        <a onclick='modal_off()'><img src='/img/land/bt_close.png' alt='' /></a>
    </div>
</div>
<!--모달창 출력부분 끝 -->
<!--modal창 관련 -->
<script type='text/javascript' src='/js/jquery.simplemodal.js'></script>
</body>
</html>