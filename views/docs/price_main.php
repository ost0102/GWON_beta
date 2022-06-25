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
                    <div class='script'>
                        인트로 페이지에서 제공하는 기술 지원 범위와 요금 안내 페이지입니다.<br/>
                        인트로 페이지를 제작하고 운영하시다가 도움이 필요한 부분을 요청해주시면 검토 후
                        빠르고 친절하게 지원 업무를 수행할 수 있도록 노력하고 있습니다.
                    </div><br/>
                    <h3>1. 이용 요금 안내</h3>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                    인트로 페이지는 개인/전문가/기업으로 회원을 구분하고 있으며, 회원 그룹별로 세부 제공 기능에 있어
                    조금씩 차이가 있습니다. <br/><br/>
                    <a href='/docs/price' target='_self'><b>> 자세히 보기</b></a>
                    <br/><br/>
                    <h3>2. 기술 지원 요청</h3>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                    인트로 페이지를 제작하고 운영하는 데 있어서 기획, 디자인, 개발에 대한 도움이 필요하신가요? 
                    원하는 항목만을 선택하여 기술 지원을 요청하실 수 있습니다.<br/><br/>
                    <a href='/docs/price_skill' target='_self'><b>> 자세히 보기</b></a>
                    <br/><br/>
                    <h3>3. 시리즈 맵 유료 사용 신청</h3>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                    인트로페이지 시리즈에 외부 링크와 위치 정보를 추가하고 싶으세요?
                    이제는 유료 결제를 통해 생성된 인트로페이지, 외부 페이지의 정보들을 모아
                    지도 정보를 만드실 수 있습니다.
                    <br/><br/>
                    <a href='/docs/price_map' target='_self'><b>> 자세히 보기</b></a>
                    <br/><br/>
                    <h3>3. 추가 지원 서비스</h3>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                    오프라인 행사를 계획하고 있다면 온라인 생중계를 인트로 페이지를 통해 진행해보세요.<br/>
                    또다른 인트로 페이지를 활용한 프로젝트를 계획 중이시라면 제안해 주세요.<br/><br/>
                    <a href='/docs/price_other' target='_self'><b>> 자세히 보기</b></a>
                    <br/><br/>
                    <h3>4. 메일로 문의하기</h3>
                    <hr style='margin-top:10px; margin-bottom: 10px;'/>
                    위에 해당되는 항목이 없나요? 문의하거나 건의할 사항이 있다면 언제나 이메일로 알려주세요.
                    <br/><br/>
                    <a href='/mail/mail_form' target='_self'><b>> 자세히 보기</b></a>
                    <br/><br/>
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