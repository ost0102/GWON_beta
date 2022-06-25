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
    $('#start_price').click(function(){
      alert('현재 개인계정으로만 사용가능합니다.');
      //location.replace('/makepage/outline/');
    });
    $('#start_reset').click(function(){
      alert('시범 운영 기간 중에는 무제한 트래픽을 제공합니다.');
      //location.replace('/makepage/outline/');
    });
    
    //geo정보 가져오기
    $('#get_geo').click(function(){
        var input_location = $('#geo_txt').val();
        if(input_location==''){
            alert('활동 지역명을 입력해주세요.');
        }else{
            $.post('/makepage/get_geo',{
                    map_info: input_location
                },
                function(data){
                    //alert(data);
                    //입력값 초기화하기
                    open_modal('지도 정보를 확인했습니다.');
                    $('#input_location').val(data);
                    $('#geo_state').text('지도 정보를 확인했습니다.');
                    open_modal(data);
                    fadeout_modal();

                    //지도출력 관련
                    $('#map_area').hide();
                    var ifr_url = '/makepage/get_map/'+data;
                    //alert(ifr_url);
                    $('#map_info_iframe').show();
                    $('#map_info_iframe').attr('src',ifr_url);
                    //alert('페이지의 콘텐츠 입력단계로 이동합니다.');
                    //location.replace('/page/');
                });
        }
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
                        인트로 페이지는 가치 있는 정보를 기록하고, 확산하는 과정에서 새로운 가치를 발굴하는 것을 목표로 서비스를 개발하였습니다.
                        정보를 기록하고 공유하는 데 비용적 부담을 문제가 되지 않게 하기 위해 최대한 저렴한 가격으로 유료모델들을 운영하고 있습니다.<br/>
                        제작하실 페이지에 많은 방문자가 유입하여 과도한 트래픽이 발생하는 경우에 한해 원활한 서비스 운영을 위해 해당 페이지로의 접근을 일시적으로 제한하지만,
                        이 또한 트래픽 용량을 추가하시면, 페이지 접근이 바로 가능합니다.
                    </div>
                    <h3>1. 기본 요금 안내</h3>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                    <table id='price_table'>
                        <tr>
                            <th>항목</th>
                            <th>개인</th>
                            <th>전문가</th>
                            <th>기업</th>
                        </tr>
                        <tr class='price_table_effect_tr'>
                            <td></td>
                            <td>무료</td>
                            <td>10만원</td>
                            <td>40만원</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'><a href="http://intropage.tistory.com/entry/%EA%B8%B0%EB%8A%A5-%EC%86%8C%EA%B0%9Clive-Update" target="_blank">페이지 생성</a></td>
                            <td>3개 / 1년</td>
                            <td>무제한</td>
                            <td>무제한</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>온라인 코드 편집기<br/>(CSS, JavaScript)</td>
                            <td>제공</td>
                            <td>제공</td>
                            <td>제공</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>트래픽 제한</td>
                            <td>1,000명 / 하루</td>
                            <td>10,000명 / 하루</td>
                            <td>무제한</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'><a href="http://intropage.tistory.com/entry/%EA%B8%B0%EB%8A%A5-%EC%86%8C%EA%B0%9Clive-Update" target="_blank">Live Update 지속시간</td>
                            <td>5분</td>
                            <td>2시간</td>
                            <td>24시간</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'><a href="http://intropage.tistory.com/entry/%EA%B8%B0%EB%8A%A5-%EC%86%8C%EA%B0%9C-%EA%B3%B5%EC%A7%80-%ED%8C%9D%EC%97%85" target="_blank">공지 팝업</a></td>
                            <td>3개 / 한달</td>
                            <td>20개 / 한달</td>
                            <td>무제한</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>운영 이슈 이메일 발송</td>
                            <td>제공</td>
                            <td>제공</td>
                            <td>제공</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'><a href="http://intropage.tistory.com/entry/%EA%B8%B0%EB%8A%A5-%EC%86%8C%EA%B0%9C-DashBoard" target="_blank">DashBoard</a></td>
                            <td>제공</td>
                            <td>제공</td>
                            <td>제공</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'><a href="http://intropage.tistory.com/entry/%EA%B8%B0%EB%8A%A5-%EC%86%8C%EA%B0%9C-%EC%8B%9C%EB%A6%AC%EC%A6%88" target="_blank">Series</a></td>
                            <td>제공</td>
                            <td>제공</td>
                            <td>제공</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>홍보 지원</td>
                            <td>-</td>
                            <td>제공</td>
                            <td>제공</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'><a href="http://intropage.tistory.com/entry/%EA%B8%B0%EB%8A%A5-%EC%B6%94%EA%B0%80-%EB%B6%84%EC%84%9D-%EC%A0%95%EB%B3%B4-%EC%97%91%EC%85%80-%ED%8C%8C%EC%9D%BC%EB%A1%9C-%EB%8B%A4%EC%9A%B4%EB%A1%9C%EB%93%9C%ED%95%98%EA%B8%B0" target="_blank">Excel 분석 자료</a></td>
                            <td>-</td>
                            <td>제공</td>
                            <td>제공</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>intropage Symbol 삭제</td>
                            <td>불가능</td>
                            <td>가능</td>
                            <td>가능</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>콘텐츠 백업</td>
                            <td>-</td>
                            <td>제공</td>
                            <td>제공</td>
                        </tr>
                        <tr class='price_table_imgarea'>
                            <td colspan='4'>
                                <img src='/img/guide/guide_img4.jpg' style='width: 90%;'/>
                            </td>
                        </tr>
                    </table>
                    <div class='script mg_top_15'>
                        본 금액은 부가세 별도 금액입니다.<br/>
                        - 위의 가격은 인트로 페이지의 기본 서비스 이용 금액입니다.<br/>
                        - 디자인/개발/기획 업무에 대해 기술 지원이 필요한 경우는 기술 지원 요청 항목을 통해 문의하실 수 있습니다.
                    </div>
                    <div class='bt_start'>
                        <button id="start_price" class="btn btn-primary" alt="유료 계정 전환하기">유료 계정 전환하기</button>
                    </div>

                    <h3>2. 추가 요금</h3>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                    <table id='price_table'>
                        <tr>
                            <th>항목</th>
                            <th>설명</th>
                            <th>가격</th>
                        </tr>
                        <tr>
                            <td class='price_td_t'>트래픽 초기화</td>
                            <td>방문자 트래픽 초기화를 신청하실 수 있습니다.</td>
                            <td>5천원 / 1GB</td>
                        </tr>
                        <tr>
                            <td class='price_td_t'>팀페이지 커스터마이징</td>
                            <td>팀페이지를 기관/팀의 성격에 맞게 디자인할 수 있습니다.</td>
                            <td>30만원 / 1년</td>
                        </tr>
                    </table>
                    <div class='bt_start'>
                       <button id="start_reset" class="btn btn-primary" alt="트래픽 초기화 신청">트래픽 초기화 신청</button>
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