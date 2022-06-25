<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<!--?$this->load->view('/include/head_info');?-->

<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<meta content='width=device-width,minimum-scale=1,maximum-scale=1' name='viewport' />
<title>intropage.net :: Quick and easy to make your project site.</title>
<meta name="description" content="인트로페이지는 싱글페이지 기반 홈페이지 제작 서비스로 프로젝트 사이트를 쉽게 만들 수 있습니다." />
<meta name="keywords" content="인트로페이지, 홈페이지 제작, 스토리텔링 사이트 제작, intropage" />
<meta property="og:url" content="<? echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>" />
<meta property="og:title" content="intropage.net :: Quick and easy to make your project site." />
<meta property="og:description" content="인트로페이지는 싱글페이지 기반 홈페이지 제작 서비스로 프로젝트 사이트를 쉽게 만들 수 있습니다." />
<meta property="og:image" content="http://intropage.net/img/logo.png" />
<script type='text/javascript' src='/js/html5.js'></script>
<script type="text/javascript" src="/assets/js/jquery-2.2.1.min.js"></script>
<script type='text/javascript' src='/js/selectivizr.js'></script>
<!--intropage script 모음 ! -->
<script type='text/javascript' src='/js/intropage.js'></script>
<!--intropage design 관련 ! -->
<link href='/css/bootstrap.min.css' rel='stylesheet' />
<link href='/css/ipg_html_layout2.css' rel='stylesheet' type='text/css'/>
<link href='/css/ipg_layout.css' type='text/css' rel='stylesheet' media='screen and (min-width:600px)'/>
<link href='/css/ipg_layout_m.css' type='text/css' rel='stylesheet' media='screen and (max-width:599px)'/>

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
<div class='contents'>
    <!--콘텐츠 영역 -->
    <div id='content_area'>
        <div id='con_div'>
            <!-- Contents Area Start -->
            <div id='con_area'>
                <h3 style="margin-top:10px;">
                    개인정보 수집 및 이용 동의
                </h3>
                <div id='con_main'>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                    <div class="clause" style="color: rgb(51, 51, 51); font-family: Dotum; background-color: rgb(255, 255, 255);">
                        <h1 id="x611e7e75legal-privacyMin-0" style="margin: 1em 0px 0px; font-size: 12px; padding: 0px;">수집하는 개인정보의 항목</h1>
                        <p>1. 회원구분에 따라서 다음의 목적을 위해서 회원정보를 수집, 이용하고 있습니다.</p>
                    </div>
                    <div class="clause" style="color: rgb(51, 51, 51); font-family: Dotum; background-color: rgb(255, 255, 255);">
                        <p>가. 모든 회원공통</p>
                        <div class="clause" style="margin-left: 20px;">
                            <p class="legalItem extraWide" style="margin-left: 20px; padding-left: 32px; text-indent: -32px;">
                                필수 : 성명, E-MAIL, 비밀번호, 국가, 휴대전화번호, 마이페이지주소
                            </p>
                            <p class="legalItem extraWide" style="margin-left: 20px; padding-left: 32px; text-indent: -32px;">
                                선택 : 이용정보 - 성별, 나이, 생성한 페이지 정보, 시리즈 정보, 팀 정보, 결제 정보, 홈페이지, SNS 정보 ( 페이스북, 트위터, 카카오, 구글, 네이버, 다음 )
                            </p>
                        </div>
                        <p>나. 페이지 생성자 (개인)</p>
                        <div class="clause" style="margin-left: 20px;">
                            <p class="legalItem extraWide" style="margin-left: 20px; padding-left: 32px; text-indent: -32px;">
                                필수 : 정산정보 - 신분증 사본, 결제 정산용 통장사본, 이메일
                            </p>
                        </div>
                        <p>다. 페이지 생성자 (법인)</p>
                        <div class="clause" style="margin-left: 20px;">
                            <p class="legalItem extraWide" style="margin-left: 20px; padding-left: 32px; text-indent: -32px;">
                                필수 : 기업정보 - 회사명, 회사주소, 회사전화번호, 회사 FAX, 대표자명, 사업자등록번호, 업태, 종목, 담당자 이름, 담당자 E-MAIL, 담당자 휴대전화
                            </p>
                        </div>
                        <p>라. 일반 회원</p>
                        <div class="clause" style="margin-left: 20px;">
                            <p style="margin-left: 20px;">인트로페이지 생성자가 추가로 요구하는 정보</p>
                        </div>
                        <p class="legalItem wide" style="padding-left: 20px; text-indent: -20px;">
                            2. 기타 이용과정이나 사업처리 과정에서 아래와 같은 정보들이 자동으로 생성되어 수집될 수 있습니다.
                        </p>
                        <div class="clause" style="margin-left: 20px;">
                            <p class="legalItem wide" style="margin-left: 20px; padding-left: 20px; text-indent: -20px;">
                                - 서비스 이용기록, 접속 로그, 쿠키, 접속IP 정보, 결제기록: 부정 이용 방지, 비인가 사용 방지 등
                            </p>
                        </div>
                        <p class="legalItem wide" style="padding-left: 20px; text-indent: -20px;">
                            3. 회원님의 기본적 인권 침해의 우려가 있는 민감정보 (범죄경력, 유전정보 등)를 수집하지 않습니다.
                        </p>
                        <p class="legalItem wide" style="padding-left: 20px; text-indent: -20px;">
                            4. 회원님이 제공하신 모든 정보는 상기 목적에 필요한 용도 이외로는 사용되지 않으며, 수집정보의 범위나 사용목적, 용도가 변경될 시에는 반드시 회원님들께 사전동의를 구할 것 입니다.
                        </p>
                    </div>
                    <div class="clause" style="color: rgb(51, 51, 51); font-family: Dotum; background-color: rgb(255, 255, 255);">
                        <h1 id="x611e7e75legal-privacyMin-1" style="margin: 1em 0px 0px; font-size: 12px; padding: 0px;">
                            개인정보의 보유 및 이용목적
                        </h1>
                        <p>1.개인정보의 수집 및 이용 목적</p>
                        <div class="clause" style="margin-left: 20px;">
                            <p style="margin-left: 20px;">"개인정보"라 함은 생존하는 개인에 관한 정보로, 성명, 이메일 주소, 전화번호 등 개인을 식별할 수 있는 정보를 말합니다.</p>
                            <p style="margin-left: 20px;">대부분의 온오프믹스 서비스는 별도의 사용자 등록이 없이 언제든지 볼 수 있습니다.</p><p style="margin-left: 20px;">
                            그러나 회사는 회원서비스(이벤트 생성과 같이 현재 제공 중이거나 향후 제공될 로그인 기반의 서비스)등을 통하여 이용자들에게 맞춤 식 서비스를 비롯한 보다 더 향상된 양질의 서비스를 
                            제공하기 위하여 이용자 개인의 정보를 수집하고 있습니다.</p>
                            <p style="margin-left: 20px;">회사는 이용자의 사전 동의 없이는 이용자의 개인 정보를 공개하지 않으며, 수집된 정보는 아래와 같이 이용하고 있습니다.</p>
                            <div class="clause" style="margin-left: 20px;">
                                <p class="legalItem wide" style="margin-left: 20px; padding-left: 20px; text-indent: -20px;">
                                    가. 이용자들의 개인정보를 기반으로 보다 더 유용한 서비스를 개발할 수 있습니다. 회사는 신규 서비스개발이나 콘텐츠의 확충 시에 기존 이용자들이 회사에 제공한 개인정보를 
                                    바탕으로 개발해야 할 서비스의 우선 순위를 보다 더 효율적으로 정하고, 회사는 이용자들이 필요로 할 콘텐츠를 합리적으로 선택하여 제공할 수 있습니다.
                                </p>
                                <p class="legalItem wide" style="margin-left: 20px; padding-left: 20px; text-indent: -20px;">
                                    나. 회사가 제공하는 각종 정보 및 서비스 등은 대부분 무료입니다. 회사는 이러한 무료 서비스를 제공하기 위해 광고를 유치할 수 있으며 이때 이용자들에 대한 정확한 개인정보를 
                                    바탕으로 각 서비스나 메뉴 등에 적절하게 광고와 내용들을 전달할 수 있습니다. 회사는 광고주들로부터 광고를 받아 광고주들이 대상으로 하려는 이용자의 유형에 맞게 광고를 보여줄 뿐, 
                                    광고주들에게는 절대로 이용자들의 개인정보를 보여주거나 제공하지 않습니다.
                                </p>
                                <p class="legalItem wide" style="margin-left: 20px; padding-left: 20px; text-indent: -20px;">
                                    다. 회사가 제공하는 서비스의 원활한 이용을 위하여 회원은 적법한 동의절차를 거쳐 SNS 업체가 연결을 위한 정보를 회사에 제공하도록 할 수 있습니다. 회사는 연결된 SNS 를 
                                    원활한 서비스 제공을 위해 사용자에게서 권한이 허락된 범위 안에서 이를 활용할 수 있으며, 허락되지 않은 범위에 대해서는 절대 활용하지 않습니다. 
                                    서비스 이용을 위하여 회원으로부터 추가적인 권한의 요청을 필요로 할 경우, 각 SNS의 인증서비스를 통하여 이에 대한 사전 동의를 반드시 구할 것 입니다.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="clause" style="color: rgb(51, 51, 51); font-family: Dotum; background-color: rgb(255, 255, 255);">
                        <h1 id="x611e7e75legal-privacyMin-2" style="margin: 1em 0px 0px; font-size: 12px; padding: 0px;">개인정보의 보유 및 이용기간</h1>
                        <p>회사는 원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당 개인정보를 지체 없이 파기합니다.</p>
                        <p>단, 다음의 정보에 대해서는 아래의 이유로 명시한 기간 동안 보존 합니다.</p>
                        <div class="clause" style="margin-left: 20px;">
                            <p class="legalItem wide" style="margin-left: 20px; padding-left: 20px; text-indent: -20px;">- 보존 항목 : 쿠키,세션</p>
                            <p class="legalItem wide" style="margin-left: 20px; padding-left: 20px; text-indent: -20px;">- 보존 근거 : 회사의 서비스이용약관 및 개인정보취급방침에 동의</p>
                            <p class="legalItem wide" style="margin-left: 20px; padding-left: 20px; text-indent: -20px;">- 보존 기간 : 로그아웃 시 삭제</p>
                        </div>
                        <p>그리고 관계법령의 규정에 의하여 보존할 필요가 있는 경우 회사는 아래와 같이 관계법령에서 정한 일정한 기간 동안 회원정보를 보관합니다.</p>
                        <div class="clause" style="margin-left: 20px;"><p class="legalItem wide" style="margin-left: 20px; padding-left: 20px; text-indent: -20px;">
                            - 보존 항목 : 이름, E-MAIL, 휴대전화번호, 비밀번호, 이용정보, 정산정보, 기업정보</p>
                            <p class="legalItem wide" style="margin-left: 20px; padding-left: 20px; text-indent: -20px;">- 보존 근거 : 회사의 서비스이용약관 및 개인정보취급방침에 동의</p>
                            <p class="legalItem wide" style="margin-left: 20px; padding-left: 20px; text-indent: -20px;">- 보존 기간 : 회원으로서의 자격을 유지하는 동안</p>
                        </div><p>[기타]</p><div class="clause" style="margin-left: 20px;">
                        <p class="legalItem" style="margin-left: 20px; padding-left: 15px; text-indent: -15px;">1) 계약 또는 청약철회 등에 관한 기록</p>
                        <div class="clause" style="margin-left: 20px;">
                            <p class="legalItem" style="margin-left: 20px; padding-left: 15px; text-indent: -15px;">- 보존근거: 전자상거래 등에서의 소비자보호에 관한 법률</p>
                            <p class="legalItem" style="margin-left: 20px; padding-left: 15px; text-indent: -15px;">- 보존기간: 5년&nbsp;<br>( 모임/행사 참가신청 정보는 계약 정보에 해당 합니다. )</p>
                        </div>
                        <p class="legalItem" style="margin-left: 20px; padding-left: 15px; text-indent: -15px;">2) 대금결제 및 재화 등의 공급에 관한 기록</p>
                        <div class="clause" style="margin-left: 20px;">
                            <p class="legalItem" style="margin-left: 20px; padding-left: 15px; text-indent: -15px;">- 보존근거: 전자상거래 등에서의 소비자보호에 관한 법률</p>
                            <p class="legalItem" style="margin-left: 20px; padding-left: 15px; text-indent: -15px;">- 보존기간: 5년</p>
                        </div>
                        <p class="legalItem" style="margin-left: 20px; padding-left: 15px; text-indent: -15px;">3) 소비자의 불만 또는 분쟁처리에 관한 기록</p>
                        <div class="clause" style="margin-left: 20px;">
                            <p class="legalItem" style="margin-left: 20px; padding-left: 15px; text-indent: -15px;">- 보존근거: 전자상거래등에서의 소비자보호에 관한 법률</p>
                            <p class="legalItem" style="margin-left: 20px; padding-left: 15px; text-indent: -15px;">- 보존기간: 3년</p>
                        </div>
                        <p class="legalItem" style="margin-left: 20px; padding-left: 15px; text-indent: -15px;">4) 웹사이트 방문기록</p>
                        <div class="clause" style="margin-left: 20px;">
                            <p class="legalItem" style="margin-left: 20px; padding-left: 15px; text-indent: -15px;">-보존근거: 통신비밀보호법</p>
                            <p class="legalItem" style="margin-left: 20px; padding-left: 15px; text-indent: -15px;">-보존기간: 3개월</p>
                        </div>
                    </div>
                </div>
                    <!--하단 설명영역-->
                    <!-- copyright area 시작 -->
                    <!-- copyright area 끝 -->
                </div>
            </div>
            <!-- Contents Area finish -->
        </div>
    </div>
    <!--콘텐츠 영역 끝 -->
</div>

<!--모달창 출력부분 끝 -->
<!--modal창 관련 -->
<script type='text/javascript' src='/js/jquery.simplemodal.js'></script>
</body>
</html>