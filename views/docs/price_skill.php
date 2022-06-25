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
    //문의하기로 선택한 데이터값 넘기기
    $('#save_offer').click(function(){
        //alert('문의하기 - 되는줄 알았지 :)');
        //변수 설정
        $modal_state ='off';
        $('#save_offer').hide();
        var now_txt = '문의 내용을 등록중입니다.';
        open_modal(now_txt);
        var design_check1 = $('#design_check1').is(':checked');
        var design_check2 = $('#design_check2').is(':checked');
        var design_check3 = $('#design_check3').is(':checked');
        var design_check4 = $('#design_check4').is(':checked');
        var code_check1 = $('#code_check1').is(':checked');
        var code_check2 = $('#code_check2').is(':checked');
        var code_check3 = $('#code_check3').is(':checked');
        var con_check1 = $('#con_check1').is(':checked');
        var con_check2 = $('#con_check2').is(':checked');
        var con_check3 = $('#con_check3').is(':checked');
        var social_check1 = $('#social_check1').is(':checked');
        var other_check1 = $('#other_check1').is(':checked');
        var total_sum = $('#input_sum').val();
        var page_info = $('#page_type').val();
        var u_name = $('#u_name').val();
        var u_email = $('#u_email').val();
        var u_phone = $('#u_phone').val();
        var u_comment = $('#u_comment').val();

        if(u_name=='' || u_email=='' || u_phone==''){
            alert('사용자 이름, 이메일, 연락처 정보를 모두 기입해주세요.')
        }else{
            $.post('/docs/input_offer_skill',{
                design_check1: design_check1,
                design_check2: design_check2,
                design_check3: design_check3,
                design_check4: design_check4,
                code_check1: code_check1,
                code_check2: code_check2,
                code_check3: code_check3,
                con_check1: con_check1,
                con_check2: con_check2,
                con_check3: con_check3,
                social_check1: social_check1,
                other_check1: other_check1,
                total_sum: total_sum,
                page_info: page_info,
                u_name: u_name,
                u_email: u_email,
                u_phone: u_phone,
                u_comment: u_comment
            },
            function(data){
                alert('접수되었습니다.');
                //입력값 초기화하기
                //open_modal(data);
                //fadeout_modal();
                //alert('페이지의 콘텐츠 입력단계로 이동합니다.');
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
                    <div class='script'>
                        기획, 디자인, 개발 중 필요한 기술 지원만을 선택하여 요청하실 수 있습니다.
                    </div>
                    <h3>1. 표준 가격 정책</h3>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                    <!--디자인 개발 영역 -->
                    <table id='price_table'>
                        <tr class='price_table_effect_tr'>
                            <th colspan='3'>
                                <img id="service_descript1" src='/img/icon/icon_noti_big.png' class='icon_st'/>디자인 도움이 필요해요!
                            </th>
                        </tr>
                        <tr class='price_table_imgarea'>
                            <td colspan='3'>
                                <img src='/img/guide/guide_img2.jpg' style='width: 90%;'/>
                            </td>
                        </tr>
                        <tr>
                            <th class='price_td_t'>항목</td>
                            <th class='price_td_con'>지원 범위</td>
                            <th class='price_td_val'>가격</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>콘텐츠 디자인 개선</td>
                            <td>이용자가 작성한 콘텐츠 내용을 선택하신 템플릿에 맞춰 디자인을 개선하는 작업을 진행합니다.</td>
                            <td>30만원</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>기본 템플릿 최적화</td>
                            <td>고객이 선택한 인트로 페이지에서 제공하는 기본 템플릿의 배경 이미지, 폰트 색상 및 본문 콘텐츠 영역 등을 수정하는 작업을 진행합니다.</td>
                            <td>50만원</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>신규 템플릿 제작</td>
                            <td>고객의 콘텐츠 특성을 분석하여 새로운 템플릿을 디자인합니다.</td>
                            <td>100만원 ~ <br/>(협의 후 결정)</td>
                        </tr>
                    <!--기능 개발 영역 -->
                        <tr class='price_table_effect_tr'>
                            <th colspan='3'>
                                <img  id="service_descript2" src='/img/icon/icon_noti_big.png' class='icon_st'/>기능 개발에 대한 도움이 필요해요!
                            </th>
                        </tr>
                        <tr class='price_table_imgarea'>
                            <td colspan='3'>
                                <img src='/img/guide/guide_img1.jpg' style='width: 90%;'/>
                            </td>
                        </tr>
                        <tr>
                            <th class='price_td_t'>항목</td>
                            <th class='price_td_con'>지원 범위</td>
                            <th class='price_td_val'>가격</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>레이아웃 정리</td>
                            <td>본문 콘텐츠를 수정했는데, 정렬이 깨지는 등 레이아웃의 간단 수정 업무를 지원해드립니다.</td>
                            <td>무료~5만원<br/>(변경 양에 따라 달라집니다.)</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>인터렉션 (반응형 이벤트)</td>
                            <td>해당 템플릿에서 제공하는 인터렉션 효과가 있는 경우, 콘텐츠 집중력을 높일 수 있는 강조 효과 등을 요청할 수 있습니다.</td>
                            <td>30만원</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>외부 모듈 연동</td>
                            <td>Youtube, Flicker 등 페이지와 관련된 외부 채널의 콘텐츠를 연동할 수 있습니다.</td>
                            <td>5만원<br/>(단순 연동시)</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>고급 기능 요청</td>
                            <td>별도로 기능 개발이 필요한 경우, 요청을 하시면 협의 후 개발을 진행합니다.</td>
                            <td>협의 후 결정</td>
                        </tr>
                    <!--콘텐츠 구성 영역 -->
                        <tr class='price_table_effect_tr'>
                            <th colspan='3'>
                                <img  id="service_descript3" src='/img/icon/icon_noti_big.png' class='icon_st'/>콘텐츠 구성에 대한 도움이 필요해요!
                            </th>
                        </tr>
                        <tr>
                            <th class='price_td_t'>항목</td>
                            <th class='price_td_con'>지원 범위</td>
                            <th class='price_td_val'>가격</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>콘텐츠 구성 Tool Kit</td>
                            <td>
                                프로젝트를 효과적으로 소개하기 위해서는 스토리텔링 기반의 콘텐츠 전달이 필요합니다.
                                콘텐츠 구성 Tool Kit은 좋은 가이드가 될 것입니다.
                            </td>
                            <td>15만원</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'><a href="http://intropage.tistory.com/entry/%EB%AA%A8%EB%B0%94%EC%9D%BC-%EC%A0%84%EC%9A%A9-%EC%82%AC%EC%9D%B4%ED%8A%B8-%EA%B0%9C%EC%84%A4%EC%84%B8%EA%B3%84%ED%83%9C%EA%B6%8C%EB%8F%84%ED%8F%89%ED%99%94%EB%B4%89%EC%82%AC%EC%9E%AC%EB%8B%A8" target="_blank">기획 대행</a></td>
                            <td>사이트 방문 목적 분석을 통한 사이트 구성 기획, 운영과 관련된 전략을 수립합니다.</td>
                            <td>100만원</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>사진 촬영</td>
                            <td>전문적인 사진이 필요한가요?</td>
                            <td>30만원<br/>(1일 기준)</td>
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
                        <button id="show_calculation" class="btn btn-primary" alt="가격 계산기 출력하기">문의하기</button>
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
                                <td class='price_td_t'><a onclick="show_guide(1)">디자인 개선</a></td>
                                <td>
                                    <input type="checkbox" id="design_check1" name="" value="" onclick='cal_check();' /> 콘텐츠 디자인 개선<br/>
                                    <input type="checkbox" id="design_check2" name="" value="" onclick='cal_check();' /> 기본 템플릿 최적화<br/>
                                    <input type="checkbox" id="design_check3" name="" value="" onclick='cal_check();' /> 신규템플릿 제작 (디자인&개발 포함) - 고급 디자인<br/>
                                    <input type="checkbox" id="design_check4" name="" value="" onclick='cal_check();' /> 신규템플릿 제작 (디자인&개발 포함) - 일반 디자인
                                </td>
                                <td id='design_sum'>0</td>
                            </tr>
                            <tr>
                                <td class='price_td_t'><a onclick="show_guide(2)">기능 개선</a></td>
                                <td>
                                    <input type="checkbox" id="code_check0" name="" value="" onclick='cal_check();' /> 레이아웃 정리<br/>
                                    <input type="checkbox" id="code_check1" name="" value="" onclick='cal_check();' /> 인터렉션 기능 개발<br/>
                                    <input type="checkbox" id="code_check2" name="" value="" onclick='cal_check();' /> 외부 모듈 연동<br/>
                                    <input type="checkbox" id="code_check3" name="" value="" onclick='cal_check();' /> 고급 기능 요청
                                </td>
                                <td id='code_sum'>0</td>
                            </tr>
                            <tr>
                                <td class='price_td_t'><a onclick="show_guide(3)">콘텐츠 개선</a></td>
                                <td>
                                    <input type="checkbox" id="con_check1" name="" value="" onclick='cal_check();' /> 콘텐츠 구성 Tool Kit<br/>
                                    <input type="checkbox" id="con_check2" name="" value="" onclick='cal_check();' /> 기획 대행<br/>
                                    <input type="checkbox" id="con_check3" name="" value="" onclick='cal_check();' /> 사진 촬영
                                </td>
                                <td id='con_sum'>0</td>
                            </tr>
                            <tr>
                                <td class='price_td_t'>할인</td>
                                <td>
                                    <input type="checkbox" id="social_check1" name="" value="" onclick='cal_check();' /> 사회적 경제 영역 (30%할인)
                                </td>
                                <td id='con_sum'>0</td>
                            </tr>
                            <tr>
                                <td class='price_td_t'>기타</td>
                                <td>
                                    <input type="checkbox" id="other_check1" name="" value="" onclick='cal_check();' /> 직접 디자인한 시안을 코딩해주세요.
                                </td>
                                <td id='con_sum'></td>
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
                            var design_check1 = $('#design_check1').is(':checked');
                            var design_check2 = $('#design_check2').is(':checked');
                            var design_check3 = $('#design_check3').is(':checked');
                            var design_check4 = $('#design_check4').is(':checked');
                            var code_check0 = $('#code_check0').is(':checked');
                            var code_check1 = $('#code_check1').is(':checked');
                            var code_check2 = $('#code_check2').is(':checked');
                            var code_check3 = $('#code_check3').is(':checked');
                            var con_check1 = $('#con_check1').is(':checked');
                            var con_check2 = $('#con_check2').is(':checked');
                            var con_check3 = $('#con_check3').is(':checked');
                            var social_check1 = $('#social_check1').is(':checked');
                            var other_check1 = $('#other_check1').is(':checked');
                            var now_price = 0;
                            var design_sum = 0;
                            var code_sum = 0;
                            var option1 = 0;
                            var option2 = 0;
                            var option3 = 0;
                            if(design_check1==true){ now_price = now_price+300000; }
                            if(design_check2==true){ now_price = now_price+500000; }
                            if(design_check3==true){ now_price = now_price+3000000; }
                            if(design_check4==true){ now_price = now_price+1000000; }
                            //design 결과값 넣기
                            design_sum = comma(now_price);
                            design_total = now_price;
                            $('#design_sum').html(design_sum);

                            //code 영역 계산 시작
                            if(code_check0==true){ now_price = now_price+30000; }
                            if(code_check1==true){ now_price = now_price+300000; }
                            if(code_check2==true){ now_price = now_price+50000; }
                            if(code_check3==true){ option1++;}
                            //design 결과값 넣기
                            code_sum = comma(now_price-design_total);
                            code_total = now_price-design_total;
                            $('#code_sum').html(code_sum);

                            //콘텐츠 영역 계산 시작
                            if(con_check1==true){ now_price = now_price+150000; }
                            if(con_check2==true){ now_price = now_price+1000000; }
                            if(con_check3==true){ now_price = now_price+300000; }
                            //design 결과값 넣기
                            con_sum = comma(now_price-code_total-design_total);
                            $('#con_sum').html(con_sum);
                            
                            //사회적 경제 영역 체크 
                            if(social_check1==true){ now_price = now_price*.7; option2++; }
                            //사회적 경제 영역 체크 
                            if(other_check1==true){ option3++; }

                            //total sum
                            //소수점 버리기
                            now_price = Math.round(now_price);
                            var total_sum = comma(now_price);
                            $('#total_sum').html(total_sum);
                            $('#input_sum').val(now_price);

                            //option 글 관리
                            var option_val = '* 부가세 별도입니다.<br/>';
                            var option1_cmt = '* 고급 기능요청을 선택하셨습니다.(예상견적에서는 제외됩니다.)<br/>';
                            var option2_cmt = '* 사회적 경제영역 할인을 선택하셨습니다.<br/>';
                            var option3_cmt = '* 디자인 시안의 코딩을 요청하셨습니다.<br/>';
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
                                page_val = '기존 페이지';
                                $('#check_page').prop('checked', false);
                                $('#check_page2').prop('checked', true);
                                $('#check_page_detail').show();
                            }
                            $('#page_type').val(page_val);
                        }

                        function show_guide(val){
                            //함수 호출시 해당하는 가이드쪽으로 이동
                            var num_w = -100;
                            if(val==1){
                                var guide1 = $('#service_descript1').offset().top+num_w;
                            }else if(val ==2){
                                var guide1 = $('#service_descript2').offset().top+num_w;
                            }else if(val ==3){
                                var guide1 = $('#service_descript3').offset().top+num_w;
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
                                <td class='price_td_t'>메모</td>
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
                            <button id="save_offer" class="btn btn-success" alt="가격 계산기 출력하기">문의하기</button>
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